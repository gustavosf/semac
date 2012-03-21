<?php

class Controller_A extends Controller_Semac {

	public $template = 'template_home';

	public function action_index($id)
	{
		$atividade = Model_Atividade::find($id);
		if ( ! $atividade->id) Response::redirect(404);
		$user = Model_User::instanceOfThis();

		$data = array();
		$data['id'] = $id;
		$data['nome'] = $atividade->titulo;
		$data['tipo'] = $atividade->getTipo();
		$data['responsavel'] = $atividade->responsavel;
		$data['titulo'] = $atividade->titulo;
		$data['local'] = $atividade->local;
		$data['datas'] = $atividade->getData();
		$data['descricao'] = $atividade->more('descricao');
		$desc = new Util_Markdown;
		$data['descricao_ext'] = $desc->transform($atividade->more('descricao_ext'));
		$data['shortbio'] = $atividade->more('shortbio');
		$data['inscricao_efetuada'] = Session::get('inscrito', false);
		$data['inscrito'] = is_object($user) ? $user->estaInscrito($id) : false;
		$data['documentos'] = $atividade->documentos;

		Session::delete('inscrito');

		$this->template->addAsset('js', 'bootstrap/bootstrap-popover.js');
		$this->template->title = $atividade->titulo;
		$this->template->content = View::factory('atividades/index', $data);
	}

	public function action_inscricao($id)
	{
		$atividade = Model_Atividade::find($id);
		if ( ! $atividade->id) Response::redirect(404);

		$data = array();
		$data['atividade_id'] = $id;

		$data['cad_nome'] = Session::get('login_errors.values.nome');
		$data['cad_matricula'] = Session::get('login_errors.values.matricula');
		$data['cad_email'] = Session::get('login_errors.values.email');

		/* Tratamentos de erro decorrentes do redirecionamento de a/cadastro */
		$data['error_form'] = Session::get('login_errors.form', false);
		$data['error'] = Session::get('login_errors.errors');
		Session::delete('login_errors');

		$this->template->title = 'Inscrição > '.$atividade->titulo;

		if (!Auth::member(2)) // 2 == participante
		{
			$data['atividade'] = $atividade->titulo;
			$this->template->content = View::factory('atividades/inscricao/login', $data);
		}
		else // cadastra o gaijo e redireciona
		{
			try {
				$ins = Model_Inscricao::inscreve(Auth::get_user_id(), $id);
				Session::set('inscrito', true);
			} catch (Database_Exception $e) {
				Session::set('inscrito', 'Você já está inscrito nesta atividade!');
			} catch (Exception $e) {
				Session::set('inscrito', $e->getMessage());
			}
			Response::redirect('a/'.$id);
		}
	}

	/**
	 * Realiza o cadastro ou loga o cidadão que está tentando se inscrever em uma atividade
	 * Após cadastrar ou logar, redireciona para a/:id/inscricao novamente, e esta rota deverá
	 * completar o processo se inscrição.
	 */
	public function action_cadastro()
	{
		$data = array();
		$atividade = Model_Atividade::find(Input::post('atividade'));
		if ( ! $atividade->id) Response::redirect(404);

		if ($_POST)
		{
			if (Input::post('form') == 'cadastro')
			{
				$user = Model_User::find()->where('username', Input::post('email'));
				if ($user->count())
				{
					Session::set('login_errors', array(
						'form' => 'cadastro',
						'errors' => array('email' => 'O e-mail '.Input::post('email').' já está cadastrado no sistema'),
						'values' => $_POST
					));
					Response::redirect('a/'.$atividade->id.'/inscricao');
				}
				
				$val = Validation::factory();
				$val->add_field('nome', 'Nome', 'required|max_length[255]');
				$val->add_field('matricula', 'Número de Matrícula', 'required|match_pattern[/^[0-9]{8}$/]');
				$val->add_field('email', 'Email', 'required|valid_email');
				if ($val->run($_POST))
				{
					list($user, $pass) = Model_User::novo(Input::post('email'), Input::post('nome'), 'Participante');
					$user->setProfile('cartao', Input::post('matricula'));
					$user->save();
					$email = $user->email;
					if ($pass)
					{
						$mail = new \Util_Mailer(array(
							'view' => 'admin/usuarios/novo',
							'subject' => 'Cadastro no sistema da Semana Acadêmica da UFRGS',
							'to' => Input::post('email'),
						), array(
							'nome' => Input::post('nome'),
							'email' => $user->email,
							'senha' => $pass,
						));
						$mail->send();
					}
				}
				else
				{
					Session::set('login_errors', array(
						'form' => 'cadastro',
						'errors' => $val->errors(),
						'values' => $_POST,
					));
					Response::redirect('a/'.$atividade->id.'/inscricao');
				}
			}
			elseif (Input::post('form') == 'login')
			{
				$email = Input::post('email');
				$pass = Input::post('senha');
			}
		}

		$auth = Auth::instance();
		if ( ! $auth->login($email, $pass))
		{
			Session::set('login_errors', array('form' => 'login'));
		}

		Response::redirect('a/'.$atividade->id.'/inscricao');
	}

	public function action_minhas()
	{
		$user = Model_User::instanceOfThis();
		$data = array();
		$data['inscricoes'] = $user->inscricoes;
		$data['user_id'] = $user->id;
		$this->template->title = 'Minhas Atividades';
		$this->template->content = View::factory('atividades/minhas', $data);
	}

}

/* End of file a.php */
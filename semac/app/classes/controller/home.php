<?php

class Controller_Home extends Controller_Semac {

	public function action_index()
	{
		$this->template->ogtags = array(
			'title'       => 'Semana Acadêmica da Informática',
			'description' => 'A Semana Acadêmica do Instituto de Informática da UFRGS (SEMAC 2012/2) ocorrerá de 01 a 05 de outubro',
			'image'       => Uri::base().Asset::find_file('logo-inf.gif', 'img'),
		);
		$this->template->content = View::forge('home/index', array(
			'tipos_atividade' => Model_Tipo_Atividade::find('all'),
		));
	}

	public function action_atividades($tipo, $id = null)
	{
		$data = array();

		if ($id === null)
		{
			$tipo = Model_Tipo_Atividade::find()->where('nome_canonico', $tipo)->or_where('nome_canonico', trim($tipo, 's'))->get_one();
			$this->template->title = $tipo->nome;
			$this->template->content = View::forge('home/atividades', array(
				'tipo' => $tipo,
				'atividades' => $tipo->atividades,
				'uri' => $this->request->uri,
			));
		}
		else
		{
			$atividade = Model_Atividade::find($id);
			if ( ! $atividade OR $atividade->status != 1) throw new HttpNotFoundException;
			$user = Model_User::get_from_auth();

			$data = array();
			$atividade->more->descricao_ext = Markdown::parse(utf8_encode($atividade->more->descricao_ext));

			$data['atividade'] = $atividade;
			$data['inscricao_efetuada'] = Session::get_flash('inscrito', false);
			$data['inscrito'] = is_object($user) ? $user->estaInscrito($id) : false;
			$data['vagas'] = $atividade->vagas;
			$data['vagas_disponiveis'] = $atividade->vagas_disponiveis();

			$this->template->title = $atividade->titulo;
			$this->template->ogtags = array(
				'title'       => $atividade->titulo,
				'description' => $atividade->more->descricao,
				'image'       => Uri::base().Asset::find_file('logo-inf.gif', 'img'),
			);
			$this->template->content = View::forge('atividades/index', $data);
		}
	}

	public function action_inscricao($id_tipo, $id_atividade)
	{
		$atividade = Model_Atividade::find($id_atividade);
		if ( ! $atividade OR $atividade->status != 1) throw new HttpNotFoundException;

		$data = array();
		$data['atividade_id'] = $atividade->id;

		$data['cad_nome'] = Session::get('login_errors.values.nome');
		$data['cad_matricula'] = Session::get('login_errors.values.matricula');
		$data['cad_email'] = Session::get('login_errors.values.email');

		$data['error_form'] = Session::get('login_errors.form', false);
		$data['error'] = Session::get('login_errors.errors');
		Session::delete('login_errors');

		$this->template->title = 'Inscrição > '.$atividade->titulo;

		if (Auth::member(1)) // usuário é visitante (não-logado)
		{
			$data['atividade'] = $atividade->titulo;
			$this->template->content = View::forge('atividades/inscricao/login', $data);
		}
		else // cadastra o gaijo e redireciona
		{
			try {
				$ins = Model_Inscricao::inscreve(Auth::get_user_id(), $atividade->id);
				Session::set_flash('inscrito', true);
			} catch (Database_Exception $e) {
				Session::set_flash('inscrito', 'Você já está inscrito nesta atividade!');
			} catch (Exception $e) {
				Session::set_flash('inscrito', $e->getMessage());
			}
			Response::redirect("atividades/{$id_tipo}/{$atividade->id}");
		}
	}

	/**
	 * Realiza o cadastro ou loga o cidadão que está tentando se inscrever em uma atividade
	 * Após cadastrar ou logar, redireciona de volta, e esta rota deverá completar o processo se inscrição.
	 */
	public function action_cadastro()
	{
		$data = array();
		$atividade = Model_Atividade::find(Input::post('atividade'));
		if ( ! $atividade OR $atividade->status != 1) throw new HttpNotFoundException;

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
					Response::redirect("atividades/{$atividade->tipo->nome_canonico}/{$atividade->id}/inscricao}");
				}

				$val = Validation::forge();
				$val->add_field('nome', 'Nome', 'required|max_length[255]');
				$val->add_field('matricula', 'Número de Matrícula', 'match_pattern[/^[0-9]{8}$/]');
				$val->add_field('email', 'Email', 'required|valid_email');
				if ($val->run($_POST))
				{
					list($user, $pass) = Model_User::novo(Input::post('email'), Input::post('nome'), 'Participante');
					$user->profile_fields->cartao = Input::post('matricula');
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
						'errors' => $val->error(),
						'values' => $_POST,
					));
					Response::redirect("atividades/{$atividade->tipo->nome_canonico}/{$atividade->id}/inscricao");
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

		Response::redirect('atividades/'.$atividade->tipo->nome_canonico.'/'.$atividade->id.'/inscricao');
	}

	public function action_busca()
	{
		$term = Input::post('search');

		$atividades = Model_Atividade::find()
			->where('status', 1)
			->and_where_open()
			->where('titulo', 'like', "%{$term}%")
			->or_where('more', 'like', "%{$term}%")
			->or_where('responsavel', 'like', "%{$term}%")
			->and_where_close()
			->get();

		$this->template->title = 'Busca';
		$this->template->content = View::forge('atividades/busca', array(
			'atividades' => $atividades,
			'termo'      => $term,
		));
	}

}
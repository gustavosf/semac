<?php

/*
 * Controlador de Atividades
 *
 * Administração de atividades da semana acadêmica
 * 
 * @package  app
 * @extends  Controller_Semac
 */

class Controller_Admin_Atividades extends Controller_Semac
 {

	public $template = 'template_admin';

	public function before()
	{
		parent::before();
		$this->template->menu = View::factory('admin/menu', array(
			'action' => $this->request->action
		));
	}

	/**
	 * Cadastro de Novas atividades na semana acadêmica
	 *
	 * Acessível apenas pelo Organizador Geral (ver acesso no config/simpleauth)
	 * Registra um atividade, e cadastra um chair caso necessário.
	 * Dispoara um e-mail para o chair, avisando do registro
	 */
	public function action_nova()
	{
		$data = array();

		if ($_POST)
		{
			$errors = null;
			if (Input::post('nome') == '') $errors['nome'] = "Nome inválido";
			if ( ! filter_var(Input::post('email'), FILTER_VALIDATE_EMAIL)) $errors['email'] = "Email inválido";
			$atividades = Model_Atividade::$atividades;
			if ( ! isset($atividades[Input::post('atividade')])) $errors['atividade'] = "Atividade Inválida!";

			$data['email'] = Input::post('email');
			$data['nome'] = Input::post('nome');
			$data['atividade'] = Input::post('atividade');
			$data['error'] = $errors;
			if (! $errors)
			{
				list($user, $pass) = Model_User::novo(Input::post('email'), Input::post('nome'), 'Chair');
				$data['new'] = $pass ? true : false;
				
				$atividade = new Model_Atividade;
				$atividade->chair = $user->id;
				$atividade->tipo = Input::post('atividade');
				$atividade->save();
				
				$data['pass'] = $pass;
				$mail = new \Util_Mailer(array(
					'view' => 'admin/atividades/nova',
					'subject' => 'Você foi incluído como Chair em uma atividade da Semana Acadêmica da Informática',
					'to' => Input::post('email'),
				), array(
					'nome' => Input::post('nome'),
					'email' => $user->email,
					'senha' => $pass,
				));
				$mail->send();
			}
		}
		
		$data['atividades'] = Model_Atividade::$atividades;
		$this->template->title = 'Nova Atividade';
		$this->template->content = View::factory('admin/atividades/nova', $data);
	}


	/**
	 * Listagem de atividades associadas a um chair
	 */
	public function action_listar()
	{
		$data = array();

		$atividades = Model_Atividade::find()
			->where('chair', Auth::instance()->get_user_id())
			->get();
		$data['atividades'] = $atividades;

		$this->template->title = 'Lista de Atividades';
		$this->template->content = View::factory('admin/atividades/listar', $data);
	}

	/**
	 * Edição de Atividades da SEMAC
	 */
	public function action_editar($id)
	{
		$data = array();
		$data['salvo'] = false;

		$atividade = Model_Atividade::find()
			->where(array('id' => $id, 'chair' => Auth::instance()->get_user_id()))
			->get_one();
		
		if ($_POST)
		{
			$val = Validation::factory();
			$val->add_field('titulo', 'Título', 'max_length[255]');
			$val->add_field('responsavel', 'Responsável', 'max_length[255]');
			$val->add_field('carga_horaria', 'Carga Horária', 'match_pattern[/^[0-9]{0,3}$/]');
			$val->add_field('vagas', 'Vagas', 'match_pattern[/^[0-9]{0,3}$/]');
			$val->set_message('match_pattern', 'Valor inválido!');
			$data['salvo'] = $val->run($_POST);
			
			$atividade->titulo = $val->validated('titulo');
			$atividade->responsavel = $val->validated('responsavel');
			$atividade->carga_horaria = $val->validated('carga_horaria');
			$atividade->vagas = $val->validated('vagas');
			$atividade->setMore('descricao', $val->input('descricao'));
			$atividade->setMore('shortbio', $val->input('shortbio'));
			$atividade->setMore('afiliacao', $val->input('afiliacao'));
			if ($data['salvo']) $atividade->save();

			$data['erros'] = $val->errors();
		}

		$data['atividade'] = $atividade;
		
		$this->template->title = 'Edição de Atividade';
		$this->template->content = View::factory('admin/atividades/editar', $data);
	}
}

/* End of file atividades.php */
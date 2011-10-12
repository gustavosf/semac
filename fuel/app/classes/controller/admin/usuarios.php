<?php

/**
 * Usuarios Controller.
 *
 * Ferramentas administrativas do sistema
 * 
 * @package  app
 * @extends  Controller_Semac
 */
class Controller_Admin_Usuarios extends Controller_Semac {

	public $template = 'template_admin';

	public function before()
	{
		parent::before();
		$this->template->menu = View::factory('admin/menu', array(
			'action' => $this->request->action
		));
	}

	/**
	 * Cadastro de novos usuários
	 *
	 * @access public
	 * @return void
	 */
	public function action_novo()
	{
		$data = array();
		if ($_POST)
		{
			$errors = null;
			if (Input::post('nome') == '') $errors['nome'] = "Nome inválido";
			if ( ! filter_var(Input::post('email'), FILTER_VALIDATE_EMAIL)) $errors['email'] = "Email inválido";
			$data['email'] = Input::post('email');
			$data['nome'] = Input::post('nome');
			$data['grupo'] = Input::post('grupo');
			$data['error'] = $errors;
			if (! $errors)
			{
				list($user, $pass) = Model_User::novo(Input::post('email'), Input::post('nome'), Input::post('grupo'));
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
		}
		$this->template->content = View::factory('admin/usuarios/novo', $data);
	}

	public function action_organizador_geral($id = null, $action = null)
	{
		$data = array();

		if ($id != null && $action)
		{
			$og = Model_User::find($id);
			if ($action = 'delete') $og->ungroup('Organizador Geral');
			$data['revogado'] = $og->getProfile('nome');
		}

		$organizadores = Model_User::find()->where('group' ,'&', 64)->get();
		$data['organizadores'] = $organizadores;

		$this->template->content = View::factory('admin/usuarios/organizador_geral', $data);
	}
}

/* End of file admin.php */

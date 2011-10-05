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
				$users = new Model_User;
				if ($users->novo(Input::post('email'), Input::post('nome'), Input::post('grupo')))
				{
					// enviar e-mail aqui //
				}
				else 
				{
					$data['error']['global'] = 'Já existe um usuário cadastrado com este e-mail';
				}
			}
		}
		$this->template->content = View::factory('admin/usuarios/novo', $data);
	}
}

/* End of file admin.php */

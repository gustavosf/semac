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
			if ($errors)
			{
				$data['error'] = $errors;
				$data['email'] = Input::post('email');
				$data['nome'] = Input::post('nome');
			}
		}
		$this->template->content = View::factory('admin/usuarios/novo', $data);
	}
}

/* End of file admin.php */

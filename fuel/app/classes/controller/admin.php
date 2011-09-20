<?php

/**
 * Admin Controller.
 *
 * Ferramentas administrativas do sistema
 * 
 * @package  app
 * @extends  Controller_Template
 */
class Controller_Admin extends Controller_Template {

	public function before()
	{
		parent::before();
		$this->template->interface_topbar = View::factory('interface/topbar');
	}

	/**
	 * The index action.
	 * 
	 * @access  public
	 * @return  void
	 */
	public function action_index()
	{
		$data = array();
		$this->template->content = View::factory('admin/index', $data);
	}


	/**
	 * Tela de identificação do usuário
	 * 
	 * @access  public
	 * @return  void
	 */
	public function action_login()
	{
		$data = array();

		if ($_POST)
		{
			$auth = Auth::instance();
			if ($auth->login(Input::post('username'), Input::post('password')))
			{
				Response::redirect('admin');
			}
			else
			{
				$data['username'] = Input::post('username');
				$data['error'] = 'Email/Senha incorreto! Favor confira suas credenciais e tente novamente';
			}
		}
		$this->template->content = View::factory('admin/login', $data);
	}

}

/* End of file login.php */

<?php

/**
 * Admin Controller.
 *
 * Ferramentas administrativas do sistema
 * 
 * @package  app
 * @extends  Controller_Template
 */
class Controller_Admin extends Controller_Semac {

	public $template = 'template_admin';

	public function before()
	{
		if (in_array($this->request->action, array('login', 'logout')))
		{
			// template do login/logout não deve conter menus (o padrão do admin)
			$this->template = 'template';
		}

		parent::before();

		$this->template->menu = View::factory('admin/menu', array(
			'action' => $this->request->action
		));
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
				$goto = Cookie::get('redirect', 'admin');
				Cookie::delete('redirect');
				Response::redirect($goto);
			}
			else
			{
				$data['username'] = Input::post('username');
				$data['error'] = 'Email/Senha incorreto! Favor confira suas credenciais e tente novamente';
			}
		}
		$this->template->title = 'Identificação';
		$this->template->content = View::factory('admin/login', $data);
	}

	/**
	 * Logout do usuário
	 * 
	 * @access  public
	 * @return  void
	 */
	public function action_logout()
	{
		if ( ! Auth::check()) Response::redirect('admin/login');
		Auth::instance()->logout();
		$this->template->title = 'Sair';
		$this->template->content = View::factory('admin/logout');
	}

}

/* End of file admin.php */

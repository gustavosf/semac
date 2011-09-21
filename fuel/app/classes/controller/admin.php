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

	public $template = 'template_admin';

	public function before()
	{
		if ($this->request->action == 'login')
		{
			// template do login não deve conter menus (o padrão do admin)
			$this->template = 'template';
		}

		parent::before();

		// redireciona para login caso não esteja logado.
		// redireciona para admin caso esteja logado tentando acessar ~/login :)
		if (\Auth::check())
		{
			if ($this->request->action == 'login')
			{
				Response::redirect('admin');
			}

			$auth = \Auth::instance();

			$this->template->menu = View::factory('admin/menu', array(
				'action' => $this->request->action
			));
			
			$this->template->interface_topbar = View::factory('interface/topbar', array(
				'user' => $auth->get_user_array()
			));
		}
		else
		{
			if ($this->request->action != 'login')
			{
				Response::redirect('admin/login');
			}

			$this->template->interface_topbar = View::factory('interface/topbar');
		}
		
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
		$this->template->title = 'Identificação';
		$this->template->content = View::factory('admin/login', $data);
	}

}

/* End of file admin.php */

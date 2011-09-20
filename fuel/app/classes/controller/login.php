<?php

/**
 * Login Controller.
 *
 * Controlador para a página de login de usuário.
  * 
 * @package  app
 * @extends  Controller
 */
class Controller_Login extends Controller_Template {


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

		if ($_POST)
		{
			$auth = Auth::instance();
			if ($auth->logni($_POST['username'], $_POST['password']))
			{
				Response::redirect('admin');
			}
			else
			{
				$data['username'] = $_POST['username'];
				$data['error'] = 'Email/Senha incorreto! Favor confira suas credenciais e tente novamente';
			}
		}
		$this->template->content = View::factory('login/index', $data);
	}
	
}

/* End of file login.php */

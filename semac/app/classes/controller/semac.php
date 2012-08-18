<?php

/**
 * Admin Controller.
 *
 * Ferramentas administrativas do sistema
 *
 * @package  app
 * @extends  Controller_Template
 */
class Controller_Semac extends Controller_Template {

	public function before()
	{
		parent::before();

		$action = preg_replace('/.*_(\w+)/', '\1', $this->request->controller);
		$action = strtolower($action.'.'.$this->request->action);

		if ( ! Auth::has_access($action))
		{
			if (Auth::check()) \Response::redirect('e/forbidden');
			else
			{
				Cookie::set('redirect', Uri::string());
				Response::redirect('admin/login');
			}
		}
		/*
		else
		{
			$auth = Auth::instance();
			$this->template->interface_topbar = View::forge('interface/topbar', array(
				'user' => $auth->get_screen_name()
			));
		}
		*/
	}

	public function after($response)
	{
		$response = parent::after($response);
		$data = array();
		$data['user'] = @Auth::instance()->get_screen_name();
		$this->template->interface_topbar = View::forge('interface/topbar', @$data);
		return $response;
	}

}

/* End of file semac.php */
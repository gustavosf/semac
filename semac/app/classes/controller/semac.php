<?php

/**
 * Semac Controller.
 *
 * @package  app
 * @extends  Controller_Hybrid
 */
class Controller_Semac extends Controller_Hybrid {

	public function before()
	{
		parent::before();

		$action = preg_replace('/.*_(\w+)/', '\1', $this->request->controller);
		$action = strtolower($action.'.'.$this->request->action);

		if ( ! Auth::has_access($action))
		{
			if (Auth::check()) Response::redirect('e/forbidden');
			else
			{
				Cookie::set('redirect', Uri::string());
				Response::redirect('admin/login');
			}
		}
	}

	public function after($response)
	{
		$response = parent::after($response);
		if (is_object($this->template))
		{
			$this->template->interface_topbar = View::forge('interface/topbar', array(
				'user' => @Auth::instance()->get_screen_name(),
				'tipos_atividade' => Model_Tipo_Atividade::find('all'),
			));
		}
		return $response;
	}

}
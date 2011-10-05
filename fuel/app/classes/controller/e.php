<?php

class Controller_E extends Controller_Template {

	public function before()
	{
		parent::before();
		$this->template->interface_topbar = View::factory('interface/topbar');
	}

	public function action_forbidden()
	{
		$this->template->title = 'Forbidden';
		$this->template->content = View::factory('e/forbidden');
	}

}

/* End of file e.php */
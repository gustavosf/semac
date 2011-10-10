<?php

class Controller_E extends Controller_Semac {

	public function action_forbidden()
	{
		$this->template->title = 'Forbidden';
		$this->template->content = View::factory('e/forbidden');
	}

}

/* End of file e.php */
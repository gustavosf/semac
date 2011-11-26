<?php

class Controller_Home extends Controller_Semac {

	public function action_index()
	{
		$data = array();

		$this->template->content = View::factory('home/index' ,$data);
	}

}

/* End of file e.php */
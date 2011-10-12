<?php

class Controller_Atividades extends Controller_Template {

	public function action_nova()
	{
		$this->template->title = 'Atividade &raquo; Nova';
		$this->template->content = View::factory('atividade/nova');
	}

}

/* End of file atividades.php */
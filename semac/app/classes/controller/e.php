<?php

/**
 * The Error Controller.
 *
 * Controller para gerenciamento de erros
 *
 * @package  app
 * @extends  Controller_Semac
 */

class Controller_E extends Controller_Semac {

	/**
	 * The 404 action for the application.
	 * 
	 * @access  public
	 * @return  void
	 */
	public function action_404()
	{
		$messages = array('Aw, crap!', 'Bloody Hell!', 'Uh Oh!', 'Nope, not here.', 'Huh?');
		$data['title'] = $messages[array_rand($messages)];

		// Set a HTTP 404 output header
		$this->response->status = 404;
		$this->response->body = View::factory('welcome/404', $data);
	}
	
	/**
	 * The forbidden action for the application.
	 * 
	 * @access  public
	 * @return  void
	 */
	public function action_forbidden()
	{
		$this->template->title = 'Forbidden';
		$this->template->content = View::factory('e/forbidden');
	}

}

/* End of file e.php */
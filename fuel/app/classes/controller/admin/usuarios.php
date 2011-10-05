<?php

/**
 * Usuarios Controller.
 *
 * Ferramentas administrativas do sistema
 * 
 * @package  app
 * @extends  Controller_Template
 */
class Controller_Admin_Usuarios extends Controller_Template {

	public $template = 'template_admin';

	/**
	 * Cadastro de novos usuários
	 *
	 * @access public
	 * @return void
	 */
	 public function action_novo()
	 {
	 	$this->template->content = View::factory('admin/novousuario');
	 }
}

/* End of file admin.php */

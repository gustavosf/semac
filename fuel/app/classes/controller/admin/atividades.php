<?php

/*
 * Controlador de Atividades
 *
 * Administração de atividades da semana acadêmica
 * 
 * @package  app
 * @extends  Controller_Semac
 */

class Controller_Admin_Atividades extends Controller_Semac
 {

	public $template = 'template_admin';

	public function before()
	{
		parent::before();
		$this->template->menu = View::factory('admin/menu', array(
			'action' => $this->request->action
		));
	}

	/**
	 * Cadastro de Novas atividades na semana acadêmica
	 */
	public function action_nova()
	{
		$data = array();

		$data['atividades'] = Model_Atividade::$atividades;
		$this->template->title = 'Nova Atividade';
		$this->template->content = View::factory('admin/atividades/nova', $data);
	}

}

/* End of file atividades.php */
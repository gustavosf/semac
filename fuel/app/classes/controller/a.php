<?php

class Controller_A extends Controller_Semac {

	public $template = 'template_home';

	public function action_index($id)
	{
		$data = array();

		$atividade = Model_Atividade::find($id);
		$data['nome'] = $atividade->titulo;
		$data['tipo'] = $atividade->getTipo();
		$data['responsavel'] = $atividade->responsavel;
		$data['titulo'] = $atividade->titulo;
		$data['local'] = $atividade->local;
		$data['data'] = $atividade->getDataSerial();
		$data['descricao'] = $atividade->more('descricao');
		$data['shortbio'] = $atividade->more('shortbio');

		$this->template->title = $atividade->titulo;
		$this->template->content = View::factory('atividades/index', $data);
	}

}

/* End of file a.php */
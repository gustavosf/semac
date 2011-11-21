<?php

class Model_Documento extends Orm\Model {

	/* Relacionamentos */
	protected static $_belongs_to  = array(
		'atividade' => array('key_from' => 'id_atividade'),
	);

	/* Métodos */
	public static function add($doc) {
		$doc = new Model_Documento;
		$doc->titulo = $doc['titulo'];
		$doc->descricao = $doc['descricao'];
		$doc->id_atividade = $doc['atividade'];
		$doc->arquivo = $doc['arquivo'];
		$doc->save();
		return $doc;
	}

	public function destroi() {
		@unlink(DOCROOT.DS.'doc'.DS.$this->atividade->id.DS.$this->arquivo);
		parent::delete();
	}

}
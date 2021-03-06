<?php

class Model_Documento extends Orm\Model {

	protected static $_properties = array(
		'id',
		'id_atividade',
		'arquivo',
		'titulo',
		'descricao',
		'data_upload',
	);

	protected static $_observers = array(
		'Orm\\Observer_CreatedAt' => array(
			'events' => array('before_insert'),
			'mysql_timestamp' => true,
			'property' => 'data_upload',
		),
	);

	/* Relacionamentos */
	protected static $_belongs_to  = array(
		'atividade' => array('key_from' => 'id_atividade'),
	);


	/* Métodos */
	public static function add($doc)
	{
		$doc = new Model_Documento;
		$doc->titulo = $doc['titulo'];
		$doc->descricao = $doc['descricao'];
		$doc->id_atividade = $doc['atividade'];
		$doc->arquivo = $doc['arquivo'];
		$doc->save();
		return $doc;
	}

	/**
	 * Retorna o path do documento
	 */
	public function getPath($host = false)
	{
		if ($host) return DOCROOT.'doc'.DS.$this->atividade->id.DS.$this->arquivo;
		else return '/doc/'.$this->atividade->id.'/'.$this->arquivo;
	}

	/**
	 * Destrói o documento, removendo-o do BD e do HD
	 */
	public function destroi()
	{
		@unlink($this->getPath(true));
		parent::delete();
	}

	/**
	 * Retorna o path para o ícone da extensão
	 */
	public function getIco()
	{
		$ext = pathinfo($this->arquivo, PATHINFO_EXTENSION);
		$icos = array(
			'image' => array('jpg', 'gif', 'jpeg', 'png'),
			'code'  => array('php', 'rb', 'c', 'h'),
			'pdf'   => array('pdf'),
			'powerpoint' => array('ppt', 'pptx'),
			'excel' => array('xls', 'xlsx'),
			'word' => array('doc', 'docx', 'odf'),
		);
		foreach ($icos as $img => $extensions)
		{
			if (array_search($ext, $extensions) !== false)
				return '/'.Asset::find_file('ico/ext/'.$img.'.png', 'img');
		}
		return '/'.Asset::find_file('ico/ext/file.png', 'img');
	}

	public function get_size()
	{
		$size = filesize($this->getPath(true));
		$sizes = array('Bytes', 'kB', 'MB', 'GB', 'TB', 'PB', 'EB', 'ZB', 'YB');
		if ($size == 0) return('n/a');
		return (round($size/pow(1024, ($i = floor(log($size, 1024)))), 2).' '.$sizes[$i]);
	}
}
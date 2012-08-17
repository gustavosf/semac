<?php

class View extends Fuel\Core\View {

	protected $_assets = array(
		'js'  => array(),
		'css' => array(),
	);

	public function addAsset($type, $asset)
	{
		$this->_assets[$type][] = $asset;
		$this->set('assets', $this->_assets);
	}

}



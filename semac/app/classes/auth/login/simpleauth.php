<?php

class Auth_Login_SimpleAuth extends \Auth\Auth_Login_SimpleAuth {

	public static function grupos()
	{
		$grupos = \Config::get('simpleauth.groups');
		array_walk($grupos, function(&$g){ $g = strtolower($g['name']); });
		return $grupos;
	}

	public function get_user_id()
	{
		if (empty($this->user))
		{
			return false;
		}

		return $this->user['id'];
	}

}
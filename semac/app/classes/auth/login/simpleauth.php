<?php

class Auth_Login_SimpleAuth extends \Auth\Auth_Login_SimpleAuth {

	public static function grupos()
	{
		$grupos = \Config::get('simpleauth.groups');
		array_walk($grupos, function(&$g){ $g = strtolower($g['name']); });
		return $grupos;
	}

	public function get_groups()
	{
		if (empty($this->user)) return false;
		$groups = \Config::get('simpleauth.groups');

		foreach ($groups as $k => $group)
		{
			if ($k & $this->user['group'])
			{
				$groups[$k] = array('SimpleGroup', $k);
			}
			else
			{
				unset($groups[$k]);
			}
		}

		if (empty($groups)) $groups = array(array('SimpleGroup', 1));
		return $groups;
	}

	public function get_user_id()
	{
		if (empty($this->user))
		{
			return false;
		}

		return $this->user['id'];
	}

	public function get_group_id($name)
	{
		$groups = Config::get('simpleauth.groups');
		foreach ($groups as $id => $group)
		{
			if ($group['name'] == $name)
				return $id;
		}
		return null;
	}

}
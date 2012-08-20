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

		/* Retorna como visitante por padrão */
		if (empty($groups)) $groups = array(array('SimpleGroup', 1));

		return $groups;
	}

	/**
	 * Extension of base driver method to default to user group instead of user id
	 */
	public function has_access($condition, $driver = null, $user = null)
	{
		$groups = $this->get_groups();
		foreach ($groups as $group) if (parent::has_access($condition, $driver, $group))
		{
			return true;
		}
		return false;
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
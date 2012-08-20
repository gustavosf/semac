<?php

class Auth_Group_SimpleGroup extends \Auth\Auth_Group_SimpleGroup {

	public function get_roles($group = null)
	{
		// When group is empty, attempt to get groups from a current login
		if ($group === null)
		{
			if ( ! $login = \Auth::instance()
				or ! is_array($groups = $login->get_groups())
				or ! isset($groups[0][1]))
			{
				return array();
			}
			$group = $groups[0][1];
		}

		// alteração simples para permitir múltiplos grupos
		// o "id" passa a ser um número binário, ou várias flags
		// que ditam quais os grupos que o usuário pertence
		$groups = \Config::get('simpleauth.groups');
		$group = (int)$group;
		$roles = array();
		foreach ($groups as $id => $data) if ($group & $id)
		{
			$roles = array_merge($roles, $data['roles']);
		}

		return $roles;
	}

	/* Sobrescrita simples da função group. A original está com erro */
	public function member($group, $user = null)
	{
		if ($user === null)
		{
			$groups = \Auth::instance()->get_groups();
		}
		else
		{
			$groups = \Auth::instance()->get_groups();
		}

		if ( ! $groups || ! in_array((int) $group, static::$_valid_groups))
		{
			return false;
		}

		return in_array(array($this->id, $group), $groups);
	}

}
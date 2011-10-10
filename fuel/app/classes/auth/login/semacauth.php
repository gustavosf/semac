<?php

class Auth_Login_SemacAuth extends \Auth\Auth_Login_SimpleAuth {

	protected $config = array(
		'drivers' => array('group' => array('SemacGroup')),
		'additional_fields' => array('profile_fields'),
	);

	public function get_groups()
	{
		if (empty($this->user))
		{
			return false;
		}

		return array(array('SemacGroup', $this->user['group']));
	}

	public function before()
	{
		parent::before();
	}

}
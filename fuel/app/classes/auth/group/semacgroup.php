<?php

class Auth_Group_SemacGroup extends \Auth\Auth_Group_SimpleGroup {
	
	protected $config = array(
		'drivers' => array('acl' => array('SemacAcl'))
	);

}
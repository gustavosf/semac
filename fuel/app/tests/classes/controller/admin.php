<?php

/**
 * Admin class tests
 * 
 * @group App
 * @group Admin
 */
class Tests_Admin extends \PHPUnit_Extensions_SeleniumTestCase {

	protected function setUp()
	{
		$this->setBrowser('*firefox');
		$this->setBrowserUrl('http://semac/');
	}

	public function testLoginRedirection()
	{
		$this->deleteAllVisibleCookies();
		$this->open('http://semac/admin');
		$this->assertTitle('Identificação*');
	}
	
	public function testLoginFields()
	{
		$this->open('http://semac/admin/login');
		$this->assertElementPresent('css=form input[type=text][name=username]');
		$this->assertElementPresent('css=form input[type=password][name=password]');
		$this->assertElementPresent('css=form input[type=submit]');
	}
	
	public function testLoginWithInvalidCredentials()
	{
		$this->open('http://semac/admin/login');
		$this->type('css=form input[type=text][name=username]', 'invalid@email.com');
		$this->type('css=form input[type=password][name=password]', 'invalidPassword');
		$this->click('css=form input[type=submit]');

		$this->waitForPageToLoad(3000);
		$this->assertTitle('*Identificação*');
		$this->assertTextPresent('*Email/Senha incorreto!*');
	}

	public function testLoginWithValidCredentials()
	{
		// deve-se criar um usuário para este teste
		// email: valid@credential.com
		// senha: validPassword
		$this->open('http://semac/admin/login');
		$this->type('css=form input[type=text][name=username]', 'valid@credential.com');
		$this->type('css=form input[type=password][name=password]', 'validPassword');
		$this->click('css=form input[type=submit]');

		$this->waitForPageToLoad(3000);
		$this->assertNotTitle('*Identificação*');
	}

	// Logout -----------------------------------------------------

	public function testLogoutWithLoggedUser() {
		// o usuário está logado, levando em conta que o teste anterior funciona
		$this->open('http://semac/admin/logout');
		$this->assertTitle('Sair');
		$this->assertElementNotPresent('css=a[href$="/logout"]');
		$this->waitForPageToLoad(5000); // 5 segundos
		$this->assertLocation('semac/');
	}

	public function testLogoutWithUnloggedUser() {
		$this->open('http://semac/admin/logout');
		$this->assertTitle('*Identificação*');
	}

}
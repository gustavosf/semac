<?php

/**
 * Testes para a area de gerenciamento de atividades
 * 
 * @group App
 * @group Admin
 * @group Usuarios
 */
class Tests_Admin_Usuarios extends \PHPUnit_Extensions_SeleniumTestCase {

	protected function setUp()
	{
		$this->setBrowser('*firefox');
		$this->setBrowserUrl('http://semac');

	}

	public function testAccessRights() {
		// Deve-se ter cadastrado no banco de dados usuários com o e-mail
		// comex@test.mail e senha 12345 para testar o sistema

		$this->deleteAllVisibleCookies(); // logout forçado
		$this->open('http://semac/admin/usuarios/novo');
		$this->assertTitle('Identificação |*');

		$this->type('css=form input[type=text][name=username]', 'comex@test.mail');
		$this->type('css=form input[type=password][name=password]', '12345');
		$this->click('css=form input[type=submit]');

		$this->waitForPageToLoad(3000);
		$this->assertTitle('Novo Usuário |*');
	}
	
	public function testFields()
	{
		$this->open('http://semac/admin/usuarios/novo');
		$this->assertElementPresent('css=form input[type=text][name=nome]');
		$this->assertElementPresent('css=form input[type=text][name=email]');
		$this->assertElementPresent('css=form select[name=grupo]');
		$this->assertElementPresent('css=form input[type=submit]');
	}

	public function testNewUserWithWrongFields()
	{
		$this->open('http://semac/admin/usuarios/novo');
		
		$this->type('css=form input[type=text][name=nome]', '');
		$this->type('css=form input[type=text][name=email]', 'wrong@');
		$this->click('css=form input[type=submit]');

		$this->waitForPageToLoad(3000);
		$this->assertTextPresent('*Nome inválido*');
		$this->assertTextPresent('*Email inválido*');

		$this->type('css=form input[type=text][name=nome]', 'TestUser');
		$this->type('css=form input[type=text][name=email]', '123@test');
		$this->click('css=form input[type=submit]');

		$this->waitForPageToLoad(3000);
		$this->assertTextPresent('*Email inválido*');

		// Name should be mantained 'TestUser'
		$this->type('css=form input[type=text][name=email]', '123@test');
		$this->click('css=form input[type=submit]');

		$this->waitForPageToLoad(3000);
		$this->assertTextNotPresent('*Nome inválido*');
		$this->assertTextPresent('*Email inválido*');
	}
	
	public function testRegisterOfNewUser()
	{
		$this->open('http://semac/admin/usuarios/novo');
		
		$this->uniqid = uniqid();
		$this->type('css=form input[type=text][name=nome]', 'TestUser');
		$this->type('css=form input[type=text][name=email]', $this->uniqid.'@dev.semac.info');
		$this->select('css=form select[name=grupo]', 'index=2');
		$this->click('css=form input[type=submit]');

		$this->waitForPageToLoad(3000);
		$this->assertTextPresent('*TestUser*foi cadastrado*');
		$this->assertTextPresent('*e-mail foi enviado para o endereço*'.$this->uniqid.'@dev.semac.info*');
	}

	public function testRegisterOfOldUser()
	{
		$this->open('http://semac/admin/usuarios/novo');
		
		// em admin/atividades/nova
		$this->uniqid = uniqid();
		$this->type('css=form input[type=text][name=nome]', 'TestUser');
		$this->type('css=form input[type=text][name=email]', $this->uniqid.'@dev.semac.info');
		$this->select('css=form select[name=grupo]', 'index=3');
		$this->click('css=form input[type=submit]');

		$this->waitForPageToLoad(3000);
		$this->assertTextPresent('*TestUser*foi cadastrado*');
		$this->assertTextPresent('*e-mail foi enviado para o endereço*'.$this->uniqid.'@dev.semac.info*');
	}

	/**
	 * Testes da funcionalidade de gerência de organizadores gerais
	 * para visualização e revogação de acesso
	 */

	public function testOgListPreview()
	{
		$this->open('http://semac/admin/usuarios/organizador_geral');
		
		// verifica usuário recém adicionado acima
		$this->assertTextPresent('TestUser');
		$this->assertTextPresent($this->uniqid.'@dev.semac.info');
	}

	public function testOgListRevokeUserRights()
	{
		$this->open('http://semac/admin/usuarios/organizador_geral');
		$this->click('css=td:contains("TestUser") + td + td > a');

		$this->waitForPageToLoad(3000);
		$this->assertTextPresent('*revogado*TestUser*');
		$this->assertTextNotPresent('<td>TestUser<\/td>');
		$this->assertTextNotPresent($this->uniqid.'@dev.semac.info');	
	}

}
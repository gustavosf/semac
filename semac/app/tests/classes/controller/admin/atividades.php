<?php

/**
 * Testes para a area de gerenciamento de atividades
 * 
 * @group App
 * @group Admin
 * @group Atividades
 */
class Tests_Admin_Atividades extends \PHPUnit_Extensions_SeleniumTestCase {

	protected function setUp()
	{
		$this->setBrowser('*firefox');
		$this->setBrowserUrl('http://semac');

	}

	public function testAccessRights() {
		// Deve-se ter cadastrado no banco de dados usuários com o e-mail
		// og@test.mail e senha 12345 para testar o sistema

		$this->deleteAllVisibleCookies(); // logout forçado
		$this->open('http://semac/admin/atividades/nova');
		$this->assertTitle('Identificação |*');

		$this->type('css=form input[type=text][name=username]', 'og@test.mail');
		$this->type('css=form input[type=password][name=password]', '12345');
		$this->click('css=form input[type=submit]');

		$this->waitForPageToLoad(3000);
		$this->assertTitle('Nova Atividade |*');
	}
	
	public function testFields()
	{
		$this->open('http://semac/admin/atividades/nova');
		$this->assertElementPresent('css=form input[type=text][name=nome]');
		$this->assertElementPresent('css=form input[type=text][name=email]');
		$this->assertElementPresent('css=form select[name=atividade]');
		$this->assertElementPresent('css=form input[type=submit]');
	}

	public function testNewActivityWithWrongFields()
	{
		$this->open('http://semac/admin/atividades/nova');
		
		$this->type('css=form input[type=text][name=nome]', '');
		$this->type('css=form input[type=text][name=email]', 'wrong@');
		$this->select('css=form select[name=atividade]', 'index=2');
		$this->click('css=form input[type=submit]');

		$this->waitForPageToLoad(3000);
		$this->assertTextPresent('*Nome inválido*');
		$this->assertTextPresent('*Email inválido*');

		$this->type('css=form input[type=text][name=nome]', 'TestChair');
		$this->type('css=form input[type=text][name=email]', '123@test');
		$this->click('css=form input[type=submit]');

		$this->waitForPageToLoad(3000);
		$this->assertTextPresent('*Email inválido*');

		// Name should be mantained 'TestChair'
		$this->type('css=form input[type=text][name=email]', '123@test');
		$this->click('css=form input[type=submit]');

		$this->waitForPageToLoad(3000);
		$this->assertTextNotPresent('*Nome inválido*');
		$this->assertTextPresent('*Email inválido*');
	}
	
	public function testNewActivityWithNewChair()
	{
		$this->open('http://semac/admin/atividades/nova');
		
		// em admin/atividades/nova
		$this->uniqid = uniqid();
		$this->type('css=form input[type=text][name=nome]', 'TestChair');
		$this->type('css=form input[type=text][name=email]', $this->uniqid.'@dev.semac.info');
		$this->select('css=form select[name=atividade]', 'index=2');
		$this->click('css=form input[type=submit]');

		$this->waitForPageToLoad(3000);
		$this->assertTextPresent('*TestChair*foi cadastrado*');
		$this->assertTextPresent('*e-mail foi enviado para o endereço*'.$this->uniqid.'@dev.semac.info*');
	}

	public function testNewActivityWithOldChair()
	{
		$this->open('http://semac/admin/atividades/nova');
		
		// em admin/atividades/nova
		$this->uniqid = uniqid();
		$this->type('css=form input[type=text][name=nome]', 'TestChair');
		$this->type('css=form input[type=text][name=email]', $this->uniqid.'@dev.semac.info');
		$this->select('css=form select[name=atividade]', 'index=2');
		$this->click('css=form input[type=submit]');

		$this->waitForPageToLoad(3000);
		$this->assertTextPresent('*TestChair*foi cadastrado*');
		$this->assertTextPresent('*e-mail foi enviado para o endereço*'.$this->uniqid.'@dev.semac.info*');
	}

}
<?php

/**
 * Testes para a extensão da classe Validation
 * 
 * @group App
 * @group Validation
 */
class Tests_Validation extends TestCase {

	protected function setUp() {
		$this->val = Validation::instance();
	}

	public function testDates() {
		// casos onde deve retornar válido
		$this->assertEquals($this->val->_validation_valid_date('07/12/1986'), 1);
		$this->assertEquals($this->val->_validation_valid_date('31/12/1986'), 1);
		$this->assertEquals($this->val->_validation_valid_date('29/02/2006'), 1);
		$this->assertEquals($this->val->_validation_valid_date('15/02/2015'), 1);

		// casos onde deve retornar inválido
		$this->assertEquals($this->val->_validation_valid_date('7/12/1986'), 0);
		$this->assertEquals($this->val->_validation_valid_date('7/7/86'), 0);
		$this->assertEquals($this->val->_validation_valid_date('/07/1986'), 0);
		$this->assertEquals($this->val->_validation_valid_date('07//1986'), 0);
		$this->assertEquals($this->val->_validation_valid_date('07/12'), 0);
		$this->assertEquals($this->val->_validation_valid_date(''), 0);
		$this->assertEquals($this->val->_validation_valid_date('//'), 0);
		$this->assertEquals($this->val->_validation_valid_date('07/12/000'), 0);
		$this->assertEquals($this->val->_validation_valid_date('07/15/1986'), 0);
		$this->assertEquals($this->val->_validation_valid_date('30/02/1986'), 0);
		$this->assertEquals($this->val->_validation_valid_date('31/02/1986'), 0);
		$this->assertEquals($this->val->_validation_valid_date('31/11/1986'), 0);
		$this->assertEquals($this->val->_validation_valid_date('32/05/1986'), 0);
		$this->assertEquals($this->val->_validation_valid_date('07/15/1986'), 0);
	}
	
	public function testTimes() {
		$this->assertEquals($this->val->_validation_valid_time('00h00'), 1);
		$this->assertEquals($this->val->_validation_valid_time('00:00'), 1);
		$this->assertEquals($this->val->_validation_valid_time('00h59'), 1);
		$this->assertEquals($this->val->_validation_valid_time('23h59'), 1);
		$this->assertEquals($this->val->_validation_valid_time('23:59'), 1);

		$this->assertEquals($this->val->_validation_valid_time('0h0'), 0);
		$this->assertEquals($this->val->_validation_valid_time('0h00'), 0);
		$this->assertEquals($this->val->_validation_valid_time('00h0'), 0);
		$this->assertEquals($this->val->_validation_valid_time('0:0'), 0);
		$this->assertEquals($this->val->_validation_valid_time('0:00'), 0);
		$this->assertEquals($this->val->_validation_valid_time('00:0'), 0);
		$this->assertEquals($this->val->_validation_valid_time('a:00'), 0);
		$this->assertEquals($this->val->_validation_valid_time('ah00'), 0);
		$this->assertEquals($this->val->_validation_valid_time('00:h00'), 0);
		$this->assertEquals($this->val->_validation_valid_time('24:00'), 0);
		$this->assertEquals($this->val->_validation_valid_time('15:60'), 0);
	}
	
	public function testDateArray() {
		$this->assertEquals($this->val->_validation_date_array(array('07/12/1986', '31/12/1986')), 1);
		$this->assertEquals($this->val->_validation_date_array(array('7/12/1986', '7/7/86')), 0);
	}
	
	public function testTimeArray() {
		$this->assertEquals($this->val->_validation_time_array(array('00h00', '00:00')), 1);
		$this->assertEquals($this->val->_validation_time_array(array('00h00', '00h60')), 0);
		$this->assertEquals($this->val->_validation_time_array(array('00h60', '00h00')), 0);
		$this->assertEquals($this->val->_validation_time_array(array('00h60', '00h60')), 0);
	}
	
}
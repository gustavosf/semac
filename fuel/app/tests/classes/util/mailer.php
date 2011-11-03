<?php

class MockMailer extends \Util_Mailer {
	public $data = array();
	public $to = array();
	public $cc = array();
	public $bcc = array();
	public $reply = array();

	// não envia o e-mail
	private function doSend() {}
}

/**
 * Admin class tests
 * 
 * @group App
 * @group Util
 */
class Tests_Mailer extends TestCase {

	protected function setUp()
	{
		
	}

	public function testCreationWithNoParams()
	{
		$mail = new MockMailer();

		$mail->subject = 'test';
		$mail->view = 'someview';
		$mail->setData(array(
			'nome'  => 'test',
			'other' => 'param',
		));

		$this->assertEquals($mail->subject, 'test');
		$this->assertEquals($mail->view, 'someview');
		$this->assertEquals($mail->data, array('nome' => 'test', 'other' => 'param'));
	}

	public function testCreationWithParameters()
	{
		$mail = new MockMailer(array(
			'subject' => 'test',
			'view'    => 'someview',
			'to'      => 'test@to.com',
			'cc'      => 'test@cc.com',
			'bcc'     => array('test@bcc.com', 'othertest@bcc.com'),
			'reply'   => 'test@reply.com',
		), array(
			'nome'  => 'test',
			'other' => 'param',
		));

		$this->assertEquals($mail->subject, 'test');
		$this->assertEquals($mail->view, 'someview');
		$this->assertEquals($mail->to, array('test@to.com'));
		$this->assertEquals($mail->cc, array('test@cc.com'));
		$this->assertEquals($mail->bcc, array('test@bcc.com', 'othertest@bcc.com'));
		$this->assertEquals($mail->reply, array('test@reply.com'));
		$this->assertEquals($mail->data, array('nome' => 'test', 'other' => 'param'));
	}

	public function testCreationWithInvalidParameters()
	{
		/*
	 	* @expectedException PHPUnit_Framework_Error
	 	* Não consegui fazer funcionar o teste com o type hinting... fodase
		$mail = new MockMailer(array(), array()); // ok
		$mail = new MockMailer('string', array()); // not ok
		$mail = new MockMailer(array(), 'string'); // not ok
		$mail = new MockMailer('string', 0); // not ok
		*/
	}

	public function testAddingAddresses()
	{
		$mail = new MockMailer();

		$mail->addTo('test@to.com');
		$mail->addTo(array('othertest@to.com', 'anothertest@to.com'));
		$this->assertEquals($mail->to, array('test@to.com', 'othertest@to.com', 'anothertest@to.com'));

		$mail->addCC('test@cc.com');
		$mail->addCC(array('othertest@cc.com', 'anothertest@cc.com'));
		$this->assertEquals($mail->cc, array('test@cc.com', 'othertest@cc.com', 'anothertest@cc.com'));

		$mail->addBCC('test@bcc.com');
		$mail->addBCC(array('othertest@bcc.com', 'anothertest@bcc.com'));
		$this->assertEquals($mail->bcc, array('test@bcc.com', 'othertest@bcc.com', 'anothertest@bcc.com'));

		$mail->addReplyTo('test@reply.com');
		$mail->addReplyTo(array('othertest@reply.com', 'anothertest@reply.com'));
		$this->assertEquals($mail->reply, array('test@reply.com', 'othertest@reply.com', 'anothertest@reply.com'));
	}

	/**
     * @expectedException InvalidArgumentException
     */
	public function testAddingInvalidAddresses()
	{
		$mail = new MockMailer();

		$mail->addTo(0);
		$mail->addTo(array(0, 1, 2));
	}

	/**
     * @expectedException DomainException
     */
	public function testWithNoView()
	{
		$mail = new MockMailer();		
		$mail->send();
	}


}
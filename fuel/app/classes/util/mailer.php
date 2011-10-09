<?php

class Util_Mailer {

	private $mail;
	private $data;

	public $subject;
	public $view;

	public function __construct($options = array(), $data) {
		$config = Config::load('mailer');

		$mail = new Util_Phpmailer_Main(true);
		$mail->IsSMTP();
		$mail->SMTPAuth   = true;
		$mail->SMTPSecure = $config['smtp']['secure'];
		$mail->Host       = $config['smtp']['host'];
		$mail->Port       = $config['smtp']['port'];
		$mail->Username   = $config['smtp']['credentials']['user'];
		$mail->Password   = $config['smtp']['credentials']['pass'];
		$mail->CharSet    = $config['charset'];
		$mail->From       = $config['from']['email'];
		$mail->FromName   = $config['from']['name'];
		$this->mail       = $mail;
		$this->data       = $data;
		
		isset($options['to'])      and $this->addAddress($options['to']);
		isset($options['cc'])      and $this->addCC($options['cc']);
		isset($options['bcc'])     and $this->addBCC($options['bcc']);
		isset($options['reply'])   and $this->addReplyTo($options['reply']);
		isset($options['subject']) and $this->subject = $options['subject'];
		isset($options['view'])    and $this->view = $options['view'];
	}

	public function addAddress($to)
	{
		$this->addAnAddress('Address', $to);
	}

	public function addCC($cc)
	{
		$this->addAnAddress('CC', $cc);
	}
	
	public function addBCC($bcc)
	{
		$this->addAnAddress('BCC', $bcc);
	}
	
	public function addReplyTo($to)
	{
		$this->addAnAddress('ReplyTo', $to);
	}

	private function addAnAddress($type, $addr)
	{
		$type = 'add'.$type;
		if (is_array($addr)) foreach ($addr as $add)
			$this->mail->$type($add);
		else
			$this->mail->$type($addr);
	}

	public function send() {
		$view          = View::factory('mailer/'.$this->view, $this->data);
		$this->mail->Subject = $this->subject;
		$this->mail->MsgHTML($view);
		$this->mail->Send();
	}

}
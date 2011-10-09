<?php

/**
 * Util_Mailer - Proxy PHP para o PHPMailer
 * NOTA: Requer o PHPMailer :)
 *
 * Uso:
 * $mailer = new Util_Mailer(array(
 *     'subject' => 'titulo do email',
 *     'view'    => 'alguma_view',
 *     'to'      => 'some@address.here',
 *     'cc'      => array('some@email.com', 'other@email.com'),
 * ));
 * $mailer->send();
 *
 * Uso Alternativo:
 * $mailer = new Util_Mailer();
 * $mailer->subject = 'titulo do email';
 * $mailer->view    = 'alguma_view';
 * $mailer->addAddress('some@address.here');
 * $mailer->addCC('some@email.com');
 * $mailer->addCC('other@email.com');
 *
 * @package app
 * @author Gustavo Seganfredo
 */

class Util_Mailer {

	
	/**
	 * Variável que armazena o objeto phpmailer
	 * @access private
	 * @var string
	 */
	private $mail;

	/**
	 * Variável que armazena os dados a serem passados a view
	 * @access private
	 * @var array
	 */
	private $data;

	/**
	 * Subject do email
	 * @access public
	 * @var string
	 */
	public $subject;

	/**
	 * View a ser utilizada para a geração do email
	 * @access public
	 * @var string
	 */
	public $view;

	/**
	 * Constructor
	 *
	 * Cria o objeto phpmailer, preenche ele com as configurações de SMTP
	 * Recebe um array opcional com configurações.
	 *
	 * @param array $options Opções de configuração
	 * @param array $data    Dados a serem colocados na view
	 * @return void
	 */
	public function __construct($options = array(), $data = array()) {
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

	/**
	 * Adiciona um endereço destinatário
	 *
	 * @param string $to
	 */
	public function addAddress($to)
	{
		$this->addAnAddress('Address', $to);
	}

	/**
	 * Adiciona um endereço destinatário, como CC
	 *
	 * @param string $cc
	 */
	public function addCC($cc)
	{
		$this->addAnAddress('CC', $cc);
	}
	
	/**
	 * Adiciona um endereço destinatário, como BCC
	 *
	 * @param string $bcc
	 */
	public function addBCC($bcc)
	{
		$this->addAnAddress('BCC', $bcc);
	}
	
	/**
	 * Adiciona um endereço para a resposta
	 *
	 * @param string $to
	 */
	public function addReplyTo($to)
	{
		$this->addAnAddress('ReplyTo', $to);
	}

	/**
	 * Executa a inserção do endereço no objeto phpmailer
	 *
	 * @param string $type tipo (Address, CC, BCC, ReplyTo)
	 * @param string $addr endereço de email
	 */
	private function addAnAddress($type, $addr)
	{
		$type = 'add'.$type;
		if (is_array($addr)) foreach ($addr as $add)
			$this->mail->$type($add);
		else
			$this->mail->$type($addr);
	}

	/**
	 * Envia a mensagem previamente configurada
	 *
	 * @return boolean
	 */
	public function send() {
		if ( ! $this->view)	throw new \DomainException('Nenhuma view para o email foi informada.');
		$view = View::factory('mailer/'.$this->view, $this->data);
		$this->mail->Subject = $this->subject;
		$this->mail->MsgHTML($view);
		return $this->mail->Send();
	}

}
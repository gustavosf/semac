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
 * $mailer->addTo('some@address.here');
 * $mailer->addCC('some@email.com');
 * $mailer->addCC('other@email.com');
 *
 * @package app
 * @author Gustavo Seganfredo
 */

class Util_Mailer {

	
	/**
	 * Variável que armazena o objeto phpmailer
	 * @access protected
	 * @var string
	 */
	protected $mail;

	/**
	 * Variável que armazena os dados a serem passados a view
	 * @access protected
	 * @var array
	 */
	protected $data;

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
	 * Define se o e-mail enviado deve ser html ou text/plain (padrão)
	 * @access public
	 * @var boolean
	 */
	 public $html = false;

	/**
	 * Variáveis para armazenar os destinatários e replys
	 * @access protected
	 * @var array
	 */
	protected $to = array();
	protected $cc = array();
	protected $bcc = array();
	protected $reply = array();



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
	public function __construct(Array $options = array(), Array $data = array()) {
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
		$this->setData($data);
		
		isset($options['to'])        and $this->addTo($options['to']);
		isset($options['cc'])        and $this->addCC($options['cc']);
		isset($options['bcc'])       and $this->addBCC($options['bcc']);
		isset($options['reply'])     and $this->addReplyTo($options['reply']);
		isset($options['subject'])   and $this->subject = $options['subject'];
		isset($options['view'])      and $this->view = $options['view'];
		isset($options['html'])      and $this->html = $options['view'] == true;
	}

	/**
	 * Adiciona um endereço destinatário
	 *
	 * @param mixed $to
	 */
	public function addTo($to)
	{
		$this->addAnAddress('to', $to);
	}

	/**
	 * Adiciona um endereço destinatário, como CC
	 *
	 * @param mixed $cc
	 */
	public function addCC($cc)
	{
		$this->addAnAddress('cc', $cc);
	}
	
	/**
	 * Adiciona um endereço destinatário, como BCC
	 *
	 * @param mixed $bcc
	 */
	public function addBCC($bcc)
	{
		$this->addAnAddress('bcc', $bcc);
	}
	
	/**
	 * Adiciona um endereço para a resposta
	 *
	 * @param mixed $to
	 */
	public function addReplyTo($to)
	{
		$this->addAnAddress('reply', $to);
	}

	/**
	 * Executa a inserção do endereço no objeto phpmailer
	 *
	 * @param string $type tipo (Address, CC, BCC, ReplyTo)
	 * @param mixed  $addr endereço de email
	 * @throws InvalidArgumentException
	 */
	private function addAnAddress($type, $addr)
	{
		if (is_array($addr)) $this->$type = array_merge($this->$type, $addr);
		elseif (is_string($addr)) array_push($this->$type, $addr);
		else throw new \InvalidArgumentException('Parâmetro "addr" deve ser uma string ou um array');
	}

	/**
	 * Setter para os dados que serão utilizados na view
	 *
	 * @param array $data
	 */
	public function setData(Array $data) {
		$this->data = $data;
	}

	/**
	 * Prepara o envio da mensagem e chama doSend para enviar
	 *
	 * @return boolean
	 * @throws DomainException
	 */
	public function send() {
		if ( ! $this->view)	throw new \DomainException('Nenhuma view para o email foi informada.');
		$view = View::factory('mailer/'.$this->view, $this->data);
		$this->mail->Subject = $this->subject;
		if ($this->html) $this->mail->MsgHTML($view);
		else $this->mail->Body = '<pre>'.$view.'</pre>';
		foreach ($this->to as $to)       $this->mail->addAddress($to);
		foreach ($this->cc as $cc)       $this->mail->addCC($cc);
		foreach ($this->bcc as $bcc)     $this->mail->addBCC($bcc);
		foreach ($this->reply as $reply) $this->mail->addReplyTo($reply);
		return $this->doSend();
	}

	/**
	 * Envia a mensagem previamente configurada
	 * Foi usado assim para poder abstrair um teste para o send sem o envio real
	 *
	 * @return boolean
	 */
	private function doSend() {
		return $this->mail->Send();
	}

}
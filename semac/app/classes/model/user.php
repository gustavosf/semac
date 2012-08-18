<?php

class Model_User extends Orm\Model {

	protected static $_properties = array(
		'id',
		'username',
		'password',
		'group',
		'email',
		'last_login',
		'login_hash',
		'profile_fields' => array(
			'data_type' => 'serialize',
		),
		'created_at',
	);

	/* Observer para desempacotar o profile_fields */
	protected static $_observers = array(
		'Orm\\Observer_Typing' => array('before_save', 'after_save', 'after_load')
	);


	/* Relacionamentos */
	protected static $_has_many = array(
		'inscricoes' => array(
			'model_to' => 'Model_Inscricao',
			'key_to' => 'id_user',
		),
		'atividades' => array(
			'key_to' => 'chair',
		),
		'chamadas' => array(
			'key_to' => 'id_user',
		),
	);

	/* Métodos */
	/**
	 * Gera uma instância da classe user para o usuário atualmente logado,
	 * ou para o usuário com o id repassado
	 *
	 * @var $id int
	 * @return Model_User
	 */
	public static function instanceOfThis($id = null)
	{
		static $instance;
		if ( ! is_object($instance))
		{
			if ( ! $id) $id = Auth::get_user_id();
			$instance = Model_User::find($id);
		}
		return $instance;
	}

	/**
	 * Função simples para dizer se um usuário está inscrito em uma atividade
	 *
	 * @var $atividade int id da atividade
	 * @return bool
	 */
	public function estaInscrito($atividade)
	{
		foreach ($this->inscricoes as $inscricao)
		{
			if ($inscricao->id_atividade == $atividade)
				return $inscricao->status;
		}
		return false;
	}

	/**
	 * Remove o acesso de um determinado usuario a um grupo
	 *
	 * O nome do grupo deve ser passado como string
	 * Ex: "Organizador Geral"
	 *
	 * @var $grupo string
	 */
	public function ungroup($grupo)
	{
		$grupos = Auth::grupos();
		$gid = array_search(strtolower($grupo), $grupos);
		if ($this->group & $gid)
		{
			$this->group = $this->group - $gid;
			$this->save();
		}
	}

	/**
	 * Cadastro de novos usuários no sistema
	 *
	 * Verifica se o usuário já existe, e neste caso simplesmente atualiza
	 * o grupo ao qual ele pertence.
	 *
	 * @param $email string
	 * @param $nome  string
	 * @param $grupo integer conforme definido nas configurações
	 * @return array retorna o objeto user e o password, caso tenha sido criado um usuário
	 **/
	public static function novo($email, $nome, $grupo)
	{

		// validação e obtenção do ID do grupo
		$grupos = Auth::grupos();
		$gid = array_search(strtolower($grupo), $grupos);
		if ($grupo === false)
		{
			throw new \DomainException('Grupo "'.$grupo.'" não existe');
		}

		// Caso o usuário exista, atualiza o grupo, caso contrário cria
		$user = Model_User::find()->where('email', $email)->get_one();
		$isnew = ! $user;

		if ($user)
		{
			$user->group = $user->group | $gid;
			$user->save();
		}
		else
		{
			$user = new Model_User;
			$user->email = $user->username = $email;
			$user->group = $gid;
			$user->last_login = '';
			$user->login_hash = '';
			$user->profile_fields['nome'] = $nome;
			$pass = $user->resetar_senha(); // já efetua o salvamento do registro
		}

		return array($user, @$pass);
	}

	/**
	 * Reset da senha do usuário
	 *
	 * Cria uma nova senha randômica (ou seta uma senha) na conta do usuário
	 *
	 * @param $senha string
	 * @return string nova senha
	 **/
	public function resetar_senha($nova_senha = null)
	{
		$pass = $nova_senha OR $pass = substr(str_shuffle('abcdefghijklmnopqrstuvxyzABCDEFGHIJKLMNOPQRSTUVXYZ0123456789'),0,6);
		$this->password = Auth::instance()->hash_password($pass);
		$this->save();
		return $pass;
	}

}
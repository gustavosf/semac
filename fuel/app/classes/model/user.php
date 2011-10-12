<?php

class Model_User extends Orm\Model {
	
	/**
	 * Provém acesso de leitura a variável guardada no profile_fields
	 *
	 * @var $property string
	 * @return mixed
	 */
	public function getProfile($property)
	{
		$profile = unserialize(html_entity_decode($this->profile_fields));
		if (isset($profile[$property]))
		{
			return $profile['nome'];
		}
		else
		{
			throw new \OutOfBoundsException('Property "'.$property.'" not found in profile.');
		}
	}

	/**
	 * Provém acesso de escrita a variável guardada no profile_fields
	 *
	 * @var $property string
	 * @var $value string
	 */
	public function setProfile($property, $value)
	{
		$profile = unserialize(html_entity_decode($this->profile_fields));
		$profile[$property] = $value;
		$this->profile_fields = serialize($profile);
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
			$pass = substr(str_shuffle('abcdefghijklmnopqrstuvxyzABCDEFGHIJKLMNOPQRSTUVXYZ0123456789'),0,10);
			$user->password = \Auth::instance()->hash_password($pass);
			$user->last_login = '';
			$user->login_hash = '';
			$user->profile_fields = serialize(array('nome' => $nome));
			$user->save();
		}
		
		return array($user, @$pass);
	}

}
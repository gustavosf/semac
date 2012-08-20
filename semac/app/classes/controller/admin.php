<?php

/**
 * Admin Controller.
 *
 * Ferramentas administrativas do sistema
 *
 * @package  app
 * @extends  Controller_Template
 */
class Controller_Admin extends Controller_Semac {

	public $template = 'template_admin';

	public function before()
	{
		if (in_array($this->request->action, array('login', 'logout', 'esqueci_minha_senha')))
		{
			// template do login/logout não deve conter menus (o padrão do admin)
			$this->template = 'template';
		}

		parent::before();

		$this->template->menu = View::forge('admin/menu', array(
			'action' => $this->request->action
		));
	}

	/**
	 * The index action.
	 *
	 * @access  public
	 * @return  void
	 */
	public function action_index()
	{
		$data = array();
		$this->template->content = View::forge('admin/index', $data);
	}


	/**
	 * Tela de identificação do usuário
	 *
	 * @access  public
	 * @return  void
	 */
	public function action_login()
	{
		$data = array();

		if ($_POST)
		{
			$auth = Auth::instance();
			if ($auth->login(Input::post('username'), Input::post('password')))
			{
				$goto = Cookie::get('redirect', '/');
				if (strpos($goto, '/logout') !== false OR strpos($goto, '/login') !== false)
				{
					$goto = '/';
				}
				Cookie::delete('redirect');
				Response::redirect($goto);
			}
			else
			{
				$data['username'] = Input::post('username');
				$data['error'] = 'Email/Senha incorreto! Favor confira suas credenciais e tente novamente';
			}
		}
		else
		{
			if ( ! Cookie::get('redirect'))
				Cookie::set('redirect', Input::server('HTTP_REFERER', '/'));
		}
		$this->template->title = 'Identificação';
		$this->template->content = View::forge('admin/login', $data);
	}

	/**
	 * Recuperação de Senha
	 *
	 * @access  public
	 * @return  void
	 */
	public function action_esqueci_minha_senha()
	{
		$data = array();
		if ($_POST)
		{
			$user = Model_User::find()
					->where('username', Input::post('email'))
					->get_one();
			if ( ! $user)
			{
				if ( ! Validation::is_valid_email(Input::post('email')))
				{
					Session::set_flash('error', 'Endereço de e-mail inválido');
				}
				else
				{
					Session::set_flash('error', 'O e-mail "<i>'.Input::post('email').'"</i> não está cadastrado no sistema');
					$data['email'] = Input::post('email');
				}
			}
			else
			{
				$pass = substr(str_shuffle('abcdefghijklmnopqrstuvxyzABCDEFGHIJKLMNOPQRSTUVXYZ0123456789'),0,6);
				$pass = $user->resetar_senha(); // já efetua o salvamento do registro

				$mail = new \Util_Mailer(array(
					'view' => 'admin/usuarios/esqueci_minha_senha',
					'subject' => 'SEMAC/UFRGS - Recuperação de senha',
					'to' => Input::post('email'),
				), array(
					'nome' => $user->profile_fields['nome'],
					'email' => $user->email,
					'senha' => $pass,
				));
				$mail->send();

				Session::set_flash('success', 'Suas novas credenciais para acesso foram enviadas para o e-mail <b>'.Input::post('email').'</b>');

				Response::redirect('admin/login');
			}
		}
		$this->template->title = 'Recuperação de Senha';
		$this->template->content = View::forge('admin/esqueci_minha_senha', $data);
	}

	/**
	 * Logout do usuário
	 *
	 * @access  public
	 * @return  void
	 */
	public function action_logout()
	{
		if ( ! Auth::check()) Response::redirect('admin/login');
		Auth::instance()->logout();
		$this->template->title = 'Sair';
		$this->template->content = View::forge('admin/logout');
	}

}

/* End of file admin.php */

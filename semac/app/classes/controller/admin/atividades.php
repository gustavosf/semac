<?php

/*
 * Controlador de Atividades
 *
 * Administração de atividades da semana acadêmica
 *
 * @package  app
 * @extends  Controller_Semac
 */

class Controller_Admin_Atividades extends Controller_Semac
 {

	public $template = 'template_admin';

	public function before()
	{
		parent::before();
		if (is_object($this->template))
		{
			$this->template->menu = View::forge('admin/menu', array(
				'action' => $this->request->action
			));
		}
	}

	/**
	 * Cadastro de Novas atividades na semana acadêmica
	 *
	 * Acessível apenas pelo Organizador Geral (ver acesso no config/simpleauth)
	 * Registra um atividade, e cadastra um chair caso necessário.
	 * Dispoara um e-mail para o chair, avisando do registro
	 */
	public function action_nova()
	{
		$data = array();

		if ($_POST)
		{
			$errors = null;
			if (Input::post('nome') == '') $errors['nome'] = "Nome inválido";
			if ( ! filter_var(Input::post('email'), FILTER_VALIDATE_EMAIL)) $errors['email'] = "Email inválido";
			$atividades = Model_Atividade::$atividades;
			if ( ! isset($atividades[Input::post('atividade')])) $errors['atividade'] = "Atividade Inválida!";

			$data['email'] = Input::post('email');
			$data['nome'] = Input::post('nome');
			$data['atividade'] = Input::post('atividade');
			$data['error'] = $errors;
			if (! $errors)
			{
				list($user, $pass) = Model_User::novo(Input::post('email'), Input::post('nome'), 'Chair');
				$data['new'] = $pass ? true : false;

				$atividade = new Model_Atividade;
				$atividade->chair = $user->id;
				$atividade->tipo = Input::post('atividade');
				$atividade->save();

				$data['pass'] = $pass;
				$mail = new \Util_Mailer(array(
					'view' => 'admin/atividades/nova',
					'subject' => 'Você foi incluído como Chair em uma atividade da Semana Acadêmica da Informática',
					'to' => Input::post('email'),
				), array(
					'nome' => Input::post('nome'),
					'email' => $user->email,
					'senha' => $pass,
				));
				$mail->send();
			}
		}

		$data['atividades'] = Model_Atividade::$atividades;
		$this->template->title = 'Nova Atividade';
		$this->template->content = View::forge('admin/atividades/nova', $data);
	}


	/**
	 * Listagem de atividades associadas a um chair
	 */
	public function action_listar()
	{
		$data = array();

		$atividades = Model_Atividade::find()
			->where('chair', Auth::instance()->get_user_id())
			->get();
		$data['atividades'] = $atividades;

		$this->template->title = 'Lista de Atividades';
		$this->template->content = View::forge('admin/atividades/listar', $data);
	}

	/**
	 * Edição de Atividades da SEMAC
	 */
	public function action_editar($id)
	{
		$data = array();
		$data['salvo'] = false;

		$atividade = Model_Atividade::find()
			->where(array('id' => $id, 'chair' => Auth::instance()->get_user_id()))
			->get_one();

		if ($_POST)
		{
			$val = Validation::forge();
			$val->add_field('titulo', 'Título', 'max_length[255]');
			$val->add_field('responsavel', 'Responsável', 'max_length[255]');
			$val->add_field('carga_horaria', 'Carga Horária', 'match_pattern[/^[0-9]{0,3}$/]');
			$val->add_field('vagas', 'Vagas', 'match_pattern[/^[0-9]{0,3}$/]');
			$val->add_field('data', 'Data', 'date_array');
			$val->add_field('as', 'Ás', 'time_array');
			$val->add_field('ate', 'Até', 'time_array');
			$val->add_field('descricao', 'Resumo', 'max_length[255]');
			$val->set_message('match_pattern', 'Valor inválido!');
			$val->set_message('date_array', 'Uma das datas está formatada incorretamente!');
			$val->set_message('time_array', 'Um dos horários está formatado incorretamente!');
			$data['salvo'] = $val->run($_POST);

			$atividade->titulo = $val->validated('titulo');
			$atividade->responsavel = $val->validated('responsavel');
			$atividade->carga_horaria = $val->validated('carga_horaria');
			$atividade->vagas = $val->validated('vagas');
			$atividade->selecao = $val->input('selecao');

			if ($atividade->more === null) $atividade->more = new stdClass;
			$atividade->more->descricao = $val->input('descricao');
			$atividade->more->descricao_ext = $val->input('descricao_ext');
			$atividade->more->shortbio = $val->input('shortbio');
			$atividade->more->afiliacao = $val->input('afiliacao');
			$datas = array_map(function($i, $d, $a, $t){
				return array('id' => $i, 'data' => $d, 'as' => $a, 'ate' => $t);
			}, $val->input('id_data'), $val->input('data'), $val->input('as'), $val->input('ate'));
			$atividade->setData($datas);

			if ($data['salvo']) $atividade->save();

			$data['erros'] = $val->error();
		}

		$data['atividade'] = $atividade;

		$this->template->title = 'Edição de Atividade';
		$this->template->content = View::forge('admin/atividades/editar', $data);
	}

	/**
	 * Edição de documentação de atividades da SEMAC
	 */
	public function action_docs($id)
	{
		$data = array();
		$data['salvo'] = false;

		$atividade = Model_Atividade::find()
			->where(array('id' => $id, 'chair' => Auth::instance()->get_user_id()))
			->get_one();
		if ( ! $atividade->id) Response::redirect('e/forbidden');

		if ($_POST)
		{
			/* Validação do formulário (upload validado separadamente) */
			$val = Validation::forge();
			$val->add_field('titulo', 'Título', 'required|max_length[255]');
			$val->add_field('descricao', 'Descriçao', 'required|max_length[255]');
			$val->set_message('max_length', 'Máximo de :param:1 caracteres');
			$val->set_message('required', 'Campo :label obrigatório!');
			$data['salvo'] = $val->run($_POST);
			$data['erros'] = $val->error();

			/* Processar e validar os uploads */
			Upload::process(array(
				'path'        => DOCROOT.DS.'doc'.DS.$atividade->id,
				'max_size'    => 10485760, # 10MB
				'create_path' => true,
				'normalize'   => true,
			));

			if ( ! Upload::is_valid())
			{
				$data['erros_upload'] = Upload::get_errors();
				$data['salvo'] = false;
			}

			/* No caso de formulário sem erros, salva */
			if ($data['salvo'])
			{
				Upload::save();
				$file = Upload::get_files();
				$doc = new Model_Documento;
				$doc->titulo = $val->validated('titulo');
				$doc->descricao = $val->validated('descricao');
				$doc->id_atividade = $atividade->id;
				$doc->arquivo = $file[0]['saved_as'];
				$doc->save();
			}
			else
			{
				$data['titulo'] = Input::post('titulo');
				$data['descricao'] = Input::post('descricao');
			}
		}

		$data['atividade'] = $atividade;
		$data['docs'] = $atividade->documentos;

		$data['upload'] = Upload::get_files();

		$this->template->title = 'Documentos | '.$atividade->titulo;
		$this->template->content = View::forge('admin/atividades/docs', $data);
	}

	public function post_docs_delete()
	{
		$id = Input::post('id');
		$doc = Model_Documento::find()
			->where(array('id' => $id))
			->get_one();
		if ( ! $doc->id OR $doc->atividade->chair != Auth::instance()->get_user_id())
		{
			$this->response->status = 403;
		}
		else
		{
			$doc->destroi();
		}

		// evita renderização do template
		$this->response();
	}

	/**
	 * Edição de locais de atividades da SEMAC
	 */
	public function action_locais()
	{
		$data = array();

		$atividades = Model_Atividade::find()
			->where('carga_horaria', 'is not', null)
			->get();

		$data['atividades'] = $atividades;
		$this->template->title = 'Locais das Atividades';
		$this->template->content = View::forge('admin/atividades/locais', $data);
	}

	public function post_locais()
	{

		$atividade = Model_Atividade::find(Input::post('id'));
		$atividade->update_locais(
			Input::post('local'),
			Input::post('data_id')
		);
		$this->response(); // retorna status 200 (ok)
	}

	/**
	 * Listagem de inscritos em atividades, visualizadas pelo chair
	 *
	 * @param $id int id da atividade
	 */
	public function action_inscritos($id)
	{
		$data = array();

	 	$atividade = Model_Atividade::find($id);
		if ( ! $atividade->id) Response::redirect(404);

		$data['inscritos'] = $atividade->inscricoes;
		$data['vagas'] = $atividade->vagas;
		$data['titulo'] = $atividade->titulo;

		$this->template->title = 'Inscritos | '.$atividade->titulo;
		$this->template->content = View::forge('admin/atividades/inscritos', $data);
	}

	/**
	 * Efetua o 'toggle' na inscrição do usuário.
	 * O retorno desta funcão deve ser apenas o código HTML (200OK ou 301 )
	 *
	 *
	 */
	public function action_inscrever()
	{
		$i = Model_Inscricao::find(Input::post('inscricao'));

		if (!$i)
		{
			$this->response->status = 400;
		}
		else
		{
			$status = Input::post('status') ? 1 : 2;
			$i->status = $i->status == $status ? 0 : $status;
			$i->save();
		}

		// evita renderização do template
		die();
	}

	/**
	 * Lista de chamada de uma determinada atividade
	 *
	 * @param $atividade int id da atividade
	 */
	public function action_chamada($atividade, $dia = null)
	{
		$atividade = Model_Atividade::find($atividade);
		if ( ! $atividade->id) Response::redirect(404);

		$data = array();
		$data['titulo'] = $atividade->titulo;

		if ( ! $dia)
		{
			$data['datas'] = $atividade->datas;
			$data['id_atividade'] = $atividade->id;

			$this->template->title = 'Lista de Chamada | '.$atividade->titulo;
			$this->template->content = View::forge('admin/atividades/chamada/dias', $data);
		}
		else
		{
			$dia = Model_Data::find($dia);
			$chamada = array();

			foreach ($atividade->inscricoes as $id => $inscrito)
			{
				if ($inscrito->estaInscrito())
				{
					$chamada[$id]['id'] = $inscrito->id_user;
					$chamada[$id]['nome'] = $inscrito->user->profile_fields->nome;
					$chamada[$id]['cartao'] = $inscrito->user->profile_fields->cartao;
					$chamada[$id]['presente'] = false;
					foreach ($dia->chamadas as $k => $c)
					{
						if ($c->id_user == $inscrito->id_user)
						{
							$chamada[$id]['presente'] = true;
						}
					}
				}
			}

			$data['id_data'] = $dia->id;
			$data['chamada'] = $chamada;

			$this->template->title = 'Lista de Chamada | '.$atividade->titulo;
			$this->template->content = View::forge('admin/atividades/chamada/lista', $data);
		}
	}


	/**
	 * Lista de chamada de uma determinada atividade
	 *
	 * @param $atividade int id da atividade
	 */
	public function post_presenca()
	{
		$data = Input::post('data');
		$user = Input::post('user');

		$d = Model_Data::find($data);

		if ( ! $d->id OR $d->atividade->chair != Auth::instance()->get_user_id())
		{
			$this->response->status = 403; // forbidden
		}
		else
		{
			$presenca = $d->marcaPresenca($user);
			if ($presenca === false) $this->response->status = 400;
		}

		// evita renderização do template
		$this->response();
	}

	/**
	 * Lista de chamada de uma determinada atividade
	 *
	 * @param $atividade int id da atividade
	 */
	public function action_extrato_chamadas($atividade = null)
	{
		if ($atividade !== null)
		{
			$atividade = Model_Atividade::find($atividade);
			if ( ! $atividade->id) Response::redirect(404);

			$presencas = array();
			foreach ($atividade->inscricoes as $id => $inscricao)
			{
				if ( ! $inscricao->estaInscrito()) continue;
				$presencas[$id]['nome'] = $inscricao->user->profile_fields->nome;
				$presencas[$id]['cartao'] = $inscricao->user->profile_fields->cartao;
				foreach ($atividade->datas as $data)
				{
					$presencas[$id]['dias'][$data->getData('d/m H:i')] = $data->isPresente($inscricao->user->id) ? 'P' : '-';
				}
			}

			$data = array();
			$data['dias'] = end($presencas);
			$data['dias'] = $data['dias']['dias'] ?: array();
			$data['atividade_titulo'] = $atividade->titulo;
			$data['presencas'] = $presencas;
			$this->template->title = 'Lista de Chamada | '.$atividade->titulo;
			$this->template->content = View::forge('admin/atividades/chamadas', $data);
		}
		else
		{
			$atividades = Model_Atividade::find()->get();
			$data = array();
			$data['atividades'] = $atividades;
			$this->template->title = 'Lista de Chamada';
			$this->template->content = View::forge('admin/atividades/chamada/listar_atividades', $data);
		}
	}

	/**
	 * Publica / Despublica uma  atividade (toggle)
	 * @param  int  $id  id da atividade
	 */
	public function post_publicar()
	{
		$id = Input::post('id');
		if ($atividade = Model_Atividade::find($id))
		{
			$atividade->status = $atividade->status ? 0 : 1;
			$atividade->save();
			$this->response(array(
				'publico' => $atividade->status,
			));
		}
		else
		{
			$this->response(array(
				'error' => 'Não foi encontrada atividade com este id'
			), 500);
		}
	}

	public function post_preview_descricao()
	{
		$this->response(array(
			'text' => Markdown::parse(Input::post('text')),
		));
	}
}


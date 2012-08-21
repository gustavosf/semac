<?php

class Controller_Home extends Controller_Semac {

	public function action_index()
	{
		$data = array();
		$this->template->content = View::forge('home/index' ,$data);
	}

	public function action_atividades($tipo, $id = null)
	{
		$data = array();

		if ($id === null)
		{
			$desc = array(
				0 => 'Coding Dojos onde programadores se reunem para resolver um problema de maneira cooperativa e inclusiva, criando um programa usando técnicas de Test Driven Developent (TDD) e Pair Programming',
				1 => 'Cursos blablalbal blabl ablaba lb all balb albla lb ababa bla lbal bla bla lba lba bla bla bal blabal bla bla lba lb al ba',
				2 => 'Lightning Talks com duração de 5 minutos cada, onde são discutidos projetos em desenvolvimento, mini-cursos de alguma tecnologia, apresentações de hardware/software, cases e etc',
				3 => 'Maratonas onde equipes recebem tarefas para programar em condições fora do convencional',
				4 => 'Minicursos sobre temas recentes e/ou não cobertos nas grades curriculares',
				5 => 'Paineis  blabla lba balbl la bla lbal bla  blalb al bla lb albla bla lbal blalb al bl al bla bllab alba',
				6 => 'Tópicos que representem o "estado da arte", sobre perspectivas profissionais para egressos da graduação e pós-graduação, entre outros',
				7 => 'Reuniões para discutir temas relevantes em Computação compreendendo projetos de pesquisa para o INF-UFRGS',
			);

			$data['atividades'] = Model_Atividade::find()->where('tipo', $tipo)->where('status', 1)->get();
			$data['descricao'] = $desc[$tipo];
			$data['tipo'] = Model_Atividade::$atividades[$tipo];
			$data['uri'] = $this->request->uri;
			$this->template->title = $data['tipo'];
			$this->template->content = View::forge('home/atividades', $data);
		}
		else
		{

		}
	}

}
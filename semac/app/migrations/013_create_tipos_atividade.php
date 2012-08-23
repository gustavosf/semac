<?php

namespace Fuel\Migrations;

class Create_tipos_atividade {

	public function up()
	{
		\DB::query("DROP TABLE IF exists tipos_atividade")->execute();
		\DBUtil::create_table('tipos_atividade', array(
			'id'            => array('constraint' => 11, 'type' => 'int', 'auto_increment' => true),
			'nome'          => array('constraint' => 255, 'type' => 'varchar'),
			'nome_canonico' => array('constraint' => 255, 'type' => 'varchar'),
			'descricao'     => array('type' => 'text'),
		), array('id'), false, 'InnoDB');

		\DB::query("ALTER TABLE atividades CHANGE COLUMN tipo id_tipo int")->execute();

		\Model_Tipo_Atividade::forge(array('id' => 1, 'nome' => 'Coding Dojo', 'nome_canonico' => 'coding-dojo', 'descricao' => 'Coding Dojos onde programadores se reunem para resolver um problema de maneira cooperativa e inclusiva, criando um programa usando técnicas de Test Driven Developent (TDD) e Pair Programming'))->save();
		\Model_Tipo_Atividade::forge(array('id' => 2, 'nome' => 'Curso', 'nome_canonico' => 'curso', 'descricao' => 'Cursos blablalbal blabl ablaba lb all balb albla lb ababa bla lbal bla bla lba lba bla bla bal blabal bla bla lba lb al ba'))->save();
		\Model_Tipo_Atividade::forge(array('id' => 3, 'nome' => 'Lightning Talk', 'nome_canonico' => 'lightning-talk', 'descricao' => 'Lightning Talks com duração de 5 minutos cada, onde são discutidos projetos em desenvolvimento, mini-cursos de alguma tecnologia, apresentações de hardware/software, cases e etc'))->save();
		\Model_Tipo_Atividade::forge(array('id' => 4, 'nome' => 'Maratona de Programação', 'nome_canonico' => 'maratona', 'descricao' => 'Maratonas onde equipes recebem tarefas para programar em condições fora do convencional'))->save();
		\Model_Tipo_Atividade::forge(array('id' => 5, 'nome' => 'Mini-Curso', 'nome_canonico' => 'mini-curso', 'descricao' => 'Minicursos sobre temas recentes e/ou não cobertos nas grades curriculares'))->save();
		\Model_Tipo_Atividade::forge(array('id' => 6, 'nome' => 'Painel', 'nome_canonico' => 'painel', 'descricao' => 'Paineis  blabla lba balbl la bla lbal bla  blalb al bla lb albla bla lbal blalb al bl al bla bllab alba'))->save();
		\Model_Tipo_Atividade::forge(array('id' => 7, 'nome' => 'Palestra', 'nome_canonico' => 'palestra', 'descricao' => 'Tópicos que representem o "estado da arte", sobre perspectivas profissionais para egressos da graduação e pós-graduação, entre outros'))->save();
		\Model_Tipo_Atividade::forge(array('id' => 8, 'nome' => 'Reunião', 'nome_canonico' => 'reuniao', 'descricao' => 'Reuniões para discutir temas relevantes em Computação compreendendo projetos de pesquisa para o INF-UFRGS'))->save();

		\DB::Query('ALTER TABLE tipos_atividade ADD UNIQUE (nome_canonico)')->execute();
		\DB::Query('ALTER TABLE atividades ADD CONSTRAINT fk__atividades__tipos_atividade FOREIGN KEY (id_tipo) REFERENCES tipos_atividade(id) ON UPDATE RESTRICT ON DELETE RESTRICT')->execute();
	}

	public function down()
	{
		\DB::query('ALTER TABLE atividades DROP FOREIGN KEY fk__atividades__tipos_atividade')->execute();
		\DB::query("ALTER TABLE atividades CHANGE COLUMN id_tipo tipo int")->execute();
		\DBUtil::drop_table('tipos_atividade');
	}
}
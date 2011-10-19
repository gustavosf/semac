<?php

namespace Fuel\Migrations;

class Renomear_descricao_to_more {

	public function up()
	{
		\DB::query("ALTER TABLE atividades CHANGE COLUMN descricao more text");
	}

	public function down()
	{
		\DB::query("ALTER TABLE atividades CHANGE COLUMN more descricao text");
	}
}
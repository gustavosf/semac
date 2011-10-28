<?php

namespace Fuel\Migrations;

class Alterar_tipo_do_data {

	public function up()
	{
		\DB::query('ALTER TABLE atividades CHANGE COLUMN data data text null')->execute();
	}

	public function down()
	{
		\DB::query('ALTER TABLE atividades CHANGE COLUMN data data datetime null')->execute();
	}
}
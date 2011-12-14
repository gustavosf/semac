<?php

namespace Fuel\Tasks;

/**
 * Admin tasks
 */

class Semac {

	/**
	 * Método para configuração inicial da aplicação
	 *
	 * @access public
	 * @return string
	 */
	public static function init()
	{
		is_file(APPPATH.'config/db.php') OR
			copy(APPPATH.'config/db.php.dist', APPPATH.'config/db.php');
		
		is_file(APPPATH.'config/auth.php') OR 
			copy(APPPATH.'config/auth.php.dist', APPPATH.'config/auth.php');
		
		is_file(APPPATH.'config/simpleauth.php') OR
			copy(APPPATH.'config/simpleauth.php.dist', APPPATH.'config/simpleauth.php');


		is_file(APPPATH.'config/mailer.php') OR
			copy(APPPATH.'config/mailer.php.dist', APPPATH.'config/mailer.php');

		return "Inicialização concluída. Você deve editar os arquivos ".
				\Cli::color('fuel/app/config/db.php', 'red').' e '.
				\Cli::color('fuel/app/config/mailer.php', 'red')."".
				"para atualizar as informações de acesso.\n".
				"Após configurar o acesso ao banco de dados, digite o comando ".
				\Cli::color('php oil refine db:config', 'green').
				" para configurar as tabelas no mesmo";
	}
}

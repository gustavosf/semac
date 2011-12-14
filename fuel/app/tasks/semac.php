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
		if (!is_file(APPPATH.'config/db.php'))
		{
			copy(APPPATH.'config/db.php.dist', APPPATH.'config/db.php');
		}
		
		if (!is_file(APPPATH.'config/auth.php'))
		{
			copy(APPPATH.'config/auth.php.dist', APPPATH.'config/auth.php');
		}
		
		if (!is_file(APPPATH.'config/simpleauth.php'))
		{
			copy(APPPATH.'config/simpleauth.php.dist', APPPATH.'config/simpleauth.php');
		}

		return "Inicialização concluída. Você deve editar o arquivo ".
				\Cli::color(APPPATH.'config/db.php', 'red').
				" e atualizar as informações para acesso ao banco de dados\n\n".
				"Após configurar o acesso ao banco de dados, digite o comando ".
				\Cli::color('php oil refine db:migrate', 'green').
				" para configurar as tabelas no banco de dados";
	}
}

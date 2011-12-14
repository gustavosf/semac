# Instalação

No terminal, clone a aplicação da semana acadêmica usando o Git
git clone git://github.com/gustavosf/semac.git
cd semac

Atualize os submódulos
git submodule init
git submodule update

Inicialize o framework
php oil refine install

Inicializa a aplicação
php oil refine semac:init

Configure manualmente os arquivos
fuel/app/config/db.php com os dados de acesso ao banco de dados, 
fuel/app/config/mailer.php com os dados de acesso ao e-mail,
fuel/app/config/simpleauth.php com um salt para a criação das senhas (opcional)

Migra o banco de dados para a versão mais recente
php oil refine db:migrate

Popula o banco de dados com usuários e atividades da semana acadêmica 2011/2 (opcional)
php oil refine db:populate
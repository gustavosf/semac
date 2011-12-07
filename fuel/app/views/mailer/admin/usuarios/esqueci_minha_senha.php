Olá <?php echo $nome; ?>!

Você solicitou a recuperação da senha para o cadastro no sistema da Semana Acadêmica do Instituto de Informática da UFRGS. Para acessar o sistema, favor acesse <?php echo URI::create('admin/login'); ?> e entre com as seguintes credenciais:

Email: <b><?php echo $email; ?></b>
Senha: <b><?php echo $senha; ?></b>
Olá <?php echo $nome; ?>!

Você foi cadastrado(a) no sistema da Semana Acadêmica do Instituto de Informática.
Para acessar o sistema, favor acesse <?php echo URI::create('login'); ?> e entre com as seguintes credenciais:

Email: <b><?php echo $email; ?></b>
Senha: <b><?php echo $senha; ?></b>
Olá <?php echo $nome; ?>!

Você foi cadastrado como Chair em uma atividade da Semana Acadêmica da Informática!
<?php if ($senha): ?>
Para acessar o sistema, favor acesse <?php echo URI::create('admin/login'); ?> e entre com as seguintes credenciais:

Email: <b><?php echo $email; ?></b>
Senha: <b><?php echo $senha; ?></b>

A configuração da nova atividade pode ser feita através da opção "Minhas Atividades" no menu da administração.
<?php else: ?>
Você pode acessar o sistema com o mesmo login e senha já previamente cadastrados, e selecionar a opção "Minhas Atividades" no menu da administração.
<?php endif ?>

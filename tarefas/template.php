<html>
    <head>
        <meta charset="UTF-8">
        <title>Gerenciador de Tarefas</title>
        <link rel="stylesheet" href="tarefas.css">
    </head>
<body>
    <h1>Gerenciador de tarefas</h1>
    
    <?php require 'formulario.php'; ?>

    <?php if($exibir_tabela) : ?>
        <?php require 'tabela.php'; ?>
    <?php endif; ?>
    </body>
</html>
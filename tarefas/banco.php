<?php

$bdServidor	= '127.0.0.1';
$bdUsuario	= 'sistematarefa';
$bdSenha	= 'sistema';
$bdBanco	= 'tarefas';

$conexao	=	mysqli_connect($bdServidor,	$bdUsuario,	$bdSenha,	$bdBanco);

if (mysqli_connect_errno()) {
    echo "Problemas para conectar no banco. Erro: ";
    echo mysqli_connect_error();
    die();
}

function buscar_tarefas($conexao)
{
    $sqlBusca = 'SELECT * FROM tarefas';
    $resultado = mysqli_query($conexao, $sqlBusca);

    $tarefas = [];

    while ($tarefa = mysqli_fetch_assoc($resultado)) {
        $tarefas[] = $tarefa;
    }

    return $tarefas;
}

function gravar_tarefa($conexao, $tarefa)
{
    if($tarefa['prazo'] == '') {
        $prazo = 'NULL';
    } else {
        $prazo = "'{tarefa['prazo']'";
    }

    $sqlGravar = "
        INSERT INTO tarefas
        (nome, descricao, prioridade, prazo, concluida)
        VALUES
        (
            '{$tarefa['nome']}',
            '{$tarefa['descricao']}',
            '{$tarefa['prioridade']},
            {$prazo},
            {$tarefa['concluida']}
            )
    ";
}

function buscar_tarefa($conexao, $id) {
    $sqlBusca = 'SELECT * FROM tarefas WHERE id = ' . $id;
    $resultado = mysqli_query($conexao, $sqlBusca);

    return mysqli_fetch_assoc($resultado);
}
    



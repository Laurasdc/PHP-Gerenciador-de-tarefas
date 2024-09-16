<?php

session_start();

require "banco.php";
require "ajudantes.php";

$exibir_tabela = true;

// Inicializa a variável $tarefa
$tarefa = null;

$exibir_tabela = true;

$tem_erros = false;
$erros_validacao = [];

if(tem_post()) {
    $tarefa = [
        'id' => $_POST['id'],
        'nome' => $_POST['nome'],
        'descricao' => '',
        'prazo' => '',
        'prioridade' => $_POST['prioridade'],
        'concluida' => 0,
    ];
    
    if (strlen($tarefa['nome']) == 0) {
        $tem_erros = true;
        $erros_validacao['nome'] = 'O nome da tarefa é obrigatório!';
    }

    if (! $tem_erros) {
        gravar_tarefa($conexao, $tarefa);
        header('Location: tarefas.php');
        die();
    }

    if(array_key_exists('descricao', $_POST)) {
        $tarefa['descricao'] = $_POST['descricao'];
    }

    if (array_key_exists('prazo', $_POST) 
        && strlen($_POST['prazo']) > 0) {
        if (validar_data($_POST['prazo'])) {
            $tarefa['prazo'] =
                traduz_data_para_banco($_POST['prazo']);
        } else {
            $tem_erros = true;
            $erros_validacao['prazo'] =
                'O prazo não é uma data válida';
        }
    }
    

    if(array_key_exists('concluida', $_POST)) {
        $tarefa['concluida'] = 1;
    }

    $_SESSION['lista_tarefas'][] = $tarefa;
}

if (isset($_SESSION['lista_tarefas'])) {
    $lista_tarefas = $_SESSION['lista_tarefas'];
} else {
    $lista_tarefas = [];
}

if ($tarefa) {
    gravar_tarefa($conexao, $tarefa);
}

$tarefa = [
    'id'         => 0,
    'nome'       => $_POST['nome'] ?? '',
    'descricao'  => $_POST['descricao'] ?? '',
    'prazo'      => $_POST['prazo'] ?? '',
    'prioridade' => (isset($_POST['prazo']))
        ? traduz_data_para_banco($_POST['prazo']) : '',
    'concluida'  => $_POST['concluida'] ?? ''
];

require "template.php";
?>

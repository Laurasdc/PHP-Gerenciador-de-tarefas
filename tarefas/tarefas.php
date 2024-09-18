<?php

session_start();

require "config.php";
require "banco.php";
require "ajudantes.php";
require "../classes/Tarefa.php";
require "../classes/RepositorioTarefas.php";

$exibir_tabela = true;

// Inicializa a variável $tarefa
$tarefa = null;

$exibir_tabela = true;

$tem_erros = false;
$erros_validacao = [];

$repositorio_tarefas = new RepositorioTarefas($conexao);

$exibir_tabela = true;

$tem_erros = false;
$erros_validacao = [];

$tarefa = new Tarefa();
$tarefa->setPrioridade(1);

if (tem_post()) {
    // Validate name
    if (array_key_exists('nome', $_POST) && strlen($_POST['nome']) > 0) {
        $tarefa->setNome($_POST['nome']);
    } else {
        $tem_erros = true;
        $erros_validacao['nome'] = 'O nome da tarefa é obrigatório';
    }

    // Validate description
    if (array_key_exists('descricao', $_POST)) {
        $tarefa->setDescricao($_POST['descricao']);
    }

    // Validate deadline
    if (array_key_exists('prazo', $_POST) && strlen($_POST['prazo']) > 0) {
        if (validar_data($_POST['prazo'])) {
            $tarefa->setPrazo(traduz_data_br_para_objetos($_POST['prazo']));
        } else {
            $tem_erros = true;
            $erros_validacao['prazo'] = 'O prazo não é uma data válida!';
        }
    }

    // Check if 'prioridade' exists in POST data
    if (array_key_exists('prioridade', $_POST)) {
        $tarefa->setPrioridade($_POST['prioridade']);
    } else {
        // Handle missing prioridade if needed
        $tem_erros = true;
        $erros_validacao['prioridade'] = 'A prioridade da tarefa é obrigatória';
        // Optionally set a default value
        // $tarefa->setPrioridade(1); // or any default you want
    }

    // Check if task is completed
    if (array_key_exists('concluida', $_POST)) {
        $tarefa->setConcluida(true);
    }

    // If no errors, save the task
    if (!$tem_erros) {
        $repositorio_tarefas->salvar($tarefa);

        if (isset($_POST['lembrete']) && $_POST['lembrete'] == '1') {
            enviar_email($tarefa);
        }
        header('Location: tarefas.php');
        die();
    }
}

    if(array_key_exists('concluida', $_POST)) {
        $tarefa['concluida'] = 1;
    }

    $_SESSION['lista_tarefas'][] = $tarefa;


$tarefas = $repositorio_tarefas->buscar();

include "template.php";

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

<?php

$exibir_tabela = true;

$tem_erros = false;
$erros_validacao = [];

$tarefa = new Tarefa();
$tarefa->setPrioridade(1);

try {
    $anexo = $repositorio_tarefas->buscar_anexo($_GET['id']);
} catch (Exception $e) {
    http_response_code(404);
    echo "Erro ao buscar anexo: ". $e->getMessage();
    die();
}

$repositorio_tarefas->remover_anexo($anexo->getId());
unlink(__DIR__ . '/../anexos/' . $anexo->getArquivo());

header('Location: /index.php?rota=tarefa&id=' . $anexo->getTarefaId());
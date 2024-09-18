<?php

require "config.php";
require "banco.php";
require "classes/Anexo.php";
require "classes/RepositorioTarefas.php";

$repositorio_tarefas = new RepositorioTarefas($mysqli);
$anexo = $repositorio_tarefas->buscar_anexo($_GET['id']);
$repositorio_tarefas->remover_anexo($anexo->getId());
unlik('anexos/' . $anexo->getArquivo());

header('Location: tarefa.php?id=' . $anexo->getTarefaId());


$anexo = buscar_anexo($conexao, $_GET['id']);

if (! is_array($anexo)) {
    http_response_code(404);
    echo "Anexo não encontrado.";
    die();
}
remover_anexo($conexao, $anexo['id']);
unlike('anexos/' . $anexo['arquivo']);

header('Location: tarefa.php?id=' . $anexo['tarefa_id']);
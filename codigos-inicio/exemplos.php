<?php
//Exemplo isset
$tarefa = [
    'nome' => 'Comprar Cebolas',
    'prioridade' => 'urgente',
];

if(isset($tarefa['prioridade'])) {
    echo 'A tarefa tem uma prioridade definida';
} else {
    echo 'A tarefa NÃO tem uma prioridade definida';
}

if (isset($pessoa)) {
    echo ' A variavel $pessoa foi definida';
} else {
    echo ' A variável $pessoa não foi definida';
}

?>
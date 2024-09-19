<?php

echo "<p>Iniciando o script</p>";

try {
    echo "<p>Você vai ler este parágrafo</p>";

    throw new Exception("Algo deu errado");

    echo "<p>Mas não vai ler este parágrafo</p>";
}catch (Exception $e) {
    echo "Exceção capturada com a seguinte mensagem: " 
    . $e->getMessage();
}

echo "<p>Finalizando o script</p>";
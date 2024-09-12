<?php

//Exibir o dia da semana em formato numérico

$data = date('Y-m-d');

//Converte a data para o dia da semana em formato numérico
$diaSemanaAtual = date('w', strtotime($data));

//Exibe o dia
echo "O dia da semana em formato numérico é: " . $diaSemanaAtual; //O ponto (.) faz a concatenação de strings

//Exibir quantos dias faltam par o próximo sábado (dias entre duas datas)
$diasAteSabado = 6 - $diaSemanaAtual;
echo "\n Faltam" . $diasAteSabado. " dias até sábado. ";


?>






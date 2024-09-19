<?php

//O método construtor da classe PDO vai tentar fazer a conexão com o banco de dados, usando os dados fornecidos, dentro do bloco try. Caso a conexão falhe, o bloco catch capturará a exceção e usará o método getMessage() do objeto $e para nos informar qual é a mensagem de erro.

try{
    $pdo = new PDO(BD_DSN, BD_USUARIO, BD_SENHA);
} catch (PDOException $e) {
    echo "Falha na conexão com o banco de dados: "
        . $e->getMessage();
    die();
}
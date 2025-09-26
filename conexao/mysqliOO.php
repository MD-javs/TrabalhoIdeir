<?php

// Verifica se a constante DB_HOST já está definida, caso contrário define o valor como 'localhost'
if (!defined('DB_HOST'))
    define('DB_HOST', 'localhost');

// Verifica se a constante DB_PORT já está definida, caso contrário define o valor como '3306'
if (!defined('DB_PORT'))
    define('DB_PORT', '3306');

// Verifica se a constante DB_USER já está definida, caso contrário define o valor como 'root'
if (!defined('DB_USER'))
    define('DB_USER', 'root');

// Verifica se a constante DB_PASS já está definida, caso contrário define o valor como uma string vazia
if (!defined('DB_PASS'))
    define('DB_PASS', '');

// Verifica se a constante DB_NAME já está definida, caso contrário define o valor como o nome do banco de dados 'fazendaboigordo3ajavs'
if (!defined('DB_NAME'))
    define('DB_NAME', 'fazendaboigordo3ajavs');

// Cria uma nova conexão MySQL com os parâmetros definidos (host, usuário, senha, nome do banco e porta)
$conexao = new mysqli(DB_HOST, DB_USER, DB_PASS, DB_NAME, DB_PORT);

// Verifica se ocorreu um erro ao tentar se conectar ao banco de dados
if ($conexao -> connect_error) {
    // Caso haja erro de conexão, exibe a mensagem de erro e interrompe a execução
    die("Erro de conexão: " . $conexao -> connect_error);
}

// Caso a conexão seja bem-sucedida, exibe a mensagem de sucesso
echo "Conectado com sucesso!";

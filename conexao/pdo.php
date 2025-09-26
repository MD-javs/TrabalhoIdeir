<?php

// Verifica se a constante DB_DRIVER já está definida, caso contrário define o valor como 'mysql'
if(!defined('DB_DRIVER'))
    define('DB_DRIVER', 'mysql');

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

try {
    // Dependendo do valor da constante DB_DRIVER, define o DSN (Data Source Name) para a conexão com o banco de dados
    switch(DB_DRIVER) {
        case 'mysql':
            // Caso o driver seja 'mysql', monta o DSN para MySQL
            $dsn = "mysql:host=" . DB_HOST . ";port=" . DB_PORT . ";dbname=" . DB_NAME;
            break;
        
        case "pgsql":
            // Caso o driver seja 'pgsql', monta o DSN para PostgreSQL
            $dsn = "pgsql:host=" . DB_HOST . ";port=" . DB_PORT . ";dbname=" . DB_NAME;
            break;
        
        // Lança uma exceção caso o driver não seja reconhecido
        default:
            throw new Exception("Driver de banco de dados não suportado.");
    }

    // Cria uma nova instância PDO utilizando o DSN, usuário e senha para a conexão
    $conexao = new PDO($dsn, DB_USER, DB_PASS);

    // Exibe a mensagem de sucesso indicando o driver utilizado
    echo "Conexão bem-sucedida com " . strtoupper(DB_DRIVER);

} catch (Exception $e) {
    // Caso ocorra um erro na conexão, captura e exibe a mensagem de erro
    die("Erro ao conectar: " . $e->getMessage());
}

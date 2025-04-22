<?php
date_default_timezone_set('America/Sao_Paulo');
function registrarLogTxt($tipo, $mensagem, $username = null) {
    // Caminho do arquivo de log
    $arquivo = __DIR__ . '/../logs/app.txt';
    $data = date('Y-m-d H:i:s'); // Data atual
    $usuarioInfo = $username ? "Usuário: $username" : "Usuário: Não identificado";

    // Formato do log
    $log = "[$data] [$tipo] $mensagem - $usuarioInfo\n";

    // Escreve o log no arquivo
    file_put_contents($arquivo, $log, FILE_APPEND);
}
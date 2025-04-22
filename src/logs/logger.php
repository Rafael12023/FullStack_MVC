<?php
date_default_timezone_set('America/Sao_Paulo');
function registrarLogTxt($tipo, $mensagem, $username = null) {
    $arquivo = __DIR__ . '/../logs/app.txt';
    $data = date('Y-m-d H:i:s'); // Data atual
    $usuarioInfo = $username ? "Usuário: $username" : "Usuário: Não identificado";

    $log = "[$data] [$tipo] $mensagem - $usuarioInfo\n";

    file_put_contents($arquivo, $log, FILE_APPEND);
}

<?php
date_default_timezone_set('America/Sao_Paulo');
function registrarLogTxt($tipo, $mensagem, $username = null) {
    try {
        $arquivo = __DIR__ . '/../logs/app.txt';
    $data = date('Y-m-d H:i:s'); 
    $usuarioInfo = $username ? "Usuário: $username" : "Usuário: Não identificado";
    $hostname = gethostname();
    $ip = gethostbyname($hostname);
    $log = "[$data] [$tipo] $mensagem - $usuarioInfo | IP: $ip\n";

    file_put_contents($arquivo, $log, FILE_APPEND);
    } catch (Exception $e) {
        error_log("Erro ao registrar log!". $e->getMessage());
    }
}

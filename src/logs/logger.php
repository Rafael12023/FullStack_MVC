<?php
date_default_timezone_set('America/Sao_Paulo');
function registrarLogTxt($tipo, $mensagem, $username = null) {
    try {
        if (empty($mensagem)) {
            error_log("Mensagem de log vazia."); //Evita logs inúteis ou registros acidentais.
            return;
        }

        $arquivo = __DIR__ . '/../logs/app.txt';

        if (!is_file($arquivo)) {// Verifica se o arquivo não existe
            file_put_contents($arquivo, "");//Caso não seja um arquivo, cria o arquivo com o conteudo vazio.
        }
        if (!is_writable($arquivo)) { // Verifica se o arquivo não tem permissão de escrita
            error_log("Arquivo de log encontrado, mas sem permissão de escrita: " . $arquivo);
            return;
        }

    $data = date('Y-m-d H:i:s'); 
    $usuarioInfo = $username ? "Usuário: $username" : "Usuário: Não identificado";
    $hostname = gethostname();
    $ip = gethostbyname($hostname);
    $log = "[$data] [$tipo] $mensagem - $usuarioInfo | IP: $ip\n";

    $resultado_gravacao = file_put_contents($arquivo, $log, FILE_APPEND);

    if ($resultado_gravacao === false) {
        error_log("Falha ao escrever no arquivo de log: $arquivo");
    }
    
    } catch (Exception $e) {
        error_log("Erro ao registrar log!". $e->getMessage());
    }
}

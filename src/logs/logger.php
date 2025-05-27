<?php
date_default_timezone_set('America/Sao_Paulo');
function registrarLogBanco($tipo, $mensagem, $username = null) {

    global $pdo;
    try {
        if (empty($mensagem)) {
            error_log("Mensagem de log vazia."); //Evita logs inúteis ou registros acidentais.
            return;
        }


    $data = date('Y-m-d H:i:s'); 
    $usuarioInfo = $username ? "Usuário: $username" : "Usuário: Não identificado";
    $hostname = gethostname();
    $ip = gethostbyname($hostname);

    $stmt = $pdo->prepare("INSERT INTO logs (data_hora, nivel, mensagem, usuario, ip) VALUES (:data_hora, :nivel, :mensagem, :usuario, :ip)");
    $stmt->execute([
        ':data_hora' => $data,
        ':nivel'     => $tipo,
        ':mensagem'  => $mensagem,
        ':usuario'   => $usuarioInfo,
        ':ip'        => $ip
    ]);

    $dados = $stmt->fetch(PDO::FETCH_ASSOC);

    if (!$dados) {
        error_log("Falha ao gerar log");
    }
    
    } catch (Exception $e) {
        error_log("Erro ao registrar log!". $e->getMessage());
    }
}

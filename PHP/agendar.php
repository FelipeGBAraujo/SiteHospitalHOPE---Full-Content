<?php
header('Content-Type: application/json');

if ($_SERVER["REQUEST_METHOD"] == "POST") {

    $cpf = $_POST['cpf'];
    $tipo = $_POST['tipo'];
    $esp = $_POST['esp'];
    $data = $_POST['data'];
    $hora = $_POST['hora'];

    require_once 'conexão.php';

    try {

        $stmt_check = $dbh->prepare("SELECT * FROM tbCliente WHERE cliCPF = ?");
        $stmt_check->execute([$cpf]);
        $cliente = $stmt_check->fetch(PDO::FETCH_ASSOC);

        if (!$cliente) {
            echo json_encode('error');
            exit;
        }

        $stmt_check_agenda = $dbh->prepare("SELECT * FROM tbAgenda WHERE agCli = ? OR (agEsp = ? AND agHora = ? AND agData = ?)");
        $stmt_check_agenda->execute([$cliente['cliID'], $esp, $hora, $data]);
        $agenda_existente = $stmt_check_agenda->fetch(PDO::FETCH_ASSOC);

        if ($agenda_existente) {
            echo json_encode('agendado');
            exit;
        }

        $stmt_insert = $dbh->prepare("INSERT INTO tbAgenda (agCli, agTipo, agEsp, agData, agHora, agStatus) VALUES (?, ?, ?, ?, ?, ?)");
        $stmt_insert->execute([$cliente['cliID'], $tipo, $esp, $data, $hora, '1']);
        echo json_encode('success');

    } catch (PDOException $e) {
        echo json_encode(array('status' => 'error', 'message' => 'Erro ao verificar os dados: ' . $e->getMessage()));
    }
} else {
    echo json_encode(array('status' => 'error', 'message' => 'Erro: Método de requisição inválido.'));
}
?>

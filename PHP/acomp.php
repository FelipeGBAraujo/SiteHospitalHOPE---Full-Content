<?php
if ($_SERVER["REQUEST_METHOD"] == "POST") {

    $nome = $_POST['nome'];

    require_once 'conexão.php';

    try {

        $stmt_check = $dbh->prepare("SELECT * FROM tbAgenda");
        $stmt_check->execute();
        $clientes = $stmt_check->fetchAll(PDO::FETCH_ASSOC);

        $encontrado = false;

        foreach ($clientes as $cliente) {
            $percorre = $cliente['agCli'];
            $stmt_check_cliente = $dbh->prepare("SELECT cliNome FROM tbCliente WHERE cliID = ?");
            $stmt_check_cliente->execute([$percorre]);
            $resultado = $stmt_check_cliente->fetch(PDO::FETCH_ASSOC);
                
            if ($resultado['cliNome'] === $nome) {
                $encontrado = true;

                $stmt_tipo_agenda = $dbh->prepare("SELECT taDescricao FROM tbTipoAgenda WHERE taID = ?");
                $stmt_tipo_agenda->execute([$cliente['agTipo']]);
                $tipo_agenda = $stmt_tipo_agenda->fetchColumn();

                $stmt_especialidade = $dbh->prepare("SELECT espDescricao FROM tbEspecialidade WHERE espID = ?");
                $stmt_especialidade->execute([$cliente['agEsp']]);
                $especialidade = $stmt_especialidade->fetchColumn();

                $stmt_status = $dbh->prepare("SELECT stDescricao FROM tbStatus WHERE stID = ?");
                $stmt_status->execute([$cliente['agStatus']]);
                $status = $stmt_status->fetchColumn();

                $dadosCliente = array(
                    'nome' => $resultado['cliNome'],
                    'tipo' => $tipo_agenda,
                    'esp' => $especialidade,
                    'data' => $cliente['agData'],
                    'hora' => $cliente['agHora'],
                    'status' => $status
                );
                break;
            }
        }

        if ($encontrado) {
            echo json_encode($dadosCliente);
        } else {
            echo json_encode('error');
        }

    } catch (PDOException $e) {
        echo json_encode(array('status' => 'error', 'message' => 'Erro ao verificar os dados: ' . $e->getMessage()));
    }
} else {
    echo json_encode(array('status' => 'error', 'message' => 'Erro: Método de requisição inválido.'));
}

?>

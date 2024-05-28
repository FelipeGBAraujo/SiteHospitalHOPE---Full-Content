<?php
if ($_SERVER["REQUEST_METHOD"] == "POST") {

    $cpf = $_POST['cpf'];
    $cart = $_POST['cart'];
    $senha = $_POST['senha'];

    require_once 'conexão.php';

    try {

       $stmt_check = $dbh->prepare("SELECT * FROM tbCliente");
        $stmt_check->execute();
        $clientes = $stmt_check->fetchAll(PDO::FETCH_ASSOC);

        $encontrado = false;

        foreach ($clientes as $cliente) {
            if ($cliente['cliCPF'] == $cpf && $cliente['cliCarteirinha'] == $cart && $cliente['cliSenha'] == $senha) {
                $encontrado = true;
                break;
            }
        }

        if ($encontrado) {
            echo json_encode('success');
        } else {
            echo json_encode('Fomos incapazes de encontrar essas informações em nosso banco. Por favor, tente novamente e reveja seus dados.');
        }

    } catch (PDOException $e) {
        echo json_encode(array('status' => 'error', 'message' => 'Erro ao verificar os dados: ' . $e->getMessage()));
    }
} else {
    echo json_encode(array('status' => 'error', 'message' => 'Erro: Método de requisição inválido.'));
}
?>

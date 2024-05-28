<?php
if ($_SERVER["REQUEST_METHOD"] == "POST") {

    $nome = $_POST['nome'];
    $cpf = $_POST['cpf'];
    $cart = $_POST['cart'];
    $email = $_POST['email'];
    $tel = $_POST['tel'];
    $senha = $_POST['senha'];

    require_once 'conexão.php';

    try {
        $stmt_check = $dbh->prepare("SELECT * FROM tbCliente WHERE cliCPF = :cpf OR cliCarteirinha = :cart OR cliEmail = :email");
        $stmt_check->execute(array(':cpf' => $cpf, ':cart' => $cart, ':email' => $email));

        if ($stmt_check->rowCount() > 0) {
            echo json_encode('cadastrado');
        } else {
            $stmt_insert = $dbh->prepare("INSERT INTO tbCliente (cliNome, cliCPF, cliCarteirinha, cliEmail, cliTelefone, cliUsuario, cliSenha) VALUES (:nome, :cpf, :cart, :email, :tel, :user, :senha)");

            $stmt_insert->execute(array(
                ':nome' => $nome,
                ':cpf' => $cpf,
                ':cart' => $cart,
                ':email' => $email,
                ':tel' => $tel,
                ':user' => $nome,
                ':senha' => $senha
            ));

            echo json_encode('success');
        }

    } catch (PDOException $e) {
        echo json_encode(array('status' => 'error', 'message' => 'Erro ao inserir os dados: ' . $e->getMessage()));
    }
} else {
    echo json_encode(array('status' => 'error', 'message' => 'Erro: Método de requisição inválido.'));
}

?>

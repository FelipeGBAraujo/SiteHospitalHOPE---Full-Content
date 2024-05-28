$('#form-P').submit(function(event) {
    event.preventDefault();

    var cpf = $('#cpf').val();
    var cart = $('#cart').val();
    var senha = $('#senha').val();
  
    if (cpf != '' && cart != '' && senha != '') {
      $.ajax({
        url: 'http://projetofaculdade.atwebpages.com/PHP/login.php',
        method: 'POST',
        data:
        {
          cpf: cpf,
          cart: cart,
          senha: senha
        },
        dataType: 'json'
      }).done(function(response) {
        console.log("Resposta do servidor:", response);
        if (response === 'success') {
          var url = 'http://projetofaculdade.atwebpages.com/index.html?status=success';
          window.location.href = url;
        } else {
            alert("Fomos incapazes de encontrar essas informações em nosso banco. Por favor, tente novamente e reveja seus dados.");
        }
      });
    } else {
      alert("Erro: Preencha todos os campos corretamente.");
    }
  });
  
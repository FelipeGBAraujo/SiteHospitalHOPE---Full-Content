$('#form-P').submit(function(event) {
  event.preventDefault();

  var nome = $('#nome').val();
  var cpf = $('#cpf').val();
  var cart = $('#cart').val();
  var email = $('#email').val();
  var tel = $('#tel').val();
  var senha = $('#senha').val();
  var confSenha = $('#confSenha').val();

  if (nome != '' && cpf != '' && cart != '' && email != '' && tel != ''
    && senha != '' && confSenha != '' && senha == confSenha) {
    $.ajax({
      url: '../PHP/valida.php',
      method: 'POST',
      data:
      {
        nome: nome,
        cpf: cpf,
        cart: cart,
        email: email,
        tel: tel,
        senha: senha
      },
      dataType: 'json'
    }).done(function(response) {
      console.log("Resposta do servidor:", response);
        if (response === 'success') {
          var url = 'http://projetofaculdade.atwebpages.com/index.html?status=success';
          window.location.href = url;
        } else if (response === 'cadastrado') {
            alert("Este cpf, carteira ou email já está ou estão em uso.");
        }
    });
  } else {
    alert("Erro: Preencha todos os campos corretamente.");
  }
});

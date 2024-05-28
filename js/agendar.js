$('#form-P').submit(function(event) {
  event.preventDefault();

  var cpf = $('#cpf').val();
  var tipo = $('#tipo').val();
  var esp = $('#especialidade').val();
  var data = $('#data').val();
  var hora = $('#hora').val();

  if (cpf != '' && tipo != '' && esp != '' && data != '' && hora != '') {
    $.ajax({
      url: '../PHP/agendar.php',
      method: 'POST',
      data:
      {
        cpf: cpf,
        tipo: tipo,
        esp: esp,
        data: data,
        hora: hora
      },
      dataType: 'json'
    }).done(function(response) {
      if (response === 'success') {
        console.log('Tá rodando');
      	alert('Seu resgistro foi efetuado! Para acompanhamento, favor seguir para a página respectiva.');
      } else if (response === 'error') {
      	alert('Parece que você não existe em nosso banco. Por favor, reveja suas informações e tente novamente.')
      } else if (response === 'agendado') {
      	alert('Infelizmente você já possui um agendamento em ocorrência ou outra pessoa escolheu o mesmo dia, hora e especialidade que você. Por favor, reveja seus dados no ' +
              'acompanhamento ou mude a data.')
      }
    });
  } else {
    alert("Erro: Preencha todos os campos corretamente.");
  }
});

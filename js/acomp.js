$('#form-P').submit(function(event) {
    event.preventDefault();

    var nome = $('#nome').val();
  
    if (nome != '') {
      $.ajax({
        url: '../PHP/acomp.php',
        method: 'POST',
        data:
        {
          nome: nome
        },
        dataType: 'json'
      }).done(function(response) {
        console.log("Resposta do servidor:", response);
        if (response.nome !== undefined) {
            console.log(response)
            var nome = response.nome;
            var tipo = response.tipo;
            var esp = response.esp;
            var data = response.data;
            var hora = response.hora;
            var status = response.status;
            
            var form = document.getElementById('form-P');
            form.style.display = 'none';
            var bord = document.getElementById('bord');
            bord.style.display = 'grid';
            var name = document.getElementById('title');
            name.innerHTML = "NOME DO PACIENTE: " + nome;
            var tipe = document.getElementById('tipo');
            tipe.innerHTML = "CONSULTA OU EXAME? " + tipo;
            var espec = document.getElementById('espe');
            espec.innerHTML = "A ESPECIALIDADE É: " + esp;
            var dat = document.getElementById('data');
            dat.innerHTML = "A DATA É/ERA: " + data;
            var time = document.getElementById('hora');
            time.innerHTML = "O HORÁRIO É: " + hora;
            var stat = document.getElementById('status');
            stat.innerHTML = "STATUS ATUAL: " + status;
        } else if (response.nome === undefined) {
        	alert('Infelizmente não encontramos você em nosso banco de dados. Por favor, tente novamente.');
        }
      });
    } else {
      alert("Erro: Preencha todos os campos corretamente.");
    }
  });
  
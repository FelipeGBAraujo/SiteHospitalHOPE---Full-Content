function obterStatusDoQueryParameter() {
    var urlParams = new URLSearchParams(window.location.search);
    return urlParams.get('status');
  }

  var status = obterStatusDoQueryParameter();

  if (status === "success") {
    console.log("A validação foi bem-sucedida!");

  } else {
    window.location.href = "http://projetofaculdade.atwebpages.com/Login/login.html"
  }
  
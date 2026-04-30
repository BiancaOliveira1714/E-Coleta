function abrirModal(){
  document.getElementById("modal").style.display="block";
}

function fecharModal(){
  document.getElementById("modal").style.display="none";
}

function enviar(){
  let endereco = document.getElementById("endereco").value;
  let material = document.getElementById("material").value;

  fetch("salvar_pedido.php",{
    method:"POST",
    headers:{"Content-Type":"application/x-www-form-urlencoded"},
    body:`endereco=${endereco}&material=${material}`
  })
  .then(res=>res.text())
  .then(msg=>{
    alert(msg);
    fecharModal();
  });
}
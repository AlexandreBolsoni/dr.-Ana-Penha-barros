// Função do carrossel que importa o conteúdo do arquivo carrossel.html
function mostrarCarrossel() {
    var carrossel = document.getElementById("carrossel");
    fetch("carrossel.html")
      .then(response => response.text())
      .then(data => {
        carrossel.innerHTML = data;
        // Inicialize o carrossel aqui, se necessário
      });
  }
  
  // Chame a função do carrossel quando necessário
  mostrarCarrossel();
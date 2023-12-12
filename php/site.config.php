<?php


function getUsuario($login, $senha_md5) {
    require_once '../conexao/site.conexao.php';
    


    $db = new DatabaseConnection("localhost", "root", "", "trabalho_interdiciplinar");
    $conn = $db->getConnection(); // Obtendo a conexão do objeto $db

    $sql = "SELECT * FROM `usuarios` WHERE (`login` LIKE ? OR `email` LIKE ?) AND `senha` LIKE ?;";
    $stmt = mysqli_prepare($conn, $sql);
    mysqli_stmt_bind_param($stmt, "sss", $login, $login, $senha_md5);
    mysqli_stmt_execute($stmt);
    $result = mysqli_stmt_get_result($stmt);

    if (mysqli_num_rows($result) > 0) {
        $row = mysqli_fetch_assoc($result);
        mysqli_stmt_close($stmt);
        mysqli_close($conn);
        return $row;
    } else {
        mysqli_stmt_close($stmt);
        mysqli_close($conn);
        return null;
    }
}

// Função para criar estilos CSS inline
function criaEstilosCSS()
{
    echo '<style>
        table {
            margin: 30px;
            width: 70%;
            border-collapse: collapse;
        }

        th, td {
            padding: 12px 8px;
            text-align: left;
            border-bottom: 1px solid #ddd;
        }

        th {
            background-color: #f2f2f2;
            font-weight: bold;
        }

        tr:nth-child(even) {
            background-color: #f9f9f9;
        }

        tr:hover {
            background-color: #f2f2f2;
        }

        form p {
            margin-bottom: 15px;
            font-weight: bold;

        }
    
        form input[type="text"],
        form input[type="number"],
        form textarea {
            margin: 0 auto  ;
            width: 100%;
            padding: 10px;
            margin-bottom: 15px;
            border: 1px solid #ccc;
            border-radius: 5px;
            box-sizing: border-box;
        }

        #btExcluir {
            background-color: #ff5c5c;
            color: white;
            padding: 12px 20px;
            border: none;
            border-radius: 5px;
            cursor: pointer;
            font-weight: bold;
            transition: background-color 0.3s ease;
        }
            
        #btExcluir:hover {
            background-color: #e04848;
        }

        /* Estilo para o link "Voltar" */
        a {
            margin: 20px auto;
            display: inline-block;
            padding: 10px 20px;
            text-decoration: none;
            background-color: #2da63f;
            color: #fff;
            border-radius: 5px;
            margin-top: 10px;
          
        }

      
    </style>';
}

function criarMenu($usuario) {
    $menu = "";
    if($usuario != "")
    {
        $menu = ' <ul class="flex-center-row">
        <li><a class="efeito-h" href="index.php">Home</a></li>
        <li><a class="efeito-ah" href="cadastro.php">Cadastro</a></li>      
        <li><a class="efeito-ah" href="tratamento.php">Tratamento</a></li>      
        <li><a class="efeito-ah" href="listaPaciente.php">lista de Pacientes</a></li>      
        <li class="usuario-logado">
            <iconify-icon icon="lucide:user-cog"></iconify-icon> 
             '.$usuario.'
             
        </li>
        <li class="btn-cinza"><a class="efeito-h" href="sair.php">
        Sair</a></li>
    </ul>';
    } else {
        $menu = ' <ul class="flex-center-row">
        <li><a class="efeito-h" href="index.php">Home</a></li>
        <li><a class="efeito-ah" href="cadastro.php">Cadastro</a></li>
        <li><a class="efeito-ah" href="tratamento.php">Tratamento</a></li>
        <li><a class="efeito-ah" href="listaPaciente.php">lista de Pacientes</a></li>
    <li>
        <a class="efeito-h" href="entrar.php">
            Entrar</a>
        </li>
    </ul>';
    }

    return $menu;
}

function criaHeader($titulo, $usuario = "") {
   // echo "Usuario : " . $usuario;

    echo '<!DOCTYPE html>
    <html lang="pt-br">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Ana Penha Barros : '.$titulo.'</title>
        <link rel="stylesheet" href="css/style.css">
        <link rel="stylesheet" href="css/login.css">
        <link rel="stylesheet" href="css/cadastro.css">
       
        
        <link rel="icon" href="img/logo.PNG" type="image/png">
    
         <!-- Inclua o Iconify Core para lidar com os ícones -->
         <script src="https://code.iconify.design/iconify-icon/1.0.7/iconify-icon.min.js"></script>
    
    </head>
    <body>
        <header>
            <div class="logo flex-center-row">
                <img src="img/logo.svg" alt="Logo MetaTSI" width="50" height="50"> 
                <div>Dr. Ana Penha Barros - Terapeuta Ocupacional</div>
            </div>
    
            '.criarMenu($usuario).'
           
        </header>
        
        <main class="center">';
}

function criaFooter() {
    echo '   </main>
    <footer>
        <iconify-icon icon="ic:outline-copyright"></iconify-icon>
        <div>Projeto desenvolvido por alunos do curso de TSI</div>
        <ul class="flex-center-column"> 
            <li><a href="#">Sobre Nós</a></li>
            <li><a href="#">Contato</a></li>
        </ul>
    </footer>

    <!-- <img src="img/equipe.svg" alt="Meu SVG" width="100" height="100"> -->

</body>
</html>';
}



?>
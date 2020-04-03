
<?php
  include '../banco/conexao.php';
  $conectar = getConnection();
?>

<?php
  // Determinar TimeZone => https://www.php.net/manual/pt_BR/timezones.america.php
  date_default_timezone_set('America/Sao_Paulo');
  setlocale(LC_TIME, "pt_BR");
            
  $agora = getdate();

  $ano = $agora["year"];
  $mes = utf8_encode(strftime("%B"));  // => https://www.php.net/manual/pt_BR/function.strftime.php
  $dia = $agora["mday"];

  $data = $dia . " de " . $mes . " de "  . $ano;
?>

<?php
  // pega o ID da URL
  $id = isset($_GET['id']) ? (int) $_GET['id'] : null;
?>

<?php
  //cria consulta SQL
  $listagem = "SELECT * FROM relatorio WHERE id = $id";

  $consulta = $conectar->prepare ($listagem);
  $consulta->execute();

  if (!$consulta) {
    die("Erro no Banco");
  }

  $linha = $consulta->fetch(PDO::FETCH_ASSOC);
?>

<!DOCTYPE html>
<html>
<head>
  <meta charset="utf-8">
  <title>Relatórios</title>

  <!-- <link rel="stylesheet" href="css/styleRelatorios.css"> -->
  <!-- Link Bootstrap -->
  <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css" integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh" crossorigin="anonymous">

  <link rel="stylesheet" href="https://raw.githubusercontent.com/daneden/animate.css/master/animate.css">
  <link rel="stylesheet" href="css/bootnavbar.css">

<!-- Image and text -->               <!-- https://color.adobe.com/pt/create -->
<nav class="navbar navbar-expand-lg navbar-light" style="background-color: #FFF0C7;"> 

  <div class="collapse navbar-collapse" id="navbarNav">
    <ul class="navbar-nav">
      
      <li class="nav-item active">
        <a class="nav-link" href="index.php">Fazer Relatório</a>
      </li>

      <li class="nav-item active">
        <a class="nav-link" href="relatorios.php">Relatórios</a>
      </li>
    </ul>
  </div>
</nav>

<style> 

  div.listando{
    float: center;
    padding-left: 500px;
    padding-right: 450px;  
  }


  img {
    float:left;
    width:130px;
    height:130px;
    margin-right: 10px;
  }

  div.descricao{
    width:320px;
    height:100px;
    display: flex;
    border: 0px solid black;
    padding-top: 0px;
    padding-right: 30px;
    padding-bottom: 05px;
    padding-left: 15px;

  }

  a.btn {
    position: relative;
    width: 30px;
    padding-right: 7px;
    padding-left: 4px;
  }

div.botao{
  padding-right: 10px;
  padding-left: 110px; 
}

  img.botaoCancelar {
    width: 32px;
    height: 32px;   
  }
  img.botaoEditar {
    width: 32px;
    height: 32px;
  }
  img.botaoRelatorio {
    width: 32px;
    height: 32px;
  }
</style>



</head>

<body>

<center>
  <p>
  <label><h5> Data Atual: <?php echo $data; ?> </h5></label>
  </p> 
</center>
<hr>


<div class="listando">  
    <br> <img src="../img/icon_contato.png">
    <p></p>
    <b>
       <?php 
          echo "ID: " . $linha["id"] . "<br>" . $linha["titulo"]; 
       ?>
    </b>
    <br>
    <b>Data:</b><br>
    <?php
      echo $linha["data_desc"];
    ?>

    <b>Editado em:</b><br>
    <?php
      echo $linha["editado_em"];
    ?>

    <br>
    <hr>

    <div class="descricao">     
         <?php 
              echo $linha["descricao"]; 
         ?> 
    </div> 
    <hr>

    <input type="hidden" name="id" value="<?php echo $linha["id"] ?>">

<div class="botao">
        <a class="btn btn-link" href="../model/deletar.php?id=<?php echo $linha["id"]?>" role="button" name="deletar">
          <img class="botaoCancelar" src="../img/icon_cancelar.png">
        </a>
        <a class="btn btn-link" href="index_atualizar.php?id=<?php echo $linha["id"]?>" role="button" name="editar">
          <img class="botaoEditar" src="../img/icon_editar.png">
        </a>
        <a class="btn btn-link" href="gerar_pdf.php?id=<?php echo $linha["id"]?>" role="button" name="relatorio">
          <img class="botaoRelatorio" src="../img/icon_relatorio.png">
        </a> 
</div>

</div> <!-- FIM da class Listando -->





<?php include_once("../_incluir/rodape.php"); ?>
</body>

</html>
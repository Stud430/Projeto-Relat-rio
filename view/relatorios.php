
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
  $mes = strftime("%B");  // => https://www.php.net/manual/pt_BR/function.strftime.php
  $dia = $agora["mday"];

  $data = $dia . " de " . $mes . " de "  . $ano;
?>


<?php
  //cria consulta SQL
  //$listagem = "SELECT * FROM relatorio order by created";

// Consulta ao banco de dados
  $listagem = "SELECT * ";
  $listagem .= "FROM relatorio ";
  if ( isset($_GET["buscar"]) ) {
      $procurar = $_GET["buscar"];
      $listagem .= "WHERE titulo LIKE '%{$procurar}%' ";
  }/* elseif ( isset($_GET["data"])) {
      $procurar = $_GET["data"];
      $listagem .= "WHERE created = $procurar ";
  } */




  $consulta = $conectar->prepare ($listagem);
  $consulta->execute();

  if (!$consulta) {
    die("Erro no Banco");
  }
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
  
  <form action="relatorios.php" method="GET" class="form-inline my-2 my-lg-0">
    <div class="form-group">
        <input class="form-control" type="text" name="buscar" placeholder="titulo"/>
    <!--    <input class="form-control" type="text" name="data" placeholder="xxxx-xx-xx"/> -->
    </div>
    <div class=text-right>
        <input type="image" src="../img/botao_search.png" class="btn btn-default" width="50" height="40" />
    </div>
  </form>

</nav>

<style>

  div.listagem{
    float: center;
    padding-left: 150px;
    padding-right: 150px;
  }

  div.listando{
    position: relative;
    width: 200px;
    height: 160px;
    float: left;
  }

  a.btn {
    position: relative;
    width: 30px;
    padding-right: 7px;
    padding-left: 4px;
  }

  img.botaoCancelar {
  /*  position: relative; */
    width: 32px;
  /*  padding-right: 5px; */
  }
  img.botaoEditar {
  /*  position: relative; */
    width: 32px;
  /*  padding-left: 5px; */
  }
  img.botaoRelatorio {
    width: 32px;
    height: 32px;
  }

</style>



</head>

<body>

<br><br>
<center>
  <label>
    <h3> 
      Relatórios 
    </h3>
  </label>
<br>
  
  <p>
    <label> <?php echo $data; ?> </label>
  </p> 
</center>
<hr>

<?php
  while($linha = $consulta->fetch(PDO::FETCH_ASSOC)) {
?>
<div class="listagem">
  <div class="listando">  
    <br>
      <a href="detalhe.php?id=<?php echo $linha['id'] ?>">
        <img src="../img/icon_contato.png">
      </a>
    <br> 
      <b>
       <?php echo $linha["titulo"] ?>
      </b> 
    <br> <?php echo $linha["data_desc"] ?> 
    <br> 
    
    <a class="btn btn-link" href="../model/deletar.php?id=<?php echo $linha["id"]?>" role="button" name="deletar">
      <img class="botaoCancelar" src="../img/icon_cancelar.png">
    </a>

    <a class="btn btn-link" href="index_atualizar.php?id=<?php echo $linha["id"]?>" role="button" name="editar">
      <img class="botaoEditar" src="../img/icon_editar.png">
    </a>

    <a class="btn btn-link" href="gerar_pdf.php?id=<?php echo $linha["id"]?>" role="button" name="relatorio">
      <img class="botaoRelatorio" src="../img/icon_relatorio.png">
    </a> 

<!--    <input type="hidden" name="id" value="<?php echo $linha["id"] ?>"> -->
  </div>     
</div>
<?php
  }
?> 

<?php include_once("../_incluir/rodape.php"); ?>
</body>

</html>

<!--

<?php
  //cria consulta SQL
  $listagem = "SELECT * FROM relatorio order by created";

  $consulta = $conectar->prepare ($listagem);
  $consulta->execute();

  if (!$consulta) {
    die("Erro no Banco");
  }
?>

-->  

<!--
  <?php
  while($linha = $consulta->fetch(PDO::FETCH_ASSOC)) {
?>
<tr>
    <td class="relatorios">
        <br><a href="detalhe.php?codigo=<?php echo $linha['id'] ?>">
          <img src="../img/icon_contato.png">
        </a>
        <br> <b><?php echo $linha["titulo"] ?></b> 
        <br> <?php echo $linha["data_desc"] ?> 
    </td>
</tr>
<?php
  }
?> 
-->


<!--

<?php
  while($linha = $consulta->fetch(PDO::FETCH_ASSOC)) {
?>
  <ul>
    <td class="imagem">
        <a href="detalhe.php?codigo=<?php echo $linha['id'] ?>">
          <img src="../img/icon_contato.png">
        </a>
        <br> <b><?php echo $linha["titulo"] ?></b> 
        <br> <?php echo $linha["data_desc"] ?> 
    </td>
<!--    <td> Data de Criação: <?php echo $linha["data_desc"] ?> </td> -->
<!--    <td> Título: <?php echo $linha["titulo"] ?> </td> -->
  </ul>
<?php
  }
?>


  -->
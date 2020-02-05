
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
  $listagem = "SELECT * FROM relatorio";

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

  <link rel="stylesheet" href="css/styleRelatorios.css">
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

</head>

<body>
<div class="form-group">
<br><br>
<center>
  <label>
    <h3> 
      Relatórios 
    </h3>
  </label>
<br>

  <div class="col-2">
    <p>
      <label> <?php echo $data; ?> </label>
    </p>   
  </div>
</center>

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

</body>

</html>
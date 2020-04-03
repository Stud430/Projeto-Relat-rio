
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

	// Consulta a tabela de Login
    $consulta = "SELECT * FROM relatorio WHERE id = :id ";

	$visualizar = $conectar->prepare($consulta);
	$visualizar->execute(array(':id' => $id));

	$linha = $visualizar->fetch(PDO::FETCH_ASSOC)
?>

<!DOCTYPE html>
<html>
<head>
  <meta charset="utf-8">
  <title>Editar Relatório</title>

  
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
  div.form-group{
    float: center;
    padding-left: 480px;
  }

  div.form-row{
  margin: 0 auto;
  width: 250%; /* Valor da Largura */
  float: center;
  } 

  div.data{
    margin: 0 auto;
    width: 50%;
  }

  div.col-2{
    float: center;
    width: 500px;
  }
  /*
  div.text-area{
    padding-left: 50px; 
  }
  */
  div.descricao{
    width:1998px;
    height:100px;
    display: flex;
    border: 0px solid black;
    padding-top: 0px;
    padding-right: 30px;
    padding-bottom: 05px;
    padding-left: 0px;

  }
</style>

</head>

<body> 

<form action="../model/editar.php" method="post">
    <!-- <br><label><h3> Login </h3></label><br> -->


<br><br>
<center>
  <div class="data">
    <label>
      <h3> 
        Editar Relatório 
      </h3>
    </label>
    <br>  
    <label>Hoje é <?php echo $data; ?> </label>
  </div>
</center>

<br>
<div class="form-group">
  <div class="form-row"> 
    <div class="col-2">
      <p>
        <label>Título</label>
        <input type="text" name="titulo" id="titulo" value="<?php echo $linha["titulo"] ?>" class="form-control">
      </p>   
    </div>
  </div>
  
<div class="descricao">  
  <div class="form-row">  
    <div class="col-2">
      <p>
        <label>Descrição</label>
        <textarea name="descricao" id="descricao" rows="6" cols="35" class="form-control">
          	<?php echo $linha["descricao"]; ?>
        </textarea>
      </p>    
    </div> <!-- FIM do col-2 -->
  </div> <!-- FIM do form-row -->
</div>

</div> <!-- FIM do form-group -->

<input type="hidden" name="id" id="id" value="<?php echo $linha["id"] ?>">

<br><br><br><br>
<center>
    <p>
      <button type="submit" class="btn btn-secondary" name="editar" value="editar">
        Editar
      </button>
    </p>
</center>
</form> 

<?php include_once("../_incluir/rodape.php"); ?>
</body>

</html>
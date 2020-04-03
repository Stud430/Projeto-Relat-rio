
<?php
  // Determinar TimeZone => https://www.php.net/manual/pt_BR/timezones.america.php
  date_default_timezone_set('America/Sao_Paulo');
  setlocale(LC_TIME, "pt_BR");
            
  $agora = getdate();

  $ano = $agora["year"];
  $mes = utf8_encode(strftime("%B"));  // => https://www.php.net/manual/pt_BR/function.strftime.php
  $dia = $agora["mday"];

  $data = $dia . " de " . $mes . " de "  . $ano;
  //$data_desc = $dia . "/" . $mes . "/" . $ano;
?>

<!DOCTYPE html>
<html>
<head>
  <meta charset="utf-8">
  <title>Criar Relatório</title>

  
  <script  src="https://code.jquery.com/jquery-3.4.1.min.js" integrity="sha256-hwg4gsxgFZhOsEEamdOYGBf13FyQuiTwlAQgxVSNgt4=" crossorigin="anonymous"></script>

  <!-- Link Bootstrap -->
  <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css" integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh" crossorigin="anonymous">

  <link rel="stylesheet" href="css/bootnavbar.css">

  <script type="text/javascript" src="../control/jquery-3.4.1.js" ></script>
  <script src="control/sweetalert.js"></script>
  <!-- https://www.youtube.com/watch?v=oCPAQv_mqoc -->

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
</style>

</head>

<body> 

<form action="../model/cadastrar.php" method="post">
    <!-- <br><label><h3> Login </h3></label><br> -->
<br><br>
<center>
  <div class="data">
    <label>
      <h3> 
        Fazer Relatório 
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
        <input type="text" name="titulo" class="form-control">
      </p>   
    </div>
  </div>
  
  <div class="form-row">  
    <div class="col-2">
      <p>
        <label>Descrição</label>
        <textarea name="descricao" rows="6" cols="35" class="form-control"></textarea>
      </p>    
    </div> <!-- FIM do col-2 -->
  </div> <!-- FIM do form-row -->

</div> <!-- FIM do form-group -->

<center>
    <p>
      <button type="submit" class="btn btn-secondary" name="Salvar" id="salvar" value="salvar">
        Salvar
      </button>
      <button type="reset" class="btn btn-secondary" name="Limpar" id="limpar" value="limpar">
        Limpar
      </button>
    </p>
</center>

</form> 

<?php include_once("../_incluir/rodape.php"); ?>
</body>

</html>


<?php
  /*
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

    <div class="col-2">
      <p>
        <label>Hoje é <?php echo $data; ?> </label>
    </p>   
    </div>

  <div class="form-row">
    <div class="col-2">
      <p>
        <label>Título</label>
        <input type="text" name="titulo" size="50" placeholder="Título" class="form-control"></p>   
    </div>
  </div>

  <div class="form-row">
    <div class="col-2">
      <p>
        <label>Descrição</label>
        <textarea name="desc" rows="6" cols="30" class="form-control" placeholder="Descreva aqui seu relatório"></textarea>
    </p>    
    </div>
  </div>  
  
  <div class="form-row">
    <p>
      <button type="submit" class="btn btn-secondary" name="Salvar" value="salvar">Salvar</button>
      <button type="reset" class="btn btn-secondary" name="Limpar" value="limpar">Limpar</button>
    </p>
  </div>

<?php
  */
?>
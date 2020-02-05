
<?php
  // Determinar TimeZone => https://www.php.net/manual/pt_BR/timezones.america.php
  date_default_timezone_set('America/Sao_Paulo');
  setlocale(LC_TIME, "pt_BR");
            
  $agora = getdate();

  $ano = $agora["year"];
  $mes = strftime("%B");  // => https://www.php.net/manual/pt_BR/function.strftime.php
  $dia = $agora["mday"];

  $data = $dia . " de " . $mes . " de "  . $ano;
  //$data_desc = $dia . "/" . $mes . "/" . $ano;
?>

<!DOCTYPE html>
<html>
<head>
  <meta charset="utf-8">
  <title>Criar Relatório</title>

  <link rel="stylesheet" href="css/styleCadastro.css">
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

<form action="../model/cadastrar.php" method="post">
    <!-- <br><label><h3> Login </h3></label><br> -->
<div class="form-group">
<br><br>
<center>
  <label>
    <h3> 
      Fazer Relatório 
    </h3>
  </label>
</center>
<br>

  <div class="data">
    <label>Hoje é <?php echo $data; ?> </label>
  </div>


  <div class="col-2">
    <p>
      <label>Título</label>
      <input type="text" name="titulo" class="form-control">
    </p>   
  </div>

  
    <div class="col-2">
      <p>
        <label>Descrição</label>
        <textarea name="descricao" rows="6" cols="35" class="form-control"></textarea>
    </p>    
    </div>
  

  <center>
  <div class="form-group">
    <p>
      <button type="submit" class="btn btn-secondary" name="Salvar" value="salvar">
        Salvar
      </button>
      <button type="reset" class="btn btn-secondary" name="Limpar" value="limpar">
        Limpar
      </button>
    </p>
  </div>
  </center>

</div>


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

</form> 


</body>

</html>
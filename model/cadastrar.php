
<?php
  include '../banco/conexao.php';
  $conectar = getConnection();
?>

<?php
    //$sql = 'INSERT INTO produto (descricao,qtd,valor) VALUES (:desc,:qtd,:valor)';
    $sql = 'INSERT INTO relatorio (titulo,descricao,created,data_desc, editado_em) 
            VALUES (:titulo,:descricao,:created,:data_desc, :editado_em)';

    date_default_timezone_set('America/Sao_Paulo');
    setlocale(LC_TIME, "pt_BR");
            
    $agora = getdate();

    $a = $agora["year"];
    $m = strftime("%B");
    $d = $agora["mday"];
    $espaco = " ";

    $titulo = $_POST["titulo"];
    $descricao = $_POST["descricao"];
    $data = date("d.m.y"); // Se no banco "created" for do tipo "date"
    $editado_em = " ";

    // https://www.youtube.com/watch?v=8BHWt8zJg48
    // https://stackoverflow.com/questions/51024986/uncaught-error-call-to-undefined-function-now/51025001

    $data_desc = $d .$espaco. "de" .$espaco. $m .$espaco. "de" .$espaco. $a;
    //$data = current_date($agora["mday"]."/".strftime("%B")."/".$agora["year"]);  
    // http://www.l9web.com.br/blog/?p=68

    $stmt = $conectar->prepare($sql);
    $stmt->bindParam(':created', $data);
    $stmt->bindParam(':titulo', $titulo);
    $stmt->bindParam(':descricao', $descricao);
    $stmt->bindParam(':data_desc', $data_desc);
    $stmt->bindParam(':editado_em', $editado_em);

    if($stmt->execute()){
        echo 'Salvo com sucesso!';
        header("location:../view/index.php");
    }else{
        echo ' Erro ao salvar!';
        //die($stmt->execute());
    }

?>



<!--


//$sql = 'INSERT INTO produto (descricao,qtd,valor) VALUES (:desc,:qtd,:valor)';
    $sql = 'INSERT INTO relatorio (titulo,descricao) VALUES (:titulo,:descricao)';


    //$created = $data;
    $titulo = $_POST["titulo"];
    $descricao = $_POST["descricao"];
    //$dataAtual = $_POST["data_desc"];

    $stmt = $conectar->prepare($sql);
    //$stmt->bindParam(':created', $created);
    $stmt->bindParam(':titulo', $titulo);
    $stmt->bindParam(':descricao', $descricao);
    //$stmt->bindParam(':data_desc', $dataAtual);

    if($stmt->execute()){
        echo 'Salvo com sucesso!';
        header("location:../view/index.php");
    }else{
        echo ' Erro ao salvar!';
        //die($stmt->execute());
    }


-->
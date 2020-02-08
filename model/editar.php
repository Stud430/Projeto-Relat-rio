
<?php
  include '../banco/conexao.php';
  $conectar = getConnection();
?>

<?php
    date_default_timezone_set('America/Sao_Paulo');
    setlocale(LC_TIME, "pt_BR");
            
    $agora = getdate();

    $a = $agora["year"];
    $m = strftime("%B");
    $d = $agora["mday"];
    $espaco = " ";

    $editado_data = $d .$espaco. "de" .$espaco. $m .$espaco. "de" .$espaco. $a;
?>


<?php

	if(isset($_POST['editar']))
{
	$id = $_POST['id'];
    $titulo = $_POST['titulo'];
    $descricao = $_POST['descricao'];

    // Verificando os campos se estao preenchidos
    if(empty($titulo) || empty($descricao) ) {
        if(empty($titulo)) {
            echo "<font color='red'>Campo Titulo Obrigatorio.</font><br/>";
        }
        if(empty($descricao)) {
            echo "<font color='red'>Campo Descricao Obrigatorio.</font><br/>";
        }
    } else {
        //atualizado dados na tabela
        $sql = "UPDATE relatorio SET titulo = :titulo, descricao = :descricao, editado_em = :editado_em WHERE id=:id";

        $query = $conectar->prepare($sql);

        $query->bindparam(':id', $id);
        $query->bindparam(':titulo', $titulo);
        $query->bindparam(':descricao', $descricao);
        $query->bindparam(':editado_em', $editado_data);
        $query->execute();
        //Redirecionado para a pagina de Listagem
        header("Location: ../view/relatorios.php");
    }
}
?>

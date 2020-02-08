
<?php
   include_once("../banco/conexao.php");
   $conectar = getConnection();
?>

<?php
	// pega o ID da URL
	$id = isset($_GET['id']) ? (int) $_GET['id'] : null;
?>

<?php
	
	$relatorio = "SELECT * FROM relatorio WHERE id = '$id' LIMIT 1";
	$resultado_relatorio = $conectar->prepare ($relatorio);
  	$resultado_relatorio->execute();
  	$linha = $resultado_relatorio->fetch(PDO::FETCH_ASSOC);
		
	$pagina = 
		"<html>
			<body>
				<h4>Informações do Relatorio</h4>
				ID: ".$linha['id']."<br>
				Titulo: ".$linha['titulo']."<br>
				Data: ".$linha['created']."<br>
				Editado em: ".$linha['editado_em']."<br>
				Descricao: ".$linha['descricao']."<br>
			</body>
		</html>
		";

//referenciar o DomPDF com namespace
	use Dompdf\Dompdf;

	// include autoloader
	require_once("../view/dompdf/autoload.inc.php");

	//Criando a Instancia
	$dompdf = new DOMPDF();
	
	// Defini o tipo de Papel e sua Orientacao
	$dompdf->setPaper('A4','portrait');

	// Carrega seu HTML
	$dompdf->load_html(' <h1 style="text-align: center;"> Relatorio ID-' . $linha["id"] .' </h1>	' . $pagina .'
		');


	//Renderizar o html
	$dompdf->render();

	//Exibibir a página
	$dompdf->stream(
		"relatorio.pdf", 
		array(
			"Attachment" => false //Para realizar o download somente alterar para true
		)
	);
?>

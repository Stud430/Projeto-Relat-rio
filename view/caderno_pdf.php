<?php
	include_once("../banco/conexao.php");
	$conectar = getConnection();
?>

<?php

	$relatorio = "SELECT * FROM relatorio";
	$resultado = $conectar->prepare($relatorio);
	$resultado->execute();

	$html = "<table align=center>";
	$html .= "<body>";

	while ($consulta = $resultado->fetch(PDO::FETCH_ASSOC)) {
		
	$html .= "<tr>" . "<td>" . "<br><br> ID: " . "</td>" . "<td> <br><br>" . $consulta["id"] . "</td></tr>";
	$html .= "<tr>" . "<td>" . "Título: " . "</td>" . "<td>" . $consulta["titulo"] . "</td></tr>";
	$html .= "<tr>" . "<td>" . "Descricao: " . "</td>" . "<td>" . $consulta["descricao"] . "</td></tr>";
	$html .= "<tr>" . "<td>" . "created: " . "</td>" . "<td>" . $consulta["created"] . "</td></tr>";
	$html .= "<tr>" . "<td>" . "data_desc: " . "</td>" . "<td>" . $consulta["data_desc"] . "</td></tr>";
	$html .= "<tr>" . "<td>" . "editado_em: " . "</td>" . "<td>" . $consulta["editado_em"] . "</td></tr>";
		
	}

	$html .= "</body>";
	$html .= "</table>";

	use Dompdf\Dompdf;

	require_once("../view/dompdf/autoload.inc.php");

	$dompdf = new DOMPDF();
	$dompdf->setPaper('A4','portrait');
	$dompdf->load_html('<h5> Relatórios </h5>' . $html . ' ');
	$dompdf->render();
	$dompdf->stream("descrevendo.pdf",
					 array(
					       "Attachment" => false
					 )
					);

?>
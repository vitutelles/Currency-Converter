<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>conversor de bufunfa</title>
    <link rel="stylesheet" href="style.css">

</head>
<body>

<main>
     <h1>conversor de moeda</h1>
<?php 
    $inicio = date("m-d-Y", strtotime("-7 days "));
    $fim  = date("m-d-Y");


    $url = 'https://olinda.bcb.gov.br/olinda/servico/PTAX/versao/v1/odata/CotacaoDolarPeriodo(dataInicial=@dataInicial,dataFinalCotacao=@dataFinalCotacao)?@dataInicial=\''. $inicio .'\'&@dataFinalCotacao=\''. $fim .'\'&$top=1&$orderby=dataHoraCotacao%20desc&$format=json&$select=cotacaoCompra,dataHoraCotacao';


    $dados = json_decode(file_get_contents($url), true );
   
    $cotação = $dados["value"][0]["cotacaoCompra"];

    $real = $_REQUEST["din"] ?? 0;

    $dólar = $real / $cotação;

    echo "Seus R\$" . number_format($real, 2, ",",".") . " equivalem a US\$" .number_format($dólar, 2, ",","."), " e o dólar hoje esta custando US\$" . number_format($cotação, 2,",","."),".";

?>

<button onclick="javascript:history.go(-1)">Voltar </button>

</main>
    
</body>
</html>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Conversor</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
    <h1>Valores Convertidos</h1>
<main>
    <?php 

        $inicio = date("m-d-Y", strtotime("-7days"));

        $fim = date("m-d-Y");

        $url = 'https://olinda.bcb.gov.br/olinda/servico/PTAX/versao/v1/odata/CotacaoDolarPeriodo(dataInicial=@dataInicial,dataFinalCotacao=@dataFinalCotacao)?@dataInicial=\''.$inicio.'\'&@dataFinalCotacao=\''.$fim.'\'&$top=1&$format=json&$select=cotacaoCompra,dataHoraCotacao';

        // Fetch data from the URL
        $dados = json_decode(file_get_contents($url), true);

        $cotacao = $dados["value"][0]["cotacaoCompra"];
        
        $reais = $_GET["din"] ?? 0; //Pega o valor do formulario preenchido no html

        $converte = $reais / $cotacao; //Uma variavel converte que dive reais e cotação, gerando o valor em dolar.

        $padrao = numfmt_create("pt_BR", NumberFormatter::CURRENCY); //Padrão para as moedas, como um number_format()

        echo " <p> Seus " . numfmt_format_currency($padrao, $reais, "BRL") . " equivalem a " . numfmt_format_currency($padrao, $converte, "USD") . "</p>"; //Exibe as informações de cada variavel, string e paragrafos.

    ?>
    <button onclick="javascript:history.go(-1)">Voltar</button> <!--Botão com historico da pagina anterior-->
</main>
</body>
</html>
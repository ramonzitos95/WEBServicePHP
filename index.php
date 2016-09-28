<?php
include ('./PrevTempo.php');

$objPrevTempo = new PrevTempo();
//Passando para os parametros os dados.
$parametros = $objPrevTempo->Parametros('Rio de Janeiro', 'Rio de Janeiro', 'Brazil', 'pt-br');
//Buscando no google a previsão do tempo
$objPrevTempo->GeneratePrevTempo($parametros);
?>
<html>
<head>
    <title>Previsão do tempo com a API do Google Weather</title>
</head>
<body>
<h1>Previsão do tempo - <?php echo date('d/m/Y'), strtotime($previsao['info'][0]->forecast_date['data']); ?></h1>
<p><b>Cidade: </b> <?php echo utf8_decode($previsao['info'][0]->city['data']); ?> </p>

<h2>O tempo Hoje</h2>
<table>
    <tr>
        <td><img itemprop="image" class="lazy"
                 src="http://www.google.com<?php echo $previsao['atual'][0]->icon['data']; ?>" alt="clima"/></td>
        <td><?php echo $previsao['atual'][0]->condition['data']; ?></td>
    </tr>
</table>

<h2>Nos próximos dias</h2>
<table>
    <?php foreach ($previsao['proximos'] as $item) { ?>
        <tr>
            <td><img itemprop="image" class="lazy" src="https://www.google.com<?php echo $item->icon['data']; ?>"
                     alt="clima"/></td>
            <td><b><?php echo $item->day_of_week['data']; ?></b> - <?php echo $item->condition['data']; ?>
                <?php echo $item->low['data'] ?> / <?php echo $item->high['data']; ?></td>
        </tr>
    <?php } ?>
</table>
</body>
</html>

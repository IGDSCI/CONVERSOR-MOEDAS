<?php 
    $url = "https://economia.awesomeapi.com.br/last/USD-BRL,EUR-BRL,BTC-BRL";
    $conversao = json_decode(file_get_contents($url));
    
    $valor_USD = $conversao->USDBRL->bid;
    $valor_EUR = $conversao->EURBRL->bid;
    $valor_BTC = $conversao->BTCBRL->bid;
    $moedaSelecionada = '';
    if (isset($_POST['valor'])){
        $valor_usuario = $_POST['valor'];
    }

    if (isset($_POST['moedas'])){
        $moedaSelecionada = $_POST['moedas'];
    }
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="css.css">
    <title>Conversão de moedas</title>
</head>
<body>
    <div id="conversor">
        <h1 id="titulo">Conversor de moedas</h1>
        <form action="index.php" method="POST">
            <h1 id="texto-input">Insira o valor em reais</h1>
            <input type="text" name="valor" placeholder="EXP: 5.37"> <h1 id="texto-input">e</h1>
            <br>
            <h1 id="texto-input">Escolha para qual moeda converter</h1>
            <select id="moedas" name="moedas">
                <option value="dolar" name="dolar">Dolár (USD)</option>
                <option value="euro" name="euro">Euro (EUR)</option>
                <option value="bitcoin" name="bitcoin">Bitcoin (BTC)</option>
            </select>
            <input type="submit" value="Converter">
            <br><br>

            <?php 
                switch ($moedaSelecionada) {
                    case 'dolar':
                        $valorConvertido = $valor_usuario / $valor_USD;
                        echo '<h1 id="texto-result">R$' . $valor_usuario . ' para USD -> U$' . number_format($valorConvertido, 2, ',', '.') . '</h1>';
                        break;
                    case 'euro':
                        $valorConvertido = $valor_usuario / $valor_EUR;
                        echo '<h1 id="texto-result">R$' . $valor_usuario . ' para EUR -> €' . number_format($valorConvertido, 2, ',', '.') . '</h1>';
                        break;
                    case 'bitcoin':
                        $valorConvertido = $valor_usuario / $valor_BTC;
                        echo '<h1 id="texto-result">R$' . $valor_usuario . ' para BTC -> BTC ' . $valorConvertido . '</h1>';
                        break;
                    default:
                }
            ?>
            <br><br><br>
        </form>
    </div>
    
    <div id="container">
        <div id="div-dolar">
            <h1 id="h1-dolar">Valor de 1 Dolár hoje: R$<?php echo number_format($valor_USD, 2, ',', '.'); ?></h1>
        </div>
    
        <div id="div-euro">
            <h1>Valor de 1 Euro hoje: R$<?php echo number_format($valor_EUR, 2, ',', '.'); ?></h1>
        </div>

        <div id="div-bitcoin">
            <h1>Valor de 1 Bitcoin hoje: R$<?php echo $valor_BTC; ?></h1>
        </div>
    </div>
   
</body>
</html>
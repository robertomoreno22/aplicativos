<!-- Criado pela Agência Monono em 2019 -->
<!-- Você precisa de um interpretador de PHP para rodar este programa localmente -->
<!-- Se for copiar, adaptar ou distribuir o código, mantenha estas quatro primeiras linhas -->
<!-- Bingo Monono v 2.1 2024 - PHP - Roberto Moreno -->


<?php
session_start();

// Inicializa a sessão se não estiver já inicializada
if (!isset($_SESSION['sorted_numbers'])) {
    $_SESSION['sorted_numbers'] = [];
}

$new_number = null;
$column = '';

// Sorteia um número novo
if (isset($_POST['sortear'])) {
    if (count($_SESSION['sorted_numbers']) < 75) {
        do {
            $new_number = rand(1, 75);
        } while (in_array($new_number, $_SESSION['sorted_numbers']));
        $_SESSION['sorted_numbers'][] = $new_number;
        $column = getColumn($new_number);
    }
}

// Reinicia o jogo
if (isset($_POST['reiniciar'])) {
    $_SESSION['sorted_numbers'] = [];
    $new_number = null;
    $column = '';
}

// Função para verificar se o número foi sorteado
function isSorted($number) {
    return in_array($number, $_SESSION['sorted_numbers']);
}

// Função para determinar a coluna do número sorteado
function getColumn($number) {
    if ($number >= 1 && $number <= 15) {
        return 'B';
    } elseif ($number >= 16 && $number <= 30) {
        return 'I';
    } elseif ($number >= 31 && $number <= 45) {
        return 'N';
    } elseif ($number >= 46 && $number <= 60) {
        return 'G';
    } elseif ($number >= 61 && $number <= 75) {
        return 'O';
    }
    return '';
}
?>

<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <title>Bingo Monono</title>
	<link rel="preconnect" href="https://fonts.googleapis.com">
	<link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
	<link href="https://fonts.googleapis.com/css2?family=Lilita+One&display=swap" rel="stylesheet">	

    <style>
        body {
            display: flex;
            flex-direction: column;
            align-items: center;
            font-family: Arial, sans-serif;
        }
		


		h1 {
		  font-family: Lilita One, sans-serif;
		  font-weight: 10em;
		  color: red;
			border-style: solid;
			border-width: 5px;
			border-color: green;
		  border-style: dashed;
		  border-radius: 20px;
		  padding: 10px;
			}
		
        .header, .footer {
            width: 100%;
            text-align: center;
            margin: 20px 0;
        }
        .container {
            display: flex;
            width: 80%;
            justify-content: space-between;
        }
        .controls, .table-container {
            width: 45%;
        }
        .controls {
            display: flex;
            flex-direction: column;
            align-items: center;
            padding: 20px;
			background-color: #ffffcc;
			border-radius: 20px;
        }
        .controls .sorted-number-display {
			font-family: Lilita One, sans-serif;
            font-size: 10em;
            font-weight: bold;
            color: orange;
            margin-top: 20px;
			-webkit-text-stroke-width: 1px;
			-webkit-text-stroke-color: black;
        }
        .controls form {
            margin: 10px 0;
            display: flex;
            justify-content: center;
            gap: 10px;
        }
        table {
            width: 100%;
            margin: 20px 0;
    		  font-family: Lilita One, sans-serif;
        }
        th, td {
            text-align: center;
            padding: 5px;
        }
        th {
            background-color: orange;
        }
        .number {
            background-color: yellow;
            color: black;
        }
        .sorted-number {
            background-color: red;
            color: white;
			border-color: white;
			border-width: 2px;
			border-radius: 50px;
        }
    </style>
</head>
<body>

<div class="header">
    <h1>BINGO</h1>
</div>

<div class="container">
    <div class="controls">
        <form method="post">
            <button type="submit" name="sortear">Sortear</button>&nbsp;
            <button type="submit" name="reiniciar">Reiniciar</button>
        </form>

        <?php if ($new_number !== null): ?>
            <div class="sorted-number-display" ;  >
                <?php echo $column . ' ' . $new_number; ?>
            </div>
            <script>
                const msg = new SpeechSynthesisUtterance('<?php echo $column . ' ' . $new_number; ?>');
                msg.lang = 'pt-BR';
                msg.voice = speechSynthesis.getVoices().find(voice => voice.lang === 'pt-BR' && voice.name.includes('female'));
                speechSynthesis.speak(msg);
            </script>
        <?php endif; ?>
    </div>

    <div class="table-container">
        <table border="0">
            <tr>
                <th>B</th>
                <th>I</th>
                <th>N</th>
                <th>G</th>
                <th>O</th>
            </tr>
            <?php for ($i = 1; $i <= 15; $i++): ?>
                <tr>
                    <td class="<?php echo isSorted($i) ? 'sorted-number' : 'number'; ?>"><?php echo $i; ?></td>
                    <td class="<?php echo isSorted($i + 15) ? 'sorted-number' : 'number'; ?>"><?php echo $i + 15; ?></td>
                    <td class="<?php echo isSorted($i + 30) ? 'sorted-number' : 'number'; ?>"><?php echo $i + 30; ?></td>
                    <td class="<?php echo isSorted($i + 45) ? 'sorted-number' : 'number'; ?>"><?php echo $i + 45; ?></td>
                    <td class="<?php echo isSorted($i + 60) ? 'sorted-number' : 'number'; ?>"><?php echo $i + 60; ?></td>
                </tr>
            <?php endfor; ?>
        </table>
    </div>
</div>

<div class="footer">
	<a href="https://monono.com.br" target="_blank"><img src="https://monono.com.br/img/monono_150.png" width="100"></a><br>
    &copy; 2019 - <?php echo date("Y"); ?><br>
	Versão 2.1<br>
</div>

</body>
</html>
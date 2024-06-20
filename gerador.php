<?php
function generateBingoCard() {
    $card = [];
    $columns = ['B' => range(1, 15), 'I' => range(16, 30), 'N' => range(31, 45), 'G' => range(46, 60), 'O' => range(61, 75)];

    foreach ($columns as $column => $numbers) {
        shuffle($numbers);
        $card[$column] = array_slice($numbers, 0, 5);
    }

    $card['N'][2] = 'MONONO'; // Espaço especial no centro da coluna N
    return $card;
}

$cards = [];
for ($i = 0; $i < 8; $i++) {
    $cards[] = generateBingoCard();
}
?>

<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <title>Cartelas de Bingo</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 0;
            padding: 0;
            display: flex;
            flex-wrap: wrap;
            justify-content: space-around;
            width: 210mm;
            height: 297mm;
            box-sizing: border-box;
        }
        .card {
            border: 1px solid #000;
            width: 45%;
            margin: 2%;
            padding: 10px;
            box-sizing: border-box;
            position: relative;
        }
        table {
            width: 100%;
            border-collapse: collapse;
            margin-bottom: 10px;
        }
        th, td {
            border: 1px solid #000;
            text-align: center;
            padding: 5px;
            width: 20%;
        }
        th {
            background-color: #f2f2f2;
        }
        .round-number {
            text-align: center;
            margin-bottom: 10px;
        }
        .free-space {
            background: #ccc;
        }
        .footer {
            text-align: center;
            font-size: 0.8em;
            position: absolute;
            bottom: 10px;
            width: 100%;
        }
    </style>
</head>
<body>
    <?php foreach ($cards as $card): ?>
        <div class="card">
            <div class="round-number">Rodada: ______</div>
            <table>
                <thead>
                    <tr>
                        <th>B</th>
                        <th>I</th>
                        <th>N</th>
                        <th>G</th>
                        <th>O</th>
                    </tr>
                </thead>
                <tbody>
                    <?php for ($i = 0; $i < 5; $i++): ?>
                        <tr>
                            <td><?php echo $card['B'][$i]; ?></td>
                            <td><?php echo $card['I'][$i]; ?></td>
                            <td class="<?php echo $card['N'][$i] == 'MONONO' ? 'free-space' : ''; ?>"><?php echo $card['N'][$i] != 'MONONO' ? $card['N'][$i] : 'MONONO'; ?></td>
                            <td><?php echo $card['G'][$i]; ?></td>
                            <td><?php echo $card['O'][$i]; ?></td>
                        </tr>
                    <?php endfor; ?>
                </tbody>
            </table>
            <div class="footer">
                Sorteie o <b>Bingo Monono</b> em <a href="https://curto.link/bingo">https://curto.link/bingo</a>
            </div>
        </div>
    <?php endforeach; ?>
</body>
</html>
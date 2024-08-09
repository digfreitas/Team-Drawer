<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Sorteador de Equipes</title>
    <style>
        body {
            text-align: center;
            margin: 0;
            font-family: 'Gill Sans', 'Gill Sans MT', Calibri, 'Trebuchet MS', sans-serif;
            display: flex;
            flex-direction: column;
            align-items: center;
            justify-content: center;
            min-height: 100vh;
            background-color: #f4f4f4;
        }

        h1 {
            margin-top: 20px;
            font-size: 24px;
        }

        form {
            display: flex;
            flex-direction: column;
            padding: 20px;
            width: 90%;
            max-width: 600px;
            box-sizing: border-box;
        }

        label {
            margin-bottom: 10px;
            font-size: 18px;
        }

        textarea {
            margin-bottom: 15px;
            width: 100%;
            padding: 10px;
            font-size: 16px;
            border: 1px solid #ccc;
            border-radius: 5px;
            box-sizing: border-box;
        }

        input[type="number"],
        input[type="submit"] {
            width: 100%;
            padding: 10px;
            margin-top: 10px;
            box-sizing: border-box;
            border: 1px solid #ccc;
            border-radius: 5px;
            font-size: 16px;
        }

        input[type="submit"] {
            background-color: #007bff;
            color: white;
            border: none;
            cursor: pointer;
        }

        input[type="submit"]:hover {
            background-color: #0056b3;
        }

        #result {
            margin-top: 20px;
            padding: 20px;
            border: 1px solid #888;
            border-radius: 5px;
            background-color: #f8d7da;
            color: #721c24;
            width: 90%;
            max-width: 600px;
            box-sizing: border-box;
        }

        @media (max-width: 600px) {
            h1 {
                font-size: 20px;
            }

            label {
                font-size: 16px;
            }

            textarea,
            input[type="number"],
            input[type="submit"] {
                font-size: 14px;
                padding: 8px;
            }
        }
    </style>
</head>
<body>
    <h1>Bem-vindo ao Sorteador de Equipes</h1>
    <form action="" method="post">
        <label for="nome-pessoas">Informe o nome das pessoas separados por vírgulas:</label>
        <textarea name="nome-pessoas" id="nome-pessoas" rows="4" required></textarea>

        <label for="num-times">Número de equipes:</label>
        <input type="number" name="num-times" id="num-times" min="1" required>

        <input type="submit" value="Sortear">
    </form>

    <?php
    if ($_SERVER['REQUEST_METHOD'] == 'POST') {
        $nomes = isset($_POST['nome-pessoas']) ? $_POST['nome-pessoas'] : '';
        $numTimes = isset($_POST['num-times']) ? intval($_POST['num-times']) : 1;

        $nomesArray = array_map('trim', explode(',', $nomes));
        shuffle($nomesArray);

        $times = array_fill(0, $numTimes, []);

        foreach ($nomesArray as $index => $nome) {
            $times[$index % $numTimes][] = $nome;
        }

        echo '<div id="result">';
        echo "<h1>Resultados do Sorteio</h1>";
        foreach ($times as $i => $time) {
            echo "<h2>Equipe " . ($i + 1) . "</h2><ul>";
            foreach ($time as $nome) {
                echo "<li>" . htmlspecialchars($nome) . "</li>";
            }
            echo "</ul>";
        }
        echo '</div>';
    }
    ?>
</body>
</html>

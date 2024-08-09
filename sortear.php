<?php 

if ($_SERVER['REQUEST_METHOD'] == 'POST') {

    $nomes = isset($_POST['nome-pessoas']) ? $_POST['nome-pessoas'] : '';
    $numTimes = isset($_POST['num-times']) ? intval($_POST['num-times']) : 1;

    $nomesArray = array_map('trim', explode(',', $nomes));
    shuffle($nomesArray);

    $times = array_fill(0, $numTimes, []);

    foreach($nomesArray as $index => $nome) {
        $times[$index % $numTimes][] = $nome;
    }
    
    echo "<h1>Resultados do sorteio</h1>";
    foreach ($times as $i => $time) {
        echo "<h2>Time " . ($i + 1) . "</h2>";
        echo "<ul>";
        foreach ($time as $nome) {
            echo "<li>" . htmlspecialchars($nome) . "</li>";
        }
        echo "</ul>";
    }
} else {
    echo "Método de solicitação não é válido.";
}
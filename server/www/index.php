<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Tic Tac Toe</title>
    <link rel="stylesheet" type="text/css" href="assets/css/style.css">
    <script src="assets/js/script.js" defer></script>
</head>
<body>
    <?php
        $players = ["X", "O"];
        $current = $_POST["current"] ?? 0;
        $next = ($current + 1) % count($players);
        $filled = 0;
        $board = [];
        $win_cases = [
            [0, 1, 2],
            [3, 4, 5],
            [6, 7, 8],
            [0, 3, 6],
            [1, 4, 7],
            [2, 5, 8],
            [0, 4, 8],
            [6, 4, 2],
        ];
            
        function checkWinCase(array $case) {
            global $board;
            $track = $board[$case[0]];
            for($j = 1; $j < 3; $j++) {
                if($track == -1 || $board[$case[$j]] == -1) return -1;
                if($track !== $board[$case[$j]]) return -1;
            }
            return $track;
        }

        for ($i = 0; $i < 9; $i++) {
            $board[$i] = $_POST["block-$i"] ?? -1;
            if($board[$i] !== -1) $filled++;
        }

        foreach($win_cases as $case) {
            $winner = checkWinCase($case);
            if($winner !== -1) break;
        }

        if($winner === -1) {
            echo "<h1>Jogador Atual: ", $players[$next],"</h1>";
        }
    ?>
    <form name="game" action="index.php" method="POST">
        <?php
            echo "<input name=current type=text value=$next>";

            for ($i = 0; $i < 9; $i++) {
                $player = $board[$i];
                $value = $players[$player] ?? "";

                echo ($value != '' || $winner !== -1) ?
                "<div class=block>" .
                    "$value" .
                    "<input name=block-$i type=text value=$player>" .
                "</div>" :
                "<div class=block onclick=makeMove($next,$i)></div>";
            }
        ?>
    </form>
    <?php
        if($filled >= 9 && $winner === -1) echo "<h1>Jogo Empatado</h1>";
        if($winner !== -1) echo "<h1>Vencedor: $players[$winner]</h1>";
        if($filled >= 9 || $winner !== -1) {
            echo "<button class=play-again onclick=restartGame()>Jogue Novamente</button>";
        }
    ?>
</body>

</html>
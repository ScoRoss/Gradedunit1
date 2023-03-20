<?php
session_start();
include("./header.php");
?>

<!DOCTYPE html>
<html>
<head>
    <title>Warhammer Scoreboard</title>
    <link rel="stylesheet" href="CSS/warhammer.css">

    <script src="https://code.jquery.com/ui/1.13.0/jquery-ui.min.js"></script>
    <link rel="stylesheet" href="https://code.jquery.com/ui/1.13.0/themes/smoothness/jquery-ui.css">
    <script>
        $(function() {
            $( "#game_date" ).datepicker();
        });
    </script>
</head>
<body>
<h1>Warhammer Scoreboard</h1>
<form action="./scoreboardform.php" method="post">
    <table>
        <tr>
            <th>Player Name</th>
            <th>Army</th>
            <th>Points</th>
            <th>Kills</th>
            <th>Deaths</th>
        </tr>
        <tr>
            <td><input type="text" name="player1name"></td>
            <td><input type="text" name="player1army"></td>
            <td><input type="number" name="player1points"></td>
            <td><input type="text" name="player1kills"></td>
            <td><input type="text" name="player1deaths"></td>
        </tr>
        <tr>
            <td><input type="text" name="player2name"></td>
            <td><input type="text" name="player2army"></td>
            <td><input type="number" name="player2points"></td>
            <td><input type="text" name="player2kills"></td>
            <td><input type="text" name="player2deaths"></td>
        </tr>
        <!-- Add more rows for additional players as needed -->
        <tr>
            <td><input type="datetime-local" name="game_date" id="game_date"></td>
        </tr>
    </table>
    <br>
    <input type="submit" value="Scoreboard">
</form>
</body>
</html>

<?php
include("./footer.php");
?>

<?php

include("./connectdb.php");
include("./header.php");

// Retrieve all game scores from the scoreboard table
$stmt = $db->prepare("
    SELECT *
    FROM scoreboard
    ORDER BY game_date DESC
");
$stmt->execute();
$game_scores = $stmt->fetchAll();

?>

<table>
    <thead>
    <tr>
        <th>Player 1 Name</th>
        <th>Player 1 Army</th>
        <th>Player 1 Points</th>
        <th>Player 1 Kills</th>
        <th>Player 1 Deaths</th>
        <th>Player 2 Name</th>
        <th>Player 2 Army</th>
        <th>Player 2 Points</th>
        <th>Player 2 Kills</th>
        <th>Player 2 Deaths</th>
        <th>Date</th>
        <th>Highest Score</th>
    </tr>
    </thead>
    <tbody>
    <?php foreach ($game_scores as $score): ?>
        <tr>
            <td><?= $score['player1name'] ?></td>
            <td><?= $score['player1army'] ?></td>
            <td><?= $score['player1points'] ?></td>
            <td><?= $score['player1kills'] ?></td>
            <td><?= $score['player1deaths'] ?></td>
            <td><?= $score['player2name'] ?></td>
            <td><?= $score['player2army'] ?></td>
            <td><?= $score['player2points'] ?></td>
            <td><?= $score['player2kills'] ?></td>
            <td><?= $score['player2deaths'] ?></td>
            <td><?= date('Y-m-d H:i:s', strtotime($score['game_date'])) ?></td>
            <td><?= $score['player1points'] + $score['player2points'] ?></td>
        </tr>
    <?php endforeach; ?>
    </tbody>
</table>

<?php include("./footer.php"); ?>


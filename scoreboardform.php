<?php

session_start();
include("./connectdb.php");

// Check if the form has been submitted
if ($_SERVER['REQUEST_METHOD'] == 'POST') {

    // Get the logged in user's ID from the session
    $user_id = $_SESSION['user_id'];

    // Get the values submitted in the form
    $player1name = $_POST['player1name'];
    $player1army = $_POST['player1army'];
    $player1points = $_POST['player1points'];
    $player1kills = $_POST['player1kills'];
    $player1deaths = $_POST['player1deaths'];
    $player2name = $_POST['player2name'];
    $player2army = $_POST['player2army'];
    $player2points = $_POST['player2points'];
    $player2kills = $_POST['player2kills'];
    $player2deaths = $_POST['player2deaths'];
    $game_date = date('Y-m-d H:i:s', strtotime($_POST['game_date']));

    // Insert the new game score into the scoreboard table
    $stmt = $db->prepare("
        INSERT INTO scoreboard (user_id, player1name, player1army, player1points, player1kills, player1deaths, player2name, player2army, player2points, player2kills, player2deaths, game_date)
        VALUES (:user_id, :player1name, :player1army, :player1points, :player1kills, :player1deaths, :player2name, :player2army, :player2points, :player2kills, :player2deaths, :game_date)
    ");

    $stmt->bindParam(':user_id', $user_id);
    $stmt->bindParam(':player1name', $player1name);
    $stmt->bindParam(':player1army', $player1army);
    $stmt->bindParam(':player1points', $player1points);
    $stmt->bindParam(':player1kills', $player1kills);
    $stmt->bindParam(':player1deaths', $player1deaths);
    $stmt->bindParam(':player2name', $player2name);
    $stmt->bindParam(':player2army', $player2army);
    $stmt->bindParam(':player2points', $player2points);
    $stmt->bindParam(':player2kills', $player2kills);
    $stmt->bindParam(':player2deaths', $player2deaths);
    $stmt->bindParam(':game_date', $game_date);

    if ($stmt->execute()) {
        // If the insert was successful, redirect the user to the scoreboard page
        header("Location: scoreboard.php");
        exit;
    } else {
        // If there was an error with the insert, display an error message
        echo "Error: " . $stmt->errorInfo()[2];
    }
}

?>

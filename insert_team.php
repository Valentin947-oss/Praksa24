<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Add Items to Database</title>
    <link rel="icon" type="image/x-icon" href="Images/logobrowser.jpg">
    <link rel="stylesheet" href="stylee.css">
    <link rel="stylesheet" href="style_insert.css">
    
</head>

<body>
<img class="logo1" src="Images/logoANG.png" alt="">
<nav >
            
            <ul>
              <li><a href="ProektPremierLiga.html" class="nvy">Home</a></li>
              <li><a href="AboutUs.html" class="nvy">About Us</a></li>
              <li><a href="Contact.html" class="nvy">Contact</a></li>
              <li><a href="index.php" class="nvy">2024/25</a></li>
              <li><a href="Insert_team.php" class="nvy">Insert Team</a></li>
              
            </ul>
            
</nav>

<div class="container">
    <h2 class="naslov_insert">Add Items to Database</h2>
    <form action="insert_team.php" method="post">

        <br>
        <br>
        
        <label for="round_number">Match ID:</label><br>
        <input type="number" id="match_id" name="match_id" required><br><br>

        <label for="round_number">Round Number:</label><br>
        <input type="number" id="round_number" name="round_number" required><br><br>

        <label for="home_team_id">Home Team ID:</label><br>
        <input type="number" id="home_team_id" name="home_team_id" required><br><br>
        
        <label for="away_team_id">Away Team ID:</label><br>
        <input type="number" id="away_team_id" name="away_team_id" required><br><br>
        
        <label for="home_team_score">Home Team Score:</label><br>
        <input type="number" id="home_team_score" name="home_team_score" required><br><br>
        
        <label for="away_team_score">Away Team Score:</label><br>
        <input type="number" id="away_team_score" name="away_team_score" required><br><br>
        
        <label for="match_date">Match Date:</label><br>
        <input type="date" id="match_date" name="match_date" required><br><br>
        
        <label for="match_time">Match Time:</label><br>
        <input type="time" id="match_time" name="match_time" required><br><br>
        
        <button type="submit">Add Item</button>
        
        <?php
$servername = "localhost";
$username = "root";
$password = "";
$database = "rezultati";


$conn = new mysqli($servername, $username, $password, $database);


if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}


if ($_SERVER["REQUEST_METHOD"] == "POST") {
   
    
    $match_id= intval($_POST['match_id']);
    $round_number = intval($_POST['round_number']);
    $home_team_id = intval($_POST['home_team_id']);
    $away_team_id = intval($_POST['away_team_id']);
    $home_team_score = intval($_POST['home_team_score']);
    $away_team_score = intval($_POST['away_team_score']);
    $match_date = $_POST['match_date'];
    $match_time = $_POST['match_time'];

   
    
        
       // Insert into statistics table

    
    // Fetch the current maximum round number from the matches table
    $sql_round_number = "SELECT MAX(round_number) AS max_round FROM matches";
    $result = $conn->query($sql_round_number);
    
    if ($result->num_rows > 0) {
        $row = $result->fetch_assoc();
        $next_round_number = $row['max_round'] + 1; // Increment round number
    } else {
        $next_round_number = 1; // Start from round number 1 if no matches are recorded yet
    }

    // Insert into matches table using the incremented round number
    $sql_matches = "INSERT INTO matches (match_id,round_number, home_team_id, away_team_id, home_team_score, away_team_score, match_date, match_time) 
                    VALUES ($match_id,$next_round_number, $home_team_id, $away_team_id, $home_team_score, $away_team_score, '$match_date', '$match_time')";

    if ($conn->query($sql_matches) === TRUE) {
        echo "New record added successfully";
    } else {
        echo "Error inserting into Matches table: " . $conn->error;
    }
    } else {
    echo "Error inserting into Statistics table: " . $conn->error;
    }

$conn->close();
?>
    

    </form>
    <br>
    </div>
    
    <footer class="footer">
        All Rights Reserved - 2024 <br>
        
        <p><a href="#">Privacy Policy</a> | <a href="#">Terms of Service</a></p>
    </footer>
    </body>
</html>
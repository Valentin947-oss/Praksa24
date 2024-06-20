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
<nav >
            
            <ul>
              <li><a href="ProektPremierLiga.html" class="nvy">Home</a></li>
              <li><a href="AboutUs.html" class="nvy">About Us</a></li>
              <li><a href="Contact.html" class="nvy">Contact</a></li>
            </ul>
</nav>
    <h2 class="naslov_insert">Add Items to Database</h2>
    <div class="container">
    <form action="insert_team.php" method="post">
    <form action="insert_team_exec.php" method="post">
    
        <br>
        <br>
        

</head>
<body>
    <h2>Add Items to Database</h2>
    <form action="insert_team.php" method="post">
    <form action="insert_team_exec.php" method="post">

        <br>
        <br>
        <label for="points">Points:</label><br>
        <input type="number" id="points" name="points" required><br><br>
        
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
        </div>

    </form>
    <footer class="footer">
        All Rights Reserved - 2024 <br>
        
        <p><a href="#">Privacy Policy</a> | <a href="#">Terms of Service</a></p>
    </footer>
</body>
</html>
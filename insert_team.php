<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Add Items to Database</title>
</head>
<body>
    <h2>Add Items to Database</h2>
    <form action="insert_team.php" method="post">
    <form action="insert_team_exec.php" method="post">
    
        <select id="team_name" name="team_name" required>
            <option value="">Man.City</option>
            <option value="">Liverpool </option>
            <option value="">Chelsea</option>
            <option value="">Man. Utd</option>
            <option value="">Tottenham</option>
            <option value="">Aston Villa</option>
            <option value="">Southampton</option>
            <option value="">Wolves</option>
            <option value="">Ipswich</option>
            <option value="">West Ham</option>
            <option value="">Crystal Palace</option>
            <option value="">Leicester</option>
            <option value="">Nott'm Forest</option>
            <option value="">Fulham</option>
            <option value="">Bournemount</option>
            <option value="">Arsenal</option>
            <option value="">Newcastle</option>
            <option value="">Brighton</option>
            <option value="">Everton</option>
            <option value="">Brentford</option>
        
        <br>
        <br>
        <label for="points">Points:</label><br>
        <input type="number" id="points" name="points" required><br><br>
        
        <label for="wins">Wins:</label><br>
        <input type="number" id="wins" name="wins" required><br><br>
        
        <label for="draws">Draws:</label><br>
        <input type="number" id="draws" name="draws" required><br><br>
        
        <label for="losses">Losses:</label><br>
        <input type="number" id="losses" name="losses" required><br><br>
        
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
    </form>
</body>
</html>
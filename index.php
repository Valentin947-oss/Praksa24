
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Fixtures | Premier League</title>
    <link rel="icon" type="image/x-icon" href="Images/logobrowser.jpg">
    <link rel="stylesheet" href="stylee.css">
    <link rel="stylesheet" href="style_insert.css">
    <script src="js.js"></script>
</head>
<body>
    <img class="logo1" src="Images/logoANG.png" alt="">
    <nav>
    
    <ul>
        <li><a href="ProektPremierLiga.html" class="nvy">Home</a></li>
        <li><a href="AboutUs.html" class="nvy">About Us</a></li>
        <li><a href="Contact.html" class="nvy">Contact</a></li>
        <li><a href="index.php" class="nvy">2024/25</a></li>
        <li><a href="insert_match.php" class="nvy">Insert Match</a></li>
        <li><a href="insert_team.php" class="nvy">Insert Team</a></li>
    </ul>
    
</nav>
<br>
<br>
    <h1 class="naslov24-25">Results so far season 2024/25</h1>
    <table>
        <thead>
           
        </thead>
        <tbody>
<?php
 $servername="localhost";
 $username="root";
 $password="";
 $database="rezultati";

$conn =new mysqli($servername, $username, $password, $database);


if (!$conn) {
die("Connection failed: " . $conn->connect_error);
}
$sql = "SELECT
    t.team_name,
    t.logo_path,  
    COUNT(m.match_id) AS rounds_played,
    COALESCE(s.wins, 0) AS wins,
    COALESCE(s.draws, 0) AS draws,
    COALESCE(s.losses, 0) AS losses,
    SUM(CASE WHEN m.home_team_id = t.team_id THEN m.home_team_score ELSE m.away_team_score END) AS goals_scored,
    SUM(CASE WHEN m.home_team_id = t.team_id THEN m.away_team_score ELSE m.home_team_score END) AS goals_conceded,
    CASE 
        WHEN SUM(CASE WHEN m.home_team_id = t.team_id THEN m.home_team_score ELSE m.away_team_score END) - 
             SUM(CASE WHEN m.home_team_id = t.team_id THEN m.away_team_score ELSE m.home_team_score END) >= 0
        THEN SUM(CASE WHEN m.home_team_id = t.team_id THEN m.home_team_score ELSE m.away_team_score END) - 
             SUM(CASE WHEN m.home_team_id = t.team_id THEN m.away_team_score ELSE m.home_team_score END)
        ELSE CONCAT('-', ABS(SUM(CASE WHEN m.home_team_id = t.team_id THEN m.home_team_score ELSE m.away_team_score END)
                          - SUM(CASE WHEN m.home_team_id = t.team_id THEN m.away_team_score ELSE m.home_team_score END)))
    END AS goal_difference,
    COALESCE(s.wins, 0) * 3 + COALESCE(s.draws, 0) AS points
FROM Teams t
LEFT JOIN Statisticss s ON t.team_id = s.team_id
LEFT JOIN Matches m ON t.team_id = m.home_team_id OR t.team_id = m.away_team_id
GROUP BY t.team_id, t.team_name, t.logo_path, s.wins, s.draws, s.losses
ORDER BY points DESC, goal_difference DESC;";
$result = $conn->query($sql);
$number=1;
if(!$result)
die("Ivalied query");

echo "
 <tr>
    <th>#</th>
    <th></th>
    <th>TEAM</th>
    <th>GAMES</th>
    <th>WINS</th>
    <th>DRAWS</th>
    <th>LOSSES</th>
    <th>G_SCORED</th>
    <th>G_CONC</th>
    <th>GDF</th>
    <th>POINTS</th>
</tr>";

$number = 1; 

while (($row = $result->fetch_assoc()) && ($number <= 20)) {
    if ($number <= 4) {
        $backgroundClass = '';
        $squareClass = 'square LS';
    } elseif ($number == 5 || $number == 6) {
        $backgroundClass = '';
        $squareClass = 'square LE';
    } elseif ($number == 7) {
        $backgroundClass = '';
        $squareClass = 'square LK';
    } elseif ($number == 18 || $number == 19 || $number == 20) {
        $backgroundClass ='';
        $squareClass='square ISP';
    } else {
        $backgroundClass = 'default-th';
        $squareClass = 'square';
    }
    if ($number >= 8 && $number <= 17) {
        $squareClass='square';
        $textColorClass = 'black-text';
    } else {
        $textColorClass = ''; 
    }

    $logoPath = htmlspecialchars($row['logo_path']);
    echo "
 <tr>
    <td class=''>
        <div class='square $squareClass'>$number</div>
    </td>
    <td>
    <img src='$logoPath' alt='Logo' style='width: 50px; height: 50px;'> 
    </td>
    <td>
     {$row['team_name']}
   </td>
   <td>
    {$row['rounds_played']}
   </td>
   <td>
    {$row['wins']}
   </td>
    <td>
    {$row['draws']}
   </td>
   <td>
    {$row['losses']}
   </td>
   <td>
    {$row['goals_scored']}
   </td>
   <td>
    {$row['goals_conceded']}
   </td>
   <td>
    {$row['goal_difference']}
   </td>
    <td>
    {$row['points']}
   </td>
</tr>
 ";

    $number++;
}
?>
</table>

        <p><div class="square LS"></div>Qualified - Champions League (Group Stage:) 
        <p><div class="square LE"></div>Qualified - Europe League (Group Stage:)
        <p><div class="square LK"></div>Qualified - Europe Conferences League (Group Stage:) 
        <p><div class="square ISP"></div>Relegation - Championship 
        <p>If teams have the same number of points at the end<br> of the season, 
            the placement is decided by <br>goal difference.</p>
    

 
    <?php

$sql = "SELECT
            m.match_id,
            home.team_name AS home_team,
            home.logo_path AS home_logo,  
            away.team_name AS away_team,
            away.logo_path AS away_logo,  
            m.home_team_score,
            m.away_team_score,
            m.match_date,
            m.match_time
        FROM Matches m
        INNER JOIN Teams home ON m.home_team_id = home.team_id
        INNER JOIN Teams away ON m.away_team_id = away.team_id
        ORDER BY m.match_date, m.match_time";

$result = $conn->query($sql);

if ($result->num_rows > 0) {
    
    $weekCount = 0; 
    $previousWeek = 0; 
    
    echo '<div class="Fixcontainer">';
    
    while ($row = $result->fetch_assoc()) {
        // kalkulira kolku kola ima vrz osnova na datumot i satot
        $matchDateTime = strtotime($row['match_date'] . ' ' . $row['match_time']);
        $weekNumber = date('W', $matchDateTime);
        
        // generira  kola
        if ($weekNumber != $previousWeek && $weekCount < 38) {
            $previousWeek = $weekNumber;
            $weekCount++;
            echo '</div>'; // zatvora kolo
            echo '<div class="fixture">';
            echo "<h2>Week $weekCount</h2>";
        }
        
        
        $formattedDateTime = date('d.m.Y H:i', $matchDateTime);
        $homeLogoPath = htmlspecialchars($row['home_logo']);
        $awayLogoPath = htmlspecialchars($row['away_logo']);
        
        //echo "<p>$formattedDateTime | {$row['home_team']} {$row['home_team_score']} - {$row['away_team_score']} {$row['away_team']}</p>";
        echo "<p>$formattedDateTime | <img src='$homeLogoPath' alt='Home Logo' style='width: 30px; height: 30px;'> {$row['home_team']} {$row['home_team_score']} - {$row['away_team_score']} <img src='$awayLogoPath' alt='Away Logo' style='width: 30px; height: 30px;'> {$row['away_team']}</p>";
    }
    
    echo '</div>'; 
    echo '</div>';  
} else {
    echo "0 results";
}

$conn->close();
?>
       
        <footer class="footer">
            All Rights Reserved - 2024 <br>
            
            <p><a href="#">Privacy Policy</a> | <a href="#">Terms of Service</a></p>
        </footer>
</body>
</html>

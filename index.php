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
    <style>
        .modal {
            display: none; 
            position: fixed; 
            z-index: 1; 
            left: 0;
            top: 0;
            width: 100%; 
            height: 100%; 
            overflow: auto;
            background-color: rgb(0,0,0); 
            background-color: rgba(0,0,0,0.4); 
        }

        .modal-content {
            background-color: #fefefe;
            margin: 15% auto; 
            padding: 20px;
            border: 1px solid #888;
            width: 80%; 
        }

        .close {
            color: #aaa;
            float: right;
            font-size: 28px;
            font-weight: bold;
        }

        .close:hover,
        .close:focus {
            color: black;
            text-decoration: none;
            cursor: pointer;
        }
    </style>
</head>
<body>
    <img class="logo1" src="Images/logoANG.png" alt="">
    <nav>
      <div class="nav-container">
          <div class="logo">
              <a href="ProektPremierLiga.html" class="nvy"></a> 
          </div>
          <ul class="nav-links">
              <li><a href="ProektPremierLiga.html" class="nvy">Home</a></li>
              <li><a href="AboutUs.html" class="nvy">About Us</a></li>
              <li><a href="Contact.html" class="nvy">Contact</a></li>
              <li><a href="index.php" class="nvy">2024/25</a></li>
              <li><a href="insert_match.php" class="nvy">Insert Match</a></li>
              <li><a href="insert_team.php" class="nvy">Insert Team</a></li>
          </ul>
          <div class="headerr">
              <form action="logout.php" method="post">
                  <button type="submit" class="logouttt">Logout</button>
              </form>
          </div>
      </div>
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
    COALESCE(s.wins, 1) * 3 + COALESCE(s.draws, 1) AS points
FROM Teams t
LEFT JOIN Statisticss s ON t.team_id = s.team_id
LEFT JOIN Matches m ON t.team_id = m.home_team_id OR t.team_id = m.away_team_id
GROUP BY t.team_id, t.team_name, t.logo_path, s.wins, s.draws, s.losses
ORDER BY points DESC, goal_difference DESC, goals_conceded DESC;";
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
        $squareClass='';
        $textColorClass = 'black-text';
    } else {
        $textColorClass = ''; 
    }
    $logoPath = "Images/".htmlspecialchars($row['logo_path']); 
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
            m.match_datetime
        FROM Matches m
        INNER JOIN Teams home ON m.home_team_id = home.team_id
        INNER JOIN Teams away ON m.away_team_id = away.team_id
        ORDER BY m.match_datetime DESC";

$result = $conn->query($sql);

if ($result->num_rows > 0) {
    
    $matchesByWeek = [];
    
    
    while ($row = $result->fetch_assoc()) {
        $matchDateTime = strtotime($row['match_datetime']);
        $weekNumber = date('W', $matchDateTime);
        
        if (!isset($matchesByWeek[$weekNumber])) {
            $matchesByWeek[$weekNumber] = [];
        }
        $matchesByWeek[$weekNumber][] = $row; // Grupiranje po kola
    }
    // Sortiranje vo obraten redosled-opagacki
    krsort($matchesByWeek); 

    echo '<div class="Fixcontainer">';
    $totalWeeks = count($matchesByWeek);
    $weekCount = $totalWeeks;
    // pecatenje na rasporedot
    foreach ($matchesByWeek as $weekNumber => $matches) {
        echo '<div class="fixture">';
        echo "<h2>Week $weekCount</h2>"; // Tekovno kolo
        // Grupiranje po 10 utakmici vo kolo
        $matchesToDisplay = array_slice($matches, 0, 10);
        if (!empty($matchesToDisplay)) {
            foreach ($matchesToDisplay as $match) {
                $matchDateTime = strtotime($match['match_datetime']);
                $formattedDateTime = date('d.m.Y H:i', $matchDateTime);
                $homeLogoPath = "Images/" . htmlspecialchars($match['home_logo']);
                $awayLogoPath = "Images/" . htmlspecialchars($match['away_logo']);
                
                echo "<p>$formattedDateTime |<br> <img src='$homeLogoPath' alt='Home Logo' style='width: 30px; height: 30px;'> {$match['home_team']} {$match['home_team_score']} - {$match['away_team_score']} <img src='$awayLogoPath' alt='Away Logo' style='width: 30px; height: 30px;'> {$match['away_team']} <br>
                <a href='javascript:void(0);' class='edit-button' onclick='openMatchModal({$match['match_id']}, \"" . date('Y-m-d\TH:i', $matchDateTime) . "\", {$match['home_team_score']}, {$match['away_team_score']});'>Edit</a>
                <a href='index.php?action=delete&match_id={$match['match_id']}' class='delete-button' onclick='return confirm(\"Are you sure you want to delete this match?\");'>Delete</a>
            </p>";

            }
        } else {
            echo "<p>No matches for this week.</p>";
        }
        echo '</div>'; 
        $weekCount--; 
    }
    echo '</div>'; 
} else {
    echo "0 results";
}
if (isset($_GET['action']) && $_GET['action'] == 'delete' && isset($_GET['match_id'])) {
    $match_id = $_GET['match_id'];

    $stmt = $conn->prepare("SELECT home_team_id, away_team_id, home_team_score, away_team_score FROM Matches WHERE match_id = ?");
    if ($stmt) {
        $stmt->bind_param("i", $match_id);
        $stmt->execute();
        $stmt->store_result();
        
        if ($stmt->num_rows > 0) {
            $stmt->bind_result($home_team_id, $away_team_id, $home_team_score, $away_team_score);
            $stmt->fetch();
        } else {
            echo "Match not found.";
            $stmt->close();
            exit;
        }
        $stmt->close();
    } else {
        echo "Error preparing statement: " . $conn->error;
        exit;
    }
    $stmt = $conn->prepare("DELETE FROM Matches WHERE match_id = ?");
    if ($stmt) {
        $stmt->bind_param("i", $match_id);
        if ($stmt->execute()) {
            
            echo "Match deleted successfully";

            updateTeamStatsAfterDeletion($conn, $home_team_id, $home_team_score, $away_team_score);
            updateTeamStatsAfterDeletion($conn, $away_team_id, $away_team_score, $home_team_score);
        } else {
            echo "Error deleting match: " . $stmt->error;
        }
        $stmt->close();
    } else {
        echo "Error preparing statement: " . $conn->error;
    }
}
function updateTeamStatsAfterDeletion($conn, $team_id, $home_team_score, $away_team_score) {
   
    $sql = "SELECT wins, draws, losses, points FROM team_stats WHERE team_id = '$team_id'";
    $result = $conn->query($sql);

    if ($result->num_rows > 0) {
        $row = $result->fetch_assoc();
        
        // Initialize stats
        $wins = $row['wins'];
        $draws = $row['draws'];
        $losses = $row['losses'];
        $points = $row['points'];

        if ($home_team_score > $away_team_score) {
            $wins--; 
            $points -= 3; 
        } elseif ($home_team_score < $away_team_score) {
            $losses--; 
        } else {
            $draws--;  
            $points--;  
        }
        // Update the database
        $sql_update = "UPDATE team_stats SET wins = '$wins', draws = '$draws', losses = '$losses', points = '$points' WHERE team_id = '$team_id'";
        if ($conn->query($sql_update) === FALSE) {
            echo "Error updating stats: " . $conn->error;
        }
    } else {
        echo "No stats found for team ID: $team_id";
    }
}

if (isset($_POST['edit_match_button'])) {
    $match_id = $_POST['match_id'];
    $home_team_score = $_POST['home_score'];
    $away_team_score = $_POST['away_score'];
    $match_datetime = $_POST['match_datetime'];
   
     if (filter_var($match_id, FILTER_VALIDATE_INT) && 
        filter_var($home_team_score, FILTER_VALIDATE_INT) && 
        filter_var($away_team_score, FILTER_VALIDATE_INT) && 
        
        !empty($match_datetime)) {
        
        $sql = "UPDATE Matches SET home_team_score = ?, away_team_score = ?, match_datetime = ? WHERE match_id = ?";
        $stmt = $conn->prepare($sql);
        if ($stmt) {
            $stmt->bind_param("iisi", $home_team_score, $away_team_score, $match_datetime, $match_id);

            if ($stmt->execute()) {
                echo '<script>alert("Match updated successfully."); window.location.href = "index.php";</script>';
            } else {
                echo "Error updating match: " . htmlspecialchars($stmt->error);
            }
            $stmt->close();
        } else {
            echo "Error preparing statement: " . htmlspecialchars($conn->error);
        }
    } else {
        echo "Invalid input.";
    }
}
function updateTeamStats($conn, $team_id, $team_score, $opponent_score) {
    $sql = "SELECT wins, draws, losses, points FROM team_stats WHERE team_id = '$team_id'";
    $result = $conn->query($sql);
    if ($result->num_rows > 0) {
        $row = $result->fetch_assoc();

        $wins = $row['wins'];
        $draws = $row['draws'];
        $losses = $row['losses'];
        $points = $row['points'];

        if ($team_score > $opponent_score) {
            $wins++;
            $points += 3;
        } elseif ($team_score < $opponent_score) {
            $losses++;
        } else {
            $draws++;
            $points++;
        }

        $sql_update = "UPDATE team_stats SET wins = '$wins', draws = '$draws', losses = '$losses', points = '$points' WHERE team_id = '$team_id'";
        if ($conn->query($sql_update) === FALSE) {
            echo "Error updating stats: " . $conn->error;
        }
    } else {
    
        echo "No stats found for team ID: $team_id";
    }
}
$conn->close();
?>
<div id="editMatchModal" class="modal">
    <div class="modal-content">
        <span class="close" onclick="closeMatchModal()">&times;</span>
        <h2>Edit Match</h2>
        <form action="index.php" method="post">
            <input type="hidden" name="match_id" id="match_id" value="<?php echo htmlspecialchars($match_id); ?>">
            <label>Match Date & Time:</label> <br>
            <input type="datetime-local" name="match_datetime" id="match_datetime" value="<?php echo htmlspecialchars($match_datetime); ?>" required> <br>
            <label>Home Team Score:</label>
            <input type="number" name="home_score" id="home_score" value="<?php echo htmlspecialchars($home_score); ?>" required> <br>
            <label>Away Team Score:</label>
            <input type="number" name="away_score" id="away_score" value="<?php echo htmlspecialchars($away_score); ?>" required>
            <button type="submit" name="edit_match_button">Update Match</button>
        </form>
    </div>
</div>
<footer class="footer">
    All Rights Reserved - 2024 <br>
    <p><a href="#">Privacy Policy</a> | <a href="#">Terms of Service</a></p>
</footer>
<script>
    function openMatchModal(matchId, matchDateTime, homeScore, awayScore) {
        document.getElementById('match_id').value = matchId;
        document.getElementById('match_datetime').value = matchDateTime;
        document.getElementById('home_score').value = homeScore;
        document.getElementById('away_score').value = awayScore;
        document.getElementById('editMatchModal').style.display = "block";
    }
    function closeMatchModal() {
        document.getElementById('editMatchModal').style.display = "none";
    }
</script>
</body>
</html>
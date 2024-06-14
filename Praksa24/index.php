<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Fixtures | Premier League</title>
    <link rel="icon" type="image/x-icon" href="Images/logobrowser.jpg">
    <link rel="stylesheet" href="stylee.css">
</head>
<body>
    <img class="logo1" src="Images/logoANG.png" alt="">
    <nav>
    <ul>
        <li><a href="ProektPremierLiga.html" class="nvy">Home</a></li>
        <li><a href="AboutUs.html" class="nvy">About Us</a></li>
        <li><a href="Contact.html" class="nvy">Contact</a></li>
      </ul>
    </nav>
    <h2 class="naslov24-25">Results so far season 24/25</h2>
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


$sql = "SELECT teams.team_name, matches.round_number,statisticss.wins,statisticss.draws,statisticss.losses,teams.points
 FROM teams, matches,statisticss  ";
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
    <th>LOSES</th>
    <th>GOALS</th>
    <th>GD</th>
    <th>POINTS</th>
</tr>";

$number = 1; 

while (($row = $result->fetch_assoc()) && ($number <= 20)) {
    echo "
 <tr>
   <td>
    $number.
   </td>
   <td>
   </td>
   <td>
     {$row['team_name']}
   </td>
   <td>
    {$row['round_number']}
   </td>
   <td>
    {$row['wins']}
   </td>
   <td>
    {$row['losses']}
   </td>
   <td>
    {$row['draws']}
   </td>
</tr>
 ";

    $number++;
}
?>
        
        </table>
        
    <div class="Fixcontainer">
        
        <div class="fixture">
            <h2>Week 1</h2>
            <p>17.08.2024  13.30 | Liverpool 2 - 1 Brentford</p>
            <p>17.08.2024  16.00 | Man. City 1 - 1 Everton</p>
            <p>17.08.2024  16.00 | Chelsea 2 - 0 Bournemount</p>
            <p>17.08.2024  16.00 | Southampton 1 - 0 Arsenal</p>
            <p>17.08.2024  16.00 | Man United 1 - 1 Fulham</p>
            <p>17.08.2024  18.30 | Tottenham 2 - 1 Newcastle</p>
            <p>18.08.2024  13.00 | Aston Villa 1 - 0 Brighton</p>
            <p>18.08.2024  15.00 | Wolves 1 - 0 Ipswich</p>
            <p>18.08.2024  15.00 | Cry. Palace 1 - 1 West Ham</p>
            <p>18.08.2024  17.30 | Leicester 0 - 0 Nott. forest</p>
        </div>
        <div class="fixture">
            <h2>Week 2</h2>
            <p>24.08.2024  13.30 | Everton 1 - 2 Chelsea</p>
            <p>24.08.2024  16.00 | Bournemount 0 - 2 Southampton </p>
            <p>24.08.2024  16.00 | Arsenal 0 - 1 Man. United</p>
            <p>24.08.2024  16.00 | Fulham 0 - 0 Tottenham</p>
            <p>24.08.2024  16.00 | Newcastle 1 - 2 Aston Villa</p>
            <p>24.08.2024  18.30 | Liverpool 1 - 0 Man. City</p>
            <p>25.08.2024  13.00 | Brighton 1 - 1 Wolves</p>
            <p>25.08.2024  15.00 | Ipswich 1 - 1 Crystal Palace</p>
            <p>25.08.2024  15.00 | West Ham 2 - 1 Leicester City</p>
            <p>25.08.2024  17.30 | Nott. forest 0 - 1 Brentford</p>
        </div>
        <div class="fixture">
            <h2>Week 3</h2>
            <p>31.08.2024  13.30 | Man City 3 - 1 Chelsea</p>
            <p>31.08.2024  16.00 | Liverpool 2 - 0 Southampton</p>
            <p>31.08.2024  16.00 | Everton 1 - 1 Arsenal</p>
            <p>31.08.2024  16.00 | Bournemount 1 - 1 Man United</p>
            <p>31.08.2024  16.00 | Fulham 0 - 0 Wolves</p>
            <p>31.08.2024  18.30 | Newcastle 1 - 1 Brighton</p>
            <p>01.09.2024  13.00 | Crystal Palace 1 - 0 Ipswich</p>
            <p>01.09.2024  15.00 | Tottenham 2 - 0 Nott. forest</p>
            <p>01.09.2024  15.00 | Aston Villa 1 - 2 West Ham</p>
            <p>01.09.2024  17.30 | Leicester City 1 - 1 Brentford</p>
        </div>
        <div class="fixture">
            <h2>Week 4</h2>
            <p>13.09.2024  13.30 | Liverpool 2 - 2 Man. United</p>
            <p>13.09.2024  16.00 | Man. City 1 - 1 Everton</p>
            <p>13.09.2024  16.00 | Chelsea 3 - 0 Bournemount</p>
            <p>13.09.2024  16.00 | Southampton 2 - 1 Arsenal</p>
            <p>13.09.2024  16.00 | Tottenham 1 - 0 Fulham</p>
            <p>13.09.2024  18.30 | Aston Villa 0 - 0 Newcastle</p>
            <p>14.09.2024  13.00 | Wolves 2 - 1 Crystal Palace </p>
            <p>14.09.2024  15.00 | Ipswich 1 - 2 West Ham</p>
            <p>14.09.2024  15.00 | Nott. forest 0 - 2 Leicester City </p>
            <p>14.09.2024  18.30 | Brentford 1 - 1 Brighton</p>
        </div>
        <footer class="footer">
            All Rights Reserved - 2024 <br>
            
            <p><a href="#">Privacy Policy</a> | <a href="#">Terms of Service</a></p>
        </footer>
</body>
</html>

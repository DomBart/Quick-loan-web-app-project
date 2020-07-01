<?php
include("include/session.php");
if ($session->logged_in) {
    ?>
    <html>
        <head>
		<style>
		</style>
            <meta http-equiv="X-UA-Compatible" content="IE=9; text/html; charset=utf-8"/> 
            <title>Įmokų grafikas</title>
            <link href="include/styles.css" rel="stylesheet" type="text/css" />
        </head>
        <body>
            <table class="center"><tr><td>
                        <img src="pictures/top.png"/>
                    </td></tr><tr><td> 
                        <?php
                        include("include/meniu.php");
                        ?>              
                        <table style="border-width: 2px; border-style: dotted;"><tr><td>
                                    Atgal į [<a href="index.php">Pradžia</a>]
                                </td></tr></table>               
                        <br> 
                        <div style="text-align: center;color:green">                   
                            <h1>Įmokų grafikas</h1>
                                               
                        </div> 
						<?php
						$con = mysql_connect("localhost","root","");

                    if (!$con)
                    { 
                    die('Could not connect: ' . mysql_error());
                    }
                    mysql_select_db("projektas", $con);

$result = mysql_query("SELECT balance FROM fondas");
					$row = mysql_fetch_array($result);
					$balansas=$row["balance"];
$result = mysql_query("SELECT laikotarpis FROM `users` WHERE username='". $_SESSION['username']."' limit 1;");
$row = mysql_fetch_array($result);
$laikotarpis = $row["laikotarpis"];
$result = mysql_query("SELECT imoka FROM `users` WHERE username='". $_SESSION['username']."' limit 1;");
$row = mysql_fetch_array($result);
$imoka = $row["imoka"];
$result = mysql_query("SELECT data FROM `users` WHERE username='". $_SESSION['username']."' limit 1;");
$row = mysql_fetch_array($result);
$data = date_create_from_format('Y-m-d', $row["data"]);
$pradine = date_create_from_format('Y-m-d', $row["data"]);
$result = mysql_query("SELECT skola FROM `users` WHERE username='". $_SESSION['username']."' limit 1;");
$row = mysql_fetch_array($result);
$skola = $row["skola"];
$style = "display:none;";
if($skola < 2*$imoka && $skola != 0)
{
	$imoka = $skola;
	$laikotarpis = 1;
}
if($skola > 0)
{
$style = "";
echo "<h2 style='text-align:center'>Jūsų mėnesine imoka - ". $imoka. " eur</h2>";
echo "<h2 style='text-align:center'>Jūsų skolos likutis - ". $skola. " eur</h2>";
echo "<table border =\"1\" style='border-collapse: collapse; margin-left:auto; margin-right:auto;'>";
echo "<th>Data</th>\n <th>Įmoka</th>\n";	
	for ($row=1; $row <= $laikotarpis; $row++) { 
		echo "<tr> \n";
		for ($col=1; $col <= 1; $col++) {		
		   echo "<td>".$data->format('Y-m-d')."</td> \n";
		   date_modify($data, '+1 month');
		   	}
		for ($col=2; $col <= 2; $col++) { 
		   echo "<td>".$imoka." eur</td> \n";
		   	}
	  	    echo "</tr>";
		}
		echo "</table>";
}
else echo "<h2 style='text-align:center'>Jūs neturite įsiskolinimų</h2>";
?>		
<div style='text-align:center; margin-top:15px; margin-left:auto; margin-right:auto; <?php echo $style;?>'>
<form method="post"> 
<input type='submit' name='moketi' value='Mokėti įmoka' class='btnbtn-default'>
</form>
</div>
<?php
     if (isset($_POST['moketi']))
     {
		 if($skola > 0)
		 {
	     date_modify($pradine, '+1 month');
		 $skola = $skola - $imoka;
		 $balansas = $balansas + $imoka;
		 $laikotarpis = $laikotarpis - 1;
		 mysql_query("UPDATE users SET data='". $pradine->format('Y/m/d').".00' WHERE username='". $_SESSION['username']."';");
		 mysql_query("UPDATE users SET skola='". $skola.".00' WHERE username='". $_SESSION['username']."';");
		 mysql_query("UPDATE users SET laikotarpis='". $laikotarpis.".00' WHERE username='". $_SESSION['username']."';");
		 mysql_query("UPDATE fondas SET balance='". $balansas."';");
		 header("Location:operacija1.php");
		 }
     }
?>
                        <br>                
                <tr><td>
                        <?php
                        include("include/footer.php");
                        ?>
                    </td></tr>      
            </table>
        </body>
    </html>
    <?php
    //Jei vartotojas neprisijungęs, užkraunamas pradinis puslapis  
} else {
    header("Location: index.php");
}
?>
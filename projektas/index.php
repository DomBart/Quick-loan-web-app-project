<?php
include("include/session.php");
?>
<html>
<style>
label{
    display: inline-block;
    float: left;
    clear: left;
    width: 250px;
    text-align: right;
	margin-right: 10px;
	align: center;
}
input {
  display: inline-block;
  float: left;
  align: center;
  margin-bottom: 5px;
  margin-right: 10px;
}
</style>
    <head>
        <meta http-equiv="X-UA-Compatible" content="IE=9; text/html; charset=utf-8"/>
        <title>Demo projektas</title>
        <link href="include/styles.css" rel="stylesheet" type="text/css" />
    </head>
    <body>             
        <table class="center" ><tr><td>
            <center><img src="pictures/top.png"/></center>
        </td></tr><tr><td>  
            <?php
            //Jei vartotojas prisijungęs
            if ($session->logged_in) {
                include("include/meniu.php");
                ?>
                <div style="text-align: center;color:green">
                    <br><br>
                    <h1>Greita paskola</h1>
					<table class="table table-striped">
            <div align='center'>
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
					echo "Fondas: " . $row["balance"];
					?>
			    <div style="align:center;">
                <form method='post'>
                    <div class="form-group col-lg-4" >
					    <label for="vardas" class="control-label">Vardas</label>
                        <input name='vardas' type='text' id='vardas' class="form-control input-sm" required oninvalid="this.setCustomValidity('Įveskite vardą')"
                         oninput="setCustomValidity('')">
						<label for="pavarde" class="control-label">Pavardė</label>
                        <input name='pavarde' type='text' id='vardas' class="form-control input-sm" required oninvalid="this.setCustomValidity('Įveskite pavardę')"
                         oninput="setCustomValidity('')">
						<label for="sask" class="control-label">Banko sąskaitos numeris</label>
                        <input name='sask' type='text' id='sask' class="form-control input-sm" required oninvalid="this.setCustomValidity('Įveskite tinkamą banko sąskaitos numerį')"
                         oninput="setCustomValidity('')">
                        <label for="suma" class="control-label">Reikiama pinigu suma</label>
                        <input type="text" name="suma" class="form-control input-sm" required oninvalid="this.setCustomValidity('Įveskite tinkamą pinigų sumą')"
                         oninput="setCustomValidity('')">
                    <p>
                    Paskolos gražinimo laikotarpis
                    <select name="laikotarpiai">
                       <option value="6">6 mėn.</option>
                       <option value="12">12 mėn.</option>
                       <option value="24">24 mėn.</option>
                       <option value="36">36 mėn.</option>
                       <option value="48">48 mėn.</option>
                    </select>
                    </p>
                    </div>
                    <div class="form-group col-lg-8" style="text-align:center">
                        <input type='submit' name='ok' value='Siųsti' class="btnbtn-default">
					</div>
                </form>
				<?php
				if (isset($_POST['ok']))
                {
				  $result = mysql_query("SELECT skola FROM `users` WHERE username='". $_SESSION['username']."' limit 1;");
				  $row2 = mysql_fetch_array($result);
                  $skola = $row2["skola"];
				  $suma = $_POST['suma'];
				  $reikiama = $suma;
				  $laikotarpis = $_POST['laikotarpiai'];
				  $naujas = $row["balance"] - $suma;
				  if($laikotarpis == 6)
				  {
				      $suma = $suma * 1.10;
					  $imoka = ($suma) / $laikotarpis;
				  }
				  else if($laikotarpis == 12)
				  {
					  $suma = $suma * 1.15;
					  $imoka = ($suma) / $laikotarpis;
				  }
				   else if($laikotarpis == 24)
				   {
					  $suma = $suma * 1.20;
					  $imoka = ($suma) / $laikotarpis;
				   }
				   else if($laikotarpis == 36)
				   {
					  $suma = $suma * 1.25;
					  $imoka = ($suma) / $laikotarpis;
				   }
				   else
				   {
					  $suma = $suma * 1.30;
					  $imoka = ($suma) / $laikotarpis;
				   }
				  if (isset($_POST["suma"]))
				  {
					if ( $row["balance"] >= $reikiama)
					{
						if ($reikiama < 0)
						{
							echo "<div style='color:red;'>Įvesta neigiama pinigų suma</div>";
						}
						else if($skola == 0)
						{
                        mysql_query("UPDATE fondas SET balance='". $naujas."';");
						mysql_query("UPDATE users SET skola='". $suma.".00' WHERE username='". $_SESSION['username']."';");
						mysql_query("UPDATE users SET laikotarpis='". $laikotarpis.".00' WHERE username='". $_SESSION['username']."';");
						mysql_query("UPDATE users SET imoka='". $imoka.".00' WHERE username='". $_SESSION['username']."';");
						mysql_query("UPDATE users SET data='". date("Y/m/d").".00' WHERE username='". $_SESSION['username']."';");
						header("Location:operacija1.php");
						}
						else echo "<div style='color:red;'>Negrąžinta skola</div>";
					}
					else echo "<div style='color:red;'>Viršytas limitas</div>";
				  }
                }
                ?>
            </div>
        </table>
                </div><br>
                <?php
                //Jei vartotojas neprisijungęs, rodoma prisijungimo forma
                //Jei atsiranda klaidų, rodomi pranešimai.
            } else {
                echo "<div align=\"center\">";
                if ($form->num_errors > 0) {
                    echo "<font size=\"3\" color=\"#ff0000\">Klaidų: " . $form->num_errors . "</font>";
                }
                echo "<table class=\"center\"><tr><td>";
                include("include/loginForm.php");
                echo "</td></tr></table></div><br></td></tr>";
            }
            echo "<tr><td>";
            include("include/footer.php");
            echo "</td></tr>";
            ?>
        </td></tr>
</table>
</body>
</html>
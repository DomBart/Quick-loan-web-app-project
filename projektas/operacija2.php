<?php
include("include/session.php");
if ($session->logged_in) {
    ?>
    <html>
        <head>  
            <meta http-equiv="X-UA-Compatible" content="IE=9; text/html; charset=utf-8"/> 
            <title>Operacija2</title>
            <link href="include/styles.css" rel="stylesheet" type="text/css" />
        </head>
        <body>
            <table class="center" >
                <tr><td>
                        <img src="pictures/top.png"/>
                    </td></tr><tr><td> 
                        <?php
                        //Jei vartotojas prisijungęs
                        ?>
                        <table style="border-width: 2px; border-style: dotted;"><tr><td>
                                    Atgal į [<a href="index.php">Pradžia</a>]
                                </td></tr></table>               
                        <br> 
                        <div style="text-align: center;color:green">                   
                            <h1>Operacija 2.</h1>
                            Nerodomas meniu, rodoma nuoroda į pradžią.                   
                        </div> 
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
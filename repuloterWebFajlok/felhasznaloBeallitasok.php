<!DOCTYPE html>
<html lang="hu">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="icon" href="./kepek/plane.png" type="image/png" sizes="16x16">
    <title>Módosítás</title>
    <?php
    require_once "kapcsolat.php";

    ?>
</head>
<body class="bejReg">

<?php
    require_once('header.php');
  ?>

<div class="container bejRegHatter">
        <div class="row">

            <form action="#" method="POST" id="bejelent">
                <table class="bejRegTable">
                    <tr><td colspan="2"><label for="keres"><h1>Kérem töltse ki a modosítani kívánt adatot</h1></label></td></tr>
                    <tr><td>Jelszó: </td> <td> <input type="password" name="jelszo" id="jelszo" class="inputokBejReg"></td></tr>
                    <tr><td>Jelszó újra: </td> <td> <input type="password" name="ujraJelszo" id="ujraJelszo" class="inputokBejReg"></td></tr>
                    <tr><td>Mobiltelefonszám: </td> <td> <input type="number" name="mobil" id="mobil" class="inputokBejReg"></td></tr>
                    <tr><td>Email cím: </td> <td> <input type="text" name="email" id="email" class="inputokBejReg"></td></tr><tr><td></td><td></td></tr>

                    <tr><td><input type="Submit" name="Submit" id="Submit" value="Módosítás"  class="inputokBejReg  pointer"></td>
                    <td><input type="Submit" name="TorlesGomb" id="TorlesGomb" value="Fiók törlése"  class="inputokBejReg  pointer"></td></tr>
                    
                </table>
            </form>
        </div>
</div>
</body>

<?php

$jelszo = $_POST["jelszo"];
$ujraJelszo = $_POST["ujraJelszo"];
$mobil = $_POST["mobil"];
$email = $_POST["email"];

$feltetelJelszo = "/^(?=.*[a-z])(?=.*[A-Z])(?=.*[a-zA-Z]).{8,}$/";
$feltetelMobil = "/^06[0-9]+[0-9]{7,8}$/";
$feltetelEmail = "/\b[\w\.-]+@[\w\.-]+\.\w{2,4}\b/";
$vanMegEgyIlyenFelh = 0;
$vanMegEgyIlyenEmail = 0;

$update = array();
$updateString = "UPDATE `utas` SET ";

$hashjelszo = password_hash($jelszo . $_SESSION['felhasznaloNev'], PASSWORD_DEFAULT);

    if(isset($_POST["Submit"])){

            if ($result = $con->query("SELECT `email` FROM `utas`")) {
                
                $tabla = $result->fetch_all();

                foreach($tabla as $sor){
                    foreach ($sor as $elem) {
                        if ($elem == $email) {
                            $vanMegEgyIlyenEmail = True;
                        }
                    }    
                }
        
                $result->free();
            }else{
                die("Hiba történt!");
            }

        $boolJelszo = $jelszo == "" || str_replace(" ", "", $jelszo) == "" ? true : preg_match($feltetelJelszo, $jelszo);
        $boolMobil = $mobil == "" || str_replace(" ", "", $mobil) == "" ? true : preg_match($feltetelMobil, $mobil);
        $boolEmail = $email == "" || str_replace(" ", "", $email) == "" ? true : preg_match($feltetelEmail, $email);

    if ($boolJelszo  && $boolMobil  && $boolEmail  &&
        $vanMegEgyIlyenEmail != True &&
        $ujraJelszo == $jelszo){

        $con->query('SET foreign_key_checks = 0');
            
        if ($jelszo != "" || str_replace(" ", "", $jelszo) != "" ) {array_push($update, '`jelszo` = "'. $jelszo .'"');}

        if ($mobil != "" || str_replace(" ", "", $mobil) != "" ) {array_push($update, '`mobiltelefonszam` = "'. $mobil .'"');}

        if ($email != "" || str_replace(" ", "", $email) != "" ) {array_push($update, '`email` = "'. $email .'"');}

        if (count($update) > 0) {


            for ($i=0; $i < count($update); $i++) { 
                if ($i + 1 < count($update)) { $updateString .= $update[$i] .' , ';}else{$updateString .= $update[$i] .' WHERE `utas`.`felhasznalonev` = "'.$_SESSION['felhasznaloNev'].'";';}
            }
        }
        
        if ($updateString != "") {
            if ($query = $con -> query($updateString)) {
                echo '<script>alert("Sikeres módosítás")</script>';
                echo '<span style="color:green;">Sikeres módosítás!</span>';
                echo "<br><br><br><br>";  

            }else{
                echo '<script>alert("Sikertelen módosítás")</script>';
                echo '<span style="color:red;">Sikertelen módosítás!</span>';
                echo "<br><br><br><br>";
            }
        }else{
            echo '<script>alert("Kérem adja meg a módosítandó helyre a módosítandó adatot.")</script>';
            echo '<span style="color:orange;">Sikertelen módosítás!</span>';
        }
    }else{
        echo '<script>alert("Kérem adja meg a módosítandó helyre a módosítandó adatot.")</script>';
        echo '<span style="color:orange;">Sikertelen módosítás!</span>';
    }
}

    if(isset($_POST['TorlesGomb'])){
        if($con -> query('DELETE FROM `utas` WHERE `utas`.`felhasznalonev` = "'.$_SESSION['felhasznaloNev'].'"')){
            require_once('./kijelentkezes.php');
        }else{
            echo '<script>alert("Sikertelen fiók törlés! Ha van megrendelt jegye akkor azt törölje!")</script>';
            echo '<span style="color:red;">Sikertelen fiók törlés! <br><br> Ha van megrendelt jegye akkor azt törölje!</span>';
        }
    }

?>

<?php
    require_once('footer.php');
?>
</html>
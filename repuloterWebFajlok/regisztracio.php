<!DOCTYPE html>
<html lang="hu">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="icon" href="./kepek/plane.png" type="image/png" sizes="16x16">
    <title>Regisztráció</title>
    <?php
    require_once "kapcsolat.php";
    error_reporting(0);

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
                    <tr><td colspan="2"><label for="Regisztracio"><h1>Regisztráció</h1></label></td></tr>
                    <tr><td >Írja be a vezetéknevét: </td> <td> <input type="text" name="vezetekNev" id="vezetekNev" class="inputokBejReg"></td></tr>
                    <tr><td>Írja be a keresztnevét: </td> <td> <input type="text" name="keresztNev" id="keresztNev" class="inputokBejReg"></td></tr>
                    <tr><td>Válassza ki a születési dátumát: </td> <td>  <input type="date" name="szulido" id="szulido" class="inputokBejReg"><br></td></tr>
                    <tr><td>Írjon be egy tetszőleges felhasználónevet: </td> <td> <input type="text" name="felhasznaloNev" id="felhasznaloNev" class="inputokBejReg"></td></tr>
                    <tr><td>Írjon be egy tetszőleges jelszót: </td> <td> <input type="password" name="jelszo" id="jelszo" class="inputokBejReg"></td></tr>
                    <tr><td>Írja be újra a jelszót: </td> <td> <input type="password" name="ujraJelszo" id="ujraJelszo" class="inputokBejReg"></td></tr>
                    <tr><td>Írja be a mobiltelefonszámát: </td> <td> <input type="number" name="mobil" id="mobil" class="inputokBejReg"></td></tr>
                    <tr><td>Írja be az email címét: </td> <td> <input type="text" name="email" id="email" class="inputokBejReg"></td></tr>

                    <tr><td><h2>Ezt a személyazonosítot rendeli önhöz a rendszer:</h2> </td><td>

            <?php
                if ($result = $con->query("SELECT `szemAzon` FROM `utas` ORDER BY `szemAzon` DESC LIMIT 1")) {

                    $tabla = $result->fetch_all();

                    $szemAzon = 0;

                    foreach($tabla as $sor){
                        foreach ($sor as $elem) {
                                    $szemAzon = $elem + 1;
                            }
                    }

                    echo '<br><span style="color: #ff8566;"> #' . $szemAzon . '</span><br><br>';
                    $result->free();
                    }
            ?></td></tr>

                <tr><td colspan="2"><input type="Submit" name="Submit" id="Submit" value="Regisztráció"  class="inputokBejReg  pointer"></td></tr>
                <tr><td colspan="2"><input type="Submit" name="vissza" id="vissza" value="Vissza a főoldalra"  class="inputokBejReg  pointer"></td></tr>
                <tr><td colspan="2"><script>document.getElementById("vissza").style.visibility = "hidden";</script></td></tr>

                <tr><td colspan="2"><div><a href="bejelentkezes.php" class="pointer">Van már fiókja? Bejelentkezéshez kattinson ide! | IDE |</a></div></td></tr>
                
                </table>
            </form>
        </div>
</div>
</body>

<?php

$vezeteknev = $_POST["vezetekNev"];
$keresztNev = $_POST["keresztNev"];
$teljesNev = $vezeteknev . " " . $keresztNev;
$szulido = $_POST["szulido"];
$felhasznaloNev = $_POST["felhasznaloNev"];
$jelszo = $_POST["jelszo"];
$ujraJelszo = $_POST["ujraJelszo"];
$mobil = $_POST["mobil"];
$email = $_POST["email"];

$feltetelVezeteknev = "/^(([A-ZÁÉÍÓÖŐÚÜŰ]+[A-Za-zÁÉÍÓÖŐÚÜŰáéíóöőúüű]+))$/";
$feltetelKeresztNev = "/^(([A-ZÁÉÍÓÖŐÚÜŰ]+[A-Za-zÁÉÍÓÖŐÚÜŰáéíóöőúüű]+))$/";
$feltetelSzulido = "/^(20[0-9]{2}|2[0-9]{3})-(0[1-9]|1[012])-([123]0|[012][1-9]|31)$/";
$feltetelJelszo = "/^(?=.*[a-z])(?=.*[A-Z])(?=.*[a-zA-Z]).{8,}$/";
$feltetelMobil = "/^06[0-9]+[0-9]{7,8}$/";
$feltetelEmail = "/\b[\w\.-]+@[\w\.-]+\.\w{2,4}\b/";
$vanMegEgyIlyenFelh = 0;
$vanMegEgyIlyenEmail = 0;

$hashjelszo = strtoupper(hash('sha512', $felhasznaloNev . $jelszo));

    if(isset($_POST["Submit"])){

        if ($result = $con->query("SELECT `felhasznalonev`, `email` FROM `utas`")) {
            
            $tabla = $result->fetch_all();

            foreach($tabla as $sor){
                foreach ($sor as $elem) {
                    if ($elem == $felhasznaloNev) {
                        $vanMegEgyIlyenFelh = True;
                    }
                    if ($elem == $email) {
                        $vanMegEgyIlyenEmail = True;
                    }
                }    
            }
    
            $result->free();
        }else{
            die("Hiba történt!");
        }

    if (preg_match($feltetelVezeteknev, $vezeteknev)  && 
    preg_match($feltetelKeresztNev, $keresztNev)  && 
    preg_match($feltetelSzulido, $szulido)  && 
    preg_match($feltetelJelszo, $jelszo)  && 
    preg_match($feltetelMobil, $mobil)  && 
    preg_match($feltetelEmail, $email)  &&
    $vanMegEgyIlyenFelh != True &&
    $vanMegEgyIlyenEmail != True &&
    $ujraJelszo == $jelszo
    ){

    $con->query('SET foreign_key_checks = 0');

    if ($result = $con->query("INSERT INTO `utas` (`utasAz`, `nev`, `szulido`, `szemAzon`, `kedvAz`, `felhasznalonev`, `jelszo`, `email`, `mobiltelefonszam`) 
        VALUES ('$szemAzon', '$teljesNev', '$szulido', '$szemAzon', '1', '$felhasznaloNev', '$hashjelszo', '$email', '$mobil');")) {
        
            echo '<script>alert("Sikeres regisztráció")</script>';
            echo '<span style="color:green;">Sikeres regisztráció!</span>';
            echo "<br><br><br><br>";
            $_SESSION['felhasznaloNev'] = $felhasznaloNev;
            echo '<script>document.getElementById("Submit").style.visibility = "hidden";</script>';
            echo '<script>document.getElementById("vissza").style.visibility = "visible";</script>';
        
        }else{
            echo '<script>alert("Sikertelen regisztráció")</script>';
            echo '<span style="color:red;">Sikertelen regisztráció!</span>';
            echo "<br><br><br><br>";
        }
        
        }else{
            echo '<script>alert("Sikertelen regisztráció")</script>';
            echo '<span style="color:red;">Sikertelen regisztráció!</span>';
            echo "<br><br><br><br>";
        }
    }

    if(isset($_POST["vissza"])){
        header("Location: ../index.php");
        exit();
    }

?>

<?php
    require_once('footer.php');
?>
</html>
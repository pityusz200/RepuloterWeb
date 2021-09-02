<!DOCTYPE html>
<html lang="hu">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="icon" href="./kepek/plane.png" type="image/png" sizes="16x16">
    <title>Bejelentkezes</title>
    <?php
    require_once "kapcsolat.php";
    require_once "header.php";
    error_reporting(0);
    session_start();
    ?>
</head>
<body class="bejReg">

<div class="container bejRegHatter">
        <div class="row">

    <form method="POST" action="#" id="bejelent">
        <table class="bejRegTable">
            <tr><td colspan="2"><label for="Bejelentkezes"><h1>Bejelentkezés</h1></label><br></td></tr>
            <tr><td>Írja be a felhasználónevét: </td> <td><input type="text" name="felhasznaloNev" id="felhasznaloNev"  class="inputokBejReg"></td></tr>
            <tr><td>Írja be a jelszavát: </td> <td><input type="password" name="jelszo" id="jelszo"  class="inputokBejReg"></td></tr>
            <tr><td>Írja be az email címét: </td> <td><input type="text" name="email" id="email"  class="inputokBejReg"></td></tr>

            <tr><td colspan="2"><input type="Submit" name="Submit" id="Submit" value="Bejelentkezés"  class="inputokBejReg pointer"></td></tr>
            <tr><td colspan="2"><input type="Submit" name="vissza" id="vissza" value="Tovább a fő oldalra"  class="inputokBejReg pointer"></td></tr>

            <tr><td colspan="2"><div><a href="regisztracio.php">Még nincs fiókja? Regisztráláshoz kattinson ide! | IDE |</a></div></td></tr>

        </table>

        

    </form>

    <script>document.getElementById("vissza").style.visibility = "hidden";</script>

<?php

$felhasznaloNev = $_POST["felhasznaloNev"];
$jelszo = $_POST["jelszo"];
$email = $_POST["email"];

$feltetelJelszo = "/^(?=.*[a-z])(?=.*[A-Z])(?=.*[a-zA-Z]).{8,}$/";
$feltetelEmail = "/\b[\w\.-]+@[\w\.-]+\.\w{2,4}\b/";
$vanIlyenFelhaN = 0;
$vanIlyenEmail = 0;
$vanIlyenJelszo = 0;

    if(isset($_POST["Submit"])){

        if ($result = $con->query("SELECT `felhasznalonev`, `email`, `jelszo`, 'utasAz' FROM `utas`")) {
            
            $tabla = $result->fetch_all();

            foreach($tabla as $sor){
                foreach ($sor as $elem) {
                    if ($elem == $felhasznaloNev) {
                        $vanIlyenFelhaN = True;
                    }
                    if ($elem == $email) {
                        $vanIlyenEmail = True;
                    }
                    
                    if (strtoupper(hash('sha512', $felhasznaloNev . $jelszo)) == $elem) {
                        $vanIlyenJelszo = True;
                    }
                }
            }

            $result->free();
            
        }else{
            die("Hiba történt!");
        }

        if ($vanIlyenFelhaN == True && $vanIlyenEmail == True && $vanIlyenJelszo == True){

            $_SESSION['felhasznaloNev'] = $felhasznaloNev;

            echo '<script>alert("Sikeres bejelentkezés!")</script>';

            echo '<script>document.getElementById("Submit").style.visibility = "hidden";</script>';
            echo '<script>document.getElementById("vissza").style.visibility = "visible";</script>';
            echo "<br><br>";
            echo '<span style="color:green; margin-bottm: 50px;">Sikeres bejelentkezés!</span>';
            
        }else{
            echo '<script>alert("Sikertelen bejelentkezés")</script>';
            echo "<br><br>";
            echo '<span style="color:red;">Sikertelen bejelentkezés!</span>';
        }        
    }

    if(isset($_POST["vissza"])){
        header("Location: ../index.php");
        exit();
    }
?>
</div>
    </div>
<?php require_once "footer.php"; ?>
</body>
</html>
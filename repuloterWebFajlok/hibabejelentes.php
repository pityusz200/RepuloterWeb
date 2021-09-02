<!DOCTYPE html>
<html lang="hu">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="icon" href="./kepek/plane.png" type="image/png" sizes="16x16">
    
    <title>Hibabejelentes</title>
</head>
<body>
<?php
    require_once('header.php');?>

<?php

$feltetelText = "/^.{15,}$/";


if (isset($_POST['hibakuldesGomb'])) {
    if (preg_match($feltetelText, $_POST['hibaText'])) {

        $date = date('jS F Y h:i:s A');
        $date = str_replace(" ", "",$date);
        $date = str_replace(":", "", $date);

        if (isset($_SESSION['felhasznaloNev'])) {
                $myfile = fopen("HibabejelentesekEsOtletelk/".$_SESSION['felhasznaloNev'] . $date. ".txt", "w") or print('<script>alert("Nem sikerült az üzenet küldés!")</script>');
                $txt = $_POST['hibaText'];
                fwrite($myfile, $txt);
                echo '<script>alert("Sikerült az üzenet küldés! Köszönjük, hogy írt nekünk!")</script>';
                fclose($myfile);
            }else{
                $myfile = fopen("HibabejelentesekEsOtletelk/vendeg".$date.".txt", "w") or print('<script>alert("Nem sikerült az üzenet küldés!")</script>');
                $txt = $_POST['hibaText'];
                fwrite($myfile, $txt);
                echo '<script>alert("Sikerült az üzenet küldés! Köszönjük, hogy írt nekünk!")</script>';
                fclose($myfile);
            }
        }else{
            echo '<script>alert("Írjon be 15 karakternél hosszabb szöveget, kérem!")</script>';
    }
}
?>
        <section class="d-flex align-items-stretch bd-highlight rendelesFo-Container">
            <article id="rendeles-kulso-Container">
                    <article>
                        <div class="p-2 bd-highlight elerhetosegEsHibabejelentes-container" style="width: 38vw;">
                                <table>
                                    <tr><td colspan="2"><h1>Hibaüzenet vagy ötlet küldése</h1></td></tr>
                                    <tr><td colspan="2"><p style="text-align: center;">A weboldallal illetve a szolgáltatással kapcsoaltosan.:</p></td></tr>
                                    <tr><td colspan="2">Ide írja az üzenetet:</td></tr>
                                    <tr><td colspan="2"><form action="#" method="POST"><textarea class="text" id="hibaText" name="hibaText" style="padding: 5px;" 
                                    placeholder="Ide tudja írni a talált hibát/problémát vagy a tanácsot. 
                                    &#10;Nagyon köszönjük üzenetét! 
                                    &#10;Az üzenetben célszerű elérhetőséget is megadni ha szeretné, hogy esetleg felvegyük önnel a kapcsolatot."></textarea></td></tr>
                                    <tr><td><input type="submit" name="hibakuldesGomb" id="hibakuldesGomb" class="elerhetoseg-hibajelentesGomb" value="Üzenet küldése!"></form></td>
                                    <td><form action="../index.php"><input type="submit" class="elerhetoseg-hibajelentesGomb" value="Vissza a fő oldalra!"></form></td></tr>
                                </table>
                        </div>
                    </article>
            </article>
        </section>
<?php
require_once('footer.php');
?>
</body>
</html>


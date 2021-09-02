<!DOCTYPE html>
<html lang="hu">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="icon" href="./kepek/plane.png" type="image/png" sizes="16x16">
    
    <title>Rendelés</title>
</head>
<body>

    <?php
        session_cache_limiter('private, must-revalidate');
        session_cache_expire(60);
        require_once('header.php');
        require_once('kapcsolat.php');

        if (isset($_GET['rendeltJaratszam'])) {
            $_SESSION['jaratszam'] = $_GET['rendeltJaratszam'];
            $_SESSION['honnan'] = $_GET['rendeltHonnan'];
            $_SESSION['hova'] = $_GET['rendeltHova'];
            $_SESSION['hova'] = str_replace('  ', '', $_SESSION['hova']);
            $_SESSION['indulasIdo'] = $_GET['rendeltIndulas'];
            $_SESSION['visszaindulasIdo'] = $_GET['rendeltVisszaindulasIdo'];
            $_SESSION['terminal'] = $_GET['rendeltTerminal'];
            $_SESSION['terminal'] = $_SESSION['terminal'] == 0 ? "A" : "B";
            $_SESSION['repulogepTipus'] = $_GET['rendeltRepulogepTipus'];
            $_SESSION['repulogepTarsasag'] = $_GET['rendeltRepulogepTarsasag'];
            $_SESSION['jegyAr'] = $_GET['jegyAr'];
            $sikeres = false;
        }
    ?>

  <section class="d-flex align-items-stretch bd-highlight rendelesFo-Container">
        <article id="rendeles-kulso-Container">
            <div class="p-2 bd-highlight rendeles-text-part">
            <article>
                <div>
                    <?php
                    
                        echo '<h2>Vár <span class="jaratSzovegKiemelese"> '. $_SESSION['hova']. '! </h2> </span><br>
                              <p>Ebből a városból: <span class="jaratSzovegKiemelese"> '.$_SESSION['honnan'] .' </span></p>
                              <p>Ebbe a városba: <span class="jaratSzovegKiemelese"> '. $_SESSION['hova'].' </span></p>
                              <p>Indulás ideje: <span class="jaratSzovegKiemelese"> '. $_SESSION['indulasIdo'] .' </span></p>
                              <p>Vissza indulás ideje: <span class="jaratSzovegKiemelese"> '. $_SESSION['visszaindulasIdo'] .' </span></p><br>
                              <p><span class="jaratSzovegKiemelese"> '. $_SESSION['terminal'] .' </span>- terminálba kell majd mennie a repülőtéren</p>
                              <p>Repülőgép típusa amivel utazni fog: <span class="jaratSzovegKiemelese"> '. $_SESSION['repulogepTipus'] .'</span></p>
                              <p>Repülőgép társaság ami a repülőgépet bíztosítja: <span class="jaratSzovegKiemelese">'. $_SESSION['repulogepTarsasag'] .'</span></p></br>';
                    ?>                
                </div>
                <div><form method="$_GET">
                    <input type="radio" id="elsoOsztaly" name="osztaly" value="0" class="inputo-rendeles">
                    <label for="elsoOsztaly"><span class="jaratSzovegKiemelese">Első</span> osztály,  ár:  <?php echo '<br>'. $_SESSION['jegyAr'] + 80000 . ' HUF ('.$_SESSION['jegyAr'].' HUF + 80.000 HUF )'?></label><br><br>
                    <input type="radio" id="masodOsztaly" name="osztaly" value="1" class="inputo-rendeles">
                    <label for="masodOsztaly"><span class="jaratSzovegKiemelese">Másod</span> osztály,  ár:  <?php echo '<br>'.  $_SESSION['jegyAr'] + 40000 . ' HUF ('.$_SESSION['jegyAr'].' HUF + 40.000 HUF )'?></label><br><br>
                    <input type="radio" id="harmadOsztaly" name="osztaly" value="2" class="inputo-rendeles">
                    <label for="harmadOsztaly"><span class="jaratSzovegKiemelese">Harmad</span> osztály,  ár:  <?php echo '<br>'.  $_SESSION['jegyAr']. ' HUF'?></label><br>
                    <div><input type="submit" value="Megrendelem" id="jaratMegrendeles" name="jaratMegrendeles" class="megrendelesGomb"></div>
                    </form>
                    <?php

                    if (isset($_GET['jaratMegrendeles'])) {
                        if (isset($_SESSION['felhasznaloNev'])) {
                            if (isset($_GET['osztaly'])) {
                                
                                $osztaly = $_GET['osztaly'];
                                
                                switch ($osztaly)
                                {
                                    case 0:
                                        $_SESSION['jegyAr'] = $_SESSION['jegyAr'] + 80000;
                                        break;
                                    case 1:
                                        $_SESSION['jegyAr'] = $_SESSION['jegyAr'] + 40000;
                                        break;
                                    default:
                                        break;
                                }

                                $sql = 'SELECT `utasAz` FROM `utas` WHERE `felhasznalonev` LIKE "'.$_SESSION['felhasznaloNev'].'"';
                                $result = $con->query($sql);
                        
                                while($row = $result->fetch_assoc()) {$utasAz = $row['utasAz'];}
                                $jaratszam = $_SESSION['jaratszam'];
                                    if ($con->query("INSERT INTO `utazas` (`utazasAz`, `jaratszamAz`, `utasAz`, `osztaly`) VALUES ('', $jaratszam, $utasAz, $osztaly)")) {
                                        echo '<script>alert("Sikeres megrendelés!")</script>';
                                        $sikeres = true;
                                        $con->close();
                                    }else{
                                        echo "Hiba történt a megrendelés közben! Kérem próbálja meg később!";
                                    }
                                }else{
                                    echo '<script>alert("Kérem válasszon ki osztályt is!")</script>';
                                }
                            }else{
                                echo '<script>alert("Kérem jelentkezzen be megrendelés előtt vagy regisztráljon!")</script>';
                            }
                        }

                    ?>
                </div>
            </article>
            </div>

            <div class="p-2 bd-highlight rendeles-img-part">    
                <article>  
                    <div>
                        <?php echo '<img src="./kepek/'.$_SESSION['hova'].'.jpg" alt="'. $_SESSION['hova'] .'" class="pointer">';?>
                    </div>
                </article>
            </div>
        </article>
  </section>
    <?php 
    unset($_GET['osztaly']);
    if ($sikeres) {
        header("Location: rendelesSikeresenMegtortent.php");
    }
    require_once('footer.php');?>
</body>
</html>
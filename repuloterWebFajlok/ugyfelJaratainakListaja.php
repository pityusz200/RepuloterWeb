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
        require_once('header.php');
        require_once('kapcsolat.php');

       $sql = 'SELECT DISTINCT jarat.jaratszam, jarat.honnan, jarat.hova, jarat.indulasido, jarat.visszaindulasido, jarat.terminal, repulogep.tipus, repgeptars.repTarsNeve, jarat.jegyar, utazas.osztaly
               FROM `utas` INNER JOIN `utazas` ON utas.utasAz = utazas.utasAz INNER JOIN `jarat` ON utazas.jaratszamAz = jarat.jaratszam INNER JOIN repulogep ON jarat.rgepkod = repulogep.rgepkod INNER JOIN repgeptars ON repulogep.rgepTarsAz = repgeptars.rgepTarsAz
               WHERE utas.felhasznalonev LIKE "'.$_SESSION['felhasznaloNev'].'";';
       
       $result = $con->query($sql);

       if($result -> num_rows > 0){
            while($row = $result->fetch_assoc()) {
                $honnan = $row['honnan'];
                $hova = $row['hova'];
                $indulasIdo = $row['indulasido'];
                $visszaindulasIdo = $row['visszaindulasido'];
                $terminal = $row['terminal'];
                $terminal = $terminal == 0 ? "A" : "B";
                $repulogepTipus = $row['tipus'];
                $repulogepTarsasag = $row['repTarsNeve'];
                $jegyAr = $row['jegyar'];
                $osztaly = $row['osztaly'];
            }
            $result -> close();

            switch ($osztaly)
            {
                case 0:
                    $jegyAr = $jegyAr + 80000;
                    break;
                case 1:
                    $jegyAr = $jegyAr + 40000;
                    break;
                default:
                    break;
            }
        }else{
            header("Location: nincsRendeltRepulojegye.php");
        }
    ?>

  <section class="d-flex align-items-stretch bd-highlight">
        <article id="rendeles-kulso-Container">
            <div class="p-2 bd-highlight rendeles-text-part">
                <div>
                    <article>
                        <div>
                            <?php
                            echo '<p>Az ön jegye <span class="jaratSzovegKiemelese">' .$hova .'</span>-ba/be szól!</p><br>
                            Ebből a városból: <span class="jaratSzovegKiemelese">'.$honnan.'</span><br>
                            Ebbe a városba: <span class="jaratSzovegKiemelese">'.$hova.'</span><br>
                            Indulás ideje: <span class="jaratSzovegKiemelese">'.$indulasIdo.'</span><br>
                            Vissza indulás ideje: <span class="jaratSzovegKiemelese">'.$visszaindulasIdo.'</span><br><br>
                            <span class="jaratSzovegKiemelese">'.$terminal.' </span>- terminálba kell majd mennie a repülőtéren<br>
                            Repülőgép típusa amivel utazni fog: <span class="jaratSzovegKiemelese">'.$repulogepTipus.'</span></br>
                            Repülőgép társaság ami a repülőgépet bíztosítja: <span class="jaratSzovegKiemelese">'.$repulogepTarsasag.'</span>
                            <p>A jegy ára: '. $jegyAr . '  HUF</p>';?>
                        </div>
                        <div>
                            <form method="POST">
                                <div id="jaratTorleseEsLetolteseDiv">
                                    <input type="submit" class="jaratTorleseEsLetolteseGomb" name="torlesGomb" value="Járat törlése">
                                </div>
                            </form>

                            <?php
                                if (isset($_POST['torlesGomb'])) {
                                    $sql = 'SELECT `utasAz` FROM `utas` WHERE `felhasznalonev` LIKE "'.$_SESSION['felhasznaloNev'].'"';
                                    $result = $con->query($sql);

                                    while($row = $result->fetch_assoc()) {$utasAz = $row['utasAz'];}
                                    if($con -> query('DELETE FROM `utazas` WHERE `utazas`.`utasAz` = '.$utasAz.'')){
                                        $con->close();
                                        header("Location: rendelesTorolve.php");
                                    }
                                }
                                $con->close();
                            ?>

                        </div>
                    </article>
                </div>
            </div>

            <div class="p-2 bd-highlight rendeles-img-part">     
                    <div>
                        <article>
                            <?php echo '<img src="kepek/'.$hova.'.jpg" alt="'.$hova.'" class="pointer">'?>
                        </article>
                    </div>
            </div>
        </article>
  </section>
    <?php 
    require_once('footer.php');?>
</body>
</html>
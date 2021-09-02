  <?php
    require_once('kapcsolat.php');
    error_reporting(0);
  ?>
      <article>       
        <ul>
          <?php

          $whereHonnan = $_POST['honnan'];
          $whereHova = $_POST['hova'];
          $whereIndulasIdo = $_POST['indulasIdo'];
          $whereVisszaindulasIdo = $_POST['visszaindulasIdo'];
          $whereRepuloTarsasag = $_POST['milyenRepuloTarsasagnal'];
          $whereRepulovel = $_POST['milyenTipusuRepulovel'];
          $whereMinimumAr = $_POST['minimumAr'];
          $whereMaximumAr = $_POST['maximumAr'];

            $where = array();
            
            if (isset($whereHonnan) && $whereHonnan != "Honnan?") {array_push($where, 'jarat.honnan LIKE "' . $whereHonnan .'"');}

            if (isset($whereHova) && $whereHova != "Hova?") {array_push($where, 'jarat.hova LIKE "' . $whereHova .'"');}

            if (isset($whereIndulasIdo) && $whereIndulasIdo != "") {array_push($where, 'jarat.indulasido > "' . $whereIndulasIdo .'"');}

            if (isset($whereVisszaindulasIdo) && $whereVisszaindulasIdo != "") {array_push($where, 'jarat.visszaindulasido < "' . $whereVisszaindulasIdo .'"');}

            if (isset($whereRepuloTarsasag) && $whereRepuloTarsasag != "Milyen repülő társaságnál?") {array_push($where, 'repgeptars.repTarsNeve LIKE "' . $whereRepuloTarsasag .'"');}

            if (isset($whereRepulovel) && $whereRepulovel != "Milyen típusú repűlővel?") {array_push($where, 'repulogep.tipus LIKE "' . $whereRepulovel .'"');}

            if (isset($whereMinimumAr) && $whereMinimumAr != "") {array_push($where, 'jarat.jegyar > ' . $whereMinimumAr);}

            if (isset($whereMaximumAr) && $whereMaximumAr != "") {array_push($where, 'jarat.jegyar < ' . $whereMaximumAr);}

            if (count($where) > 0) {

              $whereString = "WHERE ";

                for ($i=0; $i < count($where); $i++) { 
                  if ($i + 1 < count($where)) {
                    $whereString .= $where[$i] .' AND ';
                  }else{
                    $whereString .= $where[$i] .';';
                  }
                }

                $sql = "SELECT DISTINCT jarat.jaratszam, jarat.honnan, jarat.hova, jarat.indulasido, jarat.visszaindulasido, jarat.terminal, repulogep.tipus, repgeptars.repTarsNeve, jarat.jegyar
                FROM `utas` INNER JOIN `utazas` ON utas.utasAz = utazas.utasAz INNER JOIN `jarat` ON utazas.jaratszamAz = jarat.jaratszam INNER JOIN repulogep ON jarat.rgepkod = repulogep.rgepkod INNER JOIN repgeptars ON repulogep.rgepTarsAz = repgeptars.rgepTarsAz " .
                $whereString ."";
                $query = $con -> query($sql);
                if ($query -> num_rows == 0) {
                  echo "<h2>Nincs ilyen találat. Keressen másik járatot!</h2><br>";
                }
              }else{
                  $sql = "SELECT DISTINCT jarat.jaratszam, jarat.honnan, jarat.hova, jarat.indulasido, jarat.visszaindulasido, jarat.terminal, repulogep.tipus, repgeptars.repTarsNeve, jarat.jegyar
                  FROM `utas` INNER JOIN `utazas` ON utas.utasAz = utazas.utasAz INNER JOIN `jarat` ON utazas.jaratszamAz = jarat.jaratszam INNER JOIN repulogep ON jarat.rgepkod = repulogep.rgepkod INNER JOIN repgeptars ON repulogep.rgepTarsAz = repgeptars.rgepTarsAz";
              }

          if ($query = $con -> prepare($sql)){
              $query -> execute();
              $query -> bind_result($jaratszam, $honnan, $hova, $indulasIdo, $visszaindulasIdo, $terminal, $repulogepTipus, $repulogepTarsasag, $jegyAr);

              while ($query -> fetch()){?>
                <li>
                  <article>
                    <div class="jaratSzovegHatter">
                    <?php  echo '<a name='.$hova.'></a><h2> Irány <span class="jaratSzovegKiemelese">'.$hova.'</span> !</h2>
                        <span class="jaratSzovegKiemelese">'.$hova.'</span> egy kellemes város ahova mindig érdemes el utazni.
                        Ez a járat <span class="jaratSzovegKiemelese">'.$honnan.' </span> indul de le ne maradjon
                        mert <span class="jaratSzovegKiemelese">'.$indulasIdo.'</span> kor már a <span class="jaratSzovegKiemelese"> '.$repulogepTarsasag.'</span> csinos stewardess hölgyek
                        és a jól képzett piloták várják a <span class="jaratSzovegKiemelese">'.$repulogepTipus.'</span> tipúsú gép fedérzetén!<br>
                        Ennek a jegynek a vissza indulási ideje: <span class="jaratSzovegKiemelese">'.$visszaindulasIdo . '</span> <br>
                        <h4 style="text-align: center; margin-top: 10px;">Jegy ára csupán: <span class="jaratSzovegKiemelese">'.$jegyAr.' HUF </span></4>

                        <form action="./jaratRendeles.php?&rendeltJaratszam='.$jaratszam.'&rendeltHonnan='.$honnan.'&rendeltHova='.$hova.'&rendeltIndulas='.$indulasIdo.'&rendeltVisszaindulasIdo='.$visszaindulasIdo.'&rendeltTerminal='.$terminal.'&jegyAr='.$jegyAr.'&rendeltRepulogepTarsasag='.$repulogepTarsasag.'&rendeltRepulogepTipus='.$repulogepTipus.'" method="POST">
                        <div class= "rendelesGomb-Container">
                        <input 
                        type="submit" 
                        id="rendelesGomb-'.$jaratszam.'"
                        name="rendelesGomb-'.$jaratszam.'" 
                        value="Ide utazok!"></div>
                        ';
                        ?>

                        </form></div>
                        <?php
                        echo '<div class="jaratKep"><img class= "pointer" src="./kepek/'.$hova.'.jpg" alt="'.$hova.'" . text="'.$hova.'"></div>';

                          
                        ?>
                </article>
                </li>
                <?php
              }
                    $query -> close();
                } else {
                    echo 'Kérem próbálja meg később! További szép napot!';
                }
                ?>
        </ul>
      </article>
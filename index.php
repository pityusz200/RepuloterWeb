<!DOCTYPE html>
<html lang="hu">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="repuloterWebFajlok/bootstrap/css/bootstrap.min.css">
    <link rel="icon" href="./repuloterWebFajlok/kepek/plane.png" type="image/png" sizes="16x16">
    <title>Üdvözöljük a honlapon!</title>

<body>

  <?php

    session_start();
    require_once('repuloterWebFajlok/kapcsolat.php');
    require_once "./repuloterWebFajlok/headerIndex.php";

  ?>
    <div><h1 id="kezdoText" class="col-sx-8"> Üdvözöljük a weboldalon!</a></h1></div>

  <div class="container-fluid">
    <div class="row">
            <div class="keresoKeret"><?php require("./repuloterWebFajlok/szuroIndex.php");?></div>
        </div>
    </div>

      <?php 

      $sql = "SELECT DISTINCT jarat.jaratszam, jarat.honnan, jarat.hova, jarat.indulasido, jarat.visszaindulasido, jarat.terminal, repulogep.tipus, repgeptars.repTarsNeve, jarat.jegyar
              FROM `utas` INNER JOIN `utazas` ON utas.utasAz = utazas.utasAz INNER JOIN `jarat` ON utazas.jaratszamAz = jarat.jaratszam INNER JOIN repulogep ON jarat.rgepkod = repulogep.rgepkod INNER JOIN repgeptars ON repulogep.rgepTarsAz = repgeptars.rgepTarsAz";

      $result = $con->query($sql);
      $segedTomb = array();
      for ($i=0; $i < 3; $i++) { 
        array_push($segedTomb, mysqli_fetch_assoc($result));
      }

      $harmasCard = array();
      foreach ($segedTomb as $key => $value)
      {
          foreach ($value as $key2 => $value2) {
            if ($key2 == "hova") {
              array_push($harmasCard, $value2);
            }
          }
      }    
    ?>

      <div id="modositCard">
      <div class="row row-cols-1 row-cols-md-3 g-4">
        <div class="col">
          <div class="card h-100">
            <?php echo '<a href="./repuloterWebFajlok/repulojegyListaWeb.php#'.$harmasCard[0].'"><img src="repuloterWebFajlok/kepek/'.$harmasCard[0].'.jpg" class="card-img-top" alt="'.$harmasCard[0].' kép" title="Egy kép '.$harmasCard[0].'"></a>' ?>
              <div class="card-body">
              <?php echo '<h5 class="card-title">'.$harmasCard[0].'</h5>'?>
              <p class="card-text">Kérem válasszon egy tetszőleges város és kattintson a képre ahoz, hogy megtekintse a részleteket.</p>
            </div>
            <div class="card-footer">
              <small class="text-muted">Kattintson a képre</small>
            </div>
          </div>
        </div>
        <div class="col">
          <div class="card h-100">
          <?php echo '<a href="./repuloterWebFajlok/repulojegyListaWeb.php#'.$harmasCard[1].'"><img src="repuloterWebFajlok/kepek/'.$harmasCard[1].'.jpg" class="card-img-top" alt="'.$harmasCard[1].' kép" title="Egy kép '.$harmasCard[1].'"></a>' ?>
              <div class="card-body">
              <?php echo '<h5 class="card-title">'.$harmasCard[1].'</h5>'?>
              <p class="card-text">Kérem válasszon egy tetszőleges város és kattintson a képre ahoz, hogy megtekintse a részleteket.</p>
            </div>
            <div class="card-footer">
              <small class="text-muted">Kattintson a képre</small>
            </div>
          </div>
        </div>
        <div class="col">
          <div class="card h-100">
          <?php echo '<a href="./repuloterWebFajlok/repulojegyListaWeb.php#'.$harmasCard[2].'"><img src="repuloterWebFajlok/kepek/'.$harmasCard[2].'.jpg" class="card-img-top" alt="'.$harmasCard[2].' kép" title="Egy kép '.$harmasCard[2].'"></a>' ?>
              <div class="card-body">
              <?php echo '<h5 class="card-title">'.$harmasCard[2].'</h5>'?>
              <p class="card-text">Kérem válasszon egy tetszőleges város és kattintson a képre ahoz, hogy megtekintse a részleteket.</p>
            </div>
            <div class="card-footer">
              <small class="text-muted">Kattintson a képre</small>
            </div>
          </div>
        </div>
      </div>
    </div>

    <?php require_once('./repuloterWebFajlok/footerIndex.php'); 
    
    unset($_SESSION['jaratszam']);
    unset($_SESSION['honnan']);
    unset($_SESSION['hova']);
    unset($_SESSION['indulasIdo']);
    unset($_SESSION['visszaindulasIdo']);
    unset($_SESSION['terminal']);
    unset($_SESSION['repulogepTipus']);
    unset($_SESSION['repulogepTarsasag']);
    unset($_SESSION['jegyAr']);
    ?>
</body>
</html>
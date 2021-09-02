<link rel="stylesheet" href="./repuloterWebFajlok/css/repuloter.css">
<?php
    error_reporting(0);
    unset($_SESSION['rendeltJaratszam']);

    if(isset($_SESSION['felhasznaloNev'])){
?>
    <header class="container-fluid">
        <div class="row">
            <div class="container">
                <div class="row">
                    <div id="fejLec" class="col-sx-4">
                        <a href="./repuloterWebFajlok/felhasznaloBeallitasok.php"> 
                        Belépve mint: <?php echo $_SESSION['felhasznaloNev']?></a>
                        <a href="./repuloterWebFajlok/ugyfelJaratainakListaja.php">
                        <img src="./repuloterWebFajlok/kepek/plane-ticket.png" alt="Jegyeim" style="width:40px"></a>
                        <div class="col-sx-4" style="display: inline; margin-left: 10px">|</div>
                        <a href="./repuloterWebFajlok/kijelentkezes.php">Kijelentkezés</a>
                    </div>
                </div>
            </div>
        </div>
    </header>
<?php
}else{
?>
    <header class="container-fluid">
        <div class="row">
            <div class="container">
                <div class="row">
                    <div id="fejLec" class="col-sx-4">
                        <a href= "./repuloterWebFajlok/bejelentkezes.php">Bejelentkezés</a>
                        <a href= "./repuloterWebFajlok/regisztracio.php">Regisztráció</a>
                    </div>
                </div>
            </div>
        </div>
    </header>

<?php
}
?>
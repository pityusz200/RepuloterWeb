<link rel="stylesheet" href="./bootstrap/css/bootstrap.min.css">
<link rel="stylesheet" href="./css/repuloter.css">

<?php
session_start();
error_reporting(0);

    if(isset($_SESSION['felhasznaloNev'])){
?>
    <header class="container-fluid">
        <div class="row">
            <div class="container">
                <div class="row">
                    <div id="fejLec" class="col-sx-4">
                        <a href="../index.php" class="col-sx-4">Kezdőlap</a>
                        <a href="./felhasznaloBeallitasok.php">
                        Belépve mint: <?php echo $_SESSION['felhasznaloNev']?>
                        <a href="./ugyfelJaratainakListaja.php">
                        <img src="./kepek/plane-ticket.png" alt="Jegyeim" style="width:40px"></a>
                        <a href="kijelentkezes.php">Kijelentkezés</a>
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
                        <a href="../index.php" class="col-sx-4">Kezdőlap</a>
                        <a href= "bejelentkezes.php">Bejelentkezés</a>
                        <a href= "regisztracio.php">Regisztráció</a>
                    </div>
                </div>
            </div>
        </div>
    </header>

<?php
}
?>
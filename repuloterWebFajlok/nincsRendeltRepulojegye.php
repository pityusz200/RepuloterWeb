<!DOCTYPE html>
<html lang="hu">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="icon" href="./kepek/plane.png" type="image/png" sizes="16x16">
    
    <title>Nincs repülőjegye!</title>
</head>
<body>
<?php
    require_once('header.php');?>

    <div id="sikertelen-container">
        <h1>Önnek még nincs rendelt repülőjegye! <br> Kérem rendeljen meg egyet!</h1><br>
        <form action="../index.php"><input type="submit" value="Vissza a fő oldalra!"></form>
    </div>

    <?php require_once('footer.php');?>
</body>
</html>
<!DOCTYPE html>
<html lang="hu">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="icon" href="./kepek/plane.png" type="image/png" sizes="16x16">
    
    <title>Elérhetőségeink</title>
</head>
<body>
<?php
    require_once('header.php');?>


        <section class="d-flex align-items-stretch bd-highlight rendelesFo-Container">
            <article id="rendeles-kulso-Container">
                    <article>
                        <div class="p-2 bd-highlight elerhetosegEsHibabejelentes-container">
                            <div>
                                <h1>Elérhetőségeink</h1> <br> 
                                <table>
                                    <tr><td>Weboldal készítője:</td><td>Makán István</td></tr>
                                    <tr><td>Telefonszám: </td><td>06705140398</td></tr>
                                    <tr><td>Email cím:</td><td>pitymakan@gmail.com</td></tr>
                                
                            </div>
                            <tr class="pointer"><td colspan="2"><form action="../index.php"><input type="submit" class="elerhetoseg-hibajelentesGomb" value="Vissza a fő oldalra!"></form></td></tr>
                            </table>
                        </div>
                    </article>
                    <article>  
                        <div class="p-2 bd-highlight elerhetosegEsHibabejelentes-container-terkep">    
                        <iframe src="https://maps.google.com/maps?q=vasv%C3%A1ri%20p%C3%A1l%20szeged&t=&z=15&ie=UTF8&iwloc=&output=embed" frameborder="0" scrolling="no" marginheight="0" marginwidth="0"></iframe>
                        </div>
                    </article>
            </article>
        </section>

    <?php require_once('footer.php');?>
</body>
</html>
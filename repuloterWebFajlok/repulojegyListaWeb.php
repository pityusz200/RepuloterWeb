<!DOCTYPE html>
<html lang="hu">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="icon" href="./kepek/plane.png" type="image/png" sizes="16x16">
    <title>Ajánlataink</title>
</head>
<body>
  
  <?php
    session_cache_limiter('private, must-revalidate');
    session_cache_expire(60);
    require_once('header.php');
    require_once('kapcsolat.php');
  ?>     

      
      <section class="autoFelxbox align-items-start bd-highlight">
      <div class="p-2 bd-highlight">
                
                <img src="./kepek/MI Airport Manager XX Logo.png" alt="MI Airport Manager XX Logo" style="width: 350px; display: block; margin: 0% auto">
                <article>
                    <h2 id="szuresText">Szűrés</h2>
                      <div class="menu-container">
                        
                        <a id="Szuro" class="pointer"> szűrő mutatásához / elrejtéséhez</a>
                        <div id="Szurok"> <?php require 'szuro.php'; ?></div>

                        <script src="./script/repuloter.js"></script>

                      </div>
                </article>
      </div>
      <div id="tartalom" class="p-2 bd-highlight">
      
      <?php require("./repulojegyListaWeb_OnlyList.php"); ?>

    </div>

  </section>
  <?php require_once('footer.php'); ?>

</body>
</html>
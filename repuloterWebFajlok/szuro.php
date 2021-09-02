    <form action="./repulojegyListaWeb_OnlyList.php" method="POST">
      <ul>
        <li>      
          <select name="honnan" id="honnan" class="inputokSzuro" style="color: #5a5a5a;">
            <option value="Honnan?">Honnan?</option>
                  <option value="Budapest">Budapest</option>
                  <option value="London">London</option>
                  <option value="New York">New York</option>
                  <option value="Moszkva">Moszkva</option>
                  <option value="Berlin">Berlin</option>
                  <option value="Svájc">Svájc</option>
                  <option value="Párizs">Párizs</option>
                  <option value="Roma">Roma</option>
                  <option value="Görögország">Görögország</option>
                  <option value="Japán">Japán</option>
          </select>
        </li>

        <li>      
          <select name="hova" id="hova" class="inputokSzuro" style="color: #5a5a5a;">
                  <option value="Hova?">Hova?</option>
                  <option value="Budapest">Budapest</option>
                  <option value="London">London</option>
                  <option value="New York">New York</option>
                  <option value="Moszkva">Moszkva</option>
                  <option value="Berlin">Berlin</option>
                  <option value="Svájc">Svájc</option>
                  <option value="Párizs">Párizs</option>
                  <option value="Roma">Roma</option>
                  <option value="Görögország">Görögország</option>
                  <option value="Japán">Japán</option>
          </select>
        </li>
        
        <li><input name="indulasIdo" id="indulasIdo" placeholder="Mikor indulna?" type="text" class="form-control  col-md-2 inputokSzuro" onfocus="(this.type='date')" onblur="(this.type='text')"></li>
        <li><input name="visszaindulasIdo" id="visszaindulasIdo" placeholder="Mikor jönne?" type="text" class="form-control  col-md-2 inputokSzuro" onfocus="(this.type='date')" onblur="(this.type='text')"></li>

        <li>
          <select name="milyenRepuloTarsasagnal" id="milyenRepuloTarsasagnal" class="inputokSzuro" style="color: #5a5a5a;">
            <option value="Milyen repülő társaságnál?">Milyen repülő társaságnál?</option>
            <option value="Airbus">Airbus</option>
            <option value="British Aerospace">British Aerospace</option>
            <option value="Boeing Commercial Airplanes">Boeing Commercial Airplanes</option>
            <option value="Boeing">Boeing</option>
            <option value="Fokker">Fokker</option>
            <option value="Irkut">Irkut</option>
            <option value="Kazanyi RTE.">Kazanyi RTE.</option>
          </select>
        </li>

        <li>
        <select name="milyenTipusuRepulovel" id="milyenTipusuRepulovel" class="inputokSzuro" style="color: #5a5a5a;">
            <option value="Milyen típusú repűlővel?">Milyen típusú repűlővel?</option>
            <option value="Airbus A300">Airbus A300</option>
            <option value="BAe 146">BAe 146</option>
            <option value="Boeing 747">Boeing 747</option>
            <option value="Boeing 767">Boeing 767</option>
            <option value="Boeing 727">Boeing 727</option>
            <option value="Clipper Victor">Clipper Victor</option>
            <option value="Fokker 100">Fokker 100</option>
            <option value="MC–21">MC–21</option>
            <option value="Tu–204">Tu–204</option>
            <option value="VC–25A">VC–25A</option>
          </select>
        </li>

        <li><input  name="minimumAr" id="minimumAr" type="number" class="form-control  col-md-2 inputokSzuro" placeholder="Minimum ár?"  style="color: #5a5a5a;" min="0" max="500000"></li>
        <li><input  name="maximumAr" id="maximumAr" type="number" class="form-control  col-md-2 inputokSzuro" placeholder="Maximum ár?"  style="color: #5a5a5a;" min="0" max="500000"></li>
        <li><input  name="szuresGomb" id="szuresGomb"type="submit" value="Szűrés" class="inputokSzuro" style="margin: 0px auto;"></li>
      </ul>
    </form>
    <script src="./repulojegyListaWeb_Ajax.js"></script>
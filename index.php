<!DOCTYPE html>
<html lang="en">

<?php
$title = "KanalList";
include_once('views/partials/header.php')
?>

<body class="position-relative p-3">
  <div class="container-fluid py-4 min-height bg-teal rounded-3">
    <div class="container-fluid rounded-3">
      <?php include_once('views/partials/navbar.php') ?>

      <div class="page-header w-md-83 mx-auto mt-5 mb-4 pt-xxl-3 pb-xxl-1">
        <h1 class="f-Pacifico mb-4">Youtube Kanal Bulucu</h1>
        <p class="d-none d-md-block lh-sm f-Noto mb-0 description-text">
          Youtube'da hep aynı kanalları izlemekten sıkıldın mı? Burası tam
          sana göre.
          <span class="d-none d-lg-block">Youtube kanal bulucu kullanarak bilinmeyen ve keşfedilmemiş
            kanalları kolayca bulabilirsin.</span>
          Aşağıdan istediğin özellikleri gir ve senin için seçilen kanalların
          tadını çıkar.
        </p>
        <p class="lh-sm f-Noto">
          <span class="f-Poppins">
            <strong>Not:</strong>
          </span> Hepsini doldurmak zorunda
          değilsin boş bırak gitsin.
        </p>
      </div>

      <form action="result.php" method="post">
        <div class="row justify-content-around">
          <div class="col-md-4 mb-3">
            <label for="channelName" class="form-label">Kanal Adı</label>
            <input type="text" name="channelName" class="form-control" id="channelNamee" />
          </div>
          <div class="col-md-4 mb-3">
            <label for="category" class="form-label">Kategori</label>
            <div class="dropdown-multi">
              <input type="hidden" name="category[]" value="" />
              <select name="category[]" id="multicategory" class="p-5" multiple placeholder="Choose a Category">
                <option value="Gaming">Oyun</option>
                <option value="Entertainment">Eğlence</option>
                <option value="AutosandVehicles">Araçlar</option>
                <option value="Sports">Spor</option>
                <option value="TravelandEvents">Seyahat</option>
                <option value="HowtoandStyle">Nasıl yapılır ve Stil</option>
                <option value="Comedy">Komedi</option>
                <option value="Music">Muzik</option>
                <option value="Education">Eğitim</option>
                <option value="ScienceandTechnology">Bilim ve Teknoloji</option>
                <option value="FilmandAnimation">Film ve Animasyon</option>
                <option value="NewsandPolitics">Haber & Gündem</option>
                <option value="PeopleandBlogs">İnsanlar</option>
                <option value="PetsandAnimals">Hayvanlar</option>
                <option value="NonprofitsandActivism">Kar amacı gütmeyen kuruluşlar</option>
              </select>
            </div>
          </div>
        </div>
        <div class="row justify-content-around">
          <div class="col-md-4 mb-3 d-flex justify-content-between">
            <div class="col-sm-5">
              <label for="subsMin" class="form-label">Min Takipçi</label>
              <input id="subsMin" name="subMin" type="number" class="form-control" min="0" onchange="handleMinChange(event)" placeholder="En az" />
            </div>
            <div class="col-sm-5">
              <label for="subsMax" class="form-label">Max Takipçi</label>
              <input id="subsMax" name="subMax" type="number" class="form-control" min="0" onchange="forceMin(event)" placeholder="En çok" />
            </div>
          </div>
          <div class="col-md-4 mb-3">
            <label for="category" class="form-label">Dil</label>
            <div class="dropdown-multi">
              <input type="hidden" name="language[]" value="" />
              <select name="language[]" id="multicategory" class="p-5" multiple placeholder="Choose a Category">
                <option value="Turkish">Türkçe</option>
                <option value="English">İngilizce</option>
                <option value="Spanish">İspanyolca</option>
                <option value="German">Almanca</option>
                <option value="Italian">İtalyanca</option>
                <option value="Russian">Rusça</option>
              </select>
            </div>
          </div>
        </div>
        <div class="row justify-content-around">
          <div class="col-md-4 mb-3">
            <div class="d-flex justify-content-between">
              <div class="col-sm-5">
                <label for="videoCountMin" class="form-label">Min Video Sayısı</label>
                <input id="videoCountMin" name="videoCountMin" type="number" min="0" onchange="handleMinChange(event)" class="form-control" placeholder="En az" />
              </div>
              <div class="col-sm-5">
                <label for="videoCountMax" class="form-label">Max Video Sayısı</label>
                <input id="videoCountMax" name="videoCountMax" type="number" min="0" onchange="forceMin(event)" class="form-control" placeholder="En çok" />
              </div>
            </div>
          </div>
          <div class="col-md-4 mb-3">
            <label for="totalVideoMin" class="form-label">Toplam izlenmesi ne kadar olsun?</label>
            <div class="d-flex justify-content-between">
              <div class="col-sm-5">
                <input id="totalVideoMin" name="totalVideoMin" type="number" class="form-control" min="0" onchange="handleMinChange(event)" placeholder="En az" />
              </div>
              <div class="col-sm-5">
                <input id="totalVideoMax" name="totalVideoMax" type="number" class="form-control" min="0" onchange="forceMin(event)" placeholder="En çok" />
              </div>
            </div>
          </div>
        </div>
        <div class="row">
          <button type="submit" name="search" class="btn btn-primary col-md-4 mx-auto mt-3 mt-xxl-4">
            Kanalları Bul
          </button>
        </div>
      </form>
    </div>
  </div>
  <script src="https://code.jquery.com/jquery-2.2.4.min.js" integrity="sha256-BbhdlvQf/xTY9gja0Dq3HiwQF8LaCRTXxZKRutelT44=" crossorigin="anonymous"></script>
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.1/dist/js/bootstrap.bundle.min.js" integrity="sha384-gtEjrD/SeCtmISkJkNUaaKMoLD0//ElJ19smozuHV6z3Iehds+3Ulb9Bn9Plx0x4" crossorigin="anonymous"></script>
  <script src="../../js/jquery.dropdown.min.js"></script>
  <script src="../../js/dropdown-multi.js"></script>
  <script src="../../js/minMax.js"></script>
</body>

</html>
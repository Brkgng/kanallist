<?php

/** @var $pdo \PDO */
require_once "./database.php";
require_once "./functions.php";


session_start();

// order channels with using selected option
$order = isset($_POST['order']) ? $_POST['order'] : "subscriber DESC";

// if page refreshed get result from session
if (isset($_SESSION['saveResult']) and !isset($_POST['search'])) {
  $_POST = $_SESSION['saveResult'];
}

//TODO sayfaya ingilizce ekle
//TODO youtube api ile guncellemeleri ayarla

if (!empty($_POST)) {
  // save post to session for using after refresh
  $_SESSION['saveResult'] = $_POST;
  // var_dump($_POST);

  // create where query using user inputs
  $whereQuery = getWhereQuery();

  // get channel count from database
  $channelCountQuery = getChannelCountQuery($whereQuery);
  $statement = $pdo->prepare($channelCountQuery);
  $statement->execute();
  $channelCount = $statement->fetchColumn();

  // number of channel on 1 page
  $channelPerPage = 48;

  // calculate number of total page
  $totalPage = ceil($channelCount / $channelPerPage);

  $currentPage = getCurrentPage($totalPage);

  // calculate pagination's first and last link nums  
  $linkStart = ($currentPage > 4) ? $currentPage - 4 : 1;
  $linkEnd = ($linkStart + 8 <= $totalPage) ? $linkStart + 8 : $totalPage;

  // get channels from database
  $limitStart = ($currentPage - 1) * $channelPerPage;
  $query = "SELECT * FROM channel WHERE $whereQuery ORDER BY $order LIMIT $limitStart, $channelPerPage";
  $statement = $pdo->prepare($query);
  $statement->execute();
  $channels = $statement->fetchAll(PDO::FETCH_ASSOC);
} else {
  header('Location: index.php');
  die;
}
?>

<!DOCTYPE html>
<html lang="en">

<?php
$title = "Size Özel Kanallar";
include_once('views/partials/header.php')
?>

<body class="p-3">
  <div class="container-fluid py-4 min-height bg-teal rounded-3">
    <div class="container-fluid rounded-3">
      <nav class="
            navbar navbar-expand-md
            mb-4
            p-0
            mt-xxl-3
            navbar-light
            bg-light
            rounded-12
            shadow
            w-lg-85
            mx-auto
          ">
        <div class="container-fluid ms-lg-5 me-lg-5">
          <a class="py-n3 header-a" href="index.php">
            <img src="/img/logo.png" alt="Logo" width="90" height="90" />
            <h2 class="d-inline-block title f-Poppins">KanalList</h2>
          </a>
          <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNavAltMarkup" aria-controls="navbarNavAltMarkup" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
          </button>
          <div class="collapse navbar-collapse" id="navbarNavAltMarkup">
            <div class="navbar-nav ms-auto f-Noto">
              <a class="nav-link nav-link-hover" aria-current="page" href="index.php">Ana Sayfa</a>
              <a class="nav-link nav-link-hover mx-1" href="contact.php">İletişim</a>
              <a class="nav-link nav-link-hover" href="#">SSS</a>
            </div>
          </div>
        </div>
      </nav>
      <form method="post" class="d-flex justify-content-md-end justify-content-center w-lg-85 mx-auto mt-4">
        <label for="select-order" class="my-auto me-4 f-Poppins" style="vertical-align: middle;">Sıralama:</label>
        <select id="select-order" name="order" class="form-select select-width" aria-label="Order by" onchange="this.form.submit()">
          <option value="subscriber DESC" <?php echo (strcmp($order, "subscriber DESC") == 0) ? "selected" : ""; ?>>Takipçi sayısı (azalan)</option>
          <option value="subscriber ASC" <?php echo (strcmp($order, "subscriber ASC") == 0) ? "selected" : ""; ?>>Takipçi sayısı (artan)</option>
          <option value="videoCount DESC" <?php echo (strcmp($order, "videoCount DESC") == 0) ? "selected" : ""; ?>>Video sayısı (azalan)</option>
          <option value="videoCount ASC" <?php echo (strcmp($order, "videoCount ASC") == 0) ? "selected" : ""; ?>>Video sayısı (artan)</option>
          <option value="totalView DESC" <?php echo (strcmp($order, "totalView DESC") == 0) ? "selected" : ""; ?>>Toplam İzlenme (azalan)</option>
          <option value="totalView ASC" <?php echo (strcmp($order, "totalView ASC") == 0) ? "selected" : ""; ?>>Toplam İzlenme (artan)</option>
        </select>
      </form>
    </div>

    <div class="row g-0 d-flex justify-content-md-between justify-content-center w-lg-90 mx-auto mt-4">
      <?php foreach ($channels as $channel) : ?>
        <div class="card col-md-2 border-primary mb-4 card-width">
          <a class="channel-title" href=" https://www.youtube.com/channel/<?= $channel['id'] ?>" target="_blank">
            <div class="card-header f-Poppins fs-4" title="<?= $channel['name'] ?>">
              <?php echo (strlen($channel['name']) < 19) ? $channel['name'] : substr($channel['name'], 0, 18) . "..."; ?>
            </div>
            <div class="card-body pt-2">
              <p class="card-text">
                Kategori: <?php echo channelCategoryTR($channel['category']) ?><br />
                Abone Sayısı: <?php echo numberFormatter($channel['subscriber']) ?><br />

                Video Sayısı: <?php echo $channel['videoCount'] ?><br />
                Toplam İzlenme: <?php echo numberFormatter($channel['totalView']) ?><br>
                Dil: <?php echo channelLanguageTR($channel['language']) ?>
              </p>
            </div>
            <div class="position-absolute bottom-0 end-0 me-md-2 me-1 mb-4">
              <img src="<?php echo $channel['thumbnail'] ?>" class="rounded-1 thumbnail-size" onerror="this.src='../../img/default-channel-logo.png'" alt="" />
            </div>
          </a>
        </div>
      <?php endforeach; ?>
    </div>
    <nav aria-label="Page navigation" class="mt-2 hidden-xs">
      <ul class="pagination justify-content-center">
        <?php $isFirst = ($currentPage == 1) ? "disabled" : "" ?>
        <li class="page-item <?= $isFirst; ?>">
          <a class="page-link" href="result.php?page=<?= 1; ?>">&laquo;</a>
        </li>
        <?php for ($i = $linkStart; $i <= $linkEnd; $i++) : ?>
          <?php $activeLink = ($i == $currentPage) ? "active" : "" ?>
          <li class="page-item <?= $activeLink; ?>"><a class="page-link" href="result.php?page=<?= $i; ?>"><?= $i ?></a></li>
        <?php endfor; ?>
        <?php $isLast = ($currentPage == $totalPage) ? "disabled" : "" ?>
        <li class="page-item <?= $isLast; ?>">
          <a class="page-link" href="result.php?page=<?= $totalPage; ?>">&raquo;</a>
        </li>
      </ul>
    </nav>
  </div>

  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.1/dist/js/bootstrap.bundle.min.js" integrity="sha384-gtEjrD/SeCtmISkJkNUaaKMoLD0//ElJ19smozuHV6z3Iehds+3Ulb9Bn9Plx0x4" crossorigin="anonymous"></script>
</body>

</html>
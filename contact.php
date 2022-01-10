<!DOCTYPE html>
<html lang="en">

<?php
$title = "İletişim";
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
            w-md-82
            mx-auto
          ">
        <div class="container-fluid ms-lg-5">
          <a class="py-n3" href="#">
            <img src="../../img/logo.png" alt="Logo" width="90" height="90" />
			      <h2 class="d-inline-block title f-Poppins">KanalList</h2>
          </a>
          <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNavAltMarkup" aria-controls="navbarNavAltMarkup" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
          </button>
          <div class="collapse navbar-collapse" id="navbarNavAltMarkup">
            <div class="navbar-nav ms-auto me-lg-5 f-Noto">
              <a class="nav-link nav-link-hover" aria-current="page" href="index.php">Ana Sayfa</a>
              <a class="nav-link active nav-link-hover mx-1" href="contact.php">İletişim</a>
              <a class="nav-link nav-link-hover" href="#">SSS</a>
            </div>
          </div>
        </div>
      </nav>
      <div class="row w-md-82 mx-auto my-5 pt-xxl-4 pb-xxl-1">
        <div class="col-lg-7">
          <form method="POST" action="https://formspree.io/f/mnqlbjyz" class="needs-validation" novalidate>
            <div class="row">
              <div class="col mb-3">
                <label for="firstName" class="form-label">Ad</label>
                <input type="text" class="form-control" id="firstName" name="_fname" placeholder="Ad" required />
                <div class="valid-feedback">Güzel gözüküyor.</div>
                <div class="invalid-feedback">Lütfen adınızı girin.</div>
              </div>
              <div class="col mb-3">
                <label for="lastName" class="form-label">Soyad</label>
                <input type="text" class="form-control" id="lastName" name="_lname" placeholder="Soyad" required />
                <div class="invalid-feedback">Lütfen soyadınızı girin.</div>
              </div>
            </div>
            <div class="mb-3">
              <label for="emailAddress" class="form-label">E-mail adres</label>
              <input type="email" name="_replyto" class="form-control" id="emailAddress" placeholder="mailiniz@adres.com" required />
              <small><img src="/img/info.svg" alt="" /> Yazdığınız mail adresine
                geri dönüş yapacağız.</small>
              <div class="invalid-feedback">Lütfen mail adresi girin.</div>
            </div>
            <div class="mb-3">
              <label for="subject" class="form-label">Konu</label>
              <input type="text" name="_subject" class="form-control" id="subject" placeholder="Konu" required />
              <div class="invalid-feedback">Lütfen konu girin.</div>
            </div>
            <div class="mb-3">
              <label for="message" class="form-label">Mesaj</label>
              <textarea class="form-control" id="message" name="message" rows="3" placeholder="Mesajınızı buraya yazın" required></textarea>
              <div class="invalid-feedback">Lütfen mesajınızı girin.</div>
            </div>
            <div class="row mx-auto">
              <button type="submit" class="btn btn-primary col-5 mx-auto mt-1 mt-xxl-3">
                Gönder
              </button>
            </div>
          </form>
        </div>
        <div class="d-none d-lg-block col-lg-4 offset-1 my-auto">
          <div class="">
            <img src="../../img/mail.png" alt="free" class="img-fluid" />
          </div>
        </div>
      </div>
    </div>
  </div>

  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.1/dist/js/bootstrap.bundle.min.js" integrity="sha384-gtEjrD/SeCtmISkJkNUaaKMoLD0//ElJ19smozuHV6z3Iehds+3Ulb9Bn9Plx0x4" crossorigin="anonymous"></script>
  <script src="../../js/form-validation.js"></script>
</body>

</html>
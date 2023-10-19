<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title>Sistem Pembelajaran Berbasis Website</title>
  <link rel="stylesheet" href="assets/main.css" />
  <link rel="stylesheet" href="node_modules/bootstrap/dist/css/bootstrap.css" />
</head>

<body>
  <div class="text-bg-primary p-5 mt-5">
    <div class="container">Selamat memulai Belajar !!!</div>
  </div>

  <nav class="navbar navbar-expand-lg bg-body-tertiary fixed-top navbar-light shadow">
    <div class="container">
      <a class="navbar-brand" href="#">
        <img src="https://getbootstrap.com/docs/5.3/assets/brand/bootstrap-logo.svg" alt="Bootstrap" width="30" height="24" />
      </a>

      <div class="collapse navbar-collapse" id="navbarNav">
        <ul class="navbar-nav">
          <li class="nav-item">
            <a class="nav-link" href="#scrollspyBeranda">Beranda</a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="#scrollspyPanduan">Panduan</a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="#scrollspyProfil">Profil</a>
          </li>
        </ul>
      </div>

      <div>
        <a class="btn btn-primary btn-sm" href="view/login-page.php">
          <i class="bi bi-person-fill"></i> Login
        </a>
      </div>
    </div>
  </nav>

  <div id="scrollspyBeranda" class="container my-5 py-5">
    <div class="row row-cols-1 row-cols-lg-2 g-lg-0">
      <div class="col align-self-center">
        <h3>Belajar Programing ?</h3>
        <p>
          Pemrograman adalah proses membuat rangkaian instruksi yang
          mengarahkan komputer atau perangkat lain untuk melakukan tindakan
          atau pemrosesan tertentu. Ini melibatkan merancang, mengembangkan,
          dan menuliskan kode yang dapat diinterpretasikan oleh komputer untuk
          mengeksekusi tugas-tugas yang telah ditentukan.
        </p>
        <a class="btn btn-primary btn-sm mt-5" href="#">Belajar Sekarang <i class="bi bi-arrow-right"></i></a>
      </div>
      <div class="col">
        <img class="img-fluid" src="assets/img/pair-programming-animate.svg" alt="" />
      </div>
    </div>
  </div>

  <div id="scrollspyPanduan" class="container mt-5">
    <div class="p-5">
      <h2 class="text-center">Bagaimana Kita Memulai ?</h2>
      <p class="text-center">
        Belajar dasar pemrograman bagi pemula adalah langkah penting dalam
        memahami fondasi teknologi yang membentuk dunia modern. Dengan
        memahami konsep dasar seperti variabel, kondisi, dan pengulangan, Anda
        memperoleh kemampuan untuk merancang dan menciptakan solusi untuk
        masalah nyata melalui kode. Kemampuan ini membangun fondasi yang kuat
        untuk pengembangan keterampilan lebih lanjut dalam pemrograman yang
        dapat diterapkan dalam berbagai industri, mengasah kreativitas,
        memupuk pemikiran analitis, dan membuka pintu bagi peluang karir yang
        semakin terhubung dengan teknologi.
      </p>

      <h4 class="pt-5">Ikuti langkah ini :</h4>
      <table class="table table-borderless table-responsive">
        <tbody>
          <tr>
            <td><span class="badge text-bg-primary">Langkah 1</span></td>
            <td>Lakukan Login Dengan Username Dan password</td>
          </tr>
          <tr>
            <td><span class="badge text-bg-primary">Langkah 2</span></td>
            <td>Pada Menu Materi Pilih Materi yang Ingin di Pelajari</td>
          </tr>
          <tr>
            <td><span class="badge text-bg-primary">Langkah 3</span></td>
            <td>kerjakan Pre-Test</td>
          </tr>
          <tr>
            <td><span class="badge text-bg-primary">Langkah 4</span></td>
            <td>Baca seluruh Materi dan Pahami</td>
          </tr>
          <tr>
            <td><span class="badge text-bg-primary">Langkah 5</span></td>
            <td>Tonton Vidio Dari Materi yang Anda baca</td>
          </tr>
          <tr>
            <td><span class="badge text-bg-primary">Langkah 6</span></td>
            <td>
              Kerjakan Simulasi Sebagai Bukti Bahwa Anda sudah menguasai
              Materi Tersebut
            </td>
          </tr>
          <tr>
            <td><span class="badge text-bg-primary">Langkah 7</span></td>
            <td>Kerjakan Post-Test</td>
          </tr>
          <tr>
            <td><span class="badge text-bg-primary">Langkah 8</span></td>
            <td>Pilih Materi lainnya</td>
          </tr>
        </tbody>
      </table>
    </div>
  </div>

  <div class="container mt-5">
    <h3 class="text-end" id="scrollspyProfil">Tentang Saya</h3>
  </div>

  <div class="border container p-5">
    <div class="row g-0">
      <div class="col-4">
        <img class="img-fluid w-75" src="assets/img/default.png" alt="profil" />
      </div>

      <div class="col-8">
        <blockquote>
          “Mengandalkan kuliah saja, tidak cukup. Dengan Dicoding, saya mantap
          tinggalkan dunia gaming lantas belajar dunia Android yang ternyata
          menyenangkan. Yang nomor satu, Dicoding mengajarkan ilmu
          berorientasi kerja. Kini saya sangat terbantu dalam karir saya.”
        </blockquote>
        <div>
          <span class="badge text-dark fw-light fw-bold">Muhammad Rizal Pane</span>
        </div>
        <div>
          <span class="badge text-dark fw-light fw-bold">Pendidikan Tehnik Informatika dan Komputer - Universitas Negeri
            Medan</span>
        </div>
        <div>
          <p class="badge text-dark">Follow me :</p>
          <span class="badge text-dark"><a class="link-underline link-underline-opacity-0" href="#">Instagram</a></span>
          <span class="badge text-dark"><a class="link-underline link-underline-opacity-0" href="#">Telegram</a></span>
          <span class="badge text-dark"><a class="link-underline link-underline-opacity-0" href="#">Whatsapp</a></span>
          <span class="badge text-dark"><a class="link-underline link-underline-opacity-0" href="#">Discord</a></span>
        </div>
      </div>
    </div>
  </div>
</body>

</html>
l
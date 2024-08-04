<?php
session_start();
?>
<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="utf-8">
  <meta content="width=device-width, initial-scale=1.0" name="viewport">

  <title>Asoka</title>
  <meta content="" name="description">
  <meta content="" name="keywords">

  <!-- Google Fonts -->
  <link href="https://fonts.gstatic.com" rel="preconnect">
  <link href="https://fonts.googleapis.com/css?family=Open+Sans:300,300i,400,400i,600,600i,700,700i|Nunito:300,300i,400,400i,600,600i,700,700i|Poppins:300,300i,400,400i,500,500i,600,600i,700,700i" rel="stylesheet">

  <!-- Vendor CSS Files -->
  <link href="../../assets/vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet">
  <link href="../../assets/vendor/bootstrap-icons/bootstrap-icons.css" rel="stylesheet">
  <link href="../../assets/vendor/boxicons/css/boxicons.min.css" rel="stylesheet">
  <link href="../../assets/vendor/quill/quill.snow.css" rel="stylesheet">
  <link href="../../assets/vendor/quill/quill.bubble.css" rel="stylesheet">
  <link href="../../assets/vendor/remixicon/remixicon.css" rel="stylesheet">
  <link href="../../assets/vendor/simple-datatables/style.css" rel="stylesheet">

  <!-- Template Main CSS File -->
  <link href="../../assets/css/style.css" rel="stylesheet">
</head>

<body>

  <!-- ======= Header ======= -->
  <header id="header" class="header fixed-top d-flex align-items-center">

    <div class="d-flex align-items-center justify-content-between">
      <a href="menu" class="logo d-flex align-items-center">
        <img src="assets/img/logo.png" alt="">
        <span class="d-none d-lg-block">Asoka</span>
      </a>
    </div><!-- End Logo -->

  </header><!-- End Header -->

  <body>

  <main>
    <div class="container">
        <!-- Section-->
        <section class="py-5">
            <div class="container px-4 px-lg-5 mt-5">
              <div class="row g-4">
                <?php
                include '../../koneksi.php';
                $sql_meja = "SELECT * FROM tbmeja ORDER BY no_meja ASC";
                $query_meja = mysqli_query($con, $sql_meja);
                $jumlah_data_meja = mysqli_num_rows($query_meja);

                if ($jumlah_data_meja > 0) {
                    while ($data_meja = mysqli_fetch_array($query_meja)) {
                        $image_path = ($data_meja['status'] == 'Terisi') ? 'meja1.png' : 'meja.png';
                        $status_text = ($data_meja['status'] == 'terisi') ? 'Terisi' : 'Kosong';
                ?>
                        <div class="col md-3 col-sm-3 mt-2">
                            <div class="card">
                                <div class="card-body position-relative">
                                <img class="card-img-top" src="../../assets/img/<?php echo $image_path; ?>" alt="Table Image" />
                                    <div class="overlay position-absolute top-50 start-50 translate-middle text-center">
                                        <span class="text-black fs-4">Meja <?php echo $data_meja['no_meja']; ?></span>
                                    </div>
                                    <?php 
                                    if($data_meja['status'] == 'Kosong'){?>
                                    <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#modalPilihMeja<?php echo $data_meja['id_meja']; ?>">
                                      Pilih Meja
                                    </button>
                                    <?php
                                    }else{
                                      ?>
                                      <p class="text-danger">Meja Sudah Terisi</p>
                                    <?php } ?>
                                </div>
                            </div>
                        </div>

                        <!-- Modal for entering name -->
                        
                            <div class="modal fade" id="modalPilihMeja<?php echo $data_meja['id_meja']; ?>" tabindex="-1">
                                <div class="modal-dialog">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <h5 class="modal-title">Masukkan Nama untuk Meja <?php echo $data_meja['no_meja']; ?></h5>
                                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                        </div>
                                        <div class="modal-body">
                                            <form method="post" action="action/login.php">
                                                <input type="hidden" name="id_meja" value="<?php echo $data_meja['id_meja']; ?>" />
                                                <label for="nama">Nama:</label>
                                                <input type="text" name="nama" class="form-control" required />
                                                <button type="submit" class="btn btn-primary mt-2">Masuk</button>
                                            </form>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        <?php
                        }
                    }
                ?>
            </div>
        </section>
    </div>
</main>


<a href="#" class="back-to-top d-flex align-items-center justify-content-center"><i class="bi bi-arrow-up-short"></i></a>

  <!-- Vendor JS Files -->
  <script src="../../assets/vendor/apexcharts/apexcharts.min.js"></script>
  <script src="../../assets/vendor/bootstrap/js/bootstrap.bundle.min.js"></script>
  <script src="../../assets/vendor/chart.js/chart.umd.js"></script>
  <script src="../../assets/vendor/echarts/echarts.min.js"></script>
  <script src="../../assets/vendor/quill/quill.min.js"></script>
  <script src="../../assets/vendor/simple-datatables/simple-datatables.js"></script>
  <script src="../../assets/vendor/tinymce/tinymce.min.js"></script>
  <script src="../../assets/vendor/php-email-form/validate.js"></script>

  <!-- Template Main JS File -->
  <script src="../../assets/js/main.js"></script>

</body>

</html>
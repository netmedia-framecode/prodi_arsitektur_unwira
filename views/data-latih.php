<?php require_once("../controller/script.php");
require_once("redirect.php");
$_SESSION["page-name"] = "Dataset Mahasiswa";
$_SESSION["page-url"] = "data-latih";
?>

<!DOCTYPE html>
<html lang="en">

<head><?php require_once("../resources/dash-header.php") ?></head>

<body>
  <?php if (isset($_SESSION["message-success"])) { ?>
    <div class="message-success" data-message-success="<?= $_SESSION["message-success"] ?>"></div>
  <?php }
  if (isset($_SESSION["message-info"])) { ?>
    <div class="message-info" data-message-info="<?= $_SESSION["message-info"] ?>"></div>
  <?php }
  if (isset($_SESSION["message-warning"])) { ?>
    <div class="message-warning" data-message-warning="<?= $_SESSION["message-warning"] ?>"></div>
  <?php }
  if (isset($_SESSION["message-danger"])) { ?>
    <div class="message-danger" data-message-danger="<?= $_SESSION["message-danger"] ?>"></div>
  <?php } ?>
  <div class="container-scroller">
    <?php require_once("../resources/dash-topbar.php") ?>
    <div class="container-fluid page-body-wrapper">
      <?php require_once("../resources/dash-sidebar.php") ?>
      <div class="main-panel">
        <div class="content-wrapper">
          <div class="row">
            <div class="col-sm-12">
              <div class="home-tab">
                <div class="d-sm-flex align-items-center justify-content-between border-bottom">
                  <ul class="nav nav-tabs" role="tablist">
                    <li class="nav-item">
                      <h3>Dataset Mahasiswa</h3>
                    </li>
                  </ul>
                  <div>
                    <div class="btn-wrapper">
                      <button type="button" class="btn btn-primary text-white me-0 btn-sm rounded-0" data-bs-toggle="modal" data-bs-target="#exampleModal">
                        Import
                      </button>
                      <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                        <div class="modal-dialog">
                          <div class="modal-content">
                            <div class="modal-header">
                              <h5 class="modal-title" id="exampleModalLabel">File Data Latih</h5>
                              <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                            </div>
                            <form action="" method="post" enctype="multipart/form-data">
                              <div class="modal-body">
                                <div class="mb-3">
                                  <label for="formFile" class="form-label">Masukan data kamu berupa file Excel</label>
                                  <input name="excelFile" class="form-control" type="file" id="formFile" accept=".xlsx, .xls" required>
                                </div>
                              </div>
                              <div class="modal-footer border-top-0 justify-content-center">
                                <button type="button" class="btn btn-secondary btn-sm rounded-0" data-bs-dismiss="modal">Batal</button>
                                <button type="submit" name="import-latih" class="btn btn-primary text-white btn-sm rounded-0">Simpan</button>
                              </div>
                            </form>
                          </div>
                        </div>
                      </div>
                      <a href="#" class="btn btn-primary text-white me-0 btn-sm rounded-0" data-bs-toggle="modal" data-bs-target="#tambah">Tambah</a>
                    </div>
                  </div>
                </div>
                <div class="data-main">
                  <div class="card rounded-0 mt-3">
                    <div class="card-body table-responsive">
                      <table class="table table-bordered table-striped table-hover table-sm display" id="datatable">
                        <thead>
                          <tr>
                            <th scope="col" class="text-center" rowspan="2">#</th>
                            <th scope="col" class="text-center" rowspan="2">NIM</th>
                            <th scope="col" class="text-center" rowspan="2">Nama</th>
                            <th scope="colgroup" class="text-center" colspan="7">IPK</th>
                            <th scope="colgroup" class="text-center" colspan="6">Nilai Matakuliah Studio Perancangan Arsitektur</th>
                            <th scope="col" class="text-center" rowspan="2">Nilai Rata-Rata IPK</th>
                            <th scope="col" class="text-center" rowspan="2">Nilai Rata-Rata SPA</th>
                            <th scope="col" class="text-center" rowspan="2">Nilai Rata-Rata IPK Dan SPA</th>
                            <th scope="colgroup" class="text-center" colspan="<?php $count_atribut = mysqli_num_rows($atributs);
                                                                              echo $count_atribut; ?>">Atribut</th>
                            <th scope="col" class="text-center" rowspan="2">Aksi</th>
                          </tr>
                          <tr>
                            <th scope="col" class="text-center">1</th>
                            <th scope="col" class="text-center">2</th>
                            <th scope="col" class="text-center">3</th>
                            <th scope="col" class="text-center">4</th>
                            <th scope="col" class="text-center">5</th>
                            <th scope="col" class="text-center">6</th>
                            <th scope="col" class="text-center">7</th>
                            <th scope="col" class="text-center">1</th>
                            <th scope="col" class="text-center">2</th>
                            <th scope="col" class="text-center">3</th>
                            <th scope="col" class="text-center">4</th>
                            <th scope="col" class="text-center">5</th>
                            <th scope="col" class="text-center">6</th>
                            <?php foreach ($atributs as $key => $val) : ?>
                              <th scope="col" class="text-center" rowspan="2"><?= str_replace("_", " ", $val['atribut']) ?></th>
                            <?php endforeach; ?>
                          </tr>
                        </thead>
                        <tbody>
                          <?php if (mysqli_num_rows($data_latih) > 0) {
                            $no = 1;
                            while ($row = mysqli_fetch_assoc($data_latih)) {
                              $id_latih = $row['id_latih']; ?>
                              <tr>
                                <th scope="row"><?= $no; ?></th>
                                <td><?= $row["nim"] ?></td>
                                <td><?= $row["nama"] ?></td>
                                <?php $ipk = "SELECT * FROM ipk_latih WHERE id_latih='$id_latih'";
                                $data_ipk = mysqli_query($conn, $ipk);
                                foreach ($data_ipk as $row_ipk) : ?>
                                  <td><?= $row_ipk["nilai_ipk"] ?></td>
                                <?php endforeach;
                                $spa = "SELECT * FROM spa_latih WHERE id_latih='$id_latih'";
                                $data_spa = mysqli_query($conn, $spa);
                                foreach ($data_spa as $row_spa) : ?>
                                  <td><?= $row_spa["nilai_spa"] ?></td>
                                <?php endforeach; ?>
                                <td><?= $row["nilai_rata_rata_ipk"] ?></td>
                                <td><?= $row["nilai_rata_rata_spa"] ?></td>
                                <td><?= $row["nilai_rata_rata"] ?></td>
                                <?php
                                $atribut_sub_view = "SELECT atribut_sub.atribut_sub FROM atribut_latih JOIN atribut_sub ON atribut_latih.id_atribut_sub=atribut_sub.id_atribut_sub WHERE atribut_latih.id_latih='$id_latih'";
                                $atributSubView = mysqli_query($conn, $atribut_sub_view);
                                if (mysqli_num_rows($atributSubView) > 0) {
                                  while ($row_atribut_sub_view = mysqli_fetch_assoc($atributSubView)) { ?>
                                    <td><?= $row_atribut_sub_view['atribut_sub'] ?></td>
                                <?php
                                  }
                                } ?>
                                <td class="d-flex justify-content-center">
                                  <div class="col">
                                    <button type="button" class="btn btn-warning btn-sm text-white rounded-0 border-0" style="height: 30px;" data-bs-toggle="modal" data-bs-target="#ubah<?= $row["id_latih"] ?>">
                                      <i class="bi bi-pencil-square"></i>
                                    </button>
                                    <div class="modal fade" id="ubah<?= $row["id_latih"] ?>" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                      <div class="modal-dialog">
                                        <div class="modal-content">
                                          <div class="modal-header border-bottom-0 shadow">
                                            <h5 class="modal-title" id="exampleModalLabel">Ubah data <?= $row["nama"] ?></h5>
                                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                          </div>
                                          <form action="" method="POST">
                                            <div class="modal-body text-center">
                                              <div class="mb-3">
                                                <label for="nim" class="form-label">NIM <small class="text-danger">*</small></label>
                                                <input type="number" name="nim" value="<?= $row['nim'] ?>" class="form-control text-center" id="nim" minlength="3" placeholder="NIM" required>
                                              </div>
                                              <div class="mb-3">
                                                <label for="nama" class="form-label">Nama <small class="text-danger">*</small></label>
                                                <input type="text" name="nama" value="<?= $row['nama'] ?>" class="form-control text-center" id="nama" placeholder="Nama" required>
                                              </div>
                                              <?php
                                              $jenisKelamin1 = mysqli_query($conn, $jenis_kelamin);
                                              if (mysqli_num_rows($jenisKelamin1) > 0) { ?>
                                                <div class="mb-3">
                                                  <label for="id_jenis_kelamin" class="form-label">Jenis Kelamin <small class="text-danger">*</small></label>
                                                  <select name="id_jenis_kelamin" id="id_jenis_kelamin" class="form-select" aria-label="Default select example" required>
                                                    <option selected value="">Pilih Jenis Kelamin</option>
                                                    <?php while ($row_jk = mysqli_fetch_assoc($jenisKelamin1)) { ?>
                                                      <option value="<?= $row_jk['id_atribut_sub'] ?>"><?= $row_jk['atribut_sub'] ?></option>
                                                    <?php } ?>
                                                  </select>
                                                </div>
                                              <?php }
                                              $ipk = "SELECT * FROM ipk_latih JOIN status_ipk ON ipk_latih.id_status_ipk=status_ipk.id_status_ipk WHERE ipk_latih.id_latih='$id_latih'";
                                              $data_ipk = mysqli_query($conn, $ipk);
                                              foreach ($data_ipk as $row_ipk) : ?>
                                                <div class="mb-3">
                                                  <label for="nilai_ipk" class="form-label">Nilai IPK <?= $row_ipk['status_ipk'] ?> <small class="text-danger">*</small></label>
                                                  <input type="number" step="0.01" min="0" name="nilai_ipk[]" value="<?= $row_ipk['nilai_ipk'] ?>" class="form-control text-center" id="nilai_ipk" placeholder="Nilai IPK <?= $row_ipk['status_ipk'] ?>" required>
                                                </div>
                                              <?php endforeach;
                                              $spa = "SELECT * FROM spa_latih JOIN status_spa ON spa_latih.id_status_spa=status_spa.id_status_spa WHERE spa_latih.id_latih='$id_latih'";
                                              $data_spa = mysqli_query($conn, $spa);
                                              foreach ($data_spa as $row_spa) : ?>
                                                <div class="mb-3">
                                                  <label for="nilai_spa" class="form-label">Nilai SPA <?= $row_spa['status_spa'] ?> <small class="text-danger">*</small></label>
                                                  <input type="number" step="0.01" min="0" name="nilai_spa[]" value="<?= $row_spa['nilai_spa'] ?>" class="form-control text-center" id="nilai_spa" placeholder="Nilai SPA <?= $row_spa['status_spa'] ?>" required>
                                                </div>
                                              <?php endforeach; ?>
                                            </div>
                                            <div class="modal-footer justify-content-center border-top-0">
                                              <input type="hidden" name="id_latih" value="<?= $row["id_latih"] ?>">
                                              <input type="hidden" name="nimOld" value="<?= $row["nim"] ?>">
                                              <button type="button" class="btn btn-secondary btn-sm rounded-0 border-0" style="height: 30px;" data-bs-dismiss="modal">Batal</button>
                                              <button type="submit" name="ubah-latih" class="btn btn-warning btn-sm rounded-0 border-0" style="height: 30px;">Ubah</button>
                                            </div>
                                          </form>
                                        </div>
                                      </div>
                                    </div>
                                  </div>
                                  <div class="col">
                                    <button type="button" class="btn btn-danger btn-sm text-white rounded-0 border-0" style="height: 30px;" data-bs-toggle="modal" data-bs-target="#hapus<?= $row["id_latih"] ?>">
                                      <i class="bi bi-trash3"></i>
                                    </button>
                                    <div class="modal fade" id="hapus<?= $row["id_latih"] ?>" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                      <div class="modal-dialog">
                                        <div class="modal-content">
                                          <div class="modal-header border-bottom-0 shadow">
                                            <h5 class="modal-title" id="exampleModalLabel">Hapus data <?= $row["nama"] ?></h5>
                                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                          </div>
                                          <div class="modal-body text-center">
                                            Anda yakin ingin menghapus data ini?
                                          </div>
                                          <div class="modal-footer justify-content-center border-top-0">
                                            <button type="button" class="btn btn-secondary btn-sm rounded-0 border-0" style="height: 30px;" data-bs-dismiss="modal">Batal</button>
                                            <form action="" method="POST">
                                              <input type="hidden" name="id_latih" value="<?= $row["id_latih"] ?>">
                                              <button type="submit" name="hapus-latih" class="btn btn-danger btn-sm rounded-0 text-white border-0" style="height: 30px;">Hapus</button>
                                            </form>
                                          </div>
                                        </div>
                                      </div>
                                    </div>
                                  </div>
                                </td>
                              </tr>
                          <?php $no++;
                            }
                          } ?>
                        </tbody>
                      </table>
                    </div>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>

        <div class="modal fade" id="tambah" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
          <div class="modal-dialog">
            <div class="modal-content">
              <div class="modal-header border-bottom-0 shadow">
                <h5 class="modal-title" id="exampleModalLabel">Tambah Mahasiswa</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
              </div>
              <form action="" method="post" name="random_form">
                <div class="modal-body text-center">
                  <div class="mb-3">
                    <label for="nim" class="form-label">NIM <small class="text-danger">*</small></label>
                    <input type="number" name="nim" value="<?php if (isset($_POST['nim'])) {
                                                              echo $_POST['nim'];
                                                            } ?>" class="form-control text-center" id="nim" minlength="3" placeholder="NIM" required>
                  </div>
                  <div class="mb-3">
                    <label for="nama" class="form-label">Nama <small class="text-danger">*</small></label>
                    <input type="text" name="nama" value="<?php if (isset($_POST['nama'])) {
                                                            echo $_POST['nama'];
                                                          } ?>" class="form-control text-center" id="nama" placeholder="Nama" required>
                  </div>
                  <?php if (mysqli_num_rows($jenisKelamin2) > 0) { ?>
                    <div class="mb-3">
                      <label for="id_jenis_kelamin" class="form-label">Jenis Kelamin <small class="text-danger">*</small></label>
                      <select name="id_jenis_kelamin" id="id_jenis_kelamin" class="form-select" aria-label="Default select example" required>
                        <option selected value="">Pilih Jenis Kelamin</option>
                        <?php while ($row_jk = mysqli_fetch_assoc($jenisKelamin2)) { ?>
                          <option value="<?= $row_jk['id_atribut_sub'] ?>"><?= $row_jk['atribut_sub'] ?></option>
                        <?php } ?>
                      </select>
                    </div>
                  <?php }
                  foreach ($statusIPK as $key_ipk => $row_ipk) : ?>
                    <div class="mb-3">
                      <label for="nilai_ipk" class="form-label">Nilai IPK <?= $row_ipk['status_ipk'] ?> <small class="text-danger">*</small></label>
                      <input type="number" step="0.01" min="0" name="nilai_ipk[]" value="<?php if (isset($_POST['nilai_ipk'][$key_ipk])) {
                                                                                            echo $_POST['nilai_ipk'][$key_ipk];
                                                                                          } else {
                                                                                            echo 0;
                                                                                          } ?>" class="form-control text-center" id="nilai_ipk" placeholder="Nilai IPK <?= $row_ipk['status_ipk'] ?>" required>
                    </div>
                  <?php endforeach;
                  foreach ($statusSPA as $key_spa => $row_spa) : ?>
                    <div class="mb-3">
                      <label for="nilai_spa" class="form-label">Nilai SPA <?= $row_spa['status_spa'] ?> <small class="text-danger">*</small></label>
                      <input type="number" step="0.01" min="0" name="nilai_spa[]" value="<?php if (isset($_POST['nilai_spa'][$key_spa])) {
                                                                                            echo $_POST['nilai_spa'][$key_spa];
                                                                                          } else {
                                                                                            echo 0;
                                                                                          } ?>" class="form-control text-center" id="nilai_spa" placeholder="Nilai SPA <?= $row_spa['status_spa'] ?>" required>
                    </div>
                  <?php endforeach; ?>
                </div>
                <div class="modal-footer border-top-0 justify-content-center">
                  <button type="button" class="btn btn-secondary btn-sm rounded-0" data-bs-dismiss="modal">Batal</button>
                  <button type="submit" name="tambah-latih" class="btn btn-primary btn-sm rounded-0 border-0">Simpan</button>
                </div>
              </form>
            </div>
          </div>
        </div>
        <?php require_once("../resources/dash-footer.php") ?>
</body>

</html>
<?php require_once("../controller/script.php");
require_once("redirect.php");
if ($_SESSION['data-user']['role'] == 3) {
  header("Location: " . $_SESSION['page-url']);
  exit();
}
$_SESSION['page-name'] = "Kelola Pegawai";
$_SESSION['page-url'] = "pegawai";
?>

<!DOCTYPE html>
<html lang="en">

<head><?php require_once("../resources/dash-header.php") ?></head>

<body>
  <?php if (isset($_SESSION['message-success'])) { ?>
    <div class="message-success" data-message-success="<?= $_SESSION['message-success'] ?>"></div>
  <?php }
  if (isset($_SESSION['message-info'])) { ?>
    <div class="message-info" data-message-info="<?= $_SESSION['message-info'] ?>"></div>
  <?php }
  if (isset($_SESSION['message-warning'])) { ?>
    <div class="message-warning" data-message-warning="<?= $_SESSION['message-warning'] ?>"></div>
  <?php }
  if (isset($_SESSION['message-danger'])) { ?>
    <div class="message-danger" data-message-danger="<?= $_SESSION['message-danger'] ?>"></div>
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
                <div class="card card-rounded mt-3">
                  <div class="card-body">
                    <div class="table-responsive  mt-1">
                      <table class="table select-table text-center">
                        <thead>
                          <tr>
                            <th>Nama</th>
                            <th>Email</th>
                            <th>Pangkat</th>
                            <th>Telp</th>
                            <th>Tgl Dibuat</th>
                            <th>Tgl Diubah</th>
                            <?php if ($_SESSION['data-user']['role'] == 1) { ?>
                              <th colspan="2">Aksi</th>
                            <?php } ?>
                          </tr>
                        </thead>
                        <tbody id="search-page">
                          <?php if (mysqli_num_rows($pegawai) == 0) { ?>
                            <tr>
                              <td colspan="9">Belum ada data pegawai</td>
                            </tr>
                            <?php } else if (mysqli_num_rows($pegawai) > 0) {
                            while ($row = mysqli_fetch_assoc($pegawai)) { ?>
                              <tr>
                                <td>
                                  <div class="d-flex">
                                    <img src="../assets/images/user.png" alt="">
                                    <div class="my-auto">
                                      <h6><?= $row['username'] ?></h6>
                                      <p><?= $row['status_pegawai'] ?></p>
                                    </div>
                                  </div>
                                </td>
                                <td><?= $row['email'] ?></td>
                                <td><?= $row['pangkat'] ?></td>
                                <td><?= $row['telp'] ?></td>
                                <td>
                                  <div class="badge badge-opacity-success">
                                    <?php $dateCreate = date_create($row['created_at']);
                                    echo date_format($dateCreate, "l, d M Y h:i a"); ?>
                                  </div>
                                </td>
                                <td>
                                  <div class="badge badge-opacity-warning">
                                    <?php $dateUpdate = date_create($row['updated_at']);
                                    echo date_format($dateUpdate, "l, d M Y h:i a"); ?>
                                  </div>
                                </td>
                                <td>
                                  <!-- <form action="" method="post">
                                    <input type="hidden" name="id-user" value="<?= $row['id_user'] ?>">
                                    <button type="submit" name="check-smart" class="btn btn-success btn-sm">
                                      <i class="mdi mdi-contact-mail"></i>
                                    </button>
                                  </form> -->
                                </td>
                                <?php if ($_SESSION['data-user']['role'] == 1) { ?>
                                  <td>
                                    <button type="button" class="btn btn-danger btn-sm" data-bs-toggle="modal" data-bs-target="#hapus<?= $row['id_user'] ?>">
                                      <i class="mdi mdi-delete"></i>
                                    </button>
                                    <div class="modal fade" id="hapus<?= $row['id_user'] ?>" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                      <div class="modal-dialog">
                                        <div class="modal-content">
                                          <div class="modal-header border-bottom-0">
                                            <h5 class="modal-title" id="exampleModalLabel"><?= $row['username'] ?></h5>
                                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                          </div>
                                          <div class="modal-body">
                                            Anda yakin ingin menghapus <?= $row['username'] ?> ini?
                                          </div>
                                          <div class="modal-footer justify-content-center border-top-0">
                                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Batal</button>
                                            <form action="" method="POST">
                                              <input type="hidden" name="id-user" value="<?= $row['id_user'] ?>">
                                              <input type="hidden" name="username" value="<?= $row['username'] ?>">
                                              <button type="submit" name="hapus-user" class="btn btn-danger">Hapus</button>
                                            </form>
                                          </div>
                                        </div>
                                      </div>
                                    </div>
                                  </td>
                                <?php } ?>
                              </tr>
                          <?php }
                          } ?>
                        </tbody>
                      </table>
                      <?php if ($total_role2 > $data_role2) { ?>
                        <div class="d-flex justify-content-between mt-4 flex-wrap">
                          <p class="text-muted">Showing 1 to <?= $data_role2 ?> of <?= $total_role2 ?> entries</p>
                          <nav class="ml-auto">
                            <ul class="pagination separated pagination-info">
                              <?php if (isset($page_role2)) {
                                if (isset($total_page_role2)) {
                                  if ($page_role2 > 1) : ?>
                                    <li class="page-item">
                                      <a href="<?= $_SESSION['page-url'] ?>?page=<?= $page_role2 - 1; ?>/" class="btn btn-primary btn-sm rounded-0"><i class="icon-arrow-left"></i></a>
                                    </li>
                                    <?php endif;
                                  for ($i = 1; $i <= $total_page_role2; $i++) : if ($i <= 4) : if ($i == $page_role2) : ?>
                                        <li class="page-item active">
                                          <a href="<?= $_SESSION['page-url'] ?>?page=<?= $i; ?>/" class="btn btn-primary btn-sm rounded-0"><?= $i; ?></a>
                                        </li>
                                      <?php else : ?>
                                        <li class="page-item">
                                          <a href="<?= $_SESSION['page-url'] ?>?page=<?= $i; ?>/" class="btn btn-outline-primary btn-sm rounded-0"><?= $i ?></a>
                                        </li>
                                    <?php endif;
                                    endif;
                                  endfor;
                                  if ($total_page_role2 >= 4) : ?>
                                    <li class="page-item">
                                      <a href="<?= $_SESSION['page-url'] ?>?page=<?php if ($page_role2 > 4) {
                                                                                    echo $page_role2;
                                                                                  } else if ($page_role2 <= 4) {
                                                                                    echo '5';
                                                                                  } ?>/" class="btn btn-<?php if ($page_role2 <= 4) {
                                                                                                          echo 'outline-';
                                                                                                        } ?>primary btn-sm rounded-0"><?php if ($page_role2 > 4) {
                                                                                                                                        echo $page_role2;
                                                                                                                                      } else if ($page_role2 <= 4) {
                                                                                                                                        echo '5';
                                                                                                                                      } ?></a>
                                    </li>
                                  <?php endif;
                                  if ($page_role2 < $total_page_role2 && $total_page_role2 >= 4) : ?>
                                    <li class="page-item">
                                      <a href="<?= $_SESSION['page-url'] ?>?page=<?= $page_role2 + 1; ?>/" class="btn btn-primary btn-sm rounded-0"><i class="icon-arrow-right"></i></a>
                                    </li>
                              <?php endif;
                                }
                              } ?>
                            </ul>
                          </nav>
                        </div>
                      <?php } ?>
                    </div>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>
        <?php require_once("../resources/dash-footer.php") ?>
</body>

</html>
<!DOCTYPE html>
<html lang="en">

 <?php
 require '../core/init.php';
 include ("../template/head.php");
 ?>

  <body class="nav-md">
    <div class="container body">
      <div class="main_container">
        <div class="col-md-3 left_col">
          <div class="left_col scroll-view">
            <div class="navbar nav_title" style="border: 0;">
              <a href="../pages/dashboard.php" class="site_title"><i class="fa fa-code"></i> <span>Dashboard</span></a>
            </div>

            <div class="clearfix"></div>

            <?php include ("../template/sidebar.php"); ?>

          </div>
        </div>
      </div>

        <?php include '../template/topnav.php'; ?>

        <!-- page content -->
        <div class="right_col" role="main">

          <br />

          <div class="row">
              <div class="col-md-12 col-sm-12 col-xs-12">
                <div class="x_panel">
                  <div class="x_title">
                    <h2>Form Data Disposisi</h2>
                    <ul class="nav navbar-right panel_toolbox">
                      <li><a class="collapse-link"><i class="fa fa-chevron-up"></i></a>
                      </li>
                      <li class="dropdown">
                        <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false"><i class="fa fa-wrench"></i></a>
                        <ul class="dropdown-menu" role="menu">
                          <li><a href="#">Settings 1</a>
                          </li>
                          <li><a href="#">Settings 2</a>
                          </li>
                        </ul>
                      </li>
                      <li><a class="close-link"><i class="fa fa-close"></i></a>
                      </li>
                    </ul>
                    <div class="clearfix"></div>
                  </div>
                  <div class="x_content">
                    <br />
                    <form action="../action/action_tambah_disposisi.php" method="POST" data-parsley-validate class="form-horizontal form-label-left">

                      <?php
                        include '../config/koneksi.php';
                        $query = mysqli_query($conn, "SELECT * FROM mail");
                       ?>
				             <div class="form-group">
                        <label class="control-label col-md-3 col-sm-3 col-xs-12">Perihal Surat *</label>
                        <div class="col-md-6 col-sm-6 col-xs-12">
                          <select class="form-control" id="perihal_surat" required="required" style="width:200px;" onchange="getValue(this)">
                            <option value="">Silahkan Pilih</option>
                            <?php while ($row = mysqli_fetch_assoc($query)) { ?>
                                <option id="mail" user_id="<?=$row['id_user'];?>" mail_id="<?=$row['id_mail'];?>" value="<?=$row['description'];?>"> <?= $row['mail_subject']; ?> </option>
                            <?php } ?>
                          </select>
                        </div>
                      </div>

                      <?php
                        $query = mysqli_query($conn, "SELECT * FROM user WHERE level = 0");
                       ?>
              				 <div class="form-group">
                        <label class="control-label col-md-3 col-sm-3 col-xs-12">Tujuan Posisi *</label>
                        <div class="col-md-6 col-sm-6 col-xs-12">
                          <select class="form-control" name="disposition_at" required="required" style="width:250px;">
                            <option value="">Silahkan Pilih</option>
                            <?php while ($row = mysqli_fetch_assoc($query)) { ?>
                                <option value="<?=$row['id_user'];?>"> <?= $row['username']; ?> </option>
                            <?php } ?>
                          </select>
                        </div>
                      </div>

                      <div class="form-group">
                        <label class="control-label col-md-3 col-sm-3 col-xs-12">Status Balasan *</label>
                        <div class="col-md-6 col-sm-6 col-xs-12">
                          <div id="button" class="btn-group" data-toggle="buttons">
                            <label class="btn btn-default" data-toggle-class="btn-primary" data-toggle-passive-class="btn-default">
                              <input type="radio" name="status" value="1"> Biasa
                            </label>
                            <label class="btn btn-default" data-toggle-class="btn-primary" data-toggle-passive-class="btn-default">
                              <input type="radio" name="status" value="2"> Rahasia
                            </label>
                            <label class="btn btn-default" data-toggle-class="btn-primary" data-toggle-passive-class="btn-default">
                              <input type="radio" name="status" value="3"> Penting
                            </label>
                          </div>
                        </div>
                      </div>

                      <div class="form-group">
                          <label class="control-label col-md-3 col-sm-3 col-xs-12" for="deskripsi_surat">Deskripsi Surat *</label>
                          <div class="col-md-6 col-sm-6 col-xs-12">
                          <textarea type="text" name="description"  class="form-control" rows="3" style="width:200px;" id="output"></textarea>
                      </div>
                    </div>

                      <div class="form-group">
                        <label class="control-label col-md-3 col-sm-3 col-xs-12">Pemberitahuan</label>
                        <div class="col-md-6 col-sm-6 col-xs-12">
                          <input type="text" name="notification" required="required" class="form-control col-md-7 col-xs-12" value="Anda memiliki pesan baru!!" readonly>
                        </div>
                      </div>

            				  <input type="hidden" name="reply_at" value="Belum dibaca">
            				  <input type="hidden"  id="id_mail" name="id_mail" value="">
            				  <input type="hidden" id="id_user" name="id_user" value="">

                      <script type="text/javascript">
              			   		function getValue() {
              			   			var text = $("#perihal_surat").val();
                            			var id_mail = $("#perihal_surat option:selected").attr('mail_id');
                            			var id_user = $("#perihal_surat option:selected").attr('user_id');

              			   			$("#output").text(text);
                            			$("#id_mail").val(id_mail);
                            			$("#id_user").val(id_user);
              					}
              			</script>

                      <div class="ln_solid"></div>
                      <div class="form-group">
                        <div class="col-md-6 col-sm-6 col-xs-12 col-md-offset-3">
                          <button type="submit" name="button" class="btn btn-success"><i class="fa fa-plus"></i> Tambah</button>
                        </div>
                      </div>

                    </form>
                  </div>
                </div>
              </div>
            </div>

                            <?php if (isset($_SESSION['text'])): ?>

                                <div class="alert alert-<?=$_SESSION['color']?> text-center animated slideInRight slower" role="alert">
                                   <?= $_SESSION['text'] ?>
                                 </div>

                            <?php endif; Core::deleteFlash(); ?>

                      <!-- Table Dynamix -->
                     <div class="x_panel">
                        <div class="x_title">
                          <h2>Data Disposisi</h2>
                          <ul class="nav navbar-right panel_toolbox">
                            <li><a class="collapse-link"><i class="fa fa-chevron-up"></i></a>
                            </li>
                            <li class="dropdown">
                              <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false"><i class="fa fa-wrench"></i></a>
                              <ul class="dropdown-menu" role="menu">
                                <li><a href="#">Settings 1</a>
                                </li>
                                <li><a href="#">Settings 2</a>
                                </li>
                              </ul>
                            </li>
                            <li><a class="close-link"><i class="fa fa-close"></i></a>
                            </li>
                          </ul>
                          <div class="clearfix"></div>
                        </div>
                        <div class="x_content">


                            <div class="text-center ml-2">
                              <div id="button" class="btn-group" data-toggle="buttons">
                                <label class="btn btn-default" data-toggle-class="btn-primary" data-toggle-passive-class="btn-default">
                                  <input type="radio"> Copy
                                </label>
                                <label class="btn btn-default" data-toggle-class="btn-primary" data-toggle-passive-class="btn-default">
                                  <input type="radio"> CSV
                                </label>
                                <label class="btn btn-default" data-toggle-class="btn-primary" data-toggle-passive-class="btn-default">
                                  <input type="radio"> Print
                                </label>
                              </div>
                            </div>


                          <table id="datatable" class="table table-striped table-bordered">
                            <thead>
                              <tr>
                                 <th>No</th>
                                  <th>Disposisi</th>
                                  <th>Deskripsi Surat</th>
                                  <th>Status Balasan</th>
                                  <th>Status</th>
                                  <th>Aksi</th>
                              </tr>
                            </thead>


                            <tbody>

                             <?php
                             require '../config/koneksi.php';

                            $query = mysqli_query($conn, "SELECT * FROM disposition");

                         	 if(mysqli_num_rows($query) > 0 ) :
                                $i = 1;

                                while ($row = mysqli_fetch_assoc($query) ) :
                            ?>

                              <tr>
                                <td> <?= $i ?> </td>

                  							<?php
                  								$mail_to = mysqli_query($conn, "SELECT mail_to FROM mail WHERE id_mail = " . $row['disposition_at']);
                  								$mail = mysqli_fetch_assoc($mail_to);
                  							?>

                                <td> <?= $mail ['mail_to']; ?> </td>
                                <td> <?= $row ['description']; ?> </td>

                  							<?php
                                if ($row['status'] == 1) {
                                  $status = 'Biasa';
                                }else if ($row['status'] == 2) {
                                  $status = 'Rahasia';
                                }if ($row['status'] == 3) {
                                  $status = 'Penting';
                                }
                  							?>

                                <td> <?= $status ?> </td>

                                <td> <?= $row ['reply_at']; ?> </td>


                                <td>
                                  <button class="btn btn-danger btn-custome"  data-toggle="modal" data-target="#exampleModal<?=$i?>" role="button"><i class="fa fa-trash"></i> Hapus</button>
                                    <div class="modal fade" id="exampleModal<?=$i?>" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                      <div class="modal-dialog" role="document">
                                        <div class="modal-content">
                                          <div class="modal-header">
                                            <h5 class="modal-title" id="exampleModalLabel">Penghapusan Data</h5>
                                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                              <span aria-hidden="true">&times;</span>
                                            </button>
                                          </div>
                                          <div class="modal-body">
                                            Yakin mau di Hapus?
                                          </div>
                                          <div class="modal-footer">
                                            <button type="button" class="btn btn-secondary" data-dismiss="modal">Tutup</button>
                                            <a href="../action/action_hapus_disposisi.php?id=<?=$row['id_disposition']?>" type="button" class="btn btn-danger">YA</a>
                                          </div>
                                        </div>
                                      </div>
                                    </div>
                                    <a href="ubah-disposisi.php?id=<?=$row['id_disposition']?>" class="btn btn-primary btn-custome shadow" role="button"><i class="fa fa-pencil"></i> Edit</a>
                                </td>
                              </tr>


                            <?php
                                $i++;
                               endwhile;
                              endif;
                            ?>

                            </tbody>
                          </table>
                        </div>
                      </div>
                    <!-- /Table Dynamix -->

         </div>
         <!-- /page content -->
       </div>
       <!-- Modal -->



        <?php include '../template/footer.php'; ?>

  </body>
</html>

<?php
$sayfa = "Mağaza";
include('../inc/vt.php');
include('inc/head.php');
include('inc/nav.php');
include('inc/sidebar.php');

$sorgu = $baglanti->prepare("SELECT * FROM magaza");
$sorgu->execute();
$sonuc = $sorgu->fetch();
?>

<div id="content-wrapper">

    <div class="container-fluid">

        <!-- Breadcrumbs-->
        <ol class="breadcrumb">
            <li class="breadcrumb-item">
                <a href="#">Dashboard</a>
            </li>
            <li class="breadcrumb-item active">Mağaza Saat</li>
        </ol>
        

        <!-- DataTables Example -->
        <div class="card mb-3">

            <div class="card-body">


                <div class="table-responsive">
                    <table class="table table-bordered" width="100%" cellspacing="0">
                        <thead>
                        <tr>                           
                            <th>ÜST Başlık</th>
                            <th>Ana Başlık</th>
                            <th>Adres</th>
                            <th>Telefon</th>
                            <th>Düzenle</th>


                            

                        </tr>
                        </thead>

                        <tbody>                      
                            <tr>
                                <td><?= $sonuc["ustBaslik"] ?></td>
                                <td><?= $sonuc["anaBaslik"] ?></td>                              
                               <td>
                                    <a class="btn btn-info" href="#" data-toggle="modal"
                                       data-target="#adres<?= $sonuc["id"] ?>">Oku</a>
                                    <!-- Logout Modal-->
                                    <div class="modal fade" id="adres<?= $sonuc["id"] ?>" tabindex="-1" role="dialog"
                                         aria-labelledby="exampleModalLabel" aria-hidden="true">
                                        <div class="modal-dialog" role="document">
                                            <div class="modal-content">
                                                <div class="modal-header">
                                                    <h5 class="modal-title" id="exampleModalLabel">Adresiniz</h5>
                                                    <button class="close" type="button" data-dismiss="modal"
                                                            aria-label="Close">
                                                        <span aria-hidden="true">×</span>
                                                    </button>
                                                </div>
                                                <div class="modal-body"><?= $sonuc["adres"] ?></div>
                                                <div class="modal-footer">
                                                    <button class="btn btn-secondary" type="button"
                                                            data-dismiss="modal">Kapat
                                                    </button>

                                                </div>
                                            </div>
                                        </div>
                                    </div>

                                </td>
                                   <td><?= $sonuc["telefon"] ?></td>                                     
                                
                              <td><a class="btn btn" href="magazaGuncelle.php?id=<?= $sonuc["id"] ?>"><span
                                                class="fa fa-edit fa-2x"></span></a></td>
                                
                            </tr>
                           
                        </tbody>
                    </table>
                </div>
            </div>
            <div class="card-footer small text-muted">Updated yesterday at 11:59 PM</div>
        </div>

    </div>
    <!-- /.container-fluid -->
    <?php
    include('inc/footer.php');
    ?>



    
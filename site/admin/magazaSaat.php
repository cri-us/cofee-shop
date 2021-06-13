<?php
$sayfa = "Mağaza Saat";
include('../inc/vt.php');
include('inc/head.php');
include('inc/nav.php');
include('inc/sidebar.php');

$sorgu = $baglanti->prepare("SELECT * FROM magazasaat");
$sorgu->execute();


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
                    <table class="table table-bordered"  width="100%" cellspacing="0">
                        <thead>
                        <tr>
                            <th>ID</th>
                            <th>Gün</th>
                            <th>Saat</th>
                            <th>Düzenle</th>

                            

                        </tr>
                        </thead>

                        <tbody>

                        <?php while ($sonuc = $sorgu->fetch()) { ?>
                            <tr>
                                <td><?= $sonuc["id"] ?></td>
                                <td><?= $sonuc["gun"] ?></td>
                               
                              
                                <td><?= $sonuc["saat"] ?></td>
                                
                              <td><a class="btn btn" href="magazaSaatGuncelle.php?id=<?= $sonuc["id"] ?>"><span
                                                class="fa fa-edit fa-2x"></span></a></td>
                                
                            </tr>
                            <?php
                        } //while bitimi
                        ?>
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

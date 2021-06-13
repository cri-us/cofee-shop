<?php
$sayfa = 'Hakkımızda';
include('inc/vt.php');
include('inc/head.php');
include('inc/nav.php');

$sorgu = $baglanti->prepare("SELECT * FROM hakkimizda");
$sorgu->execute();
$sonuc = $sorgu->fetch();//sorgu çalıştırılıp veriler alınıyor

?>


    <section class="page-section about-heading">
        <div class="container">
            <img class="img-fluid rounded about-heading-img mb-3 mb-lg-0" src="img/<?= $sonuc['foto'] ?>" alt="">
            <div class="about-heading-content">
                <div class="row">
                    <div class="col-xl-9 col-lg-10 mx-auto">
                        <div class="bg-faded rounded p-5">
                            <h2 class="section-heading mb-4">
                                <span class="section-heading-upper"><?= $sonuc['ustBaslik'] ?></span>
                                <span class="section-heading-lower"><?= $sonuc['baslik'] ?></span>
                            </h2>
                            <?= $sonuc['icerik'] ?>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
<?php
include('inc/footer.php');
?>
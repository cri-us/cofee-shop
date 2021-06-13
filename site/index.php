<?php
$sayfa = 'Ana Sayfa';
include('inc/vt.php');
include('inc/head.php');
include('inc/nav.php');



$sorgu = $baglanti->prepare("SELECT * FROM anasayfa");
$sorgu->execute();
$sonuc = $sorgu->fetch();//sorgu çalıştırılıp veriler alınıyor

?>

    <section class="page-section clearfix">
        <div class="container">
            <div class="intro">
                <img class="intro-img img-fluid mb-3 mb-lg-0 rounded" src="img/<?= $sonuc['foto'] ?>" alt="">
                <div class="intro-text left-0 text-center bg-faded p-5 rounded">
                    <h2 class="section-heading mb-4">

                        <span class="section-heading-lower"><?= $sonuc['ustBaslik'] ?></span>
                    </h2>
                    <p class="mb-3">
                        <?= $sonuc['ustIcerik'] ?>
                    </p>
                    <div class="intro-button mx-auto">
                        <a class="btn btn-primary btn-xl" href="#"><?= $sonuc['link'] ?></a>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <section class="page-section cta">
        <div class="container">
            <div class="row">
                <div class="col-xl-9 mx-auto">
                    <div class="cta-inner text-center rounded">
                        <h2 class="section-heading mb-4">

                            <span class="section-heading-lower"><?= $sonuc['altBaslik'] ?></span>
                        </h2>
                        <?= $sonuc['altIcerik'] ?>
                    </div>
                </div>
            </div>
        </div>
    </section>

<?php
include('inc/footer.php');
?>
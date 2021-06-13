<?php
$sayfa = 'Magaza';
include('inc/vt.php');
include('inc/head.php');
include('inc/nav.php');

$sorgu1 = $baglanti->prepare("SELECT * FROM magaza");
$sorgu1->execute();
$sonuc1 = $sorgu1->fetch();//sorgu çalıştırılıp veriler alınıyor

?>
<section class="page-section cta">
    <div class="container">
        <div class="row">
            <div class="col-xl-9 mx-auto">
                <div class="cta-inner text-center rounded">
                    <h2 class="section-heading mb-5">
                        <span class="section-heading-upper"><?= $sonuc1['ustBaslik'] ?></span>
                        <span class="section-heading-lower"><?= $sonuc1['anaBaslik'] ?></span>
                    </h2>
                    <ul class="list-unstyled list-hours mb-5 text-left mx-auto">
                        <?php
                        $sorgu2 = $baglanti->prepare("SELECT * FROM magazasaat");
                        $sorgu2->execute();
                        while ($sonuc2 = $sorgu2->fetch()) {
                            ?>

                            <li class="list-unstyled-item list-hours-item d-flex">
                                <?= $sonuc2['gun'] ?>
                                <span class="ml-auto"><?= $sonuc2['saat'] ?></span>
                            </li>
                            <?php
                        } //while sonu
                        ?>

                    </ul>
                    <p class="address mb-5">
                        <?= $sonuc1['adres'] ?>
                    </p>
                    <p class="mb-0">
                        <small>
                            <em>Call Anytime</em>
                        </small>
                        <br>
                        <?= $sonuc1['telefon'] ?>
                    </p>
                </div>
            </div>
        </div>
    </div>
</section>

<?php

$sorgu3 = $baglanti->prepare("SELECT * FROM hakkimizda");
$sorgu3->execute();
$sonuc3 = $sorgu3->fetch();//sorgu çalıştırılıp veriler alınıyor

?>

<section class="page-section about-heading">
    <div class="container">
        <img class="img-fluid rounded about-heading-img mb-3 mb-lg-0" src="img/<?= $sonuc3['foto'] ?>" alt="">
        <div class="about-heading-content">
            <div class="row">
                <div class="col-xl-9 col-lg-10 mx-auto">
                    <div class="bg-faded rounded p-5">
                        <h2 class="section-heading mb-4">
                            <span class="section-heading-upper"><?= $sonuc3['ustBaslik'] ?></span>
                            <span class="section-heading-lower"><?= $sonuc3['baslik'] ?></span>
                        </h2>
                        <?= $sonuc3['icerik'] ?>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
<?php
include('inc/footer.php');
?>

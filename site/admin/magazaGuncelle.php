<script type="text/javascript" src="../js/sweetalert.min.js"></script>
<?php
$sayfa = "Mağaza";
include('../inc/vt.php');
include('inc/head.php');
include('inc/nav.php');
include('inc/sidebar.php');

$sorgu = $baglanti->prepare("SELECT * FROM magaza Where id=:id");
$sorgu->execute(['id' => (int)$_GET["id"]]);
$sonuc = $sorgu->fetch();//sorgu çalıştırılıp veriler alınıyor

if ($_POST) { // Sayfada post olup olmadığını kontrol ediyoruz.

    $ustBaslik = $_POST['ustBaslik']; // Sayfa yenilendikten sonra post edilen değerleri değişkenlere atıyoruz
    $anaBaslik = $_POST['anaBaslik'];
    $adres = $_POST['adres'];
    $telefon = $_POST['telefon'];

    
    $hata = "";

    // Veri alanlarının boş olmadığını kontrol ettiriyoruz. başka kontrollerde yapabilirsiniz.
    
    if ($ustBaslik <> "" && $anaBaslik <> "" && $hata == "") { // Veri alanlarının boş olmadığını kontrol ettiriyoruz.
        //Değişecek veriler
        $satir = [
            'id' => $_GET['id'],
            
            'ustBaslik' => $ustBaslik,
            'anaBaslik' => $anaBaslik,
            'adres' => $adres,
            'telefon' => $telefon,

        ];


        // Veri güncelleme sorgumuzu yazıyoruz.
        $sql = "UPDATE magaza SET ustBaslik=:ustBaslik , anaBaslik=:anaBaslik , adres=:adres , telefon=:telefon WHERE id=:id;";
        $durum = $baglanti->prepare($sql)->execute($satir);

        if ($durum) {
            echo '<script>swal("Başarılı","Güncellendi","success").then((value)=>{ window.location.href = "magaza.php"});

            </script>';
            // Eğer güncelleme sorgusu çalıştıysa urunler.php sayfasına yönlendiriyoruz.
        } else {
            echo 'Düzenleme hatası oluştu: '; // id bulunamadıysa veya sorguda hata varsa hata yazdırıyoruz.
        }
    }
    if ($hata != "") {
        echo '<script>swal("Hata","' . $hata . '","error");</script>';
    }
}
?>
<script src="vendor/CKEditor5/ckeditor.js"></script>
<div id="content-wrapper">

    <div class="container-fluid">

        <!-- Breadcrumbs-->
        <ol class="breadcrumb">
            <li class="breadcrumb-item">
                <a href="#">Dashboard</a>
            </li>
            <li class="breadcrumb-item active">Mağaza Düzenle</li>
        </ol>


        <!-- DataTables Example -->
        <div class="card mb-3">

            <div class="card-body">

                <form method="post" action="" enctype="multipart/form-data">

                    <div class="form-group">
                        <label>Üst Başlık</label>
                        <input required type="text" value="<?= $sonuc["ustBaslik"] ?>" class="form-control" name="ustBaslik"
                        placeholder="ustBaslik">
                    </div>


                    <div class="form-group">
                        <label>Ana Başlık</label>
                        <input required type="text" value="<?= $sonuc["anaBaslik"] ?>" class="form-control" name="anaBaslik"
                        placeholder="anaBaslik">
                    </div>

                    <div class="form-group">
                        <label for="adres">Adres</label>
                        <textarea  name="adres" id="adres">
                            <?= $sonuc["adres"] ?>
                        </textarea>

                        <script>
                            ClassicEditor
                            .create(document.querySelector('#adres'))
                            .then(editor => {
                                console.log(editor);
                            })
                            .catch(error => {
                                console.error(error);
                            });
                        </script>

                    </div>

                    <div class="form-group">
                        <label>Telefon</label>
                        <input required type="text" value="<?= $sonuc["telefon"] ?>" class="form-control" name="telefon"
                        placeholder="telefon">
                    </div>



                    

                    

                    <div class="form-group">
                        <button type="submit" class="btn btn-primary">Güncelle</button>
                    </div>

                </form>


            </div>
        </div>
        <div class="card-footer small text-muted">Updated yesterday at 11:59 PM</div>


        <!-- /.container-fluid -->


        <script>
            $(document).ready(function () {
                $('#dataTable').DataTable({
                    language: {
                        info: "_TOTAL_ kayıttan _START_ - _END_ kayıt gösteriliyor.",
                        infoEmpty: "Gösterilecek hiç kayıt yok.",
                        loadingRecords: "Kayıtlar yükleniyor.",
                        zeroRecords: "Tablo boş",
                        search: "Arama:",
                        sLengthMenu: "Sayfada _MENU_ kayıt göster",
                        infoFiltered: "(toplam _MAX_ kayıttan filtrelenenler)",
                        buttons: {
                            copyTitle: "Panoya kopyalandı.",
                            copySuccess: "Panoya %d satır kopyalandı",
                            copy: "Kopyala",
                            print: "Yazdır",
                        },

                        paginate: {
                            first: "İlk",
                            previous: "Önceki",
                            next: "Sonraki",
                            last: "Son"
                        },
                    }
                });
            });

        </script>
        <script src="js/aktifcustom.js"></script>
        <link rel="stylesheet" type="text/css" href="css/switch.css">
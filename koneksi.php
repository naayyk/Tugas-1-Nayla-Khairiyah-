<?php
$host     = "localhost";
$user     = "root";
$password = "";
$db       = "db_buku_perpustakaan";

$koneksi = mysqli_connect($host, $user, $password, $db);
if (!$koneksi) {
    die("Tidak bisa terkoneksi ke database.");
}
$kode_buku      ="";
$judul_buku     ="";
$pengarang      ="";
$penerbit       ="";
$tahun_terbit   ="";
$error          ="";
$sukses         ="";

if(isset($_POST['tambah'])){
    $kode_buku      = $_POST['kode_buku'];
    $judul_buku     = $_POST['judul_buku'];
    $pengarang      = $_POST['pengarang'];
    $penerbit       = $_POST['penerbit'];
    $tahun_terbit   = $_POST['tahun_terbit'];

    if($kode_buku && $judul_buku && $pengarang && $penerbit && $tahun_terbit){
        $sql1 = "INSERT INTO buku_perpustakaan (kode_buku, judul_buku, pengarang, penerbit, tahun_terbit) VALUES ('$kode_buku', '$judul_buku', '$pengarang', '$penerbit', '$tahun_terbit')";
        $q1 = mysqli_query($koneksi, $sql1);
        if($q1){
            $sukses = "Berhasil memasukkan data";
        } else {
            $error = "Gagal memasukkan data:" .mysql_error($koneksi);
        }
    } else {
            $error = "Silakan isi semua data";
    } 
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Data Buku</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@6.0.0-alpha.1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-B/GM4XqrwHnWXNOWMbloTmrYXZg10cakYGmpfsR/bbzQ6JAJI4ihuyADKLnBgrCe" crossorigin="anonymous">
    <style>
        .mx-auto {width : 800px}
        .card {margin-top: 10px;}
    </style>
</head>
<body>
    <div class="mx-auto">
        <!--untuk memasukkan data-->
        <div class="card">
            <div class="card-header">
                Create / Edit data
            </div>
            <div class="card-body">
                <?php
                if($error){
                ?>
                    <div class="alert alert-danger" role="alert">
                        <?php echo $error?>
                    </div>
                <?php
                }
                ?>
                <?php
                if($sukses){
                ?>
                    <div class="alert alert-success" role="alert">
                        <?php echo $sukses?>
                    </div>
                <?php
                }
                ?>
                <form action="" method="POST">
                    <div class="mb-3 row">
                        <label for="kode_buku" class="sm:col-2 col-form-label">Kode Buku</label>
                        <div class="sm:col-10">
                            <input type="text" class="form-control" id="kode_buku" name="kode_buku" value="<?php echo $kode_buku?>">
                        </div>
                    </div>
                    <div class="mb-3 row">
                        <label for="judul_buku" class="sm:col-2 col-form-label">Judul</label>
                        <div class="sm:col-10">
                            <input type="text" class="form-control" id="judul_buku" name="judul_buku" value="<?php echo $judul_buku?>">
                        </div>
                    </div>
                    <div class="mb-3 row">
                        <label for="pengarang" class="sm:col-2 col-form-label">Pengarang</label>
                        <div class="sm:col-10">
                            <input type="text" class="form-control" id="pengarang" name="pengarang" value="<?php echo $pengarang?>">
                        </div>
                    </div>
                    <div class="mb-3 row">
                        <label for="penerbit" class="sm:col-2 col-form-label">Penerbit</label>
                        <div class="sm:col-10">
                            <input type="text" class="form-control" id="penerbit" name="penerbit" value="<?php echo $penerbit?>">
                        </div>
                    </div>
                    <div class="mb-3 row">
                        <label for="tahun_terbit" class="sm:col-2 col-form-label">Tahun Terbit</label>
                        <div class="sm:col-10">
                            <input type="number" class="form-control" id="tahun_terbit" name="tahun_terbit" value="<?php echo $tahun_terbit?>">
                        </div>
                    </div>
                    <div class="col-12">
                        <input type="submit" name="tambah" value="Tambah Data" class="btn btn-primary"/>
                </form>
            </div>
        </div>

        <!--untuk mengeluarkan data-->
        <div class="card">
            <div class="card-header text-white bg-secondary">
                Data Buku
            </div>
            <div class="card-body">
                <table class = "table">
                    <thead>
                        <tr>
                            <th>No.</th>
                            <th scope="col">Kode Buku</th>
                            <th scope="col">Judul</th>
                            <th scope="col">Pengarang</th>
                            <th scope="col">Penerbit</th>
                            <th scope="col">Tahun Terbit</th>
                        </tr>
                    </thead>
                        <tbody>
                            <?php
                            $sql2 = "select * from buku_perpustakaan order by id desc";
                            $q2 = mysqli_query($koneksi, $sql2);
                            $no = 1;
                            while($r2 = mysqli_fetch_array($q2)){
                                $id             = $r2['id'];
                                $kode_buku      = $r2['kode_buku'];
                                $judul_buku     = $r2['judul_buku'];
                                $pengarang      = $r2['pengarang'];
                                $penerbit       = $r2['penerbit'];
                                $tahun_terbit   = $r2['tahun_terbit'];

                                ?>
                                <tr>
                                    <td><?= $no++ ?></td>
                                    <td scope="row"><?php echo $kode_buku ?></td>
                                    <td scope="row"><?php echo $judul_buku ?></td>
                                    <td scope="row"><?php echo $pengarang ?></td>
                                    <td scope="row"><?php echo $penerbit ?></td>
                                    <td scope="row"><?php echo $tahun_terbit ?></td>
                                </tr>
                                <?php
                            }
                            ?>
                        </tbody>
            </div>
        </div>
    </div>
</body>
</html>
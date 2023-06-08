<?php

$host = new mysqli("localhost","root","","pariwisata");

function pdo_connect_mysql() {
    $DATABASE_HOST = 'localhost';
    $DATABASE_USER = 'root';
    $DATABASE_PASS = '';
    $DATABASE_NAME = 'pariwisata';
    try {
    	return new PDO('mysql:host=' . $DATABASE_HOST . ';dbname=' . $DATABASE_NAME . ';charset=utf8', $DATABASE_USER, $DATABASE_PASS);
    } catch (PDOException $exception) {
		
    	exit('Failed to connect to database!');
    }
}
function template_header($title) {
    echo <<<EOT
    <!DOCTYPE html>
    <html>
        <head>
            <meta charset="UTF-8" />
            <title>$title</title>
            <link href="css/style.css" rel="stylesheet" type="text/css">
            <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.7.1/css/all.css">
        </head>
        <body>
        <nav class="navtop">
            <div>
                <h1>WIS-MANTAN</h1>
                <a href="index.php"><i class="fas fa-home"></i>Home</a>
                <a href="read.php"><i class="fas fa-address-book"></i>Objek</a>
                <a href="read_tiket.php"><i class="fas fa-address-book"></i>Tiket</a>
            </div>
        </nav>
EOT;
}
function template_footer() {
echo <<<EOT
    </body>
</html>
EOT;
}
function tambahDataA($data)
{
    global $host;
    $nama_objek = $data["nama_objek"];
    $deskripsi = $data["deskripsi"];
    $gambar = uploadgambar();
    $alamat = $data["alamat"];
    $jam_buka_tutup =$data["jam_buka_tutup"];
    if (!$gambar) {
        return false;
    }

    mysqli_query($host, "INSERT INTO objek VALUES (NULL,'$nama_objek','$deskripsi','$gambar','$alamat', '$jam_buka_tutup')") or die(mysqli_error($host));

    return mysqli_affected_rows($host);
}
function uploadgambar()
{
    $namafile = $_FILES["gambar"]["name"];
    $ukuranfile = $_FILES["gambar"]["size"];
    $error = $_FILES["gambar"]["error"];
    $tmpname = $_FILES["gambar"]["tmp_name"];

    if ($error === 4) {
        echo "<script>
            alert('File Belum Di upload !!');
        </script>";
        return false;
    }

    $ekstensivalid = array("jpeg", "jpg", "png");
    $ekstensifile = explode(".", $namafile);
    $ekstensifile = strtolower(end($ekstensifile));

    if (!in_array($ekstensifile, $ekstensivalid)) {
        echo "<script>
            alert('Ekstensi File tidak valid');
        </script>";
        return false;
    }

    if ($ukuranfile > 5000000) {
        echo "<script>
            alert('Ukuran File terlalu besar');
        </script>";
        return false;
    }

    $namafilebaru = $namafile;
    // $namafilebaru .= '.';
    // $namafilebaru .= $ekstensifile;

    move_uploaded_file($tmpname, "img/" . $namafilebaru);

    return $namafilebaru;
}
function ubahDataA($data, $id)
{
    global $host;
    $nama_objek = $data["nama_objek"];
    $deskripsi = $data["deskripsi"];
    $gambarlama = $data["gambarlama"];
    $alamat = $data["alamat"];
    $jam_buka_tutup = $data["jam_buka_tutup"];

    if ($_FILES["gambar"]["error"] === 4) {
        $gambar = $gambarlama;
    } else {
        $gambar = uploadgambar();
        if (file_exists('img/' . $gambarlama)) {
            unlink('img/' . $gambarlama);
        }
    }

    mysqli_query($host, " UPDATE objek SET nama_objek = '$nama_objek', deskripsi = '$deskripsi', gambar = '$gambar', alamat = '$alamat', jam_buka_tutup = '$jam_buka_tutup' WHERE id = '$id'");

    return mysqli_affected_rows($host);

}
function tampil($query)
{
    global $host;
    $result = mysqli_query($host, $query);
    $rows = [];

    while ($data = mysqli_fetch_assoc($result)) {
        $rows[] = $data;
    }

    return $rows;

}
?>
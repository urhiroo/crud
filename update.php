<?php
include 'functions.php';
$pdo = pdo_connect_mysql();
$msg = '';
$id = $_GET['id'];
$query = tampil("SELECT * FROM objek WHERE id ='$id'")[0];

if (isset($_POST["submit"])) {
    if (ubahDataA($_POST, $id) > 0) {
        echo $msg = 'Created Successfully!';;
    } else {
        echo '<script>alert("Gagal mengubah")</script>';
    }
}
?>



<?=template_header('Read')?>

<div class="content update">
	<h2>Update Objek #<?=$query['id']?></h2>
    <form action="" method="post" enctype="multipart/form-data">
        <label for="id">ID</label>
        <label for="nama_objek">Nama</label>
        <input type="text" name="id" value="<?=$query['id']?>" id="id">
        <input type="text" name="nama_objek" value="<?=$query['nama_objek']?>" id="nama_objek">
        <label for="deskripsi">Deskripsi</label>
        <label for="gambar">Gambar</label>
        <input type="text" name="deskripsi" value="<?=$query['deskripsi']?>" id="deskripsi">
        <input type="file" name="gambar" value="<?=$query['gambar']?>" id="gambar">
        <input type="hidden" name="gambarlama" value="<?= $query["gambar"];?>">
        <label for="alamat">Alamat</label>
        <label for="jam_buka_tutup">Jam Operasional</label>
        <input type="text" name="alamat" value="<?=$query['alamat']?>" id="alamat">
        <input type="datetime-local" name="jam_buka_tutup" value="<?=$query['jam_buka_tutup']?>" id="jam_buka_tutup">
        <input type="submit" value="Update" name="submit">
    </form>
    <?php if ($msg): ?>
    <p><?=$msg?></p>
    <?php endif; ?>
</div>

<?=template_footer()?>
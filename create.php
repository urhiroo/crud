<?php
include 'functions.php';
$pdo = pdo_connect_mysql();
$msg = '';
if(isset($_POST["submit"])){
    if(tambahDataA($_POST) > 0 ){
        $msg = 'Created Successfully!';
    }
}
?>


<?=template_header('Create')?>

<div class="content update">
	<h2>Tambah Objek</h2>
    <form action="" method="post" enctype="multipart/form-data">
        <label for="id">ID</label>
        <label for="nama_objek">Nama</label>
        <input type="text" name="id" value="auto" id="id">
        <input type="text" name="nama_objek" id="nama_objek">
        <label for="deskripsi">Deskripsi</label>
        <label for="gambar">Gambar</label>
        <input type="text" name="deskripsi" id="deskripsi">
        <input type="file" name="gambar" id="gambar">
        <label for="alamat">Alamat</label>
        <label for="jam_buka_tutup">Jam operasional</label>
        <input type="text" name="alamat" id="alamat">
        <input type="datetime-local" name="jam_buka_tutup" id="jam_buka_tutup">
        <input type="submit" value="Create" name="submit">
    </form>
    <?php if ($msg): ?>
    <p><?=$msg?></p>
    <?php endif; ?>
</div>

<?=template_footer()?>
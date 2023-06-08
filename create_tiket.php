<?php
include 'functions.php';
$pdo = pdo_connect_mysql();
$msg = '';
// Check if POST data is not empty
if (!empty($_POST)) {
    // Post data not empty insert a new record
    // Set-up the variables that are going to be inserted, we must check if the POST variables exist if not we can default them to blank
    $id = isset($_POST['id']) && !empty($_POST['id']) && $_POST['id'] != 'auto' ? $_POST['id'] : NULL;
    // Check if POST variable "name" exists, if not default the value to blank, basically the same for all variables
    $nama_tiket = isset($_POST['nama_tiket']) ? $_POST['nama_tiket'] : '';
    $kategori = isset($_POST['kategori']) ? $_POST['kategori'] : '';
    $kode_tiket = isset($_POST['kode_tiket']) ? $_POST['kode_tiket'] : '';
    $harga = isset($_POST['harga']) ? $_POST['harga'] : '';

    // Insert new record into the contacts table
    $stmt = $pdo->prepare('INSERT INTO tiket VALUES (?, ?, ?, ?, ?)');
    $stmt->execute([$id, $nama_tiket, $kategori, $kode_tiket, $harga]);
    // Output message
    $msg = 'Created Successfully!';
}
?>


<?=template_header('Create')?>

<div class="content update">
	<h2>Tambah Tiket</h2>
    <form action="create_tiket.php" method="post">
        <label for="id">ID</label>
        <label for="nama_tiket">Nama</label>
        <input type="text" name="id" value="auto" id="id">
        <input type="text" name="nama_tiket" id="nama_tiket">
        <label for="kategori">Kategori</label>
        <label for="kode_tiket">Kode</label>
        <input type="text" name="kategori" id="kategori">
        <input type="text" name="kode_tiket" id="kode_tiket">
        <label for="harga">Harga</label>
        <input type="text" name="harga" id="harga">
        <input type="submit" value="Create">
    </form>
    <?php if ($msg): ?>
    <p><?=$msg?></p>
    <?php endif; ?>
</div>

<?=template_footer()?>
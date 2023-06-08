<?php
include 'functions.php';
$pdo = pdo_connect_mysql();
$msg = '';
// Check if the contact id exists, for example update.php?id=1 will get the contact with the id of 1
if (isset($_GET['id'])) {
    if (!empty($_POST)) {
        // This part is similar to the create.php, but instead we update a record and not insert
        $id = isset($_POST['id']) ? $_POST['id'] : NULL;
        $nama_tiket = isset($_POST['nama_tiket']) ? $_POST['nama_tiket'] : '';
        $kategori = isset($_POST['kategori']) ? $_POST['kategori'] : '';
        $kode_tiket = isset($_POST['kode_tiket']) ? $_POST['kode_tiket'] : '';
        $harga = isset($_POST['harga']) ? $_POST['harga'] : '';
        
        // Update the record
        $stmt = $pdo->prepare('UPDATE tiket SET id = ?, nama_tiket = ?, kategori = ?, kode_tiket = ?, harga = ? WHERE id = ?');
        $stmt->execute([$id, $nama_tiket, $kategori, $kode_tiket, $harga, $_GET['id']]);
        $msg = 'Updated Successfully!';
    }
    // Get the contact from the contacts table
    $stmt = $pdo->prepare('SELECT * FROM tiket WHERE id = ?');
    $stmt->execute([$_GET['id']]);
    $contact = $stmt->fetch(PDO::FETCH_ASSOC);
    if (!$contact) {
        exit('Contact doesn\'t exist with that ID!');
    }
} else {
    exit('No ID specified!');
}
?>



<?=template_header('Read')?>

<div class="content update">
	<h2>Update tiket #<?=$contact['id']?></h2>
    <form action="update_tiket.php?id=<?=$contact['id']?>" method="post">
        <label for="id">ID</label>
        <label for="nama_tiket">Nama</label>
        <input type="text" name="id" value="<?=$contact['id']?>" id="id">
        <input type="text" name="nama_tiket" value="<?=$contact['nama_tiket']?>" id="nama_tiket">
        <label for="kategori">kategori</label>
        <label for="kode_tiket">Kode</label>
        <input type="text" name="kategori" value="<?=$contact['kategori']?>" id="kategori">
        <input type="text" name="kode_tiket" value="<?=$contact['kode_tiket']?>" id="kode_tiket">
        <label for="harga">Harga</label>
        <input type="text" name="harga" value="<?=$contact['harga']?>" id="harga">
        <input type="submit" value="Update">
    </form>
    <?php if ($msg): ?>
    <p><?=$msg?></p>
    <?php endif; ?>
</div>

<?=template_footer()?>
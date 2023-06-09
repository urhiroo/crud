<?php
include 'functions.php';

if(isset($_POST["submit"])){
    if(tambahDatatransaksi($_POST) > 0 ){
        $msg = 'Created Successfully!';
    }
}
?>


<?=template_header('Create')?>

<div class="content update">
	<h2>Tambah pembeli</h2>
    <form action="" method="post" enctype="multipart/form-data">
        <label for="id_transaksi">ID</label>
        <label for="nama_objek">Nama Wisata</label>
        <input type="text" name="id_transaksi" value="auto" id="id_transaksi">
        <input type="text" name="nama_objek" id="nama_objek">
        <label for="username">Username</label>
        <label for="qty">qty</label>
        <input type="text" name="username" id="username">
        <input type="text" name="qty" id="qty">
        <label for="total_pembelian">Total</label>
        <label for="tgl_membeli">Tanggal Pembelian</label>
        <input type="text" name="total_pembelian" id="total_pembelian">
        <input type="datetime-local" name="tgl_membeli" id="tgl_membeli">
        <label for="nama_tiket">Nama Tiket</label>
        <input type="text" name="nama_tiket" id="nama_tiket">
        <input type="submit" value="Create" name="submit">
    </form>
</div>

<?=template_footer()?>
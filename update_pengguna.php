<?php
include 'functions.php';
$pdo = pdo_connect_mysql();
$msg = '';
$id = $_GET["id"];
$query = tampil("SELECT * FROM pengguna WHERE id ='$id'")[0];
//var_dump($query)

if (isset($_POST["ubah"])) {
  if (ubahDataP($_POST, $id) > 0) {
    echo "Ubah data berhasil";
    echo '<script>window.location="read_pengguna.php"</script>';
  } else {
    echo '<script>alert("Gagal mengubah")</script>';
  }
}


?>



<?=template_header('Read')?>

<div class="content update">
	<h2>Update pengguna #<?=$query['id']?></h2>
    <form action="update_pengguna.php?id=<?=$query['id']?>" method="post">
        <label for="id">ID</label>
        <label for="username">Username</label>
        <input type="text" name="id" value="<?=$query['id']?>" id="id">
        <input type="text" name="username" value="<?=$query['username']?>" id="username">
        <label for="pw">Password</label>
        <input type="password" name="pw" value="<?=$query['pw']?>" id="pw">
        <input type="submit" name="ubah" value="Update">
    </form>
    <?php if ($msg): ?>
    <p><?=$msg?></p>
    <?php endif; ?>
</div>

<?=template_footer()?>
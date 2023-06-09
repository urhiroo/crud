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
    $username = isset($_POST['username']) ? $_POST['username'] : '';
    $pw = isset($_POST['pw']) ? $_POST['pw'] : '';

    // Insert new record into the contacts table
    $stmt = $pdo->prepare('INSERT INTO pengguna VALUES (?, ?, ?)');
    $stmt->execute([$id, $username, $pw]);
    // Output message
    $msg = 'Created Successfully!';
}
?>


<?=template_header('Create')?>

<div class="content update">
	<h2>Tambah pengguna</h2>
    <form action="create_pengguna.php" method="post">
        <label for="id">ID</label>
        <label for="username">Nama</label>
        <input type="text" name="id" value="auto" id="id">
        <input type="text" name="username" id="username">
        <label for="pw">Password</label>
        <input type="password" name="pw" id="pw">
        <input type="submit" value="Create">
    </form>
    <?php if ($msg): ?>
    <p><?=$msg?></p>
    <?php endif; ?>
</div>

<?=template_footer()?>
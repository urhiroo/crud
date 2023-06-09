<?php
include "functions.php";


?>


<?=template_header('Read')?>

<div class="content read">
	<h2>View Tabel</h2>
	<a href="create_membeli.php" class="create-contact">Tambah File</a>
	<table>
        <thead>
            <tr>
                <td>#</td>
                <td>Nama Wisata</td>
                <td>Username</td>
                <td>Qty</td>
                <td>Total pembelian</td>
                <td>Tanggal pembelian</td>
                <td>Nama Tiket</td>
                <td></td>
            </tr>
        </thead>
        <tbody>
            <?php
            $query = "SELECT * FROM membeli
                    INNER JOIN objek ON membeli.id_objek=objek.id 
                    INNER JOIN pengguna ON membeli.id_pengguna=pengguna.id 
                    INNER JOIN tiket ON membeli.id=tiket.id";
            $sql_beli = mysqli_query($host, $query) or die (mysqli_error($host));
            while ($data = mysqli_fetch_array($sql_beli)) { ?>
                <tr>
                    <td><?=$data['id_transaksi']?></td>
                    <td><?=$data['nama_objek']?></td>
                    <td><?=$data['username']?></td>
                    <td><?=$data['qty']?></td>
                    <td><?=$data['total_pembelian']?></td>
                    <td><?=$data['tgl_membeli']?></td>
                    <td><?=$data['nama_tiket']?></td>

                <td class="actions">
                    <a href="update_membeli.php?id=<?=$data['id_transaksi']?>" class="edit"><i class="fas fa-pen fa-xs"></i></a>
                    <a href="delete_membeli.php?id=<?=$data['id_transaksi']?>" class="trash"><i class="fas fa-trash fa-xs"></i></a>
                </td>
            </tr>

             <?php
             } ?>

        </tbody>
    </table>
<?=template_footer()?>
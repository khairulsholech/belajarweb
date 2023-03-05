<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<title>PDF Laporan Product</title>
</head>
<body>
	<table class="table table-bordered" id="table" width="100%" cellspacing="1">
		<thead>
			<tr>
				<th>No.</th>
				<th>Nama Product</th>
				<th>Kategori</th>
				<th>Price</th>
				<th>Image</th>
			</tr>
		</thead>
		<tbody>
		<?php
			$i = 1;
			foreach($products as $product) : ?>
			<?php 
				if ($product['IsDeleted'] == 0) {
			?>
				<tr>
				<td><?= $i++ ;?></td>
				<td><?= $product['ProductName'] ;?></td>
				<td><?= $product['Category'] ;?></td>
				<td><?= $product['Price'] ;?></td>
				<td><img width="100px" height="100px" src="<?= site_url('assets/img/'.$product['Image']) ?>" alt=""></td>
				</tr>
			<?php } ?>
		<?php endforeach ;?>
		</tbody> 
	</table>
</body>
</html>

<div class="container mt-5">

	<div class="text-center">
		<h1>Product</h1>
		<h5>Cari dan dapatkan smartphone impian kamu!!!!</h5>
	</div>

	<div class="row">
	
	<?php 
	function rupiah($angka){

		$hasil_rupiah = "Rp " . number_format($angka,0,',','.');
		return $hasil_rupiah;
		
	}
	?>

	<?php foreach ($products as $product) : ?>
	
		<div class="col-md-3">
			<div class="card" style="width: 18rem;">
				<img src="<?= base_url('assets/img/'.$product["Image"]);?>" height="200px" class="card-img-top" alt="...">
				<div class="card-body">
					<h5 class="card-title"><?= $product["ProductName"]; ?></h5>
					<b><p><?= $product["Category"]; ?></p></b>
          <p><?= rupiah($product["Price"]); ?></p>
					<a href="<?= base_url("home/viewDetail/".$product["ProductID"]) ;?>" class="btn btn-primary">Pesan</a>
				</div>
			</div>
		</div>
	<?php endforeach; ?>
    
	</div>
</div>

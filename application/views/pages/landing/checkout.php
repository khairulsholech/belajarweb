<div class="container mt-5">
	<div class="row">

		<div class="col-md-8">
			<div class="card">
				<div class="row">
					<div class="col-md-4">
						<div class="m-3">
							<img src="<?= base_url('assets/img/'.$product["Image"])?>" height="200px" class="card-img-top" alt="...">
						</div>
					</div>
					<div class="col-md-8">
						<div class="mt-5">
							<h5 class="card-title"><?= $product["ProductName"]; ?></h5>
							<b>
								<p><?= $product["Category"]; ?></p>
							</b>
							<p><?= $product["Price"]; ?></p>
						</div>
					</div>
				</div>
			</div>
		</div>
		<div class="col-md-4">
			<div class="payment px-2 py-5" style="background-color: #EEEEEE;">
				<div class="row justify-content-between">
					<div class="col-md-6">
						<b>
							<?= $product["ProductName"]; ?>
						</b>
					</div>
					<div class="col-md-6">
						<b>
							<?= $product["Price"]; ?>
						</b>
					</div>
				</div>

				<hr/>

				<div class="total">
					<b>
						<p style="text-Align: right;">
							Total Pembayaran : Rp <?= $product["Price"]; ?>
						</p>
					</b>
				</div>

				<div class="method-peyment">
					<b>
						<p>
							Cara Pembayaran
						</p>
					</b>
					<ol>
						<li>
							Pembayaran dilakukan via transfer bank ke no. Rekening <b>1234857939274 a.n PT HP Store</b>
						</li>
						<li>
							Upload bukti pembayaran ke form di bawah ini.
						</li>
						<li>
							Pilih Selesai
						</li>
					</ol>
				</div>	
				<form action="<?= base_url('home/checkout/'.$product["ProductID"]);?>" method="POST" enctype="multipart/form-data">
					<div class="form-group">
						<label for="">Upload Bukti Pembayaran</label>
						<input type="file" name="image" class="form-control my-2">
					</div>
					<button class="btn btn-primary" type="submit">Selesai</button>
				</form>

			</div>
		</div>
	</div>
</div>

<div class="container-fluid">
	<!-- Page Heading -->
	<div class="d-sm-flex align-items-center justify-content-between mb-4">
		<h1 class="h3 mb-0 text-gray-800">Store</h1>
		<a href="#" class="d-none d-sm-inline-block btn btn-sm btn-primary shadow-sm"><i
				class="fas fa-download fa-sm text-white-50"></i> Generate Report</a>
	</div>

	<a href="<?php echo base_url().'index.php/Store/addStoreView'; ?>" class="btn btn-primary btn-sm shadow-sm mb-3">Tambah Store</a>

	<div class="card">
		<div class="card-body">
			<div class="table-responsive">
				<table class="table table-bordered" id="table" width="100%" cellspacing="0">
					<thead>
						<tr>
							<th>No.</th>
							<th>Nama Toko</th>
							<th>Pemilik Toko</th>
							<th>Action</th>
						</tr>
					</thead>
					<tbody>
					<?php 
						$i = 1;
             		foreach($stores as $items) : ?>
							<tr>
							<td><?php echo $i++ ?></td>
							<td><?php echo $items["StoreName"] ;?></td>
							<td><?php echo $items["Username"] ;?></td>
							<td>
							<a href="<?php echo base_url('store/viewstore/'.$items["StoreID"]) ?>" target="_blank" class="btn btn-primary">Detail</a>
							<!-- <a href="javascript:void(0)" class="btn btn-warning" data-toggle="modal" data-target="#modal-edit"
								onclick="viewData(<?php echo (int)$items['StoreID'] ?>)">Ubah</a> -->
							</td>
							</tr>
					<?php endforeach;?>
					</tbody>
				</table>
			</div>
		</div>
	</div>
</div>

<div class="modal fade" id="modal-edit" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
	<div class="modal-dialog">
		<div class="modal-content">
			<div class="modal-header">
				<h5 class="modal-title" id="exampleModalLabel">Edit Store</h5>
				<button type="button" class="close" data-dismiss="modal" aria-label="Close">
					<span aria-hidden="true">&times;</span>
				</button>
			</div>
			<form action="<?php echo base_url().'index.php/store/edit' ?>" method="POST" enctype="multipart/form-data">
				<div class="modal-body">
					<div class="row">
					<div class="col-lg-12 d-flex justify-content-center">
					<input type="hidden" id="store_id" name="StoreID" value="">
						<div class="form-group mb-3 w-50">
							<label>Nama Toko</label>
							<input type="text" name="nama_toko" id="nama_toko" class="form-control">
							<p class="error-label mb-0 d-none text-danger">Nama toko tidak boleh kosong</p>
						</div>
					</div>
					<div class="col-lg-12 d-flex justify-content-center">
						<div class="form-group mb-3 w-50">
							<label>Pemilik Toko</label>
							<select name="pemilik_toko" id="pemilik_toko" class="form-control">
								<option value="">Pilih Pemilik Toko</option>
								<?php foreach ($users as $user) : ?>
									<option value="<?php echo $user['UserID']; ?>"><?php echo $user['Username']; ?></option>
								<?php endforeach; ?>
							</select>
							<p class="error-label mb-0 d-none text-danger">Pemilik Toko tidak boleh kosong</p>
						</div>
					</div>
					<div class="col-lg-12 d-flex justify-content-center">
						<div class="form-group mb-3 w-50">
							<label>Lokasi Toko</label>
							<input type="text" name="lokasi_toko" id="lokasi_toko" class="form-control">
							<p class="error-label mb-0 d-none text-danger">Lokasi toko tidak boleh kosong</p>
						</div>
					</div>
					<div class="col-lg-12 d-flex justify-content-center">
						<div class="form-group mb-3 w-50">
							<label>Deskripsi</label>
							<input type="text" name="description" id="description" class="form-control">
							<p class="error-label mb-0 d-none text-danger">Deskripsi tidak boleh kosong</p>
						</div>
					</div>
					<div class="col-lg-12 d-flex justify-content-center">
						<div class="form-group mb-3 w-50">
							<img class="img-preview img-fluid mb-3 col-sm-5">
							<label for="">Choose Image</label>
							<input type="file" name="image" id="image" onchange="previewImage()" class="form-control">
						</div>
					</div>
				</div>
				<div class="modal-footer">
					<button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
					<input type="submit" class="btn btn-md btn-primary rounded-75" value="Submit">
				</div>
			</form>
		</div>
	</div>
</div>

<script src="https://code.jquery.com/jquery-3.6.3.js" integrity="sha256-nQLuAZGRRcILA+6dMBOvcRh5Pe310sBpanc6+QBmyVM="
crossorigin="anonymous"></script>
<script>
	const baseUrl = `<?php echo base_url(); ?>`;
    const idStore = document.getElementById('store_id') //disini error
	const namaToko = document.getElementById('nama_toko')
	const pemilikToko = document.getElementById('pemilik_toko')
	const lokasiToko = document.getElementById('lokasi_toko')
	const description = document.getElementById('description')
	const imagePreview = document.getElementById('image-preview');
	const image = document.getElementById('image')
    const viewData = (idData) => {
		$.ajax({
			url: `<?php echo base_url('index.php/store/editStore'); ?>`,
			type: 'post',
			dataType: 'json',
			data: {
				StoreID: idData
			},
			success: (data) => {
				idStore.value = data.StoreID
				pemilikToko.value = data.UserID
				namaToko.value = data.StoreName
				lokasiToko.value = data.City
				description.value = data.Description
				imagePreview.src = `${baseUrl}assets/img/${data.Avatar}`;
			}
		})
	}

	function previewImage(){
        const image = document.querySelector('#image');
        const imgPreview = document.querySelector('.img-preview');

        imgPreview.style.display = 'block';

        const oFReader = new FileReader();
        oFReader.readAsDataURL(image.files[0]);

        oFReader.onload = function(oFREvent){
          imgPreview.src = oFREvent.target.result;
        }
      }
</script>

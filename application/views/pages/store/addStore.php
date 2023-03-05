<div class="container h-90 my-4 rounded-lg p-5 bg-light shadow-lg">
	<h1 class="text-center mb-2">Tambah Store</h1>
    <?php echo validation_errors(); ?>
    <form action="<?php echo base_url().'index.php/Store/addStore' ?>" method="POST" enctype="multipart/form-data">
        <div class="row">
            <div class="col-lg-12 d-flex justify-content-center">
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
    
            <div class="col-lg-12 d-flex justify-content-center">
                <input type="submit" class="btn btn-md btn-primary rounded-75" value="Submit">
            </div>
        </div>
    </form>
</div>

<script>
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


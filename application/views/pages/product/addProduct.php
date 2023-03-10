<div class="container h-90 my-4 rounded-lg p-5 bg-light shadow-lg">
	<h1 class="text-center mb-2">Tambah Produk</h1>
    <?php echo validation_errors(); ?>
    <form action="<?php echo base_url().'index.php/Product/addProduct' ?>" method="POST" enctype="multipart/form-data">
        <div class="row">
			<div class="col-lg-12 d-flex justify-content-center">
				<div class="form-group mb-3 w-50">
					<label>Nama Toko</label>
					<select name="store_name" id="store" class="form-control">
						<option value="">Pilih Nama Toko</option>
						<?php foreach ($stores as $store) : ?>
							<option value="<?php echo $store['StoreID']; ?>"><?php echo $store['StoreName']; ?></option>
						<?php endforeach; ?>
					</select>
					<p class="error-label mb-0 d-none text-danger">Nama Toko tidak boleh kosong</p>
				</div>
			</div>
            <div class="col-lg-12 d-flex justify-content-center">
                <div class="form-group mb-3 w-50">
                    <label>Nama Produk</label>
                    <input type="text" name="product_name" id="produk" class="form-control">
                    <p class="error-label mb-0 d-none text-danger">Nama produk tidak boleh kosong</p>
                </div>
            </div>
            <div class="col-lg-12 d-flex justify-content-center">
                <div class="form-group mb-3 w-50">
                    <label>Kategori</label>
                    <input type="text" name="category" id="kategori" class="form-control">
                    <p class="error-label mb-0 d-none text-danger">Kategori tidak boleh kosong</p>
                </div>
            </div>
            <div class="col-lg-12 d-flex justify-content-center">
                <div class="form-group mb-3 w-50">
                    <label>Harga</label>
                    <input type="number" name="price" id="harga" max="999999999" class="form-control">
                    <p class="error-label mb-0 d-none text-danger">Harga yang diperbolehkan Rp. 1 ~ 999999999</p>
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


<form method ="POST" action = "<?php echo module_url("kenderaan/save/" .$vehicle->T01_ID)?>">
<div class="col-lg-12">
  <div class="card">
	<div class="px-4 py-3 border-bottom">
	  <h5 class="card-title fw-semibold mb-0">EDIT VEHICLE</h5>
	
	</div>
	<div class="card-body">
	  <div class="mb-4 row align-items-center"> 
		<label for="exampleInputText5" class="form-label fw-semibold col-sm-3 col-form-label text-end">Kod Kenderaan</label>
		<div class="col-sm-9">
		  <input type="text" class="form-control" id="exampleInputText6" placeholder="Kod Kenderaan" name="kod_kend" value="<?php echo $vehicle->T01_KOD_KENDERAAN ?>">
		</div>
	  </div>
	  <div class="mb-4 row align-items-center"> 
		<label for="exampleInputText5" class="form-label fw-semibold col-sm-3 col-form-label text-end">Nama Kenderaan</label>
		<div class="col-sm-9">
		  <input type="text" class="form-control" id="exampleInputText6" placeholder="Nama Kenderaan" name ="nama_kend" value="<?php echo $vehicle->T01_NAMA_KENDERAAN ?>">
		</div>
	  </div>
	  <div class="mb-4 row align-items-center">
		<label for="exampleInputText6" class="form-label fw-semibold col-sm-3 col-form-label text-end">No Plat</label>
		<div class="col-sm-9">
		  <div class="input-group">
			<input type="text" class="form-control" id="exampleInputText6" placeholder="No Plat" name="no_plat" value="<?php echo $vehicle->T01_PLAT ?>">
		  </div>
		</div>
	  </div>
	  <div class="mb-4 row align-items-center">
		<label for="exampleInputText6" class="form-label fw-semibold col-sm-3 col-form-label text-end">Jenama</label>
		<div class="col-sm-9">
		  <div class="input-group">
			<input type="text" class="form-control" id="exampleInputText6" placeholder="Jenama Kenderaan" name="jenama" value="<?php echo $vehicle->T01_JENAMA ?>">
		  </div>
		</div>
	  </div>

      <div class="mb-4 row align-items-center">
		<label for="exampleInputText6" class="form-label fw-semibold col-sm-3 col-form-label text-end">Varian</label>
		<div class="col-sm-9">
		  <div class="input-group">
			<input type="text" class="form-control" id="exampleInputText6" placeholder="Varian Kenderaan" name="varian" value="<?php echo $vehicle->T01_VARIAN ?>">
		  </div>
		</div>
	  </div>
	  
	   <div class="row">
                          <div class="col-sm-3"></div>
                          <div class="col-sm-9">
                            <div class="d-flex align-items-center gap-6">
                              <button class="btn btn-primary">Simpan</button>
                              <button class="btn bg-danger-subtle text-danger">Cancel</button>
                            </div>
                          </div>
                        </div>
	 
	  </div>
	</div>
  </div>
  </form>
<form method="POST" action="<?php echo module_url("drug/add") ?>">
<div class="col-lg-12">
  <div class="card">
	<div class="px-4 py-3 border-bottom">
	  <h5 class="card-title fw-semibold mb-0">ADD NEW DRUG</h5>
	</div>
	<div class="card-body">

	<?php if($this->session->flashdata('error')): ?>
        <div class="alert alert-danger alert-dismissible fade show" role="alert">
          <?php echo $this->session->flashdata('error'); ?>
          <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
      <?php endif; ?>

      <?php if($this->session->flashdata('success')): ?>
        <div class="alert alert-success alert-dismissible fade show" role="alert">
          <?php echo $this->session->flashdata('success'); ?>
          <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
      <?php endif; ?>
	  
	  <div class="mb-4 row align-items-center"> 
		<label for="drugId" class="form-label fw-semibold col-sm-3 col-form-label text-end">Drug ID</label>
		<div class="col-sm-9">
		  <input type="text" class="form-control" id="drugId" placeholder="Drug ID" name="drugId">
		</div>
	  </div>
	  <div class="mb-4 row align-items-center"> 
		<label for="drugName" class="form-label fw-semibold col-sm-3 col-form-label text-end">Drug Name</label>
		<div class="col-sm-9">
		  <input type="text" class="form-control" id="drugName" placeholder="Drug Name" name="drugName">
		</div>
	  </div>
	  <div class="mb-4 row align-items-center">
		<label for="brand" class="form-label fw-semibold col-sm-3 col-form-label text-end">Brand</label>
		<div class="col-sm-9">
		  <input type="text" class="form-control" id="brand" placeholder="Brand" name="brand">
		</div>
	  </div>
	  <div class="mb-4 row align-items-center">
		<label for="pricePerUnit" class="form-label fw-semibold col-sm-3 col-form-label text-end">Price Per Unit</label>
		<div class="col-sm-9">
		  <input type="number" step="0.01" class="form-control" id="pricePerUnit" placeholder="Price Per Unit" name="pricePerUnit">
		</div>
	  </div>
	  <div class="mb-4 row align-items-center">
		<label for="quantity" class="form-label fw-semibold col-sm-3 col-form-label text-end">Quantity</label>
		<div class="col-sm-9">
		  <input type="number" class="form-control" id="quantity" placeholder="Quantity" name="quantity">
		</div>
	  </div>

      <div class="mb-4 row align-items-center">
		<label for="manufacturedDate" class="form-label fw-semibold col-sm-3 col-form-label text-end">Manufactured Date</label>
		<div class="col-sm-9">
		  <div class="input-group">
			<input type="date" class="form-control" id="manufacturedDate" name="manufacturedDate">
			<span class="input-group-text"><i class="fa fa-calendar"></i></span>
		  </div>
		</div>
	  </div>

      <div class="mb-4 row align-items-center">
		<label for="expiryDate" class="form-label fw-semibold col-sm-3 col-form-label text-end">Expiry Date</label>
		<div class="col-sm-9">
		  <div class="input-group">
			<input type="date" class="form-control" id="expiryDate" name="expiryDate">
			<span class="input-group-text"><i class="fa fa-calendar"></i></span>
		  </div>
		</div>
	  </div>
	  
	   <div class="row">
		  <div class="col-sm-3"></div>
		  <div class="col-sm-9">
			<div class="d-flex align-items-center gap-6">
			  <button type="submit" class="btn btn-primary">Save</button>
			  <button type="reset" class="btn bg-danger-subtle text-danger">Cancel</button>
			</div>
		  </div>
		</div>
	</div>
  </div>
</div>
</form>

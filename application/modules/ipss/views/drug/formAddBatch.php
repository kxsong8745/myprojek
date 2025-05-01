<div class="card mx-auto mt-4 shadow-sm" style="max-width: 600px;">
    <div class="card-header text-center">
        <h5 class="mb-0">Add Batch for Drug: <?= $drug->T01_DRUGS ?> (<?= $drug->T01_TRADE_NAME ?>)</h5>
    </div>
    <div class="card-body">
        <?php if ($this->session->flashdata('error')): ?>
            <div class="alert alert-danger">
                <?= $this->session->flashdata('error') ?>
            </div>
        <?php endif; ?>

        <form action="<?= module_url('drug/addBatch/' . $drug->T01_DRUG_ID) ?>" method="POST" class="needs-validation"
            novalidate>
            <input type="hidden" name="drugId" value="<?= $drug->T01_DRUG_ID ?>">

            <div class="mb-2">
                <label for="tenderer" class="form-label fw-semibold">Tenderer *</label>
                <select class="form-select form-select-sm" id="tendererId" name="tendererId" required>
                    <option value="" selected disabled>-- Select Tenderer --</option>
                    <?php foreach ($tenderers as $tenderer): ?>
                        <option value="<?= $tenderer->T03_TEND_ID ?>"><?= $tenderer->T03_TEND_NAME ?></option>
                    <?php endforeach; ?>
                </select>
                <div class="invalid-feedback">Please select a tenderer</div>
            </div>

            <div class="row mb-2">
                <div class="col-md-6">
                    <label for="packageQty" class="form-label fw-semibold">Package Quantity*</label>
                    <input type="number" class="form-control form-control-sm" id="packageQty" name="packageQty"
                        step="0.01" min="0" required>
                    <div class="invalid-feedback">Please enter a valid package quantity</div>
                </div>
                <div class="col-md-6">
                    <label for="totalPricePackageQty" class="form-label fw-semibold">Total Price (RM)*</label>
                    <input type="number" class="form-control form-control-sm" id="totalPricePackageQty"
                        name="totalPricePackageQty" step="0.01" min="0" required>
                    <div class="invalid-feedback">Please enter total price per package</div>
                </div>
            </div>

            <div class="row mb-2">
                <div class="col-md-6">
                    <label for="unitPerPackage" class="form-label fw-semibold">Units per Package *</label>
                    <input type="number" class="form-control form-control-sm" id="unitPerPackage" name="unitPerPackage"
                        min="1" required>
                    <div class="invalid-feedback">Please enter units per package</div>
                </div>
                <div class="col-md-6">
                    <label for="totalUnits" class="form-label fw-semibold">Total Units *</label>
                    <input type="number" class="form-control form-control-sm" id="totalUnits" name="totalUnits" min="1"
                        required>
                    <div class="invalid-feedback">Please enter total units</div>
                </div>
            </div>

            <div class="mb-2">
                <label for="poNo" class="form-label fw-semibold">P/O Number *</label>
                <input type="number" class="form-control form-control-sm" id="poNo" name="poNo" required>
                <div class="invalid-feedback">Please enter PO number</div>
            </div>

            <div class="mb-2">
                <label for="pricePerUnit" class="form-label fw-semibold">Price per Unit (RM)*</label>
                <input type="number" class="form-control form-control-sm" id="pricePerUnit" name="pricePerUnit"
                    placeholder="Total Price / Package Quantity / Units per Package" step="0.01" min="0.01" required>
                <div class="invalid-feedback">Please enter a valid price per unit</div>
            </div>

            <div class="mb-2">
                <label for="barcodeNum" class="form-label fw-semibold">Barcode Number*</label>
                <input type="number" class="form-control form-control-sm" id="barcodeNum" name="barcodeNum"
                    placeholder="Insert the barcode Number" required>
                <div class="invalid-feedback">Please enter a valid barcode number</div>
            </div>

            <div class="row mb-2">
                <div class="col-md-6">
                    <label for="manufacturedDate" class="form-label fw-semibold">Manufactured Date *</label>
                    <input type="date" class="form-control form-control-sm" id="manufacturedDate"
                        name="manufacturedDate" required>
                    <div class="invalid-feedback">Cannot be later than today</div>
                </div>
                <div class="col-md-6">
                    <label for="expiryDate" class="form-label fw-semibold">Expiry Date *</label>
                    <input type="date" class="form-control form-control-sm" id="expiryDate" name="expiryDate" required>
                    <div class="invalid-feedback">Must be later than manufactured date</div>
                </div>
            </div>

            <div class="text-center mt-3">
                <button type="submit" class="btn btn-primary btn-sm">Add Batch</button>
                <a href="<?= module_url('drug/viewBatches/' . $drug->T01_DRUG_ID) ?>"
                    class="btn btn-secondary btn-sm">Cancel</a>
            </div>
        </form>
    </div>
</div>


<!-- Client-side validation script -->
<script>
    (function () {
        'use strict';
        window.addEventListener('load', function () {
            var forms = document.getElementsByClassName('needs-validation');
            var validation = Array.prototype.filter.call(forms, function (form) {
                form.addEventListener('submit', function (event) {
                    if (form.checkValidity() === false) {
                        event.preventDefault();
                        event.stopPropagation();
                    }
                    form.classList.add('was-validated');
                }, false);
            });

            // Add date validation
            document.getElementById('manufacturedDate').addEventListener('change', function () {
                var mfgDate = new Date(this.value);
                var expDate = new Date(document.getElementById('expiryDate').value);

                if (mfgDate >= expDate) {
                    this.setCustomValidity('Manufactured date must be before expiry date');
                } else {
                    this.setCustomValidity('');
                }
            });

            document.getElementById('expiryDate').addEventListener('change', function () {
                var mfgDate = new Date(document.getElementById('manufacturedDate').value);
                var expDate = new Date(this.value);

                if (mfgDate >= expDate) {
                    this.setCustomValidity('Expiry date must be after manufactured date');
                } else {
                    this.setCustomValidity('');
                }
            });
        }, false);
    })();
</script>
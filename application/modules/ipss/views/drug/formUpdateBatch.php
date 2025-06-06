<div class="card mx-auto mt-4 shadow-sm" style="max-width: 600px;">
    <div class="card-header text-center">
        <h5 class="mb-0">Update Batch: <?= $batch->T01_DRUGS ?> (<?= $batch->T01_TRADE_NAME ?>)</h5>
    </div>
    <div class="card-body">
        <?php if ($this->session->flashdata('error')): ?>
            <div class="alert alert-danger">
                <?= $this->session->flashdata('error') ?>
            </div>
        <?php endif; ?>

        <form action="<?= module_url('drug/updateBatch/' . $batch->T02_BATCH_ID) ?>" method="POST"
            class="needs-validation" novalidate>
            <input type="hidden" name="batchId" value="<?= $batch->T02_BATCH_ID ?>">

            <div class="mb-2">
                <label for="tenderer" class="form-label fw-semibold">Tenderer *</label>
                <select class="form-select form-select-sm" id="tendererId" name="tendererId" required>
                    <option value="" disabled>-- Select Tenderer --</option>
                    <?php foreach ($tenderers as $tenderer): ?>
                        <option value="<?= $tenderer->T03_TEND_ID ?>" <?= ($tenderer->T03_TEND_ID == $batch->T02_TENDERER_ID) ? 'selected' : '' ?>>
                            <?= $tenderer->T03_TEND_NAME ?>
                        </option>
                    <?php endforeach; ?>
                </select>
                <div class="invalid-feedback">Please select a tenderer</div>
            </div>

            <div class="row mb-2">
                <div class="col-md-6">
                    <label for="packageQty" class="form-label fw-semibold">Package Quantity *</label>
                    <input type="number" class="form-control form-control-sm" id="packageQty" name="packageQty"
                        step="0.01" min="0" value="<?= $batch->T02_PACKAGE_QUANTITY ?>" required>
                    <div class="invalid-feedback">Please enter a valid package quantity</div>
                </div>
                <div class="col-md-6">
                    <label for="totalPricePackageQty" class="form-label fw-semibold">Total Price (RM)*</label>
                    <input type="number" class="form-control form-control-sm" id="totalPricePackageQty"
                        name="totalPricePackageQty" step="0.01" min="0" value="<?= $batch->T02_TP_PACKAGE_QUANTITY ?>"
                        required>
                    <div class="invalid-feedback">Please enter total price per package</div>
                </div>
            </div>

            <div class="row mb-2">
                <div class="col-md-6">
                    <label for="unitPerPackage" class="form-label fw-semibold">Units per Package *</label>
                    <input type="number" class="form-control form-control-sm" id="unitPerPackage" name="unitPerPackage"
                        min="1" value="<?= $batch->T02_UNIT_PER_PACKAGE ?>" required>
                    <div class="invalid-feedback">Please enter units per package</div>
                </div>

                <div class="col-md-6">
                    <label for="oriTotalUnits" class="form-label fw-semibold">Original Total Units *</label>
                    <input type="number" class="form-control form-control-sm" id="oriTotalUnits" name="oriTotalUnits"
                        min="1" value="<?= $batch->T02_ORI_TOTAL_UNITS ?>" required>
                    <div class="invalid-feedback">Please enter original total units</div>
                </div>

                <div class="col-md-6">
                    <label for="totalUnits" class="form-label fw-semibold">Current Units Left *</label>
                    <input type="number" class="form-control form-control-sm" id="totalUnits" name="totalUnits" min="1"
                        value="<?= $batch->T02_TOTAL_UNITS ?>" required>
                    <div class="invalid-feedback">Please enter total units</div>
                </div>
            </div>

            <div class="mb-2">
                <label for="poNo" class="form-label fw-semibold">PO Number *</label>
                <input type="number" class="form-control form-control-sm" id="poNo" name="poNo"
                    value="<?= $batch->T02_PO_NO ?>" required>
                <div class="invalid-feedback">Please enter PO number</div>
            </div>

            <div class="mb-2">
                <label for="pricePerUnit" class="form-label fw-semibold">Price per Unit (RM)*</label>
                <input type="number" class="form-control form-control-sm" id="pricePerUnit" name="pricePerUnit"
                    placeholder="Total Price / Package Quantity / Units per Package" step="0.01" min="0.01"
                    value="<?= $batch->T02_PRICE_PER_UNIT ?>" required>
                <div class="invalid-feedback">Please enter a valid price per unit</div>
            </div>

            <div class="mb-2">
                <label for="barcodeNum" class="form-label fw-semibold">Barcode Number*</label>
                <input type="number" class="form-control form-control-sm" id="barcodeNum" name="barcodeNum"
                    value="<?= $batch->T02_BARCODE_NUM ?>" required>
                <div class="invalid-feedback">Please enter a valid barcode number</div>
            </div>

            <div class="row mb-2">
                <div class="col-md-6">
                    <label for="manufacturedDate" class="form-label fw-semibold">Manufactured Date *</label>
                    <input type="date" class="form-control form-control-sm" id="manufacturedDate"
                        name="manufacturedDate" value="<?= date('Y-m-d', strtotime($batch->T02_MFD_DATE)) ?>" required>
                    <div class="invalid-feedback">Cannot be later than today</div>
                </div>
                <div class="col-md-6">
                    <label for="expiryDate" class="form-label fw-semibold">Expiry Date *</label>
                    <input type="date" class="form-control form-control-sm" id="expiryDate" name="expiryDate"
                        value="<?= date('Y-m-d', strtotime($batch->T02_EXP_DATE)) ?>" required>
                    <div class="invalid-feedback">Must be later than manufactured date</div>
                </div>
            </div>

            <div class="mb-2">
                <label for="recordDate" class="form-label fw-semibold">Record Date *</label>
                <input type="date" class="form-control form-control-sm" id="recordDate" name="recordDate"
                    value="<?= date('Y-m-d', strtotime($batch->T02_RECORD_DATE)) ?>" required>
                <div class="invalid-feedback">Please enter a valid record date</div>
            </div>

            <div class="text-center mt-3">
                <button type="submit" class="btn btn-primary btn-sm">Update</button>
                <a href="<?= module_url('drug/viewBatches/' . $batch->T02_BATCH_ID) ?>"
                    class="btn btn-secondary btn-sm">Cancel</a>
            </div>
        </form>
    </div>
</div>


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
<div class="container">
    <h4>Generate Expiry Alert PDF</h4>
    <form method="get" action="<?php echo site_url('ipss/alertpdf/expiryAlertPdf'); ?>" target="_blank">
        <div class="form-group">
            <label for="filter">Select Expiry Status</label>
            <select class="form-control" name="filter" id="filter">
                <option value="ALL">All</option>
                <option value="EXPIRED">Expired</option>
                <option value="3_MONTHS">Expires in 3 Months</option>
                <option value="6_MONTHS">Expires in 6 Months</option>
                <option value="9_MONTHS">Expires in 9 Months</option>
            </select>
        </div>
        <button type="submit" class="btn btn-primary mt-2">
            <i class="fas fa-file-pdf"></i> Generate PDF
        </button>
    </>
</div>

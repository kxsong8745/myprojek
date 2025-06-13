<div class="container">
    <h3>Generate Stock Alert PDF</h3>
    <form method="get" action="<?php echo site_url('ipss/alertpdf/stockAlertPdf'); ?>">
        <div class="form-group">
            <label for="filter">Select Alert Type:</label>
            <select name="filter" id="filter" class="form-control" required>
                <option value="ALL">All</option>
                <option value="CRITICAL">Critical</option>
                <option value="WARNING">Warning</option>
            </select>
        </div>
        <button type="submit" class="btn btn-primary mt-2">Generate PDF</button>
    </form>
</div>

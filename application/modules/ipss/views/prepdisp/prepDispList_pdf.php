<!DOCTYPE html>
<html>
<head>
    <title>Prepared Drugs Report</title>
    <style>
        body { font-family: Arial, sans-serif; font-size: 12px; }
        table { width: 100%; border-collapse: collapse; margin-top: 20px; }
        th, td { border: 1px solid #000; padding: 8px; text-align: left; }
        th { background-color: #f2f2f2; }
        .btn {
            display: inline-block;
            padding: 8px 12px;
            color: #fff;
            background-color: #007bff;
            text-decoration: none;
            border-radius: 4px;
            font-size: 12px;
            margin-bottom: 15px;
        }
        .btn:hover {
            background-color: #0056b3;
        }
    </style>
</head>
<body>
<a href="<?= module_url('prepdisp/generatePrepPdf') ?>" class="btn" target="_blank">Generate PDF</a>
    <h2 style="text-align:center;">Prepared Drugs Report</h2>
    <a class="btn btn-primary mb-3" href="<?= module_url('prepdisp/dispList_pdf') ?>">Dispensed Drugs Report</a>
    <table>
        <thead>
            <tr>
                <th>#</th>
                <th>Staff Name</th>
                <th>Drug Name</th>
                <th>Trade Name</th>
                <th>Batch ID</th>
                <th>Prepared Units</th>
                <th>Units Left</th>
                <th>Preparation Date</th>
                <th>Batch Expiry Date</th>
            </tr>
        </thead>
        <tbody>
            <?php if (!empty($preparations)): ?>
                <?php foreach ($preparations as $index => $prep): ?>
                    <tr>
                        <td><?= $index + 1 ?></td>
                        <td><?= $prep->staff_name ?></td>
                        <td><?= $prep->drug_name ?></td>
                        <td><?= $prep->trade_name ?></td>
                        <td><?= $prep->T02_BATCH_ID ?></td>
                        <td><?= $prep->T03_ORI_PREP_UNIT ?></td>
                        <td><?= $prep->T03_PREP_UNIT ?></td>
                        <td><?= date('d-m-Y', strtotime($prep->T03_PREP_DATE)) ?></td>
                        <td><?= date('d-m-Y', strtotime($prep->T02_EXP_DATE)) ?></td>
                    </tr>
                <?php endforeach; ?>
            <?php else: ?>
                <tr>
                    <td colspan="9" style="text-align:center;">No preparations found</td>
                </tr>
            <?php endif; ?>
        </tbody>
    </table>
</body>
</html>


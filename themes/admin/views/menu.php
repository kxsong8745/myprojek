<?php ?>
<ul id="sidebarnav">
	<?php if (!empty($_SESSION['icno'])) { ?>
		<li class="sidebar-item">
			<div style="padding: 8px 16px; font-size: 14px; color: #888;">
				<?= $_SESSION['UID'] . " - " . $_SESSION['STAFF']; ?>
			</div>
			<a href="https://mynemov3.umt.edu.my/mynemov3/mainpage/main" class="sidebar-link">
				<i class="ti ti-corner-up-left-double"></i>
				<span class="hide-menu">Kembali ke MyNemo</span>
			</a>
		</li>

		<li class="sidebar-item">
			<a class="sidebar-link has-arrow" href="javascript:void(0)" aria-expanded="false">
				<iconify-icon icon="solar:document-linear" class="aside-icon"></iconify-icon>
				<span class="hide-menu">Drug Inventory</span>
			</a>
			<ul aria-expanded="false" class="collapse first-level">
				<li class="sidebar-item">
					<a href="<?= base_url() ?>ipss/drug/listDrugs" class="sidebar-link">
						<iconify-icon icon="solar:stop-circle-line-duotone" class="sidebar-icon"></iconify-icon>
						<span class="hide-menu">Drug List</span>
					</a>
				</li>
			</ul>
		</li>

		<li class="sidebar-item">
			<a class="sidebar-link has-arrow" href="javascript:void(0)" aria-expanded="false">
				<iconify-icon icon="solar:document-linear" class="aside-icon"></iconify-icon>
				<span class="hide-menu">Open Shelf</span>
			</a>
			<ul aria-expanded="false" class="collapse first-level">
				<li class="sidebar-item">
					<a href="<?= base_url() ?>ipss/prepdisp/shelfList" class="sidebar-link">
						<iconify-icon icon="solar:stop-circle-line-duotone" class="sidebar-icon"></iconify-icon>
						<span class="hide-menu">Open Shelf List of Drugs</span>
					</a>
				</li>
			</ul>
		</li>

		<li class="sidebar-item">
			<a class="sidebar-link has-arrow" href="javascript:void(0)" aria-expanded="false">
				<iconify-icon icon="solar:document-linear" class="aside-icon"></iconify-icon>
				<span class="hide-menu">Drug Preparation and Dispensation</span>
			</a>
			<ul aria-expanded="false" class="collapse first-level">
				<li class="sidebar-item">
					<a href="<?= base_url() ?>ipss/prepdisp/prepList" class="sidebar-link">
						<iconify-icon icon="solar:stop-circle-line-duotone" class="sidebar-icon"></iconify-icon>
						<span class="hide-menu">Drug Preparation</span>
					</a>
					<a href="<?= base_url() ?>ipss/prepdisp/dispList" class="sidebar-link">
						<iconify-icon icon="solar:stop-circle-line-duotone" class="sidebar-icon"></iconify-icon>
						<span class="hide-menu">Drug Dispensation</span>
					</a>
				</li>
			</ul>
		</li>

		<li class="sidebar-item">
			<a class="sidebar-link has-arrow" href="javascript:void(0)" aria-expanded="false">
				<iconify-icon icon="solar:document-linear" class="aside-icon"></iconify-icon>
				<span class="hide-menu">Alerts</span>
			</a>
			<ul aria-expanded="false" class="collapse first-level">
				<li class="sidebar-item">
					<a href="<?= base_url() ?>ipss/alert/stockAlert" class="sidebar-link">
						<iconify-icon icon="solar:stop-circle-line-duotone" class="sidebar-icon"></iconify-icon>
						<span class="hide-menu">Drug Stock Alert</span>
					</a>
				</li>
				<li class="sidebar-item">
					<a href="<?= base_url() ?>ipss/alert/expiryAlert" class="sidebar-link">
						<iconify-icon icon="solar:stop-circle-line-duotone" class="sidebar-icon"></iconify-icon>
						<span class="hide-menu">Drug Expiry Alert</span>
					</a>
				</li>
			</ul>
		</li>

		<li class="sidebar-item">
			<a class="sidebar-link has-arrow" href="javascript:void(0)" aria-expanded="false">
				<iconify-icon icon="solar:document-linear" class="aside-icon"></iconify-icon>
				<span class="hide-menu">Reports and PDF</span>
			</a>
			<ul aria-expanded="false" class="collapse first-level">
				<li class="sidebar-item">
					<a href="<?= base_url() ?>ipss/chartdisp/staffDispense" class="sidebar-link">
						<iconify-icon icon="solar:stop-circle-line-duotone" class="sidebar-icon"></iconify-icon>
						<span class="hide-menu">Staff Dispense</span>
					</a>
					<a href="<?= base_url() ?>ipss/alertpdf/alertStockForm" class="sidebar-link">
						<iconify-icon icon="solar:stop-circle-line-duotone" class="sidebar-icon"></iconify-icon>
						<span class="hide-menu">Download Stock Alert Report</span>
					</a>
					<a href="<?= base_url() ?>ipss/alertpdf/alertExpForm" class="sidebar-link">
						<iconify-icon icon="solar:stop-circle-line-duotone" class="sidebar-icon"></iconify-icon>
						<span class="hide-menu">Download Expiry Alert Report</span>
					</a>
				</li>
			</ul>
		</li>
	<?php } ?>
</ul>

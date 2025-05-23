<?php
//$role = isset($_SESSION["iac"]) ? $role = $_SESSION["iac"]["level"] : NULL ;
?>
<ul id="sidebarnav">

	<!--<li class="header">MAIN NAVIGATION</li> -->

	<!--
			<li>
			  <a href="<?= base_url() ?>index.php/k1/index/">
				<i class="fa fa-th"></i> <span>Padan Calon EF</span> <small class="label pull-right bg-green">new</small>
			  </a>
			</li> -->


	<li class="sidebar-item">
	

		<?php if (!empty($_SESSION['icno'])) { ?>
			<div style="padding: 8px 16px; font-size: 14px; color: #888;">
				<?= $_SESSION['UID'] . " - " . $_SESSION['STAFF']; ?>
			</div>
			<a href="https://mynemov3.umt.edu.my/mynemov3/mainpage/main" class="sidebar-link">
				<i class="ti ti-corner-up-left-double"></i>
				<span class="hide-menu">Kembali ke MyNemo</span>
			</a>

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
					<a href="<?= base_url() ?>ipss/report/staffDispense" class="sidebar-link">
						<iconify-icon icon="solar:stop-circle-line-duotone" class="sidebar-icon"></iconify-icon>
						<span class="hide-menu">Staff Dispense</span>
					</a>

					<!-- <a href="<?= base_url() ?>ipss/reportpdf/generateDispPdf" class="sidebar-link">
				<iconify-icon icon="solar:stop-circle-line-duotone" class="sidebar-icon"></iconify-icon>
				<span class="hide-menu">Dispense Record download PDF</span>
			  </a> -->

				</li>
			</ul>
		</li>

		<!-- <li class="sidebar-item">
		  <a class="sidebar-link has-arrow" href="javascript:void(0)" aria-expanded="false">
			<iconify-icon icon="solar:document-linear" class="aside-icon"></iconify-icon>
			<span class="hide-menu">Reporting</span>
		  </a> -->
		<!-- <ul aria-expanded="false" class="collapse first-level">
			<li class="sidebar-item">
			  <a href="<?= base_url() ?>ipss/drug/listDrugs" class="sidebar-link">
				<iconify-icon icon="solar:stop-circle-line-duotone" class="sidebar-icon"></iconify-icon>
				<span class="hide-menu">Drug List</span>
			  </a>
			</li>
		  </ul> -->
		<!-- </li> -->



		<!-- <li class="sidebar-item">
		  <a class="sidebar-link has-arrow" href="javascript:void(0)" aria-expanded="false">
			<iconify-icon icon="solar:document-linear" class="aside-icon"></iconify-icon>
			<span class="hide-menu">Admin</span>
		  </a>
		  <ul aria-expanded="false" class="collapse first-level">
			<li class="sidebar-item">
			  <a href="<?= base_url() ?>admin/ccc/index" class="sidebar-link">
				<iconify-icon icon="solar:stop-circle-line-duotone" class="sidebar-icon"></iconify-icon>
				<span class="hide-menu">Proses Bench Fee</span>
			  </a>
			</li>
			<li class="sidebar-item">
			  <a href="<?= base_url() ?>admin/ccc/baki" class="sidebar-link">
				<iconify-icon icon="solar:stop-circle-line-duotone" class="sidebar-icon"></iconify-icon>
				<span class="hide-menu">Senarai Bench Fee</span>
			  </a>
			</li>
			<li class="sidebar-item">
			  <a href="<?= base_url() ?>admin/ccc/xaktif" class="sidebar-link">
				<iconify-icon icon="solar:stop-circle-line-duotone" class="sidebar-icon"></iconify-icon>
				<span class="hide-menu">Pool Tak Aktif</span>
			  </a>
			</li>
			<li class="sidebar-item">
			  <a href="<?= base_url() ?>admin/ccc/txpool" class="sidebar-link">
				<iconify-icon icon="solar:stop-circle-line-duotone" class="sidebar-icon"></iconify-icon>
				<span class="hide-menu">Transaksi Pool</span>
			  </a>
			<li class="sidebar-item">
			  <a href="<?= base_url() ?>admin/ccc/statfak" class="sidebar-link">
				<iconify-icon icon="solar:stop-circle-line-duotone" class="sidebar-icon"></iconify-icon>
				<span class="hide-menu">Statistik Benchfee Fakulti</span>
			  </a>
			</li>
		  </ul>
		</li>
		<li class="sidebar-item">
		  <a class="sidebar-link has-arrow" href="javascript:void(0)" aria-expanded="false">
			<iconify-icon icon="solar:document-linear" class="aside-icon"></iconify-icon>
			<span class="hide-menu">Permohonan</span>
		  </a>
		  <ul aria-expanded="false" class="collapse first-level">
			<li class="sidebar-item">
			  <a href="<?= base_url() ?>pelajar/ccc/listmohon" class="sidebar-link">
				<iconify-icon icon="solar:stop-circle-line-duotone" class="sidebar-icon"></iconify-icon>
				<span class="hide-menu">Senarai Permohonan</span>
			  </a>
			</li>
			<li class="sidebar-item">
			  <a href="<?= base_url() ?>admin/ccc/mohon" class="sidebar-link">
				<iconify-icon icon="solar:stop-circle-line-duotone" class="sidebar-icon"></iconify-icon>
				<span class="hide-menu">Mohon Tuntutan</span>
			  </a>
			</li>
			
			
		  </ul>
		</li>
		<li class="sidebar-item">
		  <a class="sidebar-link has-arrow" href="javascript:void(0)" aria-expanded="false">
			<iconify-icon icon="solar:document-linear" class="aside-icon"></iconify-icon>
			<span class="hide-menu">Keluar Kampus</span>
		  </a>
		  <ul aria-expanded="false" class="collapse first-level">
			<li class="sidebar-item">
			  <a href="<?= base_url() ?>pelajar/ccc/listmohon" class="sidebar-link">
				<iconify-icon icon="solar:stop-circle-line-duotone" class="sidebar-icon"></iconify-icon>
				<span class="hide-menu">Senarai Permohonan</span>
			  </a>
			</li>
			<li class="sidebar-item">
			  <a href="<?= base_url() ?>pelajar/ccc/mohon" class="sidebar-link">
				<iconify-icon icon="solar:stop-circle-line-duotone" class="sidebar-icon"></iconify-icon>
				<span class="hide-menu">Mohon Keluar Kampus</span>
			  </a>
			</li>
			
			
		  </ul>
		</li>
	
	
		
		<?php } ?>
		<li class="sidebar-item">
		  <a class="sidebar-link has-arrow" href="javascript:void(0)" aria-expanded="false">
			<iconify-icon icon="solar:document-linear" class="aside-icon"></iconify-icon>
			<span class="hide-menu">Penyelia</span>
		  </a>
		  <ul aria-expanded="false" class="collapse first-level">
			<li class="sidebar-item">
			  <a href="<?= base_url() ?>sv/ccc/listmohon" class="sidebar-link">
				<iconify-icon icon="solar:stop-circle-line-duotone" class="sidebar-icon"></iconify-icon>
				<span class="hide-menu">Senarai Permohonan</span>
			  </a>
			</li>
			<li class="sidebar-item">
			  <a href="<?= base_url() ?>sv/tunt/listmohon_all" class="sidebar-link">
				<iconify-icon icon="solar:stop-circle-line-duotone" class="sidebar-icon"></iconify-icon>
				<span class="hide-menu">Rekod Permohonan</span>
			  </a>
			</li>
			<li class="sidebar-item">
			  <a href="<?= base_url() ?>outcampus/ccc/listmohon" class="sidebar-link">
				<iconify-icon icon="solar:stop-circle-line-duotone" class="sidebar-icon"></iconify-icon>
				<span class="hide-menu">Permohonan Outcampus</span>
			  </a>
			</li>
			
		  </ul>
		</li> -->
	<!-- <li class="sidebar-item">
		  <a class="sidebar-link has-arrow" href="javascript:void(0)" aria-expanded="false">
			<iconify-icon icon="solar:document-linear" class="aside-icon"></iconify-icon>
			<span class="hide-menu">Dekan</span>
		  </a>
		  <ul aria-expanded="false" class="collapse first-level">
			<li class="sidebar-item">
			  <a href="<?= base_url() ?>dekan/ccc/listmohon" class="sidebar-link">
				<iconify-icon icon="solar:stop-circle-line-duotone" class="sidebar-icon"></iconify-icon>
				<span class="hide-menu">Senarai Permohonan</span>
			  </a>
			</li>
			<li class="sidebar-item">
			  <a href="<?= base_url() ?>dekan/tunt/listmohon_all" class="sidebar-link">
				<iconify-icon icon="solar:stop-circle-line-duotone" class="sidebar-icon"></iconify-icon>
				<span class="hide-menu">Rekod Permohonan</span>
			  </a>
			</li>
			
			
		  </ul>
		</li> -->
	<!-- <li class="sidebar-item">
		  <a class="sidebar-link has-arrow" href="javascript:void(0)" aria-expanded="false">
			<iconify-icon icon="solar:document-linear" class="aside-icon"></iconify-icon>
			<span class="hide-menu">Pembayaran</span>
		  </a>
		  <ul aria-expanded="false" class="collapse first-level">
			<li class="sidebar-item">
			  <a href="<?= base_url() ?>spayment/ccc/listmohon" class="sidebar-link">
				<iconify-icon icon="solar:stop-circle-line-duotone" class="sidebar-icon"></iconify-icon>
				<span class="hide-menu">Senarai Permohonan</span>
			  </a>
			</li>
			<li class="sidebar-item">
			  <a href="<?= base_url() ?>spayment/tunt/listmohon_all" class="sidebar-link">
				<iconify-icon icon="solar:stop-circle-line-duotone" class="sidebar-icon"></iconify-icon>
				<span class="hide-menu">Rekod Permohonan</span>
			  </a>
			</li>
			
			
		  </ul>
		</li> -->
	</li>
</ul>
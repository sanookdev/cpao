<!DOCTYPE html>
<html lang="en-us">

<head>
	<meta charset="utf-8">
	<!--<meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">-->

	<title>รายการข่าว | <?= project_name ?></title>
	<meta name="description" content="">
	<meta name="author" content="">

	<meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no">

	<?php include 'templates/admin/style.php'; ?>
	<link rel="stylesheet" href="https://cdn.datatables.net/buttons/1.6.1/css/buttons.dataTables.min.css" />

</head>

<body class="smart-style-2 fixed-header">

	<!-- HEADER -->
	<?php include 'templates/admin/header.php'; ?>
	<!-- END HEADER -->

	<!-- Left panel : Navigation area -->
	<!-- Note: This width of the aside area can be adjusted through LESS variables -->
	<?php include 'templates/admin/aside.php'; ?>
	<!-- END NAVIGATION -->

	<!-- MAIN PANEL -->
	<div id="main" role="main">
		<!-- RIBBON -->
		<div id="ribbon">

			<!-- breadcrumb -->
			<ol class="breadcrumb">
				<li>จัดการข่าว & RSS</li>
				<li>รายการข่าว</li>
			</ol>
			<!-- end breadcrumb -->

		</div>
		<!-- END RIBBON -->

		<!-- MAIN CONTENT -->
		<div id="content">
			<div class="row">
				<div class="col-xs-12 col-sm-7 col-md-7 col-lg-4">
					<h1 class="page-title txt-color-blueDark">
						<i class="fa fa-newspaper fa-fw "></i>
						จัดการข่าว & RSS
						<span>>
							รายการข่าว
						</span>
					</h1>
				</div>
			</div>
			<div class="row smart-form">
				<section class="col col-3">
					<label class="label">ประเภทข่าว & RSS</label>
					<label class="select">
						<select id="category_id" name="category_id">
							<option disabled="" selected="">เลือก ประเภทข่าว</option>
							<?php
							$i = 0;
							foreach ($list_cate as &$row) { ?>
								<option <?=($i++) == 0 ? 'selected' : ''?> value="<?= $row['category_id'] ?>"><?= $row['category_name'] ?></option>
							<?php  } ?>
						</select> <i></i>
					</label>
				</section>
				<section class="col col-lg-1 col-md-2">
					<label class="label">เดือน</label>
					<label class="select">
						<select id="month" name="month">
							<option selected="" value="">ทั้งหมด</option>
							<?php
							for ($y = 1; $y <= 12; $y++) { ?>
								<option value="<?= $y ?>"><?= $y ?></option>
							<?php  } ?>
						</select> <i></i>
					</label>
				</section>
				<section class="col col-lg-1 col-md-2">
					<label class="label">ปี</label>
					<label class="select">
						<select id="year" name="year">
							<option selected="" value="">ทั้งหมด</option>
							<?php
							$i = 0;
							for ($y = date('Y'); $y >= 2015; $y--) { ?>
								<option <?=($i++) == 0 ? 'selected' : ''?> value="<?= $y ?>"><?= $y ?></option>
							<?php  } ?>
						</select> <i></i>
					</label>
				</section>
			</div>
			<!-- widget grid -->
			<section id="widget-grid" class="">

				<!-- row -->
				<div class="row">
					<article class="col-xs-12 col-sm-12 col-md-12 col-lg-12">

						<!-- Widget ID (each widget will need unique ID)-->
						<div class="jarviswidget jarviswidget-color-darken" id="wid-export-news" data-widget-sortable="false" data-widget-deletebutton="false" data-widget-colorbutton="false" data-widget-editbutton="false">
							<header>
								<span class="widget-icon"> <i class="fa fa-table"></i> </span>
								<h2>ข้อมูลส่งออก </h2>
							</header>
							<!-- widget div-->
							<div>

								<!-- widget edit box -->
								<div class="jarviswidget-editbox">
									<!-- This area used as dropdown edit box -->
								</div>
								<!-- end widget edit box -->

								<!-- widget content -->
								<div class="widget-body no-padding">

									<table id="table" name="news" class="table table-striped table-bordered table-hover" width="100%">
										<thead>
											<tr>
												<th data-class="expand"><i class="fa fa-fw fa-cube text-muted hidden-md hidden-sm hidden-xs"></i> ชื่อข่าว</th>
												<th style="width: 90px;" data-class="expand"><i class="fa fa-fw fa-calendar text-muted hidden-md hidden-sm hidden-xs"></i> วันที่เผยแพร่</th>
												<th class="tool-width">จำนวนคนดู</th>
											</tr>
										</thead>
										<tbody>
										</tbody>
									</table>
								</div>
							</div>
						</div>
					</article>
				</div>
			</section>
		</div>

		<div id="error"></div>

	</div>
	<!-- END MAIN CONTENT -->

	</div>
	<!-- END MAIN PANEL -->

	<!-- PAGE FOOTER -->
	<?php include 'templates/admin/footer.php'; ?>
	<!-- END PAGE FOOTER -->

	<!-- SHORTCUT AREA : With large tiles (activated via clicking user name tag)
		Note: These tiles are completely responsive,
		you can add as many as you like
		-->
	<?php include 'templates/admin/shortcut.php'; ?>
	<!-- END SHORTCUT AREA -->

	<!--================================================== -->

	<?php include 'templates/admin/script.php'; ?>
	<script type="text/javascript" src="https://cdn.datatables.net/buttons/1.3.1/js/dataTables.buttons.min.js"></script>
	<script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/jszip/3.1.3/jszip.min.js"></script>
	<script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.53/pdfmake.min.js"></script>
	<script src="<?= base_url('/_admin/js/libs/vfs_fonts.js') ?>"></script>
	<script type="text/javascript" src="https://cdn.datatables.net/buttons/1.3.1/js/buttons.html5.min.js"></script>
	<script type="text/javascript" src="https://cdn.datatables.net/buttons/1.3.1/js/buttons.print.min.js"></script>

	<script>
		pdfMake.fonts = {
			THSarabun: {
				normal: 'THSarabun.ttf',
				bold: 'THSarabun-Bold.ttf',
				italics: 'THSarabun-Italic.ttf',
				bolditalics: 'THSarabun-BoldItalic.ttf'
			}
		}
		$(document).ready(function() {
			// DO NOT REMOVE : GLOBAL FUNCTIONS!
			pageSetUp();

			var responsiveHelper_dt_basic = [];
			var breakpointDefinition = {
				tablet: 1024,
				phone: 480
			};

			var table = $("table[name=news]").DataTable({
				"dom": "<'dt-toolbar'<'col-sm-6 col-xs-6 hidden-xs'B><'col-xs-12 col-sm-6'f>r>t<'dt-toolbar-footer'<'col-sm-6 col-xs-12 hidden-xs'i><'col-sm-6 col-xs-12'p>>",
				pageLength: 20,
				buttons: [
					'excel'
				],
				"order": [[ 1, "desc" ]],
				"autoWidth": true,
				"oLanguage": {
					"sSearch": '<span class="input-group-addon"><i class="glyphicon glyphicon-search"></i></span>'
				},
				"columns": [
					{
						"data": "news_title"
					},
					{
						"data": "public_date",
						className: 'dt-body-center'
					},
					{
						"data": "views",
						className: 'dt-body-center'
					},
				],
				"preDrawCallback": function() {
					var id = $(this).data('id')
					// Initialize the responsive datatables helper once.
					if (!responsiveHelper_dt_basic[id]) {
						responsiveHelper_dt_basic[id] = new ResponsiveDatatablesHelper($(this), breakpointDefinition);
					}
				},
				"rowCallback": function(nRow) {
					var id = $(this).data('id')
					responsiveHelper_dt_basic[id].createExpandIcon(nRow);
				},
				"drawCallback": function(oSettings) {
					var id = $(this).data('id')
					responsiveHelper_dt_basic[id].respond();
				}
			});

			$('#category_id').change(function() {
				loadData()
			})

			$('#year').change(function() {
				loadData()
			})

			$('#month').change(function() {
				loadData()
			})

			var loadData = function() {
				var before = $('.widget-icon').html()
				let cate_id = $('#category_id').val()
				let year = $('#year').val()
				let month = $('#month').val()
				console.log('year :>> ', year);
				console.log('month :>> ', month);
				$('.widget-icon').html('<i class="fas fa-sync-alt fa-spin"></i>')
				$.get(`<?= base_url() ?>AdminNews/load_list?category_id=${cate_id}&year=${year}&month=${month}`, function(data) {
					table.clear().draw();
					table.rows.add(data); // Add new data
					table.columns.adjust().draw(); // Redraw the DataTable
					$('.widget-icon').html(before)
				}).error(function(error) {
					console.log('error :', error);
					$('#error').html(error.responseText)
				})
			}
			loadData()

		});
	</script>

</body>

</html>
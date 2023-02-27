<!DOCTYPE html>
<html lang="en-us">
<?php
$main_page = "รายงาน";
$page = "รายงานอันดับการรับส่งเมล์";
?>

<head>
	<meta charset="utf-8">
	<!--<meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">-->

	<title><?= $page ?></title>
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
				<li><?= $main_page ?></li>
				<li><?= $page ?></li>
			</ol>
			<!-- end breadcrumb -->

		</div>
		<!-- END RIBBON -->

		<!-- MAIN CONTENT -->
		<div id="content">
			<div class="row">
				<div class="col-xs-12 col-sm-7 col-md-7 col-lg-4">
					<h1 class="page-title txt-color-blueDark">
						<i class="fa fa-crown fa-fw "></i>
						<?= $main_page ?>
						<span>>
							<?= $page ?>
						</span>
					</h1>
				</div>
			</div>
			<div class="row">
				<div class="col-xs-12 mb-1">
					<button class="btn btn-primary" disabled name="btnrun">ดึงข้อมูลอีเมล์</button>
					ข้อมูลเมื่อ <span id="update_date"></span>
				</div>
			</div>
			<!-- widget grid -->
			<section id="widget-grid" class="">
				<div class="smart-form row mt-2">
					<section class="col col-2">
						<label class="label">เดือน</label>
						<label class="select">
							<select id="month" name="month">
								<?php
								for ($month = 1; $month <= 12; $month++) { ?>
									<option <?= date('m') == $month ? 'selected' : '' ?> value="<?= $month ?>"><?= $month ?></option>
								<?php	} ?>
							</select> <i></i>
						</label>
					</section>
					<section class="col col-2">
						<label class="label">ปี</label>
						<label class="select">
							<select id="year" name="year">
								<?php
								for ($year = 2019; $year <= date('Y'); $year++) { ?>
									<option <?= date('Y') == $year ? 'selected' : '' ?> value="<?= $year ?>"><?= $year ?></option>
								<?php	} ?>
							</select> <i></i>
						</label>
					</section>
				</div>
				<!-- row -->
				<div class="row">
					<article class="col-xs-12 col-lg-6">
						<div class="jarviswidget jarviswidget-color-darken" id="wid-id-1-top" data-widget-sortable="false" data-widget-deletebutton="false" data-widget-colorbutton="false" data-widget-editbutton="false">
							<header>
								<span class="widget-icon"> <i class="fa fa-table"></i> </span>
								<h2>รายงานอันดับการส่งเมล์ </h2>
							</header>
							<div>
								<div class="jarviswidget-editbox"></div>
								<div class="widget-body no-padding">
									<table id="table-sent" name="page" class="table table-striped table-bordered table-hover" width="100%">
										<thead>
											<tr>
												<th data-class="expand"><i class="far fa-fw fa-paper-plane text-muted hidden-md hidden-sm hidden-xs"></i> ผู้ส่ง</th>
												<th data-class="expand"><i class="fa fa-fw fa-home text-muted hidden-md hidden-sm hidden-xs"></i> จำนวน</th>
												<th data-class="expand"><i class="fa fa-fw fa-percent text-muted hidden-md hidden-sm hidden-xs"></i> เปอร์เซ็น</th>
											</tr>
										</thead>
										<tbody>
										</tbody>
									</table>
								</div>
							</div>
						</div>
					</article>
					<article class="col-xs-12 col-lg-6">
						<div class="jarviswidget jarviswidget-color-darken" id="wid-id-2-top" data-widget-sortable="false" data-widget-deletebutton="false" data-widget-colorbutton="false" data-widget-editbutton="false">
							<header>
								<span class="widget-icon"> <i class="fa fa-table"></i> </span>
								<h2>รายงานอันดับการรับเมล์ </h2>
							</header>
							<div>
								<div class="jarviswidget-editbox"></div>
								<div class="widget-body no-padding">
									<table id="table-receive" name="page" class="table table-striped table-bordered table-hover" width="100%">
										<thead>
											<tr>
												<th data-class="expand"><i class="far fa-fw fa-envelope text-muted hidden-md hidden-sm hidden-xs"></i> ผู้รับ</th>
												<th data-class="expand"><i class="fa fa-fw fa-home text-muted hidden-md hidden-sm hidden-xs"></i> จำนวน</th>
												<th data-class="expand"><i class="fa fa-fw fa-percent text-muted hidden-md hidden-sm hidden-xs"></i> เปอร์เซ็น</th>
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

	<div class="label-container">
		<div class="label-text">Feedback</div>
		<i class="fa fa-play label-arrow"></i>
	</div>

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

			var responsiveHelper_dt_sent = undefined;
			var responsiveHelper_dt_receive = undefined;
			var breakpointDefinition = {
				tablet: 1024,
				phone: 480
			};

			var tableSent = $('#table-sent').DataTable({
				"dom": "<'dt-toolbar'<'col-sm-6 col-xs-6 hidden-xs'B><'col-xs-12 col-sm-6'f>r>t<'dt-toolbar-footer'<'col-sm-6 col-xs-12 hidden-xs'i><'col-sm-6 col-xs-12'p>>",
				buttons: [
					'excel',
					{
						extend: 'pdfHtml5',
						exportOptions: {
							columns: ':visible'
						},
						customize: function(doc) {
							doc.defaultStyle = {
								font: 'THSarabun',
								fontSize: 16
							};
							doc.content[1].table.widths = ['*', '*', '*'];
						}
					},
					'csv',
					{
						extend: 'print',
						title: 'รายงานอันดับการส่งเมล์'
					}
				],
				"autoWidth": true,
				"oLanguage": {
					"sSearch": '<span class="input-group-addon"><i class="glyphicon glyphicon-search"></i></span>'
				},
				"order": [
					[2, "desc"]
				],
				"columns": [{
						"data": "mail_sender"
					},
					{
						"data": "sented"
					},
					{
						"data": "percent"
					},
				],
				"autoWidth": true,
				"preDrawCallback": function() {
					// Initialize the responsive datatables helper once.
					if (!responsiveHelper_dt_sent) {
						responsiveHelper_dt_sent = new ResponsiveDatatablesHelper($('#table-sent'), breakpointDefinition);
					}
				},
				"rowCallback": function(nRow) {
					var id = $(this).data('id')
					responsiveHelper_dt_sent.createExpandIcon(nRow);
				},
				"drawCallback": function(oSettings) {
					var id = $(this).data('id')
					responsiveHelper_dt_sent.respond();
				}
			});
			var tableReceive = $('#table-receive').DataTable({
				"dom": "<'dt-toolbar'<'col-sm-6 col-xs-6 hidden-xs'B><'col-xs-12 col-sm-6'f>r>t<'dt-toolbar-footer'<'col-sm-6 col-xs-12 hidden-xs'i><'col-sm-6 col-xs-12'p>>",
				buttons: [
					'excel',
					{
						extend: 'pdfHtml5',
						exportOptions: {
							columns: ':visible'
						},
						customize: function(doc) {
							doc.defaultStyle = {
								font: 'THSarabun',
								fontSize: 16
							};
							doc.content[1].table.widths = ['*', '*', '*'];
						}
					}, 'csv', {
						extend: 'print',
						title: 'รายงานอันดับการรับเมล์'
					}
				],
				"autoWidth": true,
				"oLanguage": {
					"sSearch": '<span class="input-group-addon"><i class="glyphicon glyphicon-search"></i></span>'
				},
				"order": [
					[2, "desc"]
				],
				"columns": [{
						"data": "mail_to",
					},
					{
						"data": "sented"
					},
					{
						"data": "percent"
					},
				],
				"preDrawCallback": function() {
					// Initialize the responsive datatables helper once.
					if (!responsiveHelper_dt_receive) {
						responsiveHelper_dt_receive = new ResponsiveDatatablesHelper($(this), breakpointDefinition);
					}
				},
				"rowCallback": function(nRow) {
					var id = $(this).data('id')
					responsiveHelper_dt_receive.createExpandIcon(nRow);
				},
				"drawCallback": function(oSettings) {
					var id = $(this).data('id')
					responsiveHelper_dt_receive.respond();
				}
			});

			$('button[name=btnrun]').click(function() {
				$.get('<?= base_url() ?>Cron/startJobMail', function(data) {
					checkStatus()
				}).error(function(error) {
					console.log('error :', error);
					$('#error').html(error.responseText)
				})
			})

			$('#month').change(function() {
				loadData()
			})

			$('#year').change(function() {
				loadData()
			})

			var checkStatus = function() {
				$.get('<?= base_url() ?>Cron/statusJobMail', function(data) {
					$('button[name=btnrun]').prop('disabled', data.is_start == 1)
					$('#update_date').html(data.update_date)
					if (data.is_start == 1) {
						$('button[name=btnrun]').html(data.job_progress || 'กำลังดึงข้อมูล...')
						setTimeout(() => {
							checkStatus()
						}, 1000);
					} else {
						loadData()
						$('button[name=btnrun]').html('ดึงข้อมูลอีเมล์')
					}
				}).error(function(error) {
					console.log('error :', error);
					$('#error').html(error.responseText)
				})
			}
			checkStatus()

			var loadData = function() {
				var before = $('.widget-icon').html()
				$('.widget-icon').html('<i class="fas fa-sync-alt fa-spin"></i>')
				$.get(`<?= base_url() ?>AdminMail/top_list?month=${$('#month').val()}&year=${$('#year').val()}`, function(data) {
					const {
						sents,
						receives
					} = data;
					if (tableSent) {
						tableSent.clear().draw();
						tableSent.rows.add(sents); // Add new data
						tableSent.columns.adjust().draw(); // Redraw the DataTable
					}
					if (tableReceive) {
						tableReceive.clear().draw();
						tableReceive.rows.add(receives); // Add new data
						tableReceive.columns.adjust().draw(); // Redraw the DataTable
					}
					$('.widget-icon').html(before)
				}).error(function(error) {
					console.log('error :', error);
					$('#error').html(error.responseText)
				})
			}

		});
	</script>

</body>

</html>
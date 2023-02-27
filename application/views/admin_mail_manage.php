<!DOCTYPE html>
<html lang="en-us">
<?php
$main_page = "รายงาน";
$page = "บัญชีอีเมล์";
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
						<i class="fa fa-pager fa-fw "></i>
						<?= $main_page ?>
						<span>>
							<?= $page ?>
						</span>
					</h1>
				</div>
			</div>
			<div class="row">
				<div class="col-xs-3 col-lg-1">
					<button name="btnadd" style="margin-top: 18px;" class="btn btn-block btn-primary">เพิ่มเมล์</button>
				</div>
				<div class="col-xs-8 col-lg-3 mb-1" style="border-left: 1px solid #cccccc;">
					<div class="row">
						<div class="smart-form col-xs-8">
							เลือกไฟล์นำเข้า
							<label class="input input-file">
								<span class="button"><input type="file" id="csv" name="file" onchange="this.parentNode.nextSibling.value = this.value">Browse</span><input id="setting_value" type="text" readonly="">
							</label>
						</div>
						<div class="col-xs-4">
							<button name="btnimport" style="margin-top: 18px;" class="btn btn-block btn-primary">นำเข้า</button>
						</div>
					</div>
				</div>
			</div>
			<!-- widget grid -->
			<section id="widget-grid" class="">

				<!-- row -->
				<div class="row">
					<!-- NEW WIDGET START -->
					<article class="col-xs-12 col-lg-10">

						<!-- Widget ID (each widget will need unique ID)-->
						<div class="jarviswidget jarviswidget-color-darken" id="wid-id-mail-1" data-widget-sortable="false" data-widget-deletebutton="false" data-widget-colorbutton="false" data-widget-editbutton="false">
							<header>
								<span class="widget-icon"> <i class="far fa-envelope"></i> </span>
								<h2>บัญชีอีเมล์ </h2>

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

									<table id="table" name="page" class="table table-striped table-bordered table-hover" width="100%">
										<thead>
											<tr>
												<th data-class="expand" style="width: 50px;">ลำดับ</th>
												<th class="tool-width">จัดการ</th>
												<th><i class="far fa-fw fa-envelope text-muted hidden-md hidden-sm hidden-xs"></i> เมล์</th>
												<th data-hide="phone"><i class="fa fa-fw fa-cube text-muted hidden-md hidden-sm hidden-xs"></i> Domain</th>
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

	<div class="modal" id="modal-save" tabindex="-1" role="dialog">
		<div class="modal-dialog" role="document">
			<div class="modal-content">
				<div class="modal-header">
					<h5 class="modal-title"></h5>
					<button type="button" class="close" data-dismiss="modal" aria-label="Close">
						<span aria-hidden="true">&times;</span>
					</button>
				</div>
				<div class="modal-body" style="padding-top: 0px;">
					<form id="save-form" class="smart-form">
						<fieldset>
							<div class="row">
								<section class="ph-2">
									<label class="label">เมล์</label>
									<label class="input"> <i class="icon-prepend fa fa-envelope"></i>
										<input autocomplete="off" type="text" id="mail" name="mail" placeholder="">
										<b class="tooltip tooltip-top-right"><i class="fas fa-fw fa-envelope txt-color-teal"></i> เมล์</b>
									</label>
								</section>
							</div>
							<div class="row">
								<section class="ph-2">
									<label class="label">รหัสผ่าน</label>
									<label class="input"> <i class="icon-prepend fa fa-lock"></i>
										<input type="password" autocomplete="off" id="mail_password" name="mail_password" placeholder="">
										<b class="tooltip tooltip-top-right"><i class="fas fa-fw fa-lock txt-color-teal"></i> รหัสผ่าน</b>
									</label>
								</section>
							</div>
							<div class="row">
								<section class="ph-2">
									<label class="label">Domain</label>
									<label class="input"> <i class="icon-prepend fa fa-cube"></i>
										<input type="text" id="host" value="chon.go.th" name="host" placeholder="">
										<b class="tooltip tooltip-top-right"><i class="fas fa-fw fa-cube txt-color-teal"></i> Domain</b>
									</label>
								</section>
							</div>
							<div class="row">
								<section class="col col-6">
									<label class="checkbox"><input type="checkbox" name="toggle_password" id="toggle_password"><i></i>Show password</label>
								</section>
							</div>
						</fieldset>
						<button type="submit" style="display: none;" class="btn btn-primary"></button>
					</form>
				</div>
				<div class="modal-footer">
					<button name="btnsave" type="button" class="btn btn-primary">Save changes</button>
					<button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
				</div>
			</div>
		</div>
	</div>

	<button name="btnadd" class="btn-primary float">
		<i class="fa fa-plus my-float"></i>
	</button>
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

	<script src="https://cdnjs.cloudflare.com/ajax/libs/xls/0.7.4-a/xls.js"></script>
	<script src="<?= base_url('/js/xlsx.full.min.js') ?>"></script>

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

			var responsiveHelper_dt_basic = undefined;
			var breakpointDefinition = {
				tablet: 1024,
				phone: 480
			};

			var modalSave = $('#modal-save')
			var typeModal = ''
			var table = $('#table').DataTable({
				"dom": "<'dt-toolbar'<'col-sm-6 col-xs-6 hidden-xs'B><'col-xs-12 col-sm-6'f>r>t<'dt-toolbar-footer'<'col-sm-6 col-xs-12 hidden-xs'i><'col-sm-6 col-xs-12'p>>",
				buttons: [
					'excel', {
						extend: 'pdfHtml5',
						exportOptions: {
							columns: [0,2,3]
						},
						customize: function(doc) {
							doc.defaultStyle = {
								font: 'THSarabun',
								fontSize: 16
							};
							doc.content[1].table.widths = ['auto', '*', '*'];
						}
					}, 'csv', {
						extend: 'print',
						title: 'บัญชีอีเมล์',
						exportOptions: {
							columns: [0,2,3]
						},
					}
				],
				"autoWidth": true,
				"oLanguage": {
					"sSearch": '<span class="input-group-addon"><i class="glyphicon glyphicon-search"></i></span>'
				},
				"columns": [{
						"render": function(data, type, full, meta) {
							return meta.row + 1
						},
						className: 'dt-body-center'
					},
					{
						"render": function(data, type, full, meta) {
							var html = `<button name="btnedit" data-id="${full.mail}" 
								class="btn btn-xs btn-default"><i class="fas fa-pencil-alt"></i></button>`
							html += `<button name="btndelete" data-id="${full.mail}"
									class="btn btn-xs btn-danger"><i class="fa fa-trash"></i></button>`;
							return html
						}
					},
					{
						"data": "mail"
					},
					{
						"data": "host"
					},
				],
				"preDrawCallback": function() {
					// Initialize the responsive datatables helper once.
					if (!responsiveHelper_dt_basic) {
						responsiveHelper_dt_basic = new ResponsiveDatatablesHelper($(this), breakpointDefinition);
					}
				},
				"rowCallback": function(nRow) {
					var id = $(this).data('id')
					responsiveHelper_dt_basic.createExpandIcon(nRow);
				},
				"drawCallback": function(oSettings) {
					var id = $(this).data('id')
					responsiveHelper_dt_basic.respond();
				}
			});

			$('button[name=btnsave]').click(function() {
				$('#save-form').submit()
			})

			var errorClass = 'invalid';
			var errorElement = 'em';
			var validator = $("#save-form").validate({
				// Rules for form validation
				errorClass: errorClass,
				errorElement: errorElement,
				highlight: function(element) {
					$(element).parent().removeClass('state-success').addClass("state-error");
					$(element).removeClass('valid');
				},
				unhighlight: function(element) {
					$(element).parent().removeClass("state-error").addClass('state-success');
					$(element).addClass('valid');
				},
				rules: {
					mail: {
						required: true,
						remote: {
							url: "<?= base_url() ?>adminMail/check_duplicate",
							type: "get",
							data: {
								action: function() {
									return typeModal;
								},
								value: function() {
									var value = $("#mail").val();
									return value;
								}
							}
						}
					},
					mail_password: {
						required: true,
					},
					host: {
						required: true,
					},
				},

				// Messages for form validation
				messages: {
					mail: {
						remote: 'Email ซ้ำ'
					}
				},

				submitHandler: function() {
					var dataForm = $('#save-form').serializeArray();
					dataForm.push({
						name: 'old',
						value: old
					});
					console.log('old', old)
					$.confirm({
						title: 'กรุณายืนยันบันทึกข้อมูล',
						content: 'ต้องการบันทึกข้อมูล ?',
						escapeKey: 'no',
						backgroundDismiss: true,
						buttons: {
							yes: {
								btnClass: 'btn-blue',
								keys: ['enter'],
								action: function() {
									$.post("<?= base_url() ?>AdminMail/save", dataForm, function(data) {
											if (data.isError && data.Message) {
												$.alert({
													title: 'Warning!',
													type: 'red',
													content: data.Message,
												});
											} else {
												loadData()
												toastr.success(data.Message, {
													timeOut: 2000
												})
												modalSave.modal('hide')
											}
										})
										.error(function(error) {
											console.log('error :', error);
											$('#error').html(error.responseText)
										})
								}
							},
							no: {
								keys: ['esc'],
								action: function() {}
							}
						}
					});

				},

				// Do not change code below
				errorPlacement: function(error, element) {
					error.insertAfter(element.parent());
				}
			})

			var lines = [];

			function processData(allText) {
				var allTextLines = allText.split(/\r\n|\n/);
				var headers = ['mail', 'mail_password']
				lines = []
				for (var i = 0; i < allTextLines.length; i++) {
					var data = allTextLines[i].split(',');
					if (data.length == headers.length) {
						var tarr = {};
						for (var j = 0; j < headers.length; j++) {
							tarr[headers[j]] = data[j];
						}
						tarr['host'] = tarr['mail'].split('@')[1]
						lines.push(tarr);
					}
				}
			}
			var fileInput = document.getElementById("csv"),
				readFile = function() {
					var sFilename = fileInput.files[0].name;
					const extension = sFilename.split('.')[sFilename.split('.').length - 1].toLocaleLowerCase()
					var reader = new FileReader();
					$('button[name=btnimport]').prop('disabled', true)
					reader.onload = function(e) {
						if (extension == 'csv') {
							processData(reader.result)
						} else if (extension == 'xls') {
							var data = e.target.result;
							var cfb = XLS.CFB.read(data, {
								type: 'binary'
							});
							var wb = XLS.parse_xlscfb(cfb);
							// Loop Over Each Sheet
							wb.SheetNames.forEach(function(sheetName) {
								// Obtain The Current Row As CSV
								var sCSV = XLS.utils.make_csv(wb.Sheets[sheetName]);
								var oJS = XLS.utils.sheet_to_row_object_array(wb.Sheets[sheetName]);
								processData(sCSV)
							});
						} else if (extension == 'xlsx') {
							var data = e.target.result;
							var cfb = XLSX.read(data, {
								type: 'binary'
							});
							// Loop Over Each Sheet
							cfb.SheetNames.forEach(function(sheetName) {
								var sCSV = XLS.utils.make_csv(cfb.Sheets[sheetName]);
								var oJS = XLS.utils.sheet_to_json(cfb.Sheets[sheetName]);
								processData(sCSV)
							});
						}
						$('button[name=btnimport]').prop('disabled', false)
					};
					// start reading the file. When it is done, calls the onload event defined above.
					reader.readAsBinaryString(fileInput.files[0]);
				};
			fileInput.addEventListener('change', readFile);

			$('button[name=btnimport]').click(function() {
				$('button[name=btnimport]').prop('disabled', true)
				$.post("<?= base_url() ?>AdminMail/import", {
						lines
					}, function(data) {
						$('button[name=btnimport]').prop('disabled', false)
						if (data.isError && data.Message) {
							$.alert({
								title: 'Warning!',
								type: 'red',
								content: data.Message,
							});
						} else {
							loadData()
							toastr.success(data.Message, {
								timeOut: 2000
							})
							modalSave.modal('hide')
						}
					})
					.error(function(error) {
						console.log('error :', error);
						$('#error').html(error.responseText)
					})
			});

			$('#toggle_password').change(function() {
				if ($('#mail_password').prop('type') == 'text') {
					$('#mail_password').prop('type', 'password');
				} else {
					$('#mail_password').prop('type', 'text');
				}
			})

			$(document).on('click', 'button[name=btndelete]', function() {
				var id = $(this).data('id')
				$.confirm({
					title: 'กรุณายืนยันการลบข้อมูล!',
					content: 'ต้องการลบข่าวนี้หรือไม่?',
					backgroundDismiss: true,
					buttons: {
						confirm: {
							btnClass: 'btn-red',
							action: function() {
								$.post('<?= base_url() ?>AdminMail/remove', {
									id: id
								}, function(data) {
									if (data.isError && data.Message) {
										$.alert({
											title: 'Warning!',
											type: 'red',
											content: data.Message,
										});
									} else {
										loadData()
										toastr.success(data.Message, {
											timeOut: 2000
										})
									}
								})
							}
						},
						cancel: function() {}
					}
				});
			})

			$('button[name=btnadd]').click(function() {
				typeModal = 'new'
				old = ''
				$('.modal-title').html('เพิ่มเมล์')
				$('#mail').val('')
				$('#mail_password').val('')
				$('#host').val('')
				$('#toggle_password').prop('checked', false)
				$('.invalid').remove()
				$('label').removeClass('state-error')
				$('label').removeClass('state-success')
				modalSave.modal('show')
				validator.resetForm();
				validator.reset();
				$('#mail').select()
			})

			let old = ''

			$(document).on('click', 'button[name=btnedit]', function() {
				var id = $(this).data('id')
				old = $(this).data('id')
				typeModal = 'edit'
				$('.modal-title').html('แก้ไขเมล์ ' + id)
				$.get('<?= base_url() ?>AdminMail/mail?id=' + id, function(data) {
						$('#mail').val(data.mail)
						$('#mail_password').val(data.mail_password)
						$('#host').val(data.host)
						$('.invalid').remove()
						$('label').removeClass('state-error')
						$('label').removeClass('state-success')
						modalSave.modal('show')
						validator.resetForm();
						validator.reset();
						$('#mail').select()
					})
					.error(function(error) {
						console.log('error :', error);
						$('#error').html(error.responseText)
					})
			})

			function checkFloating() {
				var isElementInView = Utils.isElementInView($('button[name=btnadd]'), false);
				if (isElementInView) {
					$('.float').css('display', 'none')
				} else {
					$('.float').css('display', 'inline-block')
				}
			}
			checkFloating();
			$(window).on('scroll', function() {
				checkFloating();
			});

			var loadData = function() {
				var before = $('.widget-icon').html()
				$('.widget-icon').html('<i class="fas fa-sync-alt fa-spin"></i>')
				$.get('<?= base_url() ?>AdminMail/load_list', function(data) {
					if (table) {
						table.clear().draw();
						table.rows.add(data); // Add new data
						table.columns.adjust().draw(); // Redraw the DataTable
					}
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
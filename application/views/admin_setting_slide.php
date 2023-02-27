<!DOCTYPE html>
<html lang="en-us">

<head>
	<meta charset="utf-8">
	<!--<meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">-->

	<title><?= $page ?> | <?= project_name ?></title>
	<meta name="description" content="">
	<meta name="author" content="">

	<meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no">

	<?php include 'templates/admin/style.php'; ?>
	<link rel="stylesheet" href="https://cdn.jsdelivr.net/gh/fancyapps/fancybox@3.5.7/dist/jquery.fancybox.min.css" />
	<link rel="stylesheet" href="<?= base_url('/css/slick/slick.css') ?>">
	<link rel="stylesheet" href="<?= base_url('/css/slick/slick-theme.css') ?>">

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
				<li>ตั้งค่าเว็บไซต์</li>
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
						<i class="fa fa-cogs fa-fw "></i>
						ตั้งค่าเว็บไซต์
						<span>>
							<?= $page ?>
						</span>
					</h1>
				</div>
			</div>
			<div class="row">
				<div class="col-xs-12 mb-1">
					<button id="btnadd" class="btn btn-primary">เพิ่ม<?= $page ?></button>
				</div>
			</div>
			<!-- widget grid -->
			<section id="widget-grid" class="">

				<!-- row -->
				<div class="row">

					<!-- NEW WIDGET START -->
					<article class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
						<div class="slide-small">
						</div>
						<!-- Widget ID (each widget will need unique ID)-->
						<div class="jarviswidget jarviswidget-color-darken" id="wid-id-0" data-widget-sortable="false" data-widget-deletebutton="false" data-widget-colorbutton="false" data-widget-editbutton="false">
							<header>
								<span class="widget-icon"> <i class="fa fa-table"></i> </span>
								<h2>รายการ <?= $page ?> </h2>

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

									<table id="table" class="table table-striped table-bordered table-hover" width="100%">
										<thead>
											<tr>
												<th style="width: 50px;">ลำดับ</th>
												<th class="tool-width-3">จัดการ</th>
												<th data-class="expand"><i class="fa fa-fw fa-cube text-muted hidden-md hidden-sm hidden-xs"></i> ข้อมูล</th>
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
					<h5 class="modal-title">แก้ไข<?= $page ?></h5>
					<button type="button" class="close" data-dismiss="modal" aria-label="Close">
						<span aria-hidden="true">&times;</span>
					</button>
				</div>
				<div class="modal-body" style="padding-top: 0px;">
					<form id="save-form" action="<?= base_url() ?>AdminUpload/fileUpload" method="post" class="smart-form">
						<input type="hidden" id="setting_id" name="setting_id">
						<fieldset>
							<div class="row">
								<section class="ph-2">
									<label class="label"><?= (strstr($page, 'รูป') ? '' : 'รูป') . $page ?></label>
									<label class="input input-file">
										<span class="button"><input type="file" id="file" name="file" onchange="this.parentNode.nextSibling.value = this.value">Browse</span><input id="setting_value" type="text" readonly="">
									</label>
								</section>
							</div>
							<div class="row">
								<section class="ph-2 field-text">
									<label class="label">ชื่อ</label>
									<label class="input"> <i class="icon-prepend fas fa-fw fa-cube"></i>
										<input type="text" maxlength="200" id="setting_value3" name="setting_value3" placeholder="ชื่อ">
										<b class="tooltip tooltip-top-right"><i class="fas fa-fw fa-link txt-color-teal"></i> ชื่อ</b>
									</label>
								</section>
							</div>
							<div class="row">
								<section class="ph-2 field-text">
									<label class="label">ลิงค์</label>
									<label class="input"> <i class="icon-prepend fas fa-fw fa-link"></i>
										<input type="text" maxlength="200" id="setting_value2" name="setting_value2" placeholder="eg. http://www...">
										<b class="tooltip tooltip-top-right"><i class="fas fa-fw fa-link txt-color-teal"></i> ลิงค์</b>
									</label>
								</section>
							</div>
							<div class="row">
								<section class="col col-6">
									<label class="checkbox"><input type="checkbox" value="1" name="is_show" id="is_show"><i></i>แสดง</label>
								</section>
							</div>
							<div class="row">
								<section class="col col-6">
									<a data-fancybox="gallery" id="fancy" href=""><img onError="this.src='<?= base_url('/img/placeholder.jpg') ?>';" style="max-height: 100px;" id="blah" src="#" alt="your image" /></a>
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

	<!--================================================== -->

	<?php include 'templates/admin/script.php'; ?>
	<script src="https://cdn.jsdelivr.net/gh/fancyapps/fancybox@3.5.7/dist/jquery.fancybox.min.js"></script>
	<script src="<?= base_url('/js/slick.min.js') ?>"></script>

	<script>
		$(document).ready(function() {
			// DO NOT REMOVE : GLOBAL FUNCTIONS!
			pageSetUp();

			var responsiveHelper_dt_basic = undefined;
			var breakpointDefinition = {
				tablet: 1024,
				phone: 480
			};

			var modalSave = $('#modal-save')

			$("#file").change(function() {
				if (this.files && this.files[0]) {
					var reader = new FileReader();

					reader.onload = function(e) {
						$('#blah').attr('src', e.target.result);
						$('#fancy').attr('href', e.target.result);
					}

					reader.readAsDataURL(this.files[0]);
				}
			});

			var table = $('#table').DataTable({
				rowReorder: true,
				"sDom": "<'dt-toolbar'<'col-xs-12 col-sm-6'f><'col-sm-6 col-xs-12 hidden-xs'l>r>" +
					"t" +
					"<'dt-toolbar-footer'<'col-sm-6 col-xs-12 hidden-xs'i><'col-xs-12 col-sm-6'p>>",
				"autoWidth": true,
				"oLanguage": {
					"sSearch": '<span class="input-group-addon"><i class="glyphicon glyphicon-search"></i></span>'
				},
				"columns": [{
						"data": "setting_no",
						"render": function(data, type, full, meta) {
							return `<section class="smart-form">
										<label class="input"> 
											<input value="${data}" type="number" min="0" data-id="${full.setting_id}" name="tb_setting_no" placeholder="ลำดับ">
										</label>
									</section>`
						}
					},
					{
						"render": function(data, type, full, meta) {
							var html = `<button name="btnedit" data-id="${full.setting_id}" 
								class="btn btn-xs btn-default"><i class="fas fa-pencil-alt"></i></button>`
							html += `<button name="btnshow" data-value="${full.is_show}" data-id="${full.setting_id}" class="btn btn-xs ${full.is_show == '0' ? 'btn-danger' : 'btn-primary' }">${full.is_show == '0' ? '<i class="fa fa-eye-slash"></i>' : '<i class="fa fa-eye"></i>' }</button>`;
							html += `<button name="btndelete" data-id="${full.setting_id}" class="btn btn-xs btn-danger"><i class="fa fa-trash"></i></button>`;
							return html
						}
					},

					{
						"data": "setting_value",
						"render": function(data, type, full, meta) {
							return `<a data-fancybox="gallery" href="<?= base_url('/uploads/') ?>${data}"><img src="<?= base_url('/uploads/') ?>${data}" style="height: 32px;"></a> ${full.setting_value3 || '<code>(ไม่มีชื่อ)</code>'}`
						}
					},

				],
				"preDrawCallback": function() {
					// Initialize the responsive datatables helper once.
					if (!responsiveHelper_dt_basic) {
						responsiveHelper_dt_basic = new ResponsiveDatatablesHelper($('#table'), breakpointDefinition);
					}
				},
				"rowCallback": function(nRow) {
					responsiveHelper_dt_basic.createExpandIcon(nRow);
				},
				"drawCallback": function(oSettings) {
					responsiveHelper_dt_basic.respond();
				}
			});

			$('button[name=btnsave]').click(function() {
				$('#save-form').submit()
			})

			function showErrors(errorMessage, errormap, errorlist) {
				var val = this;
				errormap.forEach(function(error, index) {
					val.settings.highlight.call(val, error.element, val.settings.errorClass, val.settings.validClass);
					$(error.element).siblings("span.field-validation-valid, span.field-validation-error").html($("<span></span>").html(error.message)).addClass("field-validation-error").removeClass("field-validation-valid").show();
				});
			}
			var errorClass = 'invalid';
			var errorElement = 'em';
			var validator = $("#save-form").validate({
				// Rules for form validation
				errorClass: errorClass,
				errorElement: errorElement,
				showErrors: showErrors,
				highlight: function(element) {
					if ($(element).prop('type') == 'file') {
						$(element).parents('.input').removeClass('state-success').addClass("state-error");
						$(element).removeClass('valid');
					} else {
						$(element).parent().removeClass('state-success').addClass("state-error");
						$(element).removeClass('valid');
					}
				},
				unhighlight: function(element) {
					if ($(element).prop('type') == 'file') {
						$(element).parents('.input').removeClass('state-error').addClass("state-success");
						$(element).addClass('valid');
					} else {
						$(element).parent().removeClass("state-error").addClass('state-success');
						$(element).addClass('valid');
					}
				},

				// Messages for form validation
				messages: {},

				submitHandler: function() {
					var dataForm = $('#save-form').serializeArray();
					if ($('#file').val() == '' && $('#setting_value').val() == '') {
						$.alert({
							title: 'Warning!',
							type: 'red',
							backgroundDismiss: true,
							content: 'กรุณาเลือกไฟล์',
						});
						return;
					}
					if (dataForm.find(x => x.name == 'is_show') == null) {
						dataForm.push({
							name: 'is_show',
							value: 0
						});
					}
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
									var form = $('#save-form')[0];
									var formData = new FormData(form);
									$.ajax({
										url: "<?= base_url() ?>AdminUpload/fileUpload",
										data: formData,
										type: 'POST',
										contentType: false,
										processData: false,
										success: function(uploadData) {
											if (uploadData['file_name']) {
												var filename = uploadData['file_name'].replace(/^.*[\\\/]/, '')
												dataForm.push({
													name: 'setting_value',
													value: filename
												});
											}
											$.post("<?= base_url() ?><?= $post ?>/save", dataForm, function(data) {
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
									}).fail(function(error) {
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

			$(document).on('focus', 'input[name=tb_setting_no]', function() {
				$(this).select()
			})

			$(document).on('change', 'input[name=tb_setting_no]', function() {
				var id = $(this).data('id')
				var number = $(this).val()
				var dataForm = {
					setting_id: id,
					setting_no: number
				}
				$.post("<?= base_url() ?><?= $post ?>/save_no", dataForm, function(data) {
						if (data.isError && data.Message) {
							$.alert({
								title: 'Warning!',
								type: 'red',
								content: data.Message,
							});
						} else {
							loadData()
							toastr.success(data.Message, {
								timeOut: 1000
							})
						}
					})
					.error(function(error) {
						console.log('error :', error);
						$('#error').html(error.responseText)
					})
			})

			$(document).on('click', 'button[name=btnshow]', function() {
				var id = $(this).data('id')
				var value = $(this).data('value') == '0' ? '1' : '0'
				var text = value == '0' ? 'ซ่อน' : 'แสดง'
				$.post('<?= base_url() ?><?= $post ?>/show', {
					id: id,
					value: value,
				}, function(data) {
					if (data.isError && data.Message) {
						$.alert({
							title: 'Warning!',
							type: 'red',
							content: data.Message,
						});
					} else {
						loadData()
						if (value == '0') {
							toastr.warning(data.Message, {
								timeOut: 2000
							})
						} else {
							toastr.success(data.Message, {
								timeOut: 2000
							})
						}
					}
				})
			})

			$(document).on('click', 'button[name=btndelete]', function() {
				var id = $(this).data('id')
				$.confirm({
					title: 'กรุณายืนยันการลบข้อมูล!',
					content: 'ต้องการลบผู้ใช้นี้หรือไม่?',
					backgroundDismiss: true,
					buttons: {
						confirm: {
							btnClass: 'btn-red',
							action: function() {
								$.post('<?= base_url() ?><?= $post ?>/remove', {
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

			$('#btnadd').click(function() {
				$('#file').val('')
				$('#blah').attr('src', '');
				$('#fancy').attr('href', '#');
				$('.modal-title').html('เพิ่ม<?= $page ?>')
				$('#setting_id').val('')
				$('#setting_value').val('')
				$('#is_show').prop('checked', false)
				$('.invalid').remove()
				$('label').removeClass('state-error')
				$('label').removeClass('state-success')
				modalSave.modal('show')
				$('#setting_value').select()
			})

			$(document).on('click', 'button[name=btnedit]', function() {
				var id = $(this).data('id')
				$('.modal-title').html('แก้ไข<?= $page ?>')
				$.get('<?= base_url() ?><?= $post ?>/setting?id=' + id, function(data) {
						$('#setting_id').val(data.setting_id)
						$('#setting_value').val(data.setting_value)
						$('#setting_value3').val(data.setting_value3)
						$('#setting_value2').val(data.setting_value2)
						$('#is_show').prop('checked', data.is_show == '1')
						$('.invalid').remove()
						$('label').removeClass('state-error')
						$('#blah').prop('src', `<?= base_url('/uploads/') ?>${data.setting_value}`)
						$('#fancy').prop('href', `<?= base_url('/uploads/') ?>${data.setting_value}`)
						$('label').removeClass('state-success')
						modalSave.modal('show')
						$('#setting_value').select()
					})
					.error(function(error) {
						console.log('error :', error);
						$('#error').html(error.responseText)
					})
			})
			$('.slide-small').slick({
				dots: true,
				arrows: true,
				autoplay: false,
			});
			var loadData = function() {
				var before = $('.widget-icon').html()
				$('.widget-icon').html('<i class="fas fa-sync-alt fa-spin"></i>')
				$.get('<?= base_url() ?><?= $post ?>/load_list', function(data) {
					table.clear().draw();
					table.rows.add(data); // Add new data
					table.columns.adjust().draw(); // Redraw the DataTable
					$('.widget-icon').html(before)
					$('.slide-small').slick('removeSlide', null, null, true);
					for (var i in data) {
						var item = data[i]
						if (item.is_show == 1) {
							$('.slide-small').slick('slickAdd', `<img src="<?= base_url('/uploads/') ?>${item.setting_value}" class="img-responsive" style="width: 100%">`);
						}
					}
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
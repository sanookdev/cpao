<!DOCTYPE html>
<html lang="en-us">
<?php
$main_page = "ตั้งค่าเมนู";
$page = "รายการเมนูหลัก";
?>

<head>
	<meta charset="utf-8">
	<!--<meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">-->

	<title><?= $page ?> | <?=project_name?></title>
	<meta name="description" content="">
	<meta name="author" content="">

	<meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no">

	<?php include 'templates/admin/style.php'; ?>
	<link rel="stylesheet" href="https://cdn.jsdelivr.net/gh/fancyapps/fancybox@3.5.7/dist/jquery.fancybox.min.css" />

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
						<i class="fa fa-list fa-fw "></i>
						<?= $main_page ?>
						<span>>
							<?= $page ?>
						</span>
					</h1>
				</div>
			</div>
			<div class="row">
				<div class="col-xs-12 mb-1">
					<button id="btnadd" class="btn btn-primary">เพิ่มเมนูหลัก</button>
				</div>
			</div>
			<!-- widget grid -->
			<section id="widget-grid" class="">

				<!-- row -->
				<div class="row">

					<!-- NEW WIDGET START -->
					<article class="col-xs-12 col-sm-12 col-md-12 col-lg-12">

						<!-- Widget ID (each widget will need unique ID)-->
						<div class="jarviswidget jarviswidget-color-darken" id="wid-id-0" data-widget-sortable="false" data-widget-deletebutton="false" data-widget-colorbutton="false" data-widget-editbutton="false">
							<header>
								<span class="widget-icon"> <i class="fa fa-table"></i> </span>
								<h2><?= $page ?> </h2>

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
												<th data-class="expand"><i class="fa fa-fw fa-cube text-muted hidden-md hidden-sm hidden-xs"></i> ชื่อเมนู</th>
												<th data-class="expand"><i class="fa fa-fw fa-link text-muted hidden-md hidden-sm hidden-xs"></i> URL</th>
												<th data-class="expand"><i class="fa fa-fw fa-cube text-muted hidden-md hidden-sm hidden-xs"></i> ส่วนหัว</th>
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
		<!-- END MAIN CONTENT -->

		<div id="error"></div>

	</div>
	<!-- END MAIN PANEL -->

	<!-- PAGE FOOTER -->
	<?php include 'templates/admin/footer.php'; ?>
	<!-- END PAGE FOOTER -->

	<?php include 'templates/admin/shortcut.php'; ?>
	<!-- END SHORTCUT AREA -->

	<div class="modal" id="modal-save" role="dialog">
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
						<input type="hidden" id="menu_id" name="menu_id">
						<fieldset>
							<div class="row">
								<section class="ph-2">
									<label class="input"> <i class="icon-prepend fa fa-cube"></i>
										<input type="text" maxlength="200" id="menu_title" name="menu_title" placeholder="ชื่อเมนู">
										<b class="tooltip tooltip-top-right"><i class="fa fa-cube txt-color-teal"></i> ชื่อเมนู</b>
									</label>
								</section>
							</div>
							<div class="row">
								<section class="ph-2">
									<label class="input"> <i class="icon-prepend fa fa-link"></i>
										<input type="text" maxlength="200" id="menu_url" name="menu_url" placeholder="URL">
										<b class="tooltip tooltip-top-right"><i class="fa fa-link txt-color-teal"></i> URL</b>
									</label>
								</section>
							</div>
							<div class="row">
								<section class="col col-6 field-page">
									<label class="label"><a id="page" href="javascript:void(0)">หน้า</a> | <a id="load_page" href="javascript:void(0)">โหลดใหม่</a></label>
									<select id="page_id" name="page_id" style="width:100%" class="select2">
										<option value="" selected="">เลือก หน้า</option>
										<?php
										foreach ($list_page as &$row) { ?>
											<option value="<?= $row['page_id'] ?>"><?= $row['page_title'] ?></option>
										<?php	} ?>
									</select> <i></i>
								</section>
								<section class="col col-3">
									<label class="label">ส่วนหัว</label>
									<label class="checkbox"><input type="checkbox" value="1" name="is_head" id="is_head"><i></i></label>
								</section>
								<section class="col col-3">
									<label class="label">แสดง</label>
									<label class="checkbox"><input type="checkbox" value="1" name="is_show" id="is_show"><i></i></label>
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
			var typeModal = ''

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
						"data": "menu_no",
						"render": function(data, type, full, meta) {
							return `<section class="smart-form">
										<label class="input"> 
											<input value="${data}" type="number" min="0" data-id="${full.menu_id}" name="tb_menu_no" placeholder="ลำดับ">
										</label>
									</section>`
						}
					},
					{
						"render": function(data, type, full, meta) {
							var html = `<button name="btnedit" data-id="${full.menu_id}" 
								class="btn btn-xs btn-default"><i class="fas fa-pencil-alt"></i></button>`
							html += `<button name="btnshow" data-value="${full.is_show}" data-id="${full.menu_id}" class="btn btn-xs ${full.is_show == '0' ? 'btn-danger' : 'btn-primary' }">${full.is_show == '0' ? '<i class="fa fa-eye-slash"></i>' : '<i class="fa fa-eye"></i>' }</button>`;
							html += `<button name="btndelete" data-id="${full.menu_id}"
									class="btn btn-xs btn-danger"><i class="fa fa-trash"></i></button>`;
							return html
						}
					},
					{
						"data": "menu_title",
						"render": function(data, type, full, meta) {
							if (full.count_child > 0) {
								return data
							}
							return `${full.page_id ? '' : '<code>(ไม่มีหน้า)</code> '} ${data}`
						}
					},
					{
						"data": "menu_url",
					},
					{
						"data": "is_head",
						"render": function(data, type, full, meta) {
							return `<section class="smart-form">
							<label class="checkbox"><input ${data == 1 ? 'checked' : ''} data-id="${full.menu_id}" value="1"  name="tb_is_head" type="checkbox"><i></i></label>
							</section>`
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
				rules: {
					menu_title: {
						maxlength: 200,
						required: true,
					},
					menu_url: {
						maxlength: 200,
						required: true,
						remote: {
							url: "<?= base_url() ?>adminMenu/check_duplicate",
							type: "get",
							data: {
								action: function() {
									return typeModal;
								},
								id: function() {
									var value = $("#menu_id").val();
									return value;
								},
								col: function() {
									return "menu_url";
								},
								value: function() {
									var value = $("#menu_url").val();
									return value;
								}
							}
						}
					},
				},
				messages: {
					menu_url: {
						remote: 'URL is duplicate.'
					}
				},
				submitHandler: function() {
					var dataForm = $('#save-form').serializeArray();
					if (dataForm.find(x => x.name == 'is_show') == null) {
						dataForm.push({
							name: 'is_show',
							value: 0
						});
					}
					if (dataForm.find(x => x.name == 'is_head') == null) {
						dataForm.push({
							name: 'is_head',
							value: 0
						});
					}
					console.log('dataForm :', dataForm);
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
									save(dataForm)
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

			$('#menu_title').keyup(function() {
				var text = $(this).val().toLowerCase().replace(/[ .]/g, '-').replace(/[^\w\u0E00-\u0E7F-]+/g, '');
				$('#menu_url').val(text)
			})

			function save(dataForm) {
				$.post("<?= base_url() ?>AdminMenu/save", dataForm, function(data) {
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

			$('#btnadd').click(function() {
				typeModal = 'new'
				$('#blah').attr('src', '');
				$('.modal-title').html('เพิ่ม เมนูหลัก')
				$('#menu_id').val('')
				$('#menu_title').val('')
				$('#menu_url').val('')
				$('#is_show').prop('checked', false)
				$('.invalid').remove()
				$('label').removeClass('state-error')
				$('label').removeClass('state-success')
				modalSave.modal('show')
				validator.resetForm();
				validator.reset();
				$('#menu_title').select()
			})

			$(document).on('change', 'input[name=tb_is_head]', function() {
				var id = $(this).data('id')
				var is_head = $(this).prop('checked') ? 1 : 0
				$.post('<?= base_url() ?>AdminMenu/head', {
					id: id,
					is_head: is_head,
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
							timeOut: 1000
						})
					}
				})
			})

			$(document).on('change', 'input[name=tb_menu_no]', function() {
				var id = $(this).data('id')
				var number = $(this).val()
				var dataForm = {
					menu_id: id,
					menu_no: number
				}
				$.post("<?= base_url() ?>AdminMenu/save_no", dataForm, function(data) {
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
				$.post('<?= base_url() ?>AdminMenu/show', {
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
								timeOut: 1000
							})
						} else {
							toastr.success(data.Message, {
								timeOut: 1000
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
								$.post('<?= base_url() ?>AdminMenu/remove', {
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

			$(document).on('click', 'button[name=btnedit]', function() {
				var id = $(this).data('id')
				typeModal = 'edit'
				$.get('<?= base_url() ?>AdminMenu/menu?id=' + id, function(data) {
						if (data.count_child == 0) {
							$('.field-page').css('display', '')
						} else {
							$('.field-page').css('display', 'none')
						}
						$('.modal-title').html(`แก้ไข เมนูหลัก`)
						$('#menu_id').val(data.menu_id)
						$('#menu_title').val(data.menu_title)
						$('#menu_url').val(data.menu_url)
						$('#page_id').val(data.page_id)
						$('#page_id').trigger('change');
						$('#is_show').prop('checked', data.is_show == '1')
						$('#is_head').prop('checked', data.is_head == '1')
						$('.invalid').remove()
						$('label').removeClass('state-error')
						$('label').removeClass('state-success')
						modalSave.modal('show')
						validator.resetForm();
						validator.reset();
						$('#menu_title').select()
					})
					.error(function(error) {
						console.log('error :', error);
						$('#error').html(error.responseText)
					})
			})

			$('#load_page').click(function() {
				$.get('<?= base_url() ?>AdminManageMenu/load_page', function(data) {
					var html = '<option value="" selected="">เลือก หน้า</option>'
					for (var i in data) {
						var item = data[i]
						html += `<option value="${item.page_id}">${item.page_title}</option>`
					}
					$('#page_id').html(html)
					$('#page_id').trigger('change')
				})
			})

			$('#page').click(function() {
				if (!$('#page_id').val()) {
					window.open('<?=base_url('/admin/page/new')?>')
					return
				}
				window.open('<?=base_url('/admin/page/edit/')?>' + $('#page_id').val())
			})

			var loadData = function() {
				var before = $('.widget-icon').html()
				$('.widget-icon').html('<i class="fas fa-sync-alt fa-spin"></i>')
				$.get('<?= base_url() ?>AdminMenu/load_list', function(data) {
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

			////
			$("#file").change(function() {
				if (this.files && this.files[0]) {
					var reader = new FileReader();
					reader.onload = function(e) {
						$('#blah').attr('src', e.target.result);
					}
					reader.readAsDataURL(this.files[0]);
				}
			});
			$(document).on('focus', 'input[name=tb_menu_no]', function() {
				$(this).select()
			})
			$('button[name=btnsave]').click(function() {
				validator.resetForm();
				validator.reset();
				$('#save-form').submit()
			})
		});
	</script>

</body>

</html>
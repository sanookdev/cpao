<!DOCTYPE html>
<html lang="en-us">
<?php
$main_page = "ตั้งค่าเมนู";
$page = "รายการหน้า";
?>

<head>
	<meta charset="utf-8">
	<!--<meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">-->

	<title><?= $page ?> | <?=project_name?></title>
	<meta name="description" content="">
	<meta name="author" content="">

	<meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no">

	<?php include 'templates/admin/style.php'; ?>

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
				<div class="col-xs-12 mb-1">
					<a href="<?=base_url('/admin/page/new')?>" id="btnadd" name="btnadd" class="btn btn-primary">เพิ่มหน้า</a>
				</div>
			</div>
			<!-- widget grid -->
			<section id="widget-grid" class="">

				<!-- row -->
				<div class="row">
					<!-- NEW WIDGET START -->
					<article class="col-xs-12 col-lg-10">

						<!-- Widget ID (each widget will need unique ID)-->
						<div class="jarviswidget jarviswidget-color-darken" id="wid-id-1" data-widget-sortable="false" data-widget-deletebutton="false" data-widget-colorbutton="false" data-widget-editbutton="false">
							<header>
								<span class="widget-icon"> <i class="fa fa-table"></i> </span>
								<h2>รายการหน้า </h2>

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
												<th style="width: 50px;" data-hide="phone">ลำดับ</th>
												<th class="tool-width">จัดการ</th>
												<th data-class="expand"><i class="fa fa-fw fa-cube text-muted hidden-md hidden-sm hidden-xs"></i> หัวข้อ</th>
												<th data-class="expand"><i class="fa fa-fw fa-cube text-muted hidden-md hidden-sm hidden-xs"></i> ประเภท</th>
												<th data-class="expand"><i class="fa fa-fw fa-home text-muted hidden-md hidden-sm hidden-xs"></i> เมนูหลัก</th>
												<th data-class="expand"><i class="fas fa-fw fa-list-alt text-muted hidden-md hidden-sm hidden-xs"></i> เมนูย่อย</th>
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
						<input type="hidden" id="page_id" name="page_id">
						<fieldset>
							<div class="row">
								<section class="ph-2">
									<label class="label">ชื่อเมนูย่อย</label>
									<label class="input"> <i class="icon-prepend fa fa-cube"></i>
										<input type="text" id="page_title" name="page_title" placeholder="">
										<b class="tooltip tooltip-top-right"><i class="fas fa-fw fa-cube txt-color-teal"></i> ชื่อเมนูย่อย</b>
									</label>
								</section>
							</div>
							<div class="row">
								<section class="col col-6">
									<label class="checkbox"><input type="checkbox" value="1" name="is_show" id="is_show"><i></i>แสดง</label>
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
				pageLength: 25,
				"sDom": "<'dt-toolbar'<'col-xs-12 col-sm-6'f><'col-sm-6 col-xs-12 hidden-xs'l>r>" +
					"t" +
					"<'dt-toolbar-footer'<'col-sm-6 col-xs-12 hidden-xs'i><'col-xs-12 col-sm-6'p>>",
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
							var html = `<button name="btnedit" data-pageid="${full.parent_id}" data-id="${full.page_id}" 
								class="btn btn-xs btn-default"><i class="fas fa-pencil-alt"></i></button>`
							html += `<a href="<?=base_url('/admin/page/edit')?>/${full.page_id}" data-id="${full.page_id}" 
								class="btn btn-xs btn-warning"><i class="fas fa-external-link-alt"></i></a>`
							html += `<button name="btnshow" data-value="${full.is_show}" data-pageid="${full.parent_id}" 
									data-id="${full.page_id}" class="btn btn-xs ${full.is_show == '0' ? 'btn-danger' : 'btn-primary' }">${full.is_show == '0' ? '<i class="fa fa-eye-slash"></i>' : '<i class="fa fa-eye"></i>' }</button>`;
							html += `<button name="btndelete" data-id="${full.page_id}" data-pageid="${full.parent_id}" 
									class="btn btn-xs btn-danger"><i class="fa fa-trash"></i></button>`;
							return html
						}
					},
					{
						"data": "page_title"
					},
					{
						"data": "page_type"
					},
					{
						"data": "parent_menu_title"
					},
					{
						"data": "menu_title"
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
					page_title: {
						required: true,
					},
					parent_id: {
						required: true,
					},
					menu_id: {
						maxlength: 200,
						required: true,
						remote: {
							url: "<?= base_url() ?>AdminManagePage/menu_is_empty",
							type: "get",
							data: {
								action: function() {
									return typeModal;
								},
								page_id: function() {
									var value = $("#page_id").val();
									return value;
								},
								menu_id: function() {
									var value = $("#menu_id").val();
									return value;
								}
							}
						}
					},
				},

				// Messages for form validation
				messages: {
					menu_id: {
						remote: 'เมนูย่อยนี้ มีข้อมูลหน้าอยู่แล้ว'
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
					if ($('.field-menu').css('display') == 'none') {
						dataForm.push({
							name: 'menu_id',
							value: $('#parent_id').val()
						})
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
									$.post("<?= base_url() ?>AdminManagePage/save", dataForm, function(data) {
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

			$('#page_title').keyup(function() {
				var text = $(this).val().toLowerCase().replace(/[ .]/g, '-').replace(/[^\w\u0E00-\u0E7F-]+/g, '');
				$('#page_url').val(text)
			})

			$(document).on('click', 'button[name=btnshow]', function() {
				var id = $(this).data('id')
				var pageid = $(this).data('pageid')
				var value = $(this).data('value') == '0' ? '1' : '0'
				var text = value == '0' ? 'ซ่อน' : 'แสดง'
				$.post('<?= base_url() ?>AdminManagePage/show', {
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
						loadData(pageid)
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
				var pageid = $(this).data('pageid')
				var id = $(this).data('id')
				$.confirm({
					title: 'กรุณายืนยันการลบข้อมูล!',
					content: 'ต้องการลบข่าวนี้หรือไม่?',
					backgroundDismiss: true,
					buttons: {
						confirm: {
							btnClass: 'btn-red',
							action: function() {
								$.post('<?= base_url() ?>AdminManagePage/remove', {
									id: id
								}, function(data) {
									if (data.isError && data.Message) {
										$.alert({
											title: 'Warning!',
											type: 'red',
											content: data.Message,
										});
									} else {
										loadData(pageid)
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
				$('#blah').attr('src', '');
				$('.modal-title').html('เพิ่มเมนูย่อย')
				$('#page_id').val('')
				$('#page_title').val('')
				$('#page_url').val('')
				$('#is_show').prop('checked', false)
				$('.invalid').remove()
				$('label').removeClass('state-error')
				$('label').removeClass('state-success')
				modalSave.modal('show')
				validator.resetForm();
				validator.reset();
				$('#page_title').select()
			})

			$(document).on('focus', 'input[name=tb_page_no]', function() {
				$(this).select()
			})

			$(document).on('click', 'button[name=btnedit]', function() {
				var id = $(this).data('id')
				typeModal = 'edit'
				$.get('<?= base_url() ?>AdminManagePage/page?id=' + id, function(data) {
						$('#page_id').val(data.page_id)
						$('#page_title').val(data.page_title)
						$('#page_url').val(data.page_url)
						$('#parent_id').val(data.parent_id)
						$('#is_show').prop('checked', data.is_show == '1')
						$('.invalid').remove()
						$('label').removeClass('state-error')
						$('label').removeClass('state-success')
						$.get('<?= base_url() ?>AdminManagePage/load_submenu?id=' + data.parent_id, function(menu) {
							if (menu.length == 0) {
								$('.field-menu').css('display', 'none')
								return
							}
							$('.field-menu').css('display', '')
							var html = '<option disabled="" selected="">เลือก เมนูย่อย</option>'
							for (var i in menu) {
								var item = menu[i]
								if (item.page_id) {
									html += `<option value="${item.menu_id}">${item.menu_title} (1)</option>`
								} else {
									html += `<option value="${item.menu_id}">${item.menu_title}</option>`
								}
							}
							$('#menu_id').html(html)
							$('#menu_id').val(data.menu_id)
						})
						modalSave.modal('show')
						validator.resetForm();
						validator.reset();
						$('#page_title').select()
					})
					.error(function(error) {
						console.log('error :', error);
						$('#error').html(error.responseText)
					})

			})

			$('#parent_id').change(function() {
				var id = $(this).val()
				$.get('<?= base_url() ?>AdminManagePage/load_submenu_empty?id=' + id, function(data) {
					if (data.length == 0) {
						$('.field-menu').css('display', 'none')
						return
					}
					$('.field-menu').css('display', '')
					var html = '<option disabled="" selected="">เลือก เมนูย่อย</option>'
					for (var i in data) {
						var item = data[i]
						if (item.page_id) {
							html += `<option value="${item.menu_id}">${item.menu_title} (1)</option>`
						} else {
							html += `<option value="${item.menu_id}">${item.menu_title}</option>`
						}
					}
					$('#menu_id').html(html)
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
				$.get('<?= base_url() ?>AdminManagePage/load_list', function(data) {
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
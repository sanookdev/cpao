<!DOCTYPE html>
<html lang="en-us">
<?php
$main_page = "ตั้งค่าเมนู";
$page = "รายการเมนูย่อย 2";
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
					<button id="btnadd" name="btnadd" class="btn btn-primary">เพิ่มเมนูย่อย 2</button>
				</div>
			</div>
			<!-- widget grid -->
			<section id="widget-grid" class="">

				<!-- row -->
				<div class="row">
					<!-- NEW WIDGET START -->
					<article class="col-xs-12 col-md-12 col-lg-12">

						<!-- Widget ID (each widget will need unique ID)-->
						<div class="jarviswidget jarviswidget-color-darken" id="wid-id-1" data-widget-sortable="false" data-widget-deletebutton="false" data-widget-colorbutton="false" data-widget-editbutton="false">
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

									<table id="table" name="page" class="table table-striped table-bordered table-hover" width="100%">
										<thead>
											<tr>
												<th style="width: 50px;" data-hide="phone">ลำดับ</th>
												<th class="tool-width-3">จัดการ</th>
												<th data-class="expand"><i class="fa fa-fw fa-cube text-muted hidden-md hidden-sm hidden-xs"></i> หัวข้อ</th>
												<th class="col-lg-2" data-class="expand"><i class="fa fa-fw fa-home text-muted hidden-md hidden-sm hidden-xs"></i> เมนูหลัก</th>
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
						<input type="hidden" id="menu_id" name="menu_id">
						<fieldset>
							<div class="row">
								<section class="ph-2">
									<label class="label">ชื่อเมนูย่อย 2</label>
									<label class="input"> <i class="icon-prepend fa fa-cube"></i>
										<input type="text" id="menu_title" name="menu_title" placeholder="">
										<b class="tooltip tooltip-top-right"><i class="fas fa-fw fa-cube txt-color-teal"></i> ชื่อเมนูย่อย</b>
									</label>
								</section>
							</div>
							<div class="row">
								<section class="ph-2">
									<label class="label">URL</label>
									<label class="input"> <i class="icon-prepend fas fa-link"></i>
										<input type="text" maxlength="200" id="menu_url" name="menu_url" placeholder="">
										<b class="tooltip tooltip-top-right"><i class="fas fa-link txt-color-teal"></i> URL</b>
									</label>
								</section>
							</div>
							<div class="row">
								<section class="col col-6">
									<label class="label">เมนูหลัก</label>
									<label class="select">
										<select id="_parent_id">
											<option disabled="" selected>เลือก เมนูหลัก</option>
											<?php
											foreach ($list_menu as &$row) { ?>
												<option value="<?= $row['menu_id'] ?>"><?= $row['menu_title'] ?></option>
											<?php	} ?>
										</select> <i></i>
									</label>
								</section>
								<section class="col col-6">
									<label class="label">เมนูย่อย</label>
									<label class="select">
										<select id="parent_id" name="parent_id">
											<option disabled="" selected="">เลือก เมนูย่อย</option>
										</select> <i></i>
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
						"data": "menu_no",
						className: 'dt-body-center',
						"render": function(data, type, full, meta) {
							return `<section class="smart-form">
										<label class="input"> 
											<input value="${data}" type="number" data-menuid="${full.parent_id}" min="0" data-id="${full.menu_id}" name="tb_menu_no" placeholder="ลำดับ">
										</label>
									</section>`
						}
					},
					{
						"render": function(data, type, full, meta) {
							var html = `<button name="btnedit" data-id="${full.menu_id}" 
								class="btn btn-xs btn-default"><i class="fas fa-pencil-alt"></i></button>`
							html += `<button name="btnshow" data-value="${full.is_show}"
									data-id="${full.menu_id}" class="btn btn-xs ${full.is_show == '0' ? 'btn-danger' : 'btn-primary' }">${full.is_show == '0' ? '<i class="fa fa-eye-slash"></i>' : '<i class="fa fa-eye"></i>' }</button>`;
							html += `<button name="btndelete" data-id="${full.menu_id}"
									class="btn btn-xs btn-danger"><i class="fa fa-trash"></i></button>`;
							return html
						}
					},
					{
						"data": "menu_title"
					},
					{
						"data": "parent_menu_title",
						className: 'dt-body-center'
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
				var dataForm = $('#save-form').serializeArray();
				if (dataForm.find(x => x.name == 'is_show') == null) {
					dataForm.push({
						name: 'is_show',
						value: 0
					});
				}
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
					menu_title: {
						maxlength: 250,
						required: true,
					},
					parent_id: {
						required: true,
					},
					_parent_id: {
						required: true,
					},
					menu_url: {
						maxlength: 250,
						required: true,
						remote: {
							url: "<?= base_url() ?>adminMenu/check_duplicate2",
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

				// Messages for form validation
				messages: {
					menu_url: {
						remote: 'URL is duplicate!'
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
									$.post("<?= base_url() ?>AdminManageMenu/save", dataForm, function(data) {
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

			$('#menu_title').keyup(function() {
				var text = $(this).val().toLowerCase().replace(/[ .]/g, '-').replace(/[^\w\u0E00-\u0E7F-]+/g, '');
				$('#menu_url').val(text)
			})

			$(document).on('change', 'input[name=tb_menu_no]', function() {
				var id = $(this).data('id')
				var parent_id = $(this).data('menuid')
				var number = $(this).val()
				var dataForm = {
					menu_id: id,
					menu_no: number,
					parent_id: parent_id,
				}
				$.post("<?= base_url() ?>AdminManageMenu/save_no", dataForm, function(data) {
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
				$.post('<?= base_url() ?>AdminManageMenu/show', {
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
					content: 'ต้องการลบข่าวนี้หรือไม่?',
					backgroundDismiss: true,
					buttons: {
						confirm: {
							btnClass: 'btn-red',
							action: function() {
								$.post('<?= base_url() ?>AdminManageMenu/remove', {
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
				$('.modal-title').html('เพิ่มเมนูย่อย 2')
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

			$(document).on('focus', 'input[name=tb_page_no]', function() {
				$(this).select()
			})

			$(document).on('click', 'button[name=btnedit]', function() {
				var id = $(this).data('id')
				typeModal = 'edit'
				$('.modal-title').html('แก้ไขเมนูย่อย 2')
				$.get('<?= base_url() ?>AdminManageMenu/menu?id=' + id, function(data) {
						$('#menu_id').val(data.menu_id)
						$('#menu_title').val(data.menu_title)
						$('#menu_url').val(data.menu_url)
						$('#_parent_id').val(data.parent_parent_id)
						$('#is_show').prop('checked', data.is_show == '1')
						$('.invalid').remove()
						$('label').removeClass('state-error')
						$('label').removeClass('state-success')
						$.get('<?= base_url() ?>AdminManageMenu/load_list_submenu?id=' + data.parent_parent_id, function(menu) {
							var html = '<option disabled="" selected="">เลือก เมนูย่อย</option>'
							for (var i in menu) {
								var item = menu[i]
								if (item.page_id) {
									html += `<option value="${item.menu_id}">${item.menu_title} (1)</option>`
								} else {
									html += `<option value="${item.menu_id}">${item.menu_title}</option>`
								}
							}
							$('#parent_id').html(html)
							$('#parent_id').val(data.parent_id)
						})
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

			$('#_parent_id').change(function() {
				var id = $(this).val()
				$.get('<?= base_url() ?>AdminManageMenu/load_list_submenu?id=' + id, function(data) {
					var html = '<option disabled="" selected="">เลือก เมนูย่อย</option>'
					for (var i in data) {
						var item = data[i]
						html += `<option value="${item.menu_id}">${item.menu_title}</option>`
					}
					$('#parent_id').html(html)
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
				$.get('<?= base_url() ?>AdminManageMenu/load_list_submenu2', function(data) {
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
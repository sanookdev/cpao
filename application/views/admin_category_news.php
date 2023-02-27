<!DOCTYPE html>
<html lang="en-us">

<head>
	<meta charset="utf-8">
	<!--<meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">-->

	<title>จัดการประเภทข่าว | <?= project_name ?></title>
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
				<li>จัดการผู้ใช้</li>
				<li>รายการข้อมูลผู้ใช้</li>
			</ol>
			<!-- end breadcrumb -->

		</div>
		<!-- END RIBBON -->

		<!-- MAIN CONTENT -->
		<div id="content">
			<div class="row">
				<div class="col-xs-12 col-sm-7 col-md-7 col-lg-4">
					<h1 class="page-title txt-color-blueDark">
						<i class="fa fa-cube fa-fw "></i>
						ประเภทข่าว
						<span>>
							รายการข้อมูลประเภทข่าว
						</span>
					</h1>
				</div>
			</div>
			<div class="row">
				<div class="col-xs-12 mb-1">
					<button id="btnadd" class="btn btn-primary">เพิ่มประเภทข่าว</button>
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
								<h2>รายการข้อมูลประเภทข่าว </h2>

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
												<th style="width: 50px;" data-hide="phone">ลำดับ</th>
												<th class="tool-width-3">จัดการ</th>
												<th data-class="expand"><i class="fa fa-fw fa-cube text-muted hidden-md hidden-sm hidden-xs"></i> ชื่อประเภทข่าว</th>
												<th data-class="expand"><i class="fa fa-fw fa-cube text-muted hidden-md hidden-sm hidden-xs"></i> URL</th>
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
					<h5 class="modal-title">แก้ไขข้อมูลประเภทข่าว</h5>
					<button type="button" class="close" data-dismiss="modal" aria-label="Close">
						<span aria-hidden="true">&times;</span>
					</button>
				</div>
				<div class="modal-body" style="padding-top: 0px;">
					<form id="save-form" class="smart-form">
						<input type="hidden" id="category_id" name="category_id">
						<fieldset>
							<div class="row">
								<section class="ph-2">
									<label class="input"> <i class="icon-prepend fa fa-cube"></i>
										<input type="text" id="category_name" name="category_name" placeholder="ชื่อประเภทข่าว">
										<b class="tooltip tooltip-top-right"><i class="fa fa-cube txt-color-teal"></i> ชื่อประเภทข่าว</b>
									</label>
								</section>
							</div>
							<div class="row">
								<section class="ph-2">
									<label class="input"> <i class="icon-prepend fa fa-cube"></i>
										<input type="text" id="category_url" name="category_url" placeholder="URL">
										<b class="tooltip tooltip-top-right"><i class="fa fa-cube txt-color-teal"></i> URL</b>
									</label>
								</section>
							</div>
							<div class="row">
								<section class="ph-2">
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
						"data": "category_no",
						"render": function(data, type, full, meta) {
							return `<section class="smart-form">
										<label class="input"> 
											<input value="${data}" type="number" min="0" data-id="${full.category_id}" name="tb_category_no" placeholder="ลำดับ">
										</label>
									</section>`
						}
					},
					{
						"render": function(data, type, full, meta) {
							var html = `<button name="btnedit" data-id="${full.category_id}" 
								class="btn btn-xs btn-default"><i class="fas fa-pencil-alt"></i></button>`
							html += `<button name="btnshow" data-value="${full.is_show}" data-id="${full.category_id}" class="btn btn-xs ${full.is_show == '0' ? 'btn-danger' : 'btn-primary' }">${full.is_show == '0' ? '<i class="fa fa-eye-slash"></i>' : '<i class="fa fa-eye"></i>' }</button>`;
							if (full.is_lock == '0') {
								html += `<button name="btndelete" data-id="${full.category_id}" class="btn btn-xs btn-danger"><i class="fa fa-trash"></i></button>`;
							}
							return html
						}
					},
					{
						"data": "category_name",
						"render": function(data, type, full, meta) {
							return `${data} <button class="btn btn-xs copy" data-clipboard-text="/cpao/cate/${full.category_url}">copy link</button>`
						}
					},
					{
						"data": "category_url"
					},

				],
				"autoWidth": true,
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
					category_name: {
						required: true,
					},
				},

				// Messages for form validation
				messages: {},

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
									$.post("<?= base_url() ?>AdminCategoryNews/save", dataForm, function(data) {
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

			$(document).on('focus', 'input[name=tb_category_no]', function() {
				$(this).select()
			})

			$(document).on('change', 'input[name=tb_category_no]', function() {
				var id = $(this).data('id')
				var number = $(this).val()
				var dataForm = {
					category_id: id,
					category_no: number
				}
				$.post("<?= base_url() ?>AdminCategoryNews/save_no", dataForm, function(data) {
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
				$.post('<?= base_url() ?>AdminCategoryNews/show', {
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
								$.post('<?= base_url() ?>AdminCategoryNews/remove', {
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
				$('.modal-title').html('เพิ่มประเภทข่าว')
				$('#category_id').val('')
				$('#category_name').val('')
				$('#is_show').prop('checked', false)
				$('.invalid').remove()
				$('label').removeClass('state-error')
				$('label').removeClass('state-success')
				modalSave.modal('show')
				$('#category_name').select()
			})

			$(document).on('click', 'button[name=btnedit]', function() {
				var id = $(this).data('id')
				$.get('<?= base_url() ?>AdminCategoryNews/category_news?id=' + id, function(data) {
						$('#category_id').val(data.category_id)
						$('#category_name').val(data.category_name)
						$('#category_url').val(data.category_url)
						$('#is_show').prop('checked', data.is_show == '1')
						$('.invalid').remove()
						$('label').removeClass('state-error')
						$('label').removeClass('state-success')
						modalSave.modal('show')
						$('#category_name').select()
					})
					.error(function(error) {
						console.log('error :', error);
						$('#error').html(error.responseText)
					})
			})

			$('#category_name').keyup(function() {
				var text = $(this).val().toLowerCase().replace(/[ .]/g, '-').replace(/[^\w\u0E00-\u0E7F-]+/g, '');
				$('#category_url').val(text)
			})

			var loadData = function() {
				var before = $('.widget-icon').html()
				$('.widget-icon').html('<i class="fas fa-sync-alt fa-spin"></i>')
				$.get('<?= base_url() ?>AdminCategoryNews/load_list', function(data) {
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
			var clipboard = new ClipboardJS('.btn');

			clipboard.on('success', function(e) {
				e.clearSelection();
			});

			clipboard.on('error', function(e) {
			});
		});
	</script>

</body>

</html>
<!DOCTYPE html>
<html lang="en-us">

<head>
	<meta charset="utf-8">
	<!--<meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">-->

	<title>รายการ RSS | <?=project_name?></title>
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
				<li>จัดการข่าว & RSS</li>
				<li>รายการ RSS</li>
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
							รายการ RSS
						</span>
					</h1>
				</div>
			</div>
			<div class="row">
				<div class="col-xs-12 mb-1">
					<a href="<?=base_url('/admin/news/new')?>" class="btn btn-primary">เพิ่มข่าว & RSS</a>
				</div>
			</div>
			<!-- widget grid -->
			<section id="widget-grid" class="">

				<!-- row -->
				<div class="row">
					<?php
					foreach ($list_cate as &$row) { ?>

						<!-- NEW WIDGET START -->
						<article class="col-xs-12 col-sm-6 col-md-6 col-lg-6">

							<!-- Widget ID (each widget will need unique ID)-->
							<div class="jarviswidget jarviswidget-color-darken" id="wid-id-<?= $row['category_id'] ?>" data-widget-sortable="false" data-widget-deletebutton="false" data-widget-colorbutton="false" data-widget-editbutton="false">
								<header>
									<span class="widget-icon <?= $row['category_id'] ?>"> <i class="fa fa-table"></i> </span>
									<h2><?= $row['category_name'] ?> </h2>

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

										<table id="table<?= $row['category_id'] ?>" name="news" data-id="<?= $row['category_id'] ?>" class="table table-striped table-bordered table-hover" width="100%">
											<thead>
												<tr>
													<th style="width: 20px;" data-hide="phone">ลำดับ</th>
													<th class="tool-width">จัดการ</th>
													<th data-class="expand"><i class="fa fa-fw fa-cube text-muted hidden-md hidden-sm hidden-xs"></i> ชื่อข่าว</th>
													<th style="width: 90px;" data-class="expand"><i class="fa fa-fw fa-calendar text-muted hidden-md hidden-sm hidden-xs"></i> วันที่เผยแพร่</th>
												</tr>
											</thead>
											<tbody>
											</tbody>
										</table>
									</div>
								</div>
							</div>
						</article>
					<?php	}
					?>
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
					<h5 class="modal-title">แก้ไขข้อมูลข่าว</h5>
					<button type="button" class="close" data-dismiss="modal" aria-label="Close">
						<span aria-hidden="true">&times;</span>
					</button>
				</div>
				<div class="modal-body" style="padding-top: 0px;">
					<form id="save-form" class="smart-form">
						<input type="hidden" id="news_id" name="news_id">
						<input type="hidden" id="news_url" name="news_url" placeholder="">
						<fieldset>
							<div class="row">
								<section class="col col-8">
									<label class="label">ชื่อข่าว</label>
									<label class="input"> <i class="icon-prepend fa fa-cube"></i>
										<input type="text" id="news_title" name="news_title" placeholder="">
										<b class="tooltip tooltip-top-right"><i class="fa fa-cube txt-color-teal"></i> ชื่อข่าว</b>
									</label>
								</section>
								<section class="col col-4">
									<label class="label">ประเภทข่าว</label>
									<label class="select">
										<select id="category_id" name="category_id">
											<option disabled="" selected="">ประเภทข่าว</option>
											<?php
											foreach ($list_cate as &$row) { ?>
												<option value="<?= $row['category_id'] ?>"><?= $row['category_name'] ?></option>
											<?php	} ?>
										</select> <i></i>
									</label>
								</section>
							</div>
							<div class="row">
								<section class="col col-6">
									<label class="label">กำหนดเผยแพร่วันที่</label>
									<label class="input"> <i class="icon-prepend fa fa-calendar"></i>
										<input type="text" id="public_date" name="public_date" placeholder="กำหนดเผยแพร่วันที่">
										<b class="tooltip tooltip-top-right"><i class="fa fa-cube txt-color-teal"></i> กำหนดเผยแพร่วันที่</b>
									</label>
								</section>
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

	<!--================================================== -->

	<?php include 'templates/admin/script.php'; ?>

	<script>
		$(document).ready(function() {
			// DO NOT REMOVE : GLOBAL FUNCTIONS!
			pageSetUp();

			var responsiveHelper_dt_basic = [];
			var breakpointDefinition = {
				tablet: 1024,
				phone: 480
			};
			var cate_id = 0

			var modalSave = $('#modal-save')
			var table = []
			$("#public_date").datepicker({
				container: '#save-form',
				language: 'th',
				autoclose: true,
				format: 'dd/mm/yyyy',
			}).datepicker("setDate", new Date());

			$("table[name=news]").each(function(index) {
				var id = $(this).data('id')
				var tb = $(this).DataTable({
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
								var html = `<button name="btnedit" data-cateid="${full.category_id}" data-id="${full.news_id}" 
								class="btn btn-xs btn-default"><i class="fas fa-pencil-alt"></i></button>`
								html += `<a href="<?=base_url('/admin/news/edit/')?>${full.news_id}" data-cateid="${full.category_id}" data-id="${full.news_id}" 
								class="btn btn-xs btn-warning"><i class="fas fa-external-link-alt"></i></a>`
								html += `<button name="btnshow" data-value="${full.is_show}" data-cateid="${full.category_id}" 
									data-id="${full.news_id}" class="btn btn-xs ${full.is_show == '0' ? 'btn-danger' : 'btn-primary' }">${full.is_show == '0' ? '<i class="fa fa-eye-slash"></i>' : '<i class="fa fa-eye"></i>' }</button>`;
								html += `<button name="btndelete" data-id="${full.news_id}" data-cateid="${full.category_id}" 
									class="btn btn-xs btn-danger"><i class="fa fa-trash"></i></button>`;
								return html
							}
						},

						{
							"data": "news_title"
						},
						{
							"data": "public_date",
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
				table[id] = tb
			});

			$('button[name=btnsave]').click(function() {
				$('#news_url').val($('#news_title').val().toLowerCase().replace(/[ .]/g, '-').replace(/[^\w\u0E00-\u0E7F-]+/g, ''))
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
					news_title: {
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
									$.post("<?= base_url() ?>AdminNews/save", dataForm, function(data) {
											if (data.isError && data.Message) {
												$.alert({
													title: 'Warning!',
													type: 'red',
													content: data.Message,
												});
											} else {
												loadData(cate_id)
												loadData($('#category_id').val())
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

			$(document).on('click', 'button[name=btnshow]', function() {
				var id = $(this).data('id')
				var cateid = $(this).data('cateid')
				var value = $(this).data('value') == '0' ? '1' : '0'
				var text = value == '0' ? 'ซ่อน' : 'แสดง'
				$.post('<?= base_url() ?>AdminNews/show', {
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
						loadData(cateid)
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
				var cateid = $(this).data('cateid')
				var id = $(this).data('id')
				$.confirm({
					title: 'กรุณายืนยันการลบข้อมูล!',
					content: 'ต้องการลบข่าวนี้หรือไม่?',
					backgroundDismiss: true,
					buttons: {
						confirm: {
							btnClass: 'btn-red',
							action: function() {
								$.post('<?= base_url() ?>AdminNews/remove', {
									id: id
								}, function(data) {
									if (data.isError && data.Message) {
										$.alert({
											title: 'Warning!',
											type: 'red',
											content: data.Message,
										});
									} else {
										loadData(cateid)
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
				$.get('<?= base_url() ?>AdminNews/news?id=' + id, function(data) {
						cate_id = data.category_id
						$('#news_id').val(data.news_id)
						$('#news_title').val(data.news_title)
						$('#category_id').val(data.category_id)
						$('#is_show').prop('checked', data.is_show == '1')
						$("#public_date").datepicker("setDate", data.public_date);
						$('.invalid').remove()
						$('label').removeClass('state-error')
						$('label').removeClass('state-success')
						modalSave.modal('show')
						$('#news_title').select()
					})
					.error(function(error) {
						console.log('error :', error);
						$('#error').html(error.responseText)
					})

			})

			var loadData = function(cate_id) {
				var before = $('.widget-icon.' + cate_id).html()
				$('.widget-icon.' + cate_id).html('<i class="fas fa-sync-alt fa-spin"></i>')
				$.get('<?= base_url() ?>AdminNews/load_list?category_id=' + cate_id, function(data) {
					if (table[cate_id]) {
						table[cate_id].clear().draw();
						table[cate_id].rows.add(data); // Add new data
						table[cate_id].columns.adjust().draw(); // Redraw the DataTable
					}
					$('.widget-icon.' + cate_id).html(before)
				}).error(function(error) {
					console.log('error :', error);
					// $('#error').html(error.responseText)
				})
			}
			for (var id in table) {
				loadData(id)
			}

		});
	</script>

</body>

</html>
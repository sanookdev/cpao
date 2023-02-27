<!DOCTYPE html>
<html lang="en-us">

<head>
  <meta charset="utf-8">
  <!--<meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">-->

  <title>แก้ไขข่าว | <?= project_name ?></title>
  <meta name="description" content="">
  <meta name="author" content="">

  <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no">

  <?php include 'templates/admin/style.php'; ?>
  <link href="<?= base_url('/assets/elFinder/css/elfinder.min.css') ?>" media="all" rel="stylesheet" type="text/css" />
  <link href="<?= base_url('/assets/elFinder/css/theme.css') ?>" media="all" rel="stylesheet" type="text/css" />
  <link href="<?= base_url('/_admin/css/bootstrap-fileinput/fileinput.min.css') ?>" media="all" rel="stylesheet" type="text/css" />
  <link href="<?= base_url('/_admin/css/bootstrap-fileinput/themes/explorer-fas/theme.css') ?>" media="all" rel="stylesheet" type="text/css" />

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
        <li>จัดการข่าว</li>
        <li>แก้ไขข่าว</li>
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
            จัดการข่าว
            <span>>
              แก้ไขข่าว
            </span>
          </h1>
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
                <h2>แก้ไขข่าว</h2>

              </header>
              <!-- widget div-->
              <div>
                <!-- widget edit box -->
                <div class="jarviswidget-editbox">
                  <!-- This area used as dropdown edit box -->
                </div>
                <!-- end widget edit box -->
                <!-- widget content -->
                <div class="widget-body">
                  <form id="save-form" method="post" class="smart-form">
                    <input type="hidden" id="news_id" value="<?= $item['news_id'] ?>" name="news_id">
                    <input type="hidden" id="news_cover" value="<?= $item['news_cover'] ?>" name="news_cover">
                    <input type="hidden" id="news_url" name="news_url" placeholder="">
                    <fieldset>
                      <div class="row">
                        <section class="col col-6">
                          <label class="label">ชื่อข่าว</label>
                          <label class="input"> <i class="icon-prepend fa fa-cube"></i>
                            <input type="text" value="<?= $item['news_title'] ?>" id="news_title" name="news_title" placeholder="">
                            <b class="tooltip tooltip-top-right"><i class="fa fa-cube txt-color-teal"></i> ชื่อข่าว</b>
                          </label>
                        </section>
                        <section class="col col-3">
                          <label class="label">ประเภทข่าว</label>
                          <label class="select">
                            <select id="category_id" name="category_id">
                              <option disabled="" selected="">เลือก ประเภทข่าว</option>
                              <?php
                              foreach ($list_cate as &$row) { ?>
                                <option value="<?= $row['category_id'] ?>"><?= $row['category_name'] ?></option>
                              <?php  } ?>
                            </select> <i></i>
                          </label>
                        </section>
                        <section class="col col-3">
                          <label class="label">กำหนดเผยแพร่วันที่</label>
                          <label class="input"> <i class="icon-prepend fa fa-calendar"></i>
                            <input type="text" id="public_date" name="public_date" placeholder="กำหนดเผยแพร่วันที่">
                            <b class="tooltip tooltip-top-right"><i class="fa fa-cube txt-color-teal"></i> กำหนดเผยแพร่วันที่</b>
                          </label>
                        </section>
                      </div>
                      <div class="row">
                        <section class="col col-3">
                          <label class="label">รูปแบบการแสดง</label>
                          <label class="select">
                            <select id="news_type" name="news_type">
                              <option disabled="">เลือก รูปแบบการแสดง</option>
                              <option value="normal" selected>เนื้อหา</option>
                              <option value="link">Link</option>
                            </select> <i></i>
                          </label>
                        </section>
                        <section class="col col-2">
                          <label class="label">แสดง</label>
                          <label class="checkbox"><input <?= $item['is_show'] == '1' ? 'checked' : '' ?> type="checkbox" value="1" name="is_show" id="is_show"><i></i>แสดง</label>
                        </section>
                      </div>
                      <div class="row">
                        <section class="col col-6 field-link">
                          <label class="label">Link *</label>
                          <label class="input"> <i class="icon-prepend fa fa-cube"></i>
                            <input type="text" value="<?= $item['news_type'] == 'link' ? $item['news_detail'] : '' ?>" id="link" name="link" placeholder="eg  http://www...">
                            <b class="tooltip tooltip-top-right"><i class="fa fa-cube txt-color-teal"></i> Link</b>
                          </label>
                        </section>
                      </div>
                      <div class="row field-normal">
                        <section class="col col-6">
                          <h3 class="mb-1">รูปหน้าปก</h3>
                          <div class="dropzone" id="mydropzone"></div>
                        </section>
                      </div>
                      <div class="row field-normal">
                        <div class="ph-2 mb-1">
                          <h3 class="mb-1">รายละเอียดข่าว</h3>
                          <textarea name="news_detail" id="news_detail" style="display: none;"></textarea>
                          <div class="summernote"><?= $item['news_detail'] ?></div>
                        </div>
                      </div>
                      <div class="row field-normal">
                        <section class="ph-2">
                          <h3 class="mb-1 mt-1">แนบไฟล์ </h3>
                          <div id="error-attachment"></div>
                          <button id="addrow" type="button" style="padding: 6px 12px" class="btn btn-primary mb-1">เพิ่มแถว</button>
                          <table id="table-attachment" class="table table-hover">
                            <thead>
                              <th style="width: 70px;">ลำดับ</th>
                              <th class="tool-width-3">จัดการ</th>
                              <th style="max-width: 400px;">หัวข้อ</th>
                              <th>ไฟล์</th>
                            </thead>
                            <tbody>
                            </tbody>
                          </table>
                          <div class="attachment">
                            <?php
                            $i = 0;
                            foreach ($list_attachment as $row) {
                              echo '<input data-index="' . $i . '" style="display: none;" id="attachment-' . $i . '" name="attachment[]" type="file" />';
                              $i += 1;
                            }
                            ?>
                          </div>
                        </section>
                      </div>
                      <div class="row field-normal">
                        <section class="ph-2">
                          <h3 class="mb-1 mt-1">รูป</h3>
                          <input id="images" name="images[]" type="file" multiple />
                        </section>
                      </div>
                    </fieldset>
                    <footer>
                      <button type="submit" style="display: none" class="btn btn-primary">Save changes</button>
                      <button name="btnsave" type="button" class="btn btn-primary">Save changes</button>
                    </footer>
                  </form>
                </div>
              </div>
            </div>
          </article>
        </div>
      </section>
    </div>
    <div class="modal" id="modal-find" tabindex="-1" role="dialog">
      <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
          <div class="modal-header">
            <h5 class="modal-title">เลือกไฟล์จากประวัติ</h5>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
              <span aria-hidden="true">&times;</span>
            </button>
          </div>
          <div class="modal-body" style="padding-top: 0px;">
            <input type="hidden" id="page_id" name="page_id">
            <fieldset>
              <div class="row">
                <table id="table" class="table mt-3" width="100%">
                  <thead>
                    <tr>
                      <th>เลือก</th>
                      <th data-class="expand"><i class="fa fa-fw fa-cube text-muted hidden-md hidden-sm hidden-xs"></i> ข่าว</th>
                      <th data-class="expand"><i class="fa fa-fw fa-cube text-muted hidden-md hidden-sm hidden-xs"></i> ไฟล์</th>
                      <th data-class="expand"><i class="fa fa-fw fa-home text-muted hidden-md hidden-sm hidden-xs"></i> ชื่อไฟล์</th>
                    </tr>
                  </thead>
                  <tbody>
                  </tbody>
                </table>
              </div>
            </fieldset>
          </div>
          <div class="modal-footer">
            <button name="btn_save_select" type="button" class="btn btn-primary">Select</button>
            <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
          </div>
        </div>
      </div>
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
  <script src="<?= base_url('/assets/elFinder/js/elfinder.min.js') ?>"></script>
  <script src="<?= base_url('/_admin/js/summernote-ext-elfinder.js') ?>"></script>
  <script src="<?= base_url('/_admin/js/plugin/dropzone/dropzone.min.js') ?>"></script>

  <script src="<?= base_url('/_admin/js/plugin/bootstrap-fileinput/piexif.min.js') ?>" type="text/javascript"></script>
  <script src="<?= base_url('/_admin/js/plugin/bootstrap-fileinput/sortable.min.js') ?>" type="text/javascript"></script>
  <script src="<?= base_url('/_admin/js/plugin/bootstrap-fileinput/purify.min.js') ?>" type="text/javascript"></script>
  <script src="<?= base_url('/_admin/js/plugin/bootstrap-fileinput/fileinput.min.js') ?>"></script>
  <script src="<?= base_url('/_admin/js/plugin/bootstrap-fileinput/themes/fas/theme.js') ?>"></script>
  <script src="<?= base_url('/_admin/js/plugin/bootstrap-fileinput/themes/explorer-fas/theme.js') ?>" type="text/javascript"></script>
  <script src="<?= base_url('/_admin/js/plugin/bootstrap-fileinput/locales/th.js') ?>"></script>
  <script>
    function elfinderDialog() {
      var fm = $('<div/>').dialogelfinder({
        url: '<?= base_url('/assets/elFinder/php/connector.minimal.php') ?>',
        lang: 'en',
        width: 840,
        height: 450,
        destroyOnClose: true,
        uiOptions: {
          toolbar: [
            // toolbar configuration
            ['open'],
            ['back', 'forward'],
            ['reload'],
            ['home', 'up'],
            ['mkdir', 'mkfile', 'upload'],
            ['info'],
            ['copy', 'cut', 'paste'],
            ['rm'],
            ['duplicate', 'rename', 'edit'],
            ['extract', 'archive'],
            ['search'],
            ['view'],
            ['help']
          ]
        },
        getFileCallback: function(files, fm) {
          $('.summernote').summernote('editor.insertImage', files.url);
        },
        commandsOptions: {
          getfile: {
            oncomplete: 'close',
            folders: false
          }
        }
      }).dialogelfinder('instance');
    }
    $(document).ready(function() {
      // DO NOT REMOVE : GLOBAL FUNCTIONS!
      pageSetUp();

      var responsiveHelper_dt_basic = undefined;
      var responsiveHelper_dt_select_basic = undefined;
      var breakpointDefinition = {
        tablet: 1024,
        phone: 480
      };
      var news_cover = '<?= $item['news_cover'] ?>';
      var news_id = '<?= $item['news_id'] ?>';

      $('#news_type').val('<?= $item['news_type'] ?>')

      $('.summernote').summernote({
        minHeight: 200,
        maxHeight: 500,
        dialogsInBody: true,
        toolbar: [
          ['style', ['style']],
          ['fontsize', ['fontsize']],
          ['font', ['bold', 'italic', 'underline', 'clear']],
          ['fontname', ['fontname']],
          ['color', ['color']],
          ['para', ['ul', 'ol', 'paragraph']],
          ['height', ['height']],
          ['table', ['table']],
          ['insert', ['link', 'picture', 'video', 'hr', 'elfinder']],
          ['view', ['codeview', 'help']],
        ],
        callbacks: {
          onImageUpload: function(files, editor, welEditable) {
            sendFile(files[0], editor, welEditable);
          }
        }
      });

      function sendFile(file, editor, welEditable) {
        data = new FormData();
        data.append("file", file);
        $.ajax({
          data: data,
          type: "POST",
          url: "<?= base_url('/AdminUpload/fileUploadSummernote') ?>",
          cache: false,
          contentType: false,
          processData: false,
          success: function(url) {
            $('.summernote').summernote("insertImage", url, 'filename');
          }
        });
      }

      var attachment = <?= json_encode($list_attachment) ?>;

      var table = $('#table-attachment').DataTable({
        pageLength: 25,
        searching: false,
        data: attachment,
        paging: false,
        "sDom": "<'dt-toolbar'<'col-xs-12 col-sm-6'f><'col-sm-6 col-xs-12 hidden-xs'l>r>" +
          "t" +
          "<'dt-toolbar-footer'<'col-sm-6 col-xs-12 hidden-xs'i><'col-xs-12 col-sm-6'p>>",
        "autoWidth": true,
        "oLanguage": {
          "sSearch": '<span class="input-group-addon"><i class="glyphicon glyphicon-search"></i></span>'
        },
        "columns": [{
            "data": "attach_no",
            "render": function(data, type, full, meta) {
              if (type == 'sort') {
                return pad(data, 4);
              }
              return `<section class="smart-form mb-0">
										<label class="input"> 
											<input value="${data}" id="attach_no-${meta.row}" type="number" min="0" data-index="${meta.row}" data-id="${full.attach_id}" name="tb_attach_no" placeholder="ลำดับ">
										</label>
									</section>`
            }
          },
          {
            "render": function(data, type, full, meta) {
              var html = `<button type="button" data-index="${meta.row}" name="btnbrowse" data-id="${full.attach_id}" 
								class="btn btn-xs btn-warning"><i class="far fa-folder-open"></i></button>`
              html += `<button type="button" data-index="${meta.row}" name="btnselect" data-id="${full.attach_id}" 
								class="btn btn-xs btn-primary"><i class="fas fa-globe-asia"></i></button>`
              html += `<button type="button" data-index="${meta.row}" name="btndelete" data-id="${full.attach_id}" data-newsid="${full.news_id}" 
									class="btn btn-xs btn-danger"><i class="fa fa-trash"></i></button>`;
              return html
            }
          },
          {
            "data": "attach_title",
            "render": function(data, type, full, meta) {
              if (type == 'sort') {
                return data
              }
              return `<section class="smart-form mb-0">
										<label class="input"> 
											<input id="attach_title-${meta.row}" value="${data}" type="text" data-index="${meta.row}" data-id="${full.attach_id}" name="tb_attach_title" placeholder="หัวข้อ">
										</label>
									</section>`
            }
          },
          {
            "data": "attach_path",
            "render": function(data, type, full, meta) {
              if (full.url) {
                return `<a target="_blank" href="${full.url}">${data}</a>`
              }
              return `<a target="_blank" href="<?= base_url('/uploads/') ?>${data}">${data.split(/(\\|\/)/g).pop()}</a>`
            }
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

      $('#addrow').click(function() {
        var index = table.data().count()
        $('.attachment').append(
          `<input data-index="${index}" style="display: none;" id="attachment-${index}" name="attachment[]" type="file" />`
        )
        table.row.add({
          attach_title: '',
          attach_path: '',
          attach_id: '',
          attach_no: table.data().count() + 1
        }).draw(false);
      })

      var table_select = $('#table').DataTable({
        pageLength: 10,
        data: [],
        "sDom": "<'dt-toolbar'<'col-xs-12 col-sm-6'f><'col-sm-6 col-xs-12 hidden-xs'l>r>" +
          "t" +
          "<'dt-toolbar-footer'<'col-sm-6 col-xs-12 hidden-xs'i><'col-xs-12 col-sm-6'p>>",
        "autoWidth": true,
        "oLanguage": {
          "sSearch": '<span class="input-group-addon"><i class="glyphicon glyphicon-search"></i></span>'
        },
        "columns": [{
            "render": function(data, type, full, meta) {
              return `<div class="smart-form"><label class="checkbox"><input ${currentSelect == meta.row ? 'checked' : ''} data-index="${meta.row}" type="checkbox" name="select_news[]"><i></i></label></div>`
            },
          },
          {
            "data": "news_title",
            "render": function(data, type, full, meta) {
              return `<a target="_blank" href="<?= base_url() ?>admin/news/edit/${full.news_id}">${data}</a>`
            }
          },
          {
            "data": "attach_title"
          },
          {
            "data": "attach_path",
            "render": function(data, type, full, meta) {
              return `<a target="_blank" href="<?= base_url('/uploads/') ?>${data}">${data.split(/(\\|\/)/g).pop()}</a>`
            }
          }
        ],
        "preDrawCallback": function() {
          // Initialize the responsive datatables helper once.
          if (!responsiveHelper_dt_select_basic) {
            responsiveHelper_dt_select_basic = new ResponsiveDatatablesHelper($(this), breakpointDefinition);
          }
        },
        "rowCallback": function(nRow) {
          var id = $(this).data('id')
          responsiveHelper_dt_select_basic.createExpandIcon(nRow);
        },
        "drawCallback": function(oSettings) {
          var id = $(this).data('id')
          $('input[name="select_news[]"]').prop('checked', false)
          $(`input[name="select_news[]"][data-index=${currentSelect}]`).prop('checked', true)
          responsiveHelper_dt_select_basic.respond();
        }
      });

      $(document).on('click', 'button[name=btnbrowse]', function() {
        var index = $(this).data('index')
        var file = $('#attachment-' + index)
        $(file).trigger('click');
      })

      $(document).on('change', 'input[name="attachment[]"]', function(e) {
        var index = $(this).data('index')
        var url = URL.createObjectURL(this.files[0]);
        var data = table.row(index).data();
        var name = $(this).val().split(/(\\|\/)/g).pop()
        data.attach_path = name
        data.url = url
        table.row(index).data(data);
        table.draw()
      })

      $(document).on('change', 'input[name=tb_attach_title]', function() {
        var data = table.row($(this).parents('tr')).data();
        data.attach_title = $(this).val()
        table.row($(this).parents('tr')).data(data);
        table.draw()
      })

      $(document).on('change', 'input[name=tb_attach_no]', function() {
        var data = table.row($(this).parents('tr')).data();
        var old_attach_no = data.attach_no
        var new_attach_no = isNaN(Number($(this).val())) ? 1 : Number($(this).val())

        for (var i = 0; i < table.data().count(); i++) {
          var d = table.row(i).data();
          if (d.attach_no == new_attach_no) {
            d.attach_no = old_attach_no
            table.row(i).data(d);
            table.draw()
            break;
          }
        }

        data.attach_no = new_attach_no

        table.row($(this).parents('tr')).data(data);
        table.draw()
        table
          .column(0)
          .data()
          .sort();
      })

      $(document).on('click', 'button[name=btndelete]', function() {
        var index = $(this).data('index')
        var row = table.row($(this).parents('tr'));
        var del_no = table.row($(this).parents('tr')).data().attach_no;
        var rowNode = row.node();
        row.remove();

        $('#attachment-' + index).remove()

        var d = table.rows().data();
        for (var i = 0; i < table.data().count(); i++) {
          var d = table.row(i).data();
          if (d.attach_no > del_no) {
            d.attach_no -= 1;
            table.row(i).data(d);
          }
        }
        table.draw()
      })

      var modalFind = $('#modal-find')
      var isSave = false

      $("#public_date").datepicker({
        container: '#save-form',
        language: 'th',
        autoclose: true,
        format: 'dd/mm/yyyy',
      }).datepicker("setDate", '<?= $item['public_date'] ?>');

      $('#category_id').val('<?= $item['category_id'] ?>')

      $('button[name=btnsave]').click(function() {
        var code = $('.summernote').summernote('code')
        $('#news_detail').val(code.trim())
        $('#news_url').val($('#news_title').val().toLowerCase().replace(/[ .]/g, '-').replace(/[^\w\u0E00-\u0E7F-]+/g, ''))
        $('#save-form').submit()
      })

      var mapImage = []
      var _images = <?= json_encode($list_images) ?>;

      var images = [];
      var images_preview_init = [];
      var images_initialPreviewDownloadUrl = [];

      for (var i in _images) {
        images.push(_images[i].image_path)
        images_preview_init.push(_images[i].upload_image_path)
        images_initialPreviewDownloadUrl.push(_images[i].upload_image_path)
      }
      Dropzone.autoDiscover = false;
      $("#mydropzone").dropzone({
        url: "<?= base_url('/AdminUpload/fileupload') ?>",
        maxFiles: 1,
        addRemoveLinks: true,
        dictDefaultMessage: `<span class="text-center">
				<span class="font-md visible-xs-block visible-sm-block visible-lg-block">
				<span class="font-md">
				<i class="fa fa-caret-right text-danger"></i>เพิ่มรูปหน้าปก ลากไฟล์ <span class="font-xs">   เพื่ออัพโหลด</span></span><span>&nbsp&nbsp<h4 class="display-inline"> (หรือคลิก)</h4></span>`,
        dictResponseError: 'Error uploading file!',
        addRemoveLinks: true,
        removedfile: function(file) {
          var name = mapImage[file.name] || file.name;
          if (news_cover != name) {
            $.post('<?= base_url('/AdminUpload/fileremove') ?>', {
              name: name
            })
          }
          $('#news_cover').val('')
          var _ref;
          return (_ref = file.previewElement) != null ? _ref.parentNode.removeChild(file.previewElement) : void 0;
        },
        init: function() {
          myDropzone = this;
          this.on("maxfilesexceeded", function(file) {
            this.removeAllFiles(true);
            this.addFile(file);
          });
          this.on("success", function(file, response) {
            var fileuploded = file.previewElement.querySelector("[data-dz-name]");
            fileuploded.innerHTML = response.file_name;
            mapImage[file.name] = response.file_name;
            $('#news_cover').val(response.file_name)
          });
          <?php
          $file_path =  'uploads/' . $item['news_cover'];
          $url_file_path =  base_url() . $file_path;
          if ($item['news_cover'] != '' && is_file($file_path)) {
            $size = filesize($file_path);
          } else {
            $size = 0;
          }
          ?>
          var mockFile = {
            name: '<?= $item['news_cover'] ?>',
            size: <?= $size ?>,
            status: 'success',
            accepted: true,
          };
          var path = '<?= $url_file_path ?>';
          if (mockFile.name != '') {
            myDropzone.files.push(mockFile);
            myDropzone.emit("addedfile", mockFile);
            myDropzone.createThumbnailFromUrl(mockFile, path);
            myDropzone.emit("complete", mockFile);
          }

        }
      });

      var save = function() {
        if ($('#news_type').val() == 'link') {
          $('#news_detail').val($('#link').val())
        }
        var dataForm = $('#save-form').serializeArray();
        dataForm.push({
          name: 'images',
          value: images.length == 0 ? '' : images
        });
        var form = new FormData();

        jQuery.each(jQuery('input[name="attachment[]"]'), function(i, el) {
          var index = $(el).data('index')
          var d = table.row(index).data()
          form.append('attachment[' + i + ']', el.files[0]);
          form.append('server[' + i + ']', d.attach_path || '');
          form.append('row[' + i + ']', i);
        });
        var attachmentSave = []
        $.ajax({
          data: form,
          type: "POST",
          url: "<?= base_url('/AdminUpload/fileUpload_attachment') ?>",
          cache: false,
          contentType: false,
          processData: false,
          success: function(res) {
            var dataPost = {}
            for (var i in res) {
              var index = res[i].index
              if (!index) {
                $('#error-attachment').html(res[i])
              }
              attachmentSave.push({
                attach_no: $('#attach_no-' + index).val(),
                attach_title: $('#attach_title-' + index).val(),
                attach_path: res[i].file_name,
              })
            }
            dataForm.push({
              name: 'attachment',
              value: attachmentSave.length == 0 ? '' : attachmentSave
            });
            for (var i in dataForm) {
              dataPost[dataForm[i].name] = dataForm[i].value
            }
            $.post("<?= base_url() ?>AdminNews/save", dataPost, function(data) {
                if (data.isError && data.Message) {
                  $.alert({
                    title: 'Warning!',
                    type: 'red',
                    content: data.Message,
                  });
                } else {
                  toastr.success(data.Message, {
                    timeOut: 2000
                  })
                }
              })
              .error(function(error) {
                $('#error').html(error.responseText)
              })
          },
          error: function(error) {
            $('#error').html(error.responseText)
          }
        });

      }

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
          category_id: {
            required: true,
          },
          public_date: {
            required: true,
          },
          news_detail: {
            required: true,
            minlength: 5,
          },
        },
        // Messages for form validation
        messages: {},
        submitHandler: function() {
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
                  isSave = true
                  if ($('#news_type').val() == 'link' || $('#images').fileinput('getFilesCount') == 0) {
                    save()
                  } else {
                    $('#images').fileinput('upload')
                  }
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

      var images_initialPreviewConfig = []
      var re = /(?:\.([^.]+))?$/;
      for (var i in images) {
        var name = images[i].split(/(\\|\/)/g).pop()
        var ext = re.exec(name)[1];
        var config = {
          caption: name,
          key: images[i],
          downloadUrl: '/uploads/' + images[i],
          url: '<?= base_url() ?>/AdminUpload/fileinput_remove',
        }
        if (ext == 'pdf') {
          config['type'] = ext;
        }
        images_initialPreviewConfig.push(config)
      }
      $("#images").fileinput({
        theme: 'fas',
        uploadUrl: "<?= base_url('/AdminUpload/fileinput_upload?input=images') ?>",
        language: 'th',
        browseOnZoneClick: true,
        initialPreview: images_preview_init,
        initialPreviewDownloadUrl: images_initialPreviewDownloadUrl,
        initialPreviewConfig: images_initialPreviewConfig,
        initialPreviewAsData: true,
        showUpload: false,
        showCaption: false,
        showBrowse: false,
        showRemove: true,
        purifyHtml: true,
        initialPreviewFileType: 'image', // image is the default and can be overridden in config below
        allowedFileExtensions: ['jpg', 'png', 'gif'],
        uploadExtraData: function() {
          return {
            bdInteli: ''
          };
        }
      }).on('fileuploaded', function(e, params) {
        for (var i in params.response.initialPreviewConfig) {
          if (params.response.initialPreviewConfig[i].key) {
            images.push(params.response.initialPreviewConfig[i].key)
          }
        }
        if (isSave && $('#images').fileinput('getFilesCount') == 1) {
          save()
        }
      }).on('filedeleted', function(e, key, jqXHR, data) {
        for (var i in images) {
          if (images[i] == key) {
            images.splice(i, 1)
            break
          }
        }
      });

      $('#news_type').change(function() {
        if ($(this).val() == 'link') {
          $('.field-normal').css('display', 'none')
          $('.field-link').css('display', '')
        } else {
          $('.field-normal').css('display', '')
          $('.field-link').css('display', 'none')
        }
      }).trigger('change')

      $(window).on('beforeunload', function() {
        if (isSave) {
          return
        }
        Dropzone.forElement("#mydropzone").removeAllFiles(true);
      });

      var currentSelect = -1
      var currentRowEdit = -1
      $('button[name=btn_save_select]').click(function() {
        const data = table_select.row(currentSelect).data()
        const edit = table.row(currentRowEdit).data()
        edit.attach_title = data.attach_title
        edit.attach_path = data.attach_path
        table.row(currentRowEdit).data(edit)
        table.columns.adjust().draw();
        modalFind.modal('hide')
      })

      $(document).on('click', 'input[name="select_news[]"]', function(e) {
        $('input[name="select_news[]"]').prop('checked', false)
        currentSelect = $(this).data('index')
        $(this).prop('checked', true)
      })

      $(document).on('click', 'button[name=btnselect]', function() {
        modalFind.modal('show')
        currentRowEdit = $(this).data('indedx')
        $('input[name="select_news[]"]').prop('checked', false)
        if (table_select.data().count() == 0) {
          $.get('<?= base_url() ?>AdminNews/load_attachment', function(data) {
            const result = data.result
            table_select.clear().draw();
            table_select.rows.add(result);
            table_select.columns.adjust().draw();
          })
        }
      })

    });
  </script>

</body>

</html>
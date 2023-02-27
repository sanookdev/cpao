<!DOCTYPE html>
<html lang="en-us">
<?php
$main_page = "ตั้งค่าเมนู";
$page = "เพิ่มหน้า";
?>

<head>
  <meta charset="utf-8">

  <title><?= $page ?> | <?= project_name ?></title>
  <meta name="description" content="">
  <meta name="author" content="">

  <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no">

  <?php include 'templates/admin/style.php'; ?>
  <link href="<?= base_url('/assets/elFinder/css/elfinder.min.css') ?>" media="all" rel="stylesheet" type="text/css" />
  <link href="<?= base_url('/assets/elFinder/css/theme.css') ?>" media="all" rel="stylesheet" type="text/css" />
  <link rel="stylesheet" type="text/css" href="<?= base_url("/assets/jsTree/dist/themes/default/style.min.css") ?>">

</head>

<body class="smart-style-2 fixed-header">

  <!-- HEADER -->
  <?php include 'templates/admin/header.php'; ?>
  <!-- END HEADER -->

  <!-- Left panel : Navigation area -->
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
                <h2><?= $page ?></h2>

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
                    <input type="hidden" id="page_id" value="" name="page_id">
                    <fieldset>
                      <div class="row">
                        <section class="col col-6">
                          <label class="label">หัวข้อหน้า *</label>
                          <label class="input"> <i class="icon-prepend fa fa-cube"></i>
                            <input type="text" id="page_title" name="page_title" placeholder="">
                            <b class="tooltip tooltip-top-right"><i class="fa fa-cube txt-color-teal"></i> หัวข้อหน้า</b>
                          </label>
                        </section>
                        <section class="col col-3">
                          <label class="label">รูปแบบการแสดง</label>
                          <label class="select">
                            <select id="page_type" name="page_type">
                              <option disabled="">เลือก รูปแบบการแสดง</option>
                              <option value="custom" selected>Custom</option>
                              <option value="folder">Folder</option>
                              <option value="link">Link</option>
                            </select> <i></i>
                          </label>
                        </section>
                        <section class="col col-2">
                          <label class="label">แสดง</label>
                          <label class="checkbox"><input type="checkbox" value="1" name="is_show" id="is_show"><i></i></label>
                        </section>
                      </div>
                      <div class="row">
                        <section class="col col-2 field-folder">
                          <a blank="_target" href="<?= base_url('/admin/folder') ?>">จัดการโฟลเดอร์</a>
                        </section>
                      </div>
                      <div class="row">
                        <section class="col col-6 field-link">
                          <label class="label">Link *</label>
                          <label class="input"> <i class="icon-prepend fa fa-cube"></i>
                            <input type="text" value="" id="link" name="link" placeholder="eg  http://www...">
                            <b class="tooltip tooltip-top-right"><i class="fa fa-cube txt-color-teal"></i> Link</b>
                          </label>
                        </section>
                      </div>
                      <div class="row field-folder">
                        <div class="row ph-2 mb-1">
                          <section class="col col-6">
                            <input id="q_treeview" style="padding: 0px 12px;" class="form-control mb-2 mr-2" placeholder="Search">
                            <div class="text-primary mb-2" id="select_node"></div>
                          </section>
                          <div id="jstree"></div>
                        </div>
                      </div>
                      <div class="row field-custom">
                        <div class="ph-2 mb-1">
                          <h3 class="mb-1">รายละเอียดหน้า</h3>
                          <textarea name="page_detail" id="page_detail" style="display: none;"></textarea>
                          <div class="summernote">
                          </div>
                        </div>
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
    <!-- END MAIN CONTENT -->

    <div id="error"></div>

  </div>
  <!-- END MAIN PANEL -->

  <!-- PAGE FOOTER -->
  <?php include 'templates/admin/footer.php'; ?>
  <!-- END PAGE FOOTER -->

  <!--================================================== -->

  <?php include 'templates/admin/script.php'; ?>
  <script src="<?= base_url('/assets/elFinder/js/elfinder.min.js') ?>"></script>
  <script src="<?= base_url('/_admin/js/summernote-ext-elfinder.js') ?>"></script>
  <script src="<?= base_url("/assets/jsTree/dist/jstree.min.js") ?>"></script>
  <script src="<?= base_url("/assets/jsTree/src/jstree.search.js") ?>"></script>
  <script>
    function elfinderDialog() {
      var fm = $('<div/>').dialogelfinder({
        url: '<?= base_url('/assets/elFinder/php/connector.minimal.php?p=qwe23dvsdt$@FSDry57782') ?>',
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
          console.log('files.url', files.url)
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

      var responsiveHelper_dt_basic = [];
      var breakpointDefinition = {
        tablet: 1024,
        phone: 480
      };

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
          ['view', ['codeview', 'help']]
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

      var modalSave = $('#modal-save')
      var table = []
      var isSave = false

      $("#public_date").datepicker({
        container: '#save-form',
        language: 'th',
        autoclose: true,
        format: 'dd/mm/yyyy',
      }).datepicker("setDate", new Date());

      $('button[name=btnsave]').click(function() {
        var code = $('.summernote').summernote('code')
        $('#page_detail').val(code.trim())
        $('#save-form').submit()
      })

      var save = function() {
        if ($('#page_type').val() == 'folder') {
          $('#page_detail').val(moveFolder)
        } else if ($('#page_type').val() == 'link') {
          $('#page_detail').val($('#link').val())
        }
        var dataForm = $('#save-form').serializeArray();
        if ($('.field-menu').css('display') == 'none') {
          dataForm.push({
            name: 'menu_id',
            value: $('#parent_id').val()
          })
        }
        $.post("<?= base_url() ?>AdminManagePage/save", dataForm, function(data) {
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
              window.location.href = "<?= base_url('/admin/page/edit/') ?>" + data.id
            }
          })
          .error(function(error) {
            console.log('error :', error);
            $('#error').html(error.responseText)
          })
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
          page_title: {
            maxlength: 250,
            required: true,
          },
          page_detail: {
            required: true,
            minlength: 5,
          },
          page_type: {
            required: true,
          },
          link: {
            required: true,
          },
          menu_id: {
            maxlength: 200,
            remote: {
              url: "<?= base_url() ?>AdminManagePage/menu_is_empty",
              type: "get",
              data: {
                action: function() {
                  return 'new';
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
                  save()
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
                    loadData()
                    $.alert({
                      title: 'Successfully!',
                      type: 'green',
                      content: data.Message,
                      backgroundDismiss: true,
                      onClose: function() {
                        window.location.href = '<?= base_url() ?>admin/news/new'
                      },
                    });
                  }
                })
              }
            },
            cancel: function() {}
          }
        });
      })

      $('#btnadd').click(function() {
        $('.modal-title').html('เพิ่มข่าว')
        $('#page_id').val('')
        $('#page_title').val('')
        $('.invalid').remove()
        $('label').removeClass('state-error')
        $('label').removeClass('state-success')
        modalSave.modal('show')
        $('#page_title').select()
      })

      $(document).on('click', 'button[name=btnedit]', function() {
        var id = $(this).data('id')
        $.get('<?= base_url() ?>AdminManagePage/news?id=' + id, function(data) {
            $('#page_id').val(data.page_id)
            $('#page_title').val(data.page_title)
            $('.invalid').remove()
            $('label').removeClass('state-error')
            $('label').removeClass('state-success')
            modalSave.modal('show')
            $('#page_title').select()
          })
          .error(function(error) {
            console.log('error :', error);
            $('#error').html(error.responseText)
          })

      })

      $('#page_type').change(function() {
        if ($(this).val() == 'folder') {
          $('.field-folder').css('display', '')
          $('.field-custom').css('display', 'none')
          $('.field-link').css('display', 'none')
        } else if ($(this).val() == 'link') {
          $('.field-custom').css('display', 'none')
          $('.field-folder').css('display', 'none')
          $('.field-link').css('display', '')
        } else {
          $('.field-folder').css('display', 'none')
          $('.field-custom').css('display', '')
          $('.field-link').css('display', 'none')
        }
      }).trigger('change')

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
            html += `<option value="${item.menu_id}">${item.menu_title}</option>`
          }
          $('#menu_id').html(html)
        })
      })

      var moveFolder = ''
      $('#jstree').on("changed.jstree", function(e, data) {
        if (data.node && data.node.original) {
          moveFolder = data.node.original.id
          $('#select_node').html(`เลือก ${data.node.original.text}`)
        } else {
          $('#select_node').html(`ยังไม่ได้เลือก`)
        }
      }).jstree({
        "core": {
          "animation": 0,
          "check_callback": true,
          "themes": {
            "stripes": true
          },
          'data': {
            "url": '<?= base_url() ?>AdminFolder/load_tree?lazy',
            "data": function(node) {
              return {
                "id": node.id,
              };
            }
          }
        },
        "types": {
          "#": {
            "max_children": 1,
            "max_depth": 4,
            "valid_children": ["root"]
          },
          "root": {
            "icon": "/static/3.3.8/assets/images/tree_icon.png",
            "valid_children": ["default"]
          },
          "default": {
            "valid_children": ["default", "file"]
          },
          "file": {
            "icon": "glyphicon glyphicon-file",
            "valid_children": []
          }
        },
        "plugins": [
          "contextmenu", "dnd", "search",
          "state", "types", "wholerow"
        ]
      });
      var to = false;
      $('#q_treeview').keyup(function() {
        if (to) {
          clearTimeout(to);
        }
        to = setTimeout(function() {
          var v = $('#q_treeview').val();
          $('#jstree').jstree(true).search(v);
        }, 250);
      });

    });
  </script>

</body>

</html>
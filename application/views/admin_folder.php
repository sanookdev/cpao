<!DOCTYPE html>
<html lang="en">
<?php
$main_page = "จัดการโฟลเดอร์";
$page = "จัดการโฟลเดอร์";
?>

<head>
  <meta charset="utf-8">
  <!--<meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">-->

  <title><?= $page ?> | <?= project_name ?></title>
  <meta name="description" content="">
  <meta name="author" content="">

  <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no">

  <?php include 'templates/admin/style.php'; ?>
  <link rel="stylesheet" type="text/css" href="<?= base_url("/assets/simplePagination/simplePagination.css") ?>">
  <link rel="stylesheet" type="text/css" href="<?= base_url("/assets/jsTree/dist/themes/default/style.min.css") ?>">
  <link href="https://hayageek.github.io/jQuery-Upload-File/4.0.11/uploadfile.css" rel="stylesheet">
</head>

  <body class="smart-style-2 fixed-header">

    <!-- HEADER -->
    <?php include 'templates/admin/header.php'; ?>
    <!-- END HEADER -->

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
              <i class="fa fa-folder fa-fw "></i>
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
            <article class="col-xs-12">

              <!-- Widget ID (each widget will need unique ID)-->
              <div class="jarviswidget jarviswidget-color-darken" id="wid-id-2" data-widget-sortable="false" data-widget-deletebutton="false" data-widget-colorbutton="false" data-widget-editbutton="false">
                <header>
                  <span class="widget-icon"> <i class="fa fa-folder"></i> </span>
                  <h2>รายการโฟลเดอร์</h2>
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
                    <div style="padding: 16px;">
                      <button data-toggle="modal" data-target="#modal-new" class="btn btn-primary"><i class="fa fa-folder"></i> New</button>
                      <button <?= isset($cat_id) && $cat_id != 0 ? '' : 'disabled' ?> class="btn btn-success" type="button" data-toggle="collapse" data-target="#fileuploader" aria-expanded="false" aria-controls="fileuploader"><i class="fa fa-upload"></i> อัพโหลด</button>
                      <button class="btn" id="clear-upload"><i class="fas fa-eraser"></i> เคลียร์อัพโหลด</button>
                      <button data-toggle="modal" data-target="#modal-move" class="btn btn-warning" id="move_batch" disabled><i class="fas fa-arrow-right"></i> ย้าย</button>
                      <button class="btn btn-danger" id="delete_batch" disabled><i class="fa fa-trash"></i> ลบที่เลือก</button>
                      <button class="btn" id="clear_select" disabled><i class="fa fa-eraser"></i> เคลียร์ที่เลือก</button>
                      <div class="collapse mt-2" id="fileuploader">Upload</div>
                    </div>
                    <ol class="breadcrumb">
                      <?php
                      echo '<li><a href="' . base_url() . 'admin/folder">ศูนย์ข้อมูลลข่าวสาร</a></li>';
                      foreach ($path as $row) {
                        $end = explode('/', $row['cat_dir']);
                        echo '<li><a href="' . base_url() . 'admin/folder/' . $row['cat_id'] . '">' . end($end) . '</a></li>';
                      }
                      ?>
                    </ol>
                    <div class="smart-form">
                      <section class="col col-4">
                        <label class="input"> <i class="icon-prepend fa fa-search"></i>
                          <input type="text" name="search" placeholder="Search">
                        </label>
                      </section>
                    </div>
                    <table id="table" name="folder" class="table table-striped table-bordered table-hover" width="100%">
                      <thead>
                        <tr>
                          <th style="width: 5%;min-width: 50px;">เลือก</th>
                          <th style="width: 7%;min-width: 80px;" data-hide="phone">ลำดับ</th>
                          <th class="tool-width-4" style="min-width: 120px;">จัดการ</th>
                          <th data-class="expand"><i class="fa fa-fw fa-cube text-muted hidden-md hidden-sm hidden-xs"></i> ชื่อ</th>
                          <th data-class="expand"><i class="fa fa-fw fa-cube text-muted hidden-md hidden-sm hidden-xs"></i> ชื่อที่แสดง</th>
                          <th data-class="expand"><i class="fa fa-fw fa-calendar text-muted hidden-md hidden-sm hidden-xs"></i> วันที่</th>
                          <th data-class="expand"><i class="fa fa-fw fa-cube text-muted hidden-md hidden-sm hidden-xs"></i> จำนวนไฟล์ / ขนาด</th>
                        </tr>
                      </thead>
                      <tbody id="body-data">
                      </tbody>
                    </table>
                    <div class="page-nav p-3">
                    </div>
                  </div>
                </div>
              </div>
            </article>
          </div>
        </section>
      </div>

      <div id="error"></div>

    </div>
    <!-- END MAIN PANEL -->

    <div class="modal" id="modal-move" role="dialog">
      <div class="modal-dialog" role="document">
        <div class="modal-content">
          <div class="modal-header">
            <h5 class="modal-title">ย้ายโฟลเดอร์ / ไฟล์</h5>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
              <span aria-hidden="true">&times;</span>
            </button>
          </div>
          <div class="modal-footer">
            <button name="btnmove" type="button" class="btn btn-primary">Save changes</button>
            <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
          </div>
          <div class="modal-body" style="padding-top: 0px;">
            <input id="q_treeview" class="form-control mb-2" placeholder="Search">
            <div class="text-primary mb-2" id="select_node"></div>
            <div id="jstree"></div>
          </div>

        </div>
      </div>
    </div>

    <div class="modal" id="modal-href" role="dialog">
      <div class="modal-dialog" role="document">
        <div class="modal-content">
          <div class="modal-header">
            <h5 class="modal-title">แก้ไขลิงค์</h5>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
              <span aria-hidden="true">&times;</span>
            </button>
          </div>
          <div class="modal-body" style="padding-top: 0px;">
            <form id="href-form" class="smart-form">
              <fieldset>
                <div class="row">
                  <section class="ph-2">
                    <input id="edit_cat_id" type="hidden" />
                    <span class="edit_cat_name">ชื่อโฟลเดอร์</span>
                  </section>
                </div>
                <div class="row">
                  <section class="ph-2">
                    <label class="input"> <i class="icon-prepend fa fa-link"></i>
                      <input required type="text" maxlength="1000" id="edit_cat_href" name="edit_cat_href" placeholder="ลิงค์">
                      <b class="tooltip tooltip-top-right"><i class="fa fa-link txt-color-teal"></i> ลิงค์</b>
                    </label>
                  </section>
                </div>
              </fieldset>
              <button type="submit" style="display: none;" class="btn btn-primary"></button>
            </form>
          </div>
          <div class="modal-footer">
            <button name="btnhref" type="button" class="btn btn-primary">Save changes</button>
            <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
          </div>
        </div>
      </div>
    </div>

    <div class="modal" id="modal-new" role="dialog">
      <div class="modal-dialog" role="document">
        <div class="modal-content">
          <div class="modal-header">
            <h5 class="modal-title">เพิ่มโฟลเดอร์</h5>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
              <span aria-hidden="true">&times;</span>
            </button>
          </div>
          <div class="modal-body" style="padding-top: 0px;">
            <form id="save-form" class="smart-form">
              <fieldset>
                <div class="row">
                  <section class="ph-2">
                    <label class="input"> <i class="icon-prepend fa fa-cube"></i>
                      <input required type="text" maxlength="80" id="cat_dir" name="cat_dir" placeholder="ชื่อโฟลเดอร์">
                      <b class="tooltip tooltip-top-right"><i class="fa fa-cube txt-color-teal"></i> ชื่อโฟลเดอร์</b>
                    </label>
                  </section>
                </div>
                <div class="row">
                  <section class="ph-2">
                    <label class="input"> <i class="icon-prepend fa fa-cube"></i>
                      <input required type="text" maxlength="200" id="cat_title" name="cat_title" placeholder="ชื่อที่แสดง">
                      <b class="tooltip tooltip-top-right"><i class="fa fa-link txt-color-teal"></i> ชื่อที่แสดง</b>
                    </label>
                  </section>
                </div>
                <div class="row">
                  <section class="col col-3">
                    <label class="checkbox"><input type="checkbox" value="1" name="is_show" id="is_show"><i></i> แสดง</label>
                  </section>
                </div>
              </fieldset>
              <button type="submit" style="display: none;" class="btn btn-primary"></button>
            </form>
          </div>
          <div class="modal-footer">
            <button name="btnnew" type="button" class="btn btn-primary">Save changes</button>
            <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
          </div>
        </div>
      </div>
    </div>

    <!-- PAGE FOOTER -->
    <?php include 'templates/admin/footer.php'; ?>
    <!-- END PAGE FOOTER -->

    <?php include 'templates/admin/shortcut.php'; ?>
    <!-- END SHORTCUT AREA -->

    <?php include 'templates/admin/script.php'; ?>
    <script src="<?= base_url("/assets/simplePagination/jquery.simplePagination.js") ?>"></script>
    <script src="https://hayageek.github.io/jQuery-Upload-File/4.0.11/jquery.uploadfile.min.js"></script>
    <script src="<?= base_url("/assets/jsTree/dist/jstree.min.js") ?>"></script>
    <script src="<?= base_url("/assets/jsTree/src/jstree.search.js") ?>"></script>
    <script>
      $(function() {
        let page = window.location.hash.substr(1).replace('page-', '') || 1
        let itemOnPage = 10
        let parent_id = <?= $cat_id ?>;
        let parent_folder = '<?= $cat_dir ?>';
        let bodyTable = $('#body-data')
        $('.page-nav').pagination({
          items: <?= $total_page ?>,
          itemOnPage: itemOnPage,
          currentPage: page,
          cssStyle: 'light-theme',
          onPageClick: function(p, evt) {
            page = p
          }
        });
        const genLink = (data) => {
          var name = String(data.cat_dir).substring(String(data.cat_dir).lastIndexOf('/') + 1)
          return `<a href="<?= base_url() ?>admin/folder/${data.cat_id}">${name}</a>`
        }
        const renderFolder = (item) => {
          var name = item.cat_dir.substring(item.cat_dir.lastIndexOf('/') + 1)
          var directory = item.cat_dir.split('/')
          var isSelect = select.some(x => x.id == item.cat_id)
          if (directory.length > 1) {
            directory.pop()
          }
          directory = directory.join('/')
          var manage = `<button name="btnedit" data-id="${item.cat_id}" 
								class="btn btn-xs btn-default"><i class="fas fa-pencil-alt"></i></button><span data-id="${item.cat_id}" name="field-btnsave"></span>`
          manage += `<button name="btnedit_href" data-name="${item.cat_title}" data-href="${item.cat_href}" data-id="${item.cat_id}" 
								class="btn btn-xs btn-${item.cat_href ? 'success' : 'default'}"><i class="fas fa-link"></i></button>`
          manage += `<button name="btnshow" data-value="${item.published}" data-id="${item.cat_id}" 
                  class="btn btn-xs ${item.published == '0' ? 'btn-danger' : 'btn-primary' }">${item.published == '0' ? '<i class="fa fa-eye-slash"></i>' : '<i class="fa fa-eye"></i>' }</button>`;
          manage += `<button name="btndelete" data-id="${item.cat_id}" 
									class="btn btn-xs btn-danger"><i class="fa fa-trash"></i></button>`;
          return `<tr>
            <td class="smart-form text-center"><section>
                <label class="checkbox"><input ${isSelect ? 'checked' : ''} type="checkbox" data-type="folder" data-id="${item.cat_id}" value="1" name="select"><i></i></label>
              </section></td>
            <td><section class="smart-form">
                <label class="input"> 
                  <input value="${item.ordering}" type="number" min="0" data-id="${item.cat_id}" name="tb_ordering" placeholder="ลำดับ">
                </label>
              </section>
            </td>
            <td>${manage}</td>
            <td name="dir" data-parent="${directory}" data-value="${name}" data-id="${item.cat_id}">${genLink(item)}
            </td>
            <td name="title" data-value="${item.cat_title}" data-id="${item.cat_id}">${item.cat_title}
            </td>
            <td></td>
            <td>${item.count_sub_folder} โฟลเดอร์ | ${item.size} ไฟล์</td>
          </tr>`
        }
        const renderFile = (item) => {
          var name = item.file_title
          var isSelect = select.some(x => x.id == item.cat_id)
          var manage = `<button name="btnedit_file" data-id="${item.file_id}" 
								class="btn btn-xs btn-default"><i class="fas fa-pencil-alt"></i></button><span data-id="${item.file_id}" name="field-btnsave_file"></span>`
          manage += `<button name="btnshow_file" data-value="${item.published}" data-id="${item.file_id}" 
                  class="btn btn-xs ${item.published == '0' ? 'btn-danger' : 'btn-primary' }">${item.published == '0' ? '<i class="fa fa-eye-slash"></i>' : '<i class="fa fa-eye"></i>' }</button>`;
          manage += `<button name="btndelete_file" data-id="${item.file_id}" 
									class="btn btn-xs btn-danger"><i class="fa fa-trash"></i></button>`;
          return `<tr>
            <td class="smart-form text-center"><i>
                <label class="checkbox"><input ${isSelect ? 'checked' : ''} data-type="file" data-id="${item.file_id}" type="checkbox" value="1" name="select"><i></i></label>
              </i></td>
            <td><section class="smart-form">
                <label class="input"> 
                  <input value="${item.ordering}" type="number" min="0" data-id="${item.file_id}" name="tb_ordering_file" placeholder="ลำดับ">
                </label>
              </section>
            </td>
            <td>${manage}</td>
            <td name="url_download" data-value="${item.url_download}" data-id="${item.file_id}"><a target="_blank" href="<?= base_url() ?>awe12rhsto1m23fsd/jdownloads/${item.cat_dir}/${item.url_download}">${item.url_download}</a>
            </td>
            <td name="file_title" data-value="${item.file_title}" data-id="${item.file_id}">${item.file_title}</td>
            <td  style="max-width: 120px;" name="file_date" data-value="${item.date_added_format}" data-id="${item.file_id}">${item.date_added_format}</td>
            <td>${item.size}</td>
          </tr>`
        }
        const getIconFile = (file_name) => {
          var re = /(?:\.([^.]+))?$/;
          var ext = re.exec(file_name)[1];
          switch (ext) {
            case "pdf":
              return '<i class="fa fa-file-pdf-o text-danger" aria-hidden="true"></i> ';
            case "docx":
            case "doc":
              return '<i class="fa fa-file-word-o text-primary" aria-hidden="true"></i> ';
            case "ppt":
            case "pptx":
              return '<i class="fa fa-file-powerpoint-o text-danger" aria-hidden="true"></i> ';
            case "xls":
            case "xlsx":
              return '<i class="fa fa-file-excel-o text-success" aria-hidden="true"></i> ';
            case "gif":
            case "jpg":
            case "jpeg":
            case "png":
              return '<i class="fa fa-file-image-o text-danger" aria-hidden="true"></i> ';
              break;
            default:
              return '<i class="fa fa-file-o" aria-hidden="true"></i> ';
          }
        }
        const load_folder = () => {
          let search = $('input[name=search]').val()
          $.get(`<?= base_url() ?>AdminFolder/load_folder?page=${page}&parent=${parent_id}&search=${search}`, function(data) {
              var html = ''
              const rs = data.result
              for (var i in rs) {
                var item = rs[i]
                if (item.type == 'folder') {
                  html += renderFolder(item)
                } else {
                  html += renderFile(item)
                }
              }
              if (rs.length == 0) {
                html = '<tr><td colspan="6" class="text-center">ไม่พบข้อมูล</td></tr>'
              }
              $('.page-nav').pagination({
                items: data.total_page,
                itemOnPage: itemOnPage,
                currentPage: page,
                cssStyle: 'light-theme',
                onPageClick: function(p, evt) {
                  page = p
                }
              });
              bodyTable.html(html)
            })
            .fail((error) => {
              $('#error').html(error.responseText)
              console.log('error :', error);
            })
        }
        $('input[name=search]').keyup(function(e) {
          if (e.keyCode == 13) {
            page = 1
            load_folder()
          }
        })
        $('#clear-upload').click(function() {
          $('.ajax-file-upload-container').empty()
        })
        $("#fileuploader").uploadFile({
          url: "<?= base_url() ?>AdminFile/save_file",
          fileName: "myfile",
          dynamicFormData: function() {
            var data = {
              cat_id: parent_id
            }
            return data;
          },
          afterUploadAll: function(obj) {
            load_folder()
          }
        });
        $('button[name=btnnew]').click(function() {
          $('#save-form').submit()
        })
        $('button[name=btnhref]').click(function() {
          $('#href-form').submit()
        })
        var errorClass = 'invalid';
        var errorElement = 'em';
        var validator = $("#href-form").validate({
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
          submitHandler: function() {
            let data = {
              cat_id: $('#edit_cat_id').val(),
              cat_href: $('#edit_cat_href').val(),
            }
            $('#modal-href').modal('hide')
            save_href(data)
          },
          // Do not change code below
          errorPlacement: function(error, element) {
            error.insertAfter(element.parent());
          }
        })
        var validator = $("#save-form").validate({
          errorClass: errorClass,
          errorElement: errorElement,
          rules: {
            cat_dir: {
              maxlength: 250,
              required: true,
              remote: {
                url: "<?= base_url() ?>AdminFolder/check_duplicate",
                type: "get",
                data: {
                  cat_dir: function() {
                    return (parent_folder) ? parent_folder + "/" + $('#cat_dir').val() : $('#cat_dir').val();
                  },
                  parent_id: function() {
                    return parent_id;
                  },
                }
              }
            }
          },
          messages: {
            cat_dir: {
              remote: 'ชื่อโฟลเดอร์ซ้ำ'
            }
          },
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
          submitHandler: function() {
            let alias = $('#cat_title').val().toLowerCase().replace(/[ .]/g, '-').replace(/[^\w\u0E00-\u0E7F-]+/g, '');
            let data = {
              cat_id: 0,
              parent_id: parent_id,
              cat_dir: (parent_folder) ? parent_folder + "/" + $('#cat_dir').val() : $('#cat_dir').val(),
              cat_title: $('#cat_title').val(),
              cat_alias: alias,
              published: $('#is_show').prop('checked') ? 1 : 0
            }
            $('#modal-new').modal('hide')
            save(data)
          },
          // Do not change code below
          errorPlacement: function(error, element) {
            error.insertAfter(element.parent());
          }
        })
        var edit = []
        var edit_file = []
        const save = (send) => {
          $.post('<?= base_url() ?>AdminFolder/save_folder', {
            data: send
          }, function(data) {
            edit[send.cat_id] = false
            if (data.isError && data.Message) {
              $.alert({
                title: 'Warning!',
                type: 'red',
                backgroundDismiss: true,
                content: data.Message,
              });
            } else {
              load_folder()
              toastr.success(data.Message, {
                timeOut: 2000
              })
            }
          }).fail((error) => {
            $('#error').html(error.responseText)
            console.log('error :', error);
          })
        }
        const save_href = (send) => {
          $.post('<?= base_url() ?>AdminFolder/save_href', {
            data: send
          }, function(data) {
            edit[send.cat_id] = false
            if (data.isError && data.Message) {
              $.alert({
                title: 'Warning!',
                type: 'red',
                backgroundDismiss: true,
                content: data.Message,
              });
            } else {
              load_folder()
              toastr.success(data.Message, {
                timeOut: 2000
              })
            }
          }).fail((error) => {
            $('#error').html(error.responseText)
            console.log('error :', error);
          })
        }
        const save_file = (send) => {
          $.post('<?= base_url() ?>AdminFile/save', {
            data: send
          }, function(data) {
            edit_file[send.file_id] = false
            if (data.isError && data.Message) {
              $.alert({
                title: 'Warning!',
                type: 'red',
                content: data.Message,
              });
            } else {
              load_folder()
              toastr.success(data.Message, {
                timeOut: 2000
              })
            }
          }).fail((error) => {
            $('#error').html(error.responseText)
            console.log('error :', error);
          })
        }
        $(document).on('click', 'button[name=btnsave]', function() {
          let id = $(this).data('id')
          let parent = $(`td[data-id=${id}][name=dir]`).data('parent')
          let title = $(`input[data-id=${id}][name=title]`).val()
          let alias = title.toLowerCase().replace(/[ .]/g, '-').replace(/[^\w\u0E00-\u0E7F-]+/g, '');
          let send = {
            cat_id: id,
            cat_dir: (parent_folder) ? parent + "/" + $(`input[data-id=${id}][name=dir]`).val() : $(`input[data-id=${id}][name=dir]`).val(),
            cat_title: title,
            cat_alias: alias,
          }
          save(send)
        })
        $(document).on('click', 'button[name=btnshow]', function() {
          var id = $(this).data('id')
          var value = $(this).data('value') == '0' ? '1' : '0'
          var text = value == '0' ? 'ซ่อน' : 'แสดง'
          $.post('<?= base_url() ?>AdminFolder/show_folder', {
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
              load_folder()
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
        $(document).on('click', 'button[name=btnedit_href]', function() {
          let id = $(this).data('id')
          let name = $(this).data('name')
          let href = $(this).data('href')
          $('#edit_cat_id').val(id)
          $('.edit_cat_name').html(name)
          $('#edit_cat_href').val(href)
          $('#modal-href').modal('show')
        })
        $(document).on('click', 'button[name=btnedit]', function() {
          let id = $(this).data('id')
          // not edit
          if (edit[id]) {
            $(`span[data-id=${id}][name=field-btnsave]`).html('')
            $(this).find('i').removeClass('fa-ban')
            $(this).find('i').addClass('fa-pencil-alt')
            let item = {
              cat_id: id,
              cat_dir: edit[id].dir,
            }
            $(`td[name="dir"][data-id=${id}]`).html(genLink(item))
            $(`td[name="title"][data-id=${id}]`).html(edit[id].title)
            edit[id] = false
            return
          }
          // edit
          $(`span[data-id=${id}][name=field-btnsave]`).html(`<button name="btnsave" data-id="${id}" 
								class="btn btn-xs btn-warning"><i class="fas fa-save"></i></button>`)
          $(this).find('i').removeClass('fa-pencil-alt')
          $(this).find('i').addClass('fa-ban')

          let dir = $(`td[name="dir"][data-id=${id}]`).data('value')
          let title = $(`td[name="title"][data-id=${id}]`).data('value')
          edit[id] = {
            dir: dir,
            title: title,
          }
          $(`td[name="dir"][data-id=${id}]`).html(`<section class="smart-form">
            <label class="input">
              <input value="${dir}" maxlength="80" data-id="${id}" name="dir" placeholder="ชื่อโฟลเดอร์">
            </label>
          </section>`)
          $(`td[name="title"][data-id=${id}]`).html(`<section class="smart-form">
            <label class="input"> 
              <input value="${title}" maxlength="255" data-id="${id}" name="title" placeholder="ชื่อที่แสดง">
            </label>
          </section>`)
          $(`input[name=dir][data-id=${id}]`).select()
        })
        $(document).on('click', 'button[name=btndelete]', function() {
          var id = $(this).data('id')
          $.confirm({
            title: 'กรุณายืนยันการลบโฟลเดอร์!',
            content: 'ต้องการลบโฟลเดอร์นี้หรือไม่?',
            backgroundDismiss: true,
            buttons: {
              confirm: {
                btnClass: 'btn-red',
                action: function() {
                  $.post('<?= base_url() ?>AdminFolder/remove_folder', {
                    id: id
                  }, function(data) {
                    if (data.isError && data.Message) {
                      $.alert({
                        title: 'Warning!',
                        type: 'red',
                        content: data.Message,
                      });
                    } else {
                      load_folder()
                      toastr.success(data.Message, {
                        timeOut: 2000
                      })
                    }
                  }).fail(function(error) {
                    $('#error').html(error.responseText)
                  })
                }
              },
              cancel: function() {}
            }
          });
        })
        $(document).on('change', 'input[name=tb_ordering]', function() {
          var id = $(this).data('id')
          var number = $(this).val()
          var dataForm = {
            cat_id: id,
            ordering: number
          }
          $.post("<?= base_url() ?>AdminFolder/save_no", dataForm, function(data) {
              if (data.isError && data.Message) {
                $.alert({
                  title: 'Warning!',
                  type: 'red',
                  content: data.Message,
                });
              } else {
                load_folder()
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
        $(document).on('click', 'button[name=btnsave_file]', function() {
          let id = $(this).data('id')
          let title = $(`input[data-id=${id}][name=file_title]`).val()
          let alias = title.toLowerCase().replace(/[ .]/g, '-').replace(/[^\w\u0E00-\u0E7F-]+/g, '');
          let send = {
            file_id: id,
            file_title: $(`input[data-id=${id}][name=file_title]`).val(),
            date_added: $(`input[data-id=${id}][name=file_date]`).val(),
            file_alias: alias,
          }
          save_file(send)
        })
        $(document).on('click', 'button[name=btnshow_file]', function() {
          var id = $(this).data('id')
          var value = $(this).data('value') == '0' ? '1' : '0'
          var text = value == '0' ? 'ซ่อน' : 'แสดง'
          $.post('<?= base_url() ?>AdminFile/show_file', {
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
              load_folder()
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
        $(document).on('click', 'button[name=btnedit_file]', function() {
          let id = $(this).data('id')
          // not edit
          if (edit_file[id]) {
            $(`span[data-id=${id}][name=field-btnsave_file]`).html('')
            $(this).find('i').removeClass('fa-ban')
            $(this).find('i').addClass('fa-pencil-alt')
            $(`td[name="file_title"][data-id=${id}]`).html(edit_file[id].file_title)
            $(`td[name="file_date"][data-id=${id}]`).html(edit_file[id].file_date)
            edit_file[id] = false
            return
          }
          // edit
          $(`span[data-id=${id}][name=field-btnsave_file]`).html(`<button name="btnsave_file" data-id="${id}" 
								class="btn btn-xs btn-warning"><i class="fas fa-save"></i></button>`)
          $(this).find('i').removeClass('fa-pencil-alt')
          $(this).find('i').addClass('fa-ban')

          let file_title = $(`td[name="file_title"][data-id=${id}]`).data('value')
          let file_date = $(`td[name="file_date"][data-id=${id}]`).data('value')
          edit_file[id] = {
            file_title: file_title,
            file_date: file_date,
          }
          $(`td[name="file_title"][data-id=${id}]`).html(`<section class="smart-form">
            <label class="input"> 
              <input value="${file_title}" maxlength="255" data-id="${id}" name="file_title" placeholder="ชื่อที่แสดง">
            </label>
          </section>`)
          $(`td[name="file_date"][data-id=${id}]`).html(`<section class="smart-form">
            <label class="input"> 
            <input type="text" autocomplete="off" readonly value="${file_date}" data-id="${id}" name="file_date" placeholder="วันที่" data-dateformat="yy-mm-dd">
            </label>
          </section>`)
          $(`input[name=file_title][data-id=${id}]`).select()
          $(`input[name=file_date][data-id=${id}]`).datepicker({
            container: `td[name="file_date"][data-id=${id}] .smart-form`,
            language: 'th',
            autoclose: true,
            format: 'yyyy-mm-dd',
          });
        })
        $(document).on('click', 'button[name=btndelete_file]', function() {
          var id = $(this).data('id')
          $.confirm({
            title: 'กรุณายืนยันการลบไฟล์!',
            content: 'ต้องการลบไฟล์นี้หรือไม่?',
            backgroundDismiss: true,
            buttons: {
              confirm: {
                btnClass: 'btn-red',
                action: function() {
                  $.post('<?= base_url() ?>AdminFile/remove_file', {
                    id: id
                  }, function(data) {
                    if (data.isError && data.Message) {
                      $.alert({
                        title: 'Warning!',
                        type: 'red',
                        backgroundDismiss: true,
                        content: data.Message,
                      });
                    } else {
                      load_folder()
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
        $(document).on('change', 'input[name=tb_ordering_file]', function() {
          var id = $(this).data('id')
          var number = $(this).val()
          var dataForm = {
            file_id: id,
            ordering: number
          }
          $.post("<?= base_url() ?>AdminFile/save_no", dataForm, function(data) {
              if (data.isError && data.Message) {
                $.alert({
                  title: 'Warning!',
                  type: 'red',
                  content: data.Message,
                });
              } else {
                load_folder()
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
        $(document).on('keyup', 'input[name=file_title]', function(e) {
          if (e.keyCode == 13) {
            let id = $(this).data('id')
            $(`button[name=btnsave_file][data-id=${id}]`).trigger('click')
          }
        })
        $(document).on('keyup', 'input[name=file_date]', function(e) {
          if (e.keyCode == 13) {
            let id = $(this).data('id')
            $(`button[name=btnsave_file][data-id=${id}]`).trigger('click')
          }
        })
        $(document).on('keyup', 'input[name=dir]', function(e) {
          if (e.keyCode == 13) {
            let id = $(this).data('id')
            $(`button[name=btnsave][data-id=${id}]`).trigger('click')
          }
        })
        $(document).on('keyup', 'input[name=title]', function(e) {
          if (e.keyCode == 13) {
            let id = $(this).data('id')
            $(`button[name=btnsave][data-id=${id}]`).trigger('click')
          }
        })
        let select = []
        let moveFolder = ''
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
                  "select": select
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
        $(document).on('click', 'input[name=select]', function() {
          let item = {
            id: $(this).data('id'),
            type: $(this).data('type'),
          }
          if ($(this).prop('checked')) {
            select.push(item)
          } else {
            select = select.filter((value) => value.id != item.id)
          }
          updateBatch()
        })
        $('button[name=btnmove]').click(function() {
          if (moveFolder != '') {
            $.alert({
              title: 'Warning!',
              type: 'red',
              content: 'กรุณาเลือกโฟลเดอร์ปลายทาง',
            });
            return
          }
          $.confirm({
            title: 'กรุณายืนยันการย้ายข้อมูล!',
            content: `ต้องการย้ายข้อมูล (${select.length}) นี้หรือไม่?`,
            backgroundDismiss: true,
            buttons: {
              confirm: {
                btnClass: 'btn-red',
                action: function() {
                  $.post('<?= base_url() ?>AdminFolder/move_batch', {
                      list: select,
                      moveFolder: moveFolder
                    }, function(data) {
                      console.log('data :', data);
                      select = []
                      updateBatch()
                      if (data.isError && data.Message) {
                        $.alert({
                          title: 'Warning!',
                          type: 'red',
                          content: data.Message,
                        });
                      } else {
                        $('#modal-move').modal('hide')
                        load_folder()
                        toastr.success(data.Message, {
                          timeOut: 2000
                        })
                      }
                    })
                    .fail(function(error) {
                      $('#error').html(error.responseText)
                      console.log('error :', error);
                    })
                }
              },
              cancel: function() {}
            }
          });
        })
        $('#move_batch').click(function() {
          $('#jstree').jstree("refresh");
        })
        $('#delete_batch').click(function() {
          if (select.length == 0) {
            $.alert({
              title: 'Warning!',
              type: 'red',
              backgroundDismiss: true,
              content: 'กรุณาเลือกรายการ',
            });
            return;
          }
          $.confirm({
            title: 'กรุณายืนยันการลบโฟลเดอร์!',
            content: `ต้องการลบโฟลเดอร์ (${select.length}) นี้หรือไม่?`,
            backgroundDismiss: true,
            buttons: {
              confirm: {
                btnClass: 'btn-red',
                action: function() {
                  $.post('<?= base_url() ?>AdminFolder/remove_batch', {
                      list: select
                    }, function(data) {
                      select = []
                      updateBatch()
                      if (data.isError && data.Message) {
                        $.alert({
                          title: 'Warning!',
                          type: 'red',
                          content: data.Message,
                        });
                      } else {
                        load_folder()
                        toastr.success(data.Message, {
                          timeOut: 2000
                        })
                      }
                    })
                    .fail(function(error) {
                      $('#error').html(error.responseText)
                      console.log('error :', error);
                    })
                }
              },
              cancel: function() {}
            }
          });
        })
        $('#clear_select').click(function() {
          select = []
          $('input[name=select]').prop('checked', false)
          updateBatch()
        })
        const updateBatch = () => {
          if (select.length > 0) {
            $('#move_batch').prop('disabled', false)
            $('#move_batch').html(`<i class="fas fa-arrow-right"></i> ย้าย (${select.length})`)
            $('#delete_batch').prop('disabled', false)
            $('#delete_batch').html(`<i class="fa fa-trash"></i> ลบที่เลือก (${select.length})`)
            $('#clear_select').prop('disabled', false)
            $('#clear_select').html(`<i class="fa fa-eraser"></i> เคลียร์ที่เลือก (${select.length})`)
          } else {
            $('#move_batch').prop('disabled', true)
            $('#move_batch').html(`<i class="fas fa-arrow-right"></i> ย้าย`)
            $('#delete_batch').prop('disabled', true)
            $('#delete_batch').html(`<i class="fa fa-trash"></i> ลบที่เลือก`)
            $('#clear_select').prop('disabled', true)
            $('#clear_select').html(`<i class="fa fa-eraser"></i> เคลียร์ที่เลือก`)
          }
        }
        $(window).on('hashchange', function() {
          page = window.location.hash.substr(1).replace('page-', '') || 1
          load_folder()
        });
        load_folder()
      })
    </script>

  </body>

</html>
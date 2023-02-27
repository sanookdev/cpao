<!DOCTYPE html>
<html lang="en-us">

<head>
  <meta charset="utf-8">
  <!--<meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">-->

  <title>รายการผู้ใช้ | <?= project_name ?></title>
  <meta name="description" content="">
  <meta name="author" content="">

  <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no">

  <?php include 'templates/admin/style.php'; ?>
  <link rel="stylesheet" href="https://earthchie.github.io/jquery.Thailand.js/jquery.Thailand.js/dist/jquery.Thailand.min.css">

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
            <i class="fa fa-users fa-fw "></i>
            จัดการผู้ใช้
            <span>>
              รายการข้อมูลผู้ใช้
            </span>
          </h1>
        </div>
      </div>
      <div class="row">
        <div class="col-xs-12 mb-1">
          <a href="<?= base_url('/admin/user/new') ?>" class="btn btn-primary">เพิ่มผู้ใช้</a>
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
                <h2>รายการข้อมูลผู้ใช้ </h2>

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
                        <th style="width: 20px;" data-hide="phone">ลำดับ</th>
                        <th class="tool-width-2">จัดการ</th>
                        <th data-class="expand"><i class="fa fa-fw fa-user text-muted hidden-md hidden-sm hidden-xs"></i> Name</th>
                        <th data-hide="phone"> Username</th>
                        <th><i class="fa fa-fw fa-envelope text-muted hidden-md hidden-sm hidden-xs"></i> Email</th>
                        <th data-hide="phone,tablet"><i class="fa fa-fw fa-map-marker txt-color-blue hidden-md hidden-sm hidden-xs"></i> อำเภอ</th>
                        <th data-hide="phone,tablet">ตำบล</th>
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

  <div class="modal" id="modal-edit" tabindex="-1" role="dialog">
    <div class="modal-dialog modal-lg" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title">แก้ไขข้อมูลผู้ใช้</h5>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <div class="modal-body" style="padding-top: 0px;">
          <form id="edit-form" class="smart-form" autocomplete="off">
            <input type="hidden" id="user_id" name="user_id">
            <div class="col col-8">
              <header>ข้อมูลส่วนตัว</header>
              <fieldset>
                <div class="row">
                  <section class="col col-6">
                    <label class="input"> <i class="icon-prepend fa fa-user"></i>
                      <input type="text" id="fname" name="fname" placeholder="ชื่อ">
                      <b class="tooltip tooltip-top-right"><i class="fa fa-user txt-color-teal"></i> ชื่อ</b>
                    </label>
                  </section>
                  <section class="col col-6">
                    <label class="input"> <i class="icon-prepend fa fa-user"></i>
                      <input type="text" id="lname" name="lname" placeholder="นามสกุล">
                      <b class="tooltip tooltip-top-right"><i class="fa fa-user txt-color-teal"></i> นามสกุล</b>
                    </label>
                  </section>
                </div>

                <div class="row">
                  <section class="col col-6">
                    <label class="input"> <i class="icon-prepend fa fa-id-card"></i>
                      <input type="text" id="card_id" name="card_id" placeholder="เลขประตัวประชาชน">
                      <b class="tooltip tooltip-top-right"><i class="fa fa-id-card txt-color-teal"></i> เลขประตัวประชาชน</b>
                    </label>
                  </section>
                  <section class="col col-6">
                    <label class="select">
                      <select id="gender" name="gender">
                        <option disabled selected>เพศ</option>
                        <option value="ชาย">ชาย</option>
                        <option value="หญิง">หญิง</option>
                      </select> <i></i> </label>
                  </section>
                </div>

                <div class="row">
                  <section class="col col-6">
                    <label class="input"> <i class="icon-append fa fa-birthday-cake"></i>
                      <input type="text" autocomplete="off" name="birthday" placeholder="วันเกิด" data-dateformat="dd/mm/yy" id="birthday">
                      <b class="tooltip tooltip-top-right"><i class="fa fa-birthday-cake txt-color-teal"></i> วันเกิด</b>
                    </label>
                  </section>
                  <section class="col col-6">
                    <label class="input"> <i class="icon-append fas fa-map-marker"></i>
                      <input type="text" autocomplete="off" name="address" placeholder="บ้านเลขที่" id="address">
                      <b class="tooltip tooltip-top-right"><i class="fas fa-map-marker txt-color-teal"></i> บ้านเลขที่</b>
                    </label>
                  </section>
                </div>
                <div class="row">
                  <section class="ph-2">
                    <label class="input"> <i class="icon-append fas fa-search"></i>
                      <input type="text" autocomplete="off" placeholder="ค้นหาที่อยู่ของคุณ" id="search_address">
                      <b class="tooltip tooltip-top-right"><i class="fas fa-search txt-color-teal"></i> ค้นหาที่อยู่ของคุณ</b>
                    </label>
                  </section>
                </div>
                <div class="row">
                  <section class="ph-2">
                    <span style="padding: 8px 6px; color: #fff;" class="label label-success" id="show-address"></span>
                  </section>
                </div>
              </fieldset>
              <header>ข้อมูลการล็อคอิน</header>
              <fieldset>
                <div class="row">
                  <section class="col col-6">
                    <label class="input"> <i class="icon-prepend fa fa-user"></i>
                      <input type="text" autocomplete="off" id="username" name="username" placeholder="Username">
                      <b class="tooltip tooltip-top-right"><i class="fa fa-user txt-color-teal"></i> Username</b>
                    </label>
                  </section>
                  <section class="col col-6">
                    <label class="input"> <i class="icon-prepend fas fa-envelope"></i>
                      <input type="email" id="email" name="email" placeholder="E-mail">
                      <b class="tooltip tooltip-top-right"><i class="fas fa-envelope txt-color-teal"></i> E-mail</b>
                    </label>
                  </section>
                </div>

                <div class="row">
                  <section class="col col-6">
                    <label class="input"> <i class="icon-prepend fa fa-key"></i>
                      <input type="password" autocomplete="off" id="password" name="password" placeholder="Password">
                      <b class="tooltip tooltip-top-right"><i class="fa fa-key txt-color-teal"></i> Password</b>
                    </label>
                  </section>
                  <section class="col col-6">
                    <label class="input"> <i class="icon-prepend fa fa-key"></i>
                      <input type="password" autocomplete="off" id="confirmed" name="confirmed" placeholder="ยืนยัน Password">
                      <b class="tooltip tooltip-top-right"><i class="fa fa-key txt-color-teal"></i> ยืนยัน Password</b>
                    </label>
                  </section>
                </div>
                <div class="row">
                  <section class="col col-6">
                    <label class="checkbox"><input type="checkbox" name="toggle_password" id="toggle_password"><i></i>Show password</label>
                  </section>
                  <section class="col col-6">
                    <label class="input"> <i class="icon-prepend fa fa-child"></i>
                      <input type="text" id="nick" name="nick" placeholder="ชื่อที่แสดงหน้าเว็ป">
                      <b class="tooltip tooltip-top-right"><i class="fa fa-child txt-color-teal"></i> ชื่อที่แสดงหน้าเว็ป</b>
                    </label>
                  </section>
                  <section class="col col-6">
                    <label class="checkbox"><input type="checkbox" value="1" name="is_admin" id="is_admin"><i></i>ตั้งเป็น admin</label>
                  </section>
                </div>
              </fieldset>
            </div>
            <div class="col col-4">
              <header>สิทธิ์การเข้าใช้งาน</header>
              <table class="table mt-3">
                <tbody>
                  <?php
                  foreach ($permission as $pem) {
                    echo '<tr><td class="mb-1"><label class="checkbox"><input type="checkbox" data-pem="' . $pem['pem_id'] . '" value="' . $pem['pem_id'] . '" name="pem[]"><i></i></label></td><td>' . $pem['title'] . '</td></tr>';
                  }
                  ?>
                </tbody>
              </table>
            </div>
            <input type="hidden" id="district" name="district">
            <input type="hidden" id="amphoe" name="amphoe">
            <input type="hidden" id="province" name="province">
            <input type="hidden" id="zipcode" name="zipcode">
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
  <script type="text/javascript" src="https://earthchie.github.io/jquery.Thailand.js/jquery.Thailand.js/dependencies/JQL.min.js"></script>
  <script type="text/javascript" src="https://earthchie.github.io/jquery.Thailand.js/jquery.Thailand.js/dependencies/typeahead.bundle.js"></script>
  <script type="text/javascript" src="https://earthchie.github.io/jquery.Thailand.js/jquery.Thailand.js/dist/jquery.Thailand.min.js"></script>

  <script>
    $(document).ready(function() {
      // DO NOT REMOVE : GLOBAL FUNCTIONS!
      pageSetUp();

      var responsiveHelper_dt_basic = undefined;
      var breakpointDefinition = {
        tablet: 1024,
        phone: 480
      };

      var modalEdit = $('#modal-edit')
      $.Thailand({
        $search: $('#search_address'), // input ของช่องค้นหา
        $district: $('#district'),
        $amphoe: $('#amphoe'),
        $province: $('#province'),
        $zipcode: $('#zipcode'),
        onDataFill: function(data) { // callback เมื่อเกิดการ auto complete ขึ้น
          $('#show-address').html(`<b>ที่อยู่:</b> ตำบล${data.district} อำเภอ${data.amphoe} จังหวัด${data.province} ${data.zipcode}`)
        },
        templates: {
          empty: ' ',
          suggestion: function(data) {
            if (data.zipcode) {
              data.zipcode = ' » ' + data.zipcode;
            }
            return '<div>' + data.district + ' » ' + data.amphoe + ' » ' + data.province + data.zipcode + '</div>';
          }
        }
      });
      $("#birthday").datepicker({
        container: '#edit-form',
        language: 'th',
        autoclose: true,
        startView: 'decade',
        format: 'dd/mm/yyyy',
      });

      $('#toggle_password').change(function() {
        if ($('#password').prop('type') == 'text') {
          $('#password').prop('type', 'password');
        } else {
          $('#password').prop('type', 'text');
        }
      })

      var table = $('#table').DataTable({
        "sDom": "<'dt-toolbar'<'col-xs-12 col-sm-6'f><'col-sm-6 col-xs-12 hidden-xs'l>r>" +
          "t" +
          "<'dt-toolbar-footer'<'col-sm-6 col-xs-12 hidden-xs'i><'col-xs-12 col-sm-6'p>>",
        "autoWidth": true,
        "oLanguage": {
          "sSearch": '<span class="input-group-addon"><i class="glyphicon glyphicon-search"></i></span>'
        },
        "columns": [{
            "render": function(data, type, full, meta) {
              return meta.row + 1;
            },
            className: 'dt-body-center'
          },
          {
            "render": function(data, type, full, meta) {
              var html = `<button name="btnedit" data-id="${full.user_id}" 
								class="btn btn-xs btn-default"><i class="fas fa-pencil-alt"></i></button>`
              if (full.is_lock == '0') {
                html += `<button name="btndelete" data-id="${full.user_id}" class="btn btn-xs btn-danger"><i class="fa fa-trash"></i></button>`;
              }
              return html
            }
          },
          {
            "render": function(data, type, full, meta) {
              return `${full.fname} ${full.lname}`;
            }
          },
          {
            "data": "username"
          },
          {
            "data": "email"
          },
          {
            "data": "amphoe",
            "render": function(data, type, full, meta) {
              return data || '';
            }
          },
          {
            "data": "district",
            "render": function(data, type, full, meta) {
              return data || '';
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
        $('#edit-form').submit()
      })
      var errorClass = 'invalid';
      var errorElement = 'em';
      var validator = $("#edit-form").validate({
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
          fname: {
            required: true,
          },
          lname: {
            required: true,
          },
          card_id: {
            minlength: 13,
            required: true,
          },
          username: {
            required: true,
            minlength: 4,
            maxlength: 16,
            remote: {
              url: "<?= base_url() ?>adminUser/check_duplicate",
              type: "get",
              data: {
                action: function() {
                  return "edit";
                },
                id: function(data) {
                  var username = $("#user_id").val();
                  return username;
                },
                col: function() {
                  return "username";
                },
                value: function() {
                  var value = $("#username").val();
                  return value;
                }
              }
            }
          },
          email: {
            required: true,
            remote: {
              url: "<?= base_url() ?>adminUser/check_duplicate",
              type: "get",
              data: {
                action: function() {
                  return "edit";
                },
                id: function(data) {
                  var username = $("#user_id").val();
                  return username;
                },
                col: function() {
                  return "email";
                },
                value: function() {
                  var value = $("#email").val();
                  return value;
                }
              }
            }
          },
          gender: {
            required: true,
          },
          password: {
            required: true,
            minlength: 6,
            maxlength: 20
          },
          confirmed: {
            minlength: 6,
            equalTo: "#password"
          }
        },

        // Messages for form validation
        messages: {
          username: {
            remote: "Username already in use!"
          },
          email: {
            required: 'Please enter your email address',
            email: 'Please enter a VALID email address',
            remote: "E-mail already in use!",
          },
          password: {
            required: 'Please enter your password'
          },
          confirmed: {
            equalTo: 'Please enter the same password again.'
          }
        },

        submitHandler: function() {
          var dataForm = $("#edit-form").serializeArray()
          if (dataForm.find(x => x.name == 'is_admin') == null) {
            dataForm.push({
              name: 'is_admin',
              value: $('#is_admin').prop('checked') ? 1 : 0
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
                  $.post("<?= base_url() ?>adminUser/save", dataForm, function(data) {
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
                $.post('<?= base_url() ?>adminUser/remove', {
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
        $.get('<?= base_url() ?>adminUser/user?id=' + id, function(data) {
            $('#show-address').html(`<b>ที่อยู่:</b> ตำบล${data.district || '-'} อำเภอ${data.amphoe || '-'} จังหวัด${data.province || '-'} ${data.zipcode || ''}`)
            $('#address').val(data.address)
            $('#user_id').val(data.user_id)
            $('#fname').val(data.fname)
            $('#lname').val(data.lname)
            $('#username').val(data.username)
            $('#email').val(data.email)
            $('#password').val(data.password)
            $('#confirmed').val(data.password)
            $('#gender').val(data.gender)
            $('#card_id').val(data.card_id)
            $('#nick').val(data.nick)
            $('#is_admin').prop('checked', data.is_admin == '1')
            $('#is_admin').prop('disabled', data.is_lock == '1')
            $("#birthday").datepicker("setDate", data.birthday);
            // permission
            $('input[name="pem[]"]').prop('checked', false)
            for (let i in data.permission) {
              const pem = data.permission[i]
              $('input[name="pem[]"][data-pem="' + pem.pem_id + '"]').prop('checked', pem.is_active == 1)
            }
            //
            $('.invalid').remove()
            $('label').removeClass('state-error')
            $('label').removeClass('state-success')
            modalEdit.modal('show')
          })
          .error(function(error) {
            console.log('error :', error);
            $('#error').html(error.responseText)
          })

      })

      var loadData = function() {
        var before = $('.widget-icon').html()
        $('.widget-icon').html('<i class="fas fa-sync-alt fa-spin"></i>')
        $.get('<?= base_url() ?>adminUser/load_list', function(data) {
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

    });
  </script>

</body>

</html>
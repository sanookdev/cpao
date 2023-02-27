<!DOCTYPE html>
<html lang="en-us">

<head>
  <meta charset="utf-8">
  <!--<meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">-->

  <title>เพิ่มผู้ใช้ | <?= project_name ?></title>
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
        <li>เพิ่มผู้ใช้</li>
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
              เพิ่มผู้ใช้
            </span>
          </h1>
        </div>
      </div>
      <!-- widget grid -->
      <section id="widget-grid" class="">

        <!-- row -->
        <div class="row">

          <!-- NEW WIDGET START -->
          <article class="col-xs-12 col-sm-12 col-md-10 col-lg-10 col-md-offset-1 col-lg-offset-1">

            <div class="jarviswidget jarviswidget-color-darken" id="wid-id-1" data-widget-sortable="false" data-widget-deletebutton="false" data-widget-colorbutton="false" data-widget-editbutton="false">

              <header>
                <span class="widget-icon"> <i class="fa fa-table"></i> </span>
                <h2>ข้อมูลผู้ใช้ใหม่ </h2>
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
                  <form id="new-form" method="post" autocomplete="off" class="smart-form">
                    <input type="hidden" id="user_id" value="" name="user_id">
                    <div class="col col-8">
                      <header>ข้อมูลผู้ใช้</header>
                      <fieldset>
                        <div class="row">
                          <section class="col col-6">
                            <label class="input"> <i class="icon-prepend fa fa-user">*</i>
                              <input type="text" id="fname" name="fname" placeholder="ชื่อ">
                              <b class="tooltip tooltip-top-right"><i class="fa fa-user txt-color-teal"></i> ชื่อ</b>
                            </label>
                          </section>
                          <section class="col col-6">
                            <label class="input"> <i class="icon-prepend fa fa-user">*</i>
                              <input type="text" id="lname" name="lname" placeholder="นามสกุล">
                              <b class="tooltip tooltip-top-right"><i class="fa fa-user txt-color-teal"></i> นามสกุล</b>
                            </label>
                          </section>
                        </div>

                        <div class="row">
                          <section class="col col-6">
                            <label class="input"><i class="icon-prepend fa fa-id-card">*</i>
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
                              <input type="password" id="confirmed" name="confirmed" placeholder="ยืนยัน Password">
                              <b class="tooltip tooltip-top-right"><i class="fa fa-key txt-color-teal"></i> ยืนยัน Password</b>
                            </label>
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
                    <footer>
                      <button name="btnsave" type="button" class="btn btn-primary">Save changes</button>
                    </footer>
                  </form>
                </div>
              </div>
            </div>
          </article>
        </div>
      </section>
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
  <script type="text/javascript" src="https://earthchie.github.io/jquery.Thailand.js/jquery.Thailand.js/dependencies/JQL.min.js"></script>
  <script type="text/javascript" src="https://earthchie.github.io/jquery.Thailand.js/jquery.Thailand.js/dependencies/typeahead.bundle.js"></script>
  <script type="text/javascript" src="https://earthchie.github.io/jquery.Thailand.js/jquery.Thailand.js/dist/jquery.Thailand.min.js"></script>

  <script>
    $(document).ready(function() {
      // DO NOT REMOVE : GLOBAL FUNCTIONS!
      pageSetUp();
      var errorClass = 'invalid';
      var errorElement = 'em';
      $("#birthday").datepicker({
        container: '#new-form',
        language: 'th',
        autoclose: true,
        startView: 'decade',
        format: 'dd/mm/yyyy',
      });
      $('button[name=btnsave]').click(function() {
        $('#new-form').submit()
      })
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
      $("#new-form").validate({
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
          gender: {
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
                  return "new";
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
                  return "new";
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
          nick: {
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
          var dataForm = $("#new-form").serialize()
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
                        $.alert({
                          title: 'Successfully!',
                          type: 'green',
                          content: data.Message,
                          backgroundDismiss: true,
                          onClose: function() {
                            window.location.href = "<?= base_url() ?>admin/user/list"
                          },
                        });
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
    });
  </script>

</body>

</html>
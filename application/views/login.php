<!DOCTYPE html>
<html lang="en-us" id="extr-page">

<head>
  <meta charset="utf-8">
  <title>เข้าสู่ระบบ | <?= project_name ?></title>
  <meta name="description" content="">
  <meta name="author" content="">
  <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no">
  <?php include 'templates/admin/style.php'; ?>
</head>

<body class="animated fadeInDown">

  <header id="header">

    <div id="logo-group">
      <span id="logo"><a href="<?= base_url() ?>home"><img style="width: 28px;" src="img/logo_small.png" alt="<?= project_name ?>"></a></span>
    </div>

  </header>

  <div id="main" role="main" style="min-height: 683px;">

    <!-- MAIN CONTENT -->
    <div id="content" class="container">

      <div class="row">
        <div class="col-md-offset-4 col-xs-12 col-sm-12 col-md-5 col-lg-4">
          <div class="well no-padding">
            <form id="LoginForm" method="post" action="admin" style="display: none;">
              <input id="username" type="text" name="user" />
              <input id="password" type="password" name="pass" />
              <input type="password" style="visibility: hidden">
            </form>
            <form id="login-form" action="admin" class="smart-form client-form">
              <header>
                Sign In
              </header>

              <fieldset>

                <section>
                  <label class="label">Username</label>
                  <label class="input"> <i class="icon-append fa fa-user"></i>
                    <input autofocus type="text" name="username" autocomplete="on">
                    <b class="tooltip tooltip-top-right"><i class="fa fa-user txt-color-teal"></i> Please enter username</b></label>
                </section>

                <section>
                  <label class="label">Password</label>
                  <label class="input"> <i class="icon-append fa fa-lock"></i>
                    <input type="password" name="password" autocomplete="on">
                    <b class="tooltip tooltip-top-right"><i class="fa fa-lock txt-color-teal"></i> Enter your password</b> </label>
                  <div class="note">
                    <a href="<?= base_url('/forgotpassword') ?>">Forgot password?</a>
                  </div>
                </section>

                <!-- <section>
                  <label class="checkbox">
                    <input type="checkbox" value="1" name="remember_me" checked="">
                    <i></i>Stay signed in</label>
                </section> -->
              </fieldset>
              <footer>
                <button type="submit" class="btn btn-primary">
                  Sign in
                </button>
              </footer>
            </form>

          </div>

        </div>
      </div>
      <div id="error"></div>
    </div>

  </div>

  <!--================================================== -->

  <?php include 'templates/admin/script.php'; ?>

  <!-- MAIN APP JS FILE -->
  <script type="text/javascript">
    $(function() {
      // Validation
      $("#login-form").validate({
        // Rules for form validation
        rules: {
          email: {
            required: true,
          },
          password: {
            required: true,
            minlength: 6,
            maxlength: 20
          }
        },

        // Messages for form validation
        messages: {
          email: {
            required: 'Please enter your email address',
            email: 'Please enter a VALID email address'
          },
          password: {
            required: 'Please enter your password'
          }
        },

        submitHandler: function() {
          var dataForm = {
            username: $('input[name=username]').val(),
            password: $('input[name=password]').val(),
            remember_me: $('input[name=remember_me]').prop('checked') ? 1 : 0,
          }
          $.post('<?= base_url() ?>login/login', dataForm, function(data) {
              $('#progress').html('')
              if (data.isError && data.Message) {
                $.alert({
                  title: 'Warning!',
                  type: 'red',
                  content: data.Message,
                });
              } else {
                $('#username').val(dataForm.username)
                $('#password').val(dataForm.password)
                $('#LoginForm').submit()
              }
            })
            .error(function(error) {
              console.log('error :', error);
              $('#error').html(error.responseText)
            })
        },

        // Do not change code below
        errorPlacement: function(error, element) {
          error.insertAfter(element.parent());
        }
      });
    });
  </script>

</body>

</html>
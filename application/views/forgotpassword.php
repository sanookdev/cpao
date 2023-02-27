<!DOCTYPE html>
<html lang="en-us" id="extr-page">

<head>
  <meta charset="utf-8">
  <title>ลืมรหัสผ่าน? | <?= project_name ?></title>
  <meta name="description" content="">
  <meta name="author" content="">
  <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no">
  <?php include 'templates/admin/style.php'; ?>

</head>

<body class="animated fadeInDown">

  <header id="header">

    <div id="logo-group">
      <span id="logo"> <img style="width: 28px;" src="img/logo_small.png" alt="<?= project_name ?>"> </span>
    </div>

  </header>

  <div id="main" role="main" style="min-height: 683px;">

    <!-- MAIN CONTENT -->
    <div id="content" class="container">

      <div class="row">
        <div class="col-md-offset-4 col-xs-12 col-sm-12 col-md-5 col-lg-4">
          <span class="label <?= $this->session->flashdata('class') ?>" style="font-size: 16px;"><?= $this->session->flashdata('email_sent') ?></span>
          <div class="well no-padding">
            <form action="<?= base_url('/login/send_forgot_password') ?>" id="login-form" method="post" class="smart-form client-form">
              <header>
                Forgot Password
              </header>
              <fieldset class="">
                <section>
                  <label class="label">Enter your email address</label>
                  <label class="input"> <i class="icon-append fa fa-envelope"></i>
                    <input type="email" name="email">
                    <b class="tooltip tooltip-top-right"><i class="fa fa-envelope txt-color-teal"></i> Please enter email address for password reset</b></label>
                  <div class="note">
                    <a href="<?= base_url('/login') ?>">I remembered my password!</a>
                  </div>
                </section>
              </fieldset>
              <footer>
                <button type="submit" class="btn btn-primary">
                  <i class="fa fa-refresh"></i> Reset Password
                </button>
              </footer>
            </form>

          </div>

        </div>
      </div>
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
          }
        },

        // Messages for form validation
        messages: {
          email: {
            required: 'Please enter your email address',
            email: 'Please enter a VALID email address'
          }
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
<!-- jQuery -->
<script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.1/jquery.min.js"></script>
<script src="https://ajax.googleapis.com/ajax/libs/jqueryui/1.10.3/jquery-ui.min.js"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.5/js/bootstrap.min.js"></script>

<script data-pace-options='{ "restartOnRequestAfter": true }' src="<?= base_url("/_admin/js/plugin/pace/pace.min.js") ?>"></script>

<!-- Bootstrap JavaScript -->
<script src="<?= base_url("/js/common.js") ?>"></script>
<script src="<?= base_url("/js/slick.min.js") ?>"></script>
<script src="<?= base_url("/js/app.js?v=1002") ?>"></script>
<script src="https://cdn.jsdelivr.net/gh/fancyapps/fancybox@3.5.7/dist/jquery.fancybox.min.js"></script>
<script src="<?= base_url("/assets/simplePagination/jquery.simplePagination.js") ?>"></script>
<script>
  $(document).on('click', 'body.navbar-collapse-open', function() {
    $('#menu-collapse .navbar-toggle.close').trigger('click')
  })
  function goToByScroll(id) {
    id = id.replace("link", "");
    $('html,body').animate({
      scrollTop: $("#" + id).offset().top - 70
    }, 'fast');
  }
</script>
<!-- Global site tag (gtag.js) - Google Analytics -->
<script async src="https://www.googletagmanager.com/gtag/js?id=UA-154328786-1"></script>
<script>
  window.dataLayer = window.dataLayer || [];
  function gtag(){dataLayer.push(arguments);}
  gtag('js', new Date());

  gtag('config', 'UA-154328786-1');
</script>

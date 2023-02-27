<!-- PACE LOADER - turn this on if you want ajax loading to show (caution: uses lots of memory on iDevices)-->
<script data-pace-options='{ "restartOnRequestAfter": true }' src="<?=base_url('/_admin/js/plugin/pace/pace.min.js')?>"></script>

<!-- Link to Google CDN's jQuery + jQueryUI; fall back to local -->
<script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.1/jquery.min.js"></script>
<script>
    if (!window.jQuery) {
        document.write('<script src="<?=base_url('/_admin/js/libs/jquery-2.1.1.min.js')?>"><\/script>');
    }
</script>

<script src="https://ajax.googleapis.com/ajax/libs/jqueryui/1.10.3/jquery-ui.min.js"></script>
<script>
    if (!window.jQuery.ui) {
        document.write('<script src="<?=base_url('/_admin/js/libs/jquery-ui-1.10.3.min.js')?>"><\/script>');
    }
</script>

<!-- IMPORTANT: APP CONFIG -->
<script src="<?=base_url('/_admin/js/app.config.js')?>"></script>

<!-- JS TOUCH : include this plugin for mobile drag / drop touch events-->
<script src="<?=base_url('/_admin/js/plugin/jquery-touch/jquery.ui.touch-punch.min.js')?>"></script> 

<!-- BOOTSTRAP JS -->
<script src="<?=base_url('/_admin/js/bootstrap/bootstrap.min.js')?>"></script>

<!-- CUSTOM NOTIFICATION -->
<script src="<?=base_url('/_admin/js/notification/SmartNotification.min.js')?>"></script>

<!-- JARVIS WIDGETS -->
<script src="<?=base_url('/_admin/js/smartwidgets/jarvis.widget.min.js')?>"></script>

<!-- EASY PIE CHARTS -->
<script src="<?=base_url('/_admin/js/plugin/easy-pie-chart/jquery.easy-pie-chart.min.js')?>"></script>

<!-- SPARKLINES -->
<script src="<?=base_url('/_admin/js/plugin/sparkline/jquery.sparkline.min.js')?>"></script>

<!-- JQUERY VALIDATE -->
<script src="<?=base_url('/_admin/js/plugin/jquery-validate/jquery.validate.min.js')?>"></script>

<!-- JQUERY MASKED INPUT -->
<script src="<?=base_url('/_admin/js/plugin/masked-input/jquery.maskedinput.min.js')?>"></script>

<!-- JQUERY SELECT2 INPUT -->
<script src="<?=base_url('/_admin/js/plugin/select2/select2.min.js')?>"></script>

<!-- JQUERY UI + Bootstrap Slider -->
<script src="<?=base_url('/_admin/js/plugin/bootstrap-slider/bootstrap-slider.min.js')?>"></script>

<!-- browser msie issue fix -->
<script src="<?=base_url('/_admin/js/plugin/msie-fix/jquery.mb.browser.min.js')?>"></script>

<!-- FastClick: For mobile devices -->
<script src="<?=base_url('/_admin/js/plugin/fastclick/fastclick.min.js')?>"></script>

<!--[if IE 8]>

<h1>Your browser is out of date, please update your browser by going to www.microsoft.com/download</h1>

<![endif]-->

<!-- MAIN APP JS FILE -->
<script src="<?=base_url('/_admin/js/app.min.js')?>"></script>

<!-- SmartChat UI : plugin -->
<script src="<?=base_url('/_admin/js/smart-chat-ui/smart.chat.ui.min.js')?>"></script>
<script src="<?=base_url('/_admin/js/smart-chat-ui/smart.chat.manager.min.js')?>"></script>

<!-- PAGE RELATED PLUGIN(S) -->

<!-- Flot Chart Plugin: Flot Engine, Flot Resizer, Flot Tooltip -->
<script src="<?=base_url('/_admin/js/plugin/flot/jquery.flot.cust.min.js')?>"></script>
<script src="<?=base_url('/_admin/js/plugin/flot/jquery.flot.resize.min.js')?>"></script>
<script src="<?=base_url('/_admin/js/plugin/flot/jquery.flot.time.min.js')?>"></script>
<script src="<?=base_url('/_admin/js/plugin/flot/jquery.flot.tooltip.min.js')?>"></script>

<!-- Vector Maps Plugin: Vectormap engine, Vectormap language -->
<script src="<?=base_url('/_admin/js/plugin/vectormap/jquery-jvectormap-1.2.2.min.js')?>"></script>
<script src="<?=base_url('/_admin/js/plugin/vectormap/jquery-jvectormap-world-mill-en.js')?>"></script>

<!-- Full Calendar -->
<script src="<?=base_url('/_admin/js/plugin/moment/moment.min.js')?>"></script>
<!-- <script src="<?=base_url('/_admin/js/plugin/fullcalendar/jquery.fullcalendar.min.js')?>"></script> -->

<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-confirm/3.3.2/jquery-confirm.min.js"></script>

<!-- PAGE RELATED PLUGIN(S) -->
<script src="<?=base_url('/_admin/js/plugin/datatables/jquery.dataTables.min.js')?>"></script>
<script src="<?=base_url('/_admin/js/plugin/datatables/dataTables.colVis.min.js')?>"></script>
<script src="<?=base_url('/_admin/js/plugin/datatables/dataTables.tableTools.min.js')?>"></script>
<script src="<?=base_url('/_admin/js/plugin/datatables/dataTables.bootstrap.min.js')?>"></script>
<script src="<?=base_url('/_admin/js/plugin/datatable-responsive/datatables.responsive.min.js')?>"></script>

<script src="<?=base_url('/_admin/js/plugin/bootstrap-datepicker/bootstrap-datepicker.min.j')?>s"></script>
<script src="<?=base_url('/_admin/js/plugin/bootstrap-datepicker/locales/bootstrap-datepicker.th.min.js')?>"></script>

<script src="//cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.js"></script>
<script src="<?=base_url('/_admin/js/plugin/summernote/summernote.min.js')?>"></script>

<script src="https://cdnjs.cloudflare.com/ajax/libs/clipboard.js/2.0.4/clipboard.min.js"></script>

<script>
function Utils() {

}
function pad(n, width, z) {
  z = z || '0';
  n = n + '';
  return n.length >= width ? n : new Array(width - n.length + 1).join(z) + n;
}
Utils.prototype = {
    constructor: Utils,
    isElementInView: function (element, fullyInView) {
        var pageTop = $(window).scrollTop();
        var pageBottom = pageTop + $(window).height();
        var elementTop = $(element).offset().top;
        var elementBottom = elementTop + $(element).height();

        if (fullyInView === true) {
            return ((pageTop < elementTop) && (pageBottom > elementBottom));
        } else {
            return ((elementTop <= pageBottom) && (elementBottom >= pageTop));
        }
    }
};

var Utils = new Utils();
</script>

<?php
defined('BASEPATH') or exit('No direct script access allowed');
?>
<!-- <script>
    alert('1');
</script> -->
<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="utf-8">
  <title><?= $special['setting_value6'] ?></title>
  <meta name="keywords" content="<?= $special['setting_value6'] ?>,อบจ.ชลบุรี,องค์การบริหารส่วนจังหวัด,องค์การบริหารส่วนจังหวัดชลบุรี,จังหวัดชลบุรี,ชลบุรี,chonburi,chonburi provincial,chon">
  <meta name="description" content="<?= $special['setting_value6'] ?> องค์การบริหารส่วนจังหวัดชลบุรี,chonburi provincial administration organization">
  <link rel="stylesheet" href="<?= base_url("/css/custom.css") ?>">
  <link href="<?= base_url("/img/fav.png") ?>" rel="shortcut icon" type="image/vnd.microsoft.icon">

</head>
<?php
$image_info = base_url("/uploads/" . $special['setting_value']);
?>

<body style="text-align: center;background-color: <?= $special['setting_value5'] ?>" cz-shortcut-listen="true" height="100%" width="100%">

  <img alt="<?= $special['setting_value6'] ?>" width="<?= $image_info[0] ?>" height="<?= $image_info[1] ?>" src="<?= base_url("/uploads/" . $special['setting_value']) ?>" usemap="#event" />
  <map name="event" id="event">
    <?php
    $rect = json_decode($special['setting_value4'], true);
    foreach ($rect as $coor) {
      $c = $coor['x'] . ',' . $coor['y'] . ',' . ($coor['x'] + $coor['width']) . ',' . ($coor['y'] + $coor['height']);
      echo '<area shape="rect" coords="' . $c . '"  href="' . base_url('/home') . '" target="_self">';
    }
    ?>
  </map>
  <script data-pace-options='{ "restartOnRequestAfter": true }' src="<?= base_url("/_admin/js/plugin/pace/pace.min.js") ?>"></script>

</body>

</html>
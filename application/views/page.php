<?php
defined('BASEPATH') or exit('No direct script access allowed');
?>
<!DOCTYPE html>
<html lang="en" data-brk-skin="brk-blue.css">

<head>
    <meta charset="utf-8">
    <title><?= $page['menu_title'] ?> | <?= $web_name ?></title>
    <meta name="keywords"
        content="<?= $page['menu_title'] ?>,อบจ.ชลบุรี,องค์การบริหารส่วนจังหวัด,องค์การบริหารส่วนจังหวัดชลบุรี,จังหวัดชลบุรี,ชลบุรี,chonburi,chonburi provincial,chon">
    <meta name="description"
        content="<?= $page['menu_title'] ?>,องค์การบริหารส่วนจังหวัดชลบุรี,chonburi provincial administration organization">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <?php include 'templates/user/style.php'; ?>
    <link href="https://cdnjs.cloudflare.com/ajax/libs/jqueryui/1.12.1/jquery-ui.min.css" media="all" rel="stylesheet"
        type="text/css" />

</head>

<body class="layout-full" cz-shortcut-listen="true">
    <div class="wrapper">
        <!-- Header -->
        <?php include 'templates/user/header_primary.php'; ?>

        <section class="main-content">
            <div class="container">
                <div class="row">
                    <div class="content content-right clearfix col-sm-8 col-sm-push-4 col-md-9 col-md-push-3">
                        <div class="row">
                            <div class="module-breadcrumb col-sm-12">
                                <ul class="breadcrumb">
                                    <li><a href="<?= base_url('/home') ?>">หน้าแรก</a></li>
                                    <li class="active">
                                        <span><a class="active"
                                                href="<?= base_url('/page/') ?><?= $page['menu_url'] ?>"><?= $page['menu_title'] ?></a></span>
                                    </li>
                                </ul>
                            </div>
                            <section class="module-gallery list-content col-sm-12">

                                <div class="page-header">
                                    <div class="title"><?= $page['page_title'] ?></div>
                                </div>

                                <div class="clearfix">
                                    <div class="col-xs-12 pannel-sm-head">
                                        <!-- ตัดวันที่สร้างหัวเรื่องออก อัพเดต 22-07-2565  -->
                                        <!-- <i class="fa fa-clock-o"></i> เผยแพร่วันที่ :  -->
                                        <?
                    // $page['page_mod_date'] 
                    ?>
                                    </div>
                                </div>

                                <div class="item-content gallery-content">
                                    <?php
                  if ($page['page_type'] == 'custom') {
                    echo $page['page_detail'];
                  } else {
                  ?>
                                    <form class="col col-4">
                                        <input type="text" class="form-control" name="q"
                                            value="<?= isset($_GET['q']) ? $_GET['q'] : '' ?>" placeholder="Search">
                                    </form>
                                    <ol class="breadcrumb mt-2">
                                        <?php
                      echo '<li><a href="' . base_url() . 'page/' . $url . '">ศูนย์ข้อมูลลข่าวสาร</a></li>';
                      if (isset($path)) {
                        foreach ($path as $row) {
                          echo '<li><a href="' . base_url() . "page/$url/" . $row['cat_id'] . '/1">' . $row['cat_title'] . '</a></li>';
                        }
                      }
                      ?>
                                    </ol>
                                    <table id="table" name="folder"
                                        class="table table-striped table-bordered table-hover" width="100%">
                                        <tbody id="body-data">
                                            <?php
                        if (isset($folder) && count($folder) > 0) {
                          foreach ($folder as $row) {
                            if ($row['type'] == 'folder') {
                              $parent = isset($row['p_cat_title']) ? '<small> / ' . $row['p_cat_title'] . '</small>' : '';
                              echo '<tr><td colSpan="2"><a ' . ($row['cat_href'] != null && $row['cat_href'] != '' ? 'target="_blank"' : '') . ' href="' . (($row['cat_href'] != null && $row['cat_href'] != '') ? $row['cat_href'] : base_url() . "page/$url/" . $row['cat_id'] . '/1/' . $row['cat_alias']) . '"><i style="color:#F4C082;" class="fas fa-2x fa-folder-open"></i> ' . $row['cat_title'] . '</a>' . $parent . '</td>
                                    <td>' . ($row['count_sub_folder'] != 0 ? $row['count_sub_folder'] . ' โฟลเดอร์' : '') . ($row['size'] != 0 && $row['count_sub_folder'] != 0 ? ' | ' : '') . ($row['size'] != 0 ? $row['size'] . ' ไฟล์' : '') . '</td></tr>';
                            } else if ($row['type'] == 'file') {
                              $parent = isset($row['cat_title']) ? '<small> / ' . $row['cat_title'] . '</small>' : '';
                              $ext = pathinfo($row['url_download'], PATHINFO_EXTENSION);
                              $icon = '';
                              switch ($ext) {
                                case "pdf":
                                  $icon = '<i class="fa fa-2x fa-file-pdf-o text-danger" aria-hidden="true"></i> ';
                                  break;
                                case "docx":
                                case "doc":
                                  $icon = '<i class="fa fa-2x fa-file-word-o text-primary" aria-hidden="true"></i> ';
                                  break;
                                case "ppt":
                                case "pptx":
                                  $icon = '<i class="fa fa-2x fa-file-powerpoint-o text-danger" aria-hidden="true"></i> ';
                                  break;
                                case "xls":
                                case "xlsx":
                                  $icon = '<i class="fa fa-2x fa-file-excel-o text-success" aria-hidden="true"></i> ';
                                  break;
                                case "gif":
                                case "jpg":
                                case "jpeg":
                                case "png":
                                  $icon = '<i class="fa fa-2x fa-file-image-o text-danger" aria-hidden="true"></i> ';
                                  break;
                                case "rar":
                                case "zip":
                                case "7z":
                                  $icon = '<i class="fa fa-2x fa-file-archive-o text-waring" aria-hidden="true"></i> ';
                                  break;
                                default:
                                  $icon = '<i class="fa fa-2x fa-file-o" aria-hidden="true"></i> ';
                              }
                              echo '<tr><td><a href="' . base_url() . "file/$url/" . $row['file_id'] . '/' .  preg_replace('/\(|\)/', '-', $row['file_alias']) . '">' . $icon . $row['file_title'] . '</a>'.$parent.'</td><td style="min-width: 100px;">' . $row['date_added'] . '</td><td>' . $row['size'] . '</td></tr>';
                            }
                          }
                        } else {
                          echo '<div class="no-data">ไม่พบข้อมูล</div>';
                        }
                        ?>
                                        </tbody>
                                    </table>
                                    <?php   } ?>
                                </div>
                            </section>
                        </div>
                        <div class="row">
                            <div class="col-xs-6 text-center">
                                <?php
                if (isset($next)) { ?>
                                <a
                                    href="<?= base_url('/news/') ?><?= $next['news_id'] ?>/topic/<?= $next['news_url'] ?>">
                                    < ใหม่กว่า</a> <?php       }
                                    ?>
                            </div>
                            <div class="col-xs-6 text-center">
                                <?php
                if (isset($prev)) { ?>
                                <a
                                    href="<?= base_url('/news/') ?><?= $prev['news_id'] ?>/topic/<?= $prev['news_url'] ?>">เก่ากว่า
                                    ></a>
                                <?php       }
                ?>
                            </div>
                        </div>
                    </div>


                    <!-- sidebar-left -->
                    <?php include 'templates/user/sidebar-left.php'; ?>

                </div>
            </div>
        </section>

        <a href="#" class="back-to-top"></a>

        <!-- parthner -->
        <?php include 'templates/user/parthner.php'; ?>

        <?php include 'templates/user/footer.php'; ?>

    </div>

    <?php include 'templates/user/script.php'; ?>

</body>

</html>
<?php
defined('BASEPATH') or exit('No direct script access allowed');
?>
<!DOCTYPE html>
<html lang="en" data-brk-skin="brk-blue.css">

<head>
    <meta charset="utf-8">
    <title><?= $news['news_title'] ?> | <?= $web_name ?></title>
    <meta name="keywords" content="<?= $news['news_title'] ?>,อบจ.ชลบุรี,องค์การบริหารส่วนจังหวัด,องค์การบริหารส่วนจังหวัดชลบุรี,จังหวัดชลบุรี,ชลบุรี,chonburi,chonburi provincial,chon">
    <meta name="description" content="<?= $news['news_title'] ?>,องค์การบริหารส่วนจังหวัดชลบุรี,chonburi provincial administration organization">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <?php include 'templates/user/style.php'; ?>

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
                                        <span><a class="active" href="<?= base_url('/cate/') ?><?= $news['category_url'] ?>"><?= $news['category_name'] ?></a></span>
                                    </li>
                                </ul>
                            </div>
                            <section class="module-gallery list-content col-sm-12">

                                <div class="page-header">
                                    <h2 class="title"><?= $news['news_title'] ?></h2>
                                </div>

                                <div class="clearfix">
                                    <div class="col-xs-12 pannel-sm-head">
                                        เขียนโดย <?= $news['nick'] ?> <i class="fa fa-clock-o"></i> เผยแพร่วันที่ : <?= $news['public_date'] ?> </div>
                                    <div class="clearfix text-center">
                                        <?php
                                        if ($news['news_cover'] != null && $news['news_cover'] != '') { ?>
                                            <div id="lightgallery">
                                                <a data-fancybox="gallery" href="<?= base_url('/uploads/') ?><?= $news['news_cover'] ?>">
                                                    <img src="<?= base_url('/uploads/') ?><?= $news['news_cover'] ?>">
                                                </a>
                                            </div>
                                        <?php    }
                                        ?>
                                    </div>
                                </div>

                                <div class="item-content gallery-content mt-3">
                                    <?= $news['news_detail'] ?>
                                </div>
                                <?php
                                if (count($news['images']) > 0) {
                                    echo '<div class="col-xs-12"><p class="title">รูปภาพประกอบ</p>';
                                    echo '<div class="row">';
                                    $i = 0;
                                    foreach ($news['images'] as $img) {
                                        echo '<div class="col-lg-3 col-xs-3 mb-1"><a data-fancybox="gallery" href="' . base_url('/uploads/') . $img['image_path'] . '"><img src="' . base_url('/uploads/') . $img['image_path'] . '" /></a></div>';
                                        $i += 1;
                                        if ($i > 0 && $i % 4 == 0) {
                                            echo '<div class="clearfix"></div>';
                                        }
                                    }
                                    echo '</div></div>';
                                }
                                ?>
                                <?php
                                if (count($news['attachment']) > 0) {
                                    echo '<div class="col-xs-12"><p class="title">ไฟล์แนบ</p>';
                                    echo '<ul>';
                                    foreach ($news['attachment'] as $file) {
                                        $ext = pathinfo($file['attach_path'], PATHINFO_EXTENSION);
                                        echo '<li>';
                                        switch ($ext) {
                                            case "pdf":
                                                echo '<i class="fa fa-file-pdf-o text-danger" aria-hidden="true"></i> ';
                                                break;
                                            case "docx":
                                            case "doc":
                                                echo '<i class="fa fa-file-word-o text-primary" aria-hidden="true"></i> ';
                                                break;
                                            case "ppt":
                                            case "pptx":
                                                echo '<i class="fa fa-file-powerpoint-o text-danger" aria-hidden="true"></i> ';
                                                break;
                                            case "xls":
                                            case "xlsx":
                                                echo '<i class="fa fa-file-excel-o text-success" aria-hidden="true"></i> ';
                                                break;
                                            case "gif":
                                            case "jpg":
                                            case "jpeg":
                                            case "png":
                                                echo '<i class="fa fa-file-image-o text-danger" aria-hidden="true"></i> ';
                                                break;
                                            default:
                                                echo '<i class="fa fa-file-o" aria-hidden="true"></i> ';
                                        }
                                        echo '<a href="' . base_url('/uploads/') . $file['attach_path'] . '">' . (($file['attach_title']) ? $file['attach_title'] : basename($file['attach_path'])) . '</a></li>';
                                    }
                                    echo '</ul></div>';
                                }
                                ?>
                            </section>
                        </div>
                        <div class="row">
                            <div class="col-xs-6 text-center">
                                <?php
                                if (isset($next)) { ?>
                                    <a href="<?= base_url('/news/') ?><?= $next['news_id'] ?>/topic/<?= $next['news_url'] ?>">
                                        < ใหม่กว่า</a> <?php       }
                                                        ?> </div> <div class="col-xs-6 text-center">
                                            <?php
                                            if (isset($prev)) { ?>
                                                <a href="<?= base_url('/news/') ?><?= $prev['news_id'] ?>/topic/<?= $prev['news_url'] ?>">เก่ากว่า ></a>
                                            <?php       }
                                            ?></div>
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
<?php
defined('BASEPATH') or exit('No direct script access allowed');
?>
<!DOCTYPE html>
<html lang="en" data-brk-skin="brk-blue.css">

<head>
    <meta charset="utf-8">
    <title><?= $web_name ?></title>
    <meta name="keywords" content="อบจ.ชลบุรี,องค์การบริหารส่วนจังหวัด,องค์การบริหารส่วนจังหวัดชลบุรี,จังหวัดชลบุรี,ชลบุรี,chonburi,chonburi provincial,chon">
    <meta name="description" content="องค์การบริหารส่วนจังหวัดชลบุรี,chonburi provincial administration organization">
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
                                    <li><a title="หน้าแรก" href="<?= base_url('/home') ?>">หน้าแรก</a></li>
                                    <li class="active">
                                        <span><a title="poll" class="active" href="<?= base_url('/poll/result') ?>">ผลการสำรวจ</a></span>
                                    </li>
                                </ul>
                            </div>
                            <section class="module-gallery list-content col-sm-12">
                                <?php
                                foreach ($result as $poll) { ?>
                                    <div class="card-new full" style="margin-bottom: 20px; margin-top: 20px;">
                                        <div class="strip"></div>
                                        <div class="card-body">
                                            <h3 class="card-title"><?= $poll['poll_name'] ?></h3>
                                            <p class="card-text"><?= $poll['title_result'] ?></p>
                                            <?php
                                            $total = 0;
                                            $title_result = '';
                                            foreach ($poll['topic'] as $key => $topic) {
                                            ?>
                                                <div class="panel-body" style="margin:0px;">
                                                    <div id="Main">
                                                        <p><?= $topic['title_result'] ?></p>
                                                        <?php
                                                        foreach ($topic['detail'] as $detail) { ?>
                                                            <a name="poll_bar"><?= $detail['detail_result'] ?> </a> <span name="poll_val"><?= number_format($detail['count'] / $topic['total'] * 100, 2) ?>% </span><br />
                                                        <?php
                                                        }
                                                        ?>
                                                    </div>
                                                </div>
                                            <?php
                                            }
                                            ?>
                                        </div>
                                        <a href="<?= base_url() ?>poll" class="btn btn-primary">ทำแบบสอบถาม</a>
                                    </div>
                                <?php
                                }
                                ?>
                            </section>
                        </div>
                    </div>

                    <!-- sidebar-left -->
                    <?php include 'templates/user/sidebar-left.php'; ?>

                </div>
            </div>
        </section>
        <div id="cover-spin" style="display: none;"></div>
        <a href="#" class="back-to-top"></a>

        <!-- parthner -->
        <?php include 'templates/user/parthner.php'; ?>
        <?php include 'templates/user/footer.php'; ?>

    </div>

    <?php include 'templates/user/script.php'; ?>

    <script>
        $(function() {
            $("[name='poll_bar'").addClass("btn btn-default");
            // Add button style with alignment to left with margin.
            $("[name='poll_bar'").css({
                "text-align": "left",
                "margin": "5px"
            });

            //loop 
            $("[name='poll_bar'").each(
                function(i) {
                    //get poll value 	
                    var bar_width = (parseFloat($("[name='poll_val'").eq(i).text().replace('%', '') / 2)).toString();
                    var bar_width_rule = parseFloat($("[name='poll_val'").eq(i).text());
                    bar_width = bar_width + "%"; //add percentage sign.										
                    //set bar button width as per poll value mention in span.
                    if (bar_width_rule > 10) {
                        $("[name='poll_bar'").eq(i).css('width', bar_width)
                    }
                    //Define rules.
                    if (bar_width_rule >= 50) {
                        $("[name='poll_bar'").eq(i).addClass("btn btn-sm btn-success")
                    }
                    if (bar_width_rule < 50) {
                        $("[name='poll_bar'").eq(i).addClass("btn btn-sm btn-warning")
                    }
                    if (bar_width_rule <= 10) {
                        $("[name='poll_bar'").eq(i).addClass("btn btn-sm btn-danger")
                    }

                    //Hide dril down divs
                    $("#" + $("[name='poll_bar'").eq(i).text()).hide();
                });
        })
    </script>

</body>

</html>
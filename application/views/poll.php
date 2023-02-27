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
    <link rel="stylesheet" type="text/css" href="<?= base_url("/assets/td-message-master/td-message.css") ?>">
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
                                        <span><a title="poll" class="active" href="<?= base_url('/poll/') ?>">แบบสำรวจ</a></span>
                                    </li>
                                </ul>
                            </div>
                            <section class="module-gallery list-content col-sm-12">
                                <form id="form-poll">
                                    <div class="card-new full" style="margin-bottom: 20px; margin-top: 20px;">
                                        <div class="strip"></div>
                                        <div class="card-body">
                                            <h3 class="card-title"><?= $poll['poll']['poll_name'] ?></h3>
                                            <p class="card-text"><?= $poll['poll']['detail'] ?></p>
                                        </div>
                                    </div>
                                    <?php
                                    foreach ($poll['topic'] as $topic) { ?>
                                        <div class="poll card-new full" style="margin-bottom: 20px; margin-top: 20px;">
                                            <div class="strip"></div>
                                            <div class="card-body">
                                                <h3 class="card-title"><?= $topic['poll_topic_name'] ?></h3>
                                                <p class="card-text"><?= $topic['poll_topic_remark'] ?></p>
                                                <?php
                                                if ($topic['is_comment'] == 1) {
                                                    echo '<div style="padding: 8px 12px;"><textarea placeholder="คำตอบของคุณ" name="' . $topic['poll_topic_id'] . '"></textarea></div>';
                                                    continue;
                                                }
                                                foreach ($topic['detail'] as $detail) {
                                                ?>
                                                    <div class="radio">
                                                        <label>
                                                            <input required value="<?= $detail['poll_topic_detail_id'] ?>" type="radio" name="<?= $topic['poll_topic_id'] ?>">
                                                            <?= $detail['poll_detail_name'] ?>
                                                        </label>
                                                    </div>
                                                <?php
                                                }
                                                ?>
                                            </div>
                                        </div>
                                    <?php
                                    }
                                    ?>
                                    <button id="submit" class="btn btn-primary">ยืนยันส่งแบบสำรวจ</button>
                                </form>
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
    <script src="<?= base_url("/assets/td-message-master/td-message.min.js") ?>"></script>

    <script>
        function increment(id) {
            let self = this
            $.get(`<?= base_url() ?>News/increment?id=${id}`, function() {})
        }
        $(function() {

            $(document).on('submit', '#form-poll', function(e) {
                e.preventDefault();
                $('#submit').prop('disabled', true)
                var dataForm = $('#form-poll').serializeArray();
                $('#submit').html('<i class="fa fa-spinner fa-spin" /> ยืนยันส่งแบบสำรวจ')
                $.post("<?= base_url() ?>Poll/save", {
                    poll_id: '<?= $poll['poll']['poll_id'] ?>',
                    data: dataForm
                }, function(data) {
                    $('#submit').html('ยืนยันส่งแบบสำรวจ')
                    if (data.success) {
                        $.message({
                            type: "success",
                            text: data.message,
                            duration: 2000,
                            onClose: () => {
                                window.location.href = "<?= base_url() ?>poll/result"
                            }
                        });
                    } else {
                        $('#submit').prop('disabled', false)
                        $.message({
                            type: "warning",
                            text: data.message,
                            duration: 5000,
                        });
                    }
                }).fail(err => {
                    $('#submit').html('ยืนยันส่งแบบสำรวจ')
                    $('#submit').prop('disabled', false)
                    $.message({
                        type: "error",
                        text: 'เกิดข้อผิดพลาด กรุณาติดต่อเจ้าหน้าที่',
                        duration: 2000,
                    });
                })
            });

        })
    </script>

</body>

</html>
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
                    <span><a title="<?= $cate['category_name'] ?>" class="active" href="<?= base_url('/cate/') ?><?= $cate['category_url'] ?>"><?= $cate['category_name'] ?></a></span>
                  </li>
                </ul>
              </div>
              <section class="module-gallery list-content col-sm-12">
                <div class="page-header">
                  <div class="title"><?= $cate['category_name'] ?></div>
                </div>

                <div class="item-content gallery-content">
                  <form class="col col-4">
                    <input type="text" class="form-control" name="q" value="<?= isset($_GET['q']) ? $_GET['q'] : '' ?>" placeholder="Search">
                  </form>
                  <table class="table table-hover" width="100%" id="newsdla">
                    <thead>
                      <tr>
                        <th>หัวข้อ</th>
                        <th>ผู้เขียน</th>
                        <th class="text-center w-110p">วันที่เผยแพร่</th>
                        <th class="text-center w-110p">จำนวนคนดู</th>
                      </tr>
                    </thead>
                    <tbody id="list">
                      <?php
                      foreach ($list as $row) {
                        if ($row['news_type'] == 'link') {
                          $link = $row['news_detail'];
                        } else {
                          $link = base_url('/news/') . $row['news_id'] . '/topic/' . $row['news_url'];
                        }
                        echo '<tr>
                                <td><a '.($row['news_type'] == 'link' ? 'onclick="increment('.$row['news_id'].')"' : '').' ' . ($row['news_type'] == 'link' ? 'target="_blank"' : '') . ' title="' . $row['news_title'] . '" href="' . $link . '">' . $row['news_title'] . '</a></td>
                                <td>' . $row['nick'] . '</td>
                                <td class="text-center">' . $row['public_date'] . '</td>
                                <td class="text-center">' . $row['views'] . '</td>
                              </tr>';
                      }
                      ?>
                    </tbody>
                  </table>
                  <div id="no-data"><?=(count($list) == 0 ? '<div class="no-data">ไม่พบข้อมูล</div>' : '')?></div>
                  <div class="page-nav p-3">
                  </div>
                </div>
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
    function increment(id) {
      let self = this
      $.get(`<?= base_url() ?>News/increment?id=${id}`, function() {
      })
    }
    $(function() {
      var itemOnPage = <?= $itemOnPage ?>;
      var cate_id = <?= $cate['category_id'] ?>;
      var page = window.location.hash.substr(1).replace('page-', '') || 1
      var loadData = function() {
        $('#cover-spin').show(1)
        $.get('<?= base_url() ?>CategoryNews/load_news?page=' + page + '&category_id=' + cate_id, function(data) {
          $('#cover-spin').hide(0)
          var html = ''
          if (data.list.length == 0) {
            html = '<div class="no-data">ไม่พบข้อมูล</div>'
            $('#list').html('')
            $('#no-data').html(html)
            return
          }
          data.list.forEach(function(item, index) {
            html += `<tr>
                        <td><a title="${item.news_title}" href="<?= base_url('/news/') ?>${item.news_id}/topic/${item.news_url}">${item.news_title}</a></td>
                        <td>${item.nick || ''}</td>
                        <td class="text-center">${item.public_date}</td>
                        <td class="text-center">${item.views}</td>
                    </tr>`
          })
          $('#no-data').html('')
          $('#list').html(html)
        })
      }
      $('.page-nav').pagination({
        items: <?= $total_page ?>,
        itemOnPage: itemOnPage,
        currentPage: page,
        cssStyle: 'light-theme',
        onInit: function() {

        },
        onPageClick: function(p, evt) {
          page = p
        }
      });
      if (page != 1) {
        loadData()
      }
      $(window).on('hashchange', function() {
        page = window.location.hash.substr(1).replace('page-', '') || 1
        loadData()
      });
    })
  </script>

</body>

</html>
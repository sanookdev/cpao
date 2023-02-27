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

  <style>
    /* Container holding the image and the text */
      .container-fluid {
        position: relative;
        text-align: center;
        color: white;
      }
      /* Centered text */
      .centered {
        text-align: center;
              position: absolute;
              top: 50%;
              left: 50%;
              transform: translate(-50%, -50%);
              color: white;
      }
      p.countdown {
              text-align: center;
              font-size: 300%;
              color: aquamarine;
              -webkit-text-stroke-width: 0.2px;
              -webkit-text-stroke-color: white;
      }
      mark.red {
      color: red;
      background: none;
      font-size: 180%;
      -webkit-text-stroke-width: 0.3px;
      -webkit-text-stroke-color: white;
      }
      mark.white{
        color: white;
        background:none;
        font-size:150%;
        -webkit-text-stroke-width: 0.5px;
        -webkit-text-stroke-color: black;
      }
      mark.black{
        color: black;
        background:none;
        font-size:150%;
        -webkit-text-stroke-width: 0.3px;
        -webkit-text-stroke-color: white;
      }
      .c-graidient {
          background: #000;
          background: -moz-linear-gradient(-45deg, #000000 0%, #000000 25%, #1e539e 50%, #ff3083 75%, #7800a8 100%);
          /* FF3.6-15 */
          background: -webkit-linear-gradient(-45deg, #000000 0%, #000000 25%, #1e539e 50%, #ff3083 75%, #7800a8 100%);
          /* Chrome10-25,Safari5.1-6 */
          background: linear-gradient(135deg, #000000 0%, #000000 25%, #1e539e 50%, #ff3083 75%, #7800a8 100%);
          /* W3C, IE10+, FF16+, Chrome26+, Opera12+, Safari7+ */
          background-size: 400% 400%;
          background-repeat: no-repeat;
          display: flex;
          /* width: 500px;
          height: 500px; */
          max-width: 100vw;
          max-height: 100vh;
          justify-content: center;
          align-items: center;
          color: aquamarine;
          position: relative;
          /* cursor: pointer; */
          transition: .5s all;
        }
        .c-graidient__img {
          position: absolute;
          background: #000 url(https://chon.go.th/cpao/uploads/bg_chon.jpg);
          background-size: cover;
          width: 100%;
          height: 100%;
          opacity: .4;
          mix-blend-mode: screen;
          margin-left:10px;
          margin-right:10px;
        }
        .c-graidient__title {
          position: relative;
          z-index: 10;
          text-transform: uppercase;
          letter-spacing: .05em;
        }
        a.cd:hover,a.cd:focus{
          color:orangered!important;text-decoration:none;
          -webkit-text-stroke-width: 0.5px;
        -webkit-text-stroke-color: white;
          
        }
/* .c-graidient:hover {
  background-position: 100% 100%;
} */
/* .c-graidient:hover__title {
  text-shadow: 0 0 20px black;
} */
  </style>

</head>

<body class="layout-full" cz-shortcut-listen="true">

  <div class="wrapper">
    <!-- Header -->
    <?php include 'templates/user/header_primary.php'; ?>

    <!-- ภาพสไลด์ใหญ่ -->
    <?php
    if (isset($cover)) { ?>
      <section class="hero-banner">
        <div class="site-cover-bg">
          <?php
            foreach ($cover as $img) {
              if ($img['setting_value2'] == '') {
                echo '<img alt="' . $img['setting_value3'] . '" src="' . base_url('/uploads/' . $img['setting_value']) . '" class="img-responsive w-100">';
              } else {
                echo '<a target="_blank" href="'. $img['setting_value2'] .'"><img alt="' . $img['setting_value3'] . '" src="' . base_url('/uploads/' . $img['setting_value']) . '" class="img-responsive w-100"></a>';
              }
            }
            ?>
        </div>
      </section>
    <?php       }
    ?>


    <section class="main-content">
      <div class="container">
        <div class="row">
          <!-- sidebar-left -->
          <?php include 'templates/user/sidebar-left.php'; ?>

          <div class="content content-right clearfix col-sm-8  col-md-9 <?=($this->uri->segment(1) == 'home' || $this->uri->segment(1) == '' ? '' : 'col-md-push-3 col-sm-push-4')?>">
            <div class="row">
              <?php
              if (isset($cate)) { ?>
                <section class="full section-gallery section-1">
                  <div class="col-sm-12">
                    <div class="tab3 wrap" id="list">
                      <?php
                        $grid = '';
                        foreach ($cate as $row) {
                          $grid .= '1fr ';
                        }
                        ?>
                      <ul class="nav-grid" style="grid-template-columns: <?= $grid ?>">
                        <?php
                          $i = 0;
                          foreach ($cate as $row) {
                            if ($i == 0) {
                              echo '<li class="nav-grid-items text-center active">';
                            } else {
                              echo '<li class="nav-grid-items text-center">';
                            }
                            $i += 1;
                            echo '<a title="' . $row['category_name'] . '" href="#cate' . $row['category_id'] . '" data-toggle="tab">' . $row['category_name'] . '</a></li>';
                          }
                          ?>
                        <li class="active-grid-circle">
                          <div id="active-nav-grid-item" class="nav-circle grid-item-active">
                          </div>
                        </li>
                      </ul>
                      <div class="tab-content clearfix">
                        <?php
                          $i = 0;
                          foreach ($cate as $row) { ?>
                          <div class="tab-pane<?= ($i == 0) ? ' active' : '' ?>" id="cate<?= $row['category_id'] ?>">
                            <div class="row">
                              <div class="col-xs-12">
                                <div class="module-gallery list-album w-100" id="data-<?= $row['category_id'] ?>">
                                  <?php
                                      if ($row['is_image'] == 0) {
                                        echo '<table border="0" width="100%" id="newsdla">
                                                <tbody>';
                                      }
                                      if (count($row['list']) == 0) {
                                        echo '<div class="no-data">ไม่พบข้อมูล</div>';
                                      }
                                      foreach ($row['list'] as $news) {
                                        if ($row['is_image'] == 0) {
                                          echo '<tr>
                                                  <td width="100" align="center" class="date-dashed" valign="top">
                                                      <div class="bumf-date">' . date_format(date_create($news['public_date']), 'd/m/Y') . '</div>
                                                  </td>
                                                  <td class="date-dashed">
                                                      <div align="left"><a title="' . $news['news_title'] . '" href="' . base_url('/news/') . $news['news_id'] . '/topic/' . $news['news_url'] . '" class="title">' . $news['news_title'] . '</a><br>';
                                          foreach ($news['attachment'] as $att) {
                                            echo '<a title="' . $news['news_title'] . '" href="' . base_url('/uploads/' . $att['attach_path']) . '" target="_blank" class="title-file">[' . (($att['attach_title']) ? $att['attach_title'] : basename($att['attach_path']))  . ']</a>&nbsp;';
                                          }
                                          echo '</div></td>
                                                </tr>';
                                        } else {
                                          echo '<div class="col-xs-6 col-sm-6  col-md-4">
                                                    <div class="card thumbnail">
                                                        <a title="' . $news['news_title'] . '" href="' . base_url('/news/') . $news['news_id'] . '/topic/' . $news['news_url'] . '" class="item-image">
                                                            <img onError="this.src=\'' . base_url('/img/placeholder.jpg') . '\';" src="' . base_url('/uploads/' . $news['news_cover']) . '" alt="' . $news['news_title'] . '" class="img-thumb">
                                                        </a>
                                                        <div class="caption">
                                                            <a title="' . $news['news_title'] . '" href="' . base_url('/news/') . $news['news_id'] . '/topic/' . $news['news_url'] . '" class="title">
                                                            ' . $news['news_title'] . '</a>
                                                        </div>
                                                    </div>
                                                </div>';
                                        }
                                      }
                                      if ($row['is_image'] == 0) {
                                        echo '</tbody>
                                            </table>';
                                      }
                                      echo '</div>';
                                      echo '<div class="p-3 col-md-10 col-sm-10 col-xs-9 page-nav-' . $row['category_id'] . '"></div>';
                                      echo '<div class="col-md-2 col-sm-2 col-xs-3 line-56"><div class="pull-right"><a title="ดูทั้งหมด" href="' . base_url('/cate/' . $row['category_url']) . '">ดูทั้งหมด</a></div></div>';
                                      ?>
                                </div>
                              </div>
                            </div>
                          <?php $i += 1;
                            }
                            ?>

                          </div>
                      </div>
                    </div>
                </section>
              <?php       }
              ?>

              <?php
              if (isset($event)) { ?>
                <section class="full section-event section-6">
                  <div class="col-sm-12">
                    <section class="module-page">
                      <div class="page-header">
                        <div class="title">สื่อประชาสัมพันธ์ อบจ.ชลบุรี</div>
                      </div>
                      <div class="row">
                        <?php
                          $row_cal = 0;
                          foreach ($event as $row) {
                            $class = "";
                            if ($row['setting_value2'] == '12') {
                              $class = "w-h-100";
                              $row_cal = 0;
                            } else if ($row_cal % 12 == 0) {
                              $row_cal = 0;
                              $class = "float-left";
                            }
                            $row_cal += (int) $row['setting_value2'];
                            if ($class == '' && $row_cal % 12 == 0) {
                              $class = "float-right ";
                            }
                            if ($row['setting_value4'] == '') {
                              echo '<div class="col-md-' . $row['setting_value2'] . ' text-center">
                                        <img class="notice ' . $class . '" alt="' . $row['setting_value3'] . '" src="' . base_url('/uploads/' . $row['setting_value']) . '">
                                    </div>';
                            } else {
                              echo '<div class="col-md-' . $row['setting_value2'] . ' text-center">
                                        <a title="' . $row['setting_value3'] . '" target="_blank" href="' . $row['setting_value4'] . '">
                                          <img class="notice ' . $class . '" alt="' . $row['setting_value3'] . '" src="' . base_url('/uploads/' . $row['setting_value']) . '">
                                        </a>
                                    </div>';
                            }
                          }
                          ?>
                      </div>
                    </section>
                  </div>
                </section>
                <!-- ตัวหนังสือวิ่งและภาพสไลด์เล็กๆ -->
              <section class="full section-banner section-6">

                <div class="col-sm-12">
                  <section class="module-banner">
                    <div class="page-header">
                      <div class="col-sm-12">
                        <div class="title text-center">
                          ประชาสัมพันธ์ อบจ.ชลบุรี (Facebook)
                          <!-- <marquee direction="left" style="width:100%;" scrollamount="1" scrolldelay="25" truespeed="true"><?= $title_welcome ?></marquee> -->
                        </div>
                      </div>
                    </div>
                    <?php
                    if (isset($facebook)) { ?>
                      <div class="text-center mb-1">
                        <iframe src="https://www.facebook.com/plugins/page.php?href=<?= $facebook ?>&amp;tabs=timeline&amp;width=800&amp;height=300&amp;small_header=&amp;adapt_container_width=true&amp;hide_cover=&amp;show_facepile=&amp;appId=267791366593789" scrolling="no" allowtransparency="true" width="500" height="300" frameborder="0"></iframe>
                      </div>
                    <?php    }
                    ?>

                  </section>
                </div>
              </section>
              <?php        }
              ?>
              <?php
              if (isset($how_to_process)) { ?>
                <section class="full section-event section-6">
                  <div class="col-sm-12">
                    <section class="module-page">
                      <div class="page-header">
                        <div class="title">กระบวนการร้องเรียนร้องทุกข์</div>
                      </div>
                      <div class="row">
                        <div class="col-sm-12">
                          <img class="w-h-100" alt="กระบวนการร้องเรียนร้องทุกข์" src="<?= base_url('/uploads/' . $how_to_process) ?>">
                        </div>
                      </div>
                    </section>
                  </div>
                </section>

                
              <?php         }
              ?>


              <section class="full section-event section-6">
                <div class="col-sm-12">
                  <section class="module-page">
                    <div class="page-header">
                      <div class="title">ข่าวสารภายนอก</div>
                    </div>
                    <div class="row">
                      <div class="col-md-4">
                        <iframe class="pttplc" src="https://www.pttor.com/oilprice-board.aspx" width="100%" height="420" scrolling="no" frameborder="0" class="wrapperart-nostyle">
                        </iframe>
                      </div>
                      <div class="col-md-4">
                        <iframe class="bangchak" src="https://www.bangchak.co.th/oilprice.html" width="100%" height="359" scrolling="no" frameborder="0" class="wrapperart-nostyle">
                        </iframe>
                      </div>
                      <div class="col-md-4">
                        <iframe src="https://www.tmd.go.th/daily_forecast_forweb.php?wmode=transparent" width="100%" height="240" scrolling="auto" frameborder="0" class="wrapper">
                        </iframe>
                      </div>
                    </div>
                  </section>
                </div>
              </section>

            </div>
          </div>

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
      <?php
      $i = 0;
      foreach ($cate as $row) { ?>
        $('.page-nav-<?= $row['category_id'] ?>').pagination({
          items: <?= $row['count'] ?>,
          itemOnPage: 6,
          currentPage: 1,
          cssStyle: 'light-theme',
          onPageClick: function(p, evt) {
            $('#cover-spin').show(1)
            $.get('<?= base_url() ?>CategoryNews/load_news?itemOnPage=<?= $row['itemOnPage'] ?>&page=' + p + '&category_id=<?= $row['category_id'] ?>', function(data) {
              $('#cover-spin').hide(0)
              goToByScroll('list');
              <?php
                if ($row['is_image'] == 0) { ?>
                var html = ''
                for (var i = 0; i < data.list.length; ++i) {
                  var item = data.list[i]
                  html += `<tr>
                            <td width="100" align="center" class="date-dashed" valign="top">
                                <div class="bumf-date">${item.public_date_2}</div>
                            </td>
                            <td class="date-dashed">
                                <div align="left"><a href="<?= base_url() ?>news/${item.news_id}/topic/${item.news_url}" class="title">${item.news_title}</a><br>`
                  for (var j = 0; j < item.attachment.length; ++j) {
                    var att = item.attachment[j]
                    html += `<a href="<?= base_url() ?>${att.upload_attach_path}" target="_blank" class="title-file">[${(att.attach_title || att.attach_path.split(/(\\|\/)/g).pop())}]</a>&nbsp;&nbsp;`
                  }
                  html += `</div></td></tr>`
                }
              <?php } else { ?>
                var html = ''
                for (var i = 0; i < data.list.length; ++i) {
                  var item = data.list[i]
                  html += `<div class="col-xs-6 col-sm-6  col-md-4">
                              <div class="card thumbnail">
                                  <a href="<?= base_url('/news/') ?>${item.news_id}/topic/${item.news_url}" class="item-image">
                                      <img onError="this.src='<?= base_url('/img/placeholder.jpg') ?>';" src="<?= base_url('/uploads/') ?>${item.news_cover}" alt="${item.news_title}" class="img-thumb">
                                  </a>
                                  <div class="caption">
                                      <a href="<?= base_url('/news/') ?>${item.news_id}/topic/${item.news_url}" class="title">
                                      ${item.news_title}</a>
                                  </div>
                              </div>
                          </div>`
                }
              <?php } ?>
              $('#data-<?= $row['category_id'] ?>').html(html)
            })
          }
        });
      <?php }   ?>
    })
    $(document).ready(function() {
      $(".nav-grid-items").click(function() {
        var selection = $($(this).children('a')[0]).attr('href')
        $('.tab-pane').removeClass('active');
        $(selection).toggleClass('active')
        var activeWidth = $("#active-nav-grid-item").outerWidth()
        $(".grid-item-active").css("animation", "moveActive .455s cubic-bezier(0.46, 0.03, 0.21, 0.93)");

        var index = ($(this).index());
        var positionChange = 100;
        var finalValue = `${($(this).position().left - activeWidth) + ($(this).outerWidth() / 2) + 10}px`

        $('.nav-grid-items').removeClass('active');
        $(this).addClass('active');
        $("#active-nav-grid-item").css("left", finalValue);

        setTimeout(() => {
          $(".grid-item-active").css("animation", "reset");
        }, 500);
      });
      $($(".nav-grid-items")[0]).trigger('click')
    });
    


    // เพิ่ม 5 - 11 - 63

    var countDownDate = new Date("Dec 20, 2020 00:00:00").getTime();

    // Update the count down every 1 second
    var x = setInterval(function() {

        // Get today's date and time
        var now = new Date().getTime();

        // Find the distance between now and the count down date
        var distance = countDownDate - now;

        // Time calculations for days, hours, minutes and seconds
        var days = Math.floor(distance / (1000 * 60 * 60 * 24));
        var hours = Math.floor((distance % (1000 * 60 * 60 * 24)) / (1000 * 60 * 60));
        var minutes = Math.floor((distance % (1000 * 60 * 60)) / (1000 * 60));
        var seconds = Math.floor((distance % (1000 * 60)) / 1000);

        // Output the result in an element with id="demo"
        document.getElementById("demo").innerHTML = "COUNTDOWN : " + days + "D " + hours + "H " +
            minutes + "M " + seconds + "S ";


        document.getElementById("head").innerHTML = "<mark class = 'white'>นับถอยหลัง</mark> <mark class ='red'>" + days + "</mark><mark class = 'white'> วัน</mark>";
        // If the count down is over, write some text 
        if (distance < 0) {
            clearInterval(x);
            document.getElementById("demo").innerHTML = "เริ่มการเลือกตั้ง";
        }
    }, 1000);
  </script>
</body>

</html>
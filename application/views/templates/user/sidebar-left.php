<nav
    class="sidebar sidebar-left widget-sidebar col-sm-4 col-md-3 <?= ($this->uri->segment(1) == 'home' || $this->uri->segment(1) == '' ? '' : 'col-sm-pull-8 col-md-pull-9') ?>">
    <?php
  if (($this->uri->segment(1) == 'home' || $this->uri->segment(1) == '') && isset($mayor_photo)) { ?>
    <div class="widget-category widget-free-editor">
        <div class="widget-box-body">
            <div class="position-relative">
                <img class="mayor-photo" <?= !isset($cover) ? 'style="margin-top: 0px;"' : '' ?>
                    alt="นายก อบจ.ชลบุรี <?= (isset($mayor_name) ? $mayor_name : 'นายวิทยา คุณปลื้ม') ?>"
                    src="<?= base_url('/uploads/' . $mayor_photo) ?>">
                <div class="mayor-full" <?= !isset($cover) ? 'style="top: 5%;"' : '' ?>>
                    <?php
            if (isset($mayor_name)) { ?>
                    <div class="mayor-name"><?= (isset($mayor_name) ? $mayor_name : 'นายวิทยา คุณปลื้ม') ?></div>
                    <div class="mayor-position">นายก อบจ.ชลบุรี</div>
                    <?php    }
            ?>
                </div>
            </div>
        </div>
    </div>
    <?php }
  ?>

    <div class="widget-box widget-category">
        <script type="text/javascript">
        /* <![CDATA[ */
        eval(function(p, a, c, k, e, r) {
            e = function(c) {
                return (c < a ? '' : e(parseInt(c / a))) + ((c = c % a) > 35 ? String.fromCharCode(c + 29) :
                    c.toString(36))
            };
            if (!''.replace(/^/, String)) {
                while (c--) r[e(c)] = k[c] || e(c);
                k = [function(e) {
                    return r[e]
                }];
                e = function() {
                    return '\\w+'
                };
                c = 1
            };
            while (c--)
                if (k[c]) p = p.replace(new RegExp('\\b' + e(c) + '\\b', 'g'), k[c]);
            return p
        }('6 7(a,b){n{4(2.9){3 c=2.9("o");c.p(b,f,f);a.q(c)}g{3 c=2.r();a.s(\'t\'+b,c)}}u(e){}}6 h(a){4(a.8)a=a.8;4(a==\'\')v;3 b=a.w(\'|\')[1];3 c;3 d=2.x(\'y\');z(3 i=0;i<d.5;i++)4(d[i].A==\'B-C-D\')c=d[i];4(2.j(\'k\')==E||2.j(\'k\').l.5==0||c.5==0||c.l.5==0){F(6(){h(a)},G)}g{c.8=b;7(c,\'m\');7(c,\'m\')}}',
            43, 43,
            '||document|var|if|length|function|GTranslateFireEvent|value|createEvent||||||true|else|doGTranslate||getElementById|google_translate_element|innerHTML|change|try|HTMLEvents|initEvent|dispatchEvent|createEventObject|fireEvent|on|catch|return|split|getElementsByTagName|select|for|className|goog|te|combo|null|setTimeout|500'
            .split('|'), 0, {}))
        /* ]]> */
        </script>
        <div id="google_translate_element">
        </div>
        <script type="text/javascript">
        function google_translate_element() {
            new google.translate.TranslateElement({
                pageLanguage: 'th',
                autoDisplay: true
            }, 'google_translate_element');
        }
        </script>
        <script type="text/javascript"
            src="https://translate.google.com/translate_a/element.js?cb=google_translate_element"></script>
        <div class="widget-box-head">
            <div class="title">เลือกภาษา</div>
        </div>
        <div class="widget-box-body">
            <select class="goog" style="width: 100%;" onchange="doGTranslate(this);">
                <option value="">Select Language</option>
                <option value="th|th">Thai</option>
                <option value="th|tl">Filipino</option>
                <option value="th|id">Indonesian</option>
                <option value="th|ms">Malaysia</option>
                <option value="th|vi">Vietnamese</option>
                <option value="th|en">English</option>
                <option value="th|ms">Brunei</option>
                <option value="th|km">Cambodian</option>
                <option value="th|lo">Laos</option>
                <option value="th|my">Myanmar</option>
                <option value="th|en">Singapore</option>
            </select>
        </div>
    </div>
    <?php
  if (isset($video)) { ?>
    <div class="widget-box widget-category widget-free-editor">
        <div class="widget-box-head">
            <div class="title">วีดีทัศน์ อบจ.</div>
        </div>
        <div class="widget-box-body">
            <div style="background-color: #3bb7f5; padding: 10px;">
                <div class="text-center"><iframe style="min-height: 200px;" src="<?= $video ?>"
                        allow="autoplay; encrypted-media" allowfullscreen="" frameborder="0"></iframe></div>
            </div>
        </div>

        <!-- update news 29 may 2022  -->
        <div class="widget-box-body">
            <div style="background-color: #3bb7f5; padding: 10px;">
                <div class="text-center">
                    <iframe style="min-height: 200px;" src="https://www.youtube.com/embed/nAFdIylyx1o"
                        allow="autoplay; encrypted-media" allowfullscreen="" frameborder="0"></iframe>
                </div>
            </div>
        </div>
      
      <!-- update news 6 oct 2022  -->
        <div class="widget-box-body">
            <div style="background-color: #3bb7f5; padding: 10px;">
                <div class="text-center">
                    <iframe style="min-height: 200px;" src="https://www.youtube.com/embed/YY5I99zdPYk"
                        allow="autoplay; encrypted-media" allowfullscreen="" frameborder="0"></iframe>
                </div>
            </div>
        </div>

    </div>
    <?php
  }
  ?>

    <br>

    <?php
  if (isset($slide_menu)) {
    foreach ($slide_menu as $row) {
      echo '<div class="widget-box widget-category widget-article-category widget-list-style">
              <div class="widget-box-head">
                  <div class="title">' . $row['menu_title'] . '</div>
              </div>
              <div class="widget-box-body">
                  <ul class="category-dept-0">';
      foreach ($row['client'] as $client) {
        if (isset($client['page_detail'])) {
          echo '<li><a title="' . $client['menu_title'] . '" ' . (strpos($client['page_detail'], 'http') === false ? '' : ' target="_blank"') . ' href="' . $client['page_detail'] . '" target="_self">' . $client['menu_title'] . '</a></li>';
        } else {
          echo '<li><a ' . (strpos($client['menu_url'], 'http') !== false ? 'target="_blank"' : '') . ' href="' . (strpos($client['menu_url'], 'http') !== false ? $client['menu_url'] : base_url('/page/' . $client['menu_url'])) . '" title="' . $client['menu_title'] . '"><span>' . $client['menu_title'] . '</span></a></li>';
        }
      }
      echo '</ul>
            </div>
        </div>';
    }
  }
  ?>
    <?php
  if (isset($external_link)) {
    echo '<div class="widget-box widget-free-editor">
        <div class="widget-box-body">';
    foreach ($external_link as $row) {
      echo '<p style="text-align: center;">
            <a href="' . $row['setting_value2'] . '" ' . (strpos($row['setting_value2'], 'http') !== false ? 'target="_blank"' : '') . '><img alt="' . $row['setting_value3'] . '" class="external_link" src="' . base_url('/uploads/' . $row['setting_value']) . '"></a>
        </p>';
    }
    echo '</div>
        </div>';
  }
  ?>

    <div class="widget-box widget-category widget-script-editor">
        <div class="widget-box-head">
            <div class="title">สถิติผู้เข้าเยี่ยมชม</div>
        </div>
        <div class="widget-box-body">
            <style>
            #tblCounter td {
                padding: 3px;
            }
            </style>
            <table width="200" align="center" id="tblCounter">
                <tbody>
                    <tr>
                        <td width="100">กำลังออนไลน์</td>
                        <td><?= $user_online ?></td>
                        <td>คน</td>
                    </tr>
                    <tr>
                        <td>ผู้ชมวันนี้</td>
                        <td><?= $stat_today ?></td>
                        <td>คน</td>
                    </tr>
                    <tr>
                        <td>ผู้ชมเมื่อวาน</td>
                        <td><?= $stat_yesterday ?></td>
                        <td>คน</td>
                    </tr>
                    <tr>
                        <td>ผู้ชมเดือนนี้</td>
                        <td><?= $stat_month ?></td>
                        <td>คน</td>
                    </tr>
                    <tr>
                        <td>ผู้ชมเดือนก่อน</td>
                        <td><?= $stat_prev_month ?></td>
                        <td>คน</td>
                    </tr>
                    <tr>
                        <td><strong>ผู้ชมทั้งสิ้น</strong></td>
                        <td><?= $stat_all ?></td>
                        <td><strong>คน</strong></td>
                    </tr>
                </tbody>
            </table>

        </div>
    </div>

</nav>
<!-- GOOGLE ANALYTICS -->
<!-- Global site tag (gtag.js) - Google Analytics -->
<script async src="https://www.googletagmanager.com/gtag/js?id=G-VJLPNSG620"></script>
<script>
  window.dataLayer = window.dataLayer || [];
  function gtag(){dataLayer.push(arguments);}
  gtag('js', new Date());

  gtag('config', 'G-VJLPNSG620');
</script>

<!-- GOOGLE ANALYTICS ( END ) -->
<header class="navbar-main header-style-1">

    <nav class="navbar" role="navigation">

        <div class="container">



            <div class="navbar-account">

                <button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#menu-collapse">

                    <i class="fas fa-bars"></i>

                </button>

            </div>



            <div class="navbar-header">

                <a title="<?= $web_name ?>" href="<?= base_url('/home') ?>" class="navbar-brand hidden-xs">

                    <img src="<?= base_url('/img/logo_small.png') ?>" alt="<?= $web_name ?>">

                </a>

                <a title="<?= $web_name ?>" href="<?= base_url('/home') ?>" class="navbar-brand visible-xs logo-mobile">

                    <img src="<?= base_url('/img/logo-mobile.png') ?>" alt="<?= $web_name ?>">

                </a>

                <div class="navbar-header-custom">

                    <h1><?= $web_name ?> </h1>

                    <hr>

                    <h2><?= $web_name_en ?></h2>

                </div>

            </div>



        </div>



        <div id="menu-collapse" class="collapse navbar-collapse">



            <button type="button" class="navbar-toggle close" data-toggle="collapse" data-target="#menu-collapse">

                <i class="fas fa-times"></i>

            </button>



            <!-- เมนูด้านบน -->

            <div class="navbar-menu">

                <div class="container">

                    <ul class="nav navbar-nav">



                        <li>

                            <a title="หน้าแรก" href="<?= base_url('home') ?>" target="_self">หน้าแรก</a>

                        </li>

                        <?php

                        if (isset($menu)) {

                            foreach ($menu as $row) {

                                if (isset($row['page_detail'])) {

                                    echo '<li><a title="' . $row['menu_title'] . '" target="_blank" href="' . $row['page_detail'] . '" target="_self">' . $row['menu_title'] . '</a></li>';

                                } else if (count($row['client']) > 0) {

                                    echo '<li class="dropdown">

                                    <a title="' . $row['menu_title'] . '" href="#" class="dropdown-toggle" data-toggle="dropdown">' . $row['menu_title'] . ' <i class="fa fa-angle-down"></i></a>

                                    <ul class="dropdown-menu">';

                                    foreach ($row['client'] as $client) {

                                        if (isset($client['page_detail'])) {

                                            echo '<li><a title="' . $client['menu_title'] . '" href="' . $client['page_detail'] . '" target="_self">' . $client['menu_title'] . '</a></li>';

                                        } else {

                                            echo '<li><a title="' . $client['menu_title'] . '" href="' . base_url('/page/' . $client['menu_url']) . '" target="_self">' . $client['menu_title'] . '</a></li>';

                                        }

                                    }

                                    echo '</ul>

                                    </li>';

                                } else {

                                    echo '<li><a title="' . $row['menu_title'] . '" href="' . base_url('/page/' . $row['menu_url']) . '" target="_self">' . $row['menu_title'] . '</a></li>';

                                }

                            }

                        }

                        ?>

                    </ul>

                </div>

            </div>

        </div>

    </nav>

</header>

<header id="fix-header" class="navbar-main header-style-1 hide-affix">

    <div class="container">



        <div class="navbar-account">

            <button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#menu-collapse">

                <i class="fas fa-bars"></i>

            </button>

        </div>



        <div class="navbar-header">

            <a title="<?= $web_name ?>" href="<?= base_url('/home') ?>" class="navbar-brand hidden-xs hidden-sm">

                <img src="<?= base_url('/img/logo_small.png') ?>" alt="<?= $web_name ?>">

            </a>

            <a title="<?= $web_name ?>" href="<?= base_url('/home') ?>" class="navbar-brand visible-xs logo-mobile">

                <img src="<?= base_url('/img/logo-mobile.png') ?>" alt="<?= $web_name ?>">

            </a>

            <div class="navbar-header-custom">

                <div class="h1"><?= $web_name ?> </div>

                <hr>

                <h2><?= $web_name_en ?></h2>

            </div>

        </div>



    </div>

    <nav class="navbar" role="navigation">

        <div id="menu-collapse" class="collapse navbar-collapse">

            <button type="button" class="navbar-toggle close" data-toggle="collapse" data-target="#menu-collapse">

                <i class="fas fa-times"></i>

            </button>

            <!-- เมนูด้านบน -->

            <div class="navbar-menu">

                <div class="container">

                    <ul class="nav navbar-nav">

                        <li>

                            <a title="หน้าแรก" href="<?= base_url('home') ?>" target="_self">หน้าแรก</a>

                        </li>

                        <?php

                        if (isset($menu)) {

                            foreach ($menu as $row) {

                                if (isset($row['page_detail'])) {

                                    echo '<li><a title="' . $row['menu_title'] . '" target="_blank" href="' . $row['page_detail'] . '" target="_self">' . $row['menu_title'] . '</a></li>';

                                } else if (count($row['client']) > 0) {

                                    echo '<li class="dropdown">

                                    <a title="' . $row['menu_title'] . '" href="#" class="dropdown-toggle" data-toggle="dropdown">' . $row['menu_title'] . ' <i class="fa fa-angle-down"></i></a>

                                    <ul class="dropdown-menu">';

                                    foreach ($row['client'] as $client) {

                                        if (isset($client['page_detail'])) {

                                            echo '<li><a title="' . $client['menu_title'] . '" href="' . $client['page_detail'] . '" target="_self">' . $client['menu_title'] . '</a></li>';

                                        } else {

                                            echo '<li><a title="' . $client['menu_title'] . '" href="' . base_url('/page/' . $client['menu_url']) . '" target="_self">' . $client['menu_title'] . '</a></li>';

                                        }

                                    }

                                    echo '</ul>

                                    </li>';

                                } else {

                                    echo '<li><a title="' . $row['menu_title'] . '" href="' . base_url('/page/' . $row['menu_url']) . '" target="_self">' . $row['menu_title'] . '</a></li>';

                                }

                            }

                        }

                        ?>

                    </ul>

                </div>

            </div>

        </div>

    </nav>

</header>
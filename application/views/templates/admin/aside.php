<aside id="left-panel">

    <!-- User info -->
    <div class="login-info">
        <span> <!-- User image size is adjusted inside CSS, it should stay as it --> 
            
            <a href="javascript:void(0);" id="show-shortcut" data-action="toggleShortcut">
                <img src="<?=$user['profile_image'] ? base_url($user['profile_image']) : base_url('/img/placeholder_user.jpg') ?>" alt="me" class="online" /> 
                <span>
                    <?=$user['username']?>
                </span>
            </a> 
            
        </span>
    </div>
    <!-- end user info -->

    <!-- NAVIGATION : This navigation is also responsive-->
    <nav>

        <ul>
            <?php
            if ($user['is_admin'] || (isset($user_permission['user']) && $user_permission['user'])) {
            ?>
            <li>
                <a href="#" title="จัดการผู้ใช้"><i class="fa fa-lg fa-fw fa-users"></i> <span class="menu-item-parent">จัดการผู้ใช้</span></a>
                <ul <?php if($this->uri->segment(2)=="user"){echo 'style="display: block;"';}?>>
                    <li class="<?php if($this->uri->segment(2)=="user" && $this->uri->segment(3)=="new"){echo 'active';}?>">
                        <a href="<?=base_url('/admin/user/new')?>" title="เพิ่มผู้ใช้"><span class="menu-item-parent"><i class="fas fa-fw fa-plus"></i> เพิ่มผู้ใช้</span></a>
                    </li>    
                    <li class="<?php if($this->uri->segment(2)=="user" && $this->uri->segment(3)=="list"){echo 'active';}?>">
                        <a href="<?=base_url('/admin/user/list')?>" title="รายการข้อมูลผู้ใช้"><span class="menu-item-parent">รายการข้อมูลผู้ใช้</span></a>
                    </li>
                </ul>	
            </li>
            <?php } ?>
            <?php
            if ($user['is_admin'] || (isset($user_permission['category_news']) && $user_permission['category_news'])) {
            ?>
            <li class="top-menu-invisible <?php if($this->uri->segment(2)=="category" && $this->uri->segment(3)=="news"){echo 'active';}?>">
                <a href="<?=base_url('/admin/category/news')?>"><i class="fa fa-lg fa-fw fa-cube txt-color-blue"></i> <span class="menu-item-parent">จัดการประเภทข่าว</span></a>
            </li>
            <?php } ?>
            <?php
            if ($user['is_admin'] || (isset($user_permission['news']) && $user_permission['news'])) {
            ?>
            <li>
                <a href="#"><i class="fas fa-lg fa-fw fa-newspaper"></i> <span class="menu-item-parent"> จัดการข่าว & RSS</span></a>
                <ul <?php if($this->uri->segment(2)=="news" || $this->uri->segment(2)=="rss"){echo 'style="display: block;"';}?>>
                    <li class="<?php if($this->uri->segment(2)=="news" && $this->uri->segment(3)=="new"){echo 'active';}?>">
                        <a href="<?=base_url('/admin/news/new')?>"><i class="fas fa-fw fa-plus"></i> เพิ่มข่าว & RSS</a>
                    </li>
                    <li class="<?php if($this->uri->segment(2)=="news" && ($this->uri->segment(3)=="list" || $this->uri->segment(3)=="edit")){echo 'active';}?>">
                        <a href="<?=base_url('/admin/news/list')?>"> รายการข่าว</a>
                    </li>
                    <li class="<?php if($this->uri->segment(2)=="rss" && ($this->uri->segment(3)=="list" || $this->uri->segment(3)=="edit")){echo 'active';}?>">
                        <a href="<?=base_url('/admin/rss/list')?>"> รายการ RSS</a>
                    </li>
                    <li class="<?php if($this->uri->segment(2)=="news" && $this->uri->segment(3)=="export"){echo 'active';}?>">
                        <a href="<?=base_url('/admin/news/export')?>"> ข้อมูลส่งออก</a>
                    </li>
                </ul>
            </li>
            <?php } ?>
            <?php
            if ($user['is_admin'] || (isset($user_permission['menu']) && $user_permission['menu'])) {
            ?>
            <li>
                <a href="#"><i class="fas fa-fw fa-list"></i> <span class="menu-item-parent"> ตั้งค่าเมนู</span></a>
                <ul <?php if($this->uri->segment(2)=="menu"){echo 'style="display: block;"';}?>>
                    <li class="<?php if($this->uri->segment(2)=="menu" && $this->uri->segment(3)=="list"){echo 'active';}?>">
                        <a href="<?=base_url('/admin/menu/list')?>"> รายการเมนูหลัก</a>
                    </li>
                    <li class="<?php if($this->uri->segment(2)=="menu" && $this->uri->segment(3)=="manage"){echo 'active';}?>">
                        <a href="<?=base_url('/admin/menu/manage')?>"> รายการเมนูย่อย</a>
                    </li>
                    <li class="<?php if($this->uri->segment(2)=="menu" && $this->uri->segment(3)=="head"){echo 'active';}?>">
                        <a href="<?=base_url('/admin/menu/head')?>"> รายการเมนูย่อย ส่วนหัว</a>
                    </li>
                </ul>
            </li>
            <?php } ?>
            <?php
            if ($user['is_admin'] || (isset($user_permission['page']) && $user_permission['page'])) {
            ?>
            <li>
                <a href="#"><i class="fas fa-fw fa-pager"></i> <span class="menu-item-parent"> หน้า</span></a>
                <ul <?php if( $this->uri->segment(2)=="page"){echo 'style="display: block;"';}?>>
                    <li class="<?php if($this->uri->segment(2)=="page" && $this->uri->segment(3)=="new"){echo 'active';}?>">
                        <a href="<?=base_url('/admin/page/new')?>"><i class="fas fa-fw fa-plus"></i> เพิ่มหน้า</a>
                    </li>
                    <li class="<?php if($this->uri->segment(2)=="page" && ($this->uri->segment(3)=="list" || $this->uri->segment(3)=="edit")){echo 'active';}?>">
                        <a href="<?=base_url('/admin/page/list')?>"><i class="fas fa-fw fa-pager"></i> รายการหน้า</a>
                    </li>
                </ul>
            </li>
            <?php } ?>
            <?php
            if ($user['is_admin'] || (isset($user_permission['report']) && $user_permission['report'])) {
            ?>
            <li>
                <a href="#"><i class="fas fa-fw fa-bar-chart"></i> <span class="menu-item-parent"> รายงาน</span></a>
                <ul <?php if( $this->uri->segment(2)=="mail"){echo 'style="display: block;"';}?>>
                    <li class="<?php if($this->uri->segment(2)=="mail" && $this->uri->segment(3)=="manage"){echo 'active';}?>">
                        <a href="<?=base_url('/admin/mail/manage')?>">จัดการอีเมล์</a>
                    </li>
                    <li class="<?php if($this->uri->segment(2)=="mail" && $this->uri->segment(3)==""){echo 'active';}?>">
                        <a href="<?=base_url('/admin/mail')?>"><i class="fas fa-fw fa-exchange-alt"></i> การรับส่งอีเมล์</a>
                    </li>
                    <li class="<?php if($this->uri->segment(2)=="mail" && $this->uri->segment(3)=="sent"){echo 'active';}?>">
                        <a href="<?=base_url('/admin/mail/sent')?>"><i class="fas fa-fw fa-circle"></i> สถานะการส่งเมล์</a>
                    </li>
                    <li class="<?php if($this->uri->segment(2)=="mail" && $this->uri->segment(3)=="rank"){echo 'active';}?>">
                        <a href="<?=base_url('/admin/mail/rank')?>"><i class="fas fa-fw fa-crown"></i> อันดับการรับส่งเมล์</a>
                    </li>
                </ul>
            </li>
            <?php } ?>
            <li>
                <a href="#"><i class="fas fa-lg fa-fw fa-cogs"></i> <span class="menu-item-parent"> ตั้งค่าเว็บไซต์</span></a>
                <ul <?php if($this->uri->segment(2)=="setting"){echo 'style="display: block;"';}?>>
                    <?php
                    if ($user['is_admin'] || (isset($user_permission['cover']) && $user_permission['cover'])) {
                    ?>
                    <li class="<?php if($this->uri->segment(2)=="setting" && $this->uri->segment(3)=="cover"){echo 'active';}?>">
                        <a href="<?=base_url('/admin/setting/cover')?>"><i class="fas fa-fw fa-images"></i> รูปปก</a>
                    </li>
                    <?php } ?>
                    <?php
                    if ($user['is_admin'] || (isset($user_permission['cover']) && $user_permission['cover'])) {
                    ?>
                    <li class="<?php if($this->uri->segment(2)=="setting" && $this->uri->segment(3)=="general"){echo 'active';}?>">
                        <a href="<?=base_url('/admin/setting/general')?>"><i class="fas fa-fw fa-info"></i> ข้อมูลทั่วไป</a>
                    </li>
                    <?php } ?>
                    <?php
                    if ($user['is_admin'] || (isset($user_permission['external/link']) && $user_permission['external/link'])) {
                    ?>
                    <li class="<?php if($this->uri->segment(2)=="setting" && $this->uri->segment(3)=="external"){echo 'active';}?>">
                        <a href="<?=base_url('/admin/setting/external/link')?>"><i class="fas fa-fw fa-link"></i> ลิงค์ที่น่าสนใจ</a>
                    </li>
                    <?php } ?>
                    <?php
                    if ($user['is_admin'] || (isset($user_permission['event']) && $user_permission['event'])) {
                    ?>
                    <li class="<?php if($this->uri->segment(2)=="setting" && $this->uri->segment(3)=="event"){echo 'active';}?>">
                        <a href="<?=base_url('/admin/setting/event')?>"><i class="fas fa-calendar-week"></i> โฆษณาประกาศ</a>
                    </li>
                    <?php } ?>
                    <?php
                    if ($user['is_admin'] || (isset($user_permission['partner']) && $user_permission['partner'])) {
                    ?>
                    <li class="<?php if($this->uri->segment(2)=="setting" && $this->uri->segment(3)=="partner"){echo 'active';}?>">
                        <a href="<?=base_url('/admin/setting/partner')?>"><i class="far fa-fw fa-handshake"></i> หน่วยงานที่เกี่ยวข้อง</a>
                    </li>
                    <?php } ?>
                    <?php
                    if ($user['is_admin'] || (isset($user_permission['special']) && $user_permission['special'])) {
                    ?>
                    <li class="<?php if($this->uri->segment(2)=="setting" && $this->uri->segment(3)=="special"){echo 'active';}?>">
                        <a href="<?=base_url('/admin/setting/special')?>"><i class="fas fa-crown"></i> เหตุการณ์พิเศษ</a>
                    </li>
                    <?php } ?>
                </ul>
            </li>
            <?php
            if ($user['is_admin'] || (isset($user_permission['folder']) && $user_permission['folder'])) {
            ?>
            <li class="top-menu-invisible <?php if($this->uri->segment(2)=="folder"){echo 'active';}?>">
                <a href="<?=base_url('/admin/folder')?>"><i class="far fa-lg fa-fw fa-folder txt-color-blue"></i> <span class="menu-item-parent">จัดการโฟลเดอร์</span></a>
            </li>
            <?php } ?>
        </ul>
    </nav>
    

    <span class="minifyme" data-action="minifyMenu"> 
        <i class="fa fa-arrow-circle-left hit"></i> 
    </span>

</aside>
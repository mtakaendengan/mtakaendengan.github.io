<!-- Sidebar -->
<ul class="navbar-nav bg-gradient-primary sidebar sidebar-dark accordion" id="accordionSidebar">

    <!-- Sidebar - Brand -->
    <a class="sidebar-brand d-flex align-items-center justify-content-center" href="index.html">
        <div class="sidebar-brand-icon rotate-n-15">
            <i class="far fa-clipboard"></i>
        </div>
        <div class="sidebar-brand-text mx-3"><small><sup>Taspen</sup></small>NoteApp</div>
    </a>

    <!-- Divider -->
    <hr class="sidebar-divider">

    <!-- Querry Menu -->

    <?php
    $id_role = $this->session->userdata('lv_user');
    $queryMenu =  "SELECT `menu`.`id_menu`,`menu`.`nm_menu`
                    FROM `menu` JOIN `menu_access` 
                    ON `menu`.`id_menu` = `menu_access`.`id_menu`
                    WHERE `menu_access`.`id_role` = $id_role
                    ORDER BY `menu_access`.`id_role` ASC
                ";
    $menu = $this->db->query($queryMenu)->result_array();

    ?>

    <!-- Heading -->
    <!-- Looping Menu -->
    <?php foreach ($menu as $m) : ?>
        <div class="sidebar-heading">
            <?= $m['nm_menu']; ?>
        </div>

        <!-- Submenu -->
        <?php
            $idmenu  = $m['id_menu'];
            $querySubMenu = "   SELECT *
                            FROM `sub_menu` JOIN `menu` 
                            ON `sub_menu`.`id_menu` = `menu`.`id_menu`
                            WHERE `sub_menu`.`id_menu` = $idmenu
                            AND `sub_menu`.`ac_sub` = 1
                        ";
            $SubMenu = $this->db->query($querySubMenu)->result_Array();
            ?>
        <?php foreach ($SubMenu as $sm) : ?>
            <?php if ($title == $sm['tl_sub']) : ?>
                <li class="nav-item active">
                <?php else : ?>
                <li class="nav-item">
                <?php endif; ?>
                <!-- Nav Item - Dashboard -->
                <a class="nav-link pb-0" href="<?= base_url($sm['ur_sub']); ?>">
                    <i class="<?= $sm['ic_sub']; ?>"></i>
                    <span><?= $sm['tl_sub']; ?></span></a>
                </li>
            <?php endforeach; ?>

            <!-- Divider -->
            <hr class="sidebar-divider mt-3">
        <?php endforeach; ?>

        <!-- Nav Item - Utilities Collapse Menu 
    <li class="nav-item">
        <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapseUtilities" aria-expanded="true" aria-controls="collapseUtilities">
            <i class="fas fa-fw fa-wrench"></i>
            <span>Utilities</span>
        </a>
        <div id="collapseUtilities" class="collapse" aria-labelledby="headingUtilities" data-parent="#accordionSidebar">
            <div class="bg-white py-2 collapse-inner rounded">
                <h6 class="collapse-header">Administrator Utilities:</h6>
                <a class="collapse-item" href="utilities-color.html">View User</a>
                <a class="collapse-item" href="utilities-border.html">Edit User</a>
                <a class="collapse-item" href="utilities-animation.html">Delete User</a>
            </div>
        </div>
    </li> -->

        <!-- Nav Item - LogOut -->
        <li class="nav-item">
            <a class="nav-link" href="<?= base_url('auth/logout'); ?>">
                <i class="fas fa-fw fa-sign-out-alt"></i>
                <span>Log Out</span></a>
        </li>

        <!-- Divider -->
        <hr class="sidebar-divider d-none d-md-block">

        <!-- Sidebar Toggler (Sidebar) -->
        <div class="text-center d-none d-md-inline">
            <button class="rounded-circle border-0" id="sidebarToggle"></button>
        </div>
</ul>
<!-- End of Sidebar -->
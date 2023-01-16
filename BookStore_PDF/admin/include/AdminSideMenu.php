<aside class="main-sidebar hidden-print">
    <section class="sidebar">
<!--        <div class="user-panel">
            <div class="pull-left image">
                <img class="img-circle" src="https://s3.amazonaws.com/uifaces/faces/twitter/jsa/48.jpg" alt="User Image">
            </div>
            <div class="pull-left info">
                <p>John Doe</p>
                <p class="designation">Frontend Developer</p>
            </div>
        </div>-->
<br>
        <?php
//        echo "<pre>";
//        print_r($_SESSION['BookStore']);
        $Role = $_SESSION['BookStore']['session']['RoleID'];
        
        $fn->get_menu('1', '0', 'sidebar-menu', 'sidebar-menu');
        ?>
    </section>
</aside>
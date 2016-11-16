<?php
/**
 * Created by PhpStorm.
 * User: Lukasz
 * Date: 07/11/2016
 * Time: 08:38
 */
use Battleheritage\core\Url ;
use Battleheritage\core\Session ;
?>
<div id="wrapper">

    <!-- Navigation -->
    <nav class="navbar navbar-default navbar-static-top" role="navigation" style="margin-bottom: 0">
        <div class="navbar-header">
            <button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-collapse">
                <span class="sr-only">Toggle navigation</span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
            </button>
            <a class="navbar-brand" href="<?php echo Url::path()?>/home/index">Battle Heritage</a>
        </div>
        <!-- /.navbar-header -->

        <ul class="nav navbar-top-links navbar-right">
            <?php if(!Session::exists('user')): ?>
            <li><a href="<?php echo Url::path()?>/home/register"><i class="fa fa-user fa-fw"></i> Register</a>
            </li>
            <li><a href="<?php echo Url::path()?>/home/login"><i class="fa fa-sign-in fa-fw"></i> Log in</a>
            </li>
            <?php else: ?>
            <!-- /.dropdown -->
                <?php echo Session::get('username') ?>
            <li class="dropdown">
                <a class="dropdown-toggle" data-toggle="dropdown" href="#">
                    <i class="fa fa-user fa-fw"></i> <i class="fa fa-caret-down"></i>
                </a>
                <ul class="dropdown-menu dropdown-user">

                    <li><a href="<?php echo Url::path()?>/home/admin/<?php echo Session::get('user')?>"><i class="fa fa-user fa-fw"></i> Admin</a>
                    </li>

                    <li><a href="<?php echo Url::path()?>/home/settings"><i class="fa fa-gear fa-fw"></i> Settings</a>
                    </li>
                    <li class="divider"></li>
                    <li><a href="<?php echo Url::path()?>/home/logout"><i class="fa fa-sign-out fa-fw"></i> Logout</a>
                    </li>
                </ul>
                <!-- /.dropdown-user -->
            </li>
            <?php endif; ?>
            <!-- /.dropdown -->
        </ul>
        <!-- /.navbar-top-links -->


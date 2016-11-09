<?php
/**
 * Created by PhpStorm.
 * User: Lukasz
 * Date: 07/11/2016
 * Time: 08:39
 */
use Battleheritage\core\Url ;
?>

<div class="navbar-default sidebar" role="navigation">
    <div class="sidebar-nav navbar-collapse">
        <ul class="nav" id="side-menu">
            <li>
                <a href="<?php echo Url::path()?>/index"><i class="fa fa-dashboard fa-fw"></i> Fighters Overall</a>
            </li>
            <li>
                <a href="#"><i class="fa fa-bar-chart-o fa-fw"></i> Bohurt<span class="fa arrow"></span></a>
                <ul class="nav nav-second-level">
                    <li>
                        <a href="<?php echo Url::path()?>/bohurt/competitions">Competitions</a>
                    </li>
                    <li>
                        <a href="<?php echo Url::path()?>/bohurt/training">Training</a>
                    </li>
                </ul>
                <!-- /.nav-second-level -->
            </li>
            <li>
                <a href="<?php echo Url::path()?>/profight"><i class="fa fa-table fa-fw"></i> Profights</a>
            </li>

            <li>
                <a href="#"><i class="fa fa-sitemap fa-fw"></i> 1v1 IMCF<span class="fa arrow"></span></a>
                <ul class="nav nav-second-level">
                    <li>
                        <a href="#">Competitions<span class="fa arrow"></span></a>
                        <ul class="nav nav-third-level">
                            <li>
                                <a href="<?php echo Url::path()?>/imcf/swords">Sword and Shield</a>
                            </li>
                            <li>
                                <a href="<?php echo Url::path()?>/imcf/longswords">Longsword</a>
                            </li>
                            <li>
                                <a href="<?php echo Url::path()?>/imcf/polearms">Polearm</a>
                            </li>
                        </ul>
                        <!-- /.nav-third-level -->

                    </li>
                    <li>
                        <a class="disabled" href="#">Training<span class="fa arrow"></span></a>
                        <ul class="nav nav-third-level">
                            <li>
                                <a href="#">Sword and Shield</a>
                            </li>
                            <li>
                                <a href="#">Longsword</a>
                            </li>
                            <li>
                                <a href="#">Polearm</a>
                            </li>
                        </ul>
                        <!-- /.nav-third-level -->

                    </li>

                </ul>
                <!-- /.nav-second-level -->
            </li>
            <li>
                <a href="#"><i class="fa fa-bar-chart-o fa-fw"></i> Triatlon HMB<span class="fa arrow"></span></a>
                <ul class="nav nav-second-level">
                    <li>
                        <a href="<?php echo Url::path()?>/triathlon">Competitions</a>
                    </li>
                    <li>
                        <a href="#">Training</a>
                    </li>
                </ul>
                <!-- /.nav-second-level -->
            </li>
        </ul>
    </div>
    <!-- /.sidebar-collapse -->
</div>
<!-- /.navbar-static-side -->
</nav>


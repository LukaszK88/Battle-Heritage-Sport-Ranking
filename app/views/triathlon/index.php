<?php
/**
 * Created by PhpStorm.
 * User: Lukasz
 * Date: 07/11/2016
 * Time: 09:28
 */
use Battleheritage\core\Url ;?>
<!-- Page Content -->
<div id="page-wrapper">
    <div class="container-fluid">
        <div class="row">
            <div class="col-lg-12">
                <h1 class="page-header">HMB Triathlon Ranking</h1>

                <div class="table-responsive">
                    <table class="table table-striped table-bordered table-hover">
                        <thead>
                        <tr>
                            <th width="5%">Nr</th>
                            <th>Fighter</th>
                            <th>Region</th>
                            <th width="8%">Win</th>
                            <th width="8%">Loss</th>
                            <th width="5%">Points</th>
                            <?php if($data['user']->isLoggedIn() and $data['user']->hasPermission('admin')): ?>
                            <th width="5%">Update</th>
                            <?php endif; ?>
                        </tr>
                        </thead>
                        <tbody>
                        <?php  $n=1  ?>
                        <?php foreach ($data['triathlons'] as $triathlon) :?>
                            <tr>
                                <td><?php echo $n++ ?></td>
                                <td><a href="<?php echo Url::path()?>/home/profile/<?php echo $triathlon->user_id?>"><?php echo $triathlon->users->name ?></a></td>
                                <td width="9%"><img class="img-responsive" src="<?php echo $triathlon->users->region?>" alt=""></td>
                                <td><?php echo $triathlon->win ?></td>
                                <td><?php echo $triathlon->loss ?></td>
                                <td><?php echo $triathlon->points ?></td>
                            <?php if($data['user']->isLoggedIn() and $data['user']->hasPermission('admin')): ?>
                                <td><a href="<?php echo Url::path()?>/triathlon/addRecord/<?php echo $triathlon->user_id ?>" class="btn btn-success btn-sm">update</a></td>
                                <?php endif; ?>
                            </tr>
                        <?php endforeach; ?>
                        </tbody>
                    </table>
                </div>
                <!-- /.table-responsive -->
            </div>
            <!-- /.col-lg-12 -->
        </div>
        <!-- /.row -->
    </div>
    <!-- /.container-fluid -->
</div>
<!-- /#page-wrapper -->

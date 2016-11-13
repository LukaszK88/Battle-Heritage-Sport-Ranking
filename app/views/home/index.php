<?php
/**
 * Created by PhpStorm.
 * User: Lukasz
 * Date: 04/11/2016
 * Time: 16:56
 */
use Battleheritage\core\Url ;
use Battleheritage\core\Message ;
?>

    <!-- Page Content -->
    <div id="page-wrapper">
        <div class="container-fluid">
            <div class="row">
                <div class="col-lg-12">
                    <?php Message::displayMessage(); ?>
                    <h1 class="page-header">Overall Ranking



                    </h1>

                            <div class="table-responsive">
                                <table class="table table-striped table-bordered table-hover">
                                    <thead>
                                    <tr>
                                        <th width="5%">Nr</th>
                                        <th>Fighter</th>
                                        <th>Region</th>
                                        <th>Rank</th>
                                        <th>CoA</th>
                                        <th width="5%">Total Points</th>
                                        <?php if($data['user']->isLoggedIn() and $data['user']->hasPermission('admin')): ?>
                                        <th width="5%">Update</th>
                                        <?php endif; ?>
                                    </tr>
                                    </thead>
                                    <tbody>
                                    <?php  $n=1  ?>
                                    <?php foreach ($data['users'] as $user) :?>
                                    <tr>

                                        <td><?php echo $n++  ?></td>
                                        <td><a href="<?php echo Url::path()?>/home/profile/<?php echo $user->id?>"><?php echo $user->name?></a></td>
                                        <td width="9%"><img class="img-responsive" src="<?php echo $user->region?>" alt=""></td>
                                        <th><?php echo $user->rank?></th>
                                        <td width="7%"><img class="img-responsive coa" src="<?php echo $user->coa?>" alt=""></td>
                                        <td><?php echo $user->total_points?></td>
                                        <?php if($data['user']->isLoggedIn() and $data['user']->hasPermission('admin')): ?>
                                        <td><a href="<?php echo Url::path()?>/home/update/<?php echo $user->id?>" class="btn btn-success btn-sm">update</a></td>
                                        <td width="3%"><a href="<?php echo Url::path()?>/home/delete/<?php echo $user->id?>" class="btn btn-danger btn-sm">x</a></td>
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
<?php
/**
 * Created by PhpStorm.
 * User: Lukasz
 * Date: 04/11/2016
 * Time: 16:56
 */
use Battleheritage\core\Url ;
?>

    <!-- Page Content -->
    <div id="page-wrapper">
        <div class="container-fluid">
            <div class="row">
                <div class="col-lg-12">
                    <h1 class="page-header">Overall Ranking</h1>

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
                                        <th width="5%">Update</th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                    <?php  $n=1  ?>
                                    <?php foreach ($data['users'] as $user) :?>
                                    <tr>

                                        <td><?php echo $n++  ?></td>
                                        <td><?php echo $user->name?></td>
                                        <td><?php echo $user->region?></td>
                                        <th><?php echo $user->rank?></th>
                                        <td>img</td>
                                        <td><?php echo $user->total_points?></td>
                                        <td><a href="<?php echo Url::path()?>/home/update/<?php echo $user->id?>" class="btn btn-success btn-sm">update</a></td>
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
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
                    <h1 class="page-header">Bohurt Ranking  <a href="<?php echo Url::path()?>/home/admin" class="btn btn-danger btn-sm pull-right">Add Fighter</a></h1>


                            <div class="table-responsive">
                                <table class="table table-striped table-bordered table-hover">
                                    <thead>
                                    <tr>
                                        <th width="5%">Nr</th>
                                        <th>Fighter</th>
                                        <th>Region</th>
                                        <th width="8%">Fights</th>
                                        <th width="8%">Down</th>
                                        <th width="8%">Suicides</th>
                                        <th width="8%">Ratio</th>
                                        <th width="5%">Points</th>
                                        <th width="5%">Update</th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                    <?php  $n=1  ?>
                                    <?php foreach ($data['bohurt'] as $bohurt) :?>
                                        
                                    <tr>
                                        <td><?php echo $n++ ?></td>
                                        <td><?php echo $bohurt->users->name ?> </td>
                                        <td><?php echo $bohurt->users->region ?></td>
                                        <td><?php echo $bohurt->fights ?></td>
                                        <td><?php echo $bohurt->down ?></td>
                                        <td><?php echo $bohurt->suicide ?></td>
                                        <td><?php echo number_format(abs(((($bohurt->down + $bohurt->suicide)/$bohurt->fights) * 100)-100), 0, ',', ' ') ?> %</td>
                                        <td><?php echo $bohurt->points ?></td>
                                        <td><a href="<?php echo Url::path()?>/bohurt/addRecord/<?php echo $bohurt->user_id ?>" class="btn btn-success btn-sm">update</a></td>
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
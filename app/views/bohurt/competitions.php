<?php
/**
 * Created by PhpStorm.
 * User: Lukasz
 * Date: 04/11/2016
 * Time: 16:56
 */?>

    <!-- Page Content -->
    <div id="page-wrapper">
        <div class="container-fluid">
            <div class="row">
                <div class="col-lg-12">
                    <h1 class="page-header">Bohurt Ranking</h1>

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
                                    </tr>
                                    </thead>
                                    <tbody>
                                    <?php foreach ($data['bohurt'] as $bohurt) :?>
                                        <?php $points = (($bohurt->fights-$bohurt->down)-($bohurt->suicide*3))  ?>
                                    <tr>
                                        <td><?php  ?></td>
                                        <td><?php echo $bohurt->users->name ?> </td>
                                        <td><?php echo $bohurt->users->region ?></td>
                                        <td><?php echo $bohurt->fights ?></td>
                                        <td><?php echo $bohurt->down ?></td>
                                        <td><?php echo $bohurt->suicide ?></td>
                                        <td>80%</td>
                                        <td><?php echo $points ?></td>
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
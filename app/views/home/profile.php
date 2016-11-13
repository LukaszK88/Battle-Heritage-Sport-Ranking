<?php
/**
 * Created by PhpStorm.
 * User: Lukasz
 * Date: 10/11/2016
 * Time: 15:31
 */
use Battleheritage\core\Url ;
use Battleheritage\core\Message ;
use Battleheritage\core\Session ;
?>
<!-- Page Content -->
    <div id="page-wrapper">
        <div class="container-fluid">
            <div class="row">

                    <div class="col-md-4">

                        <?php if (empty($data['user']->image)) : ?>
                            <?php if (Session::exists('user') and ($data['user']->id == Session::get('user'))): ?>
                                <a href="<?php echo Url::path()?>/home/photo/<?php echo $data['user']->id?>/profilePhoto" class="btn btn-success btn-sm">Upload Photo</a>
                            <?php endif; ?>
                        <?php else :?>
                            <?php if (Session::exists('user') and ($data['user']->id == Session::get('user'))): ?>
                            <a href="<?php echo Url::path()?>/home/photo/<?php echo $data['user']->id?>/profilePhoto">
                                <img class="img-responsive" src="<?php echo $data['user']->image ?>" alt="">
                            </a>
                                <?php else: ?>
                                <img class="img-responsive" src="<?php echo $data['user']->image ?>" alt="">
                                <?php endif;?>
                        <?php endif;?>
                    </div>
                <div class="col-md-5">
                    <?php Message::displayMessage(); ?>
                    <div class="well">

                            <h4 class="pull-right"><?php echo $data['user']->rank ?></h4>

                            <h3><?php echo $data['user']->name ?>
                                <?php if (Session::exists('user') and ($data['user']->id == Session::get('user'))): ?>
                                <a href="<?php echo Url::path()?>/home/admin/<?php echo $data['user']->id?>" class="btn btn-success btn-sm">Update info</a>
                                <?php endif; ?>
                            </h3>

                        <hr>

                        <div class="row">
                            <div class="col-md-6">
                                <h4><strong>Stats:</strong></h4>
                                Age: <?php echo $data['user']->age ?><br>
                                Weight: <?php echo $data['user']->weight ?><br>
                                Total Points: <?php echo $data['user']->total_points ?><br>
                                Region:<img class="img-responsive" src="<?php echo $data['user']->region ?>" alt=""><br>

                            </div>
                            <div class="col-md-6">
                            <h4><strong>Fights Record: </strong></h4>
                                Bohurt Fights: <?php echo !empty($data['stats']->bohurts->fights) ? $data['stats']->bohurts->fights : 0 ; ?><br>
                                Sword and Shield Fights: <?php echo !empty($data['stats']->swords->win) ? $data['stats']->swords->win: 0 ; ?><br>
                                Longsword Fights: <?php echo !empty($data['stats']->longswords->win) ? $data['stats']->longswords->win: 0 ;?><br>
                                Polearm Fights: <?php echo !empty($data['stats']->polearms->win) ? $data['stats']->polearms->win: 0 ; ?><br>
                                Triathlon Fights: <?php echo !empty($data['stats']->triathlons->win) ? $data['stats']->triathlons->win: 0 ; ?><br>
                                Profights Fights: <?php echo !empty($data['stats']->profights->win) ? $data['stats']->profights->win : 0 ;?>  KO <?php echo !empty($data['user']->profights->ko) ? $data['user']->profights->ko : 0 ;?><br>
                            </div>
                        </div>

                        <hr>

                        <h4><strong>Favourite quote:</strong></h4>
                        <p>"<?php echo $data['user']->quote ?>"</p>


                        <h4><strong>About:</strong></h4>
                        <p><?php echo $data['user']->about ?></p>

                    </div>

                </div>

                <div class="col-md-3">
                    <?php if (empty($data['user']->coa)) : ?>
                        <?php if (Session::exists('user') and ($data['user']->id == Session::get('user'))): ?>
                        <a href="<?php echo Url::path()?>/home/photo/<?php echo $data['user']->id?>/coaPhoto" class="btn btn-success btn-sm">Upload Coat of arms</a>
                            <?php endif; ?>
                    <?php else :?>
                        <?php if (Session::exists('user') and ($data['user']->id == Session::get('user'))): ?>
                        <a href="<?php echo Url::path()?>/home/photo/<?php echo $data['user']->id?>/coaPhoto"> <img class="img-responsive" src="<?php echo $data['user']->coa ?>" alt=""></a>
                            <?php else:?>
                            <img class="img-responsive" src="<?php echo $data['user']->coa ?>" alt="">
                            <?php endif; ?>
                    <?php endif;?>
                </div>

            </div>
            <!-- /.row -->
        </div>
        <!-- /.container-fluid -->
    </div>
    <!-- /#page-wrapper -->
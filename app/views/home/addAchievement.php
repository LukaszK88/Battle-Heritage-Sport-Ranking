<?php
/**
 * Created by PhpStorm.
 * User: Lukasz
 * Date: 15/11/2016
 * Time: 21:20
 */

use Battleheritage\core\Message;
use Battleheritage\Validation\Validator;
use Battleheritage\core\Input;
?>

<!-- Page Content -->
<div id="page-wrapper">
    <div class="container-fluid">
        <div class="row">
            <div class="col-lg-12">
                <h1 class="page-header">Admin Page</h1>
                <div class="col-lg-4 col-lg-offset-4">
                    <?php Message::displayMessage(); ?>
                    <h2>Add achievement</h2>
                    <form action="" method="post" enctype="multipart/form-data">

                        <div class="form-group <?php if(Validator::validationErrorExists('competitionName')):  ?> has-error <?php endif; ?> ">
                            <label for="competitionName">Competiton Name</label>
                            <input name="competitionName" class="form-control" value="<?php echo !empty($data['user']->competitionName) ? $data['user']->competitionName : Input::get('competitionName');?>">

                                <span class="help-block">
                                    <?php Validator::validationError('competitionName') ?>
                                </span>

                        </div>
                        <div class="form-group <?php if(Validator::validationErrorExists('place')):  ?> has-error <?php endif; ?>">
                            <label for="place">Place</label>
                            <select name="place" class="form-control" >
                                <option value="<font color='#ffd700'><span class='fa fa-trophy fa-2x '></span></font>" >1st</option>
                                <option value="" >2nd</option>
                                <option value="">3rd</option>
                            </select>
                            <span class="help-block">
                            <?php Validator::validationError('place') ?>
                                </span>

                        </div>
                        <div class="form-group <?php if(Validator::validationErrorExists('location')):  ?> has-error <?php endif; ?>">
                            <label for="location">Location</label>
                            <input name="location" class="form-control" value="<?php echo !empty($data['user']->location) ? $data['user']->location : Input::get('location');?>">

                            <span class="help-block">
                                    <?php Validator::validationError('location') ?>
                                </span>
                        </div>

                        <div class="form-group"> <!-- Date input -->
                            <label class="control-label" for="date">Date</label>
                            <input class="form-control" id="date" name="date" placeholder="MM/DD/YYY" type="text"/>
                        </div>

                        <button type="submit" name="submit" class="btn btn-success">Submit</button><br><br>

                    </form>
                </div>


            </div>
            <!-- /.col-lg-12 -->
        </div>
        <!-- /.row -->
    </div>
    <!-- /.container-fluid -->
</div>
<!-- /#page-wrapper -->



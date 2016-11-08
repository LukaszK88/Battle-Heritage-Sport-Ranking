<?php
/**
 * Created by PhpStorm.
 * User: Lukasz
 * Date: 08/11/2016
 * Time: 14:02
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
                <div class="col-lg- col-lg-offset-4">
                    <?php Message::displayMessage(); ?>
                    <h2>Add Record</h2>
                    <form action="" method="post">
                        <div class="form-group <?php if(Validator::validationErrorExists('win')):  ?> has-error <?php endif; ?> ">
                            <label for="win">Win</label><br>
                            <input class="ex1" data-slider-id='ex1Slider' name="win" type="text" data-slider-min="0" data-slider-max="20" data-slider-step="1" data-slider-value="">

                            <span class="help-block">
                                    <?php Validator::validationError('win') ?>
                            </span>

                        </div>
                        <div class="form-group <?php if(Validator::validationErrorExists('loss')):  ?> has-error <?php endif; ?>">
                            <label for="loss">Loss</label><br>
                            <input class="ex1" data-slider-id='ex1Slider' name="loss" type="text" data-slider-min="0" data-slider-max="20" data-slider-step="1" data-slider-value="">

                            <span class="help-block">
                                    <?php Validator::validationError('loss') ?>
                                </span>

                        </div>
                        <div class="form-group <?php if(Validator::validationErrorExists('ko')):  ?> has-error <?php endif; ?>">
                            <label for="ko">KO</label><br>
                            <input class="ex1" data-slider-id='ex1Slider' name="ko" type="text" data-slider-min="0" data-slider-max="20" data-slider-step="1" data-slider-value="">

                            <span class="help-block">
                                    <?php Validator::validationError('ko') ?>
                                </span>
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

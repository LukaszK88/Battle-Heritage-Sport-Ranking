<?php
/**
 * Created by PhpStorm.
 * User: Lukasz
 * Date: 12/11/2016
 * Time: 17:38
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
                <h1 class="page-header">Settings</h1>
                <div class="col-lg-4 col-lg-offset-4">
                    <?php Message::displayMessage(); ?>
                    <h2>Change password</h2>
                    <form action="" method="post" enctype="multipart/form-data">
                        <?php if(empty($data['user']->temp_password)) :?>
                        <div class="form-group <?php if(Validator::validationErrorExists('password_current')):  ?> has-error <?php endif; ?> ">
                            <label for="password_current">Current password</label>
                            <input name="password_current" class="form-control" type="password" value="<?php echo Input::get('password_current');?>">

                                <span class="help-block">
                                    <?php Validator::validationError('password_current') ?>
                                </span>

                        </div>
                        <?php endif;?>
                        <div class="form-group <?php if(Validator::validationErrorExists('new_password')):  ?> has-error <?php endif; ?>">
                            <label for="new_password">New password</label>
                            <input name="new_password" class="form-control" type="password">

                            <span class="help-block">
                                    <?php Validator::validationError('new_password') ?>
                                </span>

                        </div>

                        <div class="form-group <?php if(Validator::validationErrorExists('new_password_again')):  ?> has-error <?php endif; ?>">
                            <label for="new_password_again">New password again</label>
                            <input name="new_password_again" class="form-control" type="password">

                            <span class="help-block">
                                    <?php Validator::validationError('new_password_again') ?>
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
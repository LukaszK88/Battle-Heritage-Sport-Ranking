<?php
/**
 * Created by PhpStorm.
 * User: Lukasz
 * Date: 11/11/2016
 * Time: 11:03
 */
use Battleheritage\core\Message;
use Battleheritage\Validation\Validator;
use Battleheritage\core\Input;
?>
<div id="page-wrapper">
<div class="container-fluid">
    <div class="row">
        <div class="col-md-4 col-md-offset-4">
            <div class="login-panel panel panel-default">
                <div class="panel-heading">
                    <h3 class="panel-title">Register</h3>
                    <?php Message::displayMessage() ?>
                </div>
                <div class="panel-body">
                    <form action="" method="post">
                        <fieldset>
                            <div class="form-group <?php if(Validator::validationErrorExists('email')):  ?> has-error <?php endif; ?>">
                                <input class="form-control" placeholder="E-mail" name="email" type="email" autofocus>

                                <span class="help-block">
                                    <?php Validator::validationError('email') ?>
                                </span>

                            </div>

                            <div class="checkbox">
                                <label>
                                    <input name="remember" type="checkbox" value="Remember Me">Remember Me
                                </label>
                            </div>
                            <!-- Change this to a button or input when using this as a form -->
                            <input type="submit" value="Register" class="btn btn-lg btn-success btn-block">
                        </fieldset>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
</div>


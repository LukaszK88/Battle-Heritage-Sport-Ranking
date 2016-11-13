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
                        <h3 class="panel-title">Log in</h3>
                    </div>
                    <div class="panel-body">
                        <form action="" method="post">
                            <fieldset>
                                <div class="form-group <?php if(Validator::validationErrorExists('username')):  ?> has-error <?php endif; ?>">
                                    <input class="form-control" placeholder="E-mail" name="username" type="email" autofocus>

                                <span class="help-block">
                                    <?php Validator::validationError('username') ?>
                                </span>

                                </div>
                                <div class="form-group <?php if(Validator::validationErrorExists('password')):  ?> has-error <?php endif; ?>">
                                    <input class="form-control" placeholder="Password" name="password" type="password" autofocus>

                                <span class="help-block">
                                    <?php Validator::validationError('password') ?>
                                </span>

                                </div>

                                <div class="checkbox">
                                    <label>
                                        <input name="remember" type="checkbox" value="on">Remember Me
                                    </label>
                                </div>
                                <!-- Change this to a button or input when using this as a form -->
                                <input type="submit" value="Log in" class="btn btn-lg btn-success btn-block">
                            </fieldset>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>


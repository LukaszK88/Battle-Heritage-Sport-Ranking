<?php
/**
 * Created by PhpStorm.
 * User: Lukasz
 * Date: 07/11/2016
 * Time: 21:41
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
                    <h2>Add Fighter</h2>
                    <form action="" method="post" enctype="multipart/form-data">

                        <div class="form-group <?php if(Validator::validationErrorExists('name')):  ?> has-error <?php endif; ?> ">
                            <label for="name">Name</label>
                            <input name="name" class="form-control" value="<?php echo !empty($data['user']->name) ? $data['user']->name : Input::get('name');?>">

                                <span class="help-block">
                                    <?php Validator::validationError('name') ?>
                                </span>

                        </div>
                        <div class="form-group <?php if(Validator::validationErrorExists('rank')):  ?> has-error <?php endif; ?>">
                            <label for="rank">Rank</label>
                            <select name="rank" class="form-control" >
                                <option >Recruit</option>
                                <option >Fighter</option>
                                <option >Veteran</option>
                                <option >Elite</option>
                            </select>
                            <span class="help-block">
                            <?php Validator::validationError('rank') ?>
                                </span>

                        </div>
                        <div class="form-group <?php if(Validator::validationErrorExists('age')):  ?> has-error <?php endif; ?>">
                            <label for="age">Age</label>
                            <input name="age" class="form-control" value="<?php echo !empty($data['user']->age) ? $data['user']->age : Input::get('age');?>">

                            <span class="help-block">
                                    <?php Validator::validationError('age') ?>
                                </span>
                        </div>
                        <div class="form-group <?php if(Validator::validationErrorExists('weight')):  ?> has-error <?php endif; ?>">
                            <label for="weight">Weight</label>
                            <input name="weight" class="form-control" value="<?php echo !empty($data['user']->weight) ? $data['user']->weight : Input::get('weight');?>">

                            <span class="help-block">
                                    <?php Validator::validationError('weight') ?>
                                </span>

                        </div>
                        <div class="form-group <?php if(Validator::validationErrorExists('region')):  ?> has-error <?php endif; ?>">

                                <label for="region">Region:</label><br>
                                <select name="region" class="form-control" >
                                    <option >South East</option>
                                    <option >Mercia</option>
                                    <option >North</option>
                                    <option >Wales</option>
                                    <option >North</option>
                                </select>

                            <span class="help-block">
                                    <?php Validator::validationError('region') ?>
                                </span>

                        </div>
                        <div class="form-group <?php if(Validator::validationErrorExists('quote')):  ?> has-error <?php endif; ?>">
                            <label for="quote">Quote</label>
                            <input name="quote" class="form-control" value="<?php echo !empty($data['user']->quote) ? $data['user']->quote : Input::get('quote');?>">

                            <span class="help-block">
                                    <?php Validator::validationError('quote') ?>
                                </span>

                        </div>
                        <div class="form-group <?php if(Validator::validationErrorExists('about')):  ?> has-error <?php endif; ?>">
                            <label for="about">About</label>
                            <textarea rows="5" name="about" class="form-control" ><?php echo !empty($data['user']->about) ? $data['user']->about : Input::get('about');?></textarea>

                            <span class="help-block">
                                    <?php Validator::validationError('about') ?>
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

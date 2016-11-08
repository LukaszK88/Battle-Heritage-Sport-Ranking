<?php
/**
 * Created by PhpStorm.
 * User: Lukasz
 * Date: 08/11/2016
 * Time: 13:05
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
                    <h2>Update Fighter record</h2>
                    <form action="" method="post">
                        <div class="form-group">
                            <label for="category">Category:</label><br>
                            <select name="category" class="form-control" >
                                <option >bohurt</option>
                                <option >imcf</option>
                                <option >profight</option>
                                <option >triathlon</option>
                            </select>
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

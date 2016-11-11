<?php
/**
 * Created by PhpStorm.
 * User: Lukasz
 * Date: 11/11/2016
 * Time: 08:45
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
                    <h2>Add Fighter photo</h2>
                    <form action="" method="post" enctype="multipart/form-data">

                        <?php if($data['photoUpdate']=='profilePhoto'):?>

                            <div class="form-group">
                                <label for="image">Image</label>
                                <input type="file" name="image" class="form-control">
                            </div>

                        <?php elseif($data['photoUpdate']=='coaPhoto'):?>

                            <div class="form-group">
                                <label for="coa">Coat of arms</label>
                                <input type="file" name="coa" class="form-control">
                            </div>

                        <?php endif; ?>

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



<?php
/**
 * Created by PhpStorm.
 * User: Lukasz
 * Date: 07/11/2016
 * Time: 08:40
 */
use Battleheritage\core\Url ;
?>
</div>
<!-- /#wrapper -->

<!-- jQuery -->
<script src="<?php echo Url::main()?>/vendor/jquery/jquery.min.js"></script>

<!-- Bootstrap Core JavaScript -->
<script src="<?php echo Url::path()?>/js/bootstrap-slider.min.js"></script>
<script src="<?php echo Url::path()?>/js/bootstrap-slider.js"></script>
<script src="<?php echo Url::main()?>/vendor/bootstrap/js/bootstrap.min.js"></script>

<!-- Metis Menu Plugin JavaScript -->
<script src="<?php echo Url::main()?>/vendor/metisMenu/metisMenu.min.js"></script>

<!-- Custom Theme JavaScript -->
<script src="<?php echo Url::path()?>/js/sb-admin-2.js"></script>

<script>$('.ex1').slider({
        formatter: function(value) {
            return 'Current value: ' + value;
        }
    });</script>

<script>
    $(document).ready(function(){
        $('.dropdown-submenu a.test').on("click", function(e){
            $(this).next('ul').toggle();
            e.stopPropagation();
            e.preventDefault();
        });
    });
</script>
<!-- Include Date Range Picker -->
<script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.4.1/js/bootstrap-datepicker.min.js"></script>
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.4.1/css/bootstrap-datepicker3.css"/>

<script>

    $(document).ready(function(){
        var date_input=$('input[name="date"]'); //our date input has the name "date"
        var container=$('.bootstrap-iso form').length>0 ? $('.bootstrap-iso form').parent() : "body";
        var options={
            format: "yyyy/mm/dd",
            startView: "year",
            minViewMode: "months"
        };
        date_input.datepicker(options);
    })

</script>

</body>

</html>

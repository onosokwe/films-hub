<?php
session_start();
include('apps/api.php') ;
$failed = false;
$form = $_POST['key'];
// $form = 1;
if ($form == 1){
    $ref = $_POST['dat'];
    $oid = $_SESSION['checkout'][1];
    $email = $_SESSION['checkout'][2];
    $total = $_SESSION['checkout'][3];
    $count = $_SESSION['checkout'][4];
    $table = "tbl_orders"; $time = time();
    $colVals = "`status` = '2', `order_ref` = '{$ref}', `time_paid` = '$time'";
    $where = "WHERE `order_id` = '{$oid}' AND `user_email` = '$email'";
    $update = $crud->update($table,$colVals,$where);
    if($update){
        if ($shoot = $crud->shoot_mail($email)){
            session_destroy();
        } else{session_destroy();} ?>
        <script type="text/javascript">
            alert('Purchase Successful! Check your email for your book!'); 
            window.location = "./";
        </script>
    <?php } else $failed = true;
}
?>

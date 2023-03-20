

<?php
if(isset($_SESSION['status']) && $_SESSION['status']!=''){
    ?>
    <script >
   swal("<?php echo $_SESSION['status'];?>", "Click ok button to proceed", "<?php echo $_SESSION['status_code'];?>");
    </script>
<?php

    unset($_SESSION['status']);
}


?>



<?php
if(isset($_SESSION['statuss']) && $_SESSION['statuss']!=''){
    ?>
    <script >
   swal("<?php echo $_SESSION['statuss'];?>", "Click ok button to proceed", "<?php echo $_SESSION['status_codes'];?>");
    </script>
<?php

    unset($_SESSION['statuss']);
}


?>
<?php
if (isset($_POST['sign_btn'])) {
    // echo "s";
    $u_name = $_POST['u_name'];
    $u_lastname = $_POST['u_lastname'];
    $u_email = $_POST['u_email'];
    $pass = $_POST['u_pass'];
    $u_gender = $_POST['u_gender'];
    $u_country = $_POST['u_country'];
    
    $u_pass = password_hash($pass,PASSWORD_DEFAULT);
    
    $sql = "INSERT INTO `users`(`user_name`, `user_lastname`, `user_email`, `user_pass`, `user_profile`, `user_gender`, `user_country`, `user_level`) 
                        VALUES ('$u_name','$u_lastname','$u_email','$u_pass','assets/images/default.png','$u_gender','$u_country','request')";
    // var_dump($sql);

    if ($conn->query($sql)) {

        alert("warning","สร้างอีเมลเสร็จสิ้น รอการอณุมัติ");
    }else{
        alert("danger","มีอีเมล $u_email แล้ว");
    }

}
?>
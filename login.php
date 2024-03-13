<?php 
    session_start();
    include_once("db.php");
    if(isset($_POST['submit']))
    {
        $username = $password = "";
        $error = "";

        if($_SERVER["REQUEST_METHOD"] == "POST"){
            if(!empty(trim($_POST["txtusername"]))){
                $username = trim($_POST["txtusername"]);
            }
            else
            {
                $error="<div class='text-danger'>Vui lòng nhập tên đăng nhập</div>";
            }

            if(!empty(trim($_POST["txtpassword"]))){
                $password = trim($_POST["txtpassword"]);
                
            }
            else
            {
                $error1="<div class='text-danger'>Vui lòng nhập mật khẩu</div>";    
            }

            

            if(empty($error)){
                $stmt = $conn->prepare("SELECT * FROM Users WHERE Username = ?");     
                $stmt->execute(array($username));
                $r=$stmt->fetch(PDO::FETCH_ASSOC);
                
                
                if($r === false){        
                    $error="<div class='text-danger'>Người dùng $username không tồn tại.</div>";    
                }
                else {
                    if($password === $r['Password'])
                    {
                        $role_level=$r['Role'];
                        $_SESSION['email']=$r['Email'];
                        $_SESSION['username']=$r['Username'];
                        $_SESSION['userid']=$r['UserID'];        
                        $_SESSION['faculty']=$r['FacultyID'];        
                        $_SESSION['role_level']=$role_level;
                        
                            
                        switch ($role_level) {
                            case 'Guest':
                                header("location: Guest/guest.php");
                                exit();
                            case 'Student':
                                header("location: Student/student.php");
                                exit();
                            case 'Coordinator':
                                header("location: Coordinator/coordinator.php");
                                exit();
                            case 'MarketingManager':
                                header("location: Manager/manager.php");
                                exit();
                            case 'Admin':
                                header("location: Admin/admin.php");
                                exit();
                        }
                    }
                    else {
                        $error="<div class='text-danger'><center>Mật khẩu không đúng</center></div>";
                    }
                }
            }
        }
    }
?>




<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="login.css">
    <link href='https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css' rel='stylesheet'>
    <title>Login Page</title>
</head>
<body>
    <div class="wrapper">
        <form method="post" action="login.php">
            <h1>Login</h1>
            <div class="input-box">
                <input type="text" placeholder="Username" id="txtusername" name="txtusername" >
                <i class='bx bxs-user'></i>
                <?php if(isset($error)){
                    echo $error;                   
                }?>
            </div>

            <div class="input-box">
                <input type="password" id="txtpassword" placeholder="Password" name="txtpassword" >
                <i class='bx bxs-lock-alt'></i>
                <?php
                if(isset($error1)){
                    echo $error1;                   
                }?>
            </div>

            <div class="remember-forgot">
                <label><input type="checkbox">Remember me</label>
                <a href="#">Forgot password?</a>
            </div>

            <button type="submit" name="submit" value="submit" class="btn">Login</button>
            <div class="register-link">
                <p>Student doesn't have account?
                    <a href="#">Register</a>
                </p>
            </div>
        </form>
    </div>
</body>
</html>
<?php 
include 'db.php';




  if (isset($_POST['create'])) {
    $username = $_POST['username'];
    $password = $_POST['password'];
    $email = $_POST['email'];
    $phone = $_POST['phone'];
    $DOB = $_POST['DOB'];
    $gender = $_POST['gender'];
    $address = $_POST['address'];
    $role = $_POST['role'];
    $faculty = $_POST['faculty'];
    $emailadd = filter_var($_POST['email'], FILTER_SANITIZE_EMAIL);

  if(filter_var($emailadd, FILTER_VALIDATE_EMAIL))
  {
        $query = $conn->prepare("Select * from users Where Email = :email");
        $query->bindParam(':email', $email);
        $query->execute();
        $result=$query->fetch();
        if($result != false)
        {
            echo "invalid email";
        }
  }
  else{
      $sql = "INSERT INTO users (Username, Password, Email, PhoneNumber, DOB, Gender,Address,Role,FacultyID) 
      VALUES (:username, :password, :email, :phone, :DOB, :gender,:address,:role,:faculty)";
      $query = $conn->prepare($sql);     
      $query->bindParam(':username', $username);
      $query->bindParam(':email', $email);
      $query->bindParam(':password', $password);	
      $query->bindParam(':DOB', $DOB);	
      $query->bindParam(':gender', $gender);	
      $query->bindParam(':address', $address);				
      $query->bindParam(':faculty', $faculty);
      $query->bindParam(':role', $role);
      $query->bindParam(':phone', $phone);
      $result = $query->execute();
  }
      }
  
?>



<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Add new accounts</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/css/bootstrap.min.css" integrity="sha384-xOolHFLEh07PJGoPkLv1IbcEPTNtaed2xpHsD9ESMhqIYd0nLMwNLD69Npy4HI+N" crossorigin="anonymous">
    <link rel="stylesheet" href="css/adminManage.css">
</head>
    <style>
    .main--content {
        position: relative;
        background: #ebe9e9;
        width: 100%;
        padding: 1rem;
    }
    .header--wrapper img{
        width: 50px;
        height: 50px;
        cursor: pointer;
        border-radius: 50%;
    }
    .header--wrapper {
        display: flex;
        justify-content: space-between;
        align-items: center;
        flex-wrap: wrap;
        background: #fff;
        border-radius: 10px;
        padding: 10px 2rem;
        margin-bottom: 1rem;
    }
    .header--title{
        color: rgba(113, 99, 186, 255);
    }

    .user--info {
        display: flex;
        align-items: center;
        gap: 1rem;
    }

    .search--box {
        background: rgb(237,237,237);
        border-radius: 15px;
        color: rgba(113, 99, 186, 255);
        display: flex;
        align-items: center;
        gap: 5px;
        padding: 4px 12px;
    }

    .search--box input {
        background: transparent;
        padding: 10px;
    }

    .search--box i {
        font-size: 1.2rem;
        cursor: pointer;
        transition: all 0.5s ease-out;
    }
    .search--box i:hover {
        transform: scale(1.2);
    }
    .card--wrapper {
        display: flex;
        flex-wrap: wrap;
        gap: 1rem;
    }

    .main--title {
        color: rgba(113, 99, 186, 255);
        padding-bottom: 10px;
        font-size: 20px;
    }

    .payment--card {
        background: rgb(229,223,223);
        border-radius: 10px;
        padding: 1.2rem;
        width: 290px;
        height: 150px;
        display: flex;
        flex-direction: column;
        justify-content: space-between;
        transition: all 0.5s ease-in-out;
    }
    .payment--card:hover {
        transform: translateY(-5px);
    }

    .card--header {
        display: flex;
        justify-content: space-between;
        align-items: center;
        margin-bottom: 20px;
    }

    .amount {
        display: flex;
        flex-direction: column;
    }
    
    .title {
        font-size: 15px;
        font-weight: 600;
    }

    .amount--value {
        font-size: 24px;
        font-family: 'Courier New', Courier, monospace;
        font-weight: 700;
    }

    .fa-regular  {
        color: #fff;
        padding: 1rem;
        height: 60px;
        width: 60px;
        text-align: center;
        border-radius: 50%;
        font-size: 1.5rem;
        background: green;
    }

    .card-detail {
        font-size: 18px;
        color: #777777;
        letter-spacing: 2px;
        font-family: 'Courier New', Courier, monospace;
    }

    /* color css*/
    .light-red {
        background: rgb(251, 233, 233);
    }
    .light-purple {
        background: rgb(254, 226, 254);
    }
    .light-green {
        background: rgb(235, 254, 235);
    }
    .light-blue {
        background: rgb(236, 236, 254);
    }
    .dark-red {
        background: red;
    }
    .dark-purple {
        background: purple;
    }
    .dark-green {
        background: green;
    }
    .dark-blue {
        background: blue;
    }
    .tabular--wrapper {
        background: #fff;
        margin-top: 1rem;
        border-radius: 10px;
        padding: 2rem;
    }
    </style>
<body>
    <div class="sidebar">
        <div class="logo"></div>
        <ul class="menu">
            <li class="active">
                <a href="adminManage.php">
                    <i class="fa-solid fa-house"></i>
                    <span>Home</span>
                </a>
            </li>
            <li>
                <a href="#">
                    <i class="fa-solid fa-user"></i>
                    <span>Profile</span>
                </a>
            </li>
            <li>
                <a href="#">
                    <i class="fa-solid fa-chart-column"></i>
                    <span>Statistics</span>
                </a>
            </li>
            <li>
                <a href="#">
                    <i class="fa-solid fa-circle-question"></i>
                    <span>FAQ</span>
                </a>
            </li>
            <li>
                <a href="#">
                    <i class="fa-solid fa-gear"></i>
                    <span>Settings</span>
                </a>
            </li>
            <li>
                <a href="#">
                    <i class="fa-solid fa-users"></i>
                    <span>Account</span>
                </a>
            </li>
            <li class="logout">
                <a href="#">
                    <i class="fa-solid fa-right-from-bracket"></i>
                    <span>Log Out</span>
                </a>
            </li>
        </ul>
    </div>
    <div class="main--content">
        <div class="header--wrapper">
            <div class="header--title">
                <span style="font-weight: bold">University Of Greenwich</span>
                <h1>ADD NEW ACCOUNTS</h1>
            </div>
            <div class="user--info">
                <div class="search--box">
                    <i class="fa-solid fa-magnifying-glass"></i>
                    <input type="text" placeholder="Search">
                </div>
                <img src="../image/image.png" alt="">
            </div>
        </div>

        <div class="tabular--wrapper">
        <form method="POST" action='adduser.php'>
        
<div class="form-group">
    <label for="username">User name</label>
    <input type="text" name="username"class="form-control" id="username"  placeholder="Enter name">
</div>
<div class="form-group">
    <label for="exampleInputPassword1">Password</label>
    <input type="password" name="password" class="form-control" id="exampleInputPassword1" placeholder="Password">
  </div>
  <div class="form-group">
    <label for="exampleInputEmail1">Email address</label>
    <input type="email" name="email" class="form-control" id="email" aria-describedby="emailHelp" placeholder="Enter email">
    <small id="emailHelp" class="form-text text-muted">We'll never share your email with anyone else.</small>
  </div>
  <div class="form-group">
    <label for="phone">Phone</label>
    <input type="text" name="phone" class="form-control" id="phone" placeholder="Phone">
  </div>
  <div class="form-group">
    <label for="DOB">DOB</label>
    <input type="date" name="DOB" class="form-control" id="date" placeholder="DOB">
  </div>
  <div class="form-group">
    <label for="gender">Gender</label>
    <input type="text" name="gender" class="form-control" id="gender" placeholder="gender">
  </div>
  <div class="form-group">
    <label for="address">Address</label>
    <input type="text"  name="address"class="form-control" id="address" placeholder="address">
  </div>
  <div class="form-group">
    <label for="role">Role</label> <br>
    <select class="form-control" id="role" name="role">
        <option>Select a role</option>
        <option value="admin">Admin</option>
        <option value="marketingCordinator">Marketing Cordinator</option>
        <option value="guest">Guest</option>
        <option value="marketingManager">Marketing Manager</option>
    </select>
  </div>
  <div class="form-group">
  <label for="faculty">Faculty</label>

<select name="faculty" class="form-control">
<?php
    $query = "SELECT * FROM faculty;";
    $result = $conn->prepare($query);                            
    $result->execute(); 
    $faculty = $result->fetchAll();
?>       
    <option value=""></option>   
    <?php foreach ($faculty as $fac): ?>
       <option value="<?php echo $fac['FacultyID'];?>">
       <?php echo $fac['FacultyName'];?>
       <?php endforeach ?>  
</select>
  </div>
  <div class="form-group">                                                                   
    <button type="submit" name="create" class="btn btn-success">Add</button>                   
</div>
                                                
</form>
        </div>

    </div>




    <script src="https://cdn.jsdelivr.net/npm/jquery@3.5.1/dist/jquery.slim.min.js" integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.1/dist/umd/popper.min.js" integrity="sha384-9/reFTGAW83EW2RDu2S0VKaIzap3H66lZH81PoYlFhbGU+6BZp6G7niu735Sk7lN" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/js/bootstrap.min.js" integrity="sha384-+sLIOodYLS7CIrQpBjl+C7nPvqq+FbNUBDunl/OZv93DB7Ln/533i8e/mZXLi/P+" crossorigin="anonymous"></script>
</body>
    
</html>
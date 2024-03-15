<?php 
include 'db.php';

          
if($_SERVER['REQUEST_METHOD'] == 'POST') {

    if (isset($_POST['UserID'])) {
        // Lấy UserID từ dữ liệu gửi đi từ form
       echo "ton tai";
    }
    else{
      echo "UserID ko ton tai";

    }
 $userid = $_POST['UserID'];
  echo $userid;      
    
}
var_dump($_POST);


    $stmt = "SELECT * FROM users WHERE UserID=:userid" ;
    $statement = $conn->prepare($stmt);
    $statement->execute([':userid' => $userid ]);
    $data = $statement->fetch(PDO::FETCH_OBJ);
    $load1= $data->UserID;
    $load2= $data->Username;
    $load3= $data->Password; 
    $load4= $data->Email;
    $load5= $data->PhoneNumber;  
    $load6= $data->DOB;   
    $load7= $data->Gender;    
    $load8= $data->Address;    
    $load9= $data->Role;   
    $load10= $data->FacultyID;     


    $stmt = $conn->prepare("SELECT * FROM faculty WHERE FacultyID =? ");     
    $stmt->execute(array($load10));
    $data = $stmt->fetch(PDO::FETCH_OBJ);   
    $load11= $data->FacultyName;
 

    if(isset($_POST["update"])) {
        var_dump($_POST);
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
    
    //   if(!filter_var($emailadd, FILTER_VALIDATE_EMAIL))
    //   {
    //         $query = $conn->prepare("Select * from users Where Email = :email");
    //         $query->bindParam(':email', $email);
    //         $query->execute();
    //         $result=$query->fetch();
    //         if($result != false)
    //         {
    //            $err = "invalid email";
    //         }
    //   }
    //   else if(!preg_match("^0/d[9]{0,10}",$phone))
    //   {
    //     $err = "invalid phone number";
    //   }
    //   else{
          $sql = "UPDATE users SET Username=:username, Password=:password, Email=:email, PhoneNumber=:phone, DOB=:DOB, Gender=:gender,Address=:address,Role=:role,FacultyID=:faculty 
          WHERE UserID=:userid;";
          $query = $conn->prepare($sql);  
          $query->bindParam(':username', $username);
          $query->bindParam(':userid', $userid);
          $query->bindParam(':email', $email);
          $query->bindParam(':password', $password);	
          $query->bindParam(':DOB', $DOB);	
          $query->bindParam(':gender', $gender);	
          $query->bindParam(':address', $address);				
          $query->bindParam(':faculty', $faculty);
          $query->bindParam(':role', $role);
          $query->bindParam(':phone', $phone);
          $query->execute();
          echo $userid;
      
    //}

    }

  
?>



<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.3.1/dist/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
    <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/popper.js@1.14.7/dist/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@4.3.1/dist/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>
    <title>Document</title>
</head>
<body>
<form method="POST" >

<div class="form-group">
    
    <input type="hidden" name="UserID"class="form-control" id="UserID" value="<?php echo $load1 ?>" >
</div>
<div class="form-group">
    <label for="username">User name</label>
    <input type="text" name="username"class="form-control" id="username" value="<?php echo $load2 ?>" placeholder="Enter name">
</div>
<div class="form-group">
    <label for="exampleInputPassword1">Password</label>
    <input type="password" name="password" class="form-control" value="<?php echo   $load3  ?>" placeholder="Password">
  </div>
  <div class="form-group">
    <label for="exampleInputEmail1">Email address</label>
    <input type="email" name="email" class="form-control" id="email"  value="<?php echo  $load4 ?>"aria-describedby="emailHelp" placeholder="Enter email">
    <small id="emailHelp" class="form-text text-muted">We'll never share your email with anyone else.</small>
  </div>
  <div class="form-group">
    <label for="phone">Phone</label>
    <input type="text" name="phone" class="form-control" value="<?php echo  $load5 ?>" id="phone" placeholder="Phone">
  </div>
  <div class="form-group">
    <label for="DOB">DOB</label>
    <input type="date" name="DOB" class="form-control" value="<?php echo  $load6 ?>"  id="date" placeholder="DOB">
  </div>
  <div class="form-group">
    <label for="gender">gender</label>
    <input type="text" name="gender" class="form-control" value="<?php echo $load7 ?>"  id="gender" placeholder="gender">
  </div>
  <div class="form-group">
    <label for="address">address</label>
    <input type="text"  name="address"class="form-control" value="<?php echo  $load8 ?>" id="address" placeholder="address">
  </div>
  <div class="form-group">
    <label for="role">role</label>
    <input type="text" name="role"class="form-control" value="<?php echo  $load9 ?>"  id="role" placeholder="role">
  </div>
  <div class="form-group">
  <label for="faculty">faculty</label>

<select name="faculty" class="form-control">
<?php
    $query = "SELECT * FROM faculty;";
    $result = $conn->prepare($query);                            
    $result->execute(); 
    $faculty = $result->fetchAll();
   
?>       

    <?php foreach ($faculty as $fac): ?>

       <option value="<?php echo $fac['FacultyID'];?>">
    <?php   echo $fac['FacultyName']?>
      
       </option>
       <?php endforeach ?>  
</select>
  </div>
  <div class="form-group">                                
                                    
    <button type="submit" name="update" class="btn btn-success btn-md mb-3">update</button>
                                    
                                    
</div>

  <
 
                                                
</form>

</body>
</html>
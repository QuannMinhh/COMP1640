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
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.3.1/dist/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
    <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/popper.js@1.14.7/dist/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@4.3.1/dist/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>
    <title>Document</title>
</head>
<body>
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
    <label for="gender">gender</label>
    <input type="text" name="gender" class="form-control" id="gender" placeholder="gender">
  </div>
  <div class="form-group">
    <label for="address">address</label>
    <input type="text"  name="address"class="form-control" id="address" placeholder="address">
  </div>
  <div class="form-group">
    <label for="role">role</label>
    <input type="text" name="role"class="form-control" id="role" placeholder="role">
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
    <option value=""></option>   
    <?php foreach ($faculty as $fac): ?>
       <option value="<?php echo $fac['FacultyID'];?>">
       <?php echo $fac['FacultyName'];?>
       <?php endforeach ?>  
</select>
  </div>
  <div class="form-group">                                
                                    
    <button type="submit" name="create" class="btn btn-success btn-md mb-3">Add</button>
                                    
                                    
</div>

  <
 
                                                
</form>

</body>
</html>
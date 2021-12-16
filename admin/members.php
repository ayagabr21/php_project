<?php session_start();?>
<?php include "config.php"?> 
<?php include "includes/header.php"?>
<?php include "includes/navbar.php"?>

<?php 
  if(isset($_GET['action'])){
      $do = $_GET['action']; 
  }else{
    $do =  "index" ;
  }

?>
<!-- make end user see as if there are many pages -->

<?php if($do == "index"):?>
     <h1 class="text-center">All members</h1>
     <?php
     $stmt = $con->prepare("SELECT * FROM `users`");
     $stmt->execute();
     $users =$stmt->fetchAll();
     ?>
     <div class="container">
     
     
     <table class="table">
  <thead>
    <tr>
      <th scope="col">#</th>
      <th scope="col">username</th>
      <th scope="col">created at</th>
      <th scope="col">control</th>
    </tr>
  </thead>
  <tbody>
    <?php foreach($users as $user):?>
    <tr>
      <th scope="row">1</th>
      <td><?=$user['username']?></td>
      <td><?=$user['email']?></td>
      <td>@mdo</td>
    
    </tr>
    <?php endforeach ?>
    
  </tbody>
</table>
<a class="btn btn-primary" href="?action=create"> add user</a>
</div>

<!-- ------------------------------------------ -->
<?php elseif($do == "create"):?>
    <h1 class="text-center">add user</h1>
    <div class="container">


    <form method="POST" action="members.php?action=store">
    <div class="mb-3">
    <label for="exampleInputEmail1" class="form-label">username</label>
    <input type="text" name="username" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp">
  </div>
  <div class="mb-3">
    <label for="exampleInputEmail1" class="form-label">Email address</label>
    <input type="email" name="email"class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp">
    <div id="emailHelp"  class="form-text">We'll never share your email with anyone else.</div>
  </div>
  <div class="mb-3">
    <label for="exampleInputPassword1" class="form-label">Password</label>
    <input type="password" name="password" class="form-control" id="exampleInputPassword1">
  </div>
  <div class="mb-3">
    <label for="exampleInputPassword1" class="form-label">Phone</label>
    <input type="number" name="phone" class="form-control" >
  </div>
  <button type="submit" class="btn btn-primary">Submit</button>
</form>

    </div>

<!-- -------------------------------- -->
<?php elseif($do == "store"):?>
    <?php
      if($_SERVER['REQUEST_METHOD']== "POST")
      {
        $username=$_POST['username'];
        $email=$_POST['email'];
        $password=sha1( $_POST['password']);
        $phone=$_POST['phone'];
        $stmt=$con->prepare(
          "INSERT INTO `users`( `username`, `email`, `password`, `role`, `phone`, `img`, `created_at`) 
          VALUES (?, ? , ?,'user',?,Null,now())"

        );
        $stmt->execute(array($username,$email,$password,$phone));
        header("location:members.php");
      }

      ?>

<!-- -------------- --------------------->

<?php elseif($do == "edit"):?>
    <h1>Hello edit page</h1>

<!-- ----------------------------------- -->

    <?php elseif($do == "update"):?>
    <h1>Hello upadate page</h1>

<!-- ---------------------------------- -->
<?php else: ?>
    <h1> 404 page </h1>
<?php endif?>

<?php include "includes/footer.php"?>

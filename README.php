# Bhawani Singh
<?php
include '_14_conn.php';
$sql = "SELECT * FROM `_14_table` WHERE id";
$stmt = $conn->prepare($sql);
  $stmt->execute();
  $data=$stmt->fetchAll();
if ($_SERVER['REQUEST_METHOD'] == "POST") {
    $username = $_POST['username'];
    $email = $_POST['email'];
    $password = $_POST['password'];
    $image = "";
    if ($_FILES['img']['name']) {
        $image = $_FILES['img']['name'];
        move_uploaded_file($_FILES["img"]["tmp_name"], "./bhawani/". $image);

        
    }

    $sql = "INSERT INTO `_14_table`( `username`, `email`, `password`,`image`) VALUES ('$username','$email','$password','$image')";
    $conn->exec($sql);
    header('LOCATION:_14_FORM.PHP');
}

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="css/bootstrap.min.css">
</head>
<body>
    <div class="container">
        <div class="row">
            <div class="col-6">
                <form action="" method="post"  enctype="multipart/form-data">
                    <input type="text" name="username" class="form-control" placeholder="Username">
                    <input type="text" name="email" class="form-control" placeholder="Email">
                    <input type="text" name="password" class="form-control" placeholder="Password">
                    <input type="file" name="img" class="form-control">
                    <input type="submit">
                </form>
            </div>
        </div>
    </div>
    <div class="container-fluid">
    <table class="table">
  <thead>
    <tr>
      <th scope="col">id</th>
      <th scope="col">Username</th>
      <th scope="col">Email</th>
      <th scope="col">Password</th>
      <th scope="col">Action</th>
    </tr>
  </thead>
  <tbody>
    <?php foreach ($data as $key => $value) {
        
     ?>
    <tr>
      <th><?=$key+1?></th>
      <td><?=$value['username']?></td>
      <td><?=$value['email']?></td>
      <td><?=$value['password']?></td>
      <td>
        <img width="50px" height="50px" src="bhawani/<?=$value['image']?>" alt="">
      </td>
      <td>
        <a href="_14_delete.php?delete=<?=$value['id']?>" class="btn btn-info">Delete</a>
        <a href="_14_edit.php?edit=<?=$value['id']?>" class="btn btn-info">Edit</a>
      </td>
    </tr>
   <?php }?>
  </tbody>
</table>
    </div>
    
</body>
</html>

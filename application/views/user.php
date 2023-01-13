
<!doctype html>
<html lang="en">
   <head>
      <meta charset="utf-8">
      <meta name="viewport" content="width=device-width, initial-scale=1">
      <title>User Add</title>
      <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-rbsA2VBKQhggwzxH7pPCaAqO46MgnOM80zW1RWuH61DGLwZJEdK2Kadq2F9CUG65" crossorigin="anonymous">
   </head>
   <body>
   	<div class="container">
      <div class="row">
         <div class="col-md-2">
         	<h1 class="text-center mt-3">Add User</h1>
         </div>
         <div class="col-md-8">
            <?php if(!empty($message)){?>
            <div class="alert alert-warning alert-dismissible fade show mt-3 text-center" role="alert">
              <strong><?=$message;?></strong>
              <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
         <?php }?>
         </div>
         <div class="col-md-2">
         	<a href="<?=base_url();?>Admin/userList"><button class="btn btn-info mt-3">User List</button></a>
         </div>
      </div>
      <form class="row g-3" method="post" action="<?=base_url();?>Admin/userAdd">
         <div class="col-md-4">
            <label for="validationCustom01" class="form-label">Full Name</label>
            <input type="text" class="form-control" id="user_name" name="user_name">
         </div>
         <div class="col-md-4">
            <label for="validationCustom02" class="form-label">Email</label>
            <input type="email" class="form-control" id="user_email" name="user_email">
         </div>
         <div class="col-md-4">
            <label for="validationCustom02" class="form-label">Password</label>
            <input type="password" class="form-control" id="password" name="password">
         </div>
         <div class="col-12">
            <button class="btn btn-primary" type="submit">Submit</button>
         </div>
      </form>
    </div>
      <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-kenU1KFdBIe4zVF0s0G1M5b4hcpxyD9F7jL+jjXkk+Q2h455rYXK/7HAuoJl+0I4" crossorigin="anonymous"></script>
   </body>
</html>

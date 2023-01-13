<!doctype html>
<html lang="en">
   <head>
      <meta charset="utf-8">
      <meta name="viewport" content="width=device-width, initial-scale=1">
      <title>User List</title>
      <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-rbsA2VBKQhggwzxH7pPCaAqO46MgnOM80zW1RWuH61DGLwZJEdK2Kadq2F9CUG65" crossorigin="anonymous">
   </head>
   <body>
   	<div class="container">
      <div class="row">
         <div class="col-md-2">
         	<h1 class="text-center mt-3">User List</h1>
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
         	<a href="<?=base_url();?>Admin"><button class="btn btn-info mt-3">User Add</button></a>
         </div>
      </div>
         <table class="table">
  <thead>
    <tr>
      <th scope="col">S. No</th>
      <th scope="col">User Name</th>
      <th scope="col">User Email</th>
      <th scope="col">Password</th>
      <th scope="col">Action</th>
    </tr>
  </thead>
  <tbody>
   <?php if(!empty($data)){ $count=1; foreach($data as $row){?>
    <tr>
      <th><?=$count;?></th>
      <td><?=$row['user_name'];?></td>
      <td><?=$row['user_email'];?></td>
      <td><?=$row['password'];?></td>
      <td>
         <a href="<?=base_url();?>Admin/userEdit/<?=$row['id'];?>"><button class="btn btn-info">Edit</button></a>
         <a href="<?=base_url();?>Admin/userDelete/<?=$row['id'];?>"><button class="btn btn-danger">Delete</button></a>
      </td>
    </tr>  
    <?php $count++;} } else{ ?>
    <tr>
       <td colspan="5"><h1 class="text-center mt-3 mb-3">No Data Found</h1></td>
    </tr>  
 <?php }?>
  </tbody>
</table>
    </div>
      <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-kenU1KFdBIe4zVF0s0G1M5b4hcpxyD9F7jL+jjXkk+Q2h455rYXK/7HAuoJl+0I4" crossorigin="anonymous"></script>
   </body>
</html>

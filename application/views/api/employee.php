<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <meta http-equiv="X-UA-Compatible" content="ie=edge">
  <title>PHP REST API CRUD</title>
  <link rel="stylesheet" href="<?=base_url();?>assets/css/style.css">
</head>
<body>
  <table id="main" border="0" cellspacing="0">
    <tr>
      <td id="header">
        <h1>REST API CRUD</h1>

        <div id="search-bar">
          <label>Search :</label>
          <input type="text" id="search" autocomplete="off">
        </div>
      </td>
    </tr>
    <tr>
      <td id="table-form">
        <form id="addForm">
          <input type="text" name="first_name" placeholder="First Name" style="width:37%;">
          <input type="text" name="last_name" placeholder="Last Name" style="width: 37%;">
          <input type="submit" id="save-button" value="Save">
        </form>
      </td>
    </tr>
    <tr>
      <td id="table-data">
        <table width="100%" cellpadding="10px" >
          <tr>
            <th width="40px">Id</th>
            <th>First Name</th>
            <th>Last Name</th>
            <th width="60px">Edit</th>
            <th width="70px">Delete</th>
          </tr>
          <tbody id="load-table"></tbody>
        </table>
      </td>
    </tr>
  </table>

  <div id="error-message" class="messages">ddd</div>
  <div id="success-message" class="messages">dd</div>

  <!-- Popup Modal Box for Update the Records -->
  <div id="modal">
    <div id="modal-form">
      <h2>Edit Form</h2>
      <form action="" id="edit-form">
      <table cellpadding="10px" width="100%">
        <tr>
          <td width="90px">Name</td>
          <td><input type="text" name="sfirst_name" id="edit-first_name">
              <input type="text" name="sid" id="edit-id" hidden="">
          </td>
        </tr>
        <tr>
          <td>Age</td>
          <td><input type="text" name="slast_name" id="edit-last_name"></td>
        </tr>
        <tr>
          <td></td>
          <td><input type="button" id="edit-submit" value="Update"></td>
        </tr>
      </table>
      </form>
      <div id="close-btn">X</div>
    </div>
  </div>

<script type="text/javascript" src="<?=base_url();?>assets/js/jquery.js"></script>
<script type="text/javascript">
 $(document).ready(function(){

   //Show Success or Error Messages
  function message(message, status){
    if(status == 1){
      $("#success-message").html(message).slideDown();
      $("#error-message").slideUp();
      setTimeout(function(){
        $("#success-message").slideUp();
      },1000);

    }else if(status == 0){
      $("#error-message").html(message).slideDown();
      $("#success-message").slideUp();
      setTimeout(function(){
        $("#error-message").slideUp();
      },1000);
    }
  }

  //Fetch All Student Records
    function loadTable(){ 
    $("#load-table").html("");
    $.ajax({ 
      url : '<?=base_url();?>api/Employee/employeeList',
      dataType: "json",
      type : "GET",
      success : function(data){
        if(data.status== 0){
          $("#load-table").append("<tr><td colspan='6'><h2>"+ data.message +"</h2></td></tr>");
        }else{
          $.each(data["data"], function(key, value){ 
            $("#load-table").append("<tr>" + 
                                    "<td>" + value['id'] + "</td>" + 
                                    "<td>" + value['first_name'] +"</td>" + 
                                    "<td>" + value['last_name'] +"</td>" + 
                                    "<td><button class='edit-btn' data-eid='"+ value['id'] + "'>Edit</button></td>" + 
                                    "<td><button class='delete-btn' data-id='"+ value['id'] + "'>Delete</button></td>" + 
                                    "</tr>");
          });
        }
      }
    });
  }

  loadTable();

  // Insert Student Record
   $(function () {
      $('form').on('submit', function (e) {
      e.preventDefault();
      $.ajax({
        type: 'post',
        dataType: "json",
        url : '<?=base_url();?>api/Employee/employeeAdd',
        data: $('form').serialize(),
        success: function (data) {
          if(data.status== 0){
          message(data.message, data.status);
        }
        else{ 
           message(data.message, data.status);
           $("#addForm")[0].reset();
           $('#search').val('');
          loadTable();
        }
        }
      });
     });
   });

  // Delete Student Record
  $(document).on('click', '.delete-btn', function(){
     var student_id = $(this).attr('data-id');
     if(confirm("Are you sure you want to delete this?"))
     {
      $.ajax({
          url:"<?=base_url();?>api/Employee/employeeDelete",
          data:{student_id:student_id},
           method:"POST",
          dataType:"JSON",
          success:function(data)
          {
            if(data.status== 0){
             message(data.message, data.status);  
            }
            else{
              message(data.message, data.status);
              $('#search').val('');
              loadTable();
            }
          }
      })
     }
   });

   // Edit Student Record
  $(document).on('click', '.edit-btn', function(){
   $("#modal").show();
     var student_id = $(this).attr('data-eid');
      $.ajax({
          url:"<?=base_url();?>api/Employee/employeeEdit",
          data:{student_id:student_id},
           method:"POST",
          dataType:"JSON",
          success:function(data)
          {
            // alert(data);
            // console.log(data.data[0]['first_name']);
            if(data.status== 0){
             message(data.message, data.status);
            }
            else{
              $("#edit-id").val(data.data[0]['id']);
              $("#edit-first_name").val(data.data[0]['first_name']);
              $("#edit-last_name").val(data.data[0]['last_name']);
              
            }
          }
      })    
   });

  //Hide Modal Box
  $("#close-btn").on("click",function(){
    $("#modal").hide();
  });

     // Update Student Record

      $('#edit-submit').on('click', function (e) {
      e.preventDefault();
      $.ajax({
        type: 'post',
        dataType: "json",
        url : '<?=base_url();?>api/Employee/employeeUpdate',
        data: $('form').serialize(),
        success: function (data) {
         
          if(data.status== 0){
          message(data.message, data.status);
        }
        else{ 
          $("#modal").hide(); 
          message(data.message, data.status);
          $('#search').val('');
          loadTable();     
        }
        }
      });
     });  

//Live Search Record
  $("#search").on("keyup",function(){
    var search_term = $(this).val();
    $("#load-table").html("");
    $.ajax({ 
      url : '<?=base_url();?>api/Employee/employeeSearch',
      type : "POST",
      dataType:"JSON",
      data:{ search_term:search_term },
      success : function(data){
       if(data.status == 0){
          $("#load-table").append("<tr><td colspan='6'><h2>"+ data.message +"</h2></td></tr>");
        }else {
      // alert('ddddd');
          $.each(data["data"], function(key, value){ 
            $("#load-table").append("<tr>" + 
                                    "<td>" + value['id'] + "</td>" + 
                                    "<td>" + value['first_name'] +"</td>" + 
                                    "<td>" + value['last_name'] +"</td>" + 
                                    "<td><button class='edit-btn' data-eid='"+ value['id'] + "'>Edit</button></td>" + 
                                    "<td><button class='delete-btn' data-id='"+ value['id'] + "'>Delete</button></td>" + 
                                    "</tr>");
          });
        }
      }
    });
  });
 });


  
</script>
</body>
</html>

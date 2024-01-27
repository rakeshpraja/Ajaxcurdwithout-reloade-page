<!DOCTYPE html>
<html lang="en">
<head>
  <title>Bootstrap Example</title>
  <meta charset="utf-8">
  <meta name="csrf-token" content="{{ csrf_token() }}">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
</head>
<body>

<div class="container mt-3">
<div>
  <span id="mamesse"></span>
 
</div>
    <div>
  <span id="add_form">Add form</span>
  <span id="update_form">Update form</span>
</div>
  <form id="forms"  enctype="multipart/form-data" >
  <input type="hidden" class="form-control" id="id" placeholder="Enter name" name="id">
  <div class="mb-3 mt-3">
      <label for="email">Name:</label>
      <input type="text" class="form-control" id="name" placeholder="Enter name" name="name">
    </div>
    <div class="mb-3 mt-3">
      <label for="email">Email:</label>
      <input type="email" class="form-control" id="email" placeholder="Enter email" name="email">
    </div>
    <div class="mb-3">
      <label for="pwd">Image:</label>
      <input type="file" class="form-control" id="image" placeholder="Enter password" name="image">
    </div>
    
    <button type="submit" id="addBtn" onclick="addData()" class="btn btn-primary">Submit</button>
    <button type="submit" id="updateBtn" onclick="updateData()" class="btn btn-primary">Update</button>
  </form>
  <table class="table">
    <thead>
      <tr>
        <th>Firstname</th>
       
        <th>Email</th>
        <th>Image</th>
        <th>Status</th>
        <th>Edit</th>
        <th>Delete</th>
      </tr>
    </thead>
    <tbody id="allStudent">
      
    </tbody>
  </table>
</div>
<script>
   
    $("#updateBtn").hide();
    $("#add_form").hide();
    
    
 $.ajaxSetup({
    headers: {
        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
    }
});

function allstudent() {
    $.ajax({
        url: 'all_student',
        type: 'GET',
        dataType: 'json',
        success: function(data) {
            $('#allStudent').empty(); // Clear previous data
            var htmls = '';
            $.each(data.student, function(key, value) {
                htmls += `<tr><td>${value.name}</td><td>${value.email}</td><td>${value.image}</td><td>${value.status}</td><td><button class="btn btn-success edit" onclick="editdata('${value.id}')">edit</button></td><td><button class="btn btn-danger delete" onclick="deletedata('${value.id}')">delete</button></td></tr>`;
            });
            $('#allStudent').append(htmls); // Append new data
        }
    });
}

$(document).ready(function() {
    $('#forms').submit(function(e) {
        e.preventDefault(); // Prevent form submission

        var formData = new FormData(this); // Create FormData object with form data

        $.ajax({
            url: 'storedata', // Adjust the URL as per your route
            type: 'POST',
            data: formData,
            contentType: false,
            processData: false,
            success: function(data) {
               $('#name').val(''); 
               $('#email').val(''); 
               $('#image').val(''); 
                allstudent();
                $("#mamesse").html(data.success);
                $("#addBtn").show();
                $("#add_form").show();
            },
            
        });
    });

    allstudent(); // Load student data initially
});
function editdata(id){
    $.ajax({
        url: "edit/"+id,
        type: 'GET',
        dataType: 'json', 
        success: function(data) {
            $("#addBtn").hide();
            $("#updateBtn").show();
            $("#add_form").hide();
            $("#update_form").show();
            $('#id').val(data.id); 
               $('#name').val(data.name); 
               $('#email').val(data.email); 
               $('#image').val(data.image);  
        }
    });

}
function deletedata(id){
    $.ajax({
        url: "delete/"+id,
        type: 'GET',
        dataType: 'json', 
        success: function(data) {
            allstudent();
        }
    });

}




</script>

</body>
</html>

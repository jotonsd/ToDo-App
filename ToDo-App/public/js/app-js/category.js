$(function () {
  // get categories onload
    $.get("http://localhost:8000/api/get-categories/"+ user_id, function(data){

      // calling function for table data
      table_reload(data);
    });

    // from validation
    let validatorServerSide = $('form#myform').jbvalidator({
        errorMessage: true,
        successClass: true,
    });

    //store categories
    $(document).on('submit', '#myform', function () {

         // checking the text button if save calling store apis
        if ($('#btn-name').text() == 'Save') {
          $.ajax({
              method: "POST",
              url: "http://localhost:8000/api/store-categories",         
              data: $(this).serialize(),
              success: function (response) {
                if (response.success == true) { 
                  console.log(response.data); 
                  $('#table-data tbody').html('');
                  var data = response.data.categories;
                  
                  // calling function for table data
                  table_reload(data);

                  // sucess alert                      
                  success(response.message)
                  clear_all();
                }
              }
          });
          return false;

          // checking the text button if update calling update apis
        }else if($('#btn-name').text() == 'Update'){
          $.ajax({
              method: "POST",
              url: "http://localhost:8000/api/update-category/"+$('#id').val(),         
              data: $(this).serialize(),
              success: function (response) {
                if (response.success == true) { 
                  console.log(response.data); 
                  var data = response.data.categories;

                  // calling function for table data
                  table_reload(data);
                  // sucess alert                      
                  success(response.message)
                  // clear all data
                  clear_all();
                }
              }
          });
          return false;
        }
    });

});

// get individual category data by id
function edit_btn(id)
{
  $.get("http://localhost:8000/api/get-category/"+id, function(response){
    console.log(response);
    var data = response.data.category;
    $('#id').val(data.id);
    $('#name').val(data.name);
    $('#user_id').val(data.user_id);
    $('#status').val(data.status);
    $('#btn-name').text('Update');
    $('#exampleModalToggleLabel').text('Update Category');
    $('#exampleModalToggle').modal('toggle');
  });
}

// clear all from data function
function clear_all(){
  $('#exampleModalToggle').modal('toggle');
  $('#myform')[0].reset();
  $('#btn-name').text('Save');
  $('#exampleModalToggleLabel').text('Add New Category');
}

// reload table data function
function table_reload(data)
{      
  $('#table-data tbody').html('');
  $(data).each(function(index) {
    if (data[index].status == 1) {
      status = '<button class="btn-sm btn-success">Actived</button>';
    }else{                        
      status = '<button class="btn-sm btn-danger">Deactived</button>';
    }
    // making data ready for apending on table
    html ='<tr>'+
          '<td>'+(index+1)+'</td>'+
          '<td>'+data[index].name+'</td>'+
          '<td>'+status+'</td>'+
          '<td><button onclick="edit_btn('+data[index].id+')" class="btn-sm btn-primary edit-btn">Edit</button></td>'+
          '</tr>'
      $('#table-data tbody').append(html);
  });
}
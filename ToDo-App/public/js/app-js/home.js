$(function () {
  // get tasks onload
    $.get("http://localhost:8000/api/task/get-categories/"+ user_id, function(data){
      $(data).each(function(index) {
        $('#category_id').append('<option value="'+ data[index].id +'">'+ data[index].name +'</option>');
      });
    });

    // get all task list
    $.get("http://localhost:8000/api/get-tasks/"+ user_id, function(data){

      // returning to the all data
      $('#get-task').prop('checked',true);
      // calling function for table data
      table_reload(data);
    });

    // searching type wise data
    $('.radio-btn').click(function(){
      var val = $('input[name="get_task"]:checked').val();
      if (val == 1) {
        // get all task list
        $.get("http://localhost:8000/api/get-tasks/"+ user_id, function(data){

          // returning to the all data
          $('#get-task').prop('checked',true);
          // calling function for table data
          table_reload(data);
        });
      } else if(val == 2){        
        // get pinned task list
        $.get("http://localhost:8000/api/get-pinned-tasks/"+ user_id, function(data){

          // calling function for table data
          table_reload(data);
        });
      }else if(val == 3){
        // get important task list
        $.get("http://localhost:8000/api/get-important-tasks/"+ user_id, function(data){

          // calling function for table data
          table_reload(data);
        });
      }
    });   


    // from validation
    let validatorServerSide = $('form#myform').jbvalidator({
        errorMessage: true,
        successClass: true,
    });

    // store tasks
    $(document).on('submit', '#myform', function () {

         // checking the text button if save calling store apis
        if ($('#btn-name').text() == 'Save') {
          $.ajax({
              method: "POST",
              url: "http://localhost:8000/api/store-tasks",         
              data: $(this).serialize(),
              success: function (response) {
                if (response.success == true) { 
                  console.log(response.data); 
                  $('#table-data tbody').html('');
                  var data = response.data.tasks;
                  
                  // returning to the all data
                  $('#get-task').prop('checked',true);

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
              url: "http://localhost:8000/api/update-task/"+$('#id').val(),         
              data: $(this).serialize(),
              success: function (response) {
                if (response.success == true) { 
                  console.log(response.data); 
                  var data = response.data.tasks;

                  // returning to the all data
                  $('#get-task').prop('checked',true);
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

// get individual task data by id
function edit_btn(id)
{
  $.get("http://localhost:8000/api/get-task/"+id, function(response){
    console.log(response);
    var data = response.data.task;
    $('#id').val(data.id);
    $('#title').val(data.title);
    $('#user_id').val(data.user_id);
    $('#category_id').val(data.category_id);
    $('#description').val(data.description);
    if (data.is_pinned == 1) {      
      $('#is_pinned').val(data.is_pinned).attr('checked',true);
    }
    if (data.is_important == 1) {      
      $('#is_important').val(data.is_important).attr('checked',true);
    }
    $('#btn-name').text('Update');
    $('#task_modalLabel').text('Update Task');
    $('#task_modal').modal('toggle');
  });
}

// view task function
function view_btn(id)
{
  $.get("http://localhost:8000/api/get-task/"+id, function(response){
    console.log(response);
    var data = response.data.task;
    if (data.is_important == 1) {
      important = '<span class="badge bg-danger"><i class="fa fa-exclamation-circle" aria-hidden="true"></i> Important</span>';
    }else{
      important = '';
    }

    if (data.is_pinned == 1) {
      pinned = ' <span class="badge bg-secondary"><i class="fa fa-map-pin" aria-hidden="true"></i> Pinned</span> ';
    }else{
      pinned = '';
    }

    $('#v-title').html(data.title);
    $('#v-category').html(response.data.category_name);
    $('#v-description').html(data.description);
    $('#v-important').html(important);
    $('#v-pinned').html(pinned);
    $('#view_task_modal').modal('toggle');
  });
}

// task completed function
function complete(id)
{
  $.get("http://localhost:8000/api/task-complete/"+id+"/"+user_id, function(response){
    console.log(response);
    var data = response.data.tasks;
    // calling function for table data
    table_reload(data);

    // sucess alert                      
    success(response.message)
  });
}

// clear all from data function
function clear_all(){
  $('#task_modal').modal('toggle');
  $('.form-control, .form-select').val('');
  $('#is_pinned').removeAttr( "checked" );
  $('#is_important').removeAttr( "checked" );
  $('#btn-name').text('Save');
  $('#task_modalLabel').text('Add New Task');
}

// reload table data function
function table_reload(data)
{      
  console.log(data)
  $('#table-data tbody').html('');
  if (data.length == 0) {
    $('#table-data tbody').append("<tr><td colspan='3'><h4>Welcome to ToDo-App</h4></td></tr>");
  } else {}
  $(data).each(function(index) {
    // checking important or not
    if (data[index].is_important == 1) {
      important = ' <span style="float:right" class="badge bg-danger"><i class="fa fa-exclamation-circle" aria-hidden="true"></i> Important</span>';
    }else{
      important = '';
    }

    // checking pinned or not
    if (data[index].is_pinned == 1) {
      pinned = ' <span style="float:right" class="badge bg-secondary"><i class="fa fa-map-pin" aria-hidden="true"></i> Pinned</span> ';
    }else{
      pinned = '';
    }

    if (data[index].is_completed == 1) {
      completed = ' <span style="float:right" class="badge bg-success"><i class="fa fa-check-circle" aria-hidden="true"></i> Completed</span> ';
    }else{
      completed = ' <span style="float:right; cursor:pointer" onclick="complete(' + data[index].id + ')" class="badge bg-info"><i class="fa fa-question-circle" aria-hidden="true"></i> Completed</span> ';
    }

    // making data ready for apending on table
    html ='<tr>'+
          '<td>'+(index+1)+'</td>'+
          '<td align="left">'+data[index].title+completed+pinned+important+'</td>'+
          '<td><button onclick="view_btn('+data[index].id+')" class="btn-sm btn-success edit-btn">View</button> <button onclick="edit_btn('+data[index].id+')" class="btn-sm btn-primary edit-btn">Edit</button></td>'+
          '</tr>'
      $('#table-data tbody').append(html);
  });
}

// max character in textarea count
$('textarea').keyup(function() {
    
  var characterCount = $(this).val().length,
      current = $('#current'),
      maximum = $('#maximum'),
      theCount = $('#the-count');    
      current.text(characterCount);
  
  /*This isn't entirely necessary, just playin around*/

    if (characterCount >= 450) {
      maximum.css('color', '#8f0001');
      current.css('color', '#8f0001');
      theCount.css('font-weight','bold');
    } else {
      maximum.css('color','#666');
      theCount.css('font-weight','normal');
    }  
      
});
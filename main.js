$(document).ready(function(){
   
   // function to load task from server 
   function loadTasks(){
    $.ajax({

        url: 'task.php',
        method:'GET',
        data:{ action: 'list'},
        success:function(data){
            $('#taskList').html(data);       
         }
    });
   }

   $('#addTask').click(function(){
     
    var task = $('#task').val();
    if(!task==""){
        $.ajax({
            url:'task.php',
           method:'POST',
           data:{action:'add',task:task},
           success:function(){
           loadTasks();
            $('#task').val('');
     }
  
    });
    }
      else{
        alert("The field is empty");
      }
         
   });
  
   $('#taskList').on('click','.complete',function(){
    var id = $(this).data('id');
    
    $.ajax({
        url:'task.php',
        method: 'POST',
        data: { action:'complete', id:id},
        success: function(){
            
            loadTasks();
           
        }
    });

   });

   // Delete action 
   $('#taskList').on('click','.delete',function(){
    var id = $(this).data('id');
    $.ajax({
        url:'task.php',
        method: 'POST',
        data: { action:'delete',id:id},
        success: function(){
            loadTasks();
        }
    });
   });

   loadTasks();
});

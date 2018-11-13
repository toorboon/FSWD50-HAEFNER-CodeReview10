$(document).ready(function(){
	
//on init
	//set the search string to '' in the beginning, so we see the whole list
	txt = '';
    $('#result').html('');
        $.ajax({
          url:"includes/fetch.inc.php",
          method: "post",
          data:{search:txt},
          dataType:"text",
          success:function(data)

          {
            $('#result').html(data);
          }
        });

    $('#search_text').keyup(function(){
      var txt = $(this).val();
        $('#result').html('');
        $.ajax({
          url:"includes/fetch.inc.php",
          method: "post",
          data:{search:txt},
          dataType:"text",
          success:function(data)

          {
            $('#result').html(data);
          }
        });
      
    });

//set event_listeners
	//on button close for the modals reload the page! 
	$('.close_button').on('click', function(){
		console.log('in close_edit');
		window.location.replace('index.php');
	});


});

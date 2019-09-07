$(document).ready(function(){
	
//ON INIT
  //jQuery Ajax Call for fetching the table on load of page
	//set the search string to '' in the beginning, so we see the whole list
	txt = '';
  print_result(txt);    

//SET EVENT LISTENERS
	//jQuery Ajax Call for fetching the table on entering a search string in the search box
	$('#search_text').keyup(function(){
      var txt = $(this).val();
      
      print_result(txt);
  });

  //on button close for the modals reload the page! 
  $('.close_button').on('click', function(){
		// console.log('in close_edit');
		window.location.replace('index.php');
	});

  //populating the Author field on the new media form with data from the database
  $('#register_book_form').on('shown.bs.modal', function(){
    //Ajax Call for filling up the authors from the database
    $.ajax({
      url:"includes/fetch.inc.php",
      method: "post",
      data:{category:'author'},
      dataType:"text",
      success: function(response)
      {
        $('#author').html('<option value="" selected disabled>Choose an Author</option>');
        
        var response = $.parseJSON(response);
            
        for(var i=0; i< response.length;i++){
          $('<option/>', {
              html: response[i].name,
              value: response[i].id
            }).appendTo('#author');
        } 
      }
    });
    //Ajax Call for filling up the pubblishers stored in the database
    $.ajax({
      url:"includes/fetch.inc.php",
      method: "post",
      data:{category:'publisher'},
      dataType:"text",
      success: function(response)
      {
        $('#publisher').html('<option value="" selected disabled>Choose a Publisher</option>');
        
        var response = $.parseJSON(response);
            
        for(var i=0; i< response.length;i++){
          $('<option/>', {
              html: response[i].name,
              value: response[i].id
            }).appendTo('#publisher');
        } 
      }
    });
  });

//FUNCTIONS
function book_media(){
  $('.book_media').on('click',function(){
    temp = this.id;
    temp = temp.substring(6);
    // console.log('id: ' + temp);
    $.ajax({
      url:"includes/booking.inc.php",
      method: "post",
      data:{media_id:temp},
      dataType:"text",
      success:function(response)
      {
        //swal("Well Done!",response,"success");
        $('#media_'+temp).html(response);//change to sweet alert
      }
    }); 
  })
}

function print_result(txt){
  $('#result').html('');
  $.ajax({
    url:"includes/fetch.inc.php",
    method: "post",
    data:{search:txt, category:'fetch_all'},
    dataType:"text",
    success:function(data)

    {
      $('#result').html(data);
      
      //on click the booked media will be send to booking.inc.php for writing in the database
      book_media()
    }
  });
}
});

//on click function for logout button, so logout from Google is possible
  $('#logout').on('click', function(){
    $.ajax({
      url:"includes/logout.inc.php",
      method: "post",
      success:function(response)
        {
          // console.log('Logged out!').then(function(){window.location.replace('index.php');});
          // swal("Well Done!",response,"success").then(function(){window.location.replace('index.php');});
          console.log('User signed out.')
          console.log('response: ' + response)
          window.location.replace('index.php');
        }
      
      }); 
    // var auth2 = gapi.auth2.getAuthInstance();
    // auth2.signOut().then(function () {
    //   console.log('even logged out from fucking Google');
    // });
  });
 
 //Google Login Shit
  /*function onSignIn(googleUser) {
    var profile = googleUser.getBasicProfile();
    console.log('ID: ' + profile.getId()); // Do not send to your backend! Use an ID token instead.
    console.log('Name: ' + profile.getName());
    console.log('Email: ' + profile.getEmail()); // This is null if the 'email' scope is not present.
  }*/
<!DOCTYPE html>
<html lang="en">
<head>
  <title>Bootstrap Example</title>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.0/css/bootstrap.min.css">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.0/jquery.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.0/js/bootstrap.min.js"></script>
</head>
<body>

<div class="container">
  <h2>Vertical (basic) form</h2>
  <form action="javascript:void(0)" id ="sendMessage" method = "POST">
    <div class="form-group">
      <label for="message">Send Message</label>
      <input type="text" class="form-control" id="message" placeholder="Type a message" name="message">
    </div>
    <button type="submit" class="btn btn-default">Submit</button>
  </form>
</div>

<script>
$(document).on('submit', "#sendMessage", function(e) {
    var message = $('#message').val();
    var id = '1';
    var form = new FormData();
    form.append('chat_message' , message);
    form.append('user_id' , id);
    form.append('action' , 'send_message');
    //console.log(message);
    $.ajax({
        url: "chat_action.php",
        data: form,
        type: "POST",
        processData: false, 
        contentType: false,
        beforeSend : function()
        {
            console.log("SENDING");//can add animation before send
        },
        success: function(data)
        {
            console.log(data);
        }
    });
});
</script> 

</body>
</html>
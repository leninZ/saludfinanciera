<!DOCTYPE html>
<html>
<head>
  <meta charset="utf-8">
  <title>FinanCoach:Login </title>

<link href='http://fonts.googleapis.com/css?family=Sanchez' rel='stylesheet' type='text/css'>
<script src='https://ajax.googleapis.com/ajax/libs/jquery/1.8.2/jquery.min.js'></script>
<script src="/js/knockout.js"></script> 
<link href="/css/style.css" rel="stylesheet" media="screen">
<!-- Bootstrap --> 
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<link href="/css/bootstrap-responsive.css" rel="stylesheet">
<script src="/js/bootstrap.min.js"></script>
<link href="/css/bootstrap.min.css" rel="stylesheet" media="screen">
  
</head>
<body style="font-family: 'Sanchez', serif; background-image: url(../img/texture_grain.png)">
<!---------------B O D Y------------------------------------------>


<div class="center shadows white round4" style="width:20%;min-width: 200px;padding: 2%;margin-top: 4%;" id="loginbox">  

<img  src="../img/logo.png" alt="financoach_logo" class="center" >
  <h4 style="float:left">Login</h4>
<form class="form-vertical" id="formlogin">
  <div class="control-group"> 
 
    <div class="controls">
      <input type="text" id="inputEmail" placeholder="Email" style="width: 95%;">
    </div>
  </div>
  <div class="control-group">

    <div class="controls">
      <input type="password" id="inputPassword" placeholder="Password" style="width: 95%;">
    </div>
  </div>
  <div class="control-group">
  <div class="alert" id="alert-error1" style="display:none;"></div>
    <div class="controls">
      <button type="submit" class="btn" id="loginButton" data-bind="click: login">Ingresa</button>
    </div>
  </div>
</form> 
</div>










</body><!-----END BODY------->


<script>
function login() {
self.login = function() {	

        var url = '/api/login';
        var formValues = {
            email: $('#inputEmail').val(),
            password: $('#inputPassword').val()
        };
		$.ajax({
            url: url,
            type:'POST',
            dataType:"json",
            data: formValues,
            success:function (data) {
               
                if(data.error) {  // If there is an error, show the error messages
                    $('#alert-error1').text(data.error.text).show();
                }
                else { 
                   window.location.replace('/');
				   
                }
            }
        });
      }
}
ko.applyBindings(new login());
</script>

</html>




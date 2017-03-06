<html>
<head>

  <title>UMB Health Spending App Registration</title>

  <!-- Load jQuery -->
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.1.1/jquery.min.js"></script>

  <script>
  $(document).ready(function(){
      $("#submit_registration").click(function(){

        $("#submit_registration").value = "Loading";

        var email= $('#email').val();
        var password = $('#password').val();
        var password_check = $('#password_check').val();
        var first_name = $('#first_name').val();
        var last_name = $('#last_name').val();

        var url = "https://capstone.td9175.com/ci/index.php/Rest/registration";

          $.post(url,
          {
            email: $('#email').val(),
            password: $('#password').val(),
            first_name: $('#first_name').val(),
            last_name: $('#last_name').val()
          },
          function(data, status){
              $("#response").text = "Data: " + data + "\nStatus: " + status;
          });

      });
  });
  </script>

</head>

<body>

  <h1>Register for UMB Health Spending App</h1>

  <input type='text' id='email' placeholder='Email address'><br><br>
  <input type='password' id='password' placeholder='Password'><br><br>
  <input type='password' id='password_check' placeholder='Password again'><br><br>
  <input type='text' id='first_name' placeholder='First name'><br><br>
  <input type='text' id='last_name' placeholder='Last name'><br><br>
  <button id='submit_registration'>Register now!</button><br><br>

  <label id='response'></label>

</body>

</html>

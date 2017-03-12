<html>
<head>

  <title>Login to UMB Health Spending App</title>

  <!-- Load jQuery -->
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.1.1/jquery.min.js"></script>

  <script>
  $(document).ready(function(){
      $("#submit_login").click(function(){

        $("#response").html("Loading...");

        var url = "https://capstone.td9175.com/ci/index.php/Rest/login";

          $.post(url,
          {
            email: $('#email').val(),
            password: $('#password').val()
          },
          function(data, status){
            if (status == 200){

              // Redirect to the landing page
              var landingPage = "https://capstone.td9175.com/ci/index.php/LandingPage";
              window.location.replace(landingPage);

            } else if (status == 401) {

              $("#response").html("Incorrect email or password.");
            }

          });
      });
  });
  </script>

</head>

<body>

  <h1>Login to UMB Health Spending App</h1>

  <input type='text' id='email' placeholder='Email address'><br><br>
  <input type='password' id='password' placeholder='Password'><br><br>
  <button id='submit_login'>Login</button><br><br>

  <div id='response'></div>

</body>

</html>

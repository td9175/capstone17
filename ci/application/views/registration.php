<html>
<head>

  <title>Register for UMB Health Spending App</title>

  <!-- Load jQuery -->
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.1.1/jquery.min.js"></script>

</head>

<body>

  <h1>Register for UMB Health Spending App</h1>

  <form>
    <input type='text' id='email' placeholder='Email address'><br><br>
    <input type='password' id='password' placeholder='Password'><br><br>
    <input type='password' id='password_check' placeholder='Password again'><br><br>
    <input type='text' id='first_name' placeholder='First name'><br><br>
    <input type='text' id='last_name' placeholder='Last name'><br><br>
    <button id='submit_registration'>Register now!</button>

    <label id='response'></label>
  </form>

</body>

</html>

<script>
$(document).ready(function(){
    $("submit_registration").click(function(){

      $("submit_registration").innerHTML = "Loading";

      var email= $('#email').val();
      var password = $('#password').val();
      var password_check = $('#password_check').val();
      var first_name = $('#first_name').val();
      var last_name = $('#last_name').val();

      var url = "http://capstone.td9175.com/ci/index.php/Rest/registration";

        $.post(url,
        {
          email: email,
          password: password,
          first_name: first_name,
          last_name: last_name
        },
        function(data, status){
            $("response").innerHTML = "Data: " + data + "\nStatus: " + status;
        });

        // $("submit_registration").innerHTML = "Register now!";
    });
});
</script>





<!--

<script>
  function register_account() {

    var email = document.getElementById('email');
    var password = document.getElementById('password');
    var password_check = document.getElementById('password_check');
    var first_name = document.getElementById('first_name');
    var last_name = document.getElementById('last_name');

    var xhttp = new XMLHttpRequest();
    xhttp.onreadystatechange = function() {
      if (this.readyState == 4 && this.status == 200) {
        document.getElementById("demo").innerHTML = this.responseText;
      }
    };
    xhttp.open("POST", "Rest/registration/" + , true);
    xhttp.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
    xhttp.send("email/" + email + "/hash_pass/" + password + "/first_name/" + first_name + "/last_name/" + last_name);
  }
</script>

-->

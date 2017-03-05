<html>
<head>
  <title>Register for UMB Health Spending App</title>
</head>

<body>

  <h1>Register for UMB Health Spending App</h1>

  <form action='#'>
    <input type='text' id='email' placeholder='Email address'>
    <input type='password' id='password' placeholder='Password'>
    <input type='password' id='password_check' placeholder='Password again'>
    <input type='text' id='first_name' placeholder='First name'>
    <input type='text' id='last_name' placeholder='Last name'>
    <input type='submit' onclick='register_account()' value='Register now!'>
  </form>

</body>

</html>

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
        document.getElementById("demo").innerHTML =
        this.responseText;
      }
    };
    xhttp.open("POST", "Rest/registration/" + "email/" + email + "/hash_pass/" + password + "/first_name/" + first_name + "/last_name/" + last_name, true);
    xhttp.send();
  }
</script>

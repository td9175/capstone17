<html>
<head>

  <title>Registration UMB Health Spending App</title>

  <!-- Load jQuery -->
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.1.1/jquery.min.js"></script>

  <script>
  $(document).ready(function(){
      $("#submit_image").click(function(){
      
		console.log("Testing");
        $("#submit_image").text = "Loading";

        var image= $('#image').val();
        

        var url = "https://capstone.td9175.com/ci/index.php/Rest/ocr";
        console.log(url);

          $.post(url,
          {
            image: $('#image').val()
          
          },
          function(data, status){
              $("#response").text = "Data: " + data + "\nStatus: " + status;
          });

      });
  });
  </script>

</head>

<body>

  <h1>Upload Receipt</h1>

  <input type='text' id='image' placeholder='Image'><br><br>
  <button id='submit_image'>Upload</button><br><br>

  <p id='response'>Ello</p>

</body>

</html>
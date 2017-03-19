<html>
<head>

  <title>Registration UMB Health Spending App</title>

  <!-- Load jQuery -->
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.1.1/jquery.min.js"></script>

  <script>
  $(document).ready(function(){
      $("#submit_image").click(function(){

        $("#submit_image").text = "Loading";

        var image= $('#image').val();
     	console.log("Image");
     	console.log(image);
        var url = "https://capstone.td9175.com/ci/index.php/Rest/upload";
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

  <h1>OCR Testing</h1>

  <input type='file' id='image' name='image'><br><br>
  
  <button id='submit_image'>Upload</button><br><br>

  <p id='response'></p>

</body>

</html>
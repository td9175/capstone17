<html>
 
   <head> 
      <title>Upload Form</title> 
   </head>
	
   <body> 
      <?php echo $error;
      include: 'applications/helpers/form_helper.php';?> 
      <?php echo form_open('upload/do_upload');?> 
		
      <form action = "" method = "">
         <input type = "file" name = "userfile" size = "20" /> 
         <br /><br /> 
         <input type = "submit" value = "upload" /> 
      </form> 
		
   </body>
	
</html>
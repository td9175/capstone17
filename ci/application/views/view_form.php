<?php 
echo"<html>
    <head>		
        <title>Codeigniter Form Submit</title>
        <!--
        <link href='http://fonts.googleapis.com/css?family=Source+Sans+Pro|Open+Sans+Condensed:300|Raleway' rel='stylesheet' type='text/css'>
        <script src='http://ajax.googleapis.com/ajax/libs/jquery/1.11.1/jquery.min.js'></script>
       
    </head>";
    
    echo form_open('form/data_submitted');
    			echo form_label('User Name :', 'u_name');
    			
    	
    echo "<body> 
        <div class='main'>
            <div id='content'>
                <h3 id='form_head'>Codelgniter Form Submit With Database</h3><br/>
                <hr>
                <div id='form_input'>";
               
                echo form_open('form/data_submitted');
                echo form_label('User Name :', 'u_name');
                $input1_data = array(
                    'name' => 'u_name',
                    'placeholder' => 'Please Enter User Name',
                    'class' => 'input_box'
                );
                echo form_input($input1_data);
                echo "<br/><br/>";
                echo form_label('User email&nbsp;&nbsp;:', 'u_email');
                $input2_data = array(
                    'type' => 'email',
                    'name' => 'u_email',
                    'placeholder' => 'Please Enter Email Address',
                    'class' => 'input_box'
                );
                echo form_input($input2_data);
              
            
              echo"      </div>
                    
            </div> 
        </div>
    </body>
</html>";

?>








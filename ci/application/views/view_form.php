<html>
    <head>		
        <title>Codeigniter Form Submit</title>
        <link rel="stylesheet" type="text/css" href="<?php echo base_url(); ?>css/style.css">
        <link href='http://fonts.googleapis.com/css?family=Source+Sans+Pro|Open+Sans+Condensed:300|Raleway' rel='stylesheet' type='text/css'>
        <script src="http://ajax.googleapis.com/ajax/libs/jquery/1.11.1/jquery.min.js"></script>
        <script src="<?php echo base_url(); ?>script/script.js"></script>
    </head>
    <body> 
        <div class="main">
            <div id="content">
                <h3 id='form_head'>Codelgniter Form Submit With Database</h3><br/>
                <hr>
                <div id="form_input">
                <?php
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
                ?>
                    </div>
                    <div id="form_button">
                        <?php echo form_submit('submit', 'Submit', "class='submit'"); ?>
                    </div>                   
               <?php echo form_close();?>
                <?php if(isset($user_name) && isset($user_email_id)){
                    echo "<div id='content_result'>";
                    echo "<h3 id='result_id'>You have submitted these values</h3><br/><hr>";
                    echo "<div id='result_show'>";
                    echo "<label class='label_output'>Entered User Name : </label>".$user_name;
                    echo"<br/><br/>";
                    echo "<label class='label_output'>Entered Email&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;: </label>".$user_email_id;
                    echo "<div>";
                    echo "</div>";
                } ?>
            </div> 
        </div>
    </body>
</html>








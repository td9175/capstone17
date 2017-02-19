
<?php echo form_open('DrugSearch/search_for_drug'); ?>
	<label for='searchQuery'>Enter a drug to search: </label>
	<input type='text' name='searchQuery'>
	<input type='submit' name='submit' value='Search!'>
	</form>
	
	
<?php

if (isset($response)){
	print $response;
	print "\n";
	
	$decodedResponse = json_decode($response);
	
	var_dump($decodedResponse);
	
	if (isset($response['candidates'])){
		print $response['candidates'];
	} else {
		print "Not set.\n";
	}
	
	print "test\n";
	
	$arrlength=count($response);

	for($x=0;$x<$arrlength;$x++)
  	{
  		echo $response[$x];
  		print "test2\n";
  		echo "<br>";
  	}
	
	print "test3\n";	
}

?>
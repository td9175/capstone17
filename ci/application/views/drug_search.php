
<?php echo form_open('DrugSearch/search_for_drug'); ?>
	<label for='searchQuery'>Enter a drug to search for: </label>
	<input type='text' name='searchQuery'>
	<input type='submit' name='submit' value='Search!'>
	</form>
	
	
<?php

if (isset($response)){
	print $response;
	print "\n";
	
	if (isset($response['data'])){
		print $response['data'];
	} else {
		print "Not set.\n";
	}
	
	print "test\n";
	
	$arrlength=count($response);

	for($x=0;$x<$arrlength;$x++)
  	{
  		echo $response[$x];
  		echo "<br>";
  	}
		
}

?>
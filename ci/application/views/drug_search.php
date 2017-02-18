<?php

echo form_open('DrugSearch/search_for_drug');
echo form_input('searchQuery');
echo form_submit('drugSearchSubmit', 'Search!');
echo form_close();

if (isset($response)){
	print $response;
	print "\n Hello World!";
}

?>
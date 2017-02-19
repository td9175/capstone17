
<?php echo form_open('Drugs/search_for_drug'); ?>
	<label for='searchQuery'>Enter a drug to search for: </label>
	<input type='text' name='searchQuery'>
	<input type='submit' name='submit' value='Search!'>
	</form>

<?php

if (isset($searchData)){
	
	foreach ($searchData->data->candidates as $candidate){
		echo "<a href='price_comparison/$candidate' >$candidate</a><br>";
	}
	
}

if (isset($priceData)){

	$prices = $priceData->data->price_detail->price;
	$pharmacies = $priceData->data->price_detail->pharmacy;
	$allPricesUrl = $priceData->data->mobile_url;
	
	//for($i=0; i<count($prices); $i++){
	//	if (i==0){
	//		echo "Cheapest price available is " . $prices[$i] . " at " . $pharmacies[$i];
	//	} else {
	//		echo "Price #" . $i+1 . " is " . $prices[$i] . " at " . $pharmacies[$i];
	//	}
	//}
	
	echo "<a href='$allPricesUrl'>View all prices on GoodRx.com</a>";

	echo "<hr>";
	var_dump($priceData);
}

?>
	<hr>
	<a href='http://GoodRx.com'>Powered by GoodRx</a>
	




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
	
	$countOfPrices = count($prices);
	
	for ($i=0; $i<$countOfPrices; $i++){
		if ($i==0){
			echo "Cheapest price available is " . $prices[$i] . " at " . $pharmacies[$i] . "<br>";
		} else {
			echo "Price #" . $i+1 . " is " . $prices[$i] . " at " . $pharmacies[$i] . "<br>";
		}
	}

	echo "<a href='$allPricesUrl'>View all prices on GoodRx.com</a><br>";

}

?>
	<hr>
	<a href='http://GoodRx.com'>Powered by GoodRx</a>
	



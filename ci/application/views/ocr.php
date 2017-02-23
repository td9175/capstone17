<?php 
	
	//echo form_open('OCR/getImage', array('method'=>'get')); ?>
	<form action='OCR.php' method='POST'>
	<label for='searchQuery'>Enter a drug to search for: </label>
	<input type='text' name='searchQuery'>
	<input type='submit' name='submit' value='Search!'>
	</form>


<?php
if (isset($searchData)){
	
	foreach ($searchData->data->candidates as $candidate){
		echo "<a href='price_comparison/$candidate' >$candidate</a><br>";
	}
	var_dump($searchData);
}

if (isset($priceData)){

	$prices = $priceData->data->price_detail->price;
	$pharmacies = $priceData->data->price_detail->pharmacy;
	$allPricesUrl = $priceData->data->mobile_url;
	
	$countOfPrices = count($prices);
	
	for ($i=0; $i<$countOfPrices; $i++){
		echo "Price #" . ($i+1) . " is $" . $prices[$i] . " at " . $pharmacies[$i] . "<br>";
	}

	echo "<a href='$allPricesUrl'>View all prices on GoodRx.com</a><br>";

}

?>
	<hr>
	<a href='http://GoodRx.com'>Powered by GoodRx</a>

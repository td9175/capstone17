<?php
//defined('BASEPATH') OR exit('No direct script access allowed');

class Ocr extends CI_Controller {
	    
	    
	    public function testRecognizingTextFromImage() {
        $expected = "The quick brown fox\njumps over the lazy\ndog.";

        $actual = (new TesseractOCR('/receipts/test.png'))->run();

        $this->assertEquals($expected, $actual);
    	}


}
<?php
/*
		@Author: Robert Fink
		12bit - UMB Bank Health Spending App
*/

header("Access-Control-Allow-Origin: *");
require('application/libraries/REST_Controller.php');

class RegexOCR extends REST_Controller {

  function receipt_regex_get() {
      $string = '{
  "language": "en",
  "textAngle": 0,
  "orientation": "Up",
  "regions": [
    {
      "boundingBox": "156,822,550,333",
      "lines": [
        {
          "boundingBox": "158,822,546,35",
          "words": [
            {
              "boundingBox": "158,822,64,33",
              "text": "NGA"
            },
            {
              "boundingBox": "245,822,106,34",
              "text": "USIOO"
            },
            {
              "boundingBox": "434,824,270,33",
              "text": "008680087310H"
            }
          ]
        },
        {
          "boundingBox": "158,863,547,36",
          "words": [
            {
              "boundingBox": "158,863,232,35",
              "text": "SPTSUNBLOCK"
            },
            {
              "boundingBox": "433,865,272,34",
              "text": "007874214229H"
            }
          ]
        },
        {
          "boundingBox": "156,905,549,37",
          "words": [
            {
              "boundingBox": "156,905,65,36",
              "text": "MSO"
            },
            {
              "boundingBox": "242,906,85,34",
              "text": "ALOE"
            },
            {
              "boundingBox": "349,906,62,33",
              "text": "GEL"
            },
            {
              "boundingBox": "433,906,272,36",
              "text": "085758100358H"
            }
          ]
        },
        {
          "boundingBox": "538,948,167,46",
          "words": [
            {
              "boundingBox": "538,948,167,46",
              "text": "SUBTOTAL"
            }
          ]
        },
        {
          "boundingBox": "347,990,316,35",
          "words": [
            {
              "boundingBox": "347,990,103,35",
              "text": "TAXI"
            },
            {
              "boundingBox": "517,990,146,35",
              "text": "8.9751%"
            }
          ]
        },
        {
          "boundingBox": "601,1031,104,40",
          "words": [
            {
              "boundingBox": "601,1031,104,40",
              "text": "TOTAL"
            }
          ]
        },
        {
          "boundingBox": "473,1076,233,36",
          "words": [
            {
              "boundingBox": "473,1076,104,36",
              "text": "DEBIT"
            },
            {
              "boundingBox": "622,1076,84,36",
              "text": "TEND"
            }
          ]
        },
        {
          "boundingBox": "494,1119,212,36",
          "words": [
            {
              "boundingBox": "494,1119,127,35",
              "text": "CHANGE"
            },
            {
              "boundingBox": "642,1120,64,35",
              "text": "DUE"
            }
          ]
        }
      ]
    },
    {
      "boundingBox": "176,277,759,839",
      "lines": [
        {
          "boundingBox": "176,277,703,47",
          "words": [
            {
              "boundingBox": "176,277,61,32",
              "text": "See"
            },
            {
              "boundingBox": "258,280,79,32",
              "text": "back"
            },
            {
              "boundingBox": "360,284,39,29",
              "text": "of"
            },
            {
              "boundingBox": "421,289,138,34",
              "text": "receipt"
            },
            {
              "boundingBox": "582,290,58,29",
              "text": "for"
            },
            {
              "boundingBox": "661,299,79,25",
              "text": "your"
            },
            {
              "boundingBox": "760,293,119,29",
              "text": "chance"
            }
          ]
        },
        {
          "boundingBox": "176,319,244,35",
          "words": [
            {
              "boundingBox": "176,319,39,28",
              "text": "to"
            },
            {
              "boundingBox": "237,319,61,32",
              "text": "win"
            },
            {
              "boundingBox": "318,319,102,35",
              "text": "$1000"
            }
          ]
        },
        {
          "boundingBox": "213,428,530,109",
          "words": [
            {
              "boundingBox": "213,428,530,109",
              "text": "Walmart"
            }
          ]
        },
        {
          "boundingBox": "222,548,535,51",
          "words": [
            {
              "boundingBox": "222,548,101,37",
              "text": "Save"
            },
            {
              "boundingBox": "337,560,157,39",
              "text": "money."
            },
            {
              "boundingBox": "510,554,85,35",
              "text": "Live"
            },
            {
              "boundingBox": "609,554,148,36",
              "text": "better."
            }
          ]
        },
        {
          "boundingBox": "417,621,326,34",
          "words": [
            {
              "boundingBox": "417,621,61,32",
              "text": "573"
            },
            {
              "boundingBox": "502,622,12,31",
              "text": ")"
            },
            {
              "boundingBox": "539,622,61,31",
              "text": "499"
            },
            {
              "boundingBox": "623,622,20,29",
              "text": "-1"
            },
            {
              "boundingBox": "663,623,80,32",
              "text": "4935"
            }
          ]
        },
        {
          "boundingBox": "333,659,452,36",
          "words": [
            {
              "boundingBox": "333,659,144,34",
              "text": "MANAGER"
            },
            {
              "boundingBox": "499,661,141,33",
              "text": "TIMOTHY"
            },
            {
              "boundingBox": "663,663,122,32",
              "text": "TEMPLE"
            }
          ]
        },
        {
          "boundingBox": "416,701,267,34",
          "words": [
            {
              "boundingBox": "416,701,61,32",
              "text": "415"
            },
            {
              "boundingBox": "498,701,121,33",
              "text": "CONLEY"
            },
            {
              "boundingBox": "642,702,41,33",
              "text": "RD"
            }
          ]
        },
        {
          "boundingBox": "374,741,348,35",
          "words": [
            {
              "boundingBox": "374,741,164,34",
              "text": "COLUMBIA"
            },
            {
              "boundingBox": "560,742,40,33",
              "text": "MO"
            },
            {
              "boundingBox": "622,741,100,35",
              "text": "65201"
            }
          ]
        },
        {
          "boundingBox": "246,781,689,36",
          "words": [
            {
              "boundingBox": "246,781,105,33",
              "text": "00159"
            },
            {
              "boundingBox": "456,783,124,32",
              "text": "009050"
            },
            {
              "boundingBox": "684,784,41,32",
              "text": "50"
            },
            {
              "boundingBox": "830,785,105,32",
              "text": "03870"
            }
          ]
        },
        {
          "boundingBox": "812,951,106,34",
          "words": [
            {
              "boundingBox": "812,951,106,34",
              "text": "22.92"
            }
          ]
        },
        {
          "boundingBox": "813,1037,108,35",
          "words": [
            {
              "boundingBox": "813,1037,108,35",
              "text": "24.98"
            }
          ]
        },
        {
          "boundingBox": "814,1080,108,36",
          "words": [
            {
              "boundingBox": "814,1080,108,36",
              "text": "24.98"
            }
          ]
        }
      ]
    },
    {
      "boundingBox": "142,1249,721,226",
      "lines": [
        {
          "boundingBox": "492,1249,343,40",
          "words": [
            {
              "boundingBox": "492,1249,63,39",
              "text": "PAY"
            },
            {
              "boundingBox": "578,1249,87,39",
              "text": "FROM"
            },
            {
              "boundingBox": "686,1251,149,38",
              "text": "PRIMARY"
            }
          ]
        },
        {
          "boundingBox": "146,1250,193,37",
          "words": [
            {
              "boundingBox": "146,1250,65,36",
              "text": "EFT"
            },
            {
              "boundingBox": "234,1250,105,37",
              "text": "DEBIT"
            }
          ]
        },
        {
          "boundingBox": "210,1295,456,40",
          "words": [
            {
              "boundingBox": "210,1295,108,37",
              "text": "24.98"
            },
            {
              "boundingBox": "363,1296,106,39",
              "text": "TOTAL"
            },
            {
              "boundingBox": "491,1296,175,39",
              "text": "PURCHASE"
            }
          ]
        },
        {
          "boundingBox": "145,1338,167,42",
          "words": [
            {
              "boundingBox": "145,1338,42,36",
              "text": "US"
            },
            {
              "boundingBox": "207,1340,105,40",
              "text": "DEBIT"
            }
          ]
        },
        {
          "boundingBox": "778,1343,84,38",
          "words": [
            {
              "boundingBox": "778,1343,84,38",
              "text": "1034"
            }
          ]
        },
        {
          "boundingBox": "143,1384,392,44",
          "words": [
            {
              "boundingBox": "143,1384,64,37",
              "text": "REF"
            },
            {
              "boundingBox": "230,1387,19,35",
              "text": "#"
            },
            {
              "boundingBox": "273,1387,262,41",
              "text": "711000190280"
            }
          ]
        },
        {
          "boundingBox": "142,1429,721,46",
          "words": [
            {
              "boundingBox": "142,1429,150,38",
              "text": "NETWORK"
            },
            {
              "boundingBox": "315,1432,57,38",
              "text": "ID."
            },
            {
              "boundingBox": "401,1435,88,40",
              "text": "0082"
            },
            {
              "boundingBox": "512,1437,88,36",
              "text": "APPR"
            },
            {
              "boundingBox": "623,1433,87,37",
              "text": "CODE"
            },
            {
              "boundingBox": "733,1433,130,37",
              "text": "452660"
            }
          ]
        }
      ]
    },
    {
      "boundingBox": "831,825,139,555",
      "lines": [
        {
          "boundingBox": "831,825,127,34",
          "words": [
            {
              "boundingBox": "831,825,83,33",
              "text": "9.97"
            },
            {
              "boundingBox": "937,826,21,33",
              "text": "x"
            }
          ]
        },
        {
          "boundingBox": "832,867,128,34",
          "words": [
            {
              "boundingBox": "832,867,84,33",
              "text": "5.98"
            },
            {
              "boundingBox": "938,868,22,33",
              "text": "x"
            }
          ]
        },
        {
          "boundingBox": "832,908,128,35",
          "words": [
            {
              "boundingBox": "832,908,85,34",
              "text": "6.97"
            },
            {
              "boundingBox": "939,910,21,33",
              "text": "x"
            }
          ]
        },
        {
          "boundingBox": "834,993,86,36",
          "words": [
            {
              "boundingBox": "834,993,86,36",
              "text": "2.06"
            }
          ]
        },
        {
          "boundingBox": "836,1123,87,37",
          "words": [
            {
              "boundingBox": "836,1123,87,37",
              "text": "0.00"
            }
          ]
        },
        {
          "boundingBox": "904,1342,66,38",
          "words": [
            {
              "boundingBox": "904,1342,66,38",
              "text": "10"
            }
          ]
        }
      ]
    }
  ]
}
';

  // Get the Y cordinate for everything
  preg_match_all('/\d+,(\d+),\d+,\d+/i', $string, $matches);

  // Put the matches array into a named variable
  $yPositions = $matches[1];

  // Initialize an empty array to hold the positions
  $positions = array();

  // Cast the array of strings to Int
  foreach ($yPositions as $position) {
    $integerPosition = (Int) $position;
    array_push($positions, $integerPosition);
  }

  // Remove duplicate Y values
  $positions = array_unique($positions);

  // Sort ascending
  array_multisort($positions, SORT_ASC);

  $wordString = "";

  // Loop through the Y positions
  foreach ($positions as $position) {
    // Build regular expression
    $regex = '/\d{1,3},'.$position.',\d{1,3},\d{1,3}.*\n.*text":\s"(.*)"/';

    // Match for the words
    preg_match_all($regex, $string, $matches);
      $words = $matches[1];

      // Turn the array into a string
      foreach ($words as $word) {
        $wordString .= $word . " ";
      }
  }
  echo "$wordString";

  // Match for qualified items, capture the amount
  $regex = '/\d{12}H\s(\d+\.\d+)[^\d]/';
  preg_match_all($regex, $wordString, $matches);

  $qualifiedAmounts = $matches[1];
  var_dump($qualifiedAmounts);

  // Add up the amounts for the total qualified amount
  $total = 0;
  foreach ($qualifiedAmounts as $qualifiedAmount) {
    $total += (Int) $qualifiedAmount;
  }
  echo "Total: $total \n";


  } //

}

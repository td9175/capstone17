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
            "boundingBox": "177,100,175,104",
            "lines": [
              {
                "boundingBox": "177,100,175,17",
                "words": [
                  {
                    "boundingBox": "177,100,80,17",
                    "text": "HEALTH"
                  },
                  {
                    "boundingBox": "266,100,48,17",
                    "text": "AND"
                  },
                  {
                    "boundingBox": "323,100,29,17",
                    "text": "GO"
                  }
                ]
              },
              {
                "boundingBox": "185,129,159,17",
                "words": [
                  {
                    "boundingBox": "185,130,58,16",
                    "text": "12345"
                  },
                  {
                    "boundingBox": "253,129,57,17",
                    "text": "MAIN"
                  },
                  {
                    "boundingBox": "319,129,25,17",
                    "text": "ST"
                  }
                ]
              },
              {
                "boundingBox": "207,158,115,17",
                "words": [
                  {
                    "boundingBox": "207,158,115,17",
                    "text": "COLUMBIA"
                  }
                ]
              },
              {
                "boundingBox": "177,187,174,17",
                "words": [
                  {
                    "boundingBox": "177,187,106,17",
                    "text": "MISSOURI"
                  },
                  {
                    "boundingBox": "293,188,58,16",
                    "text": "65201"
                  }
                ]
              }
            ]
          },
          {
            "boundingBox": "53,257,134,189",
            "lines": [
              {
                "boundingBox": "101,257,45,16",
                "words": [
                  {
                    "boundingBox": "101,257,45,16",
                    "text": "0019"
                  }
                ]
              },
              {
                "boundingBox": "53,285,63,17",
                "words": [
                  {
                    "boundingBox": "53,285,63,17",
                    "text": "ADVIL"
                  }
                ]
              },
              {
                "boundingBox": "54,314,107,17",
                "words": [
                  {
                    "boundingBox": "54,314,107,17",
                    "text": "SHAMPOO"
                  }
                ]
              },
              {
                "boundingBox": "55,342,107,17",
                "words": [
                  {
                    "boundingBox": "55,342,107,17",
                    "text": "BANDAIDS"
                  }
                ]
              },
              {
                "boundingBox": "53,371,134,17",
                "words": [
                  {
                    "boundingBox": "53,371,64,17",
                    "text": "VIDEO"
                  },
                  {
                    "boundingBox": "127,371,60,17",
                    "text": "GAME"
                  }
                ]
              },
              {
                "boundingBox": "53,400,111,17",
                "words": [
                  {
                    "boundingBox": "53,400,39,17",
                    "text": "ACE"
                  },
                  {
                    "boundingBox": "100,400,64,17",
                    "text": "WRAP"
                  }
                ]
              },
              {
                "boundingBox": "54,429,106,17",
                "words": [
                  {
                    "boundingBox": "54,429,54,17",
                    "text": "COKE"
                  },
                  {
                    "boundingBox": "116,430,44,16",
                    "text": "120z"
                  }
                ]
              }
            ]
          },
          {
            "boundingBox": "198,285,119,190",
            "lines": [
              {
                "boundingBox": "205,285,111,17",
                "words": [
                  {
                    "boundingBox": "205,285,111,17",
                    "text": "0015488514"
                  }
                ]
              },
              {
                "boundingBox": "205,314,112,17",
                "words": [
                  {
                    "boundingBox": "205,314,112,17",
                    "text": "0028556614"
                  }
                ]
              },
              {
                "boundingBox": "205,342,106,17",
                "words": [
                  {
                    "boundingBox": "205,342,106,17",
                    "text": "0017442314"
                  }
                ]
              },
              {
                "boundingBox": "203,372,96,16",
                "words": [
                  {
                    "boundingBox": "203,372,96,16",
                    "text": "00856487"
                  }
                ]
              },
              {
                "boundingBox": "205,400,108,17",
                "words": [
                  {
                    "boundingBox": "205,400,108,17",
                    "text": "001846221-1"
                  }
                ]
              },
              {
                "boundingBox": "205,430,94,16",
                "words": [
                  {
                    "boundingBox": "205,430,94,16",
                    "text": "00125498"
                  }
                ]
              },
              {
                "boundingBox": "198,458,104,17",
                "words": [
                  {
                    "boundingBox": "198,458,104,17",
                    "text": "SUBTOTAL"
                  }
                ]
              }
            ]
          },
          {
            "boundingBox": "125,486,191,133",
            "lines": [
              {
                "boundingBox": "125,486,142,17",
                "words": [
                  {
                    "boundingBox": "125,486,52,17",
                    "text": "TAXI"
                  },
                  {
                    "boundingBox": "188,487,53,16",
                    "text": "8.250"
                  },
                  {
                    "boundingBox": "249,486,18,17",
                    "text": "%"
                  }
                ]
              },
              {
                "boundingBox": "238,515,63,17",
                "words": [
                  {
                    "boundingBox": "238,515,63,17",
                    "text": "TOTAL"
                  }
                ]
              },
              {
                "boundingBox": "198,573,118,17",
                "words": [
                  {
                    "boundingBox": "198,573,54,17",
                    "text": "CASH"
                  },
                  {
                    "boundingBox": "261,573,55,17",
                    "text": "TEND"
                  }
                ]
              },
              {
                "boundingBox": "175,602,138,17",
                "words": [
                  {
                    "boundingBox": "175,602,87,17",
                    "text": "CHANGE"
                  },
                  {
                    "boundingBox": "272,602,41,17",
                    "text": "DUE"
                  }
                ]
              }
            ]
          },
          {
            "boundingBox": "339,286,114,333",
            "lines": [
              {
                "boundingBox": "414,286,38,16",
                "words": [
                  {
                    "boundingBox": "414,286,38,16",
                    "text": "2.67"
                  }
                ]
              },
              {
                "boundingBox": "403,315,50,16",
                "words": [
                  {
                    "boundingBox": "403,315,50,16",
                    "text": "13.24"
                  }
                ]
              },
              {
                "boundingBox": "410,343,39,16",
                "words": [
                  {
                    "boundingBox": "410,343,39,16",
                    "text": "1.05"
                  }
                ]
              },
              {
                "boundingBox": "397,372,51,16",
                "words": [
                  {
                    "boundingBox": "397,372,51,16",
                    "text": "42.65"
                  }
                ]
              },
              {
                "boundingBox": "398,401,47,16",
                "words": [
                  {
                    "boundingBox": "398,401,47,16",
                    "text": "11.23"
                  }
                ]
              },
              {
                "boundingBox": "404,430,39,16",
                "words": [
                  {
                    "boundingBox": "404,430,39,16",
                    "text": "2.45"
                  }
                ]
              },
              {
                "boundingBox": "382,459,50,16",
                "words": [
                  {
                    "boundingBox": "382,459,50,16",
                    "text": "73.29"
                  }
                ]
              },
              {
                "boundingBox": "391,487,40,16",
                "words": [
                  {
                    "boundingBox": "391,487,40,16",
                    "text": "6.05"
                  }
                ]
              },
              {
                "boundingBox": "382,516,51,16",
                "words": [
                  {
                    "boundingBox": "382,516,51,16",
                    "text": "79.34"
                  }
                ]
              },
              {
                "boundingBox": "339,574,55,16",
                "words": [
                  {
                    "boundingBox": "339,574,55,16",
                    "text": "80.00"
                  }
                ]
              },
              {
                "boundingBox": "350,603,40,16",
                "words": [
                  {
                    "boundingBox": "350,603,40,16",
                    "text": "0.66"
                  }
                ]
              }
            ]
          },
          {
            "boundingBox": "101,665,310,115",
            "lines": [
              {
                "boundingBox": "114,665,259,26",
                "words": [
                  {
                    "boundingBox": "114,666,23,25",
                    "text": "#"
                  },
                  {
                    "boundingBox": "151,665,96,26",
                    "text": "ITEMS"
                  },
                  {
                    "boundingBox": "260,665,83,26",
                    "text": "SOLD"
                  },
                  {
                    "boundingBox": "357,667,16,24",
                    "text": "6"
                  }
                ]
              },
              {
                "boundingBox": "101,729,310,25",
                "words": [
                  {
                    "boundingBox": "101,729,64,19",
                    "text": "Thank"
                  },
                  {
                    "boundingBox": "173,735,37,19",
                    "text": "you"
                  },
                  {
                    "boundingBox": "219,729,30,19",
                    "text": "for"
                  },
                  {
                    "boundingBox": "257,735,47,19",
                    "text": "your"
                  },
                  {
                    "boundingBox": "312,730,99,18",
                    "text": "business!"
                  }
                ]
              },
              {
                "boundingBox": "131,759,84,21",
                "words": [
                  {
                    "boundingBox": "131,759,84,21",
                    "text": "04\/20\/17"
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

  $yPosition = $matches[1];

  foreach ($yPosition as $position) {
    $regex = '/'. $position . '.*?"text":\s+"(.*?)"/ix';
    echo "$regex \n";
    // echo "$regex \n\n";
    // preg_match_all($regex, $string, $matches);
    // var_dump($matches[1]);

  }


  //
  // $words = $matches[1];
  //
  // var_dump($matches[1]);
  //
  // echo "\n\n";
  //
  // foreach ($words as $line) {
  //   echo "$line \n";
  // }


  }

}

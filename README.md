# HexapodApi : Parcours(FR) = Course(EN)
# Methods : GET - POST - PUT - DELETE

## GET ## 
-- Get URL : ./HexapodApi/api/parcours_controller.php --
-- GetById URL : ./HexapodApi/api/parcours_controller.php?id= --

## DELETE ## 
URL : ./HexapodApi/api/parcours_controller.php?id=

## POST ## 
URL : ./HexapodApi/api/parcours_controller.php

 -- JSON format data --
   {
    "parcours": {
        "name": "",
		"command": ""
       }
    }

## PUT ## 

URL : ./HexapodApi/api/parcours_controller.php?id=
 -- JSON format data --
   {
    "parcours": {
        "name": "",
		"command": ""
       }
    }

# ------------------------------------------------------- #
# Received data :

    array 
    0 => 
        object
        public 'id' => string '' 
        public 'name' => string '' 
        public 'command' => string '' 
  

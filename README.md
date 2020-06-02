# HexapodApi
# Methods : GET - POST - PUT - DELETE

## GET ## 
-- Get URL : ./HexapodApi/api/parcours_controller.php --
-- GetById URL : ./HexapodApi/api/parcours_controller.php?id= --

## DELETE ## 
URL : ./HexapodApi/api/parcours_controller.php?id=

## POST ## 
URL : ./HexapodApi/api/parcours_controller.php

 -- Form data --
    $_POST['name']
    $_POST['command']

 -- JSON format data --
   {
    "parcours": {
    	"id": 0,
        "name": "",
		"command": ""
       }
    }

## PUT ## 

URL : ./HexapodApi/api/parcours_controller.php?id=
 -- Form data --
    $_POST['name']
    $_POST['command']

URL : ./HexapodApi/api/parcours_controller.php
 -- JSON format data --
   {
    "parcours": {
    	"id": ,
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
  

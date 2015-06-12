<?php
/*
*** product ***
{
    "code": <string>,
	"prices": [
		{
            "color": <string>,
			"size": <string>,
			"label": <string>,
			"price": <number>,
			"quantity": <number>
		}
	],
	"categories": [<_id>],
	"minimum_quantity": <number>,
	"date_available": <datetime>,
	"required_shipping": <number>,
	"length": <number>,
	"width": <number>,
	"height": <number>,
	"weight": <number>,
	"brands": [<string>],
	"point_buy": <number>,
	"reward": [
		{
            "group": <_id>,
			"point": <number>
		}
	],
	"out_of_stock": {
    "id": <_id>,
		"content": <number>
	},
	"tax": [
		{
            "id": <_id>,
			"name": <string>,
			"value": <number>,
			"type": <number>
		}
	],
	"related" : {
        "<_id>": [
            {
                "color": <string>,
                "size": <string>,
                "label": <string>,
                "price": <number>,
                "quantity": <number>
            }
        ]
	},
	"images" : [<string>],
	"comments" : [
		{
            "owner": {"id": <_id>, "username": <string>},
			"date": <datetime>,
			"ranking": <number>,
			"content": <string>
		}
	],
	"status" : <number>
}

*** product_description ***
{
    <language> : {
        "<alias>" : {
            "_id": <string>,
            "alias": <string>,
			"name" : <string>,
			"catalog" : <string>,
			"description" : {
                "short" : <string>,
				"long": <string>
			},
			"keyword": <string>,
			"tag": <string>,
			"categories": {
                "<_id>" : {
                    "alias": <string>,
                    "name": <string>
                }
			},
			"related": {
                "<_id>" : {
                    "alias": <string>,
                    "name": <string>,
                    "description": <string>
				}
			},
		}
	}
}
*/
class Product_model extends CI_Model {

    function construct(){
        parent::__construct();
    }

    public function getProducts() {
        return false;
    }
}
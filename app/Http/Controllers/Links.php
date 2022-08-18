<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;

class Links extends Controller
{
    public function index(Request $req)
    {
        $data = $req->all();
        
         $filters = explode(',', $data['filter']);
         $query_string_arr = '';
         $count = 0; 
         foreach($filters as $filter){

            //$query_string_arr[]["filter['any_retailer_services']"] = $filter;
            if($count  == count($filters)){
                $and = '';
            }else{
                $and = '&';
            }
            $query_string_arr .="filter['any_retailer_services'] =$filter$and";
         }

        
         //$query_str = implode('&',$query_string_arr);
             
         // die(); 
        // $link = $req->input('link');
        // return ["link" => $link];

        // $response = Http::get('https://api-g.weedmaps.com/discovery/v2/listings?sort_by=position_distance&decisions%5B%5D=card_row%3Amap&auction%5Blisting_region_ids%5D%5B%5D=481&auction%5Bresults%5D=4&filter%5Bany_retailer_services%5D%5B%5D=storefront&filter%5Bbounding_radius%5D=75mi&filter%5Bbounding_latlng%5D=40.77984619140625%2C-73.96853637695312&latlng=40.77984619140625%2C-73.96853637695312&page_size=100&page=1&include%5B%5D=facets.has_curbside_pickup&include%5B%5D=facets.retailer_services');
       
       // $query_string = "filter['any_retailer_services'][]= delivery&filter['any_retailer_services'][] = 'storefront'";
        $query_string = urlencode($query_string_arr);
        $response = Http::get("https://api-g.weedmaps.com/discovery/v2/listings?sort_by=position_distance&$query_string");
        //$test = implode('&',$filter);
       
        
        return $response;
    }

}

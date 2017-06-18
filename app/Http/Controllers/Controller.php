<?php

namespace App\Http\Controllers;

use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Routing\Controller as BaseController;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Auth\Access\AuthorizesResources;
use Illuminate\Http\Request;

class Controller extends BaseController
{
    use AuthorizesRequests, AuthorizesResources, DispatchesJobs, ValidatesRequests;

    public function searchPost(Request $request )
    {
    	$search = urlencode($request->input('search')); // keyword search 
    	// $combined_amzon = $this->AmazonData($search);
    	$combined_ebay = $this->EbayData($search);
    	echo "<pre>";
    	print_r($combined_ebay);
    	// return view('welcome', ['amazon' => $combined_amzon,'ebay'=>$combined_ebay]);
    	

    }

    public function AmazonData($search)
    {
    	$list = array(); // declare
    	$combined_amzon = array(); // declare
    	$combined_ebay = array();// delecalre
    	include_once 'simple_html_dom.php'; 
    	$url = "https://www.amazon.co.uk/s/ref=nb_sb_noss?url=search-alias%3Daps&field-keywords=$search&rh=i%3Aaps%2Ck%3A$search";
    	$html = file_get_html($url);
    	for($i=2;$i<10;$i++){
    		foreach($html->find("li[id=result_$i]") as $element):
	    			$img =$element->find('img',0);
	    			$list['img'] = $img->src;
	    			$list['title'] = $element->find('h2',0)->plaintext;
	    			$list['price'] = $element->find('div[class=a-row a-spacing-none]',2)->plaintext;
	    			$list['seller'] = $element->find('div[class=a-row a-spacing-none]',1)->plaintext;
	    			// $list['StockLeft'] = $element->find('div[class=a-row a-spacing-none]',5)->plaintext;
	    			$combined_amzon[] = $list;
	       	endforeach;
	    	
	    }
	    return $combined_amzon;
    }

    public function EbayData($search)
    {
    	$list = array(); // declare
    	$combined_ebay = array();// delecalre
    	include_once 'simple_html_dom.php'; 
    	$url = "https://www.ebay.co.uk/sch/i.html?_from=R40&_trksid=p2380057.m570.l1313.TR12.TRC2.A0.H0.Xipad.TRS0&_nkw=$search&_sacat=0";
    	$html = file_get_html($url);
    	$all_text= $html->find("li[class=sresult lvresult clearfix li shic]",0)->plaintext; 
    	foreach($html->find("li[class=sresult lvresult clearfix li shic]") as $element):
			$img =$element->find('img[class=img]',0);
			$list['img'] = $img->src;
			if(strpos('.gif', $list['img'])==false)
			{
				$list['title'] = $element->find('a[class=vip]',0)->plaintext;
				$list['price'] = $element->find('span[class=bold]',0)->plaintext;
				$list['seller'] = "none";
				// $list['StockLeft'] = $element->find('div[class=a-row a-spacing-none]',5)->plaintext;
				$combined_ebay[] = $list;
			}
			
		endforeach;
		return $combined_ebay;
    }

   
}

<?php

namespace App\Http\Controllers;

use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Routing\Controller as BaseController;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Auth\Access\AuthorizesResources;
use Illuminate\Http\Request;
use Barryvdh\DomPDF\Facade as PDF;
use Illuminate\Support\Facades\Redirect;
use Maatwebsite\Excel\Facades\Excel;
use App\users;

class Controller extends BaseController
{
    use AuthorizesRequests, AuthorizesResources, DispatchesJobs, ValidatesRequests;

    public function searchPost(Request $request )
    {
    	if (!Auth::check() && !Request::is('login')) {
           return Redirect::route('login');

         }
    	$search = urlencode($request->input('search')); // keyword search 
    	$combined_amzon = $this->AmazonData($search);
    	$combined_ebay = $this->EbayData($search);
    	return view('welcome', ['amazon' => $combined_amzon,'ebay'=>$combined_ebay,'css'=>'go']);
    	

    }

    public function AmazonData($search)
    {
    	$list = array(); // declare
    	$combined_amzon = array(); // declare
    	$combined_ebay = array();// delecalre
    	include_once 'simple_html_dom.php'; 
    	$url = "https://www.amazon.co.uk/s/ref=nb_sb_noss?url=search-alias%3Daps&field-keywords=$search&rh=i%3Aaps%2Ck%3A$search";
    	$html = file_get_html($url);
    	for($i=2;$i<15;$i++){
    		foreach($html->find("li[id=result_$i]") as $element):
	    			$img =$element->find('img',0);
	    			$list['img'] = $img->src;
	    			$list['title'] = $element->find('h2',0)->plaintext;
	    			$list['price'] = $element->find('a',2)->plaintext;
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
			if(strpos($list['img'],'.gif')==false)
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

    public function PDFDownload()
    {

    	$search = urlencode('iphone'); // keyword search 
    	$combined_amzon = $this->AmazonData($search);
    	$combined_ebay = $this->EbayData($search);
    	$pdf = PDF::loadView('welcome', ['amazon' => $combined_amzon,'ebay'=>$combined_ebay,'css'=>'stop']);
		return $pdf->download('invoice.pdf');
    }

    
    public function exportToCSV()
	 {
		Excel::create('Laravel Excel', function($excel) {
	        $excel->sheet('Excel sheet', function($sheet) {
		    	$search = urlencode('iphone'); // keyword search 
		    	$combined_amzon = $this->AmazonData($search);
		    	$combined_ebay = $this->EbayData($search);
		        $sheet->loadView('csv', ['amazon' => $combined_amzon,'ebay'=>$combined_ebay,'css'=>'stop']);
		    });

	    })->export('csv');
	 }

	 public function Login()
	 {
	 	return view('login',['css'=>'go']);
	 }

	 public function checkLogin(Request $request)
	 {
	 	// print_r($request->input());
	 	// $users = users::all();
	 	// foreach ($users as $key) {
	 	// 	if($request->input('email')==$key->username && )
	 	// }
	 }

	 public function WhoAPi($domain)
	 {
	 	$content =file_get_contents("http://api.bulkwhoisapi.com/whoisAPI.php?domain=$domain&token=7d3f08b98ab9f69ae15060a5b58ef1ee");
	 	return json_decode($content);
	 }

	 public function findDomain(Request $request)
	 {
	 	$domain = $request->input('domain');
	 	$data = $this->WhoAPi($domain);
	 	return view('domain',['data'=>$data,'css'=>'go']);
	 }


   
}

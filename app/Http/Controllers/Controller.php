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
use App\ProductSearch;
use App\Domains;
use Parsehub\Parsehub;

class Controller extends BaseController
{
    use AuthorizesRequests, AuthorizesResources, DispatchesJobs, ValidatesRequests;

    public function searchPost(Request $request )
    {
    	// if ($request->session()->get('key')!='success') {
     //       return Redirect::route('login');

     //     }
    	$search = urlencode($request->input('search')); // keyword search 
    	$combined_amzon = $this->CheckAPI();
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
	    			$list['seller'] = "by Amazon";
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
				$list['seller'] = "By Ebay";
				// $list['StockLeft'] = $element->find('div[class=a-row a-spacing-none]',5)->plaintext;
				$combined_ebay[] = $list;
			}
			
		endforeach;
		return $combined_ebay;
    }

    public function PDFDownload(Request $request)
    {

    	$search = urlencode($request->input('search')); // keyword search 
    	$combined_amzon = $this->AmazonData($search);
    	$combined_ebay = $this->EbayData($search);
    	$pdf = PDF::loadView('welcome_pdf', ['amazon' => $combined_amzon,'ebay'=>$combined_ebay,'css'=>'stop']);
		return $pdf->download('Product.pdf');
    }

    
    public function exportToCSV(Request $request)
	 {
		Excel::create('Laravel Excel', function($excel) {
	        $excel->sheet('Excel sheet', function($sheet) {
		    	$search = urlencode($_GET['search']); // keyword search 
		    	$combined_amzon = $this->AmazonData($search);
		    	$combined_ebay = $this->EbayData($search);
		        $sheet->loadView('csv', ['amazon' => $combined_amzon,'ebay'=>$combined_ebay,'css'=>'stop']);
		    });

	    })->export('csv');
	 }

	 public function Login()
	 {

	 	return view('login/login',['css'=>'go']);
	 }

	 public function checkLogin(Request $request)
	 {

	 	$users = users::all();
	 	foreach ($users as $key) {
	 		if($request->input('email')==$key->username && $request->input('password')== $key->password)
	 		{
	 			$request->session()->put('login', 'success');
	 			$request->session()->put('User', $key->id);
	 			return redirect('/welcome');

	 		}
	 		else
	 		{
	 			return Redirect::back()->withErrors(['Incoorect username and password', 'The Message']);
	 		}
	 	}
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

	 public function PDFDownloadD(Request $request)
	 {
	 	$domain = urlencode($request->input('domain')); // keyword search 
    	$data = $this->WhoAPi($domain);
    	$pdf = PDF::loadView('domainGen',['data'=>$data,'css'=>'stop']);
		return $pdf->download('domain.pdf');
	 }

	 public function exportToCSVD(Request $request)
	 {
	 	Excel::create('Laravel Excel', function($excel) {
	        $excel->sheet('Excel sheet', function($sheet) {
		    	$domain = urlencode($_GET['domain']); // keyword search 
		    	$data = $this->WhoAPi($domain);
		        $sheet->loadView('domainGen',['data'=>$data,'css'=>'stop']);
		    });

	    })->export('csv');
	 }

	 public function SaveToDB(Request $request)
	 {
	 	$user_id = $request->session()->get('User');
	 	$search = urlencode($request->input('search'));
	 	$combined_amzon = $this->AmazonData($search);
    	$combined_ebay = $this->EbayData($search);
	 	$product = new ProductSearch();
	 	//amazon data 
	 	foreach ($combined_amzon as $key) {
	 		$product->insert(['image'=>$key['img'],'name'=>$key['title'],'price'=>$key['price'],'seller'=>$key['seller'],'user_id'=>$user_id]);
	 	}
	 	//ebay data
	 	foreach ($combined_ebay as $key) {
	 		$product->insert(['image'=>$key['img'],'name'=>$key['title'],'price'=>$key['price'],'seller'=>$key['seller'],'user_id'=>$user_id]);
	 	}
	 	return redirect()->back()->with('message', 'Data Saved!');
	 	

	 }

	 public function SaveDToDB(Request $request)
	 {
	 	$user_id = $request->session()->get('User');
	 	$search = urlencode($request->input('domain'));
	 	$data = $this->WhoAPi($search);
	 	$domain = new Domains();
	 	$domain->insert(['domain'=>$search,'user_id'=>$user_id]);
	 	
	 	return redirect()->back()->with('message', 'Data Saved!');
	 }


	 public function CheckAPI(Request $request)
	 {
	 	$api_key = "txotmiiRkdsi";
	 	$parsehub = new Parsehub($api_key);
		$projectList = $parsehub->getProjectList();
		$array = json_decode($projectList);
		$project_token = $array->projects[0]->last_ready_run->project_token;
		$run_token = $array->projects[0]->last_ready_run->run_token;
		$start_url = $array->projects[0]->last_ready_run->start_url;
		echo "<pre>";
		// print_r($array);
		// $parsehub = new Parsehub($api_key);
		$options = array(
		    // Skip start_url option if don't want to override starting url configured
		    // on parsehub.
		    'start_url' => 'https://www.amazon.co.uk/s/ref=nb_sb_noss_2?url=search-alias%3Daps&field-keywords=hp',
		    // Enter comma separated list of keywords to pass into `start_value_override`
		    'keywords' => 'iphone case, iphone copy',
		    // Set send_email options. Skip to remain this value default.
		    // 'send_email' => 1,
		);
		// $run_obj = $parsehub->runProject($project_token, $options);
		// $project_data = json_decode($run_obj);
		// $request->session()->put('Rundata', $project_data);

		

		// $parsehub = new Parsehub($api_key);
		// $cancel = $parsehub->cancelProjectRun($project_data->run_token);
		// $data = $parsehub->getLastReadyRunData($project_data->project_token);
		// // $run = $parsehub->getRun($run_token);
		// // print $run;
		// $array_main = json_decode($data);
		// print_r($array_main);
		// $item = array();
		// $all_item = array();
		// $total =  count($array_main->title);
		// for($i=0;$i<70;$i++)
		// {
		// 	$item['title'] = $array_main->title[$i]->name;
		// 	$item['img'] = $array_main->images[$i]->name;
		// 	$item['price'] = $array_main->price[$i]->name;
		// 	$item['seller'] = $array_main->seller[$i]->name;
		//  $all_item[]=$item;
		// }
		// return $all_item;
		// print_r($all_item);
		echo "<pre>";
		// print_r($request->session()->get('Rundata'));
		$this->CancelProject($request);

	 }

	 public function CancelProject($request)
	 {
	 	$project=$request->session()->get('Rundata');
	 	print_r($project->run_token);
	 	$api_key = "txotmiiRkdsi";
	 	$parsehub = new Parsehub($api_key);
	 	$cancel = $parsehub->cancelProjectRun($project->run_token);
	 	$cancel_data = json_decode($cancel);
	 	$request->session()->put('CancelData',$cancel_data);
	 	$Cancel_project=$request->session()->get('CancelData');
	 	$Cancel_project->run_token;
	 	$data = $parsehub->getLastReadyRunData($project->run_token);
		$array_main = json_decode($data);
		print_r($array_main);
	 }


   
}

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
use App\projects;
use Ixudra\Curl\Facades\Curl;
use Illuminate\Support\Facades\Log;

class Controller extends BaseController
{
    use AuthorizesRequests, AuthorizesResources, DispatchesJobs, ValidatesRequests;

    public function searchPost()
    {
    	$request  = new Request();
    	$projects = new projects();
    	$Get = $projects->where(['status'=>1])->first();
    	if(isset($Get->id))
    	{

    		$data = $this->AmazonData($Get->id);
    		// $data1 = $this->EbayData($Get->id);
    		if($data!='no')
    		{
    			$projects->where('id',$Get->id)->update(['status'=>2,'page'=>$this->getOnGoingProjectPageInfo()]);

    			// $id = $projects->where(['status'=>0])->first();
		    	// $projects->where('id',$id->id)->update(['status'=>1]);
		    	// $search = urlencode($id->keyword); // keyword search 
		    	// $this->initilizeProject($search);
		    	// $this->amazonSearch($search);
		    	// $this->initilizeProjectEbay($search);
    		}
    		else
    		{
    			// echo "still running.";
    			Log::info('still running');
    		}
    	} else {
    		$id = $projects->where(['status'=>0])->first();
    		if(isset($id->id))
    		{
    			$projects->where('id',$id->id)->update(['status'=>1]);
		    	$search = urlencode($id->keyword); // keyword search 
			    	$this->amazonSearch($search);
			    	$this->initilizeProject($search);
			    	Log::info('Started here');

    		}
    		else
    		{
    			// echo "Nothing found";
    			Log::info('Nothing found');
    			// Log::info('Showing user profile for user: ');
    		}
	    	
    	}
    	
    	

    			
    		
    	
    	
    	

    }

    public function addSearch()
    {
    	return view('addSearch',['css'=>'go']);
    }
    public function addProjectToDB(Request $request)
    {

    	$projects = new projects();
    	$projects->insert(['name'=>$request->input('pname'),'keyword'=>urlencode($request->input('pkeyword')),'des'=>$request->input('des')]);
    	return redirect()->back()->with('message', 'Project Data Saved!');
    }
    public function GetproductListing()
    {
    	// $this->searchPost();
    	$projects =  projects::all();
    	return view('productListing',['projects'=>$projects,'css'=>'go','page'=>$this->getOnGoingProjectPageInfo()]);
    }

    public function finalresult(Request $request)
    {
    	$projects = new ProductSearch();
    	$id = $request->input('id');
    	$data = $projects->where('project_id',$request->input('id'))->paginate(15);
    	$data =  $data->appends(['id'=>$id]);
    	return view('welcome', ['amazon'=>$data,'css'=>'go','i'=>0]);
    }

    public function AmazonData($id)
    {
    	if($this->getEndTime(0)!="" && $this->getEndTime(1)!="")
    		{    
    			$combined_amzon = $this->getLastRundata(0,$id);
    			return $combined_amzon;

    			// $combined_amzon = $this->getLastRundata(2);

    			// return view('welcome_amazon', ['amazon' => $combined_amzon]);
    			// break;
    		}
    		else
    		{
    			return "no";
    			// exit();
    		}
    }

    public function EbayData($id)
    {
    	if($this->getEndTime(1)!="" && $this->getEndTime(0)!="")
    		{    
    			$combined_ebay = $this->getLastRundata(1,$id);
    			// $combined_amzon = $this->getLastRundata(2);
    			return view('welcome_ebay', ['ebay' => $combined_ebay]);
    			// break;
    		}
    		else
    		{
    			return "no";
    			// exit();
    		}
    }

    
    public function PDFDownload(Request $request)
    {

    	$projects = new ProductSearch();
    	$data = $projects->where('project_id',$request->input('id'))->get();
    	$pdf = PDF::loadView('welcome_amazon', ['amazon' => $data,'css'=>'stop','i'=>0]);
		return $pdf->download('Product.pdf');
    }

    
    public function exportToCSV(Request $request)
	 {
		Excel::create('Laravel Excel', function($excel) {
	        $excel->sheet('Excel sheet', function($sheet) {
		    	$projects = new ProductSearch();
		    	$request = new Request();
    			$data = $projects->where('project_id',$request->input('id'))->get();
		        $sheet->loadView('csv', ['amazon' => $data,'css'=>'stop','i'=>0]);
		    });

	    })->export('csv');
	 }

	 public function Login(Request $request)
	 {
	 	// $request->session()->get('login')
	
	 	if ($request->session()->get('login')!='success'):
	 		return view('login/login',['css'=>'go']);
	 	else:
	 		return redirect('/welcome');
	 	endif;
	 }

	 public function LogoutUser(Request $request)
	 {
	 	$request->session()->flush();
	 	return redirect('/login');
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
	 	$response = Curl::to("https://api-2445581410012.apicast.io/v5/recommend?apikey=ca3d19b94e0eb24596c36487a053b28d&q=".$domain)
        ->get();
	 	return json_decode($response);
	 	// return $response;
	 }

	 public function findDomain(Request $request)
	 {
	 	$domain = $request->input('domain');
	 	$data = $this->WhoAPi($domain);
	 
	 	return view('domain',['data'=>$data,'css'=>'go']);
	 }

	 public function WhosAPi_new(Request $request)
	 {
	 	$domain = $request->input('domain');
	 	$content =file_get_contents("http://api.bulkwhoisapi.com/whoisAPI.php?domain=$domain&token=7d3f08b98ab9f69ae15060a5b58ef1ee");
	 	$data =  json_decode($content);
	 	return $data->raw_data;
	 }



	 public function PDFDownloadD(Request $request)
	 {
	 	$domain = $request->input('domain'); // keyword search 
    	$data = $this->WhoAPi($domain);
    	$pdf = PDF::loadView('domain_export',['data'=>$data,'css'=>'stop']);
		return $pdf->download('domain.pdf');
	 }

	 public function exportToCSVD(Request $request)
	 {
	 	Excel::create('Laravel Excel', function($excel) {
	        $excel->sheet('Excel sheet', function($sheet) {
		    	$domain = urlencode($_GET['domain']); // keyword search 
		    	$data = $this->WhoAPi($domain);
		        $sheet->loadView('domain_export',['data'=>$data,'css'=>'stop']);
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


	 public function CheckAPI()
	 {
	 	$request = new Request();
	 	$api_key = "txotmiiRkdsi";
	 	$parsehub = new Parsehub($api_key);
		$projectList = $parsehub->getProjectList();
		$array = json_decode($projectList);
		// $project_token = $array->projects[0]->last_ready_run->project_token;
		$run_token = $array->projects[0]->last_run->run_token;
		// $start_url = $array->projects[0]->last_ready_run->start_url;
		// $cancel = $parsehub->cancelProjectRun($run_token);
		echo "<pre>";
		print_r($array);
		

	 }

	 public function CancelProject($i)
	 {
	 	// $project=$request->session()->get('Rundata');
	 	$api_key = "txotmiiRkdsi";
	 	$parsehub = new Parsehub($api_key);
	 	$projectList = $parsehub->getProjectList();
		$array = json_decode($projectList);
		$run_token = $array->projects[0]->last_run->run_token;
	 	$cancel = $parsehub->cancelProjectRun($run_token);
	 	$cancel_data = json_decode($cancel);
	 	
	 }

	 public function getEndTime($i)
	 {
	 	$api_key = "txotmiiRkdsi";
	 	$parsehub = new Parsehub($api_key);
		$projectList = $parsehub->getProjectList();
		$array = json_decode($projectList);
		// echo "<pre>";
		// print_r($array);
		return $array->projects[$i]->last_run->end_time;
	 }

	 public function getLastRundata($a,$id)
	 {
	 	// echo 4;
	 	$api_key = "txotmiiRkdsi";
	 	$total = 0;
	 	$item = array();
		$all_item = array();
	 	$parsehub = new Parsehub($api_key);
		$projectList = $parsehub->getProjectList();
		$array = json_decode($projectList);
		$project_token = $array->projects[$a]->last_ready_run->project_token;
		$run_token = $array->projects[$a]->last_ready_run->run_token;
		$start_url = $array->projects[$a]->last_ready_run->start_url;
		$data = $parsehub->getLastReadyRunData($project_token);
		$array_main = json_decode($data);
		$total = min(array(count($array_main->title),count($array_main->price),count($array_main->img),count($array_main->seller),count($array_main->des)));
		if(!isset($array_main->title))
		{
			$project_token = $array->projects[1]->last_ready_run->project_token;
			$run_token = $array->projects[1]->last_ready_run->run_token;
			$start_url = $array->projects[1]->last_ready_run->start_url;
			$data = $parsehub->getLastReadyRunData($project_token);
			$array_main = json_decode($data);
			$total = min(array(count($array_main->title),count($array_main->price),count($array_main->img),count($array_main->seller),count($array_main->des)));
		}
		// echo 1;
		// $des= "";
		 // foreach($array_main->des[100]->descrip as $key):
			// 	$des.=$key.",";
		 // endforeach;
		 // print_r($des);
		// echo "<pre>";
		$description = "";
		// echo $total;
		// echo "<br>";
		// $i=100;
		// var_dump((array)$array_main->des[100]->descrip);
		for($i=0;$i<$total;$i++)
		{
			echo $i;
			echo "<br>";
			$item['title'] = $array_main->title[$i]->name;
			$item['seller'] = "by ".$array_main->seller[$i]->name;	
			$item['price'] = $array_main->price[$i]->name;
			$item['img'] = $array_main->img[$i]->name;
		 	// $item['des'] = implode(',', $array_main->des[$i]->descrip);
		 	if(!empty($array_main->des[$i]->descrip))
		 	{
		 		$count_d=count($array_main->des[$i]->descrip);
		 	}
		 	else
		 	{
		 		$count_d = 0;
		 	}
			for($j=1;$j<$count_d;$j++)
		 	{
		 		$description.=$array_main->des[$i]->descrip[$j]->name;
		 	}
		 	$product = new ProductSearch();
		 	$product->insert(['image'=>$item['img'],'name'=>$item['title'],'price'=>$item['price'],'seller'=>$item['seller'],'project_id'=>$id,'des'=>$description]);
		 	$description = "";
		 	// echo "<pre>";
		 	// print_r($item);
		}

// $array_main->seller[$i]->name
		return $all_item;
	 }

	 public function initilizeProject($search)
	 {
	 	$api_key = "txotmiiRkdsi";
	 	$parsehub = new Parsehub($api_key);
		$projectList = $parsehub->getProjectList();
		$array = json_decode($projectList);
		$project_token = $array->projects[1]->last_ready_run->project_token;
		$run_token = $array->projects[1]->last_ready_run->run_token;
		$start_url = $array->projects[1]->last_ready_run->start_url;
		// $parsehub = new Parsehub($api_key);

		$options = array(
		    // Skip start_url option if don't want to override starting url configured
		    // on parsehub.
		    'start_url' => "https://www.amazon.co.uk/s/ref=nb_sb_noss_2?url=search-alias%3Daps&field-keywords=$search",
		    // Enter comma separated list of keywords to pass into `start_value_override`
		    'keywords' => 'iphone case, iphone copy',
		    // Set send_email options. Skip to remain this value default.
		    // 'send_email' => 1,
		);
		$run_obj = $parsehub->runProject($project_token, $options);
	 }

	 
	 public function initilizeProjectEbay($search)
	 {

	 	$api_key = "txotmiiRkdsi";
	 	$parsehub = new Parsehub($api_key);
		$projectList = $parsehub->getProjectList();
		$array = json_decode($projectList);
		$project_token = $array->projects[1]->last_ready_run->project_token;
		$run_token = $array->projects[1]->last_ready_run->run_token;
		$start_url = $array->projects[1]->last_ready_run->start_url;
		// $parsehub = new Parsehub($api_key);

		$options = array(
		    // Skip start_url option if don't want to override starting url configured
		    // on parsehub.
		    'start_url' => "https://www.ebay.co.uk/sch/i.html?_from=R40&_nkw=$search&_sacat=0&_fsrp=1&_pgn=1",
		    // Enter comma separated list of keywords to pass into `start_value_override`
		    'keywords' => 'iphone case, iphone copy',
		    // Set send_email options. Skip to remain this value default.
		    // 'send_email' => 1,
		);
		$run_obj = $parsehub->runProject($project_token, $options);
	 }

	 public function amazonSearch($search)
	 {
	 	$api_key = "txotmiiRkdsi";
	 	$parsehub = new Parsehub($api_key);
		$projectList = $parsehub->getProjectList();
		$array = json_decode($projectList);
		$project_token = $array->projects[0]->last_run->project_token;
		$run_token = $array->projects[0]->last_run->run_token;
		$start_url = $array->projects[0]->last_run->start_url;
		// $parsehub = new Parsehub($api_key);

		$options = array(
		    // Skip start_url option if don't want to override starting url configured
		    // on parsehub.
		    'start_url' => "https://www.amazon.co.uk/s/ref=nb_sb_noss_2?url=search-alias%3Daps&field-keywords=$search",
		    // Enter comma separated list of keywords to pass into `start_value_override`
		    'keywords' => 'iphone case, iphone copy',
		    // Set send_email options. Skip to remain this value default.
		    // 'send_email' => 1,
		);
		$run_obj = $parsehub->runProject($project_token, $options);
	 }

	 public function GetProjectDetail()
	 {
	 	$i=0;
	 	$api_key = "txotmiiRkdsi";
	 	$parsehub = new Parsehub($api_key);
		$projectList = $parsehub->getProjectList();
		$array = json_decode($projectList);
		echo "<pre>";
		$project_token = $array->projects[$i]->last_run->project_token;
		$run_token = $array->projects[$i]->last_run->run_token;
		$start_url = $array->projects[$i]->last_run->start_url;
		$data = $parsehub->getLastReadyRunData($project_token);
		$array_main = json_decode($data);
		// echo "<pre>";
		print_r($array_main);

	 }
	 public function getOnGoingProjectPageInfo()
	 {

	 	$api_key = "txotmiiRkdsi";
	 	$parsehub = new Parsehub($api_key);
		$projectList = $parsehub->getProjectList();
		$array = json_decode($projectList);
		
		// // $project_token = $array->projects[$i]->last_run->project_token;
		// // $run_token = $array->projects[$i]->last_run->run_token;
		// // $start_url = $array->projects[$i]->last_run->start_url;
		// // $data = $parsehub->getLastReadyRunData($project_token);
		// // $array_main = json_decode($data);
		// echo "<pre>";
		// print_r($array);
		return $array->projects[0]->last_run->pages + $array->projects[1]->last_run->pages;
	 }




   
}

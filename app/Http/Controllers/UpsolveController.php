<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use GuzzleHttp\Exception\RequestException;

class UpsolveController extends Controller
{
    public function index(Request $request)
    {
    	$solved = collect([""]);
    	$client = new \GuzzleHttp\Client();

	    try {
	            $response = $client->request('GET', 'https://codeforces.com/api/user.status?handle='. auth()->user()->codeforces);

	            $data = json_decode($response->getBody()->getContents(), true);

	            foreach ($data["result"] as $submission) {
	                foreach ($submission as $key => $value) {
                    if($key == "verdict" && $value == "OK"){
	                    foreach ($submission["problem"] as $key => $value) {
	                        if($key == "contestId")
	                        {
	                            $solved->push(strval($value).strval($submission["problem"]["index"]));
	                            break;
	                        }
	                    }
	                }
	            }
	            };

	    } catch (RequestException $e) {
	    	return redirect()->route('dashboard');
	    } 
	    $collectproblems = collect([]);
	    try {
	            $response = $client->request('GET', 'https://codeforces.com/api/user.rating?handle='. auth()->user()->codeforces);

	            $data = json_decode($response->getBody()->getContents(), true);

	           	$contest = $data["result"];

	            for ($i=count($contest) - 1; $i >= 0 ; $i--) {

	            	$contestId = $contest[$i]["contestId"];
	            	$contestName = $contest[$i]["contestName"];

	            	try {
				        $contestDetailsResponse = $client->request('GET', 'https://codeforces.com/api/contest.standings?contestId='.strval($contestId).'&handles='. auth()->user()->codeforces);

				        $contestDetails = json_decode($contestDetailsResponse->getBody()->getContents(), true);

				        $problems = $contestDetails['result']['problems'];
				        $level = 0;

				        for ($j=0; $j < count($problems); $j++) { 
				        	if($contestDetails['result']['rows'][0]['problemResults'][$j]['points'] == 0.0)
				        	{
				        		$level++;
				        		if(!$solved->search(strval($problems[$j]["contestId"]).$problems[$j]["index"]))
					        	{
					        		$problems[$j]["level"] = min($level,3);
					        		$problems[$j]["contest"] = $contestName;
					        		$flag = 1;
					        		foreach ($problems[$j] as $key => $value) {
                                        if($key == "rating")
                                        {
                                        	$flag = 0;
                                    	}
                                    }
                                    if ($flag) {
                                    	$problems[$j]["rating"] = 0;
                                    }
					        		$collectproblems->push($problems[$j]);
					        		if($level > 2)
					        			break;
					        	}
					        }
				        }

				        if($collectproblems->count() >  20)
				        	break;

				    } catch (RequestException $e) {
				    	return redirect()->route('dashboard');
				    } 
	            };

	    } catch (RequestException $e) {
	    	return redirect()->route('dashboard');
	    } 
	    if($request["sortBy"] == "rating")
	    	$collectproblems = $collectproblems->sortBy('rating');
	    return view('upsolve.index' , ['problems' => $collectproblems->toArray() , 'sortBy' => $request["sortBy"]]);
    }

    public function virtual(Request $request)
    {
    	$solved = collect([""]);
    	$virtual_contest = collect([]);
    	$client = new \GuzzleHttp\Client();

	    try {
	            $response = $client->request('GET', 'https://codeforces.com/api/user.status?handle='. auth()->user()->codeforces);

	            $data = json_decode($response->getBody()->getContents(), true);

	            foreach ($data["result"] as $submission) {
	            	$flag = 0;
	            	
	                foreach ($submission as $key => $value) {
                    if($key == "verdict" && $value == "OK"){
	                	
	                    foreach ($submission["problem"] as $key => $value) {
	                        if($key == "contestId")
	                        {
	                            $solved->push(strval($value).strval($submission["problem"]["index"]));
	                            $flag = 1;
	                            break;
	                        }
	                    }
	                }
	            }
	                if($flag && $submission['author']['participantType'] == "VIRTUAL" &&  $submission['contestId'] > 0 &&  $submission['contestId'] < 100000)
	            		$virtual_contest->push($submission['contestId']);
	            };

	    } catch (RequestException $e) {
	    	return redirect()->route('dashboard');
	    } 
	    $virtual_contest = $virtual_contest->unique();
	    $collectproblems = collect([]);

	    foreach ($virtual_contest as $key => $value) {

	    			$contestId = $value;

	            	try {
				        $contestDetailsResponse = $client->request('GET', 'https://codeforces.com/api/contest.standings?contestId='.strval($contestId).'&handles='.auth()->user()->codeforces.'&showUnofficial=true');

				        $contestDetails = json_decode($contestDetailsResponse->getBody()->getContents(), true);

				        $problems = $contestDetails['result']['problems'];
				        $level = 0;

				        for ($j=0; $j < count($problems); $j++) { 
				        	if($contestDetails['result']['rows'][0]['problemResults'][$j]['points'] == 0.0)
				        	{
				        		$level++;
				        		if(!$solved->search(strval($problems[$j]["contestId"]).$problems[$j]["index"]))
					        	{
					        		$problems[$j]["level"] = min($level,3);
					        		$problems[$j]["contest"] = $contestDetails['result']['contest']['name'];
					        		$flag = 1;
					        		foreach ($problems[$j] as $key => $value) {
                                        if($key == "rating")
                                        {
                                        	$flag = 0;
                                    	}
                                    }
                                    if ($flag) {
                                    	$problems[$j]["rating"] = 0;
                                    }
					        		$collectproblems->push($problems[$j]);
					        		if($level > 2)
					        			break;
					        	}
					        }
				        }

				        if($collectproblems->count() >  20)
				        	break;

				    } catch (RequestException $e) {
				    	return redirect()->route('dashboard');
				    } 
	    }
	    if($request["sortBy"] == "rating")
	    	$collectproblems = $collectproblems->sortBy('rating');
	    return view('upsolve.virtual' , ['problems' => $collectproblems->toArray() , 'sortBy' => $request["sortBy"]]);
    }

    public function wrong(Request $request)
    {
    	$notsolved = collect([]);
    	$notsolved2 = collect([""]); // To remove duplicates 
    	$problems = collect([]);
    	$solved = collect([""]);
    	$client = new \GuzzleHttp\Client();

	    try {
	            $response = $client->request('GET', 'https://codeforces.com/api/user.status?handle='. auth()->user()->codeforces);

	            $data = json_decode($response->getBody()->getContents(), true);

	            foreach ($data["result"] as $submission) {
	                foreach ($submission as $key => $value) {
                    if($key == "verdict")
                    { if($value != "OK"){
	                    foreach ($submission["problem"] as $key => $value) {
	                        if($key == "contestId")
	                        {
	                            $problems->push($submission);
	                            break;
	                        }
	                    }
	                }
	                else
	                {
	                	foreach ($submission["problem"] as $key => $value) {
	                        if($key == "contestId")
	                        {
	                            $solved->push(strval($value).strval($submission["problem"]["index"]));
	                            break;
	                        }
	                    }
	                }
	            	}
	            }

	            };

	            for ($j=0; $j < count($problems); $j++) { 
	            	if(!$solved->search(strval($problems[$j]["problem"]["contestId"]).$problems[$j]["problem"]["index"]) && !$notsolved2->search(strval($problems[$j]["problem"]["contestId"]).$problems[$j]["problem"]["index"]))
	            	{
	            		$data = $problems[$j]["problem"]; 
	            		$data["participantType"] = $problems[$j]["author"]["participantType"];
	            		$notsolved->push($data);
	            		$notsolved2->push(strval($problems[$j]["problem"]["contestId"]).$problems[$j]["problem"]["index"]);
	            	}
	            }

	    } catch (RequestException $e) {
	    	return redirect()->route('dashboard');
	    } 
	    
	   	if($request["sortBy"] == "rating")
	    	$notsolved = $notsolved->sortBy('rating');
	    return view('upsolve.wrong' , ['problems' => $notsolved->toArray() , 'sortBy' => $request["sortBy"]]);
    }
}

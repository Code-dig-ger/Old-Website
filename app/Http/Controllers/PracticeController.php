<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\{Generaltopic,Topic,Problem};
use Goutte\Client;
use GuzzleHttp\Exception\RequestException;
use Illuminate\Support\Facades\Auth;

function spojChecker($userId)
{
    $client = new Client();

    $userPage = 'https://www.spoj.com/users/'.$userId;
    $collection = collect([""]);

    try {

    $crawler = $client->request('GET', $userPage);

    

    if(count($crawler->filter('#user-profile-tables')) == 0)
        return $collection;

    $submission = $crawler->filter('#user-profile-tables')->first();

    if(count($submission->filter('h4')) == 0 || $submission->filter('h4')->first()->text() != "List of solved classical problems:")
        return $collection;


    $solved = $submission->filter('table')->first();


    $problems_solved = $solved->filter('td')->each(function ($problem)
        {
            return $problems_solved[] = $problem->text();
        });

    foreach ($problems_solved as $problem) {
        $collection->push(strval($problem));
    }

    return $collection;

    } catch ( \Symfony\Component\HttpClient\Exception\TransportException | \Exception | \Throwable $exception ) {
        $collection = collect([""]);
        return $collection;
    }

}

function spojproblemChecker($userId , $problem_code)
{
    $client = new Client();
    $userPage = 'https://www.spoj.com/status/'.$problem_code.','.$userId; 
    try {
        $crawler = $client->request('GET', $userPage);
        if((count($crawler->filter('.kol1')) > 0)|| (count($crawler->filter('.kol2')) > 0) || (count($crawler->filter('.kol3')) > 0) )
            return 1;
        else
            return 0;
    } catch ( \Symfony\Component\HttpClient\Exception\TransportException | \Exception | \Throwable $exception ) {
        return 0;
    }
}

function codechefChecker($userId)
{
    $client = new Client();
    $userPage = 'https://www.codechef.com/users/'.$userId;
    try {

    $crawler = $client->request('GET', $userPage);
    $section = $crawler->filter('.rating-data-section.problems-solved');
    $solved = $crawler->filter('h5');

    $collection = collect([""]);

    if($solved->text() == "Fully Solved (0)")
    {
        return $collection;
    }

    $solved = $crawler->filter('article')->first();

    $problems_solved = $solved->filter('span')->each(function ($contest) {

        return $problems_solved[] = $contest->filter('a')->each(function ($problem)
        {
            return $problems_solved[] = $problem->text();
        });
    });

    foreach ($problems_solved as $contest) {
        foreach ($contest as $problem) {
            $collection->push(strval($problem));
        }
    }

    return $collection;

    } catch ( \Symfony\Component\HttpClient\Exception\TransportException | \Exception | \Throwable $exception ) {
        $collection = collect([""]);
        return $collection;
    }
}

function codeforcesChecker($userId)
{
    $collection = collect([""]);
    $client = new \GuzzleHttp\Client();

    try {
            $response = $client->request('GET', 'https://codeforces.com/api/user.status?handle='. $userId);

            $data = json_decode($response->getBody()->getContents(), true);

            foreach ($data["result"] as $submission) {
                foreach ($submission as $key => $value) {
                    if($key == "verdict" && $value == "OK"){
                        foreach ($submission["problem"] as $key => $value) {
                            if($key == "contestId")
                            {
                                $collection->push(strval($value).strval($submission["problem"]["index"]));
                                break;
                            }
                        }
                    }
                }
            };

            return $collection;

    } catch (RequestException $e) {
            $collection = collect([""]);
            return $collection;
    } 
}

function uVaChecker($id)
{
    $client = new \GuzzleHttp\Client();

    try {

    $response = $client->request('GET', 'https://uhunt.onlinejudge.org/api/subs-user/'.$id);

    $data = json_decode($response->getBody()->getContents(), true);

    $collection = collect([""]);

    foreach ($data["subs"] as $submission) {
        if($submission[2] == 90)
            $collection->push(strval($submission[1]));
    };
    
    return $collection;

    } catch (RequestException $e) {
            $collection = collect([""]);
            return $collection;
    } 
}

class PracticeController extends Controller
{

    public function topicwise_index()
    {
        $topics = Topic::orderBy('dif' , 'asc' ) -> get();
        return view('practice.topicwise.index' , ['topics' => $topics]);
    }

    public function topicwise_show($id)
    {
        if (!Auth::check())
        {
            $topics_problems = Problem::
            where([['topic_id' , $id],['status' , 'accepted']])->orderBy('dif', 'asc')->paginate(10);

            $topic = Topic::whereid($id)->first();

            return view('practice.topicwise.show', [
                'problems' => $topics_problems , 
                'topic' => $topic
            ]);
        } 

        $user = auth()->user();

        // Check for handles 
        $handles = ["codeforces"];
        $solved_codeforces = codeforcesChecker($user->codeforces);
        $solved_codechef = NULL;
        $solved_uva = NULL;
        $solved_spoj = NULL;

        if($user->codechef){
            $solved_codechef = codechefChecker($user->codechef);
            array_push($handles, "codechef");
        }
        if($user->uva){
            $solved_uva = uVaChecker($user->uvaid);
            array_push($handles, "uva");
        }
        if($user->spoj){
            $solved_spoj = spojChecker($user->spoj);
            array_push($handles, "spoj");
        }
       
        $topics_problems = Problem::
            where([['topic_id' , $id],['status' , 'accepted']])->wherein('platform', $handles)
                ->orderBy('dif', 'asc')->paginate(10);

        $any_problem = Topic::find($id)->problem()->first();

        if(count($topics_problems) == 0 && $any_problem)
            //Problem are there but in different platform
            return view('ladders.topicwise.noproblem' , ['isproblem' => true]);
        else if(count($topics_problems) == 0)
            return view('ladders.topicwise.noproblem' , ['isproblem' => false]);

        $current_solved = collect([0]);

        foreach ($topics_problems as $problem) {

            $isSolved = auth()->user()->problem->find($problem->id);
            if($isSolved == NULL)
            {
                $platform = $problem->platform;
                $code = strval($problem->code);
                $flag = false;

                switch ($platform) {
                  case "codeforces":
                    $flag = $solved_codeforces->search($code);
                    break;
                  case "codechef":
                    $flag = $solved_codechef->search($code);
                    break;
                  case "uva":
                    $flag = $solved_uva->search($code);
                    break;
                  case "spoj":
                    $flag = $solved_spoj->search($code);
                }
                if($platform == "spoj" && !$flag)
                    // Try using different method
                    $flag = spojproblemChecker($user->spoj , $problem->code);

                if($flag)
                {
                    $current_solved->push($problem->id);
                    auth()->user()->problem()->attach($problem->id);
                }
            }
        }

        $topic = Topic::whereid($id)->first();

        return view('practice.topicwise.show', [
            'problems' => $topics_problems , 
            'current' => $current_solved ,
            'topic' => $topic
        ]);
    }
  /////////////////////////////////////////////////////////////////////////////////////////////////////  
    /////////////////////////////////////////////////////////////////////////////////////////////////////
      /////////////////////////////////////////////////////////////////////////////////////////////////////
    public function general_index()
    {
        $topics = Generaltopic::orderBy('dif' , 'asc' ) -> get();
        return view('practice.general.index' , ['topics' => $topics]);
    }

    public function general_show($id)
    {
        if (!Auth::check())
        {
            $topics_problems = Problem::
            where([['generaltopic_id' , $id],['status' , 'accepted']])->orderBy('dif', 'asc')->paginate(10);
            
            $level = Generaltopic::whereid($id)->first(); 

            return view('practice.general.show', [
                'problems' => $topics_problems , 
                'level' => $level
            ]);
        } 

        $user = auth()->user();

        // Check for handles 
        $handles = ["codeforces"];
        $solved_codeforces = codeforcesChecker($user->codeforces);
        $solved_codechef = NULL;
        $solved_uva = NULL;
        $solved_spoj = NULL;

        if($user->codechef){
            $solved_codechef = codechefChecker($user->codechef);
            array_push($handles, "codechef");
        }
        if($user->uva){
            $solved_uva = uVaChecker($user->uvaid);
            array_push($handles, "uva");
        }
        if($user->spoj){
            $solved_spoj = spojChecker($user->spoj);
            array_push($handles, "spoj");
        }
       
        $topics_problems = Problem::
            where([['generaltopic_id' , $id],['status' , 'accepted']])->wherein('platform', $handles)
                ->orderBy('dif', 'asc')->paginate(10);

        $any_problem = Generaltopic::find($id)->problem()->first();

        if(count($topics_problems) == 0 && $any_problem)
            //Problem are there but in different platform
            return view('ladders.topicwise.noproblem' , ['isproblem' => true]);
        else if(count($topics_problems) == 0)
            return view('ladders.topicwise.noproblem' , ['isproblem' => false]);

        $current_solved = collect([0]);

        foreach ($topics_problems as $problem) {

            $isSolved = auth()->user()->problem->find($problem->id);
            if($isSolved == NULL)
            {
                $platform = $problem->platform;
                $code = strval($problem->code);
                $flag = false;

                switch ($platform) {
                  case "codeforces":
                    $flag = $solved_codeforces->search($code);
                    break;
                  case "codechef":
                    $flag = $solved_codechef->search($code);
                    break;
                  case "uva":
                    $flag = $solved_uva->search($code);
                    break;
                  case "spoj":
                    $flag = $solved_spoj->search($code);
                }
                if($platform == "spoj" && !$flag)
                    // Try using different method
                    $flag = spojproblemChecker($user->spoj , $problem->code);

                if($flag)
                {
                    $current_solved->push($problem->id);
                    auth()->user()->problem()->attach($problem->id);
                }
            }
        }

        $level = Generaltopic::whereid($id)->first(); 

        return view('practice.general.show', [
            'problems' => $topics_problems , 
            'current' => $current_solved ,
            'level' => $level
        ]);
    }
}

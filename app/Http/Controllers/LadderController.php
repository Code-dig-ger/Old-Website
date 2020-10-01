<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\{Generaltopic,Topic,Problem};
use Goutte\Client;
use GuzzleHttp\Exception\RequestException;

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

class LadderController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function topicwise_index()
    {
        $topics = Topic::orderBy('dif' , 'asc' ) -> get();
        return view('ladders.topicwise.index' , ['topics' => $topics]);
    }

    public function topicwise_show($id)
    {
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
                ->orderBy('dif', 'asc')->get();

        $any_problem = Topic::whereid($id)->first()->problem()->first();

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

                if($flag)
                {
                    $current_solved->push($problem->id);
                    auth()->user()->problem()->attach($problem->id);
                }
            }
        }

        // For start to Continue
        if (!auth()->user()->topic->contains($id))
            auth()->user()->topic()->attach($id , ['problem_id' => $topics_problems[0]->id]);

        $cur_ind = 0;

        $total_problems = count($topics_problems);

        $current_problem = $topics_problems[0]->id;

        $isSolved = (auth()->user()->problem->find($current_problem)!=NULL | $current_solved->search($current_problem));

        $cur_prob = Problem::find($current_problem);

        if(!$isSolved && $cur_prob->platform == "spoj")
        {
            $isSolved = spojproblemChecker($user->spoj , $cur_prob->code);
            if($isSolved)
                auth()->user()->problem()->attach($cur_prob->id);
        }

        while($isSolved)
        {
            $cur_ind += 1;

            if($cur_ind == $total_problems)
                break;

            $current_problem = $topics_problems[$cur_ind]->id;

            $isSolved = (auth()->user()->problem->find($current_problem)!=NULL | $current_solved->search($current_problem)); 

            $cur_prob = Problem::find($current_problem);

            if(!$isSolved && $cur_prob->platform == "spoj")
            {                
                $isSolved = spojproblemChecker($user->spoj , $cur_prob->code);
                if($isSolved)
                    auth()->user()->problem()->attach($cur_prob->id);
            }
        }
        $topic = Topic::whereid($id)->first();

        if($cur_ind == $total_problems)
        {
            //Solved complete ladder 
            auth()->user()->topic()->detach($id);
            return view('ladders.topicwise.solved' , ['solved_problems' => $topics_problems
                , 'topic' => $topic ]);
        }

        $current_problem = $topics_problems[$cur_ind]->id;

        $problem = Problem::find($current_problem);   

        return view('ladders.topicwise.show', [
            'solved_problems' => $topics_problems , 
            'cur_ind' => $cur_ind,
            'problem' => $problem,
            'topic' => $topic
        ]);
    }
  /////////////////////////////////////////////////////////////////////////////////////////////////////  
    /////////////////////////////////////////////////////////////////////////////////////////////////////
      /////////////////////////////////////////////////////////////////////////////////////////////////////
    public function general_index()
    {
        $topics = Generaltopic::orderBy('dif' , 'asc' ) -> get();
        return view('ladders.general.index' , ['topics' => $topics]);
    }

    public function general_show($id)
    {
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
                ->orderBy('dif', 'asc')->get();

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

                if($flag)
                {
                    $current_solved->push($problem->id);
                    auth()->user()->problem()->attach($problem->id);
                }
            }
        }

        // For start to Continue
        if (!auth()->user()->generaltopic->contains($id))
            auth()->user()->generaltopic()->attach($id , ['problem_id' => $topics_problems[0]->id]);

        $cur_ind = 0;

        $total_problems = count($topics_problems);

        $current_problem = $topics_problems[0]->id;

        $isSolved = (auth()->user()->problem->find($current_problem)!=NULL | $current_solved->search($current_problem));

        $cur_prob = Problem::find($current_problem);

        if(!$isSolved && $cur_prob->platform == "spoj")
        {
            $isSolved = spojproblemChecker($user->spoj , $cur_prob->code);
            if($isSolved)
                auth()->user()->problem()->attach($cur_prob->id);
        }


        while($isSolved)
        {
            $cur_ind += 1;

            if($cur_ind == $total_problems)
                break;

            $current_problem = $topics_problems[$cur_ind]->id;

            $isSolved = (auth()->user()->problem->find($current_problem)!=NULL | $current_solved->search($current_problem));

            $cur_prob = Problem::find($current_problem);

            if(!$isSolved && $cur_prob->platform == "spoj")
            {
                $isSolved = spojproblemChecker($user->spoj , $cur_prob->code);
                if($isSolved)
                    auth()->user()->problem()->attach($cur_prob->id);
            }
        }

        if($cur_ind == $total_problems)
        {
            auth()->user()->generaltopic()->detach($id);
            //Solved complete ladder 
            return view('ladders.general.solved' , ['solved_problems' => $topics_problems]);
        }

        $current_problem = $topics_problems[$cur_ind]->id;

        $problem = Problem::find($current_problem);   

        $level = Generaltopic::whereid($id)->first(); 

        return view('ladders.general.show', [
            'solved_problems' => $topics_problems , 
            'cur_ind' => $cur_ind,
            'problem' => $problem,
            'level' => $level
        ]);
    }
}

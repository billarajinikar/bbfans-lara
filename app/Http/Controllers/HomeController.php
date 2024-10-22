<?php
namespace App\Http\Controllers;
use Illuminate\Http\Request; 
use App\Models\Poll;
use App\Models\Contestant;

class HomeController extends Controller
{
    public function index(Request $request)
    {
        $seasson = 8;
        $pollController = new PollController();
        $contestantController = new ContestantController();
        $voteController = new VoteController();
        $activePoll = $pollController->getActivePoll();
        $contestants = $contestantController->getContestantsBySeasson($seasson);
        if ($activePoll) {
            $pollId = $activePoll->id; 
            $poll = Poll::with('contestants')->findOrFail($pollId);
            $userIP = $request->ip();
            $hasVoted = $voteController->hasVoted($userIP, $pollId);
            
            $results = $pollController->getPollResults($poll); 
        } else {
            $pollId = null;
            $hasVoted = true;
            $results = null;
        }
        return view('home', compact('activePoll', 'contestants', 'hasVoted', 'results'));
    }
}

<?php
namespace App\Http\Controllers;
use Illuminate\Http\Request; 
use App\Models\Poll;
use App\Models\Contestant;
use Carbon\Carbon;

class HomeController extends Controller
{
    public function index(Request $request)
    {
        $now = Carbon::now();
        // Fetch the active poll (where the current time is between start_at and end_at)
        $activePoll = Poll::with('contestants')
            ->where('start_at', '<=', $now)
            ->where('end_at', '>=', $now)
            ->first();
        
        $contestants = Contestant::get();
        if ($activePoll) {
            $pollId = $activePoll->id; 
            $poll = Poll::with('contestants')->findOrFail($pollId);
            $userIP = $request->ip();
            $voteController = new VoteController();
            $hasVoted = $voteController->hasVoted($userIP, $pollId);
            $pollController = new PollController();
            $results = $pollController->getPollResults($poll); 
        } else {
            $pollId = null;
            $hasVoted = true;
            $results = null;
        }
        return view('home', compact('activePoll', 'contestants', 'hasVoted', 'results'));
    }
}

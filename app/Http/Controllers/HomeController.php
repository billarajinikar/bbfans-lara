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
        // Get the current date and time
        $now = Carbon::now();

        // Fetch the active poll (where the current time is between start_at and end_at)
        $activePoll = Poll::with('contestants')
            ->where('start_at', '<=', $now)
            ->where('end_at', '>=', $now)
            ->first();
        
        $contestants = Contestant::get();
        $poll = Poll::with('contestants')->findOrFail($id=1);
        $userIP = $request->ip();
        $pollController = new PollController();
        $results = $pollController->getPollResults($poll);
        $hasVoted = true; //session()->has('voted_poll_'.$poll->id);

        return view('home', compact('activePoll', 'contestants', 'hasVoted', 'results'));
    }
}

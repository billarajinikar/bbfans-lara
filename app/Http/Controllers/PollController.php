<?php
namespace App\Http\Controllers;

use App\Models\Poll;  // This allows you to use the Poll model
use Illuminate\Http\Request;
use Carbon\Carbon;

class PollController extends Controller
{
    public function index()
    {
        // Retrieve all polls
        $polls = Poll::all();

        return view('polls.index', compact('polls'));
    }

    public function create()
    {
        // Display the form for creating a new poll
        return view('polls.create');
    }

    public function store(Request $request)
    {
        // Validate the request data
        $validated = $request->validate([
            'title' => 'required|string|max:255',
            'start_at' => 'required|date',
            'end_at' => 'required|date|after:start_at',
        ]);

        // Create a new poll
        $poll = Poll::create($validated);

        return redirect()->route('polls.index')->with('success', 'Poll created successfully');
    }
    public static function getPollResults(Poll $poll)
    {
        $contestants = $poll->contestants->map(function ($contestant) use ($poll) {
            $votesCount = $contestant->votesForPoll($poll->id)->count();
            return [
                'contestant' => $contestant,
                'votes_count' => $votesCount
            ];
        });
    
        // Calculate the total votes for the poll
        $totalVotes = $contestants->sum('votes_count');
        
        // Map the results and calculate percentages
        $results = $contestants->map(function ($contestantData) use ($totalVotes) {
            $contestant = $contestantData['contestant'];
            $votesCount = $contestantData['votes_count'];
            $percentage = $totalVotes > 0 ? ($votesCount / $totalVotes) * 100 : 0;
            
            return [
                'name' => $contestant->name,
                'votes' => $votesCount,
                'percentage' => round($percentage, 2),
            ];
        });
    
        return $results->sortByDesc('percentage')->values()->all();
    }

    public static function getActivePoll() {
        $now = Carbon::now();
        $activePoll = Poll::with('contestants')
            ->where('start_at', '<=', $now)
            ->where('end_at', '>=', $now)
            ->first();
        return $activePoll;
    }
}

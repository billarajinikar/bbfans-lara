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
        $contestants = $poll->contestants()->withCount('votes')->get();
        $totalVotes = $contestants->sum('votes_count');

        $results = $contestants->map(function ($contestant) use ($totalVotes) {
            $percentage = $totalVotes > 0 ? ($contestant->votes_count / $totalVotes) * 100 : 0;
            return [
                'name' => $contestant->name,
                'votes' => $contestant->votes_count,
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

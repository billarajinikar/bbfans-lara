<?php
namespace App\Http\Controllers;

use App\Models\Poll;  // This allows you to use the Poll model
use Illuminate\Http\Request;

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
        $results = $poll->contestants()
            ->withCount('votes')
            ->get()
            ->map(function ($contestant) {
                return [
                    'name' => $contestant->name,
                    'votes' => $contestant->votes_count,
                ];
            });

        return $results;
    }
}

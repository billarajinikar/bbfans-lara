<?php
namespace App\Http\Controllers;

use App\Models\Contestant;
use Illuminate\Http\Request;

class ContestantController extends Controller
{
    public function index()
    {
        $seasson = 8;
        $contestants = Contestant::where('seasson', $seasson)->get();
        return view('home', compact('contestants'));
    }

    public function show($id)
    {
        $contestant = Contestant::with('media')->findOrFail($id);
        return view('contestant.show', compact('contestant'));
    }
    public static function getContestantsBySeasson($seasson) {
        $contestants = Contestant::where('seasson', $seasson)->get();
        return $contestants;
    }
}

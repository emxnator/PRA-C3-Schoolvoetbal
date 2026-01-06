<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\MatchModel;


class MatchController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
       $matches = MatchModel::all();
        
        return view('matches.index', compact('matches'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $teams = \App\Models\Team::all();
        $tournaments = \App\Models\Tournament::where('archived', 0)->get();
        $referees = \App\Models\Team::distinct('referee')->pluck('referee')->filter()->sort();
        return view('matches.create_match', compact('teams', 'tournaments', 'referees'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validatedData = $request->validate([
        'team_1_id' => 'required|exists:teams,id',
        'team_2_id' => 'required|exists:teams,id|different:team_1_id',
        'tournament_id' => 'required|exists:tournaments,id',
        'team_1_score' => 'nullable|integer',
        'team_2_score' => 'nullable|integer',
        'field'        => 'required|integer',
        'referee'      => 'required|string|max:255',
        'start_time'   => 'required|date_format:H:i',
        'type'         => 'required|string|max:255'
        ]);

        MatchModel::create($validatedData);

        return redirect()->route('matches.index')->with('success', 'Match created successfully.');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $match = MatchModel::findOrFail($id);
        return view('show_match', compact('match'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, MatchModel $match)
    {
        $validated = $request->validate([
            'winner_id' => 'required|integer',
        ]);

        $winnerId = $validated['winner_id'];
        
        // Set scores based on winner (winner gets 1, loser gets 0)
        if ($winnerId == $match->team_1_id) {
            $match->update([
                'team_1_score' => 1,
                'team_2_score' => 0,
            ]);
        } elseif ($winnerId == $match->team_2_id) {
            $match->update([
                'team_1_score' => 0,
                'team_2_score' => 1,
            ]);
        }

        return redirect()->back()->with('success', 'Winnaar succesvol geselecteerd.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        MatchModel::findOrFail($id)->delete();
        return redirect()->route('matches.index');
    }


    
}

<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Tournament;

class TournamentController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $tournaments = Tournament::where('archived', false)
            ->orderBy('datum', 'asc')
            ->get();
        
        return view('tournaments.index', compact('tournaments'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('tournaments.create_tournament');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'name' => 'required|string|max:255',
            'datum' => 'required|date',
            'fields_amount' => 'required|integer|min:1',
            'game_length_minutes' => 'required|integer|min:1',
            'amount_teams_pool' => 'required|integer|min:1',
        ]);

        $validatedData['archived'] = false;

        Tournament::create($validatedData);

        return redirect()->route('tournaments.index')->with('success', 'Tournament created successfully.');
    }

    /**
     * Display the specified resource.
     */
    public function show(Tournament $tournament)
    {
        // Auto-seed logic if not enough teams/pools
        if ($tournament->pools->count() < 2) {
            // Create Pools
            if ($tournament->pools->count() == 0) {
                $poolA = $tournament->pools()->create(['name' => 'Pool A']);
                $poolB = $tournament->pools()->create(['name' => 'Pool B']);
            } else {
                $poolA = $tournament->pools->first();
                $poolB = $tournament->pools()->create(['name' => 'Pool B']);
            }
            
            // Create Teams
            // Ensure at least 4 teams per pool for quarterfinals
            $this->ensureTeamsInPool($poolA, 4);
            $this->ensureTeamsInPool($poolB, 4);

            // Create Matches for Pools
            $this->createPoolMatches($poolA);
            $this->createPoolMatches($poolB);
        }

        // Generate Playoffs if not exists
        $playoffMatches = $tournament->matches()->where('type', 'playoff')->get();
        if ($playoffMatches->isEmpty()) {
            // Simulate scores for pool matches to allow playoff generation
            foreach ($tournament->matches()->where('type', '!=', 'playoff')->get() as $match) {
                if (is_null($match->team_1_score)) {
                    $match->update([
                        'team_1_score' => rand(0, 5),
                        'team_2_score' => rand(0, 5),
                    ]);
                }
            }
            
            $tournament->generatePlayoffs();
            $playoffMatches = $tournament->matches()->where('type', 'playoff')->get();
        }

        return view('tournaments.show', compact('tournament', 'playoffMatches'));
    }

    private function ensureTeamsInPool($pool, $count)
    {
        $currentCount = $pool->teams()->count();
        for ($i = $currentCount; $i < $count; $i++) {
            $pool->teams()->create([
                'name' => $pool->name . ' Team ' . ($i + 1),
                'school_id' => 1, // Assuming school with ID 1 exists, or create one if needed. 
                // Ideally we should check for schools.
            ]);
        }
    }

    private function createPoolMatches($pool)
    {
        $teams = $pool->teams;
        // Simple round robin
        foreach ($teams as $i => $team1) {
            foreach ($teams as $j => $team2) {
                if ($i < $j) {
                    \App\Models\MatchModel::create([
                        'tournament_id' => $pool->tournament_id,
                        'pool_id' => $pool->id,
                        'team_1_id' => $team1->id,
                        'team_2_id' => $team2->id,
                        'field' => 1,
                        'referee' => 'Auto',
                        'start_time' => now(),
                        'type' => 'pool',
                    ]);
                }
            }
        }
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
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $tournament = Tournament::findOrFail($id);
        $tournament->delete();

        return redirect()->route('tournaments.index')->with('success', 'Tournament deleted successfully.');
    }

    /**
     * Archive the tournament.
     */
    public function archive(Tournament $tournament)
    {
        $tournament->update(['archived' => true]);
        
        return redirect()->route('toernooien')
            ->with('success', 'Toernooi succesvol gearchiveerd.');
    }

    /**
     * Display archived tournaments.
     */
    public function archiveIndex()
    {
        $tournaments = Tournament::where('archived', true)
            ->orderBy('datum', 'desc')
            ->get();
        
        return view('tournaments.archive', compact('tournaments'));
    }
}

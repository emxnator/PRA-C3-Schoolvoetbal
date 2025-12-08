<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Tournament;
use App\Models\School;
use App\Models\Team;

class HomeController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $upcomingTournaments = Tournament::where('archived', false)
            ->where('datum', '>=', now())
            ->orderBy('datum', 'asc')
            ->take(3)
            ->get();
        
        $totalSchools = School::count();
        $totalTeams = Team::count();
        $totalTournaments = Tournament::where('archived', false)->count();
        
        return view('pages.home', compact('upcomingTournaments', 'totalSchools', 'totalTeams', 'totalTournaments'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
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
        //
    }
}

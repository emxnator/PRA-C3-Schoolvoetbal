<x-base-layout>


    <form class="form" action="{{ route('matches.store') }}" method="POST">
        @csrf
        <h1 class="form-title">Maak hier een Wedstrijd aan!</h1>


        <label class="form-label" for="tournament_id">Toernooi:</label>
        <select class="form-input" id="tournament_id" name="tournament_id" required>
            <option value="">Selecteer Toernooi</option>
            @foreach($tournaments as $tournament)
            <option value="{{ $tournament->id }}">{{ $tournament->name }}</option>
            @endforeach
        </select>

        <label class="form-label" for="team_1_id">Team 1:</label>
        <select class="form-input" id="team_1_id" name="team_1_id" required>
            <option value="">Selecteer Team 1</option>
            @foreach($teams as $team)
            <option value="{{ $team->id }}">{{ $team->name }}</option>
            @endforeach
        </select>

        <label class="form-label" for="team_2_id">Team 2:</label>
        <select class="form-input" id="team_2_id" name="team_2_id" required>
            <option value="">Selecteer Team 2</option>
            @foreach($teams as $team)
            <option value="{{ $team->id }}">{{ $team->name }}</option>
            @endforeach
        </select>
        <label class="form-label" for="field">Field:</label>
        <input class="form-input" type="number" id="field" name="field" required>

        <label class="form-label" for="referee">Scheidsrechter:</label>
        <select class="form-input" id="referee" name="referee" required>
            <option value="">Selecteer Scheidsrechter</option>
            @foreach($referees as $referee)
                <option value="{{ $referee }}">{{ $referee }}</option>
            @endforeach
        </select>

        <label class="form-label" for="type">Type:</label>
        <input class="form-input" type="text" id="type" name="type" required>


        <label class="form-label" for="start_time">Start Time:</label>
        <input class="form-input" type="time" id="start_time" name="start_time" required>


        <input class="submit-btn" type="submit" value="Submit">
    </form>
</x-base-layout>
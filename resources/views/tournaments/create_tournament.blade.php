<x-base-layout>

    <form class="form" action="{{ route('tournaments.store') }}" method="POST">
        @csrf
        <h1 class="form-title">Maak hier een Toernooi aan!</h1>

        <label class="form-label" for="name">Naam:</label>
        <input class="form-input" type="text" id="name" name="name" required>

        <label class="form-label" for="datum">Datum:</label>
        <input class="form-input" type="date" id="datum" name="datum" required>

        <label class="form-label" for="fields_amount">Aantal Velden:</label>
        <input class="form-input" type="number" id="fields_amount" name="fields_amount" min="1" required>

        <label class="form-label" for="game_length_minutes">Wedstrijdduur (minuten):</label>
        <input class="form-input" type="number" id="game_length_minutes" name="game_length_minutes" min="1" required>

        <label class="form-label" for="amount_teams_pool">Teams per Poule:</label>
        <input class="form-input" type="number" id="amount_teams_pool" name="amount_teams_pool" min="1" required>

        <input class="submit-btn" type="submit" value="Submit">
    </form>
</x-base-layout>

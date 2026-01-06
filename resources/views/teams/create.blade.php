<x-base-layout>
    

    <form class="form" action="{{route('teams.store')}}" method="POST">
        @csrf
        <h1 class="form-title">Maak hier een team aan!</h1>
        <label class="form-label" for="name">Team Naam:</label>
        <input class="form-input" type="text" id="name" name="name" required>

        <label class="form-label" for="referee">Scheidsrechter Naam:</label>
        <input class="form-input" type="text" id="referee" name="referee" required>

        <label class="form-label" for="school_id">School:</label>
        <select class="form-input" id="school_id" name="school_id" required>
            <option value="">Selecteer School</option>
            @foreach($schools as $school)
                <option value="{{ $school->id }}">{{ $school->name }}</option>
            @endforeach
        </select>

        <label class="form-label" for="pool_id">Pool:</label>
        <select class="form-input" id="pool_id" name="pool_id" required>
            <option value="">Selecteer Pool</option>
            @foreach($pools as $pool)
                <option value="{{ $pool->id }}">{{ $pool->name }}</option>
            @endforeach
        </select>

        <input class="submit-btn" type="submit" value="Submit">
    </form>
</x-baselayout>

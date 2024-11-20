<div class="container">
    <h1>CV Analysis for {{ $student->cv->name }}</h1>

    <h2>Matching Skills</h2>
    @if(!empty($matchingSkills))
        <ul>
            @foreach($matchingSkills as $skill)
                <li>{{ $skill }}</li>
            @endforeach
        </ul>
        <p>Matching Skills Score: <strong>{{ $score }} / 100</strong></p>
    @else
        <p>No matching skills found.</p>
        <p>Matching Skills Score: <strong>0 / 100</strong></p>
    @endif

    <div class="d-flex gap-2 justify-content-center mt-3">
        <!-- Additional actions/buttons can go here -->
    </div>
</div>

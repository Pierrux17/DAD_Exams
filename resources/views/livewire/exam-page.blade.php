<div>
    @if($exam)
        <h1>Examen ID: {{ $exam->id }}</h1>
        <p><strong>Nom du participant :</strong> {{ $exam->user->name }}</p>
        <p><strong>Date :</strong> {{ $exam->exam_date }}</p>
        <p><strong>Lieu de l'examen :</strong> {{ $exam->place }}</p>
        <p><strong>Topic :</strong> {{ $exam->topic->name }}</p>

        <h2>Questions :</h2>
        <ul>
            @foreach($questions as $question)
                <li>{{ $question->text }}</li>
            @endforeach
        </ul>
    @else
        <p>Examen introuvable.</p>
    @endif
</div>

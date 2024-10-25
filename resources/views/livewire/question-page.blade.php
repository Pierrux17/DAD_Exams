<div>
    @if($exam)
        <h1>Examen ID: {{ $exam->id }}</h1>
        <p><strong>Nom du participant :</strong> {{ $exam->user->name }}</p>
        <p><strong>Date :</strong> {{ $exam->exam_date }}</p>
        <p><strong>Lieu de l'examen :</strong> {{ $exam->place }}</p>
        <p><strong>Topic :</strong> {{ $exam->topic->name }}</p>

        <h2>Questions :</h2>
        
        <form wire:submit.prevent="submitResponses">
            <ul>
                @foreach($responses as $index => $response)
                    <li>
                        <p>{{ $response->question->text }}</p>
                        <label>
                            <input type="radio" name="user_response_{{ $index }}" wire:model="userAnswers.{{ $index }}" value="1"> Oui
                        </label>
                        <label>
                            <input type="radio" name="user_response_{{ $index }}" wire:model="userAnswers.{{ $index }}" value="0"> Non
                        </label>
                    </li>
                @endforeach
            </ul>
            <button type="submit">Soumettre les réponses</button>

            @if(session()->has('message'))
                <p>{{ session('message') }}</p>
            @endif
        </form>
    @else
        <p>Examen introuvable</p>
    @endif
</div>

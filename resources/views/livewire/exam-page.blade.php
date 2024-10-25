<div>
    @if($exam)
        <h1>Examen ID: {{ $exam->id }}</h1>
        <p><strong>Nom du participant :</strong> {{ $exam->user->name }}</p>
        <p><strong>Date :</strong> {{ $exam->exam_date }}</p>
        <p><strong>Lieu de l'examen :</strong> {{ $exam->place }}</p>
        <p><strong>Topic :</strong> {{ $exam->topic->name }}</p>

        @if($exam->status == 'En attente')
            <form wire:submit.prevent="submit">
                <button type="submit">Commencer l'examen</button>
            </form>
        @else
            <p>Examen terminé</p>

            <!-- Afficher les résultats de l'examen -->
            <p><strong>Result :</strong> {{ $exam->result }} %</p>
            <p><strong>Statut :</strong> {{ $exam->status }}</p>
        @endif
    @else
        <p>Examen introuvable</p>
    @endif
</div>
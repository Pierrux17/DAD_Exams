<div>
    <h1 class="text-0.5xl text-center text-blue-500 font-bold mb-6">Examen ID: {{ $exam->id }}</h1>
    <p class="text-gray-700 mb-4"><strong>Nom du participant :</strong> {{ $exam->user->name }}</p>
    <p class="text-gray-700 mb-4"><strong>Date :</strong> {{ $exam->exam_date }}</p>
    <p class="text-gray-700 mb-4"><strong>Lieu de l'examen :</strong> {{ $exam->place }}</p>
    <p class="text-gray-700 mb-6"><strong>Topic :</strong> {{ $exam->topic->name }}</p>
</div>

@extends ("layouts.admin")

@section('content')
    <div class="container">
        <!-- Intestazione della pagina con il titolo del progetto e link per tornare alla lista dei progetti -->
        <div class="div mt-3 d-flex justify-content-between align-items-center">
            <h2 class="m-0 fw-bold text-primary">Titolo Progetto</h2>
            <a class="text-decoration-underline" href="{{ route('admin.projects.index') }}">Torna alla lista</a>
        </div>
        <!-- Visualizzazione del titolo del progetto -->
        <h1>{{ $project->title }}</h1>
        <hr>
        <!-- Sezione per la descrizione del progetto -->
        <h2 class="fw-bold text-primary mt-3">Descrizione Progetto</h2>
        <p class="fs-2">{{ $project->description }}</p>
        <hr>
        <!-- Sezione con informazioni aggiuntive: linguaggio/framework e campo di lavoro -->
        <div class="d-flex gap-5">
            <div>
                <h4 class="fw-bold text-primary mt-3">Campo</h4>
                <p>{{ $project->type?->field }}</p>
                <h4 class="fw-bold text-primary mt-3">Linguaggio/Framework</h4>
                <p>{{ $project->type?->name }}</p>
            </div>
            <div>
                <h4 class="fw-bold text-primary mt-3">Tecnologia Utilizzata</h4>
                @forelse ($project->technologies as $technology)
                    <!-- Lista delle tecnologie utilizzate nel progetto -->
                    <p>{{ $technology->name }}</p>
                @empty
                    <!-- Messaggio di fallback nel caso non ci siano tecnologie associate -->
                    <p>Nessuna tecnologia indicata</p>
                @endforelse
            </div>
        </div>
        <!-- Visualizzazione dello slug del progetto -->
        <h6 class="fw-bold text-primary mt-3">Slug ID</h6>
        <p>{{ $project->slug }}</p>
    </div>
@endsection

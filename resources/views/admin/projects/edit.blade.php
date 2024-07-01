@extends('layouts.admin')

@section('content')
    <div class="container">
        <h1 class="mt-2">Modifica Progetto</h1>
        <div class="d-flex justify-content-between">
            <p>Modifica il form per aggiornare un progetto della tua lista.</p>
            <a href="{{ route('admin.projects.index') }}" class="text-danger">Annulla</a>
        </div>

        <!-- Mostra gli errori di validazione, se presenti -->
        @if ($errors->any())
            <div class="alert alert-danger">
                <ul class="errors-style">
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <!-- Form per aggiornare il progetto esistente -->
        <form action="{{ route('admin.projects.update', ['project' => $project]) }}" method="POST">
            @method('PUT')
            @csrf
            <div class="mb-3">
                <!-- Campo per il titolo del progetto -->
                <label for="titolo" class="form-label">Titolo</label>
                <input type="text" class="form-control" id="titolo" aria-describedby="titolo" name="title"
                    value="{{ old('title', $project->title) }}">

                <!-- Campo per la descrizione del progetto -->
                <label for="descrizione" class="form-label">Descrizione</label>
                <textarea type="text-area" class="form-control" id="descrizione" aria-describedby="description" name="description">{{ old('description', $project->description) }}</textarea>

                <!-- Dropdown per selezionare il linguaggio del progetto -->
                <label class="mt-1 mb-2" for="type">Seleziona un linguaggio</label>
                <br>
                <select class="fs-6 p-1" name="type_id" id="type">
                    <option disabled="disabled" selected="selected">Seleziona un campo</option>
                    @foreach ($types as $type)
                        <option @selected(old('type_id', $project->type?->id) == $type->id ? 'selected' : '') value="{{ $type->id }}">{{ $type->name }}</option>
                    @endforeach
                </select>

                <!-- Checkbox per selezionare le tecnologie utilizzate nel progetto -->
                <div class="d-flex flex-column">
                    <span class="mt-1 mb-2">Seleziona una tecnologia</span>
                    <div class="btn-group" role="group" aria-label="Basic checkbox toggle button group">
                        @foreach ($technologies as $technology)
                            <input @checked($project->technologies->contains($technology)) type="checkbox" class="btn-check"
                                id="technology-{{ $technology->id }}" value="{{ $technology->id }}" name="technologies[]">
                            <label class="btn btn-outline-primary"
                                for="technology-{{ $technology->id }}">{{ $technology->name }}</label>
                        @endforeach
                    </div>
                </div>
            </div>
            <button type="submit" class="btn btn-primary">Invia</button>
        </form>
    </div>
@endsection

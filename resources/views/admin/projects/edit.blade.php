@extends('layouts.admin') 

@section('content')
    <div class="container">
        <!-- Intestazione della pagina con titolo -->
        <h1 class="mt-2">Modifica Progetto</h1>
        <!-- Link per annullare e tornare alla lista dei progetti -->
        <div class="d-flex justify-content-between">
            <p>Modifica il form per aggiornare un progetto della tua lista.</p>
            <a href="{{ route("admin.projects.index") }}" class="text-danger">Annulla</a>
        </div>

        <!-- Se ci sono errori di validazione, mostrarli qui -->
        @if ($errors->any())
            <div class="alert alert-danger">
                <ul class="errors-style">
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <!-- Form per modificare un progetto esistente -->
        <form action="{{ route("admin.projects.update", ["project" => $project]) }}" method="POST">
            @method("PUT") <!-- Metodo HTTP PUT per l'aggiornamento -->
            @csrf <!-- Token CSRF per la sicurezza del form -->
            <div class="mb-3">
                <!-- Campo per il titolo del progetto -->
                <label for="titolo" class="form-label">Titolo</label>
                <input type="text" class="form-control" id="titolo" aria-describedby="titolo" name="title" value="{{ old('title', $project->title) }}">

                <!-- Campo per la descrizione del progetto -->
                <label for="descrizione" class="form-label">Descrizione</label>
                <textarea type="text-area" class="form-control" id="descrizione" aria-describedby="description" name="description">{{ old('description', $project->description) }}</textarea>    

                <!-- Dropdown per selezionare il linguaggio di programmazione del progetto -->
                <label class="mt-1 mb-2" for="type">Seleziona un linguaggio</label>
                <br>
                <select class="fs-6 p-1" name="type_id" id="type">
                    <option disabled="disabled" selected="selected">Seleziona un linguaggio</option>
                    @foreach ($types as $type)
                        <option @selected(old("type_id") == $type->id ? "selected" : "") value="{{$type->id}}">{{ $type->name }}</option>
                    @endforeach
                </select>
            </div>
            <!-- Pulsante per inviare il form -->
            <button type="submit" class="btn btn-primary">Invia</button>
        </form>
    </div>
@endsection

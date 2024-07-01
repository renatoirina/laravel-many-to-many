@extends('layouts.admin')

@section('content')
    <div class="container">
        <!-- Intestazione della pagina e pulsante per aggiungere un nuovo progetto -->
        <div class="d-flex justify-content-between align-items-center">
            <h1 class="mt-2">Lista Progetti</h1>
            <span class="fs-4 add-btn d-flex align-items-center justify-content-center text-white me-5">
                <a href="{{ route('admin.projects.create') }}">
                    <i class="fa-solid fa-plus"></i>
                </a>
            </span>
        </div>
        <div class="d-flex justify-content-between align-items-center">
            <p>Clicca il nome per avere maggiori informazioni</p>
            <p class="me-1">Aggiungi progetto</p>
        </div>

        <!-- Messaggi di sessione per feedback all'utente -->
        @if (session('messageDelete'))
            <div class="alert alert-success">
                {{ session('messageDelete') }}
            </div>
        @endif

        @if (session('messageUpload'))
            <div class="alert alert-primary">
                {{ session('messageUpload') }}
            </div>
        @endif

        @if (session('messageEdit'))
            <div class="alert alert-primary">
                {{ session('messageEdit') }}
            </div>
        @endif

        <!-- Form per selezionare quanti elementi visualizzare per pagina -->
        <form action="{{ route('admin.projects.index') }}" method="GET">
            @csrf
            <label for="per_page">Quanti elementi per pagina vuoi vedere?</label>
            <select name="per_page" id="per_page">
                <option value="5" @selected($projects->perPage() == 5)>5</option>
                <option value="10" @selected($projects->perPage() == 10)>10</option>
                <option value="15" @selected($projects->perPage() == 15)>15</option>
            </select>
            <button type="submit">Applica</button>
        </form>

        <!-- Tabella che mostra l'elenco dei progetti -->
        <table class="table table-striped table-hover ms-body">
            <thead>
                <tr>
                    <th scope="col">#</th>
                    <th scope="col">Titolo</th>
                    <th scope="col">Descrizione</th>
                    <th scope="col">Linguaggio</th>
                    <th scope="col">Campo</th>
                    <th scope="col">Tecnologia</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($projects as $project)
                    <tr>
                        <th scope="row">{{ $project->id }}</th>
                        <td>
                            <a href="{{ route('admin.projects.show', ['project' => $project->slug]) }}">
                                {{ $project->title }}
                            </a>
                        </td>
                        <td>{{ $project->description }}</td>
                        <td>{{ $project->type?->name }}</td>
                        <td>{{ $project->type?->field }}</td>
                        <td>
                            @forelse ($project->technologies as $technology)
                                {{ $technology->name }}
                            @empty
                                Nessuna tecnologia indicata
                            @endforelse
                        </td>
                        <td>
                            <!-- Pulsante per aprire il modale di eliminazione -->
                            <button type="button" class="btn btn-danger" data-bs-toggle="modal"
                                data-bs-target="#deleteModal" data-project-id="{{ $project->id }}">Elimina</button>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>

        <!-- Paginazione -->
        <div>
            {{ $projects->links() }}
        </div>

        <!-- Modale di conferma eliminazione -->
        <div class="modal fade" id="deleteModal" tabindex="-1" aria-labelledby="deleteModalLabel" aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered">
                <div class="modal-content">
                    <!-- Header del modale -->
                    <div class="modal-header">
                        <h1 class="modal-title fs-5" id="deleteModalLabel">Conferma eliminazione</h1>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <!-- Body del modale -->
                    <div class="modal-body">
                        <span>Vuoi davvero eliminare l'elemento definitivamente?</span>
                    </div>
                    <!-- Footer del modale -->
                    <div class="modal-footer">
                        <button type="button" class="btn btn-outline-danger" data-bs-dismiss="modal">Chiudi</button>
                        <!-- Form per l'eliminazione definitiva del progetto -->
                        <form id="deleteForm" action="" method="POST">
                            @method('DELETE')
                            @csrf
                            <button class="btn btn-danger">Elimina definitivamente</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>

        <script>
            // JavaScript per impostare l'azione del form di eliminazione con l'id del progetto corretto
            document.addEventListener('DOMContentLoaded', function() {
                var deleteModal = document.getElementById('deleteModal');
                deleteModal.addEventListener('show.bs.modal', function(event) {
                    var button = event.relatedTarget;
                    var projectId = button.getAttribute('data-project-id');
                    var deleteForm = deleteModal.querySelector('#deleteForm');
                    deleteForm.setAttribute('action', `/admin/projects/${projectId}`);
                });
            });
        </script>
    </div>
@endsection

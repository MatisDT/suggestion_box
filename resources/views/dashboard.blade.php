@extends('layouts.app')

@section('content')
    @if (session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif

    <div class="d-flex justify-content-between align-items-center mb-3">
        <h1>Liste des idées</h1>

        <a href="{{ route('ideas.create') }}" class="btn btn-primary">Proposer une idée</a>
    </div>

    <hr>

    <form action="{{ route('dashboard') }}" method="GET" class="mb-3 d-flex gap-2">
        <input type="text" name="search" class="form-control" placeholder="Rechercher une idée" value="{{ $search }}">

        <button type="submit" class="btn btn-outline-primary">Rechercher</button>
    </form>

    @forelse ($ideas as $idea)
        <div class="card mb-3">
            <div class="card-body d-flex justify-content-between align-items-center">
                <div>
                    <div class="d-flex justify-content-start align-items-center gap-2 mb-2">
                        <h5 class="card-title mb-0">{{ $idea->title }}</h5>

                        <p class="my-auto badge text-bg-success">Statut : {{ $idea->status }}</p>
                    </div>

                    @if($idea->description) <p class="text-muted">{{ $idea->description }}</p> @endif
                </div>

                <div class="d-flex gap-2 align-items-center">
                    <a href="{{ route('ideas.edit', $idea) }}" class="btn btn-secondary btn-sm">Modifier</a>

                    <form action="{{ route('ideas.destroy', $idea) }}" method="POST">
                        @csrf
                        @method('DELETE')

                        <button type="submit" class="btn btn-danger btn-sm">Supprimer</button>
                    </form>
                </div>
            </div>
        </div>
    @empty
        <div class="alert alert-secondary">Aucune idée n'a encore été ajoutée</div>
    @endforelse
@endsection

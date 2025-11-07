@extends('layouts.app')

@section('content')
    <h2 class="mb-3">Modifier l'idée</h2>

    <form action="{{ route('ideas.update', $idea) }}" method="POST">
        @csrf
        @method('PUT')

        <div class="mb-3">
            <label for="title" class="form-label">Titre</label>
            <input type="text" id="title" name="title" class="form-control @error('title') is-invalid @enderror"
                value="{{ old('title', $idea->title) }}">
            @error('title')
                <div class="invalid-feedback">{{ $message }}</div>
            @enderror
        </div>

        <div class="mb-3">
            <label for="description" class="form-label">Description</label>
            <textarea id="description" name="description" rows="5" class="form-control">{{ old('content', $idea->description) }}</textarea>
        </div>

        <button type="submit" class="btn btn-primary">Mettre à jour l'idée</button>
    </form>
@endsection

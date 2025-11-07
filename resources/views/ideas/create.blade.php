@extends('layouts.app')

@section('content')
    <h2 class="mb-3">Proposer une nouvelle idée</h2>

    <form action="{{ route('ideas.store') }}" method="POST">
        @csrf

        <div class="mb-3">
            <label for="title" class="form-label">Titre</label>
            <input type="text" id="title" name="title" class="form-control @error('title') is-invalid @enderror"
                value="{{ old('title') }}">
            @error('title')
                <div class="invalid-feedback">{{ $message }}</div>
            @enderror
        </div>

        <div class="mb-3">
            <label for="description" class="form-label">Description</label>
            <textarea id="description" name="description" rows="5" class="form-control">{{ old('content') }}</textarea>
        </div>

        <button type="submit" class="btn btn-primary">Ajouter l'idée</button>
    </form>
@endsection

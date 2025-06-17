@extends('layouts.app')

@section('title', 'Materiaal bekijken')

@section('content')
    <div class="max-w-3xl mx-auto bg-white p-6 rounded shadow">
        <h1 class="text-2xl font-bold mb-4">🔍 Materiaalgegevens</h1>

        <div class="mb-4">
            <p><strong>Naam:</strong> {{ $material->naam }}</p>
            <p><strong>Categorie:</strong> {{ $material->categorie }}</p>
            <p><strong>Voorraad:</strong> {{ $material->voorraad }}</p>
        </div>

        <div class="flex space-x-4 mt-6">
            <a href="{{ route('admin.materials.edit', $material) }}" class="bg-blue-600 text-white px-4 py-2 rounded hover:bg-blue-700">Bewerken</a>
            <a href="{{ route('admin.materials.index') }}" class="bg-gray-300 text-gray-800 px-4 py-2 rounded hover:bg-gray-400">Terug naar overzicht</a>
        </div>
    </div>
@endsection
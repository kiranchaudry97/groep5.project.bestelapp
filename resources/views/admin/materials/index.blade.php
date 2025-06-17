<!DOCTYPE html>
<html lang="nl">
<head>
  <meta charset="UTF-8">
  <title>📦 Materiaalbeheer | Aquafin</title>
  <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-white min-h-screen text-gray-800 font-sans">

  {{-- Navigatie --}}
  @include('partials.admin-nav')

  <div class="max-w-6xl mx-auto px-6 py-8">

    <h1 class="text-2xl font-bold text-blue-600 mb-6 text-center">
      ➕ Beheer Materiaal
    </h1>

    {{-- 🔍 Filter --}}
    <div class="flex justify-center mb-6">
      <form method="GET" class="flex flex-wrap gap-2 items-center bg-blue-50 p-4 rounded shadow-md border max-w-2xl w-full">
        <select name="categorie"
                class="border border-blue-300 rounded px-4 py-2 text-sm flex-1 focus:outline-none focus:ring focus:ring-blue-300">
          <option value="">Alle categorieën</option>
          @foreach($allCategories as $cat)
            <option value="{{ $cat }}" @selected(request('categorie') == $cat)>{{ $cat }}</option>
          @endforeach
        </select>
        <button type="submit" class="bg-blue-500 text-white px-4 py-2 rounded text-sm hover:bg-blue-600">
          🔍 Filter
        </button>
        <a href="{{ route('admin.materials.index') }}"
           class="bg-gray-200 text-gray-800 px-4 py-2 rounded text-sm hover:bg-gray-300">
          ♻ Reset
        </a>
      </form>
    </div>

    {{-- ➕ Nieuw materiaal --}}
    <div class="text-center mb-6">
      <a href="{{ route('admin.materials.create') }}"
         class="bg-blue-500 text-white px-5 py-2 rounded hover:bg-blue-600 text-sm font-semibold shadow">
        ➕ Nieuw materiaal
      </a>
    </div>

    {{-- 📋 Materiaallijst --}}
    <div class="overflow-x-auto">
      <table class="w-full bg-white border rounded shadow-sm text-sm text-left">
        <thead class="bg-gray-100">
          <tr>
            <th class="p-3"> Naam</th>
            <th class="p-3"> Categorie</th>
            <th class="p-3"> Voorraad</th>
            <th class="p-3">Acties</th>
          </tr>
        </thead>
        <tbody>
          @forelse ($materials as $material)
            <tr class="border-t hover:bg-gray-50">
              <td class="p-3">{{ $material->naam }}</td>
              <td class="p-3">{{ $material->categorie }}</td>
              <td class="p-3">{{ $material->voorraad }}</td>
              <td class="p-3 flex gap-2">
                <a href="{{ route('admin.materials.edit', $material) }}"
                   class="text-blue-600 hover:underline">✏ Bewerken</a>
                <form method="POST" action="{{ route('admin.materials.destroy', $material) }}">
                  @csrf
                  @method('DELETE')
                  <button type="submit" onclick="return confirm('Verwijderen?')"
                          class="text-red-600 hover:underline">
                    ❌ Verwijder
                  </button>
                </form>
              </td>
            </tr>
          @empty
            <tr>
              <td colspan="4" class="text-center p-4 text-gray-500">⚠ Geen materialen gevonden.</td>
            </tr>
          @endforelse
        </tbody>
      </table>
    </div>
  </div>

  {{-- Footer --}}
  @include('partials.footer')
</body>
</html>
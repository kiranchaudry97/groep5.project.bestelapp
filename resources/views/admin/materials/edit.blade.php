<!DOCTYPE html>
<html lang="nl">
<head>
  <meta charset="UTF-8">
  <title>✏ Materiaal Bewerken | Aquafin</title>
  <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-white min-h-screen text-gray-800 font-sans">

  {{-- Navigatie --}}
  @include('partials.admin-nav')

  <div class="flex flex-col items-center justify-center min-h-[80vh] px-4">
    <div class="w-full max-w-xl bg-white border border-blue-200 rounded-xl shadow-lg p-8">
      <h1 class="text-xl font-bold text-center text-blue-600 mb-6">📦 Materiaal Bewerken</h1>

      <form action="{{ route('admin.materials.update', $material) }}" method="POST" class="space-y-5">
        @csrf
        @method('PUT')

        {{-- Naam --}}
        <div>
          <label class="block text-sm font-medium mb-1">Naam</label>
          <input type="text" name="naam" value="{{ old('naam', $material->naam) }}" required
                 class="w-full border border-blue-300 rounded px-4 py-2 text-sm focus:outline-none focus:ring focus:ring-blue-300">
        </div>

        {{-- Categorie --}}
        <div>
          <label class="block text-sm font-medium mb-1">Categorie</label>
          <select name="categorie" required
                  class="w-full border border-blue-300 rounded px-4 py-2 text-sm focus:outline-none focus:ring focus:ring-blue-300">
            <option value="">-- Kies een categorie --</option>
            @foreach($allCategories as $cat)
              <option value="{{ $cat }}" @selected(old('categorie', $material->categorie) == $cat)>
                {{ $cat }}
              </option>
            @endforeach
          </select>
        </div>

        {{-- Voorraad --}}
        <div>
          <label class="block text-sm font-medium mb-1">Aantal op voorraad</label>
          <input type="number" name="voorraad" min="0" value="{{ old('voorraad', $material->voorraad) }}" required
                 class="w-full border border-blue-300 rounded px-4 py-2 text-sm focus:outline-none focus:ring focus:ring-blue-300">
        </div>

        {{-- Beschrijving --}}
        <div>
          <label class="block text-sm font-medium mb-1">Beschrijving</label>
          <textarea name="beschrijving" rows="3"
                    class="w-full border border-blue-300 rounded px-4 py-2 text-sm focus:outline-none focus:ring focus:ring-blue-300">{{ old('beschrijving', $material->beschrijving) }}</textarea>
        </div>

        {{-- Acties --}}
        <div class="flex justify-end gap-2 pt-4">
          <a href="{{ route('admin.materials.index') }}"
             class="bg-gray-200 text-gray-700 px-4 py-2 rounded hover:bg-gray-300 text-sm">Annuleren</a>
          <button type="submit"
                  class="bg-blue-500 text-white px-5 py-2 rounded hover:bg-blue-600 text-sm font-semibold">
            Opslaan
          </button>
        </div>
      </form>
    </div>
  </div>

  {{-- Footer --}}
  @include('partials.footer')

</body>
</html>
<!DOCTYPE html>
<html lang="nl">
<head>
  <meta charset="UTF-8">
  <title>Nieuw Materiaal | Aquafin</title>
  <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="min-h-screen flex flex-col bg-gray-100 text-gray-800">

  {{-- ✅ Navigatie --}}
  @include('partials.admin-nav')

  {{-- ✅ Inhoud --}}
  <main class="flex-grow">
    <div class="max-w-xl mx-auto bg-white rounded shadow p-6 mt-8 mb-10">
      <h1 class="text-xl font-bold mb-6 text-center">➕📦 Nieuw materiaal toevoegen</h1>

      @if(session('status'))
        <div class="mb-4 bg-green-100 border border-green-400 text-green-700 px-4 py-2 rounded text-sm">
          ✅ {{ session('status') }}
        </div>
      @endif

      <form action="{{ route('admin.materials.store') }}" method="POST" class="space-y-4">
        @csrf

        <div>
          <label class="block mb-1 text-sm font-medium">Naam</label>
          <input type="text" name="naam" required class="w-full border rounded px-3 py-2 text-sm border-blue-400">
        </div>

        <div>
          <label class="block mb-1 text-sm font-medium">Categorie</label>
          <select name="categorie" required class="w-full border rounded px-3 py-2 text-sm border-blue-400">
            <option value="">-- Kies een categorie --</option>
            @foreach ($allCategories as $cat)
              <option value="{{ $cat }}">{{ $cat }}</option>
            @endforeach
          </select>
        </div>

        <div>
          <label class="block mb-1 text-sm font-medium">Voorraad</label>
          <input type="number" name="voorraad" min="0" required class="w-full border rounded px-3 py-2 text-sm border-blue-400">
        </div>

        <div>
          <label class="block mb-1 text-sm font-medium">Beschrijving</label>
          <textarea name="beschrijving" rows="3" class="w-full border rounded px-3 py-2 text-sm border-blue-400"></textarea>
        </div>

        <div class="text-right mt-6">
          <button type="submit" class="bg-blue-500 text-white px-4 py-2 rounded hover:bg-blue-600 text-sm">
            Opslaan
          </button>
        </div>
      </form>
    </div>
  </main>

  {{-- ✅ Footer --}}
  @include('partials.footer')

</body>
</html>
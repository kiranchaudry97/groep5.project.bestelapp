<!DOCTYPE html>
<html lang="nl">
<head>
  <meta charset="UTF-8">
  <title>Winkelmand | Technieker</title>
  <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-white min-h-screen text-gray-800 font-sans flex flex-col">

  {{-- Navigatie --}}
  @include('partials.nav')

  <main class="flex-grow">
    <div class="max-w-4xl mx-auto p-6">
      <h1 class="text-2xl font-bold mb-6 text-center">🛒 Mijn Winkelmand</h1>

      {{-- ✅ Statusmelding --}}
      @if (session('status'))
        <div class="bg-green-100 border border-green-300 text-green-700 text-sm px-4 py-2 rounded mb-4 text-center">
          ✅ {{ session('status') }}
        </div>
      @endif

      {{-- ✅ Winkelmandinhoud --}}
      @if($materials->isEmpty())
        <p class="text-center text-gray-600">Je hebt nog geen materialen toegevoegd.</p>
      @else
        <table class="w-full bg-white border rounded text-sm shadow">
          <thead class="bg-blue-100">
            <tr>
              <th class="p-3 text-left">Categorie</th>
              <th class="p-3 text-left">Materiaal</th>
              <th class="p-3 text-center">Aantal</th>
              <th class="p-3 text-center">Actie</th>
            </tr>
          </thead>
          <tbody>
            @foreach ($materials as $material)
              <tr class="border-t hover:bg-gray-50">
                <td class="p-3">{{ $material->categorie }}</td>
                <td class="p-3">{{ $material->naam }}</td>
                <td class="p-3 text-center">{{ $cart[$material->id] }}</td>
                <td class="p-3 text-center">
                  <form method="POST" action="{{ route('technieker.cart.remove') }}" onsubmit="return confirm('Verwijder dit materiaal?')">
                    @csrf
                    <input type="hidden" name="material_id" value="{{ $material->id }}">
                    <button type="submit" class="text-red-600 hover:underline text-sm">❌ Verwijder</button>
                  </form>
                </td>
              </tr>
            @endforeach
          </tbody>
        </table>

        {{-- ✅ Bestelformulier met leverdatum --}}
        <form method="POST" action="{{ route('technieker.cart.submit') }}" class="mt-6 space-y-4">
          @csrf

          <div>
            <label for="leverdatum" class="block text-sm font-medium text-gray-700 mb-1">
              Leverdatum <span class="text-red-500">*</span>
            </label>
            <input type="date" name="leverdatum" id="leverdatum" required
                   class="border border-gray-300 rounded px-3 py-2 text-sm w-full md:w-1/2"
                   min="{{ date('Y-m-d') }}">
            @error('leverdatum')
              <p class="text-red-600 text-xs mt-1">{{ $message }}</p>
            @enderror
          </div>

          <div class="text-right">
            <button type="submit"
                    class="bg-green-600 hover:bg-green-700 text-white px-4 py-2 rounded">
              ✅ Bestelling plaatsen
            </button>
          </div>
        </form>
      @endif

      <div class="mt-6 text-sm text-center">
        <a href="{{ route('technieker.materials.index') }}" class="text-blue-600 hover:underline">← Terug naar materialen</a>
      </div>
    </div>
  </main>

  {{-- Footer --}}
  @include('partials.footer')

</body>
</html>
<!DOCTYPE html>
<html lang="nl">
<head>
  <meta charset="UTF-8">
  <title>Materiaaloverzicht | Technieker</title>
  <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-white min-h-screen text-gray-800 font-sans">

  @include('partials.nav')

  <div class="max-w-7xl mx-auto p-6">
    <h1 class="text-2xl font-bold mb-6 text-center">📦 Materiaal bestellen</h1>

    @php
      $categorieAfbeeldingen = [
        '👷‍♂ PBM' => 'pbm.jpg',
        '🧰 Bevestigingsmateriaal' => 'bevestiging.jpg',
        '🔧 Gereedschap' => 'gereedschap.jpg',
        '⚙ Technische onderhoudsmaterialen' => 'technisch.jpeg',
        '🛠 Riolering tools' => 'riolering.jpg',
        '📦 Diversen / Verbruiksgoederen' => 'diversen.jpg',
      ];

      $categorieLabels = [
        '👷‍♂ PBM' => ['emoji' => '👷‍♂', 'label' => 'PBM'],
        '🧰 Bevestigingsmateriaal' => ['emoji' => '🧰', 'label' => 'Bevestigingsmateriaal'],
        '🔧 Gereedschap' => ['emoji' => '🔧', 'label' => 'Gereedschap'],
        '⚙ Technische onderhoudsmaterialen' => ['emoji' => '⚙', 'label' => 'Technisch onderhoud'],
        '🛠 Riolering tools' => ['emoji' => '🛠', 'label' => 'Riolering tools'],
        '📦 Diversen / Verbruiksgoederen' => ['emoji' => '📦', 'label' => 'Verbruiksgoederen'],
      ];

      $uniekeCats = collect($allCategories)->unique()->sort()->values();
      $dropdownCats = array_keys($categorieLabels);
    @endphp

    {{-- 📸 Tegels --}}
    <div class="grid grid-cols-2 sm:grid-cols-3 lg:grid-cols-4 xl:grid-cols-5 gap-6 mb-8">
      @foreach ($uniekeCats as $cat)
        @php
          $img = $categorieAfbeeldingen[$cat] ?? null;
          $label = $categorieLabels[$cat] ?? ['emoji' => '', 'label' => $cat];
        @endphp
        @if ($img)
          <a href="{{ route('technieker.materials.index', ['categorie' => $cat]) }}"
             class="relative block rounded-lg border-4 border-blue-300 overflow-hidden shadow hover:shadow-lg transition duration-200 group bg-white">
            <img src="{{ asset('images/categorieën/' . $img) }}"
                 alt="{{ $cat }}"
                 class="w-full h-32 object-cover group-hover:scale-105 transition-transform duration-300">
            <div class="absolute inset-0 bg-black bg-opacity-30"></div>
            <div class="absolute inset-0 flex items-center justify-center p-2 text-center">
              <span class="text-white font-bold text-sm sm:text-base drop-shadow leading-tight">
                {{ $label['emoji'] }}<br>{{ $label['label'] }}
              </span>
            </div>
          </a>
        @endif
      @endforeach
    </div>

    {{-- 🔍 Filters (met Enter support) --}}
    <form method="GET"
          class="flex flex-wrap items-center justify-center gap-2 bg-white p-4 rounded-md border border-blue-300 shadow w-full max-w-4xl mx-auto mb-8">
      
      {{-- Zoekveld --}}
      <div class="relative w-full sm:w-auto">
        <span class="absolute inset-y-0 left-3 flex items-center text-gray-500">🔍</span>
        <input type="text" name="search" value="{{ request('search') }}"
               placeholder="Zoek materiaal..."
               class="pl-10 pr-4 py-2 rounded-full border border-blue-300 focus:ring-blue-400 focus:border-blue-400 text-sm w-full sm:w-64">
      </div>

      {{-- Dropdown --}}
      <select name="categorie"
              class="rounded-full border border-blue-300 px-4 py-2 text-sm focus:ring-blue-400 focus:border-blue-400 w-full sm:w-48">
        <option value="">Categorie</option>
        @foreach ($dropdownCats as $cat)
          <option value="{{ $cat }}" @selected(request('categorie') == $cat)>{{ $cat }}</option>
        @endforeach
      </select>

      {{-- Knoppen --}}
      <button type="submit" class="bg-blue-500 text-white px-4 py-2 rounded-full text-sm hover:bg-blue-600">Filter</button>

      <a href="{{ route('technieker.materials.index') }}"
         class="inline-flex items-center border border-gray-300 text-gray-700 px-4 py-2 rounded-full text-sm hover:bg-gray-100">
         Reset
      </a>
    </form>

    {{-- 📋 Materialen --}}
    <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-6">
      @forelse ($materials as $material)
        <div class="bg-gray-300 rounded-md p-4 shadow flex flex-col gap-2">
          <div>
            <h2 class="text-base font-bold text-gray-900">{{ $material->naam }}</h2>
            <p class="text-sm text-gray-600">{{ $material->categorie }}</p>
            <p class="text-sm text-gray-700">
              Voorraad: <span class="font-semibold">{{ $material->voorraad }}</span> stuks
            </p>
          </div>

          <form method="POST" action="{{ route('technieker.cart.add') }}" class="flex items-center justify-between">
            @csrf
            <input type="hidden" name="material_id" value="{{ $material->id }}">
            <input type="number" name="aantal" min="1" max="{{ $material->voorraad }}" value="1"
                   class="w-16 border rounded px-2 py-1 text-sm text-center" required>
            <button type="submit"
                    class="bg-blue-500 text-white text-sm px-4 py-2 rounded hover:bg-blue-600">
               Toevoegen
            </button>
          </form>
        </div>
      @empty
        <p class="text-center col-span-3 text-gray-500">Geen materialen gevonden.</p>
      @endforelse
    </div>

    {{-- 🛒 Winkelmand --}}
    <div class="text-center mt-8 text-sm">
      <a href="{{ route('technieker.cart.view') }}" class="text-blue-600 hover:underline">🛒 Bekijk winkelmand</a>
    </div>
  </div>

  @include('partials.footer')

</body>
</html>
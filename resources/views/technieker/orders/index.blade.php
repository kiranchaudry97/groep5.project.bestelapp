<!DOCTYPE html>
<html lang="nl">
<head>
  <meta charset="UTF-8">
  <title>Dashboard | Technieker</title>
  <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-white min-h-screen text-gray-800 font-sans">

  {{-- Navigatie --}}
  @include('partials.nav')

  <div class="max-w-6xl mx-auto p-6">
    <!-- Welkom -->
    <div class="text-center mb-10">
      <h1 class="text-2xl font-bold mb-2">👋 Welkom, {{ Auth::user()->name }}!</h1>
      <p class="text-gray-600">dashboard👷‍♂</p>
      <a href="{{ route('technieker.materials.index') }}"
         class="mt-4 inline-block bg-blue-500 text-white px-6 py-2 rounded hover:bg-blue-600 text-sm">
        Materiaal bestellen
      </a>
    </div>

    <!-- Laatste bestellingen -->
    <div>
      <h2 class="text-xl font-semibold mb-4">📦 Laatste bestellingen</h2>

      <table class="w-full text-sm text-center border border-gray-300 rounded overflow-hidden shadow">
        <thead class="bg-gray-200 text-gray-700">
          <tr>
            <th class="p-3 bg-blue-400 text-white">Bestelnummer</th>
            <th class="p-3 bg-blue-400 text-white">Bestel Datum</th>
            <th class="p-3 bg-blue-400 text-white">Status</th>
          </tr>
        </thead>
        <tbody>
          @forelse ($orders as $order)
            <tr class="border-t border-gray-200 bg-gray-50 hover:bg-gray-100">
              <td class="p-3 font-semibold">
                <a href="{{ route('technieker.orders.show', $order->id) }}" class="text-blue-600 hover:underline">
                  #B{{ str_pad($order->id, 4, '0', STR_PAD_LEFT) }}
                </a>
              </td>
              <td class="p-3">{{ \Carbon\Carbon::parse($order->leverdatum)->format('d/m/Y') }}</td>
              <td class="p-3">
                @php
                  $badgeClass = match($order->status) {
                    'verwerkt' => 'bg-gray-200 text-gray-800',
                    'in_behandeling' => 'bg-blue-400 text-white',
                    'geleverd' => 'bg-green-500 text-white',
                    'geannuleerd' => 'bg-red-500 text-white',
                    default => 'bg-gray-300 text-gray-600'
                  };
                @endphp
                <span class="px-3 py-1 rounded-full text-xs font-semibold {{ $badgeClass }}">
                  {{ ucfirst($order->status) }}
                </span>
              </td>
            </tr>
          @empty
            <tr>
              <td colspan="3" class="text-gray-500 italic p-4">Geen bestellingen gevonden.</td>
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
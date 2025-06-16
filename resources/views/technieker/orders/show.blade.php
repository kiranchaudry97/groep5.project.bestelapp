<!DOCTYPE html>
<html lang="nl">
<head>
  <meta charset="UTF-8">
  <title>Bestelling #{{ $order->id }}</title>
  <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-white min-h-screen font-sans text-gray-800">

  {{-- Navigatie --}}
  @include('partials.nav')

  <div class="max-w-4xl mx-auto px-4 py-8">
    <h1 class="text-2xl font-bold mb-6 text-center">📦 Bestelling #B{{ str_pad($order->id, 4, '0', STR_PAD_LEFT) }}</h1>

    <!-- Order info -->
    <div class="bg-white p-4 rounded shadow mb-6 border">
      <p class="mb-2">
        <strong>Besteldatum:</strong>
        {{ \Carbon\Carbon::parse($order->created_at)->format('d/m/Y') }}
      </p>
      <p class="mb-2">
        <strong>Leverdatum:</strong>
        {{ \Carbon\Carbon::parse($order->leverdatum)->format('d/m/Y') }}
      </p>
      <p>
        <strong>Status:</strong>
        @php
          $badgeClass = match($order->status) {
            'in_behandeling' => 'bg-blue-100 text-blue-800',
            'verwerkt' => 'bg-gray-200 text-gray-700',
            'geleverd' => 'bg-green-200 text-green-700',
            'geannuleerd' => 'bg-red-200 text-red-700',
            default => 'bg-gray-100 text-gray-500'
          };
        @endphp
        <span class="px-2 py-1 text-xs rounded {{ $badgeClass }}">
          {{ ucfirst($order->status) }}
        </span>
      </p>
    </div>

    <!-- Materialen overzicht -->
    <div class="bg-white rounded shadow overflow-x-auto border">
      <table class="w-full text-sm">
        <thead class="bg-blue-100 text-left">
          <tr>
            <th class="p-3">Materiaal</th>
            <th class="p-3">Categorie</th>
            <th class="p-3 text-center">Aantal</th>
          </tr>
        </thead>
        <tbody>
          @foreach ($order->items as $item)
            <tr class="border-t hover:bg-gray-50">
              <td class="p-3">{{ $item->material->naam }}</td>
              <td class="p-3">{{ $item->material->categorie }}</td>
              <td class="p-3 text-center">{{ $item->aantal }}</td>
            </tr>
          @endforeach
        </tbody>
      </table>
    </div>

    <!-- Teruglink -->
    <div class="mt-6 text-sm text-center">
      <a href="{{ route('technieker.orders.index') }}" class="text-blue-600 hover:underline">
        ← Terug naar overzicht
      </a>
    </div>
  </div>

  {{-- Footer --}}
  @include('partials.footer')

</body>
</html>
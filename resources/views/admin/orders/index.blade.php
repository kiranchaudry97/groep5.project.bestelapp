<!DOCTYPE html>
<html lang="nl">
<head>
  <meta charset="UTF-8">
  <title>📦 Bestellingen | Admin</title>
  <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-gray-100 text-gray-800 min-h-screen flex flex-col">

  {{-- ✅ Navigatie --}}
  @include('partials.admin-nav')

  <main class="flex-grow">
    <div class="max-w-6xl mx-auto p-6">
      <h1 class="text-2xl font-bold mb-6 text-center">📥 Ingekomen bestellingen</h1>

      {{-- ✅ Flash-melding --}}
      @if(session('status'))
        <div class="mb-6 bg-green-100 border border-green-400 text-green-700 px-4 py-2 rounded text-sm text-center">
          ✅ {{ session('status') }}
        </div>
      @endif

      {{-- ✅ Statistieken --}}
      <div class="grid grid-cols-2 md:grid-cols-4 gap-4 mb-8 text-center">
        <div class="bg-white border rounded shadow p-4">
          <p class="text-sm text-gray-500">Totaal</p>
          <p class="text-2xl font-bold text-blue-600">{{ $stats['totaal'] }}</p>
        </div>
        <div class="bg-white border rounded shadow p-4">
          <p class="text-sm text-gray-500">In behandeling</p>
          <p class="text-2xl font-bold text-yellow-500">{{ $stats['in_behandeling'] }}</p>
        </div>
        <div class="bg-white border rounded shadow p-4">
          <p class="text-sm text-gray-500">Verzonden</p>
          <p class="text-2xl font-bold text-green-500">{{ $stats['verzonden'] }}</p>
        </div>
        <div class="bg-white border rounded shadow p-4">
          <p class="text-sm text-gray-500">Afgehandeld</p>
          <p class="text-2xl font-bold text-gray-700">{{ $stats['afgehandeld'] }}</p>
        </div>
      </div>

      {{-- ✅ Overzicht bestellingen --}}
      @forelse ($bestellingen as $order)
        <div class="bg-white border rounded shadow mb-6">
          <div class="p-4 border-b flex flex-col sm:flex-row sm:justify-between gap-3">
            <div>
              <p class="text-blue-600 font-semibold">📦 Bestelling #{{ $order->id }}</p>
              <p class="text-sm text-gray-600">👤 {{ $order->user->name }} ({{ $order->user->email }})</p>
              <p class="text-sm text-gray-500">
                📅 Besteldatum: <strong>{{ \Carbon\Carbon::parse($order->created_at)->format('d-m-Y') }}</strong>
              </p>
              <p class="text-sm text-gray-500">
                🚚 Leverdatum: <strong>{{ \Carbon\Carbon::parse($order->leverdatum)->format('d-m-Y') }}</strong>
              </p>
            </div>

            {{-- Status aanpassen --}}
            <form method="POST" action="{{ route('admin.bestellingen.status', $order) }}">
              @csrf
              <select name="status" onchange="this.form.submit()"
                class="text-sm border border-blue-300 rounded px-3 py-2 bg-white text-gray-800 w-full sm:w-auto">
                @foreach(['in_behandeling', 'verzonden', 'afgehandeld'] as $optie)
                  <option value="{{ $optie }}" {{ $order->status === $optie ? 'selected' : '' }}>
                    {{ ucfirst(str_replace('_', ' ', $optie)) }}
                  </option>
                @endforeach
              </select>
            </form>
          </div>

          <table class="w-full text-sm">
            <thead class="bg-blue-50 text-left text-blue-700 font-semibold">
              <tr>
                <th class="p-3">Materiaal</th>
                <th class="p-3 text-center">Aantal</th>
              </tr>
            </thead>
            <tbody>
              @foreach ($order->items as $item)
                <tr class="border-t hover:bg-gray-50">
                  <td class="p-3">{{ $item->material->naam }}</td>
                  <td class="p-3 text-center">{{ $item->aantal }}</td>
                </tr>
              @endforeach
            </tbody>
          </table>
        </div>
      @empty
        <p class="text-center text-gray-600 mt-10">Er zijn nog geen bestellingen geplaatst.</p>
      @endforelse
    </div>
  </main>

  {{-- ✅ Footer --}}
  @include('partials.footer')

</body>
</html>
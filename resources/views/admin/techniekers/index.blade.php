<!DOCTYPE html>
<html lang="nl">
<head>
  <meta charset="UTF-8">
  <title>Techniekers | Admin</title>
  <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-gray-100 text-gray-800 min-h-screen">
  
  {{-- Navigatie --}}
  @include('partials.admin-nav')

  <div class="max-w-5xl mx-auto p-6">
    <h1 class="text-2xl font-bold mb-6 text-center">👷‍♂ Overzicht techniekers</h1>

    @if (session('status'))
      <div class="bg-green-100 border border-green-300 text-green-700 px-4 py-2 rounded text-sm text-center mb-4">
        ✅ {{ session('status') }}
      </div>
    @endif

    <div class="mb-4 text-right">
      <a href="{{ route('admin.techniekers.create') }}"
         class="bg-blue-500 text-white px-4 py-2 rounded text-sm hover:bg-blue-600">
        ➕ Nieuwe technieker
      </a>
    </div>

    <table class="w-full bg-white border rounded shadow text-sm">
      <thead class="bg-blue-100 text-left">
        <tr>
          <th class="p-3">Naam</th>
          <th class="p-3">E-mailadres</th>
          <th class="p-3">Aangemaakt op</th>
        </tr>
      </thead>
      <tbody>
        @forelse($users as $user)
          <tr class="border-t hover:bg-gray-50">
            <td class="p-3">{{ $user->name }}</td>
            <td class="p-3">{{ $user->email }}</td>
            <td class="p-3">{{ $user->created_at->format('d/m/Y') }}</td>
          </tr>
        @empty
          <tr>
            <td colspan="3" class="p-3 text-gray-500 text-center">Geen techniekers gevonden.</td>
          </tr>
        @endforelse
      </tbody>
    </table>
  </div>

  {{-- Footer --}}
  @include('partials.footer')

</body>
</html>
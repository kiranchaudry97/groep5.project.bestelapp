<!DOCTYPE html>
<html lang="nl">
<head>
  <meta charset="UTF-8">
  <title>Nieuwe Technieker</title>
  <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-gray-100 text-gray-800 min-h-screen">

  @include('partials.admin-nav')

  <div class="max-w-xl mx-auto p-6 bg-white mt-10 rounded shadow">
    <h1 class="text-xl font-bold mb-4 text-center">👷‍♂ Nieuwe Technieker toevoegen</h1>

    @if(session('status'))
      <div class="mb-4 text-green-700 bg-green-100 border border-green-400 px-4 py-2 rounded text-sm">
        ✅ {{ session('status') }}
      </div>
    @endif

    <form method="POST" action="{{ route('admin.techniekers.store') }}" class="space-y-4">
      @csrf

      <!-- Naam -->
      <div>
        <label class="block text-sm font-medium mb-1">Naam</label>
        <input type="text" name="name" required class="w-full border border-blue-300 rounded px-3 py-2 text-sm">
      </div>

      <!-- E-mail -->
      <div>
        <label class="block text-sm font-medium mb-1">E-mailadres</label>
        <input type="email" name="email" required class="w-full border border-blue-300 rounded px-3 py-2 text-sm">
      </div>

      <!-- Info over standaard wachtwoord -->
      <div class="text-sm text-gray-600 bg-blue-50 border border-blue-200 rounded p-3">
        🔐 Bij het aanmaken wordt automatisch het wachtwoord <code>tech123</code> toegekend.<br>
        De technieker kan dit zelf wijzigen via het profiel.
      </div>

      <!-- Submit -->
      <div class="text-right">
        <button type="submit" class="bg-blue-500 text-white px-4 py-2 rounded hover:bg-blue-600 text-sm">
          ➕ Gebruiker aanmaken
        </button>
      </div>
    </form>
  </div>

  @include('partials.footer')

</body>
</html>
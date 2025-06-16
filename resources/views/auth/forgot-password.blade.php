<!DOCTYPE html>
<html lang="nl">
<head>
  <meta charset="UTF-8">
  <title>Wachtwoord vergeten | BestelApp</title>
  <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-gray-50 min-h-screen flex items-center justify-center">

  <div class="w-full max-w-md bg-white rounded shadow-md p-6 text-gray-800">

    <!-- Logo -->
    <div class="text-center mb-6">
      <img src="{{ asset('images/logoaquafin.jpg') }}" alt="Aquafin logo" class="w-28 mx-auto rounded shadow-sm">
    </div>

    <!-- Uitleg -->
    <p class="mb-4 text-sm text-gray-600 text-center">
      Wachtwoord vergeten? Geen probleem. Geef je e-mailadres op en we sturen je een link waarmee je een nieuw wachtwoord kunt instellen.
    </p>

    <!-- Sessiestatus -->
    @if (session('status'))
      <div class="bg-green-100 border border-green-300 text-green-700 px-4 py-2 rounded text-sm mb-4 text-center">
        ✅ {{ session('status') }}
      </div>
    @endif

    <!-- Formulier -->
    <form method="POST" action="{{ route('password.email') }}" class="space-y-4">
      @csrf

      <!-- Email -->
      <div>
        <label for="email" class="block text-sm font-medium mb-1">E-mailadres</label>
        <input type="email" id="email" name="email" required autofocus
               class="w-full border border-blue-300 rounded px-3 py-2 text-sm"
               value="{{ old('email') }}">
        @error('email')
          <p class="text-red-600 text-xs mt-1">{{ $message }}</p>
        @enderror
      </div>

      <div class="text-right">
        <button type="submit"
                class="bg-blue-500 hover:bg-blue-600 text-white text-sm px-4 py-2 rounded">
          Verzend resetlink
        </button>
      </div>
    </form>

  </div>

</body>
</html>
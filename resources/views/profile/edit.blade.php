<!DOCTYPE html>
<html lang="nl">
<head>
  <meta charset="UTF-8">
  <title>Profiel | Technieker</title>
  <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-gray-50 min-h-screen text-gray-800">

  @include('partials.nav') {{-- of nav-technieker.blade.php als apart --}}
  
  <div class="max-w-3xl mx-auto p-6">
    <h1 class="text-xl font-bold mb-6 text-center">👤 Mijn Profiel</h1>

    @if (session('status'))
      <div class="bg-green-100 text-green-700 px-4 py-2 border rounded mb-4 text-sm">
        ✅ {{ session('status') }}
      </div>
    @endif

    <form method="POST" action="{{ route('profile.update') }}" class="space-y-6">
      @csrf
      @method('PATCH')

      <div>
        <label class="block text-sm font-medium mb-1">Naam</label>
        <input type="text" name="name" value="{{ old('name', $user->name) }}" class="w-full border px-3 py-2 rounded text-sm">
        @error('name') <p class="text-red-600 text-xs mt-1">{{ $message }}</p> @enderror
      </div>

      <div>
        <label class="block text-sm font-medium mb-1">E-mailadres</label>
        <input type="email" name="email" value="{{ old('email', $user->email) }}" class="w-full border px-3 py-2 rounded text-sm">
        @error('email') <p class="text-red-600 text-xs mt-1">{{ $message }}</p> @enderror
      </div>

      <hr>

      <div>
        <label class="block text-sm font-medium mb-1">Nieuw wachtwoord</label>
        <input type="password" name="password" class="w-full border px-3 py-2 rounded text-sm">
        @error('password') <p class="text-red-600 text-xs mt-1">{{ $message }}</p> @enderror
      </div>

      <div>
        <label class="block text-sm font-medium mb-1">Bevestig wachtwoord</label>
        <input type="password" name="password_confirmation" class="w-full border px-3 py-2 rounded text-sm">
      </div>

      <div class="text-right">
        <button type="submit" class="bg-blue-500 hover:bg-blue-600 text-white px-4 py-2 rounded text-sm">Wijzigingen opslaan</button>
      </div>
    </form>
  </div>

  @include('partials.footer')
</body>
</html>
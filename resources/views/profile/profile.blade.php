<!DOCTYPE html>
<html lang="nl">
<head>
  <meta charset="UTF-8">
  <title>Profiel | Technieker</title>
  <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-gray-50 min-h-screen text-gray-800">

  {{-- Navigatie --}}
  @include('partials.nav-technieker') {{-- gebruik deze als je een aparte technieker-navigatie hebt --}}

  <div class="max-w-3xl mx-auto p-6">
    <h1 class="text-xl font-bold mb-6 text-center">👤 Mijn Profiel</h1>

    {{-- Feedback --}}
    @if (session('status'))
      <div class="bg-green-100 text-green-700 px-4 py-2 border rounded mb-4 text-sm">
        ✅ {{ session('status') === 'profile-updated' ? 'Profiel succesvol bijgewerkt.' : session('status') }}
      </div>
    @endif

    {{-- Formulier --}}
    <form method="POST" action="{{ route('profile.update') }}" class="space-y-6">
      @csrf
      @method('PATCH')

      {{-- Naam --}}
      <div>
        <label class="block text-sm font-medium mb-1">Naam</label>
        <input type="text" name="name" value="{{ old('name', auth()->user()->name) }}" class="w-full border px-3 py-2 rounded text-sm">
        @error('name') <p class="text-red-600 text-xs mt-1">{{ $message }}</p> @enderror
      </div>

      {{-- Email --}}
      <div>
        <label class="block text-sm font-medium mb-1">E-mailadres</label>
        <input type="email" name="email" value="{{ old('email', auth()->user()->email) }}" class="w-full border px-3 py-2 rounded text-sm">
        @error('email') <p class="text-red-600 text-xs mt-1">{{ $message }}</p> @enderror
      </div>

      <hr>

      {{-- Nieuw wachtwoord --}}
      <div>
        <label class="block text-sm font-medium mb-1">Nieuw wachtwoord</label>
        <input type="password" name="password" class="w-full border px-3 py-2 rounded text-sm">
        @error('password') <p class="text-red-600 text-xs mt-1">{{ $message }}</p> @enderror
      </div>

      {{-- Bevestiging wachtwoord --}}
      <div>
        <label class="block text-sm font-medium mb-1">Bevestig wachtwoord</label>
        <input type="password" name="password_confirmation" class="w-full border px-3 py-2 rounded text-sm">
      </div>

      <div class="text-right">
        <button type="submit" class="bg-blue-500 hover:bg-blue-600 text-white px-4 py-2 rounded text-sm">
          ✅ Wijzigingen opslaan
        </button>
      </div>
    </form>
  </div>

  {{-- Footer --}}
  @include('partials.footer')

</body>
</html>
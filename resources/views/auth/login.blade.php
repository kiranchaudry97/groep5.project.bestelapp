<!DOCTYPE html>
<html lang="nl">
<head>
  <meta charset="UTF-8">
  <title>Login | BestelApp</title>
  <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="min-h-screen bg-white flex items-center justify-center">

<div class="w-full max-w-sm text-center px-4">

  <!-- Logo -->
  <img src="{{ asset('images/logoaquafin.jpg') }}" alt="Aquafin logo"
       class="mx-auto w-32 h-auto mb-6 rounded shadow-sm" />

  <!-- Sessiestatus -->
  @if (session('status'))
    <div class="bg-green-100 border border-green-400 text-green-700 px-4 py-2 rounded mb-4 text-sm">
      ✅ {{ session('status') }}
    </div>
  @endif

  <!-- Foutmeldingen -->
  @if ($errors->any())
    <div class="bg-red-100 border border-red-400 text-red-700 px-4 py-2 rounded mb-4 text-sm">
      ❌ {{ $errors->first() }}
    </div>
  @endif

  <!-- Loginformulier -->
  <form method="POST" action="{{ route('login') }}" class="space-y-4 text-left">
    @csrf

    <!-- E-mailadres -->
    <input type="email" name="email" placeholder="E-mailadres" required autofocus
           class="w-full border border-blue-400 rounded-md px-4 py-2" value="{{ old('email') }}" />

    <!-- Wachtwoord -->
    <input type="password" name="password" placeholder="Wachtwoord" required
           class="w-full border border-blue-400 rounded-md px-4 py-2" />

    <!-- Onthoud mij -->
    <div class="flex items-center mb-2">
      <input type="checkbox" name="remember" id="remember" class="mr-2">
      <label for="remember" class="text-sm text-gray-700">Onthoud mij</label>
    </div>

    <!-- Acties -->
    <div class="flex justify-between items-center text-sm">
      <a href="{{ route('password.request') }}" class="text-blue-500 hover:underline">
        Wachtwoord vergeten?
      </a>
      <button type="submit"
              class="bg-blue-500 text-white px-4 py-2 rounded-md hover:bg-blue-600">
        Inloggen
      </button>
    </div>
  </form>

  <!-- Testgegevens -->
  <div class="mt-6 text-left text-sm text-gray-600 bg-gray-50 border border-gray-300 rounded p-4">
    <p class="mb-1 font-semibold text-gray-700">🔐 Testlogin:</p>
    <ul class="list-disc list-inside mb-3">
      <li><strong>Technieker:</strong> tech@aquafin.be / <code>tech123</code></li>
      <li><strong>Admin:</strong> admin@aquafin.be / <code>admin123</code></li>
    </ul>
    <p><span class="font-medium text-gray-800">ℹ Na het inloggen</span> kan je via het profiel je wachtwoord zelf wijzigen.</p>
  </div>

</div>

</body>
</html>
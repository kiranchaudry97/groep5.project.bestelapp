<!DOCTYPE html>
<html lang="nl" class="h-full">
<head>
  <meta charset="UTF-8">
  <title>Nieuwe Categorie | Aquafin</title>
  <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="min-h-screen h-full flex flex-col bg-gray-100 text-gray-800">

  @include('partials.admin-nav')

  <main class="flex-grow max-w-lg mx-auto mt-10 p-6 bg-white rounded shadow">
    <h1 class="text-xl font-bold mb-6 text-center">📁 Nieuwe categorie toevoegen</h1>

    @if(session('status'))
      <div class="mb-4 bg-green-100 border border-green-400 text-green-700 px-4 py-2 rounded text-sm">
        ✅ {{ session('status') }}
      </div>
    @endif

    <form action="{{ route('admin.categories.store') }}" method="POST" class="space-y-4">
      @csrf

      <div>
        <label class="block mb-1 text-sm font-medium">Categorienaam</label>
        <input type="text" name="naam" required class="w-full border rounded px-3 py-2 text-sm border-blue-400" value="{{ old('naam') }}">
        @error('naam')
          <p class="text-red-600 text-sm mt-1">{{ $message }}</p>
        @enderror
      </div>

      <div class="text-right">
        <button type="submit" class="bg-blue-500 text-white px-4 py-2 rounded hover:bg-blue-600 text-sm">
          Toevoegen
        </button>
      </div>
    </form>
  </main>

  @include('partials.footer')
</body>
</html>
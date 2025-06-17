<nav class="bg-white shadow-sm border-b mb-6">
  <div class="max-w-7xl mx-auto px-4 py-3 flex justify-between items-center">
    
    <!-- Logo + naam -->
    <div class="flex items-center gap-3">
      <img src="{{ asset('images/logoaquafin.jpg') }}" alt="Aquafin" class="h-14 w-auto rounded shadow-sm">
    </div>

    <!-- Navigatielinks -->
    <div class="flex items-center space-x-3 text-sm">
      <a href="{{ route('technieker.dashboard') }}" class="bg-blue-400 text-white px-4 py-1 rounded-full font-semibold hover:bg-blue-500">Dashboard</a>
      <a href="{{ route('technieker.materials.index') }}" class="bg-blue-400 text-white px-4 py-1 rounded-full font-semibold hover:bg-blue-500">Materiaal</a>
      <a href="{{ route('technieker.cart.view') }}" class="bg-blue-400 text-white px-4 py-1 rounded-full font-semibold hover:bg-blue-500">Winkelmand</a>
      <a href="{{ route('technieker.orders.index') }}" class="bg-blue-400 text-white px-4 py-1 rounded-full font-semibold hover:bg-blue-500">Bestellingen</a>
      
      <!-- ✅ Nieuw: Profiel -->
      <a href="{{ route('profile.edit') }}" class="bg-blue-400 text-white px-4 py-1 rounded-full font-semibold hover:bg-blue-500">
        Profiel
      </a>

      <!-- Afmelden -->
      <form method="POST" action="{{ route('logout') }}" class="inline">
        @csrf
        <button type="submit" class="bg-red-500 text-white px-4 py-1 rounded-full font-semibold hover:bg-red-600">
          Afmelden
        </button>
      </form>
    </div>

  </div>
</nav>
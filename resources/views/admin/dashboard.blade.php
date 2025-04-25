<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <meta http-equiv="X-UA-Compatible" content="ie=edge" />
  <script src="https://cdn.tailwindcss.com"></script>
  <title>Dashboard Admin</title>
</head>
<body class="bg-gray-50 m-0 p-0">
  <header class="bg-gradient-to-r from-blue-200 to-blue-300 to bg-blue-500 sticky top-0 z-50 shadow">
    <nav class="container mx-auto px-4 py-4 flex justify-between items-center text-blue-950">
      <a href="#" class="text-2xl sm:text-3xl font-bold">Artikelia</a>
      <ul class="flex space-x-4 sm:space-x-6 items-center text-sm sm:text-base">
        <li><a href="{{ route('create') }}" class="hover:underline font-semibold">Tambah</a></li>
        <li><a href="#" class="px-4 py-1 border border-blue-950 rounded-xl font-semibold hover:bg-blue-200 hover:text-blue-950 transition">Logout</a></li>
      </ul>
    </nav>
  </header>

  <div class="py-10 px-4">
    <div class="max-w-[1500px] mx-auto px-4">
      <h3 class="text-3xl font-bold text-center mb-4 text-blue-950">Dashboard</h3>
      <p class="text-gray-500 text-center mb-10">Konten menarik dimulai dari sini. Ayo buat!</p>

      <div class="grid grid-cols-1 sm:grid-cols-2 gap-6">
        @foreach ($artikels as $artikel)
          <div class="w-full bg-white rounded-xl shadow-xl overflow-hidden p-4 sm:p-6 hover:scale-105 transition duration-200">
            <div class="flex flex-col sm:flex-row gap-4 sm:gap-6">
              <img src="{{ asset('storage/' . $artikel->thumbnail) }}" alt="foto" class="rounded-md bg-gray-100 w-full sm:w-36 h-36 object-cover" />
        
              <div class="flex flex-col justify-between w-full relative">
                <div class="flex flex-col sm:flex-row absolute top-2 right-2 sm:top-4 sm:right-4 space-y-2 sm:space-y-0 sm:space-x-3">
                  <a href="{{ route('edit', $artikel->id) }}">
                    <img src="{{ asset('images/edit.png') }}" alt="edit" class="w-4 h-4 hover:scale-110 transition duration-200">
                  </a>                
                  <form action="{{ route('destroy', $artikel->id) }}" method="POST" onsubmit="return confirm('Yakin mau hapus?')">
                    @csrf
                    @method('DELETE')
                    <button type="submit">
                      <img src="{{ asset('images/delete.png') }}" alt="delete" class="w-4 h-4 hover:scale-110 transition duration-200">
                    </button>
                  </form>
                </div>
              
                <div class="pr-10 sm:pr-0">
                  <p class="text-gray-500 text-xs mb-1 pr-10">{{ $artikel->category }} by {{ $artikel->author }}</p>
                  <h4 class="text-xl sm:text-2xl font-bold mb-3">{{ $artikel->title }}</h4>
                  <p class="text-gray-500 mb-4">{{ $artikel->excerpt ?? Str::limit(strip_tags($artikel->content), 100) }}</p>
                </div>
        
                <div class="flex justify-between text-xs text-gray-500">
                  <p>{{ $artikel->status }}</p>
                  @if ($artikel->status !== 'Draft' && $artikel->published_at)
                    <p>{{ \Carbon\Carbon::parse($artikel->published_at)->format('d F Y') }}</p>
                  @endif
                </div>                
              </div>
            </div>
          </div>
        @endforeach
      </div>
      </a>
    </div>
  </div>
</body>
</html>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <meta http-equiv="X-UA-Compatible" content="ie=edge" />
  <title>{{ $artikel->title }}</title>
  <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-gray-100 text-gray-800">

  <div class="bg-gray-900 text-white sticky top-0 z-50 shadow">
    <div class="container mx-auto px-4 py-4 flex justify-between items-center">
      <a href="{{ url('/') }}" class="text-2xl font-bold">BlmKepikiran</a>
      <a href="{{ url()->previous() }}" class="text-sm hover:text-gray-400">← Kembali</a>
    </div>
  </div>

  <div class="max-w-3xl mx-auto p-6 bg-white rounded-xl shadow mt-8 mb-10">
    <div>
      <img src="{{ asset('storage/' . $artikel->thumbnail) }}" alt="{{ $artikel->title }}" class="rounded-md mb-4 w-full h-64 object-cover" />
    </div>

    <div class="text-sm text-gray-500 mb-2">
      {{ $artikel->category }} by {{ $artikel->author }} • 
      {{ \Carbon\Carbon::parse($artikel->published_at)->format('d F Y') }}
    </div>

    <div>
      <h1 class="text-3xl font-bold mb-4">{{ $artikel->title }}</h1>
    </div>

    <div class="text-gray-700 leading-relaxed prose max-w-none">
      {!! $artikel->content !!}
    </div>
  </div>

</body>
</html>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Edit Artikel</title>
    <script src="https://cdn.jsdelivr.net/npm/@tailwindcss/browser@4"></script>
    <script src="https://cdn.ckeditor.com/ckeditor5/34.0.0/classic/ckeditor.js"></script>
</head>

<body class="bg-gray-50 m-0 p-0">
    <header class="bg-gradient-to-r from-blue-200 to-blue-300 to bg-blue-500 sticky top-0 z-50 shadow">
      <nav class="container mx-auto px-4 py-4 flex justify-between items-center text-blue-950">
        <a href="#" class="text-2xl sm:text-3xl font-bold">Artikelia</a>
        <ul class="flex space-x-4 sm:space-x-6 items-center text-sm sm:text-base">
          <li><a href="{{ route('admin.dashboard') }}" class="hover:underline font-semibold">Kembali</a></li>
          <li><a href="#" class="px-4 py-1 border border-blue-950 rounded-xl font-semibold hover:bg-blue-200 hover:text-blue-950 transition">Logout</a></li>
        </ul>
      </nav>
    </header>

    <div class="max-w-3xl mx-auto mt-10 mb-16 bg-white p-8 rounded-2xl shadow">
        <h1 class="text-3xl font-bold text-center mb-10">Edit Artikel</h1>

        @if (session('success'))
            <div class="bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded-lg mb-6 flex items-center gap-2">
                <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 flex-shrink-0" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7" />
                </svg>
                <span>{{ session('success') }}</span>
            </div>
        @endif

        @if ($errors->any())
            <div class="bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded-lg mb-6">
                <strong class="font-semibold">Ada error:</strong>
                <ul class="mt-2 list-disc list-inside space-y-1">
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <form action="{{ route('update', $artikel->id) }}" method="POST" enctype="multipart/form-data" class="space-y-6" id="editForm">
            @csrf
            @method('PUT')

            <div>
                <label for="title" class="font-semibold block mb-1">Judul Artikel</label>
                <input type="text" id="title" name="title" required class="w-full p-3 border rounded-lg" value="{{ old('title', $artikel->title) }}">
                @error('title')
                    <span class="text-red-500 text-sm">{{ $message }}</span>
                @enderror
            </div>

            <div>
                <label for="slug" class="font-semibold block mb-1">Slug</label>
                <input type="text" id="slug" name="slug" required class="w-full p-3 border rounded-lg" value="{{ old('slug', $artikel->slug) }}">
                @error('slug')
                    <span class="text-red-500 text-sm">{{ $message }}</span>
                @enderror
            </div>

            <div>
                <label for="content" class="font-semibold block mb-1">Konten</label>
                <textarea id="content" name="content" class="w-full p-3 border rounded-lg min-h-[200px]">{{ old('content', $artikel->content) }}</textarea>
                @error('content')
                    <span class="text-red-500 text-sm">{{ $message }}</span>
                @enderror
            </div>

            <div>
                <label for="excerpt" class="font-semibold block mb-1">Ringkasan Artikel (Opsional)</label>
                <input type="text" id="excerpt" name="excerpt" class="w-full p-3 border rounded-lg" value="{{ old('excerpt', $artikel->excerpt) }}">
                @error('excerpt')
                    <span class="text-red-500 text-sm">{{ $message }}</span>
                @enderror
            </div>

            <div>
                <label for="thumbnail" class="font-semibold block mb-1">Thumbnail Baru (opsional)</label>
                <input type="file" id="thumbnail" name="thumbnail" class="w-full p-3 border rounded-lg">
                @if ($artikel->thumbnail)
                    <p class="text-sm mt-1">Thumbnail saat ini: <a href="{{ asset('storage/' . $artikel->thumbnail) }}" target="_blank" class="underline text-blue-600">Lihat Gambar</a></p>
                @endif
                @error('thumbnail')
                    <span class="text-red-500 text-sm">{{ $message }}</span>
                @enderror
            </div>

            <div>
                <label for="category" class="font-semibold block mb-1">Kategori</label>
                <select id="category" name="category" class="w-full p-3 border rounded-lg">
                    @foreach(['Edukasi', 'Ulasan', 'Tutorial', 'Berita', 'Hiburan'] as $kategori)
                        <option value="{{ $kategori }}" {{ old('category', $artikel->category) == $kategori ? 'selected' : '' }}>{{ $kategori }}</option>
                    @endforeach
                </select>
                @error('category')
                    <span class="text-red-500 text-sm">{{ $message }}</span>
                @enderror
            </div>

            <div>
                <label for="author" class="font-semibold block mb-1">Author</label>
                <input type="text" id="author" name="author" class="w-full p-3 border rounded-lg" value="{{ old('author', $artikel->author) }}">
                @error('author')
                    <span class="text-red-500 text-sm">{{ $message }}</span>
                @enderror
            </div>

            <div>
                <label for="status" class="font-semibold block mb-1">Status</label>
                <select id="status" name="status" class="w-full p-3 border rounded-lg">
                    <option value="Draft" {{ old('status', $artikel->status) === 'Draft' ? 'selected' : '' }}>Draft</option>
                    <option value="Published" {{ old('status', $artikel->status) === 'Published' ? 'selected' : '' }}>Published</option>
                    <option value="Archived" {{ old('status', $artikel->status) === 'Archived' ? 'selected' : '' }}>Archived</option>
                </select>
                @error('status')
                    <span class="text-red-500 text-sm">{{ $message }}</span>
                @enderror
            </div>

            <div id="tanggal-wrapper" class="hidden">
                <label for="published_at" class="font-semibold block mb-1">Tanggal Published</label>
                <input type="date" id="published_at" name="published_at" class="w-full p-3 border rounded-lg"
                    value="{{ old('published_at', $artikel->published_at ? date('Y-m-d', strtotime($artikel->published_at)) : '') }}">
                @error('published_at')
                    <span class="text-red-500 text-sm">{{ $message }}</span>
                @enderror
            </div>

            <div class="pt-2">
                <button type="submit" id="saveButton" class="bg-gray-900 text-white px-6 py-3 rounded-lg hover:bg-gray-700 transition" disabled>Simpan Artikel</button>
            </div>
        </form>
    </div>

    
    <script>
        let form = document.getElementById('editForm');
        let saveButton = document.getElementById('saveButton');
        let initialData = new FormData(form);

        form.addEventListener('input', () => {
            saveButton.disabled = ![...new FormData(form)].some(([key, value]) => value !== initialData.get(key));
        });

        ClassicEditor.create(document.querySelector('#content')).catch(console.error);
        
        const statusSelect = document.getElementById("status");
        const tanggalWrapper = document.getElementById("tanggal-wrapper");

        function toggleTanggal() {
            const selectedStatus = statusSelect.value;
            if (selectedStatus === 'Published' || selectedStatus === 'Archived') {
                tanggalWrapper.classList.remove('hidden');
            } else {
                tanggalWrapper.classList.add('hidden');
            }
        }
        toggleTanggal();
        statusSelect.addEventListener("change", toggleTanggal);
    </script>
</body>
</html>

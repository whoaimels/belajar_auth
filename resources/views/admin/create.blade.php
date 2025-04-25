<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Create New Article</title>
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

    <main class="max-w-3xl mx-auto mt-10 mb-16 bg-white p-8 rounded-2xl shadow">
        <h1 class="text-3xl font-bold text-center mb-10">Buat Artikelmu!</h1>

        <form action="{{ route('store') }}" method="POST" enctype="multipart/form-data" class="space-y-6">
            @csrf

            <div>
                <label for="title" class="font-semibold block mb-1">Judul Artikel</label>
                <input type="text" id="title" name="title" required class="w-full p-3 border rounded-lg" value="{{ old('title') }}">
                @error('title')
                    <span class="text-red-500 text-sm">{{ $message }}</span>
                @enderror
            </div>

            <div>
                <label for="slug" class="font-semibold block mb-1">Slug</label>
                <input type="text" id="slug" name="slug" required class="w-full p-3 border rounded-lg" value="{{ old('slug') }}">
                @error('slug')
                    <span class="text-red-500 text-sm">{{ $message }}</span>
                @enderror
            </div>

            <div>
                <label for="content" class="font-semibold block mb-1">Konten</label>
                <textarea id="content" name="content" class="w-full p-3 border rounded-lg min-h-[200px]">{{ old('content') }}</textarea>
                @error('content')
                    <span class="text-red-500 text-sm">{{ $message }}</span>
                @enderror
            </div>

            <div>
                <label for="excerpt" class="font-semibold block mb-1">Ringkasan Artikel (Opsional)</label>
                <input type="text" id="excerpt" name="excerpt" class="w-full p-3 border rounded-lg" value="{{ old('excerpt') }}">
                @error('excerpt')
                    <span class="text-red-500 text-sm">{{ $message }}</span>
                @enderror
            </div>

            <div>
                <label for="thumbnail" class="font-semibold block mb-1">Thumbnail</label>
                <input type="file" id="thumbnail" name="thumbnail" required class="w-full p-3 border rounded-lg">
                @error('thumbnail')
                    <span class="text-red-500 text-sm">{{ $message }}</span>
                @enderror
            </div>

            <div>
                <label for="category" class="font-semibold block mb-1">Kategori</label>
                <select id="category" name="category" class="w-full p-3 border rounded-lg">
                    <option value="Edukasi" {{ old('category') == 'Edukasi' ? 'selected' : '' }}>Edukasi</option>
                    <option value="Ulasan" {{ old('category') == 'Ulasan' ? 'selected' : '' }}>Ulasan</option>
                    <option value="Tutorial" {{ old('category') == 'Tutorial' ? 'selected' : '' }}>Tutorial</option>
                    <option value="Berita" {{ old('category') == 'Berita' ? 'selected' : '' }}>Berita</option>
                    <option value="Hiburan" {{ old('category') == 'Hiburan' ? 'selected' : '' }}>Hiburan</option>
                </select>
                @error('category')
                    <span class="text-red-500 text-sm">{{ $message }}</span>
                @enderror
            </div>

            <div>
                <label for="author" class="font-semibold block mb-1">Author</label>
                <input type="text" id="author" name="author" class="w-full p-3 border rounded-lg" value="{{ old('author') }}">
                @error('author')
                    <span class="text-red-500 text-sm">{{ $message }}</span>
                @enderror
            </div>

            <div>
                <label for="status" class="font-semibold block mb-1">Status</label>
                <select id="status" name="status" class="w-full p-3 border rounded-lg">
                    <option value="Draft" {{ old('status') == 'Draft' ? 'selected' : '' }}>Draft</option>
                    <option value="Published" {{ old('status') == 'Published' ? 'selected' : '' }}>Published</option>
                    <option value="Archived" {{ old('status') == 'Archived' ? 'selected' : '' }}>Archived</option>
                </select>
                @error('status')
                    <span class="text-red-500 text-sm">{{ $message }}</span>
                @enderror
            </div>

            <div id="tanggal-wrapper" class="hidden">
                <label for="published_at" class="font-semibold block mb-1">Tanggal Published</label>
                <input type="date" id="published_at" name="published_at" class="w-full p-3 border rounded-lg" value="{{ old('published_at') }}">
                @error('published_at')
                    <span class="text-red-500 text-sm">{{ $message }}</span>
                @enderror
            </div>
            

            <div class="pt-2">
                <button type="submit" class="bg-gray-900 text-white px-6 py-3 rounded-lg hover:bg-gray-700 transition">Simpan Artikel</button>
            </div>
        </form>
    </main>

    <script>
        ClassicEditor
            .create(document.querySelector('#content'))
            .catch(error => console.error(error));

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

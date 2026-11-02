
<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Form Input Kategori</title>
</head>
<body>
    <h1>Form Input Kategori</h1>

    <form action="{{ route('categories.store') }}" method="POST">
        @csrf

        <label>Nama Kategori</label>
        <input type="text" name="name" value="{{ old('name') }}" required>
        @error('name')
            <p>{{ $message }}</p>
        @enderror

        <br><br>

        <label>Deskripsi</label>
        <textarea name="description">{{ old('description') }}</textarea>

        <br><br>
        <button type="submit">Simpan</button>
    </form>
</body>
</html>
      
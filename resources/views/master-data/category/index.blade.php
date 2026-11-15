
<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Data Kategori</title>
</head>
<body>
    <h1>Data Kategori</h1>

    @if (session('success'))
        <p>{{ session('success') }}</p>
    @endif

    <p>
        <a href="{{ route('categories.create') }}">+ Tambah Kategori</a>
    </p>

    <table border="1" cellpadding="10">
        <thead>
            <tr>
                <th>No.</th>
                <th>Nama Kategori</th>
                <th>Deskripsi</th>
            </tr>
        </thead>
        <tbody>
            @forelse ($categories as $category)
                <tr>
                    <td>{{ $loop->iteration }}</td>
                    <td>{{ $category->name }}</td>
                    <td>{{ $category->description ?? '-' }}</td>
                </tr>
            @empty
                <tr>
                    <td colspan="3">Belum ada kategori.</td>
                </tr>
            @endforelse
        </tbody>
    </table>
</body>
</html>

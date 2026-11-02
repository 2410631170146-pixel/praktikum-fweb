
<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Data Kategori</title>
</head>
<body>
    <h1>Data Kategori</h1>

    @if (session('success'))
        <p>{{ session('success') }}</p>
    @endif

    <p>
        <a href="{{ route('categories.create') }}">
            + Tambah Kategori
        </a>
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
            <tr>
                <td>1</td>
                <td>Contoh Makanan</td>
                <td>Kategori produk makanan</td>
            </tr>
        </tbody>
    </table>
</body>
</html>

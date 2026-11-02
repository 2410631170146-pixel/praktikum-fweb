
<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Data Produk</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body class="bg-light">
<div class="container py-5">

    <div class="d-flex justify-content-between align-items-center mb-4">
        <h1>Data Produk</h1>
        <a href="{{ route('products.create') }}" class="btn btn-primary">
            + Tambah Produk
        </a>
    </div>

    @if (session('success'))
        <div class="alert alert-success">
            {{ session('success') }}
        </div>
    @endif

    @if ($errors->any())
        <div class="alert alert-danger">
            <ul class="mb-0">
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <div class="card shadow-sm mb-4">
        <div class="card-body">
            <form action="{{ route('products.index') }}" method="GET">
                <div class="row g-3">
                    <div class="col-md-5">
                        <label class="form-label">Cari Produk</label>
                        <input
                            type="text"
                            name="search"
                            class="form-control"
                            placeholder="Nama atau kode produk"
                            value="{{ request('search') }}"
                        >
                    </div>

                    <div class="col-md-4">
                        <label class="form-label">Kategori</label>
                        <select name="category_id" class="form-select">
                            <option value="">Semua Kategori</option>
                            @foreach ($categories as $category)
                                <option
                                    value="{{ $category->id }}"
                                    @selected(request('category_id') == $category->id)
                                >
                                    {{ $category->name }}
                                </option>
                            @endforeach
                        </select>
                    </div>

                    <div class="col-md-3 d-flex align-items-end gap-2">
                        <button type="submit" class="btn btn-primary">Cari</button>
                        <a href="{{ route('products.index') }}" class="btn btn-secondary">Reset</a>
                    </div>
                </div>
            </form>
        </div>
    </div>

    <div class="card shadow-sm">
        <div class="card-body table-responsive">
            <table class="table table-bordered table-striped align-middle">
                <thead class="table-dark">
                    <tr>
                        <th>No.</th>
                        <th>Kode Produk</th>
                        <th>Nama Produk</th>
                        <th>Kategori</th>
                        <th>Harga</th>
                        <th>Stok</th>
                        <th>Status</th>
                        <th>Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse ($products as $product)
                        <tr>
                            <td>{{ $products->firstItem() + $loop->index }}</td>
                            <td>{{ $product->code }}</td>
                            <td>{{ $product->name }}</td>
                            <td>{{ $product->category->name ?? '-' }}</td>
                            <td>Rp{{ number_format($product->price, 0, ',', '.') }}</td>
                            <td>{{ $product->stock }}</td>
                            <td>
                                @if ($product->stock <= 0)
                                    <span class="badge bg-danger">Habis</span>
                                @elseif ($product->stock < 10)
                                    <span class="badge bg-warning text-dark">Stok Menipis</span>
                                @else
                                    <span class="badge bg-success">Tersedia</span>
                                @endif
                            </td>
                            <td>
                                <div class="d-flex gap-2">
                                    <a
                                        href="{{ route('products.edit', $product->id) }}"
                                        class="btn btn-warning btn-sm"
                                    >Edit</a>

                                    <form
                                        action="{{ route('products.destroy', $product->id) }}"
                                        method="POST"
                                        onsubmit="return confirm('Yakin ingin menghapus produk ini?')"
                                    >
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="btn btn-danger btn-sm">
                                            Hapus
                                        </button>
                                    </form>
                                </div>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="8" class="text-center">
                                Data produk tidak ditemukan.
                            </td>
                        </tr>
                    @endforelse
                </tbody>
            </table>

            {{ $products->links() }}
        </div>
    </div>
</div>
</body>
</html>

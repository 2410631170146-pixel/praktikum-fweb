<!DOCTYPE html>
<html>
<head>
    <title>Test Badge Stok</title>

    <link
        href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css"
        rel="stylesheet"
    >
</head>

<body class="p-5">

    <h2>Status Stok Menu</h2>

    <div class="mt-4">
        <p>Stok banyak:
            <x-badge status="Aman" />
        </p>

        <p>Stok sedikit:
            <x-badge status="Menipis" />
        </p>

        <p>Stok kosong:
            <x-badge status="Habis" />
        </p>
    </div>

</body>
</html>
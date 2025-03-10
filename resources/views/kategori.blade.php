<!DOCTYPE html>
<html>

<head>
    <title>Data Kategori Barang</title>
</head>

<body>
    <ul class="navbar-nav">
        <li class="nav-item">
            <a class="nav-link" href="{{ route('kategori.index') }}">Manage Kategori</a>
        </li>
    </ul>

    <h1>Data Kategori Barang</h1>
    <table border="1" cellpadding="2" cellspacing="0">
        <tr>
            <th>ID</th>
            <th>Kode kategori</th>
            <th>Nama kategori</th>
        </tr>
        @foreach ($data as $d)
            <tr>
                <td>{{ $d->kategori_id }}</td>
                <td>{{ $d->kategori_kode }}</td>
                <td>{{ $d->kategori_nama }}</td>
            </tr>
        @endforeach
    </table>
</body>

</html>

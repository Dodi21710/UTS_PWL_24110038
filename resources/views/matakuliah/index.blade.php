<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Data Mata Kuliah</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body class="bg-light">

<div class="container mt-5">
    <h2>Data Mata Kuliah</h2>

    @if(session('success'))
        <div class="alert alert-success">
            {{ session('success') }}
        </div>
    @endif

    <a href="{{ route('matakuliah.create') }}"
       class="btn btn-primary mb-3">
        + Tambah Mata Kuliah
    </a>

    <table class="table table-bordered table-striped bg-white">
        <thead class="table-dark">
            <tr>
                <th>No</th>
                <th>Kode</th>
                <th>Nama Mata Kuliah</th>
                <th>Aksi</th>
            </tr>
        </thead>

        <tbody>
            @forelse($matakuliahs as $key => $mk)
            <tr>
                <td>{{ $key + 1 }}</td>
                <td>{{ $mk->kode }}</td>
                <td>{{ $mk->nama_matakuliah }}</td>
                <td>
                    <a href="{{ route('matakuliah.edit', $mk->id) }}"
                       class="btn btn-warning btn-sm">
                        Edit
                    </a>

                    <form action="{{ route('matakuliah.destroy', $mk->id) }}"
                          method="POST"
                          class="d-inline"
                          onsubmit="return confirm('Yakin ingin menghapus?')">

                        @csrf
                        @method('DELETE')

                        <button class="btn btn-danger btn-sm">
                            Hapus
                        </button>
                    </form>
                </td>
            </tr>
            @empty
            <tr>
                <td colspan="4" class="text-center">
                    Belum ada data mata kuliah.
                </td>
            </tr>
            @endforelse
        </tbody>
    </table>
</div>

</body>
</html>
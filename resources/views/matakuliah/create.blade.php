<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Tambah Mata Kuliah</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body class="bg-light">

<div class="container mt-5">
    <div class="card p-4">
        <h3>Tambah Mata Kuliah</h3>

        <form action="{{ route('matakuliah.store') }}" method="POST">
            @csrf

            <div class="mb-3">
                <label>Kode Mata Kuliah</label>
                <input type="text" name="kode" class="form-control"
                       value="{{ old('kode') }}" required>
                @error('kode')
                    <small class="text-danger">{{ $message }}</small>
                @enderror
            </div>

            <div class="mb-3">
                <label>Nama Mata Kuliah</label>
                <input type="text" name="nama_matakuliah"
                       class="form-control"
                       value="{{ old('nama_matakuliah') }}" required>
                @error('nama_matakuliah')
                    <small class="text-danger">{{ $message }}</small>
                @enderror
            </div>

            <button class="btn btn-primary">Simpan</button>
            <a href="{{ route('matakuliah.index') }}"
               class="btn btn-secondary">Kembali</a>
        </form>
    </div>
</div>

</body>
</html>
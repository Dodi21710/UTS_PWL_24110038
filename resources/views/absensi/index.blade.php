<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Data Absensi</title>

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css"
          rel="stylesheet">
</head>

<body class="bg-light">

<div class="container mt-5">

    <h2 class="mb-4">Form Absensi Mahasiswa</h2>
    ```html
<!-- FILTER ABSENSI -->
<div class="card shadow-sm p-4 mb-4">
    <h5 class="mb-3">Filter Absensi</h5>

    <form action="{{ route('absensi.index') }}" method="GET">
        <div class="row">

            <!-- DatePicker -->
            <div class="col-md-5 mb-3">
                <label class="form-label">Tanggal Absensi</label>
                <input
                    type="date"
                    name="tanggal"
                    class="form-control"
                    value="{{ $tanggal }}"
                    required
                >
            </div>

            <!-- ComboBox Nama Mata Kuliah -->
            <div class="col-md-5 mb-3">
                <label class="form-label">Nama Mata Kuliah</label>

                <select name="matakuliah_id"
                        class="form-select"
                        required>

                    <option value="">-- Pilih Mata Kuliah --</option>

                    @foreach($matakuliahs as $mk)
                        <option value="{{ $mk->id }}"
                            {{ $matakuliah_id == $mk->id ? 'selected' : '' }}>

                            {{ $mk->nama_matakuliah }}

                        </option>
                    @endforeach

                </select>
            </div>

            <!-- Tombol Tampilkan -->
            <div class="col-md-2 mb-3 d-flex align-items-end">
                <button type="submit" class="btn btn-primary w-100">
                    Tampilkan
                </button>
            </div>

        </div>
    </form>
</div>
```

    @if(session('success'))
        <div class="alert alert-success">
            {{ session('success') }}
        </div>
    @endif

    @if($errors->any())
        <div class="alert alert-danger">
            Periksa kembali data absensi yang kamu masukkan.
            <ul class="mb-0">
                @foreach($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <!-- FORM FILTER TANGGAL DAN MATA KULIAH -->
    <div class="card p-4 mb-4">

        <h5>Filter Absensi</h5>

        <form action="{{ route('absensi.index') }}" method="GET">

            <div class="row">

                <div class="col-md-5 mb-3">
                    <label class="form-label">Tanggal Absensi</label>

                    <input type="date"
                           name="tanggal"
                           class="form-control"
                           value="{{ $tanggal }}"
                           required>
                </div>

                <div class="col-md-5 mb-3">
                    <label class="form-label">Mata Kuliah</label>

                    <select name="matakuliah_id"
                            class="form-select"
                            required>

                        <option value="">-- Pilih Mata Kuliah --</option>

                        @foreach($matakuliahs as $mk)
                            <option value="{{ $mk->id }}"
                                {{ $matakuliah_id == $mk->id ? 'selected' : '' }}>

                                {{ $mk->kode }} - {{ $mk->nama_matakuliah }}

                            </option>
                        @endforeach

                    </select>
                </div>

                <div class="col-md-2 mb-3 d-flex align-items-end">

                    <button type="submit" class="btn btn-primary w-100">
                        Tampilkan
                    </button>

                </div>

            </div>

        </form>

    </div>

    <!-- FORM INPUT ABSENSI -->
    @if($matakuliah_id)

    <div class="card p-4 mb-4">

        <h5>Input Absensi Mahasiswa</h5>

        <form action="{{ route('absensi.store') }}" method="POST">

            @csrf

            <input type="hidden"
                   name="tanggal_absensi"
                   value="{{ $tanggal }}">

            <input type="hidden"
                   name="matakuliah_id"
                   value="{{ $matakuliah_id }}">

            <table class="table table-bordered table-striped mt-3">

                <thead class="table-dark">
                    <tr>
                        <th>No</th>
                        <th>NIM</th>
                        <th>Nama Mahasiswa</th>
                        <th>Status Kehadiran</th>
                    </tr>
                </thead>

                <tbody>

                    @forelse($mahasiswas as $key => $mahasiswa)

                    @php
                        $dataAbsensi = $absensis->firstWhere(
                            'mahasiswa_id',
                            $mahasiswa->id
                        );
                    @endphp

                    <tr>
                        <td>{{ $key + 1 }}</td>

                        <td>{{ $mahasiswa->NIM }}</td>

                        <td>{{ $mahasiswa->name }}</td>

                        <td>
                            <select
                                name="status[{{ $mahasiswa->id }}]"
                                class="form-select"
                                required>

                                <option value="H"
                                    {{ ($dataAbsensi->status_absen ?? '') == 'H' ? 'selected' : '' }}>
                                    Hadir
                                </option>

                                <option value="A"
                                    {{ ($dataAbsensi->status_absen ?? '') == 'A' ? 'selected' : '' }}>
                                    Alpha
                                </option>

                                <option value="I"
                                    {{ ($dataAbsensi->status_absen ?? '') == 'I' ? 'selected' : '' }}>
                                    Izin
                                </option>

                                <option value="S"
                                    {{ ($dataAbsensi->status_absen ?? '') == 'S' ? 'selected' : '' }}>
                                    Sakit
                                </option>

                            </select>
                        </td>
                    </tr>

                    @empty

                    <tr>
                        <td colspan="4" class="text-center">
                            Belum ada data mahasiswa.
                        </td>
                    </tr>

                    @endforelse

                </tbody>

            </table>

            @if($mahasiswas->count() > 0)
                <button type="submit" class="btn btn-success">
                    Simpan Absensi
                </button>
            @endif

        </form>

    </div>

    @endif

</div>



</body>
</html>
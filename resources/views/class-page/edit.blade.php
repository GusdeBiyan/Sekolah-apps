@extends('layout.app', [
    'namePage' => 'Data-Kelas',
])
@section('title', 'Sekolah | Edit Data Kelas')
@section('content')
    <div class="content">
        <div class="container-fluid">
            <div class="col-md-4 mb-3">
                <h4 for="class_id" class="form-label">Edit Data Kelas</h4>

            </div>
            <div class="row">
                <div class="col">
                    <div class="card">
                        <div class="card-body">
                            <form action="{{ route('class.update', ['id' => $kelas->id]) }}" method="POST">
                                @csrf
                                @method('PUT')


                                <div class="form-group">
                                    <label for="nama_kelas-{{ $kelas->id }}">Nama</label>
                                    <input type="text" name="nama_kelas"
                                        class="form-control @error('nama_kelas') is-invalid @enderror"
                                        id="nama_kelas-{{ $kelas->id }}"
                                        value="{{ old('nama_kelas', $kelas->nama_kelas) }}" required>
                                    @error('nama_kelas')
                                        <div class="invalid-feedback">
                                            {{ $message }}
                                        </div>
                                    @enderror
                                </div>

                                <div class="form-group">
                                    <label for="kode_kelas-{{ $kelas->id }}">Kode Kelas</label>
                                    <input type="text" name="kode_kelas"
                                        class="form-control @error('kode_kelas') is-invalid @enderror"
                                        id="kode_kelas-{{ $kelas->id }}"
                                        value="{{ old('kode_kelas', $kelas->kode_kelas) }}" required>
                                    @error('kode_kelas')
                                        <div class="invalid-feedback">
                                            {{ $message }}
                                        </div>
                                    @enderror
                                </div>


                                <button type="submit" class="btn btn-primary">Update</button>

                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script>
        document.getElementById('nama_kelas-{{ $kelas->id }}').addEventListener('input', function() {
            this.value = this.value.toUpperCase();
        });
    </script>

    <script>
        document.getElementById('kode_kelas-{{ $kelas->id }}').addEventListener('input', function() {
            this.value = this.value.toUpperCase();
        });
    </script>

@endsection

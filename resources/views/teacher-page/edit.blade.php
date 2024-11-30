@extends('layout.app', [
    'namePage' => 'Data-Guru',
])
@section('title', 'Sekolah | Edit Data Guru')
@section('content')
    <div class="content">
        <div class="container-fluid">
            <div class="col-md-4 mb-3">
                <h4 for="class_id" class="form-label">Edit Data Guru</h4>

            </div>
            <div class="row">
                <div class="col">
                    <div class="card">
                        <div class="card-body">
                            <form action="{{ route('teacher.update', ['id' => $teacher->id]) }}" method="POST">
                                @csrf
                                @method('PUT')

                                <div class="form-group">
                                    <label for="nama">Nama</label>
                                    <input type="text" name="nama" id="nama"
                                        class="form-control @error('nama') is-invalid @enderror"
                                        value="{{ old('nama', $teacher->nama) }}" required>
                                    @error('nama')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>

                                <div class="form-group">
                                    <label for="email">Email</label>
                                    <input type="email" name="email" id="email"
                                        class="form-control @error('email') is-invalid @enderror"
                                        value="{{ old('email', $teacher->email) }}" required>
                                    @error('email')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                                <div class="form-group">
                                    <label for="nip">NIP</label>
                                    <input type="text" name="nip" id="nip"
                                        class="form-control @error('nip') is-invalid @enderror"
                                        value="{{ old('nip', $teacher->nip) }}" required>
                                    @error('nip')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>

                                <div class="form-group">
                                    <label for="mata_pelajaran">Mata Pelajaran</label>
                                    <input type="text" name="mata_pelajaran" id="mata_pelajaran"
                                        class="form-control @error('mata_pelajaran') is-invalid @enderror"
                                        value="{{ old('mata_pelajaran', $teacher->mata_pelajaran) }}">
                                    @error('mata_pelajaran')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>


                                <div class="row">
                                    <div class="col">
                                        <div class="form-group">
                                            <label for="class_id">Kelas</label>
                                            <select name="class_id" id="class_id"
                                                class="form-control @error('class_id') is-invalid @enderror" required>
                                                <option value="{{ $teacher->class_id }}">{{ $teacher->kelas->nama_kelas }}
                                                </option>
                                                @foreach ($kelas as $class)
                                                    <option value="{{ $class->id }}">{{ $class->nama_kelas }}
                                                    </option>
                                                @endforeach
                                            </select>
                                            @error('class_id')
                                                <div class="invalid-feedback">{{ $message }}</div>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="col">
                                        <div class="form-group">
                                            <label for="status">Status</label>
                                            <select name="status" id="status"
                                                class="form-control @error('status') is-invalid @enderror" required>
                                                <option value="{{ $teacher->status }}">{{ $teacher->status }}</option>
                                                <option value="aktif">Aktif</option>
                                                <option value="non-aktif">Non-aktif
                                                </option>
                                            </select>
                                            @error('status')
                                                <div class="invalid-feedback">{{ $message }}</div>
                                            @enderror
                                        </div>
                                    </div>
                                </div>

                                <div class="form-group">
                                    <label for="nomor_telepon">Nomor Telepon</label>
                                    <input type="text" name="nomor_telepon" id="nomor_telepon"
                                        class="form-control @error('nomor_telepon') is-invalid @enderror"
                                        value="{{ old('nomor_telepon', $teacher->nomor_telepon) }}">
                                    @error('nomor_telepon')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>

                                <div class="form-group">
                                    <label for="alamat">Alamat</label>
                                    <textarea name="alamat" id="alamat" class="form-control @error('alamat') is-invalid @enderror">{{ old('alamat', $teacher->alamat) }}</textarea>
                                    @error('alamat')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>

                                <div class="row">
                                    <div class="col">

                                        <div class="form-group">
                                            <label for="tanggal_lahir">Tanggal Lahir</label>
                                            <input type="date" name="tanggal_lahir" id="tanggal_lahir"
                                                class="form-control @error('tanggal_lahir') is-invalid @enderror"
                                                value="{{ old('tanggal_lahir', $teacher->tanggal_lahir) }}" required>
                                            @error('tanggal_lahir')
                                                <div class="invalid-feedback">{{ $message }}</div>
                                            @enderror
                                        </div>
                                    </div>

                                    <div class="col">

                                        <div class="form-group">
                                            <label for="jenis_kelamin">Jenis Kelamin</label>
                                            <select name="jenis_kelamin"
                                                class="form-control @error('jenis_kelamin') is-invalid @enderror"
                                                id="jenis_kelamin-{{ $teacher->id }}" required>
                                                <option value="L"
                                                    {{ old('jenis_kelamin', $teacher->jenis_kelamin) == 'L' ? 'selected' : '' }}>
                                                    L</option>
                                                <option value="P"
                                                    {{ old('jenis_kelamin', $teacher->jenis_kelamin) == 'P' ? 'selected' : '' }}>
                                                    P</option>
                                            </select>
                                            @error('jenis_kelamin')
                                                <div class="invalid-feedback">{{ $message }}</div>
                                            @enderror
                                        </div>
                                    </div>
                                </div>


                                <button type="submit" class="btn btn-primary">Update</button>

                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

@endsection

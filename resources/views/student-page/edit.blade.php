@extends('layout.app', [
    'namePage' => 'Data-Siswa',
])
@section('title', 'Sekolah | Edit Data Siswa')
@section('content')
    <div class="content">
        <div class="container-fluid">
            <div class="col-md-4 mb-3">
                <h4 for="class_id" class="form-label">Edit Data Siswa</h4>

            </div>
            <div class="row">
                <div class="col">
                    <div class="card">
                        <div class="card-body">
                            <form action="{{ route('student.update', ['id' => $student->id]) }}" method="POST">
                                @csrf
                                @method('PUT')


                                <div class="form-group">
                                    <label for="nama-{{ $student->id }}">Nama</label>
                                    <input type="text" name="nama"
                                        class="form-control @error('nama') is-invalid @enderror"
                                        id="nama-{{ $student->id }}" value="{{ old('nama', $student->nama) }}" required>
                                    @error('nama')
                                        <div class="invalid-feedback">
                                            {{ $message }}
                                        </div>
                                    @enderror
                                </div>

                                <div class="form-group">
                                    <label for="nisn-{{ $student->id }}">NISN</label>
                                    <input type="text" name="nisn"
                                        class="form-control @error('nisn') is-invalid @enderror"
                                        id="nisn-{{ $student->id }}" value="{{ old('nisn', $student->nisn) }}" required>
                                    @error('nisn')
                                        <div class="invalid-feedback">
                                            {{ $message }}
                                        </div>
                                    @enderror
                                </div>

                                <div class="form-group">
                                    <label for="class_id-{{ $student->id }}">Kelas</label>
                                    <select name="class_id" id="class_id-{{ $student->id }}"
                                        class="form-control @error('class_id') is-invalid @enderror" required>
                                        @foreach ($kelas as $class)
                                            <option value="{{ $class->id }}"
                                                {{ old('class_id', $student->class_id) == $class->id ? 'selected' : '' }}>
                                                {{ $class->nama_kelas }}
                                            </option>
                                        @endforeach
                                    </select>
                                    @error('class_id')
                                        <div class="invalid-feedback">
                                            {{ $message }}
                                        </div>
                                    @enderror
                                </div>

                                <div class="form-group">
                                    <label for="email-{{ $student->id }}">Email</label>
                                    <input type="email" name="email"
                                        class="form-control @error('email') is-invalid @enderror"
                                        id="email-{{ $student->id }}" value="{{ old('email', $student->email) }}"
                                        required>
                                    @error('email')
                                        <div class="invalid-feedback">
                                            {{ $message }}
                                        </div>
                                    @enderror
                                </div>

                                <div class="form-group">
                                    <label for="tanggal_lahir-{{ $student->id }}">Tanggal Lahir</label>
                                    <input type="date" name="tanggal_lahir"
                                        class="form-control @error('tanggal_lahir') is-invalid @enderror"
                                        id="tanggal_lahir-{{ $student->id }}"
                                        value="{{ old('tanggal_lahir', $student->tanggal_lahir) }}" required>
                                    @error('tanggal_lahir')
                                        <div class="invalid-feedback">
                                            {{ $message }}
                                        </div>
                                    @enderror
                                </div>

                                <div class="form-group">
                                    <label for="jenis_kelamin-{{ $student->id }}">Jenis Kelamin</label>
                                    <select name="jenis_kelamin"
                                        class="form-control @error('jenis_kelamin') is-invalid @enderror"
                                        id="jenis_kelamin-{{ $student->id }}" required>
                                        <option value="L"
                                            {{ old('jenis_kelamin', $student->jenis_kelamin) == 'L' ? 'selected' : '' }}>
                                            L</option>
                                        <option value="P"
                                            {{ old('jenis_kelamin', $student->jenis_kelamin) == 'P' ? 'selected' : '' }}>
                                            P</option>
                                    </select>
                                    @error('jenis_kelamin')
                                        <div class="invalid-feedback">
                                            {{ $message }}
                                        </div>
                                    @enderror
                                </div>

                                <div class="form-group">
                                    <label for="alamat-{{ $student->id }}">Alamat</label>
                                    <textarea name="alamat" class="form-control @error('alamat') is-invalid @enderror" id="alamat-{{ $student->id }}"
                                        required>{{ old('alamat', $student->alamat) }}</textarea>
                                    @error('alamat')
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

@endsection

@extends('layout.app', [
    'namePage' => 'Data-Guru',
])
@section('title', 'Sekolah | Data Guru')
@section('content')


    @if (session('toast_message'))
        <script>
            const Toast = Swal.mixin({
                toast: true,
                position: "top-end",
                showConfirmButton: false,
                timer: 3000,
                timerProgressBar: true,
                didOpen: (toast) => {
                    toast.addEventListener('mouseenter', Swal.stopTimer);
                    toast.addEventListener('mouseleave', Swal.resumeTimer);
                }
            });


            Toast.fire({
                icon: "{{ session('toast_icon') }}",
                title: "{{ session('toast_message') }}"
            });
        </script>
    @endif

    <div class="content">
        <div class="container-fluid">
            <form action="{{ route('teachers.index') }}" method="GET">
                <div class="col-md-4 mb-3">
                    <h4 for="class_id" class="form-label">Data Guru</h4>
                    <select name="class_id" id="class_id" class="form-control" onchange="this.form.submit()">
                        <option value=""> Semua Kelas</option>
                        @foreach ($kelas as $class)
                            <option value="{{ $class->id }}" {{ request('class_id') == $class->id ? 'selected' : '' }}>
                                {{ $class->nama_kelas }}
                            </option>
                        @endforeach
                    </select>
                </div>
            </form>
            <div class="row">
                <div class="col">
                    <div class="card">
                        <div class="card-body">
                            <div class="card-sub">
                                <Button data-toggle="modal" data-target="#addTeacherModal"
                                    class="btn btn-primary btn-md">Tambah Data

                                </Button>
                            </div>
                            <table class="table" id="data-table">
                                <thead>
                                    <tr>
                                        <th scope="col">No</th>
                                        <th scope="col">Nama</th>
                                        <th scope="col">Mata Pelajaran</th>
                                        <th scope="col">Kelas</th>
                                        <th scope="col">Status</th>
                                        <th scope="col">NIP</th>
                                        <th class="text-right" scope="col">Action</th>



                                    </tr>
                                </thead>
                                <tbody>
                                    @forelse ($teachers as $item)
                                        <tr>
                                            <td scope="row">{{ $loop->iteration }}</td>
                                            <td>{{ $item->nama }}</td>
                                            <td>{{ $item->mata_pelajaran }}</td>
                                            <td>{{ $item->kelas->nama_kelas }}</td>
                                            <td class="{{ $item->status === 'aktif' ? 'text-success' : 'text-danger' }}">
                                                {{ $item->status }}
                                            </td>
                                            <td>{{ $item->nip }}</td>
                                            <td class="text-right">
                                                <button class="btn" type="button" id="actionDropdown"
                                                    data-toggle="dropdown" aria-expanded="false">
                                                    <i class="fas fa-ellipsis-v"></i>
                                                </button>
                                                <div class="dropdown-menu" aria-labelledby="navbarDropdown">
                                                    <a class="dropdown-item text-success" href="#" data-toggle="modal"
                                                        data-target="#showTeacherModal-{{ $item->id }}">View</a>
                                                    <a href="{{ route('teacher.edit', $item->id) }}"
                                                        class="dropdown-item text-warning">
                                                        Edit
                                                    </a>
                                                    <a class="dropdown-item text-danger delete-teacher" href="#"
                                                        data-teacher-id="{{ $item->id }}">
                                                        Delete
                                                    </a>
                                                </div>
                                            </td>
                                        </tr>
                                    @empty
                                        <tr>
                                            <td colspan="5" class="text-center">No teachers found</td>
                                        </tr>
                                    @endforelse

                                </tbody>
                            </table>
                        </div>
                    </div>

                </div>

            </div>
        </div>
    </div>

    <div class="modal fade" id="addTeacherModal" tabindex="-1" aria-labelledby="addTeacherModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <form action="{{ route('teacher.store') }}" method="POST">
                    @csrf
                    <div class="modal-header">
                        <h5 class="modal-title" id="addTeacherModalLabel">Tambah Data Guru</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <div class="form-group">
                            <label for="nama">Nama</label>
                            <input type="text" name="nama" id="nama"
                                class="form-control @error('nama') is-invalid @enderror" value="{{ old('nama') }}"
                                required>
                            @error('nama')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="form-group">
                            <label for="email">Email</label>
                            <input type="email" name="email" id="email"
                                class="form-control @error('email') is-invalid @enderror" value="{{ old('email') }}"
                                required>
                            @error('email')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                        <div class="form-group">
                            <label for="nip">NIP</label>
                            <input type="text" name="nip" id="nip"
                                class="form-control @error('nip') is-invalid @enderror" value="{{ old('nip') }}"
                                required>
                            @error('nip')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="form-group">
                            <label for="mata_pelajaran">Mata Pelajaran</label>
                            <input type="text" name="mata_pelajaran" id="mata_pelajaran"
                                class="form-control @error('mata_pelajaran') is-invalid @enderror"
                                value="{{ old('mata_pelajaran') }}">
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
                                        <option value="">Pilih Kelas</option>
                                        @foreach ($kelas as $class)
                                            <option value="{{ $class->id }}"
                                                {{ old('class_id') == $class->id ? 'selected' : '' }}>
                                                {{ $class->nama_kelas }}
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
                                        <option value="">Pilih Status</option>
                                        <option value="aktif" {{ old('status') == 'aktif' ? 'selected' : '' }}>Aktif
                                        </option>
                                        <option value="non-aktif" {{ old('status') == 'non-aktif' ? 'selected' : '' }}>
                                            Non-aktif</option>
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
                                value="{{ old('nomor_telepon') }}">
                            @error('nomor_telepon')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="form-group">
                            <label for="alamat">Alamat</label>
                            <textarea name="alamat" id="alamat" class="form-control @error('alamat') is-invalid @enderror">{{ old('alamat') }}</textarea>
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
                                        value="{{ old('tanggal_lahir') }}" required>
                                    @error('tanggal_lahir')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>

                            <div class="col">

                                <div class="form-group">
                                    <label for="jenis_kelamin">Jenis Kelamin</label>
                                    <select name="jenis_kelamin" id="jenis_kelamin"
                                        class="form-control @error('jenis_kelamin') is-invalid @enderror" required>
                                        <option value="">Pilih Jenis Kelamin</option>
                                        <option value="L" {{ old('jenis_kelamin') == 'L' ? 'selected' : '' }}>
                                            L</option>
                                        <option value="P" {{ old('jenis_kelamin') == 'P' ? 'selected' : '' }}>
                                            P</option>
                                    </select>

                                    @error('jenis_kelamin')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>
                        </div>




                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                        <button type="submit" class="btn btn-primary">Simpan</button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    @foreach ($teachers as $teacher)
        <div class="modal fade" id="showTeacherModal-{{ $teacher->id }}" tabindex="-1"
            aria-labelledby="showTeacherModalLabel-{{ $teacher->id }}" aria-hidden="true">
            <div class="modal-dialog modal-lg">
                <div class="modal-content">

                    <div class="modal-header">
                        <h5 class="modal-title" id="showTeacherModalLabel-{{ $teacher->id }}">View Data Siswa</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <!-- Form Input Data Siswa -->
                        <div class="form-group">
                            <label for="nama">Nama</label>
                            <input type="text" name="nama" id="nama"
                                class="form-control @error('nama') is-invalid @enderror" value="{{ $teacher->nama }}"
                                readonly>

                        </div>

                        <div class="form-group">
                            <label for="email">Email</label>
                            <input type="email" name="email" id="email"
                                class="form-control @error('email') is-invalid @enderror" value="{{ $teacher->email }}"
                                readonly>

                        </div>
                        <div class="form-group">
                            <label for="nip">NIP</label>
                            <input type="text" name="nip" id="nip"
                                class="form-control @error('nip') is-invalid @enderror" value="{{ $teacher->nip }}"
                                readonly>

                        </div>

                        <div class="form-group">
                            <label for="mata_pelajaran">Mata Pelajaran</label>
                            <input type="text" name="mata_pelajaran" id="mata_pelajaran"
                                class="form-control @error('mata_pelajaran') is-invalid @enderror"
                                value="{{ $teacher->mata_pelajaran }}" readonly>

                        </div>


                        <div class="row">
                            <div class="col">
                                <div class="form-group">
                                    <label for="class_id">Kelas</label>
                                    <input name="class_id" id="class_id" class="form-control"
                                        value="{{ $teacher->kelas->nama_kelas }}" readonly>
                                </div>
                            </div>
                            <div class="col">
                                <div class="form-group">
                                    <label for="status">Status</label>
                                    <input name="status" id="status"
                                        class="form-control @error('status') is-invalid @enderror"
                                        value="{{ $teacher->status }}"readonly>



                                </div>
                            </div>
                        </div>

                        <div class="form-group">
                            <label for="nomor_telepon">Nomor Telepon</label>
                            <input type="text" name="nomor_telepon" id="nomor_telepon"
                                class="form-control @error('nomor_telepon') is-invalid @enderror"
                                value="{{ $teacher->nomor_telepon }}" readonly>

                        </div>

                        <div class="form-group">
                            <label for="alamat">Alamat</label>
                            <textarea name="alamat" id="alamat" class="form-control @error('alamat') is-invalid @enderror" readonly>{{ $teacher->alamat }}</textarea>

                        </div>

                        <div class="row">
                            <div class="col">
                                <div class="form-group">
                                    <label for="tanggal_lahir">Tanggal Lahir</label>
                                    <input type="date" name="tanggal_lahir" id="tanggal_lahir"
                                        class="form-control @error('tanggal_lahir') is-invalid @enderror"
                                        value="{{ $teacher->tanggal_lahir }}" readonly>

                                </div>
                            </div>

                            <div class="col">

                                <div class="form-group">
                                    <label for="jenis_kelamin">Jenis Kelamin</label>
                                    <input name="jenis_kelamin" id="jenis_kelamin"
                                        class="form-control @error('jenis_kelamin') is-invalid @enderror"
                                        value="{{ $teacher->jenis_kelamin }}" readonly>


                                </div>
                            </div>
                        </div>



                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>

                    </div>

                </div>
            </div>
        </div>
    @endforeach


    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.1/jquery.min.js"></script>

    <script>
        $(document).ready(function() {
            var modal = $('#addTeacherModal');
            var modalErrors = modal.find('.invalid-feedback');

            if (modalErrors.length > 0) {
                modal.modal('show');
            }
        });
    </script>

    <script>
        document.addEventListener('click', function(event) {

            if (event.target.classList.contains('delete-teacher')) {
                event.preventDefault();

                var teacherId = event.target.getAttribute('data-teacher-id');


                Swal.fire({
                    title: 'Apakah Anda yakin?',
                    text: "Data yang dihapus tidak dapat dikembalikan!",
                    icon: 'warning',
                    showCancelButton: true,
                    confirmButtonColor: '#3085d6',
                    cancelButtonColor: '#d33',
                    confirmButtonText: 'Ya, hapus!'
                }).then((result) => {

                    if (result.isConfirmed) {

                        window.location.href = '/teacher/delete/' + teacherId;
                    }
                });
            }
        });
    </script>



@endsection

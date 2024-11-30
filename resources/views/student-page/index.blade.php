@extends('layout.app', [
    'namePage' => 'Data-Siswa',
])
@section('title', 'Sekolah | Data Siswa')
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
            <form action="{{ route('students.index') }}" method="GET">
                <div class="col-md-4 mb-3">
                    <h4 for="class_id" class="form-label">Data Siswa</h4>
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
                                <Button data-toggle="modal" data-target="#addStudentModal"
                                    class="btn btn-primary btn-md">Tambah Data

                                </Button>
                            </div>
                            <table class="table" id="data-table">
                                <thead>
                                    <tr>
                                        <th scope="col">No</th>
                                        <th scope="col">Nama</th>
                                        <th scope="col">NISN</th>
                                        <th scope="col">Jenis Kelamin</th>
                                        <th scope="col">Kelas</th>
                                        <th class="text-right" scope="col">Action</th>



                                    </tr>
                                </thead>
                                <tbody>
                                    @forelse ($students as $item)
                                        <tr>
                                            <td scope="row">{{ $loop->iteration }}</td>
                                            <td>{{ $item->nama }}</td>
                                            <td>{{ $item->nisn }}</td>
                                            <td>{{ $item->jenis_kelamin }}</td>
                                            <td>{{ $item->kelas->nama_kelas }}</td>
                                            <td class="text-right">
                                                <button class="btn" type="button" id="actionDropdown"
                                                    data-toggle="dropdown" aria-expanded="false">
                                                    <i class="fas fa-ellipsis-v"></i>
                                                </button>
                                                <div class="dropdown-menu" aria-labelledby="navbarDropdown">
                                                    <a class="dropdown-item text-success" href="#" data-toggle="modal"
                                                        data-target="#showStudentModal-{{ $item->id }}">View</a>
                                                    <a href="{{ route('student.edit', $item->id) }}"
                                                        class="dropdown-item text-warning">
                                                        Edit
                                                    </a>
                                                    <a class="dropdown-item text-danger delete-student" href="#"
                                                        data-student-id="{{ $item->id }}">
                                                        Delete
                                                    </a>
                                                </div>
                                            </td>
                                        </tr>
                                    @empty
                                        <tr>
                                            <td colspan="5" class="text-center">No students found</td>
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

    <div class="modal fade" id="addStudentModal" tabindex="-1" aria-labelledby="addStudentModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <form action="{{ route('student.store') }}" method="POST">
                    @csrf
                    <div class="modal-header">
                        <h5 class="modal-title" id="addStudentModalLabel">Tambah Data Siswa</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <!-- Form Input Data Siswa -->
                        <div class="form-group">
                            <label for="nama">Nama</label>
                            <input type="text" name="nama" class="form-control @error('nama') is-invalid @enderror"
                                id="nama" value="{{ old('nama') }}" required>
                            @error('nama')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="form-group">
                            <label for="nisn">NISN</label>
                            <input type="text" name="nisn" class="form-control @error('nisn') is-invalid @enderror"
                                id="nisn" value="{{ old('nisn') }}" required>
                            @error('nisn')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="form-group">
                            <label for="class_id">Kelas</label>
                            <select name="class_id" id="class_id"
                                class="form-control @error('class_id') is-invalid @enderror" required>
                                <option value="">Pilih Kelas</option>
                                @foreach ($kelas as $class)
                                    <option value="{{ $class->id }}"
                                        {{ old('class_id') == $class->id ? 'selected' : '' }}>{{ $class->nama_kelas }}
                                    </option>
                                @endforeach
                            </select>
                            @error('class_id')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="form-group">
                            <label for="email">Email</label>
                            <input type="email" name="email" class="form-control @error('email') is-invalid @enderror"
                                id="email" value="{{ old('email') }}" required>
                            @error('email')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="form-group">
                            <label for="tanggal_lahir">Tanggal Lahir</label>
                            <input type="date" name="tanggal_lahir"
                                class="form-control @error('tanggal_lahir') is-invalid @enderror" id="tanggal_lahir"
                                value="{{ old('tanggal_lahir') }}" required>
                            @error('tanggal_lahir')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="form-group">
                            <label for="jenis_kelamin">Jenis Kelamin</label>
                            <select name="jenis_kelamin" class="form-control @error('jenis_kelamin') is-invalid @enderror"
                                id="jenis_kelamin" required>
                                <option value="">Pilih Jenis Kelamin</option>
                                <option value="L" {{ old('jenis_kelamin') == 'L' ? 'selected' : '' }}>Laki-laki
                                </option>
                                <option value="P" {{ old('jenis_kelamin') == 'P' ? 'selected' : '' }}>Perempuan
                                </option>
                            </select>
                            @error('jenis_kelamin')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="form-group">
                            <label for="alamat">Alamat</label>
                            <textarea name="alamat" class="form-control @error('alamat') is-invalid @enderror" id="alamat" required>{{ old('alamat') }}</textarea>
                            @error('alamat')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
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

    @foreach ($students as $student)
        <div class="modal fade" id="showStudentModal-{{ $student->id }}" tabindex="-1"
            aria-labelledby="showStudentModalLabel-{{ $student->id }}" aria-hidden="true">
            <div class="modal-dialog modal-lg">
                <div class="modal-content">

                    <div class="modal-header">
                        <h5 class="modal-title" id="showStudentModalLabel-{{ $student->id }}">View Data Siswa</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <!-- Form Input Data Siswa -->
                        <div class="form-group">
                            <label for="nama_show-{{ $student->id }}">Nama</label>
                            <input type="text" name="nama_show"
                                class="form-control @error('nama_show') is-invalid @enderror"
                                id="nama_show-{{ $student->id }}" value="{{ old('nama_show', $student->nama) }}"
                                readonly>

                        </div>

                        <div class="form-group">
                            <label for="nisn_show-{{ $student->id }}">NISN</label>
                            <input type="text" name="nisn_show"
                                class="form-control @error('nisn_show') is-invalid @enderror"
                                id="nisn_show-{{ $student->id }}" value="{{ old('nisn_show', $student->nisn) }}"
                                readonly>

                        </div>

                        <div class="form-group">
                            <label for="class_id_show-{{ $student->id }}">Kelas</label>
                            <select name="class_id_show" id="class_id_show-{{ $student->id }}"
                                class="form-control @error('class_id_show') is-invalid @enderror" readonly>
                                @foreach ($kelas as $class)
                                    <option value="{{ $class->id }}"
                                        {{ old('class_id_show', $student->class_id) == $class->id ? 'selected' : '' }}>
                                        {{ $class->nama_kelas }}
                                    </option>
                                @endforeach
                            </select>

                        </div>

                        <div class="form-group">
                            <label for="email_show-{{ $student->id }}">Email</label>
                            <input type="email" name="email_show"
                                class="form-control @error('email_show') is-invalid @enderror"
                                id="email_show-{{ $student->id }}" value="{{ old('email_show', $student->email) }}"
                                readonly>

                        </div>

                        <div class="form-group">
                            <label for="tanggal_lahir_show-{{ $student->id }}">Tanggal Lahir</label>
                            <input type="date" name="tanggal_lahir_show"
                                class="form-control @error('tanggal_lahir_show') is-invalid @enderror"
                                id="tanggal_lahir_show-{{ $student->id }}"
                                value="{{ old('tanggal_lahir_show', $student->tanggal_lahir) }}" readonly>

                        </div>

                        <div class="form-group">
                            <label for="jenis_kelamin_show-{{ $student->id }}">Jenis Kelamin</label>
                            <select name="jenis_kelamin_show"
                                class="form-control @error('jenis_kelamin_show') is-invalid @enderror"
                                id="jenis_kelamin_show-{{ $student->id }}" readonly>
                                <option value="L"
                                    {{ old('jenis_kelamin_show', $student->jenis_kelamin) == 'L' ? 'selected' : '' }}>
                                    Laki-laki</option>
                                <option value="P"
                                    {{ old('jenis_kelamin_show', $student->jenis_kelamin) == 'P' ? 'selected' : '' }}>
                                    Perempuan</option>
                            </select>

                        </div>

                        <div class="form-group">
                            <label for="alamat_show-{{ $student->id }}">Alamat</label>
                            <textarea name="alamat_show" class="form-control @error('alamat_show') is-invalid @enderror"
                                id="alamat_show-{{ $student->id }}" readonly>{{ old('alamat_show', $student->alamat) }}</textarea>

                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>

                    </div>

                </div>
            </div>
        </div>
    @endforeach


    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>

    <script>
        $(document).ready(function() {
            var modal = $('#addStudentModal');
            var modalErrors = modal.find('.invalid-feedback');

            if (modalErrors.length > 0) {
                modal.modal('show');
            }
        });
    </script>

    <script>
        document.addEventListener('click', function(event) {

            if (event.target.classList.contains('delete-student')) {
                event.preventDefault();

                var studentId = event.target.getAttribute('data-student-id');


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

                        window.location.href = '/student/delete/' + studentId;
                    }
                });
            }
        });
    </script>



@endsection

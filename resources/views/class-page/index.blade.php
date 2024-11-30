@extends('layout.app', [
    'namePage' => 'Data-Kelas',
])
@section('title', 'Sekolah | Data Kelas')
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
            <div class="col-md-4 mb-3">
                <h4 for="class_id" class="form-label">Data Kelas</h4>

            </div>
            <div class="row">
                <div class="col">
                    <div class="card">
                        <div class="card-body">
                            <div class="card-sub">
                                <Button data-toggle="modal" data-target="#addClassModal"
                                    class="btn btn-primary btn-md">Tambah Data

                                </Button>
                            </div>
                            <table class="table" id="data-table">
                                <thead>
                                    <tr>
                                        <th scope="col">No</th>
                                        <th scope="col">Nama kelas</th>
                                        <th scope="col">Kode kelas</th>
                                        <th class="text-center" scope="col">Jumlah siswa </th>
                                        <th class="text-center" scope="col">Jumlah guru </th>
                                        <th class="text-right" scope="col">Action</th>



                                    </tr>
                                </thead>
                                <tbody>
                                    @forelse ($kelas as $item)
                                        <tr>
                                            <td scope="row">{{ $loop->iteration }}</td>
                                            <td>{{ $item->nama_kelas }}</td>
                                            <td>{{ $item->kode_kelas }}</td>
                                            <td class="text-center">{{ $item->jumlah_murid }}</td>
                                            <td class="text-center">{{ $item->jumlah_guru }}</td>

                                            <td class="text-right">
                                                <button class="btn" type="button" id="actionDropdown"
                                                    data-toggle="dropdown" aria-expanded="false">
                                                    <i class="fas fa-ellipsis-v"></i>
                                                </button>
                                                <div class="dropdown-menu" aria-labelledby="navbarDropdown">

                                                    <a href="{{ route('class.edit', $item->id) }}"
                                                        class="dropdown-item text-warning">
                                                        Edit
                                                    </a>
                                                    <a class="dropdown-item text-danger delete-class" href="#"
                                                        data-class-id="{{ $item->id }}">
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
                            <div class="s">
                                <p class=" text-danger">*Jumlah Siswa dan Guru berdasarkan Data Murid dan Data Guru
                                </p>
                            </div>
                        </div>
                    </div>

                </div>

            </div>
        </div>
    </div>

    <div class="modal fade" id="addClassModal" tabindex="-1" aria-labelledby="addClassModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <form action="{{ route('class.store') }}" method="POST">
                    @csrf
                    <div class="modal-header">
                        <h5 class="modal-title" id="addClassModalLabel">Tambah Data Kelas</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">

                        <div class="form-group">
                            <label for="nama_kelas">Nama Kelas</label>
                            <input type="text" name="nama_kelas"
                                class="form-control @error('nama_kelas') is-invalid @enderror" id="nama_kelas"
                                value="{{ old('nama_kelas') }}" required>
                            @error('nama_kelas')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="form-group">
                            <label for="kode_kelas">Kode Kelas</label>
                            <input type="text" name="kode_kelas"
                                class="form-control @error('kode_kelas') is-invalid @enderror" id="kode_kelas"
                                value="{{ old('kode_kelas') }}" required>
                            @error('kode_kelas')
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







    <script>
        document.getElementById('nama_kelas').addEventListener('input', function() {
            this.value = this.value.toUpperCase();
        });
    </script>

    <script>
        document.getElementById('kode_kelas').addEventListener('input', function() {
            this.value = this.value.toUpperCase();
        });
    </script>

    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>

    <script>
        $(document).ready(function() {
            var modal = $('#addClassModal');
            var modalErrors = modal.find('.invalid-feedback');

            if (modalErrors.length > 0) {
                modal.modal('show');
            }
        });
    </script>

    <script>
        document.addEventListener('click', function(event) {

            if (event.target.classList.contains('delete-class')) {
                event.preventDefault();

                var classId = event.target.getAttribute('data-class-id');


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

                        window.location.href = '/class/delete/' + classId;
                    }
                });
            }
        });
    </script>

@endsection

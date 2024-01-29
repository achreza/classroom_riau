@extends('layouts.app')


@section('content')
    <!-- Button trigger modal -->
    @if ($role == 'dosen')
        <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#exampleModal">
            Tambah Mata Kuliah <i class="fas fa-plus"></i>
        </button>
    @endif
@if($status == 0)
        <div class="row">
            <div class="col-lg-12 d-flex justify-content-center align-items-center">
                <h1 class="text-center">Anda belum membayar UKT</h1>
            </div>
        </div>
@elseif($status == 1)
        @if ($role == 'mahasiswa')
            <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#exampleModal">
                Masuk ke Mata Kuliah <i class="fas fa-plus"></i>
            </button>
        @endif
        
        @if ($role == 'dosen' || $role == 'mahasiswa')
        @if ($kelas == null)
            <div class="row">
                <div class="col-lg-12 d-flex justify-content-center align-items-center">
                    <img class="mt-4" style="width: 400px" src="{{ asset('image/index.png') }}" alt="">
                </div>
            </div>
        @else
            <div class="row mt-3">
                @foreach ($kelas as $index => $item)
                    <div class="col-md-4 mb-4">
                        <div class="card h-100">
                            <img style="max-height: 190px" class="card-img-top" src="{{ asset($rand[$index]) }}"
                                alt="Card image cap">
                            <div class="card-body">
                                <h5 class="card-title">{{ $item->nama_kelas }}</h5>
                                <p class="card-text">
                                    {{ $item->deskripsi }}
                                </p>
                                <a href="{{ route('kelas.show', ['kela' => $item->id]) }}"
                                    class="btn btn-outline-primary">Detail</a>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
        @endif
    @elseif($role == 'admin')
        <div class="row mt-3">
            <div class="card">
                <div class="card-body">
                    <h4>List User</h4>
                    <button type="button" class="btn btn-primary mb-3 mt-2" data-bs-toggle="modal"
                        data-bs-target="#exampleModal">
                        Tambahkan User <i class="fas fa-plus"></i>
                    </button>
                    <table id="tableUser">
                        <thead>
                            <tr>
                                <th>No</th>
                                <th>Nama</th>
                                <th>Email</th>
                                <th>NIDN/NIM</th>
                                <th>Status</th>
                                <th>Status Aktif</th>
                                <th>Action</th>
                                <th>Active</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($user as $index => $item)
                                <tr>
                                    <td>{{ $index + 1 }}</td>
                                    <td>{{ $item->name }}</td>
                                    <td>{{ $item->email }}</td>
                                    <td>{{ $item->kode }}</td>
                                    <td>{{ $item->role->nama_role }}</td>
                                    <td>
                                        @if ($item->belum_bayar == 0)
                                            <span class="badge bg-danger">Belum Aktif</span>
                                        @else
                                            <span class="badge bg-success">Aktif</span>
                                        @endif
                                    <td>
                                        <a href="{{ route('user.delete', $item->id) }}" class="btn btn-danger" data-confirm-delete="true">Hapus</a>
                                    </td>
                                    <td>
                                        <input type="checkbox" name="active_users[]" value="{{ $item->id }}">
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                        <tfoot>
                            <tr>
                                <td colspan="7"></td>
                                <td>
                                    <button type="button" class="btn btn-primary" id="bulkActivate" >UBAH STATUS AKTIF</button>
                                </td>
                            </tr>
                        </tfoot>                        
                    </table>
                </div>
            </div>


        </div>
    @endif
@endif

    


    <!-- Modal -->
    <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                {{-- if mahasiswa make join kelas modal --}}
                @if ($role == 'mahasiswa')
                    <div class="modal-header">
                        <h1 class="modal-title fs-5" id="exampleModalLabel">Join Kelas</h1>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body demo-vertical-spacing demo-only-element">
                        <form action="{{ route('joinkelas.store') }}" method="POST">
                            @csrf
                            <div class="form-password-toggle">
                                <label class="form-label" for="basic-default-password12">Kode Kelas</label>
                                <div class="input-group">
                                    <input type="text" class="form-control" id="basic-default-password12"
                                        placeholder="Kode kelas" aria-describedby="basic-default-password2"
                                        name="kode_kelas">
                                </div>
                            </div>
                            <div class="modal-footer">
                                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Tutup</button>
                                <button type="submit" class="btn btn-primary">Masuk</button>
                            </div>
                        </form>
                    </div>
                @elseif ($role == 'dosen')
                    <div class="modal-header">
                        <h1 class="modal-title fs-5" id="exampleModalLabel">Tambah Mata Kuliah</h1>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body demo-vertical-spacing demo-only-element">
                        <form action="{{ route('kelas.store') }}" enctype="multipart/form-data" method="POST">
                            @csrf
                            <div class="form-password-toggle">
                                <label class="form-label" for="basic-default-password12">Nama Mata Kuliah</label>
                                <div class="input-group">
                                    <input type="text" class="form-control" id="basic-default-password12"
                                        placeholder="Nama Kelas" aria-describedby="basic-default-password2"
                                        name="nama_kelas">
                                </div>
                            </div>
                            <div class="form-password-toggle">
                                <label class="form-label" for="basic-default-password12">Kode Mata Kuliah</label>
                                <div class="input-group">
                                    <input type="text" class="form-control" id="basic-default-password12"
                                        placeholder="Kode Mata Kuliah" aria-describedby="basic-default-password2"
                                        name="kode_matakuliah">
                                </div>
                            </div>
                            <div class="form-password-toggle">
                                <label class="form-label" for="basic-default-password12">Deskripsi</label>
                                <div class="input-group">
                                    <textarea class="form-control" id="basic-default-password12" rows="3" placeholder="Deskripsi Mata Kuliah"
                                        aria-describedby="basic-default-password2" name="deskripsi"></textarea>

                                </div>
                            </div>
                            <div class="mb-3">
                                <label for="formFile" class="form-label">Modul Kelas</label>
                                <input class="form-control" type="file" id="formFile" name="modul">
                                <div id="emailHelp" class="form-text text-black">*Format file
                                    pdf,word,zip,rar.
                                </div>
                            </div>
                            <div class="modal-footer">
                                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Tutup</button>
                                <button type="submit" class="btn btn-primary">Buat</button>
                            </div>
                        </form>
                    </div>
                @elseif ($role == 'admin')
                    <div class="modal-header">
                        <h1 class="modal-title fs-5" id="exampleModalLabel">Tambah User</h1>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>

                    <div class="modal-body demo-vertical-spacing demo-only-element">
                        <form action="{{ route('user.create') }}" method="post">
                            @csrf
                            <div class="form-outline mb-4">
                                <label class="form-label" for="">Nama Lengkap</label>
                                <input type="text" name="name" id="form3Example4" class="form-control"
                                    placeholder="Nama" />

                            </div>
                            <div class="form-outline mb-4">
                                <label class="form-label" for="">Email</label>
                                <input type="email" id="form3Example3" name="email" class="form-control"
                                    placeholder="email" />
                                <div class="form-text">Email harus menggunakan email akun google yang sudah terdaftar.
                                </div>

                            </div>
                            <div class="form-outline mb-4">
                                <label class="form-label" for="">NIM / NIDN</label>
                                <input type="text" name="kode" id="form3Example4" class="form-control"
                                    placeholder="NIM / NIP" />
                                <div class="form-text">Masukkan NIM jika mendaftarkan mahasiswa, masukkan NIP jika
                                    mendaftarkan dosen.</div>

                            </div>
                            <div class="form-outline mb-4">
                                <label class="form-label" for="">Jurusan</label>
                                <input type="text" name="jurusan" id="form3Example4" class="form-control"
                                    placeholder="Jurusan" />

                            </div>
                            {{-- select role --}}
                            <div class="form-outline mb-4">
                                <label class="form-label" for="">Role</label>
                                <select class="form-control form-select" name="role"
                                    aria-label="Default select example">
                                    <option selected>Pilih Role</option>
                                    <option value="1">Admin</option>
                                    <option value="2">Dosen</option>
                                    <option value="3">Mahasiswa</option>
                                </select>
                            </div>

                            <div class="modal-footer">
                                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Tutup</button>
                                <button type="submit" class="btn btn-primary">Tambahkan</button>
                            </div>


                        </form>
                    </div>
                @endif
            </div>
        </div>
    </div>


    <script>
        $(document).ready(function() {
            $('#tableUser').DataTable();
        });
        $(document).ready(function () {
        $('#bulkActivate').on('click', function () {
            var selectedUserIds = [];

            // Get selected user IDs
            $('input[name="active_users[]"]:checked').each(function () {
                selectedUserIds.push($(this).val());
            });

            // Send AJAX request to update the database
            $.ajax({
                type: 'GET',
                url: '/user-active' + '/' + selectedUserIds.join(','), 
                success: function (response) {
                    location.reload();
                },
                error: function (response) {
                    alert('An error occurred.');
                }
            });
        });
    });
    </script>
@endsection

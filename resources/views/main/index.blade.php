@extends('layouts.app')


@section('content')
    <!-- Button trigger modal -->
    @if ($role == 'dosen')
        <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#exampleModal">
            Tambah Kelas <i class="fas fa-plus"></i>
        </button>
    @endif
    @if ($role == 'mahasiswa')
        <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#exampleModal">
            Masuk ke Kelas <i class="fas fa-plus"></i>
        </button>
    @endif

    @if ($role == 'dosen' || $role == 'mahasiswa')
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
                                <th>NIP/NIM</th>
                                <th>Jurusan</th>
                                <th>Status</th>
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
                                        <a href="{{ route('user.delete', $item->id) }}" class="btn btn-danger">Hapus</a>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>


        </div>
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
                                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                                <button type="submit" class="btn btn-primary">Add</button>
                            </div>
                        </form>
                    </div>
                @elseif ($role == 'dosen')
                    <div class="modal-header">
                        <h1 class="modal-title fs-5" id="exampleModalLabel">Tambah Kelas</h1>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body demo-vertical-spacing demo-only-element">
                        <form action="{{ route('kelas.store') }}" method="POST">
                            @csrf
                            <div class="form-password-toggle">
                                <label class="form-label" for="basic-default-password12">Nama Kelas</label>
                                <div class="input-group">
                                    <input type="text" class="form-control" id="basic-default-password12"
                                        placeholder="Nama Kelas" aria-describedby="basic-default-password2"
                                        name="nama_kelas">
                                </div>
                            </div>
                            <div class="form-password-toggle">
                                <label class="form-label" for="basic-default-password12">Deskripsi</label>
                                <div class="input-group">
                                    <textarea class="form-control" id="basic-default-password12" rows="3" placeholder="Deskripsi Kelas"
                                        aria-describedby="basic-default-password2" name="deskripsi"></textarea>

                                </div>
                            </div>
                            <div class="modal-footer">
                                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                                <button type="submit" class="btn btn-primary">Add</button>
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
                                <label class="form-label" for="">NIM / NIP</label>
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
                                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                                <button type="submit" class="btn btn-primary">Add</button>
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
    </script>
@endsection

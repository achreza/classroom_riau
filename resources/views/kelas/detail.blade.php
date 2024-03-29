@extends('layouts.app')

@section('content')
    <div class="row">

        <div class="col-lg-12 ">
            <div class="cover-class d-flex justify-content-start align-items-end"
                style="background-image: url('../{{ $rand }}');">
                <h3 class="cover-nama-kelas">{{ $kelas->nama_kelas }} - {{ $kelas->kode_matakuliah }}</h3>

            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-lg-9">
            @if (request()->session()->get('role') == 2)
                <div class="kelas-dosen-button-group d-flex justify-content-between align-items-baseline">
                    <button type="button" class="btn btn-primary mt-2" data-bs-toggle="modal" data-bs-target="#modalTugas">
                        Tambah Materi <i class="fas fa-plus"></i>
                    </button>
                    <div class="dropdown">
                        <div class="p-1 rounded-circle btn btn-primary " id="dropdownMenuLink" data-bs-toggle="dropdown"
                            aria-expanded="false">
                            <img style="width: 20px" src="{{ asset('image/setting.svg') }}" alt="">
                        </div>

                        <ul class="dropdown-menu" aria-labelledby="dropdownMenuLink">
                            <li>
                                <form action="{{ route('kelas.delete', ['id' => $kelas->id]) }}" method="GET"
                                    id="form_delete_kelas">
                                    @csrf

                                    <button type="submit" class="dropdown-item text-danger fw-bold" id="hapus_kelas">Hapus
                                        Kelas</button>
                                </form>
                            </li>
                        </ul>
                    </div>
                </div>
            @endif

            @foreach ($tugas as $index => $item)
                <a href="{{ route('tugas.show', ['id' => $item->id]) }}" class="card-anchor ">
                    <div class="card card-tugas">
                        <div class="card-body kelas-item-tugas d-flex align-items-center">
                            <div class="item-tugas-logo-group ">
                                <img class="item-tugas-logo" src="{{ asset('image/task.svg') }}" alt="">
                            </div>

                            <div class=" item-tugas-info d-flex justify-content-between w-100 align-items-start gap-2"
                                style="position: relative;">

                                <div>
                                    <h6 class="mb-0">{{ $item->nama_tugas }}</h6>
                                    <small class="text-muted">Tanggal Perkuliahan : {{ $item->tanggal_perkuliahan }}</small>
                                    <br>
                                    <small class="text-muted">Deadline : {{ $item->deadline_date }},
                                        {{ $item->deadline_time }}</small>
                                </div>
                                <div class="status-pengumpulan">
                                    @if (Auth::user()->role_id == 3 && $status[$index] == 'Sudah Mengumpulkan')
                                        <span class="badge bg-success">Sudah Mengumpulkan</span>
                                    @elseif(Auth::user()->role_id == 3 && $status[$index] == 'Belum Mengumpulkan')
                                        <span class="badge bg-danger">Belum Mengumpulkan</span>
                                    @else
                                    @endif
                                </div>

                            </div>
                        </div>
                    </div>
                </a>
            @endforeach

        </div>
        <div class="col-lg-3">
            <div class="row">
                <div class="col-lg-12">
                    @if($kelas->modul)
                        <a href="{{ route('download.modul', $kelas->modul) }}" class="btn btn-primary mt-3" style="width: 100%">
                            Download Modul Kelas
                        </a>
                    @else
                        <p>No modul available for this class.</p>
                    @endif
                </div>                
            </div>
            <div class="row">
                <div class="col-lg-12">
                    <div class="card mt-3 p-3">
                        <div class="">
                            <p>Kode Kelas</p>
                            <h3>{{ $kelas->kode_kelas }}</h3>
                        </div>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-lg-12">
                    <div class="card mt-3 p-3">
                        <p>List Mahasiswa</p>
                        @if ($list_mahasiswa == null)
                            <div class="kelas-list-mahasiswa d-flex align-items-center justify-content-center">

                                <p class="text-muted">
                                    Belum ada mahasiswa
                                </p>
                            </div>
                        @endif
                        <ul class="mhs-list">
                            @foreach ($list_mahasiswa as $item)
                                @if ($item->mahasiswa->is_online == 0)
                                    <li class="text-black "> <span class="dot-offline"></span>{{ $item->mahasiswa->name }}
                                    </li>
                                @elseif($item->mahasiswa->is_online == 1)
                                    <li class="text-black "> <span class="dot-online"></span>{{ $item->mahasiswa->name }}
                                    </li>
                                @endif
                            @endforeach
                        </ul>

                    </div>
                    @if (request()->session()->get('role') == 3)
                        <form action="{{ route('kelas.keluar', $kelas->id) }}" method="GET" id="form_delete">
                            @csrf

                            {{-- make with sweet alert --}}
                            <button type="submit" class="btn btn-danger w-100 mt-3 showConfirm">
                                Keluar dari kelas </button>
                        </form>
                    @endif

                </div>
            </div>

        </div>
    </div>

    <div class="modal fade" id="modalTugas" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-header">
                    <h1 class="modal-title fs-5" id="exampleModalLabel">Tambah Materi</h1>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body demo-vertical-spacing demo-only-element">
                    <form action="{{ route('tugas.store') }}" method="POST" enctype="multipart/form-data">
                        @csrf
                        <input type="text" name="id_kelas" value="{{ $kelas->id }}" hidden>
                        <div class="form-password-toggle">
                            <label class="form-label" for="basic-default-password12">Nama Materi</label>
                            <div class="input-group">
                                <input type="text" class="form-control" id="basic-default-password12"
                                    placeholder="Nama Materi" aria-describedby="basic-default-password2" name="nama_tugas">
                            </div>
                        </div>
                        <div class="form-password-toggle">
                            <label class="form-label" for="basic-default-password12">Deskripsi</label>
                            <input class="form-control" id="deskripsi" type="hidden" name="deskripsi">
                            <trix-editor input="deskripsi"></trix-editor>
                        </div>
                        <div class="form-password-toggle">
                            <label class="form-label" for="basic-default-password12">Pertemuan</label>
                            <div class="input-group">
                                <input type="text" class="form-control" id="pertemuan" placeholder="Pertemuan Ke-"
                                    aria-describedby="basic-default-password2" name="pertemuan">
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="form-label" for="tglAwalKegiatan">Tanggal Perkuliahan:</label>
                            <input type="date" class="form-control" id="tglAwalKegiatan"
                                name="tanggal_perkuliahan" />
                        </div>
                        <div class="form-group">
                            <label class="form-label" for="tglAwalKegiatan">Deadline Date:</label>
                            <input type="date" class="form-control" id="tglAwalKegiatan" name="deadline_date" />
                        </div>
                        <div class="form-group">
                            <label class="form-label" for="tglAwalKegiatan">Deadline Time:</label>
                            <input type="time" class="form-control" id="tglAwalKegiatan" name="deadline_time" />
                        </div>
                        <div class="form-group">
                            <label class="form-label" for="tglAwalKegiatan">Kode Youtube:</label>
                            <input type="text" class="form-control" id="tglAwalKegiatan" name="youtube"
                                placeholder="Contoh : lv5R6C3hz54" />
                            <div id="emailHelp" class="form-text">*Optional, kosongkan bila tidak mengupload video
                                pembelajaran</div>
                        </div>
                        <div class="form-group">
                            <label class="form-label" for="tglAwalKegiatan">File:</label>
                            <input type="file" class="form-control" id="tglAwalKegiatan" name="file" />
                            <div id="emailHelp" class="form-text">*Upload berformat pdf jika hanya satu file, jika banyak
                                file maka upload dengan format rar/zip dengan maks ukuran 5mb</div>
                        </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Tutup</button>
                    <button type="submit" class="btn btn-primary">Tambahkan</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
    <script>
        $('.showConfirm').on('click', function(e) {
            e.preventDefault();
            var form = $('#form_delete');
            Swal.fire({
                title: 'Apakah anda yakin?',
                text: "Anda akan keluar dari kelas ini",
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',

                confirmButtonText: 'Ya, Keluar!'
            }).then((result) => {
                if (result.isConfirmed) {
                    form.submit();
                }
            })
        });

        $('#hapus_kelas').on('click', function(e) {
            e.preventDefault();
            var form = $('#form_delete_kelas');
            Swal.fire({
                title: 'Apakah anda yakin?',
                text: "Anda akan menghapus kelas ini",
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',

                confirmButtonText: 'Ya, Hapus!'
            }).then((result) => {
                if (result.isConfirmed) {
                    form.submit();
                }
            })
        });
    </script>
@endsection

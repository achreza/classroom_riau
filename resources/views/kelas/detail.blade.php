@extends('layouts.app')

@section('content')
    <div class="row">
        <div class="col-lg-12">
            <div class="cover-class d-flex justify-content-start align-items-end">
                <h3 class="cover-nama-kelas">{{ $kelas->nama_kelas }}</h3>
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-lg-9">
            <button type="button" class="btn btn-primary mt-2" data-bs-toggle="modal" data-bs-target="#modalTugas">
                Tambah Tugas <i class="fas fa-plus"></i>
            </button>
            @foreach ($tugas as $item)
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
                                    <small class="text-muted">Deadline : {{ $item->tgl_mulai }},
                                        {{ $item->tgl_akhir }}</small>
                                </div>
                                <div class="">
                                    <span class="badge bg-warning text-dark">Belum Dikerjakan</span>
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
                    <div class="card mt-3 p-3">
                        <div class="">
                            <p>Kode Kelas</p>
                            <h3>KJ87UV</h3>
                        </div>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-lg-12">
                    <div class="card mt-3 p-3">
                        <p>List Mahasiswa</p>
                        <div class="kelas-list-mahasiswa d-flex align-items-center justify-content-center">
                            <p class="text-muted">
                                Belum ada mahasiswa
                            </p>
                        </div>
                    </div>
                </div>
            </div>

        </div>
    </div>

    <div class="modal fade" id="modalTugas" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-header">
                    <h1 class="modal-title fs-5" id="exampleModalLabel">Tambah Tugas</h1>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body demo-vertical-spacing demo-only-element">
                    <form action="{{ route('tugas.store') }}" method="POST" enctype="multipart/form-data">
                        @csrf
                        <input type="text" name="id_kelas" value="{{ $kelas->id }}" hidden>
                        <div class="form-password-toggle">
                            <label class="form-label" for="basic-default-password12">Nama Tugas</label>
                            <div class="input-group">
                                <input type="text" class="form-control" id="basic-default-password12"
                                    placeholder="Nama Kelas" aria-describedby="basic-default-password2" name="nama_tugas">
                            </div>
                        </div>
                        <div class="form-password-toggle">
                            <label class="form-label" for="basic-default-password12">Deskripsi</label>
                            <input class="form-control" id="deskripsi" type="hidden" name="deskripsi">
                            <trix-editor input="deskripsi"></trix-editor>
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
                            <label class="form-label" for="tglAwalKegiatan">File:</label>
                            <input type="file" class="form-control" id="tglAwalKegiatan" name="file" />
                        </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                    <button type="submit" class="btn btn-primary">Add</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection

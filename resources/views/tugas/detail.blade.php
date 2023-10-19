@extends('layouts.app')

@section('content')
    <div class="row">
        <div class="col-lg-8 offset-lg-2">
            <div class="header-tugas">
                <div class="judul-tugas-group d-flex justify-content-between">
                    <div>
                        <h4 class="mb-0">{{ $tugas->nama_tugas }}</h4>
                        <small class="text-muted">Deadline : {{ $tugas->deadline_date }},
                            {{ $tugas->deadline_time }}</small>
                    </div>

                    <div class="dropdown">
                        <div class="tugas-setting-wrap rounded-circle btn btn-primary " id="dropdownMenuLink"
                            data-bs-toggle="dropdown" aria-expanded="false">
                            <img class="tugas-setting-logo" src="{{ asset('image/setting.svg') }}" alt="">
                        </div>

                        <ul class="dropdown-menu" aria-labelledby="dropdownMenuLink">
                            <li><a class="dropdown-item" href="#" data-bs-toggle="modal" data-bs-target="#modalTugas">
                                    Edit tugas</a></li>
                            <li><a class="dropdown-item text-danger" href="#">Hapus tugas</a></li>
                        </ul>
                    </div>
                </div>
            </div>
            <div class="body-tugas">
                {!! $tugas->deskripsi !!}
            </div>
        </div>
    </div>

    {{-- Modal Edit --}}
    <div class="modal fade" id="modalTugas" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-header">
                    <h1 class="modal-title fs-5" id="exampleModalLabel">Tambah Tugas</h1>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body demo-vertical-spacing demo-only-element">
                    <form id="formUpdateTugas" action="{{ route('tugas.update', ['id' => $tugas->id]) }}" method="POST"
                        enctype="multipart/form-data">
                        @csrf

                        <div class="form-password-toggle">
                            <label class="form-label" for="basic-default-password12">Nama Tugas</label>
                            <div class="input-group">
                                <input type="text" class="form-control" id="namaTugas" placeholder="Nama Kelas"
                                    aria-describedby="basic-default-password2" name="nama_tugas"
                                    value="{{ $tugas->nama_tugas }}">
                            </div>
                        </div>
                        <div class="form-password-toggle">
                            <label class="form-label" for="basic-default-password12">Deskripsi</label>
                            <input class="form-control" id="deskripsi" type="hidden" name="deskripsi">
                            <trix-editor input="deskripsi">{!! $tugas->deskripsi !!}</trix-editor>
                        </div>


                        <div class="form-group">
                            <label class="form-label" for="tglAwalKegiatan">Deadline Date:</label>
                            <input type="date" class="form-control" id="ddate" name="deadline_date"
                                value="{{ $tugas->deadline_date }}" />
                        </div>
                        <div class="form-group">
                            <label class="form-label" for="tglAwalKegiatan">Deadline Time:</label>
                            <input type="time" class="form-control" id="dtime" name="deadline_time"
                                value="{{ $tugas->deadline_time }}" />
                        </div>
                        <div class="form-group">
                            <label class="form-label" for="tglAwalKegiatan">File:</label>
                            <input type="file" class="form-control" id="file" name="file"
                                value="{{ $tugas->file }}" />
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

    <script>
        // function prefillUpdateForm(id, namaTugas, deskripsi, ddate, dtime, file) {
        //     console.log(deskripsi);
        //     document.getElementById("namaTugas").value = namaTugas;

        //     document.getElementById("ddate").value = ddate;
        //     document.getElementById("dtime").value = dtime;
        //     document.getElementById("file").value = file;
        //     const form = document.getElementById("formUpdateTugas");
        //     form.action = `/tugas/update/${id}`;
        // }
    </script>
@endsection

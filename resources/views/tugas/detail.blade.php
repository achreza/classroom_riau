@extends('layouts.app')

@section('content')
    <div class="row">
        <div class="col-lg-12">
            <ul class="nav nav-pills mb-3" id="pills-tab" role="tablist">
                <li class="nav-item" role="presentation">
                    <button class="nav-link active" id="pills-tugas-tab" data-bs-toggle="pill" data-bs-target="#pills-tugas"
                        type="button" role="tab" aria-controls="pills-tugas" aria-selected="true">Tugas</button>
                </li>
                <li class="nav-item" role="presentation">
                    <button class="nav-link" id="pills-pengumpulan-tab" data-bs-toggle="pill"
                        data-bs-target="#pills-pengumpulan" type="button" role="tab" aria-controls="pills-pengumpulan"
                        aria-selected="false">Pengumpulan</button>
                </li>
            </ul>
            <div class="tab-content" id="pills-tabContent">
                {{-- Tugas --}}
                <div class="tab-pane fade show active" id="pills-tugas" role="tabpanel" aria-labelledby="pills-tugas-tab">
                    <div class="row">
                        <div class="col-lg-8 offset-lg-2">
                            <div class="header-tugas">
                                <div class="judul-tugas-group d-flex justify-content-between">
                                    <div>
                                        <h4 class="mb-0">{{ $tugas->nama_tugas }}</h4>
                                        <small class="text-muted">Deadline : {{ $dateFormatted }},
                                            {{ $tugas->deadline_time }}</small>
                                    </div>
                                    @if (request()->session()->get('role') == 2)
                                        <div class="dropdown">
                                            <div class="tugas-setting-wrap rounded-circle btn btn-primary "
                                                id="dropdownMenuLink" data-bs-toggle="dropdown" aria-expanded="false">
                                                <img class="tugas-setting-logo" src="{{ asset('image/setting.svg') }}"
                                                    alt="">
                                            </div>

                                            <ul class="dropdown-menu" aria-labelledby="dropdownMenuLink">
                                                <li><a class="dropdown-item" href="#" data-bs-toggle="modal"
                                                        data-bs-target="#modalTugas">
                                                        Edit tugas</a></li>
                                                <li>
                                                    <a href="{{ route('tugas.destroy', $tugas->id) }}"
                                                        class="dropdown-item text-danger fw-bold" type="submit"
                                                        data-confirm-delete='true'>Hapus
                                                        Tugas</a>
                                                </li>
                                            </ul>
                                        </div>
                                    @endif

                                </div>
                            </div>
                            @if ($tugas->kode_youtube == !null)
                                <iframe class="mt-3 mb-3" width="665" height="480"
                                    src="https://www.youtube.com/embed/{{ $tugas->kode_youtube }}" frameborder="0"
                                    allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture; web-share"
                                    allowfullscreen></iframe>
                            @endif

                            <div class="body-tugas">
                                {!! $tugas->deskripsi !!}
                                @if (!$tugas->file == null)
                                    <a class="btn btn-primary mt-2 "
                                        href="{{ route('download.tugas', ['file' => $tugas->file]) }}">
                                        <img class="tugas-setting-logo me-2" src="{{ asset('image/tugas.svg') }}"
                                            alt="">
                                        Download Tugas
                                    </a>
                                @endif

                            </div>
                        </div>
                    </div>
                </div>


                @if (request()->session()->get('role') == 2)
                    {{-- List Pengumpulan Dosen --}}
                    <div class="tab-pane fade" id="pills-pengumpulan" role="tabpanel"
                        aria-labelledby="pills-pengumpulan-tab">
                        <div class="row">
                            <div class="col-lg-10 offset-lg-1">
                                <h4>List pengumpulan</h4>
                                <table class="table" id="dataTable">
                                    <thead>
                                        <tr>
                                            <th scope="col">Nomor</th>
                                            <th scope="col">Nama</th>
                                            <th scope="col">Tanggal Pengumpulan</th>
                                            <th scope="col">Nilai</th>
                                            <th scope="col">Status</th>
                                            <th scope="col">Action</th>

                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($nilai as $item)
                                            <tr>
                                                <th scope="row">{{ $loop->iteration }}</th>
                                                <td>{{ $item->pengumpulan->mahasiswa->name }}</td>
                                                <td>{{ \Carbon\Carbon::parse($item->pengumpulan->pengumpulan)->format('d-m-Y H:i:s') }}
                                                </td>
                                                <td>{{ $item->nilai }} / 100</td>
                                                <td>
                                                    @if ($item->pengumpulan->status == 'Selesai')
                                                        <span class="badge bg-success">Tepat Waktu</span>
                                                    @elseif($item->pengumpulan->status == 'Terlambat')
                                                        <span class="badge bg-warning text-dark">Terlambat</span>
                                                    @else
                                                    @endif

                                                </td>
                                                <td>
                                                    <button type="button" class="btn btn-primary" data-bs-toggle="modal"
                                                        data-bs-target="#modalPenilaian"
                                                        onclick="
                                                    passingDataToModal('{{ $item->id }}','{{ $item->pengumpulan->file }}')
                                                    ">
                                                        Beri Nilai
                                                    </button>
                                                </td>

                                            </tr>
                                        @endforeach


                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                @else
                    {{-- Pengumpulan mahasiswa --}}
                    <div class="tab-pane fade" id="pills-pengumpulan" role="tabpanel"
                        aria-labelledby="pills-pengumpulan-tab">
                        <div class="row">
                            <div class="col-lg-10 offset-lg-1">
                                <h4>Pengumpulan Tugas</h4>
                                @if ($pengumpulan == null)
                                    <form action="{{ route('pengumpulan.store', $tugas->id) }}" method="post"
                                        enctype="multipart/form-data">
                                        @csrf
                                        <div class="mb-3">
                                            <label for="formFile" class="form-label">File Tugas</label>
                                            <input class="form-control" type="file" id="formFile" name="file">
                                            <div id="emailHelp" class="form-text text-black">*Format file
                                                pdf,word,zip,rar.
                                            </div>
                                        </div>
                                        <div class="mb-3">
                                            <label for="exampleFormControlTextarea1" class="form-label">Catatan</label>
                                            <textarea class="form-control" id="exampleFormControlTextarea1" rows="5" name="catatan"></textarea>
                                        </div>
                                        <button type="submit" class="btn btn-primary">Kumpulkan</button>
                                    </form>
                                @else
                                    <div class="card">
                                        <div class="card-body">
                                            <div class="card-pengumpulan-header d-flex justify-content-end">

                                                <a href="{{ route('pengumpulan.destroy', $pengumpulan->id) }}"
                                                    class="btn btn-danger text-white btn-sm" data-confirm-delete="true">Batalkan Pengumpulan</a>
                                            </div>
                                            <h6>Nilai</h6>
                                            <h5 class="fw-bold">{{ $nilai->nilai }} / 100</h5>
                                            <h6>Catatan</h6>
                                            <p>{{ $nilai->catatan_dosen ?? '-' }}</p>
                                            <h6>File</h6>
                                            <a class="btn btn-primary mt-2 "
                                                href="{{ route('download.pengumpulan', ['file' => $pengumpulan->file]) }}">
                                                <img class="tugas-setting-logo me-2" src="{{ asset('image/tugas.svg') }}"
                                                    alt="">
                                                Download File
                                            </a>
                                        </div>
                                    </div>
                                @endif

                            </div>
                        </div>
                    </div>
                @endif




            </div>
        </div>
    </div>



    {{-- Modal Edit --}}
    <div class="modal fade" id="modalTugas" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-header">
                    <h1 class="modal-title fs-5" id="exampleModalLabel">Update Tugas</h1>
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
                            <label class="form-label" for="tglAwalKegiatan">Kode Youtube:</label>
                            <input type="text" class="form-control" id="file" name="kode_youtube"
                                value="{{ $tugas->kode_youtube }}" />
                        </div>
                        <div class="form-group">
                            <label class="form-label" for="tglAwalKegiatan">File:</label>
                            <input type="file" class="form-control" id="file" name="file"
                                value="{{ $tugas->file }}" />
                        </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Tutup</button>
                    <button type="submit" class="btn btn-primary">Perbarui</button>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <!-- Modal Penilaian -->
    <div class="modal fade" id="modalPenilaian" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-xl">
            <div class="modal-content">
                <form method="post" id="formPenilaian">
                    @csrf
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLabel">Lembar Penilaian</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <div class="row">
                            <div class="col-lg-8">
                                <iframe id="pdf-preview" frameborder="0" style="width: 100%; height: 100vh;"
                                    sandbox="allow-same-origin allow-scripts"></iframe>

                            </div>
                            <div class="col-lg-4">

                                <div class="mb-3">
                                    <label for="">Nilai</label>
                                    <input type="number" class="form-control" placeholder="Masukkan nilai"
                                        name="nilai">
                                    <div class="form-text">Berikan nilai antara 0-100 </div>
                                </div>
                                <div class="mb-3">
                                    <label for="">Catatan untuk mahasiswa</label>
                                    <textarea class="form-control" placeholder="Masukkan catatan (jika diperlukan)" name="catatan_dosen" rows="3"></textarea>
                                </div>
                                <div class="mb-3">
                                    <label class="fw-bold">Catatan dari mahasiswa</label>
                                    <p>{{ $item->pengumpulan->catatan ?? '-' }}</p>
                                </div>

                            </div>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Tutup</button>
                            <button type="submit" class="btn btn-primary">Simpan</button>
                        </div>
                </form>
            </div>
        </div>
    </div>
    {{-- <script type="text/javascript" language="javascript" src="https://code.jquery.com/jquery-3.5.1.js"></script>
    <script type="text/javascript" language="javascript"
        src="https://cdn.datatables.net/1.11.3/js/jquery.dataTables.min.js"></script>
    <script type="text/javascript" language="javascript"
        src="https://cdn.datatables.net/buttons/2.0.1/js/dataTables.buttons.min.js"></script>
    <script type="text/javascript" language="javascript"
        src="https://cdnjs.cloudflare.com/ajax/libs/jszip/3.1.3/jszip.min.js"></script>
    <script type="text/javascript" language="javascript"
        src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.53/pdfmake.min.js"></script>
    <script type="text/javascript" language="javascript"
        src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.53/vfs_fonts.js"></script>
    <script type="text/javascript" language="javascript"
        src="https://cdn.datatables.net/buttons/2.0.1/js/buttons.html5.min.js"></script>
    <script type="text/javascript" language="javascript"
        src="https://cdn.datatables.net/buttons/2.0.1/js/buttons.print.min.js"></script> --}}
    <script>
        // $('#hapus_tugas').on('click', function(e) {
        //     e.preventDefault();
        //     var form = $('#formdeleteTugas');
        //     Swal.fire({
        //         title: 'Apakah anda yakin?',
        //         text: "Anda akan menghapus Tugas ini",
        //         icon: 'warning',
        //         showCancelButton: true,
        //         confirmButtonColor: '#3085d6',
        //         cancelButtonColor: '#d33',

        //         confirmButtonText: 'Ya, Hapus!'
        //     }).then((result) => {
        //         if (result.isConfirmed) {
        //             form.submit();
        //         }
        //     })
        // });
        // $(document).ready(function() {
        //     $('#dataTable').DataTable({
        //         dom: 'Bfrtip',
        //         buttons: [

        //             {
        //                 extend: 'excel',
        //                 text: 'Export to Excel',
        //                 className: 'btn btn-success'
        //             },



        //         ]
        //     });
        // });
        // make export in datatable

        let table = new DataTable('#dataTable', {
            dom: 'Bfrtip',
            buttons: [{
                extend: 'excelHtml5',
                text: 'Export to Excel',
                filename: 'Data Siswa',
                className: 'btn btn-success',
                exportOptions: {
                    columns: [0, 1, 2, 3, 4]
                }
            }]
        });
    </script>
    <script>
        function passingDataToModal(id, filename) {

            $("#pdf-preview").attr("src", `/storage/pengumpulan/${filename}`);

            const form = $("#formPenilaian");
            form.attr("action", `/tugas/penilaian/${id}`);
        }
    </script>

@endsection

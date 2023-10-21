@extends('layouts.app')


@section('content')
    <!-- Button trigger modal -->
    @if ($role == 'dosen')
        <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#exampleModal">
            Tambah Kelas <i class="fas fa-plus"></i>
        </button>
    @endif


    <!-- Modal -->
    <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">

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
                                    placeholder="Nama Kelas" aria-describedby="basic-default-password2" name="nama_kelas">
                            </div>
                        </div>
                        <div class="form-password-toggle">
                            <label class="form-label" for="basic-default-password12">Deskripsi</label>
                            <div class="input-group">
                                <textarea class="form-control" id="basic-default-password12" rows="3" placeholder="Deskripsi Kelas"
                                    aria-describedby="basic-default-password2" name="deskripsi"></textarea>

                            </div>
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

    <div class="row mt-3">
        @foreach ($kelas as $item)
            <div class="col-md-4">
                <div class="card h-100">
                    <img class="card-img-top"
                        src="https://demos.themeselection.com/sneat-bootstrap-html-admin-template-free/assets/img/elements/2.jpg"
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
@endsection

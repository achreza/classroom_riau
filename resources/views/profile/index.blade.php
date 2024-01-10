@extends('layouts.app')

@section('content')
    <div class="card mb-4">
        <h5 class="card-header">Profile Details</h5>
        <!-- Account -->
        <div class="card-body">
            <div class="d-flex align-items-start align-items-sm-center gap-4">
                <img src="{{ request()->session()->get('avatar') }}" alt="user-avatar" class="d-block rounded" height="100"
                    width="100" id="uploadedAvatar">

            </div>
        </div>
        <hr class="my-0">
        <div class="card-body">
            <form id="formAccountSettings" method="POST" action="{{ route('profile.update', $user->id) }}"
                class="fv-plugins-bootstrap5 fv-plugins-framework" novalidate="novalidate">
                @csrf
                <div class="row">
                    <div class="mb-3 col-md-12 fv-plugins-icon-container">
                        <label for="name" class="form-label">Name</label>
                        <input class="form-control" type="text" id="name" name="name" value="{{ $user->name }}"
                            autofocus="" @if (request()->session()->get('role') == 1) disabled @endif>
                        <div class="fv-plugins-message-container fv-plugins-message-container--enabled invalid-feedback">
                        </div>
                    </div>
                    <div class="mb-3 col-md-6">
                        <label for="nim" class="form-label">NIM / NIDN</label>
                        <input class="form-control" type="text" id="nim" name="kode" value="{{ $user->kode }}"
                            placeholder="john.doe@example.com" @if (request()->session()->get('role') == 1) disabled @endif>
                    </div>
                    <div class="mb-3 col-md-6">
                        <label for="jurusan" class="form-label">Jurusan</label>
                        <input type="text" class="form-control" id="jurusan" name="jurusan"
                            value="{{ $user->jurusan }}" @if (request()->session()->get('role') == 1) disabled @endif>
                    </div>

                </div>
                @if (request()->session()->get('role') == 1)
                    <div class=""></div>
                @else
                    <div class="mt-2">
                        <button type="submit" class="btn btn-primary me-2">Save
                            changes</button>

                    </div>
                @endif

                <input type="hidden">
            </form>
        </div>
        <!-- /Account -->
    </div>
@endsection

@php
    $title = 'Login';
@endphp
@extends('layouts.main')
@section('content')
    <div class="row justify-content-center">
        <div class="col-lg-5">
            <div class="card shadow-lg border-0 rounded-lg mt-5">
                <div class="card-header">
                    <h3 class="text-center font-weight-light my-4">Login</h3>
                </div>
                <div class="card-body">
                    <form action="{{ url('masuk') }}" method="post">
                        @csrf
                        <div class="form-floating mb-3">
                            <input class="form-control @error('username') is-invalid @enderror" id="username" type="text"
                                name="username" placeholder="Masukan Username" value="{{ old('username') }}" />
                            @error('username')
                                <div class="invalid-feedback">
                                    {{ $message }}
                                </div>
                            @enderror
                            <label for="username">Masukan Username</label>
                        </div>
                        <div class="form-floating mb-3">
                            <input class="form-control @error('username') is-invalid @enderror" id="password"
                                type="password" placeholder="Password" name="password" value="{{ old('password') }}" />
                            @error('password')
                                <div class="invalid-feedback">
                                    {{ $message }}
                                </div>
                            @enderror
                            <label for="password">Password</label>
                        </div>
                        <div class="d-flex align-items-center justify-content-between mt-4 mb-0">
                            <button type="button" class="btn btn-secondary" onclick="history.back()"> <i
                                    class="fas fa-arrow-left"></i> Back</button>
                            <button class="btn btn-primary"> Login <i class="fas fa-arrow-right"></i> </button>
                        </div>
                    </form>
                </div>
                <div class="card-footer text-center py-3">
                    <div class="small"><a href="{{ url('register') }}">Belum mmepunyai akun ? Register dulu!</a></div>
                </div>
            </div>
        </div>
    </div>
@endsection
@section('scripts')
    @if (session()->has('success'))
        <script>
            toastr.success(`{{ session('success') }}`);
        </script>
    @endif
    @if (session()->has('loginErorr'))
        <script>
            toastr.error(`{{ session('loginErorr') }}`);
        </script>
    @endif
    @if (count($errors) > 0)
        <script>
            toastr.error(`{{ $errors->first() }}`);
        </script>
    @endif
@endsection

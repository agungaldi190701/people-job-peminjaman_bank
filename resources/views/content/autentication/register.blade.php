@php
    $title = 'Registrasi';
@endphp
@extends('layouts.main')
@section('content')
    <div class="row justify-content-center">
        <div class="col-lg-7">
            <div class="card shadow-lg border-0 rounded-lg mt-5">
                <div class="card-header">
                    <h3 class="text-center font-weight-light my-4">Create Account</h3>
                </div>
                <div class="card-body">
                    <form action="{{ url('registrasi') }}" method="post">
                        @csrf
                        <div class="row mb-3">
                            <div class="col-md-6">
                                <div class="form-floating mb-3 mb-md-0">
                                    <input type="hidden" name="role" id="role" value="admin">
                                    <input class="form-control @error('nama') is-invalid @enderror" id="nama"
                                        type="text" placeholder="Masukan Nama" name="nama"
                                        value="{{ old('nama') }}" />
                                    @error('nama')
                                        <div class="invalid-feedback">
                                            {{ $message }}
                                        </div>
                                    @enderror
                                    <label for="nama">Masukan Nama</label>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-floating mb-3 mb-md-0">
                                    <input class="form-control @error('username') is-invalid @enderror " id="username"
                                        type="text" placeholder="Masukan username" name="username"
                                        value="{{ old('username') }}" />
                                    @error('username')
                                        <div class="invalid-feedback">
                                            {{ $message }}
                                        </div>
                                    @enderror
                                    <label for="username">Masukan username</label>
                                </div>
                            </div>

                        </div>
                        <div class="row mb-3">
                            <div class="col-md-6">
                                <div class="form-floating mb-3 mb-md-0">
                                    <input class="form-control @error('password') is-invalid @enderror" id="password"
                                        type="password" placeholder="Create a password" name="password" />
                                    @error('password')
                                        <div class="invalid-feedback">
                                            {{ $message }}
                                        </div>
                                    @enderror
                                    <label for="password">Password</label>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-floating mb-3 mb-md-0">
                                    <input class="form-control @error('password_confirmation') is-invalid @enderror"
                                        id="password_confirmation" type="password"
                                        placeholder="Confirm password_confirmation" name="password_confirmation" />
                                    @error('password_confirmation')
                                        <div class="invalid-feedback">
                                            {{ $message }}
                                        </div>
                                    @enderror
                                    <label for="password_confirmation">Confirm Password</label>
                                </div>
                            </div>
                        </div>
                        <div class="mt-4 mb-0">
                            <div class="d-grid">
                                <button class="btn btn-primary btn-block">Create Account</button>
                            </div>
                        </div>
                    </form>
                </div>
                <div class="card-footer text-center py-3">
                    <div class="small"><a href="{{ url('login') }}">Have an account? Go to login</a></div>
                </div>
            </div>
        </div>
    </div>
@endsection
@section('scripts')
    @if (count($errors) > 0)
        <script>
            toastr.error(`{{ $errors->first() }}`);
        </script>
    @endif
@endsection

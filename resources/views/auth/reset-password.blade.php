{{-- resources/views/auth/reset-password.blade.php --}}
@extends('layouts.new_app')

@section('content')
    <div class="container d-flex justify-content-center align-items-center bg-main" style="min-height: 80vh;">
        <div class="card shadow-lg p-4" style="max-width: 500px; width: 100%; background-color: #EFECEC;">
            <h3 class="text-center mb-3" style="color:#8B4513;">ตั้งรหัสผ่านใหม่</h3>

            <form method="POST" action="{{ route('password.store') }}">
                @csrf
                <input type="hidden" name="token" value="{{ $request->route('token') }}">

                <div class="mb-3">
                    <label for="email" class="form-label">อีเมล</label>
                    <input id="email" type="email" class="form-control" name="email"
                        value="{{ old('email', $request->email) }}" required autofocus>
                </div>

                <div class="mb-3">
                    <label for="password" class="form-label">รหัสผ่านใหม่</label>
                    <input id="password" type="password" class="form-control" name="password" required>
                </div>

                <div class="mb-3">
                    <label for="password_confirmation" class="form-label">ยืนยันรหัสผ่านใหม่</label>
                    <input id="password_confirmation" type="password" class="form-control" name="password_confirmation"
                        required>
                </div>

                <div class="d-grid">
                    <button type="submit" class="btn btn-register">
                        รีเซ็ตรหัสผ่าน
                    </button>
                </div>
            </form>
        </div>
    </div>
@endsection
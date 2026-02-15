{{-- resources/views/auth/forgot-password.blade.php --}}
@extends('layouts.new_app')

@section('content')
    <div class="container d-flex justify-content-center align-items-center bg-main" style="min-height: 80vh;">
        <div class="card shadow-lg p-4" style="max-width: 500px; width: 100%; background-color: #EFECEC;">
            <h3 class="text-center mb-3" style="color:#8B4513;">ลืมรหัสผ่าน</h3>
            <p class="text-muted text-center">กรอกอีเมลของคุณ แล้วเราจะส่งลิงก์สำหรับตั้งรหัสผ่านใหม่</p>

            @if (session('status'))
                <div class="alert alert-success">
                    {{ session('status') }}
                </div>
            @endif

            <form method="POST" action="{{ route('password.email') }}">
                @csrf
                <div class="mb-3">
                    <label for="email" class="form-label">อีเมล</label>
                    <input id="email" type="email" class="form-control" name="email" required autofocus>
                </div>

                <div class="d-grid">
                    <button type="submit" class="btn btn-login">
                        ส่งลิงก์รีเซ็ตรหัสผ่าน
                    </button>
                </div>
            </form>

            <div class="text-center mt-3">
                <a href="{{ route('login') }}" class="text-decoration-none">กลับไปหน้าเข้าสู่ระบบ</a>
            </div>
        </div>
    </div>
@endsection
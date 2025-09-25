@extends('layouts.app')

@section('content')
<div class="container">
    <h3>ตั้งค่าการเก็บคะแนน</h3>
    <form action="{{ route('calculatescore') }}" method="POST">
        @csrf

        <label>ระยะทาง</label>
        <select name="distance" class="form-control">
            <option value="30">30 เมตร</option>
            <option value="50">50 เมตร</option>
            <option value="70">70 เมตร</option>
            <option value="90">90 เมตร</option>
        </select>

        <label>ประเภทธนู</label>
        <select name="bow_type" class="form-control">
            <option value="recurve">Recurve</option>
            <option value="compound">Compound</option>
        </select>

        <label>จำนวนลูกธนู</label><br>
        <input type="radio" name="arrows" value="3" checked> 3 ลูก
        <input type="radio" name="arrows" value="6"> 6 ลูก

        <br><br>
        <button type="submit" class="btn btn-primary">ยืนยัน</button>
    </form>
</div>
@endsection

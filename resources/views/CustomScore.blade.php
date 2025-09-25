@extends('layouts.new_app')

@section('new_content')
<div class="page-wrap">
  <div class="container py-4">
    <h3 class="fw-bold mb-3 title">เก็บคะแนนซ้อม</h3>

    <form action="{{ route('calculatescore') }}" method="POST" class="needs-validation" novalidate>
      @csrf
      <div class="row g-3">

        <div class="col-12 col-md-6">
          <div class="card soft-card h-100">
            <div class="card-body">
              <label class="fw-bold mb-2">ระยะทาง</label>
              <select name="distance" class="form-select form-select-lg rounded-3" required>
                <option value="90" selected>90 เมตร</option>
                <option value="70">70 เมตร</option>
                <option value="50">50 เมตร</option>
                <option value="30">30 เมตร</option>
              </select>
            </div>
          </div>
        </div>

        <div class="col-12 col-md-6">
          <div class="card soft-card h-100">
            <div class="card-body">
              <label class="fw-bold mb-2">ประเภทธนู</label>
              <select name="bow_type" class="form-select form-select-lg rounded-3">
                <option value="Recurve" selected>Recurve</option>
                <option value="Compound">Compound</option>
              </select>
            </div>
          </div>
        </div>

        <div class="col-12">
          <div class="card soft-card">
            <div class="card-body">
              <label class="fw-bold d-block mb-2">จำนวนลูกธนู</label>
              <div class="d-flex gap-4 align-items-center">
                <div class="form-check form-check-lg">
                  <input class="form-check-input" type="radio" name="arrows" id="a3" value="3" checked>
                  <label class="form-check-label fs-5" for="a3">3 ลูก</label>
                </div>
                <div class="form-check form-check-lg">
                  <input class="form-check-input" type="radio" name="arrows" id="a6" value="6">
                  <label class="form-check-label fs-5" for="a6">6 ลูก</label>
                </div>
              </div>
            </div>
          </div>
        </div>

        <div class="col-12 text-center mt-1">
          <button type="submit" class="btn btn-lg px-5 py-2 rounded-3 submit-btn">
            ยืนยัน
          </button>
        </div>
      </div>
    </form>
  </div>
</div>

<style>
/* พื้นหลังเหมือนภาพตัวอย่าง */
.page-wrap{ background:#F8CFA7; min-height: calc(100vh - 86px); } /* -86px เผื่อความสูง navbar ใน layout */
.title{ color:#A94A2B; }
/* การ์ดโค้งนุ่ม */
.soft-card{ border:0; border-radius:16px; box-shadow:0 6px 16px rgba(0,0,0,.08); }
.submit-btn{ background:#B9452F; color:#fff; font-weight:700; }
.submit-btn:hover{ filter:brightness(.95); }
</style>
@endsection

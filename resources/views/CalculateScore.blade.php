@extends('layouts.new_app')

@section('new_content')
<div class="page-wrap d-flex flex-column">

  {{-- แถบข้อมูล --}}
  <div class="info-bar">
    <div class="container d-flex justify-content-between">
      <strong>Distance: {{ $distance }}m</strong>
      <span>Arrows/End: {{ $arrows }}</span>
    </div>
  </div>

  <div class="container py-3 d-flex flex-column flex-grow-1">

    {{-- กรอบสีเทาเฉพาะบอร์ด --}}
    <div class="board-shell soft-card flex-grow-1 d-flex flex-column">

      @for ($row = 1; $row <= 6; $row++)
        <div class="d-flex align-items-center score-row">
          <div class="row-idx">{{ $row }}.</div>

          <div class="flex-grow-1 px-2">
            <div class="grid-lanes" style="--cols: {{ $arrows }};">
              @for ($col = 1; $col <= $arrows; $col++)
                <div class="lane d-flex justify-content-center align-items-center"
                     data-row="{{ $row }}" data-col="{{ $col }}">
                </div>
              @endfor
            </div>
          </div>

          <div class="sum" id="sum-{{ $row }}">0</div>
        </div>

        @if($row < 6)<div class="divider"></div>@endif
      @endfor

    </div>

    {{-- คีย์แพด --}}
    <div class="keypad mt-3">
      <div class="row g-2">
        <div class="col-2"><button class="btn w-100 btn-key" data-score="X">X</button></div>
        <div class="col-2"><button class="btn w-100 btn-key" data-score="10">10</button></div>
        <div class="col-2"><button class="btn w-100 btn-key" data-score="9">9</button></div>
        <div class="col-2"><button class="btn w-100 btn-key" data-score="8">8</button></div>
        <div class="col-4"><button class="btn w-100 btn-del">DEL</button></div>

        <div class="col-2"><button class="btn w-100 btn-key" data-score="7">7</button></div>
        <div class="col-2"><button class="btn w-100 btn-key" data-score="6">6</button></div>
        <div class="col-2"><button class="btn w-100 btn-key" data-score="5">5</button></div>
        <div class="col-2"><button class="btn w-100 btn-key" data-score="4">4</button></div>
        <div class="col-4"><button class="btn w-100 btn-next">Next End</button></div>

        <div class="col-3"><button class="btn w-100 btn-key" data-score="3">3</button></div>
        <div class="col-3"><button class="btn w-100 btn-key" data-score="2">2</button></div>
        <div class="col-3"><button class="btn w-100 btn-key" data-score="1">1</button></div>
        <div class="col-3"><button class="btn w-100 btn-key" data-score="M">M</button></div>
      </div>
    </div>

  </div>
</div>

<style>
/* พื้นหลังโดยรอบเหมือนหน้า custom */
.page-wrap{ background:#F8CFA7; min-height:calc(100vh - 86px); }

/* แถบด้านบน */
.info-bar{ background:#FFD3A8; }

/* กรอบบอร์ดเทา */
.board-shell{ background:#E6E7EB; padding:10px; border-radius:16px; }

/* แถว + เส้นแบ่ง */
.score-row{ background:#f2f3f5; border-radius:12px; padding:8px 0; }
.divider{ height:10px; }

/* index ซ้าย & sum ขวา (แดง) */
.row-idx{ width:48px; padding:8px; color:#7b7f86; font-weight:600; text-align:right; }
.sum{ width:56px; padding:8px; text-align:right; font-weight:800; color:#C53 !important; }

/* ช่อง lane เป็น grid */
.grid-lanes{ display:grid; grid-template-columns:repeat(var(--cols), 1fr); gap:8px; }

/* ลาย lane + มุมโค้ง */
.lane{
  height:64px; border-radius:12px;
  background:
    linear-gradient(90deg, #7c3e1f 0 6%, transparent 6% 10%, #7c3e1f 10% 16%, transparent 16% 100%),
    #cfcfcf;
}

/* ปุ่ม */
.keypad .btn{ border-radius:12px; font-weight:700; padding:.85rem 0; }
.btn-key{ background:#F4C542; }
.btn-del{ background:#FFA8A3; }
.btn-next{ background:#FFBE86; }
.keypad .btn:hover{ filter:brightness(.95); }

/* fallback ตัวเลขตอนรูปไม่โหลด */
.fallback{ font-weight:800; font-size:1.25rem; }
</style>

<script>
(() => {
  const maxCols = {{ $arrows }};
  let curRow = 1, curCol = 1;

  // โฟลเดอร์รูป
  const MEDAL_BASE = "{{ asset('image/medal') }}";
  const medalMap = {
    'X':'x.png','10':'10.png','9':'9.png','8':'8.png',
    '7':'7.png','6':'6.png','5':'5.png','4':'4.png',
    '3':'3.png','2':'2.png','1':'1.png','M':'m.png'
  };

  // โหลดรูปแบบปลอดภัย (ถ้าโหลดไม่ได้จะแสดงตัวเลขแทน)
  function loadMedal(score, done){
    const file = medalMap[String(score)];
    if(!file){ return done(null); }
    const src = `${MEDAL_BASE}/${file}`;
    const img = new Image();
    img.onload = () => done(src);
    img.onerror = () => done(null);
    img.src = src;
  }

  function placeMedal(r,c,score){
    const cell = document.querySelector(`.lane[data-row="${r}"][data-col="${c}"]`);
    if(!cell) return;
    loadMedal(score, (src) => {
      if(src){
        cell.innerHTML = `<img src="${src}" alt="${score}" style="height:52px">`;
      }else{
        cell.innerHTML = `<span class="fallback">${score}</span>`;
      }
      cell.dataset.score = String(score);
      updateSum(r);
    });
  }

  function updateSum(r){
    let sum = 0;
    document.querySelectorAll(`.lane[data-row="${r}"]`).forEach(el=>{
      const v = el.dataset.score;
      if (v === 'X') sum += 10;
      else if (!v || v === 'M') sum += 0;
      else sum += parseInt(v,10) || 0;
    });
    document.getElementById(`sum-${r}`).textContent = sum;
  }

  document.querySelectorAll('.btn-key').forEach(btn=>{
    btn.addEventListener('click', ()=>{
      if (curRow > 6) return;
      placeMedal(curRow, curCol, btn.dataset.score);
      if (curCol < maxCols) curCol++;
    });
  });

  document.querySelector('.btn-del').addEventListener('click', ()=>{
    const cell = document.querySelector(`.lane[data-row="${curRow}"][data-col="${curCol}"]`);
    if(!cell) return;
    cell.innerHTML = '';
    delete cell.dataset.score;
    updateSum(curRow);
  });

  document.querySelector('.btn-next').addEventListener('click', ()=>{
    if (curRow < 6) { curRow++; curCol = 1; }
  });
})();
</script>
@endsection

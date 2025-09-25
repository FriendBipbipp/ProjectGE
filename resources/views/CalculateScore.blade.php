@extends('layouts.app')

@section('content')
<div class="container">
    <h4>ระยะทาง: {{ $distance }}m | ธนู: {{ ucfirst($bow_type) }} | ลูกละ: {{ $arrows }}</h4>

    <table class="table table-bordered">
        <thead>
            <tr>
                <th>รอบ</th>
                <th colspan="{{ $arrows }}">คะแนน</th>
                <th>รวม</th>
            </tr>
        </thead>
        <tbody id="scoreTable">
            @for ($i = 1; $i <= 6; $i++)
                <tr>
                    <td>{{ $i }}.</td>
                    @for ($j = 1; $j <= $arrows; $j++)
                        <td class="score-cell" data-row="{{ $i }}" data-col="{{ $j }}"></td>
                    @endfor
                    <td class="sum-cell" id="sum-{{ $i }}">0</td>
                </tr>
            @endfor
        </tbody>
    </table>

    {{-- ปุ่มคีย์คะแนน --}}
    <div class="score-keypad">
        <button class="btn btn-warning" onclick="addScore('X')">X</button>
        <button class="btn btn-warning" onclick="addScore(10)">10</button>
        <button class="btn btn-warning" onclick="addScore(9)">9</button>
        <button class="btn btn-warning" onclick="addScore(8)">8</button>
        <button class="btn btn-danger" onclick="deleteScore()">DEL</button>
        <br>
        @for ($i = 7; $i >= 1; $i--)
            <button class="btn btn-secondary" onclick="addScore({{ $i }})">{{ $i }}</button>
        @endfor
        <button class="btn btn-dark" onclick="addScore('M')">M</button>
        <button class="btn btn-info" onclick="nextEnd()">Next End</button>
    </div>
</div>

<script>
let currentRow = 1;
let currentCol = 1;
const maxRows = 6;
const maxCols = {{ $arrows }};

function addScore(score) {
    let cell = document.querySelector(`.score-cell[data-row="${currentRow}"][data-col="${currentCol}"]`);
    if(cell){
        cell.innerHTML = badge(score);
        updateSum(currentRow);
        if(currentCol < maxCols){
            currentCol++;
        }
    }
}

function badge(score){
    if(score === 'M') return `<span style="color:red;">M</span>`;
    if(score === 'X') return `<span style="color:gold;">X</span>`;
    return `<span class="badge bg-primary">${score}</span>`;
}

function updateSum(row){
    let sum = 0;
    document.querySelectorAll(`.score-cell[data-row="${row}"]`).forEach(cell=>{
        let val = cell.innerText;
        if(val === 'X') val = 10;
        if(val === 'M') val = 0;
        sum += parseInt(val) || 0;
    });
    document.getElementById(`sum-${row}`).innerText = sum;
}

function deleteScore(){
    let cell = document.querySelector(`.score-cell[data-row="${currentRow}"][data-col="${currentCol}"]`);
    if(cell){
        cell.innerHTML = '';
        updateSum(currentRow);
    }
}

function nextEnd(){
    if(currentRow < maxRows){
        currentRow++;
        currentCol = 1;
    }
}
</script>
@endsection

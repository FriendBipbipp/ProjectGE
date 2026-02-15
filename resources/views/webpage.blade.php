<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>KKU Archery Club</title>

    <!--Google Fonts (Sarabun)-->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Sarabun:wght@400;700&display=swap" rel="stylesheet">
    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <!-- Custom CSS (สำหรับ Background และปุ่มสีพิเศษ) -->
    <link href="{{ asset('css/style.css') }}" rel="stylesheet">
    <!-- Scripts -->
    @vite(['resources/css/app.css', 'resources/js/app.js'])

</head>

<body>

    <!--
      ส่วนนี้คือหัวใจหลักของการจัด Layout
      - vh-100: ทำให้ section นี้สูงเต็มหน้าจอ
      - d-flex: เปิดใช้งาน Flexbox
      - flex-column: จัดเรียงเนื้อหาจากบนลงล่าง
      - justify-content-center: จัดเนื้อหาให้อยู่ "กึ่งกลางแนวตั้ง"
      - align-items-center: จัดเนื้อหาให้อยู่ "กึ่งกลางแนวนอน"
      - text-center: จัดข้อความทั้งหมดให้อยู่ตรงกลาง
    -->
    <main class="bg-main d-flex flex-column justify-content-evenly align-items-center text-center">
        <!-- องค์ประกอบที่ 1: Logo -->
        <!-- 
            สำคัญ: เปลี่ยน src เป็น path ของไฟล์โลโก้ของคุณ 
            mb-4 คือคลาสสำหรับเว้นระยะห่างด้านล่าง (Margin Bottom)
        -->
        <img src="{{ asset('img/LOGO KK AC 3.png') }}" alt="Club Logo" class="my-4 img-fluid" style="max-width: 240px;">

        <!-- องค์ประกอบที่ 2: ชื่อและข้อความต้อนรับ -->
        <h1 class="display-5 fw-bold">Welcome to Khon Kaen University Archery Club</h1>
        <p class="lead mb-4">ยินดีต้อนรับเข้าสู่ชมรมยิงธนูมหาวิทยาลัยขอนแก่น</p>

        <!-- องค์ประกอบที่ 3: ปุ่ม -->
        <!-- 
            ใช้ d-grid เพื่อจัดเรียงปุ่มให้สวยงาม และใช้ Grid System (col-*) เพื่อควบคุมความกว้างของปุ่มในแต่ละขนาดหน้าจอ
            - col-10: บนจอมือถือ ให้ปุ่มกว้าง 10/12 ส่วน
            - col-md-6: บนจอแท็บเล็ต ให้ปุ่มกว้าง 6/12 ส่วน
            - col-lg-4: บนจอเดสก์ท็อป ให้ปุ่มกว้าง 4/12 ส่วน
        -->
        <div class="d-grid gap-3 col-10 col-md-6 col-lg-4 mx-auto my-4">
            {{-- ถ้ามี Route 'register' อยู่จริง ให้แสดงปุ่มนี้ --}}
            @if (Route::has('register'))
                <a href="{{ route('register') }}" class="btn btn-register btn-lg">REGISTER</a>
            @endif

            {{-- ถ้ามี Route 'login' อยู่จริง ให้แสดงปุ่มนี้ --}}
            @if (Route::has('login'))
                <a href="{{ route('login') }}" class="btn btn-login btn-lg">LOG IN</a>
            @endif

            {{-- กรณีที่ Login แล้ว, อาจจะแสดงปุ่ม Home แทน (ตามโค้ดเดิมของคุณ) --}}
            @auth
                <a href="{{ url('/home') }}" class="btn btn-outline-light btn-lg">HOME</a>
            @endauth
        </div>
    </main>

    <!-- Bootstrap JS (ไม่จำเป็นสำหรับหน้านี้ แต่ใส่ไว้เผื่ออนาคต) -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>

</body>

</html>
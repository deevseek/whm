<!doctype html>
<html lang="id">
<head>
  <meta charset="utf-8" />
  <meta name="viewport" content="width=device-width,initial-scale=1" />
  <title>Tes Kesehatan Mental - WMH</title>
  <link rel="stylesheet" href="assets/css/style.css" />
</head>
<body>

<header class="site-header">
  <div class="container">
    <h1>WMH</h1>
    <nav>
      <a href="index.php">Home</a>
      <a href="test.php">Tes Kesehatan Mental</a>
      <a href="appointment.php">Buat Janji</a>
      <a href="articles.php">Artikel</a>
      <a href="videos.php">Video</a>
      <a href="books.php">Buku</a>
      <a href="admin.php">Admin</a>
    </nav>
  </div>
</header>

<main class="container">
  <h2>Tes Kesehatan Mental</h2>
  <p>Jawablah sesuai kondisi yang Anda rasakan dalam <b>2–4 minggu terakhir</b>.  
     Tes ini bukan diagnosis medis.</p>

  <form id="quiz">
    <ol>

<!-- A. Perasaan & Emosi -->
<li><p>Saya merasa sedih tanpa alasan yang jelas</p>
<label><input type="radio" name="q1" value="0" required> • Jarang</label>
<label><input type="radio" name="q1" value="1"> • Kadang</label>
<label><input type="radio" name="q1" value="2"> • Sering</label></li>

<li><p>Saya merasa cemas atau khawatir berlebihan</p>
<label><input type="radio" name="q2" value="0" required> • Jarang</label>
<label><input type="radio" name="q2" value="1"> • Kadang</label>
<label><input type="radio" name="q2" value="2"> • Sering</label></li>

<li><p>Saya mudah tersinggung atau marah</p>
<label><input type="radio" name="q3" value="0" required> • Jarang</label>
<label><input type="radio" name="q3" value="1"> • Kadang</label>
<label><input type="radio" name="q3" value="2"> • Sering</label></li>

<li><p>Saya merasa hampa atau kosong secara emosional</p>
<label><input type="radio" name="q4" value="0" required> • Jarang</label>
<label><input type="radio" name="q4" value="1"> • Kadang</label>
<label><input type="radio" name="q4" value="2"> • Sering</label></li>

<li><p>Saya sulit merasakan kebahagiaan</p>
<label><input type="radio" name="q5" value="0" required> • Jarang</label>
<label><input type="radio" name="q5" value="1"> • Kadang</label>
<label><input type="radio" name="q5" value="2"> • Sering</label></li>

<li><p>Saya merasa takut tanpa sebab yang jelas</p>
<label><input type="radio" name="q6" value="0" required> • Jarang</label>
<label><input type="radio" name="q6" value="1"> • Kadang</label>
<label><input type="radio" name="q6" value="2"> • Sering</label></li>

<li><p>Saya merasa tidak tenang sepanjang hari</p>
<label><input type="radio" name="q7" value="0" required> • Jarang</label>
<label><input type="radio" name="q7" value="1"> • Kadang</label>
<label><input type="radio" name="q7" value="2"> • Sering</label></li>

<!-- B. Pikiran & Konsentrasi -->
<li><p>Saya sering overthinking</p>
<label><input type="radio" name="q8" value="0" required> • Jarang</label>
<label><input type="radio" name="q8" value="1"> • Kadang</label>
<label><input type="radio" name="q8" value="2"> • Sering</label></li>

<li><p>Saya sulit berkonsentrasi</p>
<label><input type="radio" name="q9" value="0" required> • Jarang</label>
<label><input type="radio" name="q9" value="1"> • Kadang</label>
<label><input type="radio" name="q9" value="2"> • Sering</label></li>

<li><p>Saya sering memikirkan hal negatif tentang diri sendiri</p>
<label><input type="radio" name="q10" value="0" required> • Jarang</label>
<label><input type="radio" name="q10" value="1"> • Kadang</label>
<label><input type="radio" name="q10" value="2"> • Sering</label></li>

<li><p>Saya merasa diri saya tidak berguna</p>
<label><input type="radio" name="q11" value="0" required> • Jarang</label>
<label><input type="radio" name="q11" value="1"> • Kadang</label>
<label><input type="radio" name="q11" value="2"> • Sering</label></li>

<li><p>Saya sering membandingkan diri dengan orang lain</p>
<label><input type="radio" name="q12" value="0" required> • Jarang</label>
<label><input type="radio" name="q12" value="1"> • Kadang</label>
<label><input type="radio" name="q12" value="2"> • Sering</label></li>

<li><p>Saya merasa masa depan terlihat suram</p>
<label><input type="radio" name="q13" value="0" required> • Jarang</label>
<label><input type="radio" name="q13" value="1"> • Kadang</label>
<label><input type="radio" name="q13" value="2"> • Sering</label></li>

<li><p>Saya sulit mengambil keputusan</p>
<label><input type="radio" name="q14" value="0" required> • Jarang</label>
<label><input type="radio" name="q14" value="1"> • Kadang</label>
<label><input type="radio" name="q14" value="2"> • Sering</label></li>

<!-- C. Energi & Motivasi -->
<li><p>Saya merasa cepat lelah</p>
<label><input type="radio" name="q15" value="0" required> • Jarang</label>
<label><input type="radio" name="q15" value="1"> • Kadang</label>
<label><input type="radio" name="q15" value="2"> • Sering</label></li>

<li><p>Saya kehilangan minat pada hal yang biasanya saya sukai</p>
<label><input type="radio" name="q16" value="0" required> • Jarang</label>
<label><input type="radio" name="q16" value="1"> • Kadang</label>
<label><input type="radio" name="q16" value="2"> • Sering</label></li>

<li><p>Saya menunda pekerjaan karena kurang motivasi</p>
<label><input type="radio" name="q17" value="0" required> • Jarang</label>
<label><input type="radio" name="q17" value="1"> • Kadang</label>
<label><input type="radio" name="q17" value="2"> • Sering</label></li>

<li><p>Saya merasa tidak punya semangat menjalani hari</p>
<label><input type="radio" name="q18" value="0" required> • Jarang</label>
<label><input type="radio" name="q18" value="1"> • Kadang</label>
<label><input type="radio" name="q18" value="2"> • Sering</label></li>

<li><p>Saya merasa aktivitas sehari-hari terasa berat</p>
<label><input type="radio" name="q19" value="0" required> • Jarang</label>
<label><input type="radio" name="q19" value="1"> • Kadang</label>
<label><input type="radio" name="q19" value="2"> • Sering</label></li>

<li><p>Saya merasa tidak produktif</p>
<label><input type="radio" name="q20" value="0" required> • Jarang</label>
<label><input type="radio" name="q20" value="1"> • Kadang</label>
<label><input type="radio" name="q20" value="2"> • Sering</label></li>

<!-- D. Tidur & Fisik -->
<li><p>Saya sulit tidur di malam hari</p>
<label><input type="radio" name="q21" value="0" required> • Jarang</label>
<label><input type="radio" name="q21" value="1"> • Kadang</label>
<label><input type="radio" name="q21" value="2"> • Sering</label></li>

<li><p>Saya sering terbangun di tengah malam</p>
<label><input type="radio" name="q22" value="0" required> • Jarang</label>
<label><input type="radio" name="q22" value="1"> • Kadang</label>
<label><input type="radio" name="q22" value="2"> • Sering</label></li>

<li><p>Saya tidur terlalu lama tapi tetap merasa lelah</p>
<label><input type="radio" name="q23" value="0" required> • Jarang</label>
<label><input type="radio" name="q23" value="1"> • Kadang</label>
<label><input type="radio" name="q23" value="2"> • Sering</label></li>

<li><p>Saya sering sakit kepala atau pegal tanpa sebab jelas</p>
<label><input type="radio" name="q24" value="0" required> • Jarang</label>
<label><input type="radio" name="q24" value="1"> • Kadang</label>
<label><input type="radio" name="q24" value="2"> • Sering</label></li>

<li><p>Nafsu makan saya berubah (menurun atau meningkat)</p>
<label><input type="radio" name="q25" value="0" required> • Jarang</label>
<label><input type="radio" name="q25" value="1"> • Kadang</label>
<label><input type="radio" name="q25" value="2"> • Sering</label></li>

<!-- E. Hubungan Sosial -->
<li><p>Saya menarik diri dari orang lain</p>
<label><input type="radio" name="q26" value="0" required> • Jarang</label>
<label><input type="radio" name="q26" value="1"> • Kadang</label>
<label><input type="radio" name="q26" value="2"> • Sering</label></li>

<li><p>Saya merasa kesepian meskipun bersama orang lain</p>
<label><input type="radio" name="q27" value="0" required> • Jarang</label>
<label><input type="radio" name="q27" value="1"> • Kadang</label>
<label><input type="radio" name="q27" value="2"> • Sering</label></li>

<li><p>Saya merasa tidak dipahami oleh orang sekitar</p>
<label><input type="radio" name="q28" value="0" required> • Jarang</label>
<label><input type="radio" name="q28" value="1"> • Kadang</label>
<label><input type="radio" name="q28" value="2"> • Sering</label></li>

<li><p>Saya menghindari interaksi sosial</p>
<label><input type="radio" name="q29" value="0" required> • Jarang</label>
<label><input type="radio" name="q29" value="1"> • Kadang</label>
<label><input type="radio" name="q29" value="2"> • Sering</label></li>

<li><p>Saya sulit menceritakan perasaan kepada orang lain</p>
<label><input type="radio" name="q30" value="0" required> • Jarang</label>
<label><input type="radio" name="q30" value="1"> • Kadang</label>
<label><input type="radio" name="q30" value="2"> • Sering</label></li>

<!-- F. Tekanan & Kontrol Diri -->
<li><p>Saya merasa kewalahan menghadapi masalah kecil</p>
<label><input type="radio" name="q31" value="0" required> • Jarang</label>
<label><input type="radio" name="q31" value="1"> • Kadang</label>
<label><input type="radio" name="q31" value="2"> • Sering</label></li>

<li><p>Saya merasa stres berkepanjangan</p>
<label><input type="radio" name="q32" value="0" required> • Jarang</label>
<label><input type="radio" name="q32" value="1"> • Kadang</label>
<label><input type="radio" name="q32" value="2"> • Sering</label></li>

<li><p>Saya merasa sulit mengendalikan emosi</p>
<label><input type="radio" name="q33" value="0" required> • Jarang</label>
<label><input type="radio" name="q33" value="1"> • Kadang</label>
<label><input type="radio" name="q33" value="2"> • Sering</label></li>

<li><p>Saya merasa hidup terasa sangat berat</p>
<label><input type="radio" name="q34" value="0" required> • Jarang</label>
<label><input type="radio" name="q34" value="1"> • Kadang</label>
<label><input type="radio" name="q34" value="2"> • Sering</label></li>

<li><p>Saya sering merasa putus asa</p>
<label><input type="radio" name="q35" value="0" required> • Jarang</label>
<label><input type="radio" name="q35" value="1"> • Kadang</label>
<label><input type="radio" name="q35" value="2"> • Sering</label></li>

<li><p>Saya merasa butuh bantuan tetapi tidak tahu harus ke siapa</p>
<label><input type="radio" name="q36" value="0" required> • Jarang</label>
<label><input type="radio" name="q36" value="1"> • Kadang</label>
<label><input type="radio" name="q36" value="2"> • Sering</label></li>

<li><p>Saya merasa tidak mampu menghadapi masalah sendirian</p>
<label><input type="radio" name="q37" value="0" required> • Jarang</label>
<label><input type="radio" name="q37" value="1"> • Kadang</label>
<label><input type="radio" name="q37" value="2"> • Sering</label></li>

<li><p>Saya merasa perlu istirahat mental</p>
<label><input type="radio" name="q38" value="0" required> • Jarang</label>
<label><input type="radio" name="q38" value="1"> • Kadang</label>
<label><input type="radio" name="q38" value="2"> • Sering</label></li>

<li><p>Saya merasa hidup tidak seimbang</p>
<label><input type="radio" name="q39" value="0" required> • Jarang</label>
<label><input type="radio" name="q39" value="1"> • Kadang</label>
<label><input type="radio" name="q39" value="2"> • Sering</label></li>

<li><p>Saya merasa membutuhkan bantuan profesional</p>
<label><input type="radio" name="q40" value="0" required> • Jarang</label>
<label><input type="radio" name="q40" value="1"> • Kadang</label>
<label><input type="radio" name="q40" value="2"> • Sering</label></li>

    </ol>

    <button type="submit" class="btn">Lihat Hasil</button>
  </form>

  <div id="result" class="result" style="display:none"></div>
</main>

<footer>
  <div class="container">
    <p>&copy; WMH</p>
  </div>
</footer>

<script src="assets/js/app.js"></script>
</body>
</html>

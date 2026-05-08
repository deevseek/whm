// Basic interactivity for quiz
document.addEventListener('DOMContentLoaded', function(){
  var quiz = document.getElementById('quiz');
  if (quiz) {
    quiz.addEventListener('submit', function(e){
      e.preventDefault();
      var score = 0;
      var inputs = quiz.querySelectorAll('input[type=radio]:checked');
      inputs.forEach(function(i){ score += Number(i.value); });
      
      // Determine category based on score
      var category = '';
      if (score <= 13) {
        category = 'Rendah';
        msg = '<h3>Hasil: Rendah</h3><p>Tampaknya gejala Anda rendah. Pertahankan kebiasaan sehat dan terus jaga kesehatan mental.</p>';
      } else if (score <= 26) {
        category = 'Sedang';
        msg = '<h3>Hasil: Sedang</h3><p>Ada tanda-tanda stres/kecemasan. Pertimbangkan berbicara dengan orang terpercaya atau profesional untuk dukungan lebih lanjut.</p>';
      } else if (score <= 40) {
        category = 'Tinggi';
        msg = '<h3>Hasil: Tinggi</h3><p>Terdapat gejala signifikan. Disarankan untuk menghubungi profesional kesehatan mental segera untuk bantuan yang sesuai.</p>';
      } else {
        category = 'Sangat Tinggi';
        msg = '<h3>Hasil: Sangat Tinggi</h3><p>Gejala yang Anda alami sangat signifikan. Sangat penting untuk segera menghubungi profesional kesehatan mental atau lembaga bantuan krisis.</p>';
      }
      
      var resultBox = document.getElementById('result');
      resultBox.innerHTML = msg + '<p><strong>Total Skor: ' + score + '</strong></p>';
      resultBox.style.display = 'block';
      resultBox.scrollIntoView({behavior:'smooth'});
      
      // Save results to database
      saveTestResult(score, category);
    });
  }
});

function saveTestResult(score, category) {
  var data = {
    score: score,
    category: category,
    nama: 'Pengunjung'
  };
  
  fetch('api_save_test.php', {
    method: 'POST',
    headers: {
      'Content-Type': 'application/json',
    },
    body: JSON.stringify(data)
  })
  .then(response => response.json())
  .then(data => {
    if (data.success) {
      console.log('Hasil tes tersimpan');
    }
  })
  .catch((error) => {
    console.log('Gagal menyimpan hasil tes:', error);
  });
}


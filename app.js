// Basic interactivity for quiz
document.addEventListener('DOMContentLoaded', function(){
  var quiz = document.getElementById('quiz');
  if (quiz) {
    quiz.addEventListener('submit', function(e){
      e.preventDefault();
      var score = 0;
      var inputs = quiz.querySelectorAll('input[type=radio]:checked');
      inputs.forEach(function(i){ score += Number(i.value); });
      var resultBox = document.getElementById('result');
      var msg = '';
      if (score <= 2) {
        msg = '<h3>Hasil: Rendah</h3><p>Tampaknya gejala Anda rendah. Pertahankan kebiasaan sehat.</p>';
      } else if (score <= 6) {
        msg = '<h3>Hasil: Sedang</h3><p>Ada tanda-tanda stres/kecemasan. Pertimbangkan berbicara dengan orang terpercaya atau profesional.</p>';
      } else {
        msg = '<h3>Hasil: Tinggi</h3><p>Terdapat gejala signifikan. Disarankan untuk menghubungi profesional kesehatan mental.</p>';
      }
      resultBox.innerHTML = msg;
      resultBox.style.display = 'block';
      resultBox.scrollIntoView({behavior:'smooth'});
    });
  }
});

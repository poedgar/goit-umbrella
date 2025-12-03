console.log('olenka');

document.addEventListener('DOMContentLoaded', function () {
  const video = document.getElementById('impactVideo');
  const playButton = document.getElementById('playButton');

  playButton.addEventListener('click', function () {
    video.play();
    playButton.style.display = 'none';
  });

  // Опційно: можна показати кнопку знову, коли відео закінчиться
  video.addEventListener('ended', function () {
    playButton.style.display = 'block';
  });
});

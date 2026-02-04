document.addEventListener('DOMContentLoaded', function () {
  const video = document.getElementById('impactVideo');
  const playButton = document.getElementById('playButton');

  if (!video || !playButton) return;

  playButton.addEventListener('click', function () {
    video.play();
    playButton.style.display = 'none';
  });

  // Опційно: можна показати кнопку знову, коли відео закінчиться
  video.addEventListener('ended', function () {
    playButton.style.display = 'block';
  });
});

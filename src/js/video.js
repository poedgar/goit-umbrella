document.addEventListener('DOMContentLoaded', function () {
  const video = document.getElementById('impactVideo');
  const playButton = document.getElementById('playButton');
  const iframe = document.getElementById("impactVideo");

  if (!video || !playButton) return;

  playButton.addEventListener('click', function () {
    iframe.src = "https://www.youtube.com/embed/GBYrd07HAfQ?rel=0&autoplay=1";

    playButton.style.display = 'none';
  });

  // Опційно: можна показати кнопку знову, коли відео закінчиться.
  video.addEventListener('ended', function () {
    playButton.style.display = 'block';
  });
});

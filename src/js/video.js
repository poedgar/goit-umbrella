document.addEventListener('DOMContentLoaded', function () {
  const video = document.getElementById('impactVideo');
  const playButton = document.getElementById('playButton');
  const source1 = document.getElementById("impactVideoSourceMp4");
  const source2 = document.getElementById("impactVideoSourceWebm");

  if (!video || !playButton) return;

  playButton.addEventListener('click', function () {
    source1.src = "https://www.bettered.global/wp-content/themes/goit-global/main-homepage-video.mp4";
    source2.src = "https://www.bettered.global/wp-content/themes/goit-global/main-homepage-video.webm";

    video.load();

    video.muted = false;

    video.volume = 1.0;

    video.play();
    playButton.style.display = 'none';
  });

  // Опційно: можна показати кнопку знову, коли відео закінчиться
  video.addEventListener('ended', function () {
    playButton.style.display = 'block';
  });
});

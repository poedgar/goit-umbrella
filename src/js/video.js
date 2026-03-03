document.addEventListener('DOMContentLoaded', function () {
  const video = document.getElementById('impactVideo');
  const playButton = document.getElementById('playButton');
  const source1 = document.getElementById("impactVideoSourceMp4");
  const source2 = document.getElementById("impactVideoSourceWebm");

  if (!video || !playButton) return;

  playButton.addEventListener('click', function () {
    source1.src = "<?= esc_url($video_url['url']); ?>";
    source2.src = "<?= esc_url($video_url['url']); ?>";

    video.load();

    video.play();
    playButton.style.display = 'none';
  });

  // Опційно: можна показати кнопку знову, коли відео закінчиться
  video.addEventListener('ended', function () {
    playButton.style.display = 'block';
  });
});

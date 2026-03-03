document.addEventListener('DOMContentLoaded', function () {
  const video = document.getElementById('impactVideo');
  const playButton = document.getElementById('playButton');
  const source1 = document.getElementById("impactVideoSourceMp4");
  const source2 = document.getElementById("impactVideoSourceWebm");

  if (!video || !playButton) return;

  playButton.addEventListener('click', function () {
    source1.src = "https://www.bettered.global/wp-content/uploads/2025/12/video.mp4";
    source2.src = "https://www.bettered.global/wp-content/uploads/2025/12/video.webm";

    console.log(source1.src, "sourc1.src");

    video.load();

    video.play();
    playButton.style.display = 'none';
  });

  // Опційно: можна показати кнопку знову, коли відео закінчиться
  video.addEventListener('ended', function () {
    playButton.style.display = 'block';
  });
});

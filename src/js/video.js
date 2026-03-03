var player;

function onYouTubeIframeAPIReady() {
  player = new YT.Player('impactVideo');
  console.log('Player ready');
}

// document.addEventListener('DOMContentLoaded', function () {
//   const playButton = document.getElementById('playButton');
//   const iframe = document.getElementById('impactVideo');

//   if (!iframe || !playButton) return;

//   playButton.addEventListener('click', function () {
//     // Switch to second video with sound
//     player.loadVideoById('Dn1zS16jhbg');
//     player.unMute();
//     player.setLoop(false);

//     // iframe.src = "https://www.youtube.com/embed/Dn1zS16jhbg?si=h_PYub1HsQaqDb0P&autoplay=1&mute=1&rel=0";
//     playButton.style.display = 'none';
//   });
// });


document.addEventListener('DOMContentLoaded', function () {
  var playButton = document.getElementById('playButton');
  if (!playButton) return;

  playButton.addEventListener('click', function () {
    if (!player || !player.loadVideoById) {
      console.log('Player not ready');
      return;
    }
    player.loadVideoById('Dn1zS16jhbg');
    player.unMute();
    player.setLoop(false);
    playButton.style.display = 'none';
  });
});
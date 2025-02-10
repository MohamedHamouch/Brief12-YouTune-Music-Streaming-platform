const audioPlayer = document.querySelector('#audioPlayer');
const audioSource = document.querySelector('#audioSource');
const playButtons = document.querySelectorAll('.play-button');

let currentlyPlaying = null;

playButtons.forEach(button => {
  button.addEventListener('click', () => {
    const song = button.getAttribute('data-song');
    const icon = button.querySelector('i');

    if (currentlyPlaying === button) {
      if (audioPlayer.paused) {
        audioPlayer.play();
        icon.classList.remove('fa-play-circle');
        icon.classList.add('fa-pause-circle');
      } else {
        audioPlayer.pause();
        icon.classList.remove('fa-pause-circle');
        icon.classList.add('fa-play-circle');
      }
      return;
    }

    if (currentlyPlaying) {
      const prevIcon = currentlyPlaying.querySelector('i');
      prevIcon.classList.remove('fa-pause-circle');
      prevIcon.classList.add('fa-play-circle');
    }

    audioSource.src = song;
    audioPlayer.load();
    audioPlayer.play();

    icon.classList.remove('fa-play-circle');
    icon.classList.add('fa-pause-circle');
    currentlyPlaying = button;
  });
});


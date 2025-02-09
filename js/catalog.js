const albumForm = document.querySelector('#albumForm');

function openAlbumForm() {
  albumForm.classList.remove('hidden');
}

function closeAlbumForm() {
  albumForm.classList.add('hidden');
}

window.addEventListener('click', (e) => {
  if (e.target === albumForm) {
    closeAlbumForm();
  }
});

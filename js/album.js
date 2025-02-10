const playlistForm = document.querySelector('#playlistForm');
const songIdInput = document.querySelector('#song_id');
const songTitleInput = document.querySelector('#song_title');

function closeForm() {
  playlistForm.classList.add('hidden');
}

document.querySelectorAll('.add-to-playlist').forEach(button => {
  button.addEventListener('click', () => {
    songIdInput.value = button.dataset.id;
    songTitleInput.value = button.dataset.title;
    playlistForm.classList.remove('hidden');
  });
});

const uploadForm = document.querySelector('#uploadForm');

function openUploadForm() {
  uploadForm.classList.remove('hidden');
}

function closeUploadForm() {
  uploadForm.classList.add('hidden');
}
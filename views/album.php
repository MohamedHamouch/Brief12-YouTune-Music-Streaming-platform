<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Album Detail</title>
  <script src="https://cdn.tailwindcss.com"></script>
  <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css" rel="stylesheet">
</head>

<body class="bg-gray-900 text-white">

  <?php
  require_once "header.php";

  if (isset($_SESSION['error'])) {
    echo "<script>alert('{$_SESSION['error']}')</script>";
    unset($_SESSION['error']);
  }

  if (isset($_SESSION['message'])) {
    echo "<script>alert('{$_SESSION['message']}')</script>";
    unset($_SESSION['message']);
  }
  ?>
  <section class="max-w-4xl mx-auto p-8">

    <div class="bg-gray-800 p-6 rounded-lg shadow-lg">
      <div class="flex flex-col md:flex-row items-center">
        <img src="<?= htmlspecialchars($album->getCover()) ?>" alt="Album Cover"
          class="w-40 h-40 object-cover rounded-lg mb-4 md:mb-0 md:mr-6">

        <div class="text-center md:text-left">
          <h1 class="text-4xl font-extrabold"><?= htmlspecialchars($album->getTitle()) ?></h1>

          <p class="text-lg text-gray-400 mt-2"><?= htmlspecialchars($artisUsername) ?></p>

          <p class="text-sm text-gray-500 mt-1">Released: <?= htmlspecialchars($album->getCreatedAt()) ?></p>

          <?php if ($user instanceof Artist && $user->getId() == $album->getArtistId()): ?>
            <button onclick="openUploadForm()"
              class="mt-4 bg-indigo-600 text-white px-4 py-2 rounded-lg flex items-center">
              <i class="fas fa-upload mr-2"></i>
              Upload Song
            </button>
          <?php endif; ?>
        </div>
      </div>
    </div>

  </section>

  <section class="max-w-4xl mx-auto p-8">
    <div class="bg-gray-800 p-6 rounded-lg shadow-lg">
      <h2 class="text-2xl font-semibold mb-4">Song List</h2>

      <?php if (empty($songs)): ?>
        <p class="text-gray-400">No songs yet</p>
      <?php else: ?>
        <ul class="space-y-4">
          <?php foreach ($songs as $song): ?>
            <li class="flex items-center justify-between bg-gray-700 p-4 rounded-lg hover:bg-gray-600">
              <div class="flex items-center">
                <i class="fas fa-music text-indigo-500 mr-4"></i>
                <span><?= htmlspecialchars($song['title']) ?></span>
              </div>
              <div class="flex items-center space-x-4">
                <button class="text-white play-button" data-song="<?= $song['audio'] ?>">
                  <i class="fas fa-play-circle text-2xl"></i>
                </button>

                <?php if ($user instanceof Member): ?>
                  <button class="text-green-500 add-to-playlist" data-id="<?= $song['id'] ?>"
                    data-title="<?= htmlspecialchars($song['title']) ?>">
                    <i class="fas fa-plus-circle text-2xl"></i>
                  </button>
                <?php elseif ($user instanceof Artist && $user->getId() == $album->getArtistId()): ?>
                  <form action="/album" method="POST" class="inline-block">
                    <input type="hidden" name="song_id" value="<?= $song['id'] ?>">
                    <input type="hidden" name="album_id" value="<?= $album->getId() ?>">
                    <button type="submit" name="remove_song" class="text-red-500">
                      <i class="fas fa-trash-alt text-xl"></i>
                    </button>
                  </form>
                <?php endif; ?>
              </div>
            </li>
          <?php endforeach; ?>
        </ul>
      <?php endif; ?>
    </div>
  </section>


  <?php if ($user instanceof Member) { ?>

    <div id="playlistForm" class="hidden fixed inset-0 bg-black bg-opacity-50 flex items-center justify-center">
      <form class="bg-gray-800 p-6 rounded-lg shadow-lg w-96">
        <input type="hidden" name="song_id" id="song_id">
        <div class="mb-4">
          <label class="block text-sm font-medium mb-2">Song Title</label>
          <input type="text" id="song_title" class="w-full bg-gray-700 rounded p-2" readonly>
        </div>
        <div class="mb-4">
          <label class="block text-sm font-medium mb-2">Select Playlist</label>
          <select name="playlist_id" class="w-full bg-gray-700 rounded p-2">

            <?php foreach ($playlists as $playlist): ?>
              <option value="<?= $playlist['id'] ?>"><?= htmlspecialchars($playlist['title']) ?></option>
            <?php endforeach; ?>
          </select>
        </div>
        <div class="flex justify-end space-x-3">
          <button type="button" onclick="closeForm()" class="px-4 py-2 bg-gray-600 rounded">Cancel</button>
          <button type="submit" class="px-4 py-2 bg-indigo-600 rounded">Add</button>
        </div>
      </form>
    </div>


  <?php }

  if ($user instanceof Artist && $user->getId() == $album->getArtistId()): ?>
    <div id="uploadForm" class="hidden fixed inset-0 bg-black bg-opacity-50 flex items-center justify-center">
      <form class="bg-gray-800 p-6 rounded-lg shadow-lg w-96" action="/album" enctype="multipart/form-data" method="POST">
        <input type="hidden" name="album_id" value="<?= $album_id ?>">

        <div class="mb-4">
          <label class="block text-sm font-medium mb-2">Song Title</label>
          <input type="text" name="title" class="w-full bg-gray-700 rounded p-2" required>
        </div>

        <div class="mb-4">
          <label class="block text-sm font-medium mb-2">Audio File</label>
          <input type="file" name="audio" accept="audio/*"
            class="w-full bg-gray-700 rounded p-2 text-sm file:mr-4 file:py-2 file:px-4 file:rounded-full file:border-0 file:bg-indigo-600 file:text-white hover:file:bg-indigo-700"
            required>
        </div>

        <div class="flex justify-end space-x-3">
          <button type="button" onclick="closeUploadForm()" class="px-4 py-2 bg-gray-600 rounded">Cancel</button>
          <button type="submit" name="upload_song" class="px-4 py-2 bg-indigo-600 rounded">Upload</button>
        </div>
      </form>
    </div>
  <?php endif; ?>


  <audio id="audioPlayer" class="fixed bottom-0 left-0 w-full opacity-0 pointer-events-none" controls>
    <source id="audioSource" type="audio/mp3">
    Your browser does not support the audio element.
  </audio>

  <script src="../js/song.js"></script>
</body>

</html>
<?php
$songs = [
  ['title' => 'Song Title 1', 'artist' => 'Artist 1', 'date' => '2024-01-01', 'audio_file' => '../assets/labess.mp3'],
  ['title' => 'Song Title 2', 'artist' => 'Artist 2', 'date' => '2024-01-01', 'audio_file' => 'assets/song2.mp3'],
  ['title' => 'Song Title 3', 'artist' => 'Artist 3', 'date' => '2024-01-01', 'audio_file' => 'assets/song3.mp3'],
];
?>

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
  ?>
  
  <section class="max-w-4xl mx-auto p-8">
    <!-- Album Detail -->
    <div class="bg-gray-800 p-6 rounded-lg shadow-lg">
      <div class="flex flex-col md:flex-row items-center">
        <!-- Album Cover -->
        <img src="https://via.placeholder.com/150" alt="Album Cover"
          class="w-40 h-40 object-cover rounded-lg mb-4 md:mb-0 md:mr-6">

        <div class="text-center md:text-left">
          <h1 class="text-4xl font-extrabold">Album Title</h1>
          <p class="text-lg text-gray-400 mt-2">Artist Name</p>
          <p class="text-sm text-gray-500 mt-1">Released: 2024-01-01</p>
        </div>
      </div>

      <div class="mt-8">
        <h2 class="text-2xl font-semibold mb-4">Song List</h2>
        <ul class="space-y-4">
          <?php foreach ($songs as $song): ?>
            <li class="flex items-center justify-between bg-gray-700 p-4 rounded-lg hover:bg-gray-600">
              <div class="flex items-center">
                <i class="fas fa-music text-indigo-500 mr-4"></i>
                <span><?= htmlspecialchars($song['title']) ?></span>
              </div>
              <div class="flex items-center space-x-4">

                <button class="text-white play-button" data-song="<?= $song['audio_file'] ?>">
                  <i class="fas fa-play-circle text-2xl"></i>
                </button>

                <button class="text-red-500">
                  <i class="fas fa-trash-alt text-xl"></i>
                </button>
              </div>
            </li>
          <?php endforeach; ?>
        </ul>
      </div>
    </div>
  </section>

  <audio id="audioPlayer" class="fixed bottom-0 left-0 w-full opacity-0 pointer-events-none" controls>
    <source id="audioSource" type="audio/mp3">
    Your browser does not support the audio element.
  </audio>

  <script src="../js/song.js"></script>
</body>

</html>
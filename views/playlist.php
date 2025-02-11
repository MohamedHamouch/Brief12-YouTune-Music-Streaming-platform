<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Playlist Detail</title>
  <script src="https://cdn.tailwindcss.com"></script>
  <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css" rel="stylesheet">
</head>

<body class="bg-gray-900 text-white">

  <?php require_once "header.php"; ?>

  <section class="max-w-4xl mx-auto p-8">
    <div class="bg-gray-800 p-6 rounded-lg shadow-lg">
      <h1 class="text-4xl font-extrabold text-center"> <?= htmlspecialchars($playlist->getTitle()) ?> </h1>
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
                <button class="text-red-500 delete-song" data-id="<?= $song['id'] ?>">
                  <i class="fas fa-trash-alt text-xl"></i>
                </button>
              </div>
            </li>
          <?php endforeach; ?>
        </ul>
      <?php endif; ?>
    </div>
  </section>

  <audio id="audioPlayer" class="fixed bottom-0 left-0 w-full opacity-0 pointer-events-none" controls>
    <source id="audioSource" type="audio/mp3">
    Your browser does not support the audio element.
  </audio>

  <script src="../js/song.js"></script>
</body>

</html>
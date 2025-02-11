<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>YouTune - My Playlists</title>
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
  <section class="p-8">
    <h2 class="text-3xl font-extrabold text-center mb-6">Create New Playlist</h2>
    <form action="/library" method="POST"
      class="max-w-3xl mx-auto bg-gray-800 p-6 rounded-lg shadow-lg grid grid-cols-1 md:grid-cols-3 gap-6">

      <div class="mb-4 col-span-2 md:col-span-2">
        <label for="playlist-title" class="block text-lg font-medium text-gray-300">Playlist Title</label>
        <input type="text" id="playlist-title" name="title" placeholder="Enter playlist title"
          class="mt-2 px-4 py-2 w-full bg-gray-700 text-white rounded-md focus:outline-none focus:ring-2 focus:ring-indigo-500">
      </div>

      <div class="mb-4 col-span-2 md:col-span-1">
        <label for="visibility" class="block text-lg font-medium text-gray-300">Visibility</label>
        <select id="visibility" name="visibility"
          class="mt-2 px-4 py-2 w-full bg-gray-700 text-white rounded-md focus:outline-none focus:ring-2 focus:ring-indigo-500">
          <option value="public">Public</option>
          <option value="private">Private</option>
        </select>
      </div>

      <div class="col-span-2">
        <button type="submit" name="create_playlist"
          class="w-full sm:w-1/2 mx-auto px-6 py-2 bg-indigo-600 text-white font-bold rounded-md hover:bg-indigo-700 transition-all">Create
          Playlist</button>
      </div>
    </form>
  </section>



  <section class="p-8">
    <h2 class="text-3xl font-extrabold text-center mb-8">My Playlists</h2>

    <?php if (empty($playlists)):
      ?>
      <p class="text-center text-gray-400">No playlists available</p>
    <?php else: ?>
      <div class="grid grid-cols-2 md:grid-cols-3 lg:grid-cols-4 xl:grid-cols-5 gap-8">
        <?php foreach ($playlists as $playlist): ?>
          <div class="bg-gray-800 p-6 rounded-lg shadow-lg hover:bg-gray-700 transition-all">
            <div class="bg-gradient-to-r from-indigo-500 to-purple-600 p-4 rounded-md mb-4 flex items-center space-x-3">
              <i class="fas fa-headphones-alt text-white text-3xl"></i>
              <a href="/playlist?id=<?= $playlist['id'] ?>" class="text-lg font-bold text-white hover:text-gray-300">
                <?= htmlspecialchars($playlist['title']) ?>
              </a>
            </div>
            <p class="text-gray-500 text-xs">Created: <?= htmlspecialchars($playlist['created_at']) ?></p>
          </div>
        <?php endforeach; ?>
      </div>
    <?php endif; ?>
  </section>

</body>

</html>
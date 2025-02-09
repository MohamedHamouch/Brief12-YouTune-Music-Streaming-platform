<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>YouTune - Catalog</title>
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
    <div class="max-w-7xl mx-auto">
      <div class="flex justify-between items-center mb-8">
        <h2 class="text-3xl font-extrabold">Albums Catalog</h2>
        <button onclick="openAlbumForm()"
          class="bg-indigo-600 text-white px-4 py-2 rounded-lg flex items-center hover:bg-indigo-700">
          <i class="fas fa-plus mr-2"></i>
          Create New Album
        </button>
      </div>

      <?php if (empty($albums)): ?>
        <p class="text-center text-gray-500">You haven't posted any albums yet.</p>
      <?php else: ?>
        <div class="grid grid-cols-2 md:grid-cols-3 lg:grid-cols-4 xl:grid-cols-5 gap-8">
          <?php foreach ($albums as $album): ?>
            <div class="bg-gray-800 p-4 rounded-lg hover:bg-gray-700 transition-all">
              <img src="<?= htmlspecialchars($album['cover']) ?>" class="w-full h-48 object-cover rounded-md mb-4"
                alt="Album Cover">
              <a href="/album?id=<?= $album['id'] ?>"
                class="text-lg font-bold hover:text-gray-400"><?= htmlspecialchars($album['title']) ?></a>
              <p class="text-gray-400 text-sm"><?= htmlspecialchars($user->getUsername()) ?></p>
              <p class="text-gray-500 text-xs">Release Date: <?= htmlspecialchars($album['created_at']) ?></p>
            </div>
          <?php endforeach; ?>
        </div>
      <?php endif; ?>
    </div>
  </section>



  <div id="albumForm" class="hidden fixed inset-0 bg-black bg-opacity-50 flex items-center justify-center">
    <form class="bg-gray-800 p-6 rounded-lg shadow-lg w-96" enctype="multipart/form-data" method="POST">
      <div class="mb-4">
        <label class="block text-sm font-medium mb-2">Album Title</label>
        <input type="text" name="title" class="w-full bg-gray-700 rounded p-2" required>
      </div>

      <div class="mb-4">
        <label class="block text-sm font-medium mb-2">Cover Image</label>
        <input type="file" name="cover" accept="image/*"
          class="w-full bg-gray-700 rounded p-2 text-sm file:mr-4 file:py-2 file:px-4 file:rounded-full file:border-0 file:bg-indigo-600 file:text-white hover:file:bg-indigo-700"
          required>
      </div>

      <div class="flex justify-end space-x-3">
        <button type="button" onclick="closeAlbumForm()"
          class="px-4 py-2 bg-gray-600 rounded hover:bg-gray-700">Cancel</button>
        <button type="submit" name="create_album" class="px-4 py-2 bg-indigo-600 rounded hover:bg-indigo-700">Create
          Album</button>
      </div>
    </form>
  </div>
  <script src="../js/catalog.js"></script>
</body>

</html>
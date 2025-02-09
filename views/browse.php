<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>YouTune - All Albums</title>
  <script src="https://cdn.tailwindcss.com"></script>
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
    <h2 class="text-3xl font-extrabold text-center mb-8">All Albums</h2>
    <div class="grid grid-cols-2 md:grid-cols-3 lg:grid-cols-4 xl:grid-cols-5 gap-8">
      <?php foreach ($albums as $album): ?>
        <div class="bg-gray-800 p-4 rounded-lg hover:bg-gray-700 transition-all">
          <img src="<?= htmlspecialchars($album['cover']) ?>" class="w-full rounded-md mb-4" alt="Album Cover">
          <a href="/album?id=<?= $album['id'] ?>"
            class="text-lg font-bold hover:text-gray-400"><?= htmlspecialchars($album['title']) ?></a>
          <p class="text-gray-400 text-sm"><?= htmlspecialchars($album['username']) ?></p>
          <p class="text-gray-500 text-xs">Release Date: <?= htmlspecialchars($album['created_at']) ?></p>
        </div>
      <?php endforeach; ?>
    </div>
  </section>
</body>

</html>
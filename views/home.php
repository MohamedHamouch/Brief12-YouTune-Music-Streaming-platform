<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>YouTune - Home</title>
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

  <section class="text-center py-24 bg-gradient-to-r from-purple-600 to-blue-500">
    <h2 class="text-5xl font-extrabold">Discover Your Next Favorite Song</h2>
    <p class="mt-4 text-xl">Stream millions of songs ad-free, anytime, anywhere.</p>
    <a href="/browse"
      class="inline-block mt-8 px-8 py-3 bg-white text-gray-900 font-bold rounded-full text-lg shadow-lg hover:bg-gray-200">
      Start Listening
    </a>
  </section>

  <section class="p-10">
    <h3 class="text-3xl font-semibold mb-6">Trending Now</h3>
    <div class="grid grid-cols-2 md:grid-cols-4 gap-6">
      <div class="bg-gray-800 p-6 rounded-lg shadow-md">
        <img src="https://via.placeholder.com/150" class="w-full rounded-md" alt="Album Cover">
        <h4 class="mt-3 font-bold text-lg">Album Name</h4>
        <p class="text-gray-400 text-sm">Artist Name</p>
      </div>
      <div class="bg-gray-800 p-6 rounded-lg shadow-md">
        <img src="https://via.placeholder.com/150" class="w-full rounded-md" alt="Album Cover">
        <h4 class="mt-3 font-bold text-lg">Album Name</h4>
        <p class="text-gray-400 text-sm">Artist Name</p>
      </div>
      <div class="bg-gray-800 p-6 rounded-lg shadow-md">
        <img src="https://via.placeholder.com/150" class="w-full rounded-md" alt="Album Cover">
        <h4 class="mt-3 font-bold text-lg">Album Name</h4>
        <p class="text-gray-400 text-sm">Artist Name</p>
      </div>
      <div class="bg-gray-800 p-6 rounded-lg shadow-md">
        <img src="https://via.placeholder.com/150" class="w-full rounded-md" alt="Album Cover">
        <h4 class="mt-3 font-bold text-lg">Album Name</h4>
        <p class="text-gray-400 text-sm">Artist Name</p>
      </div>
    </div>
  </section>
</body>

</html>
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
  ?>

  <section class="p-8">
    <h2 class="text-3xl font-extrabold text-center mb-8">All Albums</h2>
    <div class="grid grid-cols-2 md:grid-cols-3 lg:grid-cols-4 xl:grid-cols-5 gap-8"> 
      <!-- Album Cards -->
      <div class="bg-gray-800 p-4 rounded-lg hover:bg-gray-700 transition-all">
        <img src="https://via.placeholder.com/200" class="w-full rounded-md mb-4" alt="Album Cover">
        <a href="#" class="text-lg font-bold hover:text-gray-400">Album Title</a>
        <p class="text-gray-400 text-sm">Artist Name</p>
        <p class="text-gray-500 text-xs">Release Date: 2024-01-01</p>
      </div>
      <div class="bg-gray-800 p-4 rounded-lg hover:bg-gray-700 transition-all">
        <img src="https://via.placeholder.com/200" class="w-full rounded-md mb-4" alt="Album Cover">
        <a href="#" class="text-lg font-bold hover:text-gray-400">Album Title</a>
        <p class="text-gray-400 text-sm">Artist Name</p>
        <p class="text-gray-500 text-xs">Release Date: 2023-12-15</p>
      </div>
      <div class="bg-gray-800 p-4 rounded-lg hover:bg-gray-700 transition-all">
        <img src="https://via.placeholder.com/200" class="w-full rounded-md mb-4" alt="Album Cover">
        <a href="#" class="text-lg font-bold hover:text-gray-400">Album Title</a>
        <p class="text-gray-400 text-sm">Artist Name</p>
        <p class="text-gray-500 text-xs">Release Date: 2023-11-20</p>
      </div>
      <div class="bg-gray-800 p-4 rounded-lg hover:bg-gray-700 transition-all">
        <img src="https://via.placeholder.com/200" class="w-full rounded-md mb-4" alt="Album Cover">
        <a href="#" class="text-lg font-bold hover:text-gray-400">Album Title</a>
        <p class="text-gray-400 text-sm">Artist Name</p>
        <p class="text-gray-500 text-xs">Release Date: 2023-09-25</p>
      </div>
      <!-- Add more album cards as needed -->
    </div>
  </section>
</body>

</html>
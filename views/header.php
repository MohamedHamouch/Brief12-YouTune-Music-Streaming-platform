<header class="flex justify-between items-center p-6 bg-gray-800 shadow-lg">
  <h1 class="text-3xl font-extrabold text-purple-400">YouTune</h1>
  <nav>

    <ul class="flex space-x-6 text-lg">
      <li><a href="/" class="hover:text-purple-400">Home</a></li>
      <li><a href="/browse" class="hover:text-purple-400">Browse</a></li>
      <li><a href="/library" class="hover:text-purple-400">Library</a></li>

      <?php
      if (session_status() === PHP_SESSION_NONE)
        session_start();
      if (isset($_SESSION['user'])) { ?>

        <li><a href="/logout" class="hover:text-purple-400">Logout</a></li>

      <?php } else { ?>
        <li><a href="/login" class="hover:text-purple-400">Login</a></li>
      <?php } ?>
    </ul>
  </nav>
</header>
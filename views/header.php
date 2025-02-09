<header class="flex justify-between items-center p-6 bg-gray-800 shadow-lg">
  <h1 class="text-3xl font-extrabold text-purple-400">YouTune</h1>
  <nav>
    <ul class="flex space-x-6 text-lg">
      <li><a href="/" class="hover:text-purple-400">Home</a></li>
      <li><a href="/browse" class="hover:text-purple-400">Browse</a></li>

      <?php
      if (session_status() === PHP_SESSION_NONE)
        session_start();

      if (isset($_SESSION['user'])) {
        $user = unserialize($_SESSION['user']);

        if ($user instanceof Admin) {
          echo '<li><a href="/dashboard" class="hover:text-purple-400">Dashboard</a></li>';
        } elseif ($user instanceof Artist) {
          echo '<li><a href="/catalog" class="hover:text-purple-400">Catalog</a></li>';
        }

        echo '<li><a href="/logout" class="hover:text-purple-400">Logout</a></li>';
      } else {
        echo '<li><a href="/login" class="hover:text-purple-400">Login</a></li>';
        echo '<li><a href="/register" class="hover:text-purple-400">Register</a></li>';
      }
      
      ?>
    </ul>
  </nav>
</header>
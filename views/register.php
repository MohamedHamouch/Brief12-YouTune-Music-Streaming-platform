<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>YouTune - Register</title>
  <script src="https://cdn.tailwindcss.com"></script>
</head>

<body class="bg-gray-900 text-white">
  <?php
  require_once "header.php";

  if (isset($_SESSION['error'])) {
    echo "<script>alert('{$_SESSION['error']}')</script>";
    unset($_SESSION['error']);
  }
  ?>

  <section class="max-w-lg mx-auto p-8 bg-gray-800 rounded-lg mt-10">
    <h2 class="text-3xl font-extrabold text-center mb-8">Create Your Account</h2>

    <form action="#" method="POST">
      <div class="mb-4">
        <label for="username" class="block text-sm font-medium">Username</label>
        <input type="text" id="username" name="username" required
          class="w-full p-3 mt-2 bg-gray-700 text-white rounded-lg border border-gray-600 focus:outline-none focus:ring-2 focus:ring-purple-600">
      </div>

      <div class="mb-4">
        <label for="email" class="block text-sm font-medium">Email Address</label>
        <input type="email" id="email" name="email" required
          class="w-full p-3 mt-2 bg-gray-700 text-white rounded-lg border border-gray-600 focus:outline-none focus:ring-2 focus:ring-purple-600">
      </div>

      <div class="mb-4">
        <label for="password" class="block text-sm font-medium">Password</label>
        <input type="password" id="password" name="password" required
          class="w-full p-3 mt-2 bg-gray-700 text-white rounded-lg border border-gray-600 focus:outline-none focus:ring-2 focus:ring-purple-600">
      </div>

      <div class="mb-4">
        <label for="role" class="block text-sm font-medium">Register As</label>
        <select id="role" name="role" required
          class="w-full p-3 mt-2 bg-gray-700 text-white rounded-lg border border-gray-600 focus:outline-none focus:ring-2 focus:ring-purple-600">
          <option value="member" selected>Listener</option>
          <option value="artist">Artist</option>
        </select>
      </div>

      <div class="flex justify-center">
        <button type="submit"
          class="w-full py-3 px-6 bg-purple-600 text-white font-bold rounded-lg hover:bg-purple-700 focus:outline-none focus:ring-2 focus:ring-purple-600">Register</button>
      </div>
    </form>

    <p class="mt-4 text-center text-sm">
      Already have an account? <a href="/login" class="text-purple-600 hover:text-purple-400">Login</a>
    </p>
  </section>
</body>

</html>
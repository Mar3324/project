<ul class="nav justify-content-end">
  <li class="nav-item">
    <a class="nav-link active" href="register.php">Register</a>
  </li>
  <?php if(isset($_SESSION['loggedIn'])): ?>
  <li class="nav-item">
    <a class="nav-link" href="#"><?=$_SESSION['loggedInUser']['name']; ?></a>
  </li>
  <li class="nav-item">
    <a class="nav-link" href="logout.php">Logout</a>
  </li>
  <?php else: ?>
  <li class="nav-item">
    <a class="nav-link" href="login.php">Login</a>
  </li>
 <?php endif; ?>
</ul>
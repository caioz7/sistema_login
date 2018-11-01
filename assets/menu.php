<h2 class="bg-primary text-white pl-3 pt-2 pb-2 m-0">SISTEMA FCV</h2>
<ul class="nav justify-content-left bg-dark">
  <li class="nav-item">
    <a class="nav-link text-white" href="home.php">Home</a>
  </li>
  <li class="nav-item">
    <a class="nav-link text-white" href="agenda.php">Agenda</a>
  </li>
  <li class="nav-item float-right">
    <a class="nav-link text-danger" href="logout.php">SAIR</a>
  </li>
</ul>
<div class="row">
  <div class="col">
    <p class="ml-3">
        Seja bem vindo, <b><?php echo $_SESSION['user_name']; ?></b>.
    </p>
  </div>
</div>
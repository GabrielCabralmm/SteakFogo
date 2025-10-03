<main class="container my-4">
  <h1 class="mb-4">Área Administrativa</h1>
  <div class="row g-4"><!-- g-4 = espaçamento entre colunas -->
 
    <!-- ADM PRODUTOS -->
    <div class="col-sm-6 col-md-4">
      <div class="card border-danger text-center">
        <div class="card-body">
          <i class="bi bi-bag-fill fs-1 text-danger"></i>
          <h5 class="card-title text-danger">PRODUTOS</h5>
          <div class="d-grid gap-2">
            <a href="produtos_lista.php" class="btn btn-danger">LISTAR</a>
            <a href="produtos_insere.php" class="btn btn-danger">INSERIR</a>
          </div>
        </div>
      </div>
    </div>
    <!-- fecha ADM PRODUTOS -->
 
    <!-- ADM TIPOS -->
    <div class="col-sm-6 col-md-4">
      <div class="card border-warning text-center">
        <div class="card-body">
          <i class="bi bi-list-task fs-1 text-warning"></i>
          <h5 class="card-title text-warning">TIPOS</h5>
          <div class="d-grid gap-2">
            <a href="tipos_lista.php" class="btn btn-warning">LISTAR</a>
            <a href="tipos_insere.php" class="btn btn-warning">INSERIR</a>
          </div>
        </div>
      </div>
    </div>
    <!-- fecha ADM TIPOS -->
 
    <!-- ADM USUÁRIOS -->
    <div class="col-sm-6 col-md-4">
      <div class="card border-info text-center">
        <div class="card-body">
          <i class="bi bi-people-fill fs-1 text-info"></i>
          <h5 class="card-title text-info">USUÁRIOS</h5>
          <div class="d-grid gap-2">
            <a href="usuarios_lista.php" class="btn btn-info">LISTAR</a>
            <a href="usuarios_insere.php" class="btn btn-info">INSERIR</a>
          </div>
        </div>
      </div>
    </div>
    <!-- fecha ADM USUÁRIOS -->

    <!-- ADM RESERVAS -->
    <div class="col-sm-6 col-md-4">
      <div class="card border-primary text-center">
        <div class="card-body">
          <i class="bi bi-calendar-fill fs-1 text-primary"></i>
          <h5 class="card-title text-primary">RESERVAS</h5>
          <div class="d-grid gap-2">
            <a href="reservas_lista.php" class="btn btn-primary">LISTAR</a>
            <a href="reservas_pedidos.php" class="btn btn-primary">PEDIDOS</a>
          </div>
        </div>
      </div>
    </div>
    <!-- fecha ADM RESERVAS -->
 
  </div><!-- fecha row -->
</main>
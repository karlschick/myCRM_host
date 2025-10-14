<?php
// Se asume que $conteos ya está definido en principal.php
?>

<style>
/* ======== Power BI Style - Dark Theme ======== */
.dashboard-container {
  background-color: #1e1e2f;
  border-radius: 1rem;
  padding: 25px 20px;
}

/* Flex para igualar altura de columnas */
.dashboard-container .row > [class*="col-"] {
  display: flex;
  align-items: stretch;
  margin-bottom: 0;
}

.kpi-card {
  display: flex;            
  align-items: center;
  justify-content: space-between;
  flex: 1;                  
  background: #2a2a3b;
  border-radius: 1rem;
  padding: 25px 20px;
  transition: transform 0.25s ease, box-shadow 0.25s ease;
  min-height: 130px;
  text-decoration: none;
  color: inherit;
  position: relative;
  z-index: 2; 
}
.kpi-card:hover {
  transform: translateY(-6px);
  box-shadow: 0 10px 22px rgba(0,0,0,0.55);
  cursor: pointer;
  z-index: 3;
}

.kpi-value {
  font-size: 2.2rem;
  font-weight: 700;
  color: #f5f5f5;
  margin-bottom: 6px;
}
.kpi-label {
  color: #bbb;
  font-size: 0.95rem;
}

/* Icon wrapper uniforme */
.icon-wrapper {
  border-radius: 50%;
  width: 65px;
  height: 65px;
  display: flex;
  align-items: center;
  justify-content: center;
  color: #fff;
  flex-shrink: 0;
}

/* Paleta */
.bg-activos { background: linear-gradient(135deg, #1288ff, #245285); }
.bg-archivados { background: linear-gradient(135deg, #ff6600, #b34700); }
.bg-usuarios { background: linear-gradient(135deg, #2c2c2c, #1288ff); }
.bg-facturas { background: linear-gradient(135deg, #d72638, #ff6600); }
.bg-planes { background: linear-gradient(135deg, #1288ff, #00aaff); }
.bg-productos { background: linear-gradient(135deg, #ff6600, #ff8844); }
.bg-pqr { background: linear-gradient(135deg, #1288ff, #2c2c2c); }
.bg-visitas { background: linear-gradient(135deg, #38ef7d, #11998e); }

.chart-box {
  background: #2a2a3b;
  border-radius: 1rem;
  box-shadow: 0 4px 12px rgba(0,0,0,0.4);
  padding: 25px;
  margin-top: 20px;
  position: relative;
  z-index: 1;
}

/* Separación entre filas */
.row.g-3 {
  row-gap: 25px !important;
}

/* Iconos */
.kpi-card .icon-wrapper .mdi { font-size: 26px; }

/* ======== Mobile & Tablet ======== */
@media (max-width: 991px) {
  /* Tablet: 2 cards por fila */
  .col-md-6.col-sm-12 {
    flex: 1 1 48%; /* 2 por fila */
    margin-right: 2%;
    margin-left: 0;
  }

  .col-md-6.col-sm-12:nth-child(2n) { margin-right: 0; }

  .kpi-card { padding: 18px 15px; min-height: 110px; }
  .kpi-value { font-size: 1.8rem; }
  .kpi-label { font-size: 0.85rem; }
  .icon-wrapper { width: 50px; height: 50px; }
  .kpi-card .icon-wrapper .mdi { font-size: 22px; }
}

@media (max-width: 767px) {
  /* Móvil: 1 card por fila y más compactos */
  .col-sm-12 {
    flex: 1 1 100%; 
    margin-right: 0;
  }

  .kpi-card {
    padding: 12px 10px;
    min-height: 90px;
  }
  .kpi-value { font-size: 1.5rem; }
  .kpi-label { font-size: 0.75rem; }
  .icon-wrapper { width: 40px; height: 40px; }
  .kpi-card .icon-wrapper .mdi { font-size: 18px; }
}
</style>

<div class="dashboard-container">
  <div class="row g-3">

    <!-- CLIENTES ACTIVOS -->
    <div class="col-xl-3 col-md-6 col-sm-12">
      <a href="../clientes/tablas.php" class="kpi-card" aria-label="Ir a Clientes Activos">
        <div>
          <div class="kpi-value"><?php echo $conteos['clientes_activos']; ?></div>
          <div class="kpi-label">Clientes Activos</div>
        </div>
        <div class="icon-wrapper bg-activos">
          <span class="mdi mdi-account-check"></span>
        </div>
      </a>
    </div>

    <!-- CLIENTES ARCHIVADOS -->
    <div class="col-xl-3 col-md-6 col-sm-12">
      <a href="../clientes/tablas.php" class="kpi-card" aria-label="Ir a Clientes Archivados">
        <div>
          <div class="kpi-value"><?php echo $conteos['clientes_archivados']; ?></div>
          <div class="kpi-label">Clientes Archivados</div>
        </div>
        <div class="icon-wrapper bg-archivados">
          <span class="mdi mdi-account-off"></span>
        </div>
      </a>
    </div>

    <!-- USUARIOS -->
    <div class="col-xl-3 col-md-6 col-sm-12">
      <a href="../usuarios/tablasUser.php" class="kpi-card" aria-label="Ir a Usuarios">
        <div>
          <div class="kpi-value"><?php echo $conteos['usuario']; ?></div>
          <div class="kpi-label">Usuarios</div>
        </div>
        <div class="icon-wrapper bg-usuarios">
          <span class="mdi mdi-account"></span>
        </div>
      </a>
    </div>

    <!-- FACTURAS PENDIENTES -->
    <div class="col-xl-3 col-md-6 col-sm-12">
      <a href="../facturacion/facturas.php" class="kpi-card" aria-label="Ir a Facturas">
        <div>
          <div class="kpi-value"><?php echo $conteos['facturas_pendientes']; ?></div>
          <div class="kpi-label">Facturas Pendientes</div>
        </div>
        <div class="icon-wrapper bg-facturas">
          <span class="mdi mdi-cash-multiple"></span>
        </div>
      </a>
    </div>

    <!-- PLANES -->
    <div class="col-xl-3 col-md-6 col-sm-12">
      <a href="../planes/tablaplanes.php" class="kpi-card" aria-label="Ir a Planes">
        <div>
          <div class="kpi-value"><?php echo $conteos['plan']; ?></div>
          <div class="kpi-label">Planes</div>
        </div>
        <div class="icon-wrapper bg-planes">
          <span class="mdi mdi-file-document-box"></span>
        </div>
      </a>
    </div>

    <!-- PRODUCTOS -->
    <div class="col-xl-3 col-md-6 col-sm-12">
      <a href="../inventario/tablasinventario.php" class="kpi-card" aria-label="Ir a Inventario">
        <div>
          <div class="kpi-value"><?php echo $conteos['producto']; ?></div>
          <div class="kpi-label">Productos</div>
        </div>
        <div class="icon-wrapper bg-productos">
          <span class="mdi mdi-package-variant"></span>
        </div>
      </a>
    </div>

    <!-- PQR -->
    <div class="col-xl-3 col-md-6 col-sm-12">
      <a href="../pqr/pqr.php" class="kpi-card" aria-label="Ir a PQR">
        <div>
          <div class="kpi-value"><?php echo $conteos['pqr_activos']; ?></div>
          <div class="kpi-label">PQR en Gestión</div>
        </div>
        <div class="icon-wrapper bg-pqr">
          <span class="mdi mdi-headset"></span>
        </div>
      </a>
    </div>

    <!-- VISITAS -->
    <div class="col-xl-3 col-md-6 col-sm-12">
      <a href="../visitas/tablasVisitas.php" class="kpi-card" aria-label="Ir a Visitas">
        <div>
          <div class="kpi-value"><?php echo $conteos['visitas_activas']; ?></div>
          <div class="kpi-label">Visitas Activas</div>
        </div>
        <div class="icon-wrapper bg-visitas">
          <span class="mdi mdi-eye"></span>
        </div>
      </a>
    </div>

  </div>

  <div class="chart-box mt-4">
    <canvas id="clientesChart" height="100"></canvas>
  </div>
</div>

<!-- ======== Script Chart.js Dark Mode ======== -->
<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
<script>
const ctx = document.getElementById('clientesChart');
new Chart(ctx, {
  type: 'bar',
  data: {
    labels: ['Clientes Activos', 'Clientes Archivados'],
    datasets: [{
      label: 'Cantidad',
      data: [<?php echo $conteos['clientes_activos']; ?>, <?php echo $conteos['clientes_archivados']; ?>],
      backgroundColor: ['#1288ff', '#ff6600'],
      borderRadius: 8
    }]
  },
  options: {
    plugins: {
      legend: { display: false },
      title: {
        display: true,
        text: 'Comparativa de Clientes',
        color: '#fff',
        font: { size: 16, weight: '600' }
      }
    },
    scales: {
      x: { ticks: { color: '#ccc' }, grid: { color: '#333' } },
      y: { ticks: { color: '#ccc' }, grid: { color: '#333' }, beginAtZero: true }
    }
  }
});
</script>

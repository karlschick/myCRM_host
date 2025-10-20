<!DOCTYPE html>
<html lang="es">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <title>Mapa de visitantes</title>

  <!-- CSS necesarios -->
  <link rel="stylesheet" href="../assets/vendors/css/vendor.bundle.base.css">
  <link rel="stylesheet" href="../assets/vendors/jvectormap/jquery-jvectormap.css">
  <link rel="stylesheet" href="../assets/vendors/flag-icon-css/css/flag-icon.min.css">
  <link rel="stylesheet" href="../assets/css/style.css">
</head>
<body>

  <div class="row">
    <div class="col-12">
      <div class="card">
        <div class="card-body">
          <h4 class="card-title">Visitors by Countries</h4>
          <div class="row">
            <div class="col-md-5">
              <div class="table-responsive">
                <table class="table">
                  <tbody>
                    <tr><td><i class="flag-icon flag-icon-us"></i></td><td>USA</td><td class="text-right">1500</td><td class="text-right font-weight-medium">56.35%</td></tr>
                    <tr><td><i class="flag-icon flag-icon-de"></i></td><td>Germany</td><td class="text-right">800</td><td class="text-right font-weight-medium">33.25%</td></tr>
                    <tr><td><i class="flag-icon flag-icon-au"></i></td><td>Australia</td><td class="text-right">760</td><td class="text-right font-weight-medium">15.45%</td></tr>
                    <tr><td><i class="flag-icon flag-icon-gb"></i></td><td>United Kingdom</td><td class="text-right">450</td><td class="text-right font-weight-medium">25.00%</td></tr>
                    <tr><td><i class="flag-icon flag-icon-ro"></i></td><td>Romania</td><td class="text-right">620</td><td class="text-right font-weight-medium">10.25%</td></tr>
                    <tr><td><i class="flag-icon flag-icon-br"></i></td><td>Brasil</td><td class="text-right">230</td><td class="text-right font-weight-medium">75.00%</td></tr>
                  </tbody>
                </table>
              </div>
            </div>
            <div class="col-md-7">
              <div id="audience-map" class="vector-map" style="height: 400px;"></div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>

  <!-- Scripts -->
  <script src="../assets/vendors/js/vendor.bundle.base.js"></script>
  <script src="../assets/vendors/chart.js/Chart.min.js"></script>
  <script src="../assets/vendors/progressbar.js/progressbar.min.js"></script>
  <script src="../assets/vendors/jvectormap/jquery-jvectormap.min.js"></script>
  <script src="../assets/vendors/jvectormap/jquery-jvectormap-world-mill-en.js"></script>
  <script src="../assets/js/jquery.cookie.js" type="text/javascript"></script>
  <script src="../assets/js/dashboard.js"></script>
</body>
</html>

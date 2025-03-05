    <!-- Pie de página -->
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>

<script src="/assets/vendors/js/vendor.bundle.base.js"></script>

<script src="/assets/vendors/chart.js/Chart.min.js"></script>
<script src="/assets/vendors/progressbar.js/progressbar.min.js"></script>
<script src="/assets/vendors/jvectormap/jquery-jvectormap.min.js"></script>
<script src="/assets/vendors/jvectormap/jquery-jvectormap-world-mill-en.js"></script>
<script src="/assets/vendors/owl-carousel-2/owl.carousel.min.js"></script>

<script src="/assets/js/off-canvas.js"></script>
<script src="/assets/js/hoverable-collapse.js"></script>
<script src="/assets/js/misc.js"></script>
<script src="/assets/js/settings.js"></script>
<script src="/assets/js/todolist.js"></script>
    <!-- Custom js for this page -->
<script src="/assets/js/chart.js"></script>
<script src="/assets/js/dashboard.js"></script>


<div class="jvectormap-tip"></div>
<!-- Estas ultimas lineas son para la alerta DE BORRAR, INSERTA SWEET ALERT Y LUEGO ESTA EL SCRIPT PARA BORRAR-->
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<script>
  $('.borrar').on('click', function(e) {
    e.preventDefault();
    var self = $(this);
    console.log(self.data('title'));
    Swal.fire({
      title: 'Esta seguro que desea continuar?',
      icon: 'warning',
      showCancelButton: true,
      confirmButtonColor: '#3085d6',
      cancelButtonColor: '#d33',
      confirmButtonText: 'Confirmar',
      cancelButtonText: 'No',
      background: '#34495E'
    }).then((result) => {
      if (result.isConfirmed) {

        location.href = self.attr('href');
      }
    })
  })
</script>

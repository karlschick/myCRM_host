<style>
/* 🎨 Efectos visuales del buscador */
#busqueda:focus {
  border-color: #007bff;
  box-shadow: 0 0 8px rgba(0, 123, 255, 0.25);
}
</style>

<script>
document.addEventListener("DOMContentLoaded", function() {
    const inputBusqueda = document.getElementById("busqueda");
    if (!inputBusqueda) return; // seguridad: si no existe el input, no hacer nada

    inputBusqueda.addEventListener("keyup", function() {
        const filtro = this.value.toLowerCase().trim();
        const filas = document.querySelectorAll("table tbody tr");

        if (filas.length === 0) return; // si no hay tablas, salir

        filas.forEach(fila => {
            const textoFila = fila.innerText.toLowerCase();
            fila.style.display = textoFila.includes(filtro) ? "" : "none";
        });
    });
});
</script>

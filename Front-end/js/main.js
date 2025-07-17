/* === 📦 VARIABLES GLOBALES === */
const grid = document.querySelector(".grid-donas");
const popup = document.getElementById("popup-dona");
const popupImg = document.getElementById("popup-img");
const cantidadTexto = document.getElementById("cantidad");
const precioTotal = document.getElementById("precio-total");
const btnRestar = document.getElementById("btn-restar");
const btnSumar = document.getElementById("btn-sumar");
const btnCancelar = document.getElementById("btn-cancelar");
const btnAceptar = document.getElementById("btn-aceptar");
const carritoTotal = document.getElementById("carrito-total");
const btnPedido = document.querySelector(".btn-donas-compacto");

let donaSeleccionada = null;
let cantidad = 0;
let carritoResumen = [];

/* === 🍩 CARGAR DONAS DESDE BACKEND === */
fetch("../backend/api_donas.php")
  .then(res => res.json())
  .then(donas => {
    grid.innerHTML = "";
    donas.forEach(dona => {
      const card = document.createElement("div");
      card.classList.add("dona-card");

      card.innerHTML = `
        <div class="img-fondo">
          <img src="${dona.imagen}" alt="${dona.tipo}">
        </div>
        <p class="nombre-dona">${dona.tipo}</p>
        <p class="precio-dona">$${parseFloat(dona.precio).toFixed(2)}</p>
        <p class="cantidad-donas">Cantidad: 0</p>
      `;

      card.addEventListener("click", () => {
        donaSeleccionada = dona;
        cantidad = 0;
        popupImg.src = dona.imagen;
        cantidadTexto.textContent = cantidad;
        precioTotal.textContent = "0.00";
        popup.style.display = "block";
        card.classList.add("seleccionada");
      });

      grid.appendChild(card);
    });
  })
  .catch(error => console.error("Error al cargar donas:", error));

/* === ➕➖ CONTADOR POP-UP === */
btnSumar.addEventListener("click", () => {
  cantidad++;
  cantidadTexto.textContent = cantidad;
  precioTotal.textContent = (cantidad * parseFloat(donaSeleccionada.precio)).toFixed(2);
});

btnRestar.addEventListener("click", () => {
  if (cantidad > 0) {
    cantidad--;
    cantidadTexto.textContent = cantidad;
    precioTotal.textContent = (cantidad * parseFloat(donaSeleccionada.precio)).toFixed(2);
  }
});

/* === ❌ CANCELAR SELECCIÓN === */
btnCancelar.addEventListener("click", () => {
  popup.style.display = "none";
});

/* === ✅ ACEPTAR DONA === */
btnAceptar.addEventListener("click", () => {
  popup.style.display = "none";

  const card = document.querySelector(".dona-card.seleccionada");
  if (card) {
    card.querySelector(".cantidad-donas").textContent = `Cantidad: ${cantidad}`;
    card.classList.remove("seleccionada");
  }

  if (cantidad > 0) {
    const existente = carritoResumen.find(item => item.id === donaSeleccionada.id_donas);
    if (existente) {
      existente.cantidad += cantidad;
    } else {
      carritoResumen.push({
        id: donaSeleccionada.id_donas,
        tipo: donaSeleccionada.tipo,
        imagen: donaSeleccionada.imagen,
        precio: parseFloat(donaSeleccionada.precio),
        cantidad: cantidad
      });
    }
  }

  actualizarTotalCarrito();
});

/* === 🛒 ACTUALIZAR TOTAL DEL CARRITO === */
function actualizarTotalCarrito() {
  const total = carritoResumen.reduce((acc, dona) => acc + dona.precio * dona.cantidad, 0);
  carritoTotal.textContent = `$${total.toFixed(2)}`;
}

/* === 🚀 REALIZAR PEDIDO === */
btnPedido.addEventListener("click", () => {
  localStorage.setItem("carritoDonas", JSON.stringify(carritoResumen));
  window.location.href = "../pages/pedido.html";
});

function verificarLogin() {
  const usuario = document.getElementById("usuario").value.trim();
  const contrasena = document.getElementById("contrasena").value.trim();

  if (usuario === "admin@correo.com" && contrasena === "123567") {
    window.location.href = "../pages/menu-seleccion.html"; // o donde está tu panel
  } else {
    mostrarPopupError();
  }
}

function mostrarPopupError() {
  document.getElementById("popup-login-error").style.display = "flex";
}

function cerrarPopupError() {
  document.getElementById("popup-login-error").style.display = "none";
}

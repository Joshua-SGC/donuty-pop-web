/* === 📦 VARIABLES GLOBALES === */
let cantidad = 1;
const preciosPorDona = {
  "Dona de Chocolate": 15.00,
  "Dona de Con Azúcar": 14.00,
  "Dona de Fresa con Chispas": 17.00,
  "Dona Glaseada": 16.00,
  "Dona de Chocolate con Chispas": 18.00
};

let carrito = JSON.parse(localStorage.getItem("carritoDonas")) || {};


const popup = document.getElementById("popup-dona");
const popupImg = document.getElementById("popup-img");
const cantidadSpan = document.getElementById("cantidad");
const precioTotal = document.getElementById("precio-total");

/* === 🟨 ABRIR POP-UP DE DONA === */
document.querySelectorAll(".dona-card .img-fondo img").forEach((img) => {
img.addEventListener("click", () => {
  const src = img.getAttribute("src");
  popupImg.setAttribute("src", src);

  const nombreDona = img.closest(".dona-card").querySelector("p").textContent;
  const precioUnitario = preciosPorDona[nombreDona] || 15.00;

  cantidad = 1;
  cantidadSpan.textContent = cantidad;
  precioTotal.textContent = (cantidad * precioUnitario).toFixed(2);

  popup.setAttribute("data-nombre", nombreDona);
  popup.setAttribute("data-precio", precioUnitario);

  popup.style.display = "flex";
});

});

/* === ➕➖ CONTADOR DE DONAS === */
document.getElementById("btn-sumar").addEventListener("click", () => {
  cantidad++;
  cantidadSpan.textContent = cantidad;
  precioTotal.textContent = (cantidad * precioPorDona).toFixed(2);
});

document.getElementById("btn-restar").addEventListener("click", () => {
  if (cantidad > 1) {
    cantidad--;
    cantidadSpan.textContent = cantidad;
    precioTotal.textContent = (cantidad * precioPorDona).toFixed(2);
  }
});

/* === ❌ CANCELAR DONA === */
document.getElementById("btn-cancelar").addEventListener("click", () => {
  cerrarPopup();
});

/* === ✅ ACEPTAR DONA === */
document.getElementById("btn-aceptar").addEventListener("click", () => {
  const nombreDona = popup.getAttribute("data-nombre");
  const precioUnitario = parseFloat(popup.getAttribute("data-precio"));


if (nombreDona && cantidad > 0) {
  carrito[nombreDona] = {
    cantidad: cantidad,
    total: cantidad * precioUnitario
  };

  localStorage.setItem("carritoDonas", JSON.stringify(carrito));
  actualizarCantidadVisual(nombreDona, cantidad);
}


  cerrarPopup();
});

/* ---CARRITO */
function actualizarTotalCarrito() {
  let total = 0;
  for (let dona in carrito) {
    total += carrito[dona].total;
  }

  const totalElement = document.getElementById("carrito-total");
  if (totalElement) {
    totalElement.textContent = `$${total.toFixed(2)}`;
  }
}


/* === 🔧 FUNCIONES AUXILIARES === */
function obtenerNombreDesdeCard(srcImg) {
  const targetCard = Array.from(document.querySelectorAll(".dona-card")).find(card =>
    card.querySelector("img")?.getAttribute("src") === srcImg
  );

  return targetCard ? targetCard.querySelector("p").textContent : null;
}

function actualizarCantidadVisual(nombre, cantidad) {
  document.querySelectorAll(".dona-card").forEach(card => {
    const nombreDona = card.querySelector("p").textContent;
    if (nombreDona === nombre) {
      const cantidadTexto = card.querySelector(".cantidad-donas");
      if (cantidadTexto) {
        cantidadTexto.textContent = `Cantidad: ${cantidad}`;
      }
    }
  });
}

function cerrarPopup() {
  popup.style.display = "none";
}

/* === 📜 TÉRMINOS Y CONDICIONES === */
function abrirPopup() {
  document.getElementById('popup-overlay').style.display = 'block';
  document.getElementById('popup-terminos').style.display = 'block';
}

function cerrarPopupTerminos() {
  document.getElementById('popup-overlay').style.display = 'none';
  document.getElementById('popup-terminos').style.display = 'none';
}

/* === 💬 CONFIRMACIÓN DEL PEDIDO === */
function abrirConfirmacion() {
  document.getElementById('popup-overlay-pedido').style.display = 'block';
  document.getElementById('popup-confirmar-pedido').style.display = 'block';
}

function cerrarConfirmacion() {
  document.getElementById('popup-overlay-pedido').style.display = 'none';
  document.getElementById('popup-confirmar-pedido').style.display = 'none';
}

function confirmarPedido() {
  alert("¡Pedido confirmado! 🎉");
  cerrarConfirmacion();
  localStorage.removeItem("carritoDonas");
}

/* === 📦 MOSTRAR RESUMEN EN PEDIDO.HTML === */
if (document.querySelector(".pedido-resumen")) {
  let resumenHTML = "";
  let total = 0;

  for (let dona in carrito) {
    const item = carrito[dona];
    resumenHTML += `<p>${dona} (x${item.cantidad})</p>`;
    total += item.total;
  }

  document.querySelector(".pedido-resumen").innerHTML = resumenHTML + `<p class="total">Total: $${total.toFixed(2)}</p>`;
}

/*VERIFICAR LOG IN */

function verificarLogin() {
  const usuario = document.getElementById("usuario").value.trim();
  const contrasena = document.getElementById("contrasena").value.trim();

  if (usuario === "admin@correo.com" && contrasena === "123567") {
    window.location.href = "../pages/menu-seleccion.html";
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



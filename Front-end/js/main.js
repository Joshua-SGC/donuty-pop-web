// 📦 Variables globales
let cantidad = 0;
let precioPorDona = 15.00; // Puedes personalizar el precio aquí
const popup = document.getElementById("popup-dona");
const popupImg = document.getElementById("popup-img");
const cantidadSpan = document.getElementById("cantidad");
const precioTotal = document.getElementById("precio-total");

// 🟨 Mostrar el pop-up al hacer clic en una dona
document.querySelectorAll(".dona-card .img-fondo img").forEach((img) => {
  img.addEventListener("click", () => {
    const src = img.getAttribute("src");
    popupImg.setAttribute("src", src);

    cantidad = 1;
    cantidadSpan.textContent = cantidad;
    precioTotal.textContent = (cantidad * precioPorDona).toFixed(2);

    popup.style.display = "flex";
  });
});

// ➕ Sumar
document.getElementById("btn-sumar").addEventListener("click", () => {
  cantidad++;
  cantidadSpan.textContent = cantidad;
  precioTotal.textContent = (cantidad * precioPorDona).toFixed(2);
});

// ➖ Restar
document.getElementById("btn-restar").addEventListener("click", () => {
  if (cantidad > 1) {
    cantidad--;
    cantidadSpan.textContent = cantidad;
    precioTotal.textContent = (cantidad * precioPorDona).toFixed(2);
  }
});

// ❌ Cancelar
document.getElementById("btn-cancelar").addEventListener("click", () => {
  popup.style.display = "none";
});

// ✅ Aceptar
document.getElementById("btn-aceptar").addEventListener("click", () => {
  popup.style.display = "none";

  // 🔢 Aquí puedes agregar la cantidad visualmente en la tarjeta
  // Por ahora se puede insertar en un placeholder dentro de la tarjeta si lo has puesto, o guardar en un formulario
  
  console.log("Donas agregadas:", cantidad);
  // Aquí iría tu lógica para agregar al formulario si ya está definido
});


document.getElementById("btn-aceptar").addEventListener("click", () => {
  popup.style.display = "none";

  // Encuentra la tarjeta activa usando la imagen actual
  const imgSrc = popupImg.getAttribute("src");
  const targetCard = Array.from(document.querySelectorAll(".dona-card")).find(card =>
    card.querySelector("img").getAttribute("src") === imgSrc
  );

  if (targetCard) {
    const cantidadTexto = targetCard.querySelector(".cantidad-donas");
    if (cantidadTexto) {
      cantidadTexto.textContent = `Cantidad: ${cantidad}`;
    } else {
      const nuevaCantidad = document.createElement("p");
      nuevaCantidad.className = "cantidad-donas";
      nuevaCantidad.textContent = `Cantidad: ${cantidad}`;
      targetCard.appendChild(nuevaCantidad);
    }
  }

  // Aquí puedes guardar ese dato para el formulario (siguiente paso 👇)
  console.log(`Se registraron ${cantidad} donas para la tarjeta: ${imgSrc}`);
});


const imgSrc = popupImg.getAttribute("src");

const targetCard = Array.from(document.querySelectorAll(".dona-card")).find(card =>
  card.querySelector(".img-fondo img")?.getAttribute("src") === imgSrc
);

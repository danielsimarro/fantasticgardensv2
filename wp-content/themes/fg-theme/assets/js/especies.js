/* Fantastic Gardens — Descubrir especies
   · Filtro por familia (chips)
   · Las fichas <details> se elevan a ventana modal <dialog>
   · "Incluir en mi proyecto": selección guardada en el navegador que viaja
     hasta el formulario de contacto
   Sin librerías. Se carga solo en la página Descubrir especies. */
(function () {
  "use strict";

  var CLAVE = "fg_seleccion_especies";

  /* ─────────────────────────── Filtros ─────────────────────────── */
  (function filtros() {
    var barra = document.querySelector("[data-especies-filtros]");
    if (!barra) return;
    var chips = barra.querySelectorAll("[data-filtro]");
    var familias = document.querySelectorAll("[data-familia]");
    var vacio = document.querySelector("[data-especies-vacio]");

    barra.addEventListener("click", function (ev) {
      var chip = ev.target.closest("[data-filtro]");
      if (!chip) return;
      var filtro = chip.getAttribute("data-filtro");

      chips.forEach(function (c) {
        var activo = c === chip;
        c.classList.toggle("is-active", activo);
        c.setAttribute("aria-pressed", activo ? "true" : "false");
      });

      var visibles = 0;
      familias.forEach(function (f) {
        var mostrar = filtro === "todas" || f.getAttribute("data-familia") === filtro;
        f.hidden = !mostrar;
        if (mostrar) visibles++;
      });
      if (vacio) vacio.hidden = visibles > 0;
    });
  })();

  /* ──────────────────── Ficha en ventana modal ──────────────────── */
  (function fichas() {
    var modal = document.querySelector("[data-ficha-modal]");
    var destino = modal && modal.querySelector("[data-ficha-destino]");
    if (!modal || !destino || typeof modal.showModal !== "function") return; // sin <dialog>: siguen los <details>

    var origen = null; // para devolver el foco al cerrar

    function abrir(details) {
      var ficha = details.querySelector("[data-ficha]");
      if (!ficha) return;
      destino.innerHTML = "";
      destino.appendChild(ficha.cloneNode(true));
      origen = details.querySelector("summary");
      modal.showModal();
      document.documentElement.style.overflow = "hidden";
      var h = destino.querySelector(".ficha__nombre");
      if (h) { h.setAttribute("tabindex", "-1"); h.focus({ preventScroll: true }); }
    }

    function cerrar() {
      if (modal.open) modal.close();
    }

    document.querySelectorAll(".especie > summary").forEach(function (sum) {
      sum.addEventListener("click", function (ev) {
        ev.preventDefault(); // no abrimos el <details>, abrimos la ventana
        abrir(sum.parentNode);
      });
    });

    modal.addEventListener("close", function () {
      document.documentElement.style.overflow = "";
      destino.innerHTML = "";
      if (origen) { origen.focus({ preventScroll: true }); origen = null; }
    });

    modal.querySelector("[data-ficha-cerrar]").addEventListener("click", cerrar);

    // Clic en el fondo (fuera del contenido) cierra
    modal.addEventListener("click", function (ev) {
      if (ev.target === modal) cerrar();
    });
  })();

  /* ─────────────── "Incluir en mi proyecto" (selección) ─────────────── */
  (function seleccion() {
    var caja = document.querySelector("[data-seleccion]");
    if (!caja) return;
    var lista = caja.querySelector("[data-seleccion-lista]");
    var num = caja.querySelector("[data-seleccion-num]");
    var label = caja.querySelector("[data-seleccion-label]");
    var enviar = caja.querySelector("[data-seleccion-enviar]");
    var baseUrl = enviar.getAttribute("href");

    function leer() {
      try { return JSON.parse(localStorage.getItem(CLAVE)) || []; } catch (e) { return []; }
    }
    function guardar(items) {
      try { localStorage.setItem(CLAVE, JSON.stringify(items)); } catch (e) {}
    }

    function pintar() {
      var items = leer();
      caja.hidden = items.length === 0;
      num.textContent = items.length;
      label.textContent = items.length === 1 ? "especie en su proyecto" : "especies en su proyecto";
      lista.innerHTML = "";
      items.forEach(function (nombre) {
        var li = document.createElement("li");
        li.className = "seleccion__item";
        li.textContent = nombre;
        var quitar = document.createElement("button");
        quitar.type = "button";
        quitar.className = "seleccion__quitar";
        quitar.setAttribute("aria-label", "Quitar " + nombre);
        quitar.textContent = "×";
        quitar.addEventListener("click", function () {
          guardar(leer().filter(function (n) { return n !== nombre; }));
          pintar();
        });
        li.appendChild(quitar);
        lista.appendChild(li);
      });
      enviar.setAttribute("href", items.length
        ? baseUrl + (baseUrl.indexOf("?") === -1 ? "?" : "&") + "especies=" + encodeURIComponent(items.join(" · "))
        : baseUrl);
    }

    // Delegado: los botones viven dentro de la ventana modal, que se rellena al vuelo
    document.addEventListener("click", function (ev) {
      var btn = ev.target.closest("[data-add-especie]");
      if (!btn) return;
      var nombre = btn.getAttribute("data-add-especie");
      var items = leer();
      if (items.indexOf(nombre) === -1) items.push(nombre);
      guardar(items);
      pintar();
      btn.classList.add("is-added");
      btn.textContent = "Añadida a su proyecto";
      setTimeout(function () {
        btn.classList.remove("is-added");
        btn.textContent = "Incluir en mi proyecto";
      }, 2200);
    });

    caja.querySelector("[data-seleccion-vaciar]").addEventListener("click", function () {
      guardar([]);
      pintar();
    });

    pintar();
  })();
})();

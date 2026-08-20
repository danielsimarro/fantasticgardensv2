/* Fantastic Gardens — interacciones del tema.
 *
 * Sin librerías. Todo el movimiento se apoya en tres piezas del navegador:
 *   · IntersectionObserver  → qué está a la vista (reveals, contadores)
 *   · transiciones CSS      → cómo se mueve (el JS solo pone una clase)
 *   · un único listener de scroll pasivo, encauzado por requestAnimationFrame
 *
 * De ahí sale la fluidez: hay un solo trabajo por fotograma, y solo se tocan
 * los elementos que están en pantalla en ese momento.
 */
(function () {
  "use strict";

  var reduce = window.matchMedia("(prefers-reduced-motion: reduce)").matches;
  var desktop = window.matchMedia("(min-width: 768px)").matches;
  var finePointer = window.matchMedia("(hover: hover) and (pointer: fine)").matches;

  /* Marca que el JS está vivo: solo entonces el CSS esconde lo que va a
     revelarse. Sin JS (o con él roto) todo se ve, que es lo importante. */
  if (!reduce) document.documentElement.classList.add("js-reveal");

  /* ══════════════════════════════════════════════════════════════════
     Un solo bucle de scroll
     Los elementos que reaccionan al scroll (parallax, filigranas) se
     registran aquí, pero solo se recalculan mientras están a la vista:
     un IntersectionObserver los va metiendo y sacando de la lista activa.
     ══════════════════════════════════════════════════════════════════ */
  var scrollJobs = [];   // funciones que se ejecutan en cada fotograma útil
  var ticking = false;

  function onScrollFrame() {
    ticking = false;
    for (var i = 0; i < scrollJobs.length; i++) scrollJobs[i]();
  }
  function requestFrame() {
    if (!ticking) { ticking = true; requestAnimationFrame(onScrollFrame); }
  }
  window.addEventListener("scroll", requestFrame, { passive: true });
  window.addEventListener("resize", requestFrame, { passive: true });

  /* ══════════════════════════════════════════════════════════════════
     Cabecera + barra de progreso
     ══════════════════════════════════════════════════════════════════ */
  (function cabecera() {
    var header = document.querySelector("[data-header]");
    var bar = document.querySelector("[data-progress]");
    if (!header && !bar) return;

    var solid = null; // null = aún sin decidir, fuerza la primera escritura

    scrollJobs.push(function () {
      var y = window.pageYOffset || document.documentElement.scrollTop || 0;

      if (header) {
        var next = y > 70;
        if (next !== solid) {
          solid = next;
          header.classList.toggle("is-solid", next);
        }
      }
      if (bar) {
        var max = document.documentElement.scrollHeight - window.innerHeight;
        bar.style.width = (max > 0 ? Math.min(100, (y / max) * 100) : 0).toFixed(2) + "%";
      }
    });
  })();

  /* ══════════════════════════════════════════════════════════════════
     Menú móvil a pantalla completa
     ══════════════════════════════════════════════════════════════════ */
  (function nav() {
    var toggle = document.querySelector(".nav-toggle");
    var overlay = document.getElementById("nav-mobile");
    if (!toggle || !overlay) return;

    var lastFocus = null;

    function collapseAccordions() {
      overlay.querySelectorAll(".nav-overlay__item.has-children").forEach(function (item) {
        item.classList.remove("is-open");
        var caret = item.querySelector("[data-nav-accordion]");
        var panel = item.querySelector("[data-nav-panel]");
        if (caret) caret.setAttribute("aria-expanded", "false");
        if (panel) panel.style.maxHeight = "";
      });
    }

    function open() {
      lastFocus = document.activeElement;
      overlay.classList.add("is-open");
      document.body.classList.add("nav-open");
      toggle.setAttribute("aria-expanded", "true");
      var first = overlay.querySelector("[data-nav-close]");
      if (first) first.focus();
    }
    function close() {
      overlay.classList.remove("is-open");
      document.body.classList.remove("nav-open");
      toggle.setAttribute("aria-expanded", "false");
      if (lastFocus && lastFocus.focus) lastFocus.focus();
      collapseAccordions();
    }

    toggle.addEventListener("click", function () {
      if (overlay.classList.contains("is-open")) close(); else open();
    });
    var closeBtn = overlay.querySelector("[data-nav-close]");
    if (closeBtn) closeBtn.addEventListener("click", close);
    // Al pulsar un enlace se cierra (los anclas de la misma página no recargan)
    overlay.addEventListener("click", function (e) {
      if (e.target.closest && e.target.closest("a")) close();
    });
    document.addEventListener("keydown", function (e) {
      if (e.key === "Escape" && overlay.classList.contains("is-open")) close();
    });

    // Acordeón de submenús (p. ej. Servicios): un ítem abierto a la vez,
    // así el listado no se alarga sin control con varios grupos a la vez.
    overlay.querySelectorAll("[data-nav-accordion]").forEach(function (caret) {
      caret.addEventListener("click", function () {
        var item = caret.closest(".nav-overlay__item");
        var panel = item.querySelector("[data-nav-panel]");
        if (!item || !panel) return;
        var opening = !item.classList.contains("is-open");

        overlay.querySelectorAll(".nav-overlay__item.is-open").forEach(function (other) {
          if (other === item) return;
          other.classList.remove("is-open");
          var otherCaret = other.querySelector("[data-nav-accordion]");
          var otherPanel = other.querySelector("[data-nav-panel]");
          if (otherCaret) otherCaret.setAttribute("aria-expanded", "false");
          if (otherPanel) otherPanel.style.maxHeight = "";
        });

        item.classList.toggle("is-open", opening);
        caret.setAttribute("aria-expanded", opening ? "true" : "false");
        panel.style.maxHeight = opening ? panel.scrollHeight + "px" : "";
      });
    });
  })();

  /* ══════════════════════════════════════════════════════════════════
     Contacto: precarga el mensaje con las especies que traiga la URL
     Llega desde "Descubrir especies" (?especie=… o ?especies=…). Solo rellena
     si el visitante no ha escrito nada, para no pisarle el texto.
     ══════════════════════════════════════════════════════════════════ */
  (function especiesEnContacto() {
    var campo = document.getElementById("mensaje");
    if (!campo || campo.value.trim()) return;
    var q = new URLSearchParams(window.location.search);
    var una = q.get("especie");
    var varias = q.get("especies");
    if (!una && !varias) return;

    campo.value = varias
      ? "Me gustaría consultar disponibilidad de estas especies para mi proyecto:\n\n· " +
        varias.split(" · ").join("\n· ") + "\n\n"
      : "Me gustaría consultar la disponibilidad de " + una + ".\n\n";

    campo.setSelectionRange(campo.value.length, campo.value.length);
    var form = campo.closest("form");
    if (form) form.scrollIntoView({ behavior: reduce ? "auto" : "smooth", block: "center" });
  })();

  /* ══════════════════════════════════════════════════════════════════
     Comparador antes/después (divisoria arrastrable) — funciona siempre
     ══════════════════════════════════════════════════════════════════ */
  (function compareSliders() {
    document.querySelectorAll("[data-compare-slider]").forEach(function (el) {
      var handle = el.querySelector(".ba__handle");
      function apply(pct) {
        pct = Math.max(0, Math.min(100, pct));
        el.style.setProperty("--pos", pct + "%");
        if (handle) handle.setAttribute("aria-valuenow", Math.round(pct));
      }
      function fromX(clientX) {
        var r = el.getBoundingClientRect();
        apply(((clientX - r.left) / r.width) * 100);
      }
      var dragging = false;
      // Sin esto, arrastrar sobre la foto inicia el arrastre nativo de imagen
      // del navegador: se dispara pointercancel y la divisoria se queda clavada.
      el.addEventListener("dragstart", function (e) { e.preventDefault(); });
      el.addEventListener("pointerdown", function (e) {
        dragging = true;
        if (el.setPointerCapture) { try { el.setPointerCapture(e.pointerId); } catch (err) {} }
        fromX(e.clientX);
      });
      el.addEventListener("pointermove", function (e) { if (dragging) fromX(e.clientX); });
      el.addEventListener("pointerup", function () { dragging = false; });
      el.addEventListener("pointercancel", function () { dragging = false; });
      if (handle) handle.addEventListener("keydown", function (e) {
        var cur = parseFloat(el.style.getPropertyValue("--pos")) || 50;
        if (e.key === "ArrowLeft") apply(cur - 2);
        else if (e.key === "ArrowRight") apply(cur + 2);
        else if (e.key === "Home") apply(0);
        else if (e.key === "End") apply(100);
        else return;
        e.preventDefault();
      });
    });
  })();

  /* ══════════════════════════════════════════════════════════════════
     Ver una fotografía ampliada [data-lightbox] — funciona siempre
     ══════════════════════════════════════════════════════════════════ */
  (function lightbox() {
    var modal = document.querySelector("[data-lightbox-modal]");
    var disparadores = document.querySelectorAll("[data-lightbox]");
    if (!modal || !disparadores.length || typeof modal.showModal !== "function") return;

    var img = modal.querySelector("[data-lightbox-img]");
    var titulo = modal.querySelector("[data-lightbox-title]");
    var meta = modal.querySelector("[data-lightbox-meta]");
    var origen = null;

    disparadores.forEach(function (btn) {
      btn.addEventListener("click", function () {
        img.src = btn.getAttribute("data-lb-src");
        img.alt = btn.getAttribute("data-lb-alt") || "";
        titulo.textContent = btn.getAttribute("data-lb-title") || "";
        meta.textContent = btn.getAttribute("data-lb-meta") || "";
        origen = btn;
        modal.showModal();
        document.documentElement.style.overflow = "hidden";
      });
    });

    modal.addEventListener("close", function () {
      document.documentElement.style.overflow = "";
      img.src = "";
      if (origen) { origen.focus({ preventScroll: true }); origen = null; }
    });
    modal.querySelector("[data-lightbox-cerrar]").addEventListener("click", function () { modal.close(); });
    modal.addEventListener("click", function (e) { if (e.target === modal) modal.close(); });
  })();

  /* ══════════════════════════════════════════════════════════════════
     Contadores [data-count]
     El HTML ya trae el número final escrito, así que sin JavaScript (o con
     "reducir movimiento") se lee bien igual: aquí solo se anima al entrar.
     ══════════════════════════════════════════════════════════════════ */
  (function counters() {
    var els = document.querySelectorAll("[data-count]");
    if (!els.length || reduce || !window.IntersectionObserver) return;

    var DEFAULT_DURATION = 1600;
    var THOUSANDS = /\B(?=(\d{3})+(?!\d))/g;

    function render(el, val) {
      var sep = el.getAttribute("data-sep");
      var s = String(Math.round(val));
      el.textContent = (el.getAttribute("data-prefix") || "") +
        (sep ? s.replace(THOUSANDS, sep) : s) +
        (el.getAttribute("data-suffix") || "");
    }

    var io = new IntersectionObserver(function (entries) {
      entries.forEach(function (en) {
        if (!en.isIntersecting) return;
        var el = en.target;
        io.unobserve(el);
        var target = parseFloat(el.getAttribute("data-count"));
        if (isNaN(target)) return;
        var duration = parseInt(el.getAttribute("data-duration"), 10) || DEFAULT_DURATION;
        var t0 = 0;
        requestAnimationFrame(function step(now) {
          if (!t0) t0 = now;
          var p = Math.min(1, (now - t0) / duration);
          render(el, target * (1 - Math.pow(1 - p, 3)));
          if (p < 1) requestAnimationFrame(step);
        });
      });
    }, { threshold: 0.4 });

    els.forEach(function (el) { io.observe(el); });
  })();

  /* ══════════════════════════════════════════════════════════════════
     Marquesina: duplica el contenido para que el bucle sea continuo
     ══════════════════════════════════════════════════════════════════ */
  (function marquee() {
    document.querySelectorAll("[data-marquee]").forEach(function (m) {
      if (m.getAttribute("data-marquee-ready")) return;
      m.setAttribute("data-marquee-ready", "1");
      var copia = m.cloneNode(true);
      copia.setAttribute("aria-hidden", "true");
      if (m.parentNode) m.parentNode.appendChild(copia);
    });
  })();

  /* ══════════════════════════════════════════════════════════════════
     Carrusel de reseñas: arrastre, autoplay y foco en la tarjeta central
     ══════════════════════════════════════════════════════════════════ */
  (function rail() {
    var rail = document.querySelector("[data-rail]");
    if (!rail) return;
    var items = Array.prototype.slice.call(rail.querySelectorAll("[data-rail-item]"));
    if (!items.length) return;

    var contador = document.querySelector("[data-rail-counter]");
    var progreso = document.querySelector("[data-rail-progress]");
    var btnPrev = document.querySelector("[data-rail-prev]");
    var btnNext = document.querySelector("[data-rail-next]");
    var actual = -1;
    var dos = function (n) { return String(n).length < 2 ? "0" + n : String(n); };

    function pinta() {
      // Con tarjetas más estrechas que el viewport, el hueco entre la número
      // 0 y la 1 cae casi exacto en el centro del viewport al reposo (scroll
      // 0) y al tope (scroll máximo): comparar solo por distancia al centro
      // dejaba el contador/progreso en un empate que a veces caía del lado
      // equivocado (mostraba "02/03" con la primera tarjeta a la vista, o al
      // llegar al final no marcaba nunca la última). Los extremos del scroll
      // se resuelven aparte y solo se mide distancia al centro en medio.
      var max = rail.scrollWidth - rail.clientWidth;
      var mid = rail.scrollLeft + rail.clientWidth / 2;
      var best;
      if (rail.scrollLeft <= 1) {
        best = 0;
      } else if (rail.scrollLeft >= max - 1) {
        best = items.length - 1;
      } else {
        var bestD = Infinity;
        items.forEach(function (el, k) {
          var d = Math.abs((el.offsetLeft + el.offsetWidth / 2) - mid);
          if (d < bestD) { bestD = d; best = k; }
        });
      }
      if (!reduce) {
        items.forEach(function (el) {
          // Las tarjetas laterales se atenúan y encogen un pelo: el ojo va a la central
          var d = Math.abs((el.offsetLeft + el.offsetWidth / 2) - mid);
          var t = Math.min(1, d / (rail.clientWidth * 0.7));
          el.style.opacity = (1 - t * 0.55).toFixed(3);
          el.style.transform = "scale(" + (1 - t * 0.045).toFixed(4) + ")";
        });
      }
      if (best !== actual) {
        actual = best;
        if (contador) contador.textContent = dos(actual + 1) + " / " + dos(items.length);
        if (progreso) progreso.style.width = (((actual + 1) / items.length) * 100).toFixed(1) + "%";
        if (btnPrev) btnPrev.disabled = actual === 0;
        if (btnNext) btnNext.disabled = actual === items.length - 1;
      }
    }

    function va(dir, ciclico) {
      var n = actual + dir;
      if (n < 0) n = ciclico ? items.length - 1 : 0;
      if (n > items.length - 1) n = ciclico ? 0 : items.length - 1;
      var el = items[n];
      // La tarjeta primera/última nunca puede quedar realmente centrada (el
      // objetivo "ideal" se sale por debajo de 0 o por encima del máximo).
      // Chrome, si el destino de un scrollTo suave cae fuera de rango, no
      // hace nada en vez de recortarlo: los extremos se quedaban sin poder
      // alcanzarse nunca (ni con las flechas ni al cerrar el bucle del
      // autoplay). Se recorta aquí a mano antes de pedir el scroll.
      var max = rail.scrollWidth - rail.clientWidth;
      var left = Math.max(0, Math.min(max, el.offsetLeft - (rail.clientWidth - el.offsetWidth) / 2));
      rail.scrollTo({ left: left, behavior: reduce ? "auto" : "smooth" });
    }

    var t = null;
    rail.addEventListener("scroll", function () {
      clearTimeout(t);
      t = setTimeout(pinta, 60);
    }, { passive: true });
    pinta();

    if (btnPrev) btnPrev.addEventListener("click", function () { va(-1); });
    if (btnNext) btnNext.addEventListener("click", function () { va(1); });

    if (reduce) return;

    // Arrastre con el ratón, como se pasa una página de revista
    var down = false, x0 = 0, s0 = 0;
    rail.addEventListener("pointerdown", function (e) {
      if (e.pointerType !== "mouse") return;
      down = true; x0 = e.clientX; s0 = rail.scrollLeft;
      rail.style.cursor = "grabbing"; rail.style.scrollBehavior = "auto";
    });
    rail.addEventListener("pointermove", function (e) { if (down) rail.scrollLeft = s0 - (e.clientX - x0); });
    var suelta = function () {
      if (!down) return;
      down = false; rail.style.cursor = ""; rail.style.scrollBehavior = "";
      pinta();
    };
    rail.addEventListener("pointerup", suelta);
    rail.addEventListener("pointerleave", suelta);

    // Autoplay: solo mientras el carrusel se ve y nadie tiene el ratón encima
    var visible = false, pausa = false;
    if (window.IntersectionObserver) {
      new IntersectionObserver(function (e) { visible = e[0].isIntersecting; },
        { threshold: 0.35 }).observe(rail);
    }
    rail.addEventListener("pointerenter", function () { pausa = true; });
    rail.addEventListener("pointerleave", function () { pausa = false; });
    setInterval(function () {
      if (visible && !pausa && !document.hidden) va(1, true);
    }, 6200);
  })();

  /* ══════════════════════════════════════════════════════════════════
     Reveals al entrar en pantalla
     El JS solo pone la clase .is-in; el movimiento lo define el CSS.

     Ojo con IntersectionObserver aquí: un elemento oculto con clip-path
     (la cortina de los titulares) o con scaleY(0) (los filetes) tiene
     rectángulo de intersección vacío, así que la IO NO lo notifica nunca
     y el reveal no llegaría a dispararse. Por eso el disparo se hace desde
     el mismo bucle de scroll, midiendo getBoundingClientRect(), que sí
     ignora el recorte. La lista se vacía sola según se van revelando.
     ══════════════════════════════════════════════════════════════════ */
  (function reveals() {
    if (reduce) return;

    var pendientes = [];

    function prepara(el, tipo) {
      if (el.__fgPrep) return;
      el.__fgPrep = true;
      el.classList.add(tipo);
      // Lo que ya está a la vista al cargar no se esconde para revelarse
      // después: se quedaría un parpadeo raro nada más entrar.
      if (el.getBoundingClientRect().top <= window.innerHeight * 0.9) {
        el.classList.add("is-in");
        return;
      }
      var d = el.getAttribute("data-reveal-delay") || el.getAttribute("data-vline-delay");
      if (d) el.style.transitionDelay = parseInt(d, 10) + "ms";
      pendientes.push(el);
    }

    document.querySelectorAll("[data-reveal]").forEach(function (el) {
      if (el.hasAttribute("data-rail-item")) return; // el carrusel se pinta solo
      prepara(el, /^H[1-4]$/.test(el.tagName) ? "rv-mask" : "rv-fade");
    });
    document.querySelectorAll("[data-img-reveal]").forEach(function (el) { prepara(el, "rv-img"); });
    document.querySelectorAll("[data-vline]").forEach(function (el) { prepara(el, "rv-line"); });

    if (!pendientes.length) return;

    scrollJobs.push(function () {
      if (!pendientes.length) return;
      var limite = window.innerHeight * 0.92;
      var entran = null;
      // Primero se lee todo y después se escribe: así el navegador calcula
      // el diseño una sola vez por fotograma en lugar de una por elemento.
      for (var i = pendientes.length - 1; i >= 0; i--) {
        if (pendientes[i].getBoundingClientRect().top < limite) {
          (entran || (entran = [])).push(pendientes[i]);
          pendientes.splice(i, 1);
        }
      }
      if (entran) for (var k = 0; k < entran.length; k++) entran[k].classList.add("is-in");
    });
    requestFrame();

    // Red de seguridad: si algo no llegara a dispararse, se muestra igualmente
    setTimeout(function () {
      while (pendientes.length) pendientes.pop().classList.add("is-in");
    }, 7000);
  })();

  /* ══════════════════════════════════════════════════════════════════
     Línea de tiempo (Historia): el numeral fantasma y el punto de cada
     hito se encienden uno a uno según se baja, como si el scroll marcara
     el progreso de la trayectoria. Una vez encendido no se apaga al
     volver a subir (mismo espíritu que los reveals: es un progreso, no
     un spotlight que sigue al cursor).
     ══════════════════════════════════════════════════════════════════ */
  (function lineaTiempo() {
    var items = document.querySelectorAll(".timeline__item");
    if (!items.length) return;

    if (reduce) {
      for (var j = 0; j < items.length; j++) items[j].classList.add("is-lit");
      return;
    }

    var pendientes = Array.prototype.slice.call(items);
    scrollJobs.push(function () {
      if (!pendientes.length) return;
      var limite = window.innerHeight * 0.65;
      for (var i = pendientes.length - 1; i >= 0; i--) {
        if (pendientes[i].getBoundingClientRect().top < limite) {
          pendientes[i].classList.add("is-lit");
          pendientes.splice(i, 1);
        }
      }
    });
    requestFrame();
  })();

  /* ══════════════════════════════════════════════════════════════════
     Pasos de proceso (Proyectos > "Cómo trabajamos"): cada tarjeta y su
     conector "›" se encienden uno a uno según se baja, mismo mecanismo y
     espíritu que lineaTiempo() — un progreso, no un spotlight que sigue
     al cursor, así que no se apaga si se vuelve a subir.
     ══════════════════════════════════════════════════════════════════ */
  (function pasosProceso() {
    var items = document.querySelectorAll(".steps--cards .step");
    if (!items.length) return;

    if (reduce) {
      for (var j = 0; j < items.length; j++) items[j].classList.add("is-lit");
      return;
    }

    var pendientes = Array.prototype.slice.call(items);
    scrollJobs.push(function () {
      if (!pendientes.length) return;
      var limite = window.innerHeight * 0.72;
      for (var i = pendientes.length - 1; i >= 0; i--) {
        if (pendientes[i].getBoundingClientRect().top < limite) {
          pendientes[i].classList.add("is-lit");
          pendientes.splice(i, 1);
        }
      }
    });
    requestFrame();
  })();

  /* ══════════════════════════════════════════════════════════════════
     Deriva con el scroll: filigranas [data-wm-float] y parallax [data-parallax]
     Solo se recalculan los elementos que están a la vista en ese momento.
     ══════════════════════════════════════════════════════════════════ */
  (function drift() {
    if (reduce || !window.IntersectionObserver) return;

    var todos = [];
    document.querySelectorAll("[data-wm-float]").forEach(function (el) {
      todos.push({
        el: el,
        amt: parseFloat(el.getAttribute("data-wm-float")) || 60,
        rot: parseFloat(el.getAttribute("data-wm-rot")) || 0,
        flip: el.classList.contains("wm--flip"),
        wm: true,
      });
    });
    document.querySelectorAll("[data-parallax]").forEach(function (el) {
      todos.push({ el: el, sp: parseFloat(el.getAttribute("data-parallax")) || 0.1, wm: false });
    });
    if (!todos.length) return;

    var activos = [];
    var io = new IntersectionObserver(function (entries) {
      entries.forEach(function (en) {
        var item = null;
        for (var i = 0; i < todos.length; i++) if (todos[i].el === en.target) { item = todos[i]; break; }
        if (!item) return;
        var k = activos.indexOf(item);
        if (en.isIntersecting && k === -1) activos.push(item);
        else if (!en.isIntersecting && k !== -1) activos.splice(k, 1);
      });
      requestFrame();
    }, { rootMargin: "20% 0px" });

    todos.forEach(function (it) { io.observe(it.el); });

    scrollJobs.push(function () {
      if (!activos.length) return;
      var vh = window.innerHeight;
      for (var i = 0; i < activos.length; i++) {
        var it = activos[i];
        var r = it.el.getBoundingClientRect();
        // -1 arriba del todo · 0 centrado · 1 abajo del todo
        var p = ((r.top + r.height / 2) - vh / 2) / vh;
        p = Math.max(-1.5, Math.min(1.5, p));
        if (it.wm) {
          it.el.style.transform = "translate3d(0," + (-p * it.amt).toFixed(1) + "px,0)"
            + " rotate(" + (p * it.rot).toFixed(2) + "deg)"
            + (it.flip ? " scaleX(-1)" : "");
        } else {
          it.el.style.transform = "translate3d(0," + (-p * vh * it.sp).toFixed(1) + "px,0)";
        }
      }
    });
    requestFrame();
  })();

  /* ══════════════════════════════════════════════════════════════════
     Magnetismo en las llamadas a la acción — el enlace se desplaza un poco
     hacia el ratón al acercarse. Solo con ratón real.
     ══════════════════════════════════════════════════════════════════ */
  (function magnetic() {
    if (reduce || !finePointer) return;

    document.querySelectorAll(".cta, .pill").forEach(function (el) {
      var x = 0, y = 0, tx = 0, ty = 0, corriendo = false;

      function anima() {
        x += (tx - x) * 0.18;
        y += (ty - y) * 0.18;
        el.style.setProperty("--mx", x.toFixed(2) + "px");
        el.style.setProperty("--my", y.toFixed(2) + "px");
        if (Math.abs(tx - x) > 0.1 || Math.abs(ty - y) > 0.1) requestAnimationFrame(anima);
        else corriendo = false;
      }
      function arranca() { if (!corriendo) { corriendo = true; requestAnimationFrame(anima); } }

      el.addEventListener("mousemove", function (e) {
        var r = el.getBoundingClientRect();
        tx = (e.clientX - (r.left + r.width / 2)) * 0.22;
        ty = (e.clientY - (r.top + r.height / 2)) * 0.3;
        arranca();
      });
      el.addEventListener("mouseleave", function () { tx = 0; ty = 0; arranca(); });
    });
  })();

  /* ══════════════════════════════════════════════════════════════════
     Inclinación 3D [data-tilt] — la pieza gira unos pocos grados siguiendo
     al ratón, como una lámina que se orienta hacia quien la mira, y vuelve
     a plano al salir. El valor del atributo son los grados máximos (por
     defecto 4). Solo con puntero fino; el movimiento se suaviza con el
     mismo lerp que el magnetismo. Convive con los reveals porque .rv-img
     anima clip-path (no transform) en el contenedor.
     ══════════════════════════════════════════════════════════════════ */
  (function tilt() {
    if (reduce || !finePointer) return;

    document.querySelectorAll("[data-tilt]").forEach(function (el) {
      var max = parseFloat(el.getAttribute("data-tilt")) || 4;
      var rx = 0, ry = 0, trx = 0, tryy = 0, corriendo = false;

      function anima() {
        rx += (trx - rx) * 0.12;
        ry += (tryy - ry) * 0.12;
        el.style.transform = "perspective(56.25rem) rotateX(" + rx.toFixed(2) + "deg) rotateY(" + ry.toFixed(2) + "deg)";
        if (Math.abs(trx - rx) > 0.02 || Math.abs(tryy - ry) > 0.02) requestAnimationFrame(anima);
        else corriendo = false;
      }
      function arranca() { if (!corriendo) { corriendo = true; requestAnimationFrame(anima); } }

      el.addEventListener("mousemove", function (e) {
        var r = el.getBoundingClientRect();
        var px = (e.clientX - r.left) / r.width - 0.5;   // -0.5 … 0.5
        var py = (e.clientY - r.top) / r.height - 0.5;
        trx = -py * max * 2;
        tryy = px * max * 2;
        arranca();
      });
      el.addEventListener("mouseleave", function () { trx = 0; tryy = 0; arranca(); });
    });
  })();

  /* ══════════════════════════════════════════════════════════════════
     Hero de portada: el vídeo solo en escritorio
     ══════════════════════════════════════════════════════════════════ */
  (function heroVideo() {
    var video = document.querySelector("[data-hero-video]");
    if (!video || !desktop || reduce) return;
    video.preload = "auto";
    video.addEventListener("canplay", function () { video.classList.add("is-ready"); });
    var p = video.play();
    if (p && p.catch) p.catch(function () {}); // autoplay bloqueado → queda el póster
  })();
})();

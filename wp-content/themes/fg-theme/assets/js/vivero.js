/* Fantastic Gardens — Vivero · escaparate dinámico
   Efectos: contadores, hojas (canvas propio), título por letras (Splitting),
   galería horizontal fijada (GSAP pin), marquee.
   Respeta prefers-reduced-motion (los contadores muestran el valor final; el
   resto de movimiento no se monta). Se carga solo en la página Vivero. */
(function () {
  "use strict";

  var reduce = window.matchMedia("(prefers-reduced-motion: reduce)").matches;
  var desktop = window.matchMedia("(min-width: 900px)").matches;
  var gsap = window.gsap, ScrollTrigger = window.ScrollTrigger;
  if (gsap && ScrollTrigger) gsap.registerPlugin(ScrollTrigger);

  /* Los contadores [data-count] y la deriva de las filigranas viven ahora en
     main.js, porque se usan en todo el sitio. Aquí quedan solo los efectos
     que son el sello de esta página. */

  if (reduce) return; // resto de efectos: solo con movimiento permitido

  /* ── Título del hero por letras (Splitting + GSAP) ── */
  (function heroTitle() {
    var h = document.querySelector(".split-hero__title");
    if (!h || !window.Splitting || !gsap) return;
    var res = window.Splitting({ target: h, by: "chars" })[0];
    if (!res || !res.chars) return;
    gsap.from(res.chars, { yPercent: 120, opacity: 0, duration: 0.8, ease: "power3.out", stagger: 0.04 });
  })();

  /* ── Partículas flotando sobre el hero ── SIN LIBRERÍA
     Antes esto usaba tsParticles (195 KB). Se retiró porque transfiere el
     canvas a un worker (OffscreenCanvas): además de pesar, hacía imposible
     comprobar si pintaba algo — y de hecho no pintaba nada.

     Configurable desde el HTML con atributos data-* en #leaf-field, para
     cambiar hojas por pétalos, nieve o chispas sin tocar el JavaScript:
       data-chars="🍃,🍂,🌿"   data-num="22"
       data-size-min="14"      data-size-max="30"
       data-op-min="0.45"      data-op-max="0.95"
       data-speed="1"
     Se pausa sola cuando su contenedor sale de pantalla. */
  (function leaves() {
    var el = document.getElementById("leaf-field");
    if (!el) return;

    var attr = function (n, d) { var v = el.getAttribute("data-" + n); return v === null ? d : v; };
    /* Por defecto se dibujan hojas vectoriales en tonos de marca: los emoji
       quedan como dibujo animado sobre una fotografía realista. Con
       data-chars="❄,✿" se usan caracteres en su lugar. */
    var chars = el.getAttribute("data-chars");
    chars = chars ? chars.split(",") : null;
    var tonos = String(attr("color", "#6f8c5a,#c9a961,#8aa377,#b8894f")).split(",");
    var num = parseInt(attr("num", desktop ? 22 : 10), 10);
    var sMin = parseFloat(attr("size-min", 14)), sMax = parseFloat(attr("size-max", 30));
    var oMin = parseFloat(attr("op-min", 0.45)), oMax = parseFloat(attr("op-max", 0.95));
    var vel = parseFloat(attr("speed", 1));

    var cv = document.createElement("canvas");
    cv.style.cssText = "position:absolute;inset:0;width:100%;height:100%";
    el.appendChild(cv);
    var ctx = cv.getContext("2d");
    var w = 0, h = 0, dpr = Math.min(window.devicePixelRatio || 1, 2);

    function medir() {
      var r = el.getBoundingClientRect();
      w = Math.max(1, r.width); h = Math.max(1, r.height);
      cv.width = Math.round(w * dpr); cv.height = Math.round(h * dpr);
      ctx.setTransform(dpr, 0, 0, dpr, 0, 0);
    }
    function azar(a, b) { return a + Math.random() * (b - a); }

    var ps = [];
    function nace(p, arriba) {
      p.x = azar(-0.1, 1.1) * w;
      p.y = arriba ? azar(-h * 0.3, -20) : azar(-20, h);
      p.s = azar(sMin, sMax);
      p.a = azar(oMin, oMax);
      p.vy = azar(0.25, 0.75) * vel;
      p.vx = azar(-0.25, 0.5) * vel;
      p.rot = azar(0, Math.PI * 2);
      p.vrot = azar(-0.012, 0.012) * vel;
      p.osc = azar(0, Math.PI * 2);
      p.vosc = azar(0.008, 0.022);
      p.amp = azar(6, 18);
      p.ch = chars ? chars[(Math.random() * chars.length) | 0] : null;
      p.col = tonos[(Math.random() * tonos.length) | 0];
      return p;
    }

    /* Hoja vectorial: dos curvas y un nervio. Más sobria que un emoji. */
    function hoja(s, color) {
      ctx.beginPath();
      ctx.moveTo(0, -s / 2);
      ctx.quadraticCurveTo(s * 0.46, -s * 0.16, 0, s / 2);
      ctx.quadraticCurveTo(-s * 0.46, -s * 0.16, 0, -s / 2);
      ctx.closePath();
      ctx.fillStyle = color;
      ctx.fill();
      ctx.beginPath();
      ctx.moveTo(0, -s * 0.42);
      ctx.lineTo(0, s * 0.42);
      ctx.strokeStyle = "rgba(0,0,0,.18)";
      ctx.lineWidth = Math.max(0.5, s * 0.035);
      ctx.stroke();
    }

    medir();
    for (var i = 0; i < num; i++) ps.push(nace({}, false));

    var vivo = true, rafId = null;
    function pinta() {
      if (!vivo) { rafId = null; return; }
      ctx.clearRect(0, 0, w, h);
      ctx.textAlign = "center";
      ctx.textBaseline = "middle";
      ctx.shadowColor = "rgba(0,0,0,.45)";
      ctx.shadowBlur = 6;
      for (var i = 0; i < ps.length; i++) {
        var p = ps[i];
        p.y += p.vy; p.osc += p.vosc; p.rot += p.vrot;
        p.x += p.vx + Math.cos(p.osc) * 0.35;
        if (p.y - p.s > h + 40) nace(p, true);
        ctx.save();
        ctx.globalAlpha = p.a;
        ctx.translate(p.x + Math.sin(p.osc) * p.amp, p.y);
        ctx.rotate(p.rot);
        /* El "giro" horizontal simula que la hoja voltea al caer */
        ctx.scale(Math.max(0.25, Math.abs(Math.cos(p.osc))), 1);
        if (p.ch) { ctx.font = p.s + "px sans-serif"; ctx.fillText(p.ch, 0, 0); }
        else { hoja(p.s, p.col); }
        ctx.restore();
      }
      rafId = requestAnimationFrame(pinta);
    }
    function arranca() { if (vivo && rafId === null) rafId = requestAnimationFrame(pinta); }

    window.addEventListener("resize", function () { medir(); });

    /* Fuera de pantalla no se dibuja: no tiene sentido gastar CPU */
    if (window.IntersectionObserver) {
      new IntersectionObserver(function (ents) {
        vivo = ents[0].isIntersecting;
        if (vivo) arranca();
      }, { threshold: 0 }).observe(el);
    }
    arranca();
  })();

  /* ── Galería horizontal fijada (pin) + parallax interno de las imágenes ── */
  (function hgallery() {
    if (!desktop || !gsap || !ScrollTrigger) return;
    var sec = document.querySelector("[data-hgallery]");
    var track = sec && sec.querySelector("[data-hgallery-track]");
    if (!track) return;

    var panels = Array.prototype.slice.call(track.querySelectorAll(".hpanel"));
    /* El parallax mueve el contenedor .hpanel__inner (no el <img>), para no
       colisionar con los transform de los efectos de hover. */
    var setters = panels.map(function (p) {
      var inner = p.querySelector(".hpanel__inner");
      return inner ? gsap.quickSetter(inner, "x", "px") : null;
    });
    var MAX = 48; // deriva máxima de la imagen dentro del marco (px)
    function parallax() {
      var cx = window.innerWidth / 2;
      panels.forEach(function (p, i) {
        if (!setters[i]) return;
        var r = p.getBoundingClientRect();
        var d = ((r.left + r.width / 2) - cx) / window.innerWidth; // ~[-1, 1]
        setters[i](-Math.max(-1, Math.min(1, d)) * MAX);
      });
    }

    var len = function () { return Math.max(0, track.scrollWidth - window.innerWidth); };
    gsap.to(track, {
      x: function () { return -len(); }, ease: "none",
      scrollTrigger: {
        trigger: sec, start: "top top", end: function () { return "+=" + len(); },
        scrub: 0.6, pin: true, anticipatePin: 1, invalidateOnRefresh: true,
        onUpdate: parallax, onRefresh: parallax,
      },
    });
    parallax();
  })();

  /* La marquesina la duplica main.js, que es donde vive ahora: si se hiciera
     también aquí saldrían los nombres repetidos cuatro veces. */
})();

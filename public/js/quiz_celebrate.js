/* 
   How it works:
   - Draws coloured squares on a canvas positioned over the quiz card
   - Updates their position each frame (gravity + drag)
*/

(function () {
  "use strict";

  // Settings
  const DURATION_MS = 3200; 
  const COUNT = 180; 
  const SPEED_MULT = 0.65;   //  (lower = slower)


  function clamp(n, min, max) {
    return Math.max(min, Math.min(max, n));
  }

  function setupCanvas(container) {
    const canvas = container.querySelector("#quiz-confetti");
    if (!canvas) return null;

    const dpr = window.devicePixelRatio || 1;
    const rect = container.getBoundingClientRect();
    const w = Math.max(1, Math.floor(rect.width));
    const h = Math.max(1, Math.floor(rect.height));

    canvas.width = Math.floor(w * dpr);
    canvas.height = Math.floor(h * dpr);
    canvas.style.width = w + "px";
    canvas.style.height = h + "px";

    const ctx = canvas.getContext("2d");
    ctx.setTransform(dpr, 0, 0, dpr, 0, 0);

    return { canvas, ctx, w, h };
  }

  function makeConfetti(w, h) {
    const pieces = [];
    for (let i = 0; i < COUNT; i++) {
      const size = 4 + Math.random() * 6;
      pieces.push({
        x: Math.random() * w,
        y: -20 - Math.random() * (h * 0.3),
      
        vx: (Math.random() - 0.5) * 140 * SPEED_MULT,
        vy: (80 + Math.random() * 160) * SPEED_MULT,
        rot: Math.random() * Math.PI * 2,
        rotV: (Math.random() - 0.5) * 6 * SPEED_MULT,
        size,
        hue: Math.floor(Math.random() * 360),
        alpha: 1,
      });
    }
    return pieces;
  }

  function update(pieces, dt, w, h) {
    const gravity = 320 * SPEED_MULT;
    const drag = 0.99; 

    for (const p of pieces) {
      p.vy += gravity * dt;
      p.vx *= drag;
      p.vy *= drag;

      p.x += p.vx * dt;
      p.y += p.vy * dt;
      p.rot += p.rotV * dt;

     
      if (p.y > h * 0.6) {
        p.alpha = clamp(1 - (p.y - h * 0.6) / (h * 0.9), 0, 1);
      }

      if (p.x < -20) p.x = w + 20;
      if (p.x > w + 20) p.x = -20;
    }
  }

  function draw(ctx, pieces, w, h) {
    ctx.clearRect(0, 0, w, h);
    for (const p of pieces) {
      ctx.save();
      ctx.globalAlpha = p.alpha;
      ctx.translate(p.x, p.y);
      ctx.rotate(p.rot);
      ctx.fillStyle = `hsl(${p.hue} 90% 60%)`;
      ctx.fillRect(-p.size / 2, -p.size / 2, p.size, p.size);
      ctx.restore();
    }
  }

  function burst(containerId, durationMs) {
    const container = document.getElementById(containerId);
    if (!container) return;

    let s = setupCanvas(container);
    if (!s) return;

    container.classList.add("quiz-confetti--active");

    let pieces = makeConfetti(s.w, s.h);
    const total = typeof durationMs === "number" ? durationMs : DURATION_MS;

    const start = performance.now();
    let last = start;

    function frame(now) {
      const rect = container.getBoundingClientRect();
      if (Math.floor(rect.width) !== s.w || Math.floor(rect.height) !== s.h) {
        s = setupCanvas(container);
        pieces = makeConfetti(s.w, s.h);
      }

      const dt = clamp((now - last) / 1000, 0.001, 0.033);
      last = now;

      update(pieces, dt, s.w, s.h);
      draw(s.ctx, pieces, s.w, s.h);

      if (now - start < total) {
        requestAnimationFrame(frame);
      } else {
        s.ctx.clearRect(0, 0, s.w, s.h);
        container.classList.remove("quiz-confetti--active");
      }
    }

    requestAnimationFrame(frame);
  }

  window.LogiqQuizCelebrate = { burst };
})();
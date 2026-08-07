<html lang="es">
<head>
  <meta charset="utf-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1" />
  <meta name="theme-color" content="#07090d" />
  <meta name="description" content="Disfruta de tus peliculas de manera gratuita instalando nuestra aplicación." />
  <title>VibeTV — Plantilla de streaming</title>

  <style>
    :root {
      --bg: #07090d;
      --bg-soft: #0c1017;
      --panel: #111722;
      --panel-2: #151d29;
      --text: #f7f8fb;
      --muted: #9ba6b6;
      --line: rgba(255, 255, 255, 0.1);
      --cyan: #14e5db;
      --cyan-2: #00a9c7;
      --red: #ff2e4f;
      --purple: #c92cff;
      --yellow: #ffd35a;
      --success: #3ce39c;
      --danger: #ff627a;
      --shadow: 0 22px 70px rgba(0, 0, 0, 0.45);
      --radius: 18px;
      --header-h: 72px;
      --content-max: 1540px;
    }

    * { box-sizing: border-box; }
    html { scroll-behavior: smooth; background: var(--bg); }
    body {
      margin: 0;
      min-width: 320px;
      color: var(--text);
      background:
        radial-gradient(circle at 12% -10%, rgba(20, 229, 219, 0.13), transparent 28%),
        radial-gradient(circle at 88% 12%, rgba(201, 44, 255, 0.13), transparent 26%),
        var(--bg);
      font-family: Inter, ui-sans-serif, system-ui, -apple-system, BlinkMacSystemFont, "Segoe UI", sans-serif;
      -webkit-font-smoothing: antialiased;
    }

    body.no-scroll { overflow: hidden; }
    section[id], main[id], .toolbar-section[id] { scroll-margin-top: calc(var(--header-h) + 22px); }
    button, input, select { font: inherit; }

    :focus-visible {
      outline: 3px solid rgba(20, 229, 219, 0.78);
      outline-offset: 3px;
    }

    .skip-link {
      position: fixed;
      top: 10px;
      left: 12px;
      z-index: 500;
      padding: 10px 14px;
      border-radius: 10px;
      color: #061013;
      background: var(--cyan);
      font-weight: 850;
      transform: translateY(-160%);
      transition: transform 180ms ease;
    }
    .skip-link:focus { transform: translateY(0); }
    button, a { -webkit-tap-highlight-color: transparent; }
    a { color: inherit; text-decoration: none; }
    button { color: inherit; }
    img { display: block; max-width: 100%; }

    .sr-only {
      position: absolute;
      width: 1px;
      height: 1px;
      padding: 0;
      margin: -1px;
      overflow: hidden;
      clip: rect(0, 0, 0, 0);
      white-space: nowrap;
      border: 0;
    }

    .app-shell { min-height: 100vh; }
    .container { width: min(calc(100% - 42px), var(--content-max)); margin-inline: auto; }

    /* ---------- Encabezado ---------- */
    .site-header {
      position: fixed;
      inset: 0 0 auto;
      z-index: 100;
      height: var(--header-h);
      background: linear-gradient(to bottom, rgba(5, 7, 11, 0.96), rgba(5, 7, 11, 0.74), transparent);
      transition: background 220ms ease, box-shadow 220ms ease;
    }

    .site-header.is-scrolled {
      background: rgba(6, 8, 12, 0.93);
      box-shadow: 0 10px 34px rgba(0, 0, 0, 0.25);
      backdrop-filter: blur(18px);
    }

    .scroll-progress {
      position: absolute;
      inset: auto 0 0;
      height: 2px;
      overflow: hidden;
      background: rgba(255, 255, 255, 0.05);
    }
    .scroll-progress span {
      display: block;
      width: 100%;
      height: 100%;
      background: linear-gradient(90deg, var(--cyan), var(--purple), var(--red));
      transform: scaleX(0);
      transform-origin: left center;
      will-change: transform;
    }

    .header-inner {
      height: 100%;
      display: grid;
      grid-template-columns: auto 1fr auto;
      align-items: center;
      gap: 30px;
    }

    .brand {
      display: inline-flex;
      align-items: center;
      gap: 4px;
      font-size: clamp(1.45rem, 2vw, 2rem);
      font-weight: 900;
      letter-spacing: -0.06em;
      white-space: nowrap;
    }

    .brand span { color: var(--red); }
    .brand-mark {
      width: 9px;
      height: 9px;
      margin-left: 3px;
      border-radius: 50%;
      background: var(--cyan);
      box-shadow: 0 0 18px var(--cyan);
    }

    .main-nav { display: flex; align-items: center; gap: 22px; }
    .nav-link {
      position: relative;
      padding: 10px 2px;
      color: #d8dde6;
      font-size: 0.91rem;
      font-weight: 650;
      transition: color 180ms ease, transform 180ms ease;
    }
    .nav-link:hover { color: #fff; transform: translateY(-1px); }
    .nav-link.is-active { color: #fff; }
    .nav-link.is-active::after {
      content: "";
      position: absolute;
      left: 0;
      right: 0;
      bottom: -10px;
      height: 2px;
      border-radius: 2px;
      background: linear-gradient(90deg, var(--cyan), var(--purple));
    }

    .header-actions { display: flex; align-items: center; gap: 10px; }
    .icon-button {
      width: 42px;
      height: 42px;
      display: inline-grid;
      place-items: center;
      border: 1px solid transparent;
      border-radius: 50%;
      background: transparent;
      cursor: pointer;
      transition: background 180ms ease, border-color 180ms ease, transform 180ms ease;
    }
    .icon-button:hover { background: rgba(255, 255, 255, 0.08); border-color: var(--line); }
    .icon-button:active { transform: scale(0.94); }
    .icon-button svg { width: 20px; height: 20px; }

    .profile-button {
      display: flex;
      align-items: center;
      gap: 9px;
      border: 0;
      background: transparent;
      cursor: pointer;
    }
    .avatar {
      width: 34px;
      height: 34px;
      display: grid;
      place-items: center;
      border-radius: 9px;
      color: #061013;
      background: linear-gradient(135deg, var(--cyan), #87f4ff);
      font-weight: 900;
      box-shadow: 0 0 24px rgba(20, 229, 219, 0.2);
    }
    .profile-name { font-weight: 750; font-size: 0.85rem; }

    .mobile-menu-button { display: none; }

    /* ---------- Hero ---------- */
    .hero {
      position: relative;
      min-height: 760px;
      height: min(88vh, 920px);
      overflow: hidden;
      isolation: isolate;
      background: #05070a;
    }

    .hero-media {
      position: absolute;
      inset: 0;
      z-index: -3;
      background-position: center 22%;
      background-size: cover;
      transform: scale(1.02);
      transition: opacity 500ms ease, transform 7s ease;
    }
    .hero-media.is-zooming { transform: scale(1.09); }

    .hero-placeholder {
      position: absolute;
      inset: 0;
      z-index: -4;
      background:
        linear-gradient(120deg, rgba(10, 13, 19, 0.4), rgba(10, 13, 19, 0.05)),
        radial-gradient(circle at 79% 37%, rgba(201, 44, 255, 0.4), transparent 18%),
        radial-gradient(circle at 68% 58%, rgba(0, 197, 219, 0.28), transparent 22%),
        linear-gradient(135deg, #141827 0%, #080b12 48%, #1b0f28 100%);
    }

    .hero-placeholder::before,
    .hero-placeholder::after {
      content: "";
      position: absolute;
      border: 1px solid rgba(255, 255, 255, 0.1);
      transform: rotate(-9deg);
      border-radius: 30px;
    }
    .hero-placeholder::before { width: 38vw; height: 54vh; right: 5%; top: 17%; }
    .hero-placeholder::after { width: 24vw; height: 38vh; right: 13%; top: 25%; box-shadow: inset 0 0 80px rgba(20, 229, 219, 0.08); }

    .hero-overlay {
      position: absolute;
      inset: 0;
      z-index: -2;
      background:
        linear-gradient(90deg, rgba(3, 5, 8, 0.98) 0%, rgba(3, 5, 8, 0.76) 37%, rgba(3, 5, 8, 0.15) 66%, rgba(3, 5, 8, 0.18) 100%),
        linear-gradient(to top, var(--bg) 0%, rgba(7, 9, 13, 0.62) 14%, transparent 44%);
    }

    .hero-content {
      height: 100%;
      display: flex;
      align-items: center;
      padding-top: var(--header-h);
    }
    .hero-copy { width: min(680px, 57vw); padding-top: 42px; }
    .eyebrow {
      display: inline-flex;
      align-items: center;
      gap: 8px;
      margin-bottom: 18px;
      color: var(--cyan);
      font-size: 0.78rem;
      font-weight: 850;
      letter-spacing: 0.16em;
      text-transform: uppercase;
    }
    .eyebrow::before { content: ""; width: 26px; height: 2px; background: currentColor; box-shadow: 0 0 12px currentColor; }

    .hero-title {
      max-width: 760px;
      margin: 0;
      font-size: clamp(3.5rem, 7.2vw, 7.8rem);
      line-height: 0.86;
      letter-spacing: -0.065em;
      text-transform: uppercase;
      text-wrap: balance;
      text-shadow: 0 10px 32px rgba(0, 0, 0, 0.42);
    }
    .hero-title .accent { color: var(--cyan); text-shadow: 0 0 35px rgba(20, 229, 219, 0.25); }
    .hero-subtitle { margin: 23px 0 0; font-size: clamp(1.15rem, 2vw, 1.55rem); color: #d8e1eb; font-weight: 520; }
    .hero-description { max-width: 630px; margin: 14px 0 0; color: #bdc5d0; line-height: 1.65; font-size: 1rem; }
    .hero-meta { display: flex; flex-wrap: wrap; gap: 10px; margin-top: 20px; }
    .meta-pill {
      display: inline-flex;
      align-items: center;
      gap: 6px;
      min-height: 31px;
      padding: 5px 11px;
      border: 1px solid rgba(255, 255, 255, 0.13);
      border-radius: 999px;
      color: #dbe2eb;
      background: rgba(8, 11, 16, 0.42);
      backdrop-filter: blur(8px);
      font-size: 0.78rem;
      font-weight: 720;
    }
    .hero-actions { display: flex; flex-wrap: wrap; gap: 12px; margin-top: 28px; }

    .button {
      min-height: 48px;
      display: inline-flex;
      align-items: center;
      justify-content: center;
      gap: 9px;
      padding: 0 20px;
      border: 1px solid transparent;
      border-radius: 12px;
      cursor: pointer;
      font-weight: 820;
      transition: transform 180ms ease, filter 180ms ease, border-color 180ms ease, background 180ms ease;
    }
    .button:hover { transform: translateY(-2px); }
    .button:active { transform: translateY(0); }
    .button svg { width: 18px; height: 18px; }
    .button-primary { color: #061011; background: linear-gradient(135deg, var(--cyan), #6cf8ef); box-shadow: 0 12px 32px rgba(20, 229, 219, 0.17); }
    .button-primary:hover { filter: brightness(1.08); }
    .button-secondary { border-color: rgba(255, 255, 255, 0.18); background: rgba(255, 255, 255, 0.1); backdrop-filter: blur(12px); }
    .button-secondary:hover { background: rgba(255, 255, 255, 0.16); }
    .button-ghost { min-height: 42px; border-color: var(--line); background: transparent; color: #dde4ec; }
    .button-ghost:hover { border-color: rgba(20, 229, 219, 0.42); background: rgba(20, 229, 219, 0.07); }

    .hero-bottom {
      position: absolute;
      left: 0;
      right: 0;
      bottom: 54px;
      display: flex;
      align-items: center;
      justify-content: space-between;
      pointer-events: none;
    }
    .hero-bottom > * { pointer-events: auto; }
    .hero-dots { display: flex; align-items: center; gap: 8px; }
    .hero-dot {
      width: 8px;
      height: 8px;
      padding: 0;
      border: 0;
      border-radius: 50%;
      background: rgba(255, 255, 255, 0.42);
      cursor: pointer;
      transition: width 180ms ease, background 180ms ease, border-radius 180ms ease;
    }
    .hero-dot.is-active { width: 28px; border-radius: 99px; background: var(--cyan); box-shadow: 0 0 18px rgba(20, 229, 219, 0.55); }
    .hero-control-group { display: flex; gap: 8px; }
    .hero-control {
      width: 42px;
      height: 42px;
      display: grid;
      place-items: center;
      border: 1px solid rgba(255, 255, 255, 0.14);
      border-radius: 50%;
      background: rgba(5, 8, 12, 0.56);
      backdrop-filter: blur(10px);
      cursor: pointer;
    }
    .hero-control:hover { border-color: var(--cyan); color: var(--cyan); }

    /* ---------- Contenido ---------- */
    main { position: relative; z-index: 1; }
    .catalog { padding-bottom: 80px; }
    .section { margin-top: 52px; }
    .section:first-child { margin-top: -22px; }
    .section-heading {
      display: flex;
      align-items: end;
      justify-content: space-between;
      gap: 20px;
      margin-bottom: 18px;
    }
    .section-title-wrap { min-width: 0; }
    .section-kicker { color: var(--cyan); font-size: 0.72rem; letter-spacing: 0.15em; font-weight: 850; text-transform: uppercase; }
    .section-title { margin: 5px 0 0; font-size: clamp(1.35rem, 2vw, 1.9rem); letter-spacing: -0.03em; }
    .section-title strong { color: var(--red); }
    .section-copy { margin: 7px 0 0; color: var(--muted); font-size: 0.9rem; }
    .row-actions { display: flex; gap: 7px; flex: 0 0 auto; }
    .row-arrow {
      width: 39px;
      height: 39px;
      display: grid;
      place-items: center;
      border: 1px solid var(--line);
      border-radius: 50%;
      background: rgba(255, 255, 255, 0.035);
      cursor: pointer;
      transition: border-color 180ms ease, background 180ms ease;
    }
    .row-arrow:hover { border-color: rgba(20, 229, 219, 0.45); background: rgba(20, 229, 219, 0.07); }
    .row-arrow:disabled { opacity: 0.28; cursor: not-allowed; }

    .content-row {
      display: grid;
      grid-auto-flow: column;
      grid-auto-columns: clamp(155px, 14.2vw, 220px);
      gap: 14px;
      overflow-x: auto;
      overflow-y: hidden;
      padding: 4px 2px 24px;
      scroll-snap-type: x proximity;
      scrollbar-width: none;
      overscroll-behavior-inline: contain;
    }
    .content-row::-webkit-scrollbar { display: none; }

    .media-card {
      position: relative;
      min-width: 0;
      scroll-snap-align: start;
      border-radius: 14px;
      outline: none;
    }
    .poster-button {
      position: relative;
      width: 100%;
      aspect-ratio: 2 / 3;
      padding: 0;
      overflow: hidden;
      border: 1px solid rgba(255, 255, 255, 0.08);
      border-radius: 14px;
      background: #141a24;
      cursor: pointer;
      box-shadow: 0 10px 24px rgba(0, 0, 0, 0.22);
      transition: transform 220ms cubic-bezier(.2,.8,.2,1), box-shadow 220ms ease, border-color 220ms ease;
    }
    .poster-button:hover, .poster-button:focus-visible {
      z-index: 3;
      transform: translateY(-7px) scale(1.025);
      border-color: rgba(20, 229, 219, 0.42);
      box-shadow: 0 18px 42px rgba(0, 0, 0, 0.5), 0 0 26px rgba(20, 229, 219, 0.07);
    }
    .poster-image, .live-image {
      position: absolute;
      inset: 0;
      width: 100%;
      height: 100%;
      object-fit: cover;
      opacity: 0;
      transition: opacity 240ms ease, transform 500ms ease;
    }
    .poster-image.is-loaded, .live-image.is-loaded { opacity: 1; }
    .poster-button:hover .poster-image { transform: scale(1.055); }

    .poster-placeholder {
      position: absolute;
      inset: 0;
      display: flex;
      flex-direction: column;
      align-items: flex-start;
      justify-content: flex-end;
      padding: 16px;
      background:
        radial-gradient(circle at 75% 20%, rgba(201, 44, 255, 0.35), transparent 30%),
        radial-gradient(circle at 20% 72%, rgba(20, 229, 219, 0.2), transparent 34%),
        linear-gradient(145deg, #202738, #111621 58%, #1f1227);
    }
    .poster-placeholder::before {
      content: "";
      position: absolute;
      inset: 11px;
      border: 1px solid rgba(255, 255, 255, 0.08);
      border-radius: 10px;
    }
    .placeholder-number { position: absolute; top: 16px; right: 16px; color: rgba(255, 255, 255, 0.13); font-size: 3.6rem; font-weight: 950; line-height: 1; }
    .placeholder-label { position: relative; z-index: 1; color: rgba(255, 255, 255, 0.58); font-size: 0.7rem; letter-spacing: 0.13em; text-transform: uppercase; }
    .placeholder-title { position: relative; z-index: 1; margin-top: 4px; font-size: 1.05rem; font-weight: 900; text-align: left; line-height: 1.08; }

    .card-topline {
      position: absolute;
      inset: 10px 10px auto;
      z-index: 2;
      display: flex;
      align-items: center;
      justify-content: space-between;
      gap: 7px;
    }
    .badge {
      min-height: 25px;
      display: inline-flex;
      align-items: center;
      gap: 5px;
      padding: 4px 8px;
      border-radius: 7px;
      background: rgba(7, 10, 14, 0.78);
      backdrop-filter: blur(7px);
      color: #fff;
      font-size: 0.62rem;
      font-weight: 850;
      letter-spacing: 0.04em;
      text-transform: uppercase;
    }
    .badge-new { background: var(--red); }
    .badge-live { background: var(--red); box-shadow: 0 0 16px rgba(255, 46, 79, 0.28); }
    .live-dot { width: 6px; height: 6px; border-radius: 50%; background: #fff; animation: pulse 1.35s infinite; }
    @keyframes pulse { 50% { opacity: 0.3; transform: scale(0.75); } }

    .favorite-button {
      width: 31px;
      height: 31px;
      display: grid;
      place-items: center;
      border: 1px solid rgba(255, 255, 255, 0.2);
      border-radius: 50%;
      color: #fff;
      background: rgba(5, 7, 10, 0.68);
      cursor: pointer;
    }
    .favorite-button:hover, .favorite-button.is-active { border-color: var(--cyan); color: var(--cyan); background: rgba(5, 19, 20, 0.8); }
    .favorite-button svg { width: 15px; height: 15px; }

    .poster-shade { position: absolute; inset: 36% 0 0; background: linear-gradient(to top, rgba(2, 4, 6, 0.96), rgba(2, 4, 6, 0.6), transparent); pointer-events: none; }
    .poster-play {
      position: absolute;
      left: 13px;
      bottom: 13px;
      z-index: 2;
      width: 38px;
      height: 38px;
      display: grid;
      place-items: center;
      border: 0;
      border-radius: 50%;
      color: #061012;
      background: #fff;
      opacity: 0;
      transform: translateY(8px);
      transition: opacity 180ms ease, transform 180ms ease;
    }
    .poster-button:hover .poster-play, .poster-button:focus-visible .poster-play { opacity: 1; transform: translateY(0); }
    .poster-play svg { width: 16px; height: 16px; margin-left: 2px; }

    .card-info { padding: 11px 3px 0; }
    .card-title { overflow: hidden; margin: 0; color: #f7f8fb; font-size: 0.89rem; font-weight: 780; text-overflow: ellipsis; white-space: nowrap; }
    .card-meta { display: flex; align-items: center; gap: 7px; margin-top: 5px; color: var(--muted); font-size: 0.7rem; }
    .rating { color: var(--yellow); }
    .progress-track { height: 3px; margin-top: 9px; overflow: hidden; border-radius: 99px; background: rgba(255, 255, 255, 0.15); }
    .progress-value { height: 100%; border-radius: inherit; background: linear-gradient(90deg, var(--red), var(--purple)); }

    /* ---------- Canales en vivo ---------- */
    .live-grid {
      display: grid;
      grid-template-columns: repeat(4, minmax(0, 1fr));
      gap: 14px;
    }
    .live-card {
      position: relative;
      overflow: hidden;
      min-height: 200px;
      border: 1px solid rgba(20, 229, 219, 0.2);
      border-radius: 15px;
      background: var(--panel);
      cursor: pointer;
      transition: transform 200ms ease, border-color 200ms ease, box-shadow 200ms ease;
    }
    .live-card:nth-child(3n + 2) { border-color: rgba(201, 44, 255, 0.28); }
    .live-card:nth-child(3n) { border-color: rgba(255, 46, 79, 0.28); }
    .live-card:hover { transform: translateY(-5px); border-color: var(--cyan); box-shadow: 0 18px 35px rgba(0, 0, 0, 0.28); }
    .live-art { position: relative; aspect-ratio: 16 / 9; overflow: hidden; background: linear-gradient(135deg, #232d3d, #10151f); }
    .live-art::before { content: ""; position: absolute; inset: 0; background: radial-gradient(circle at 68% 28%, rgba(20, 229, 219, 0.24), transparent 27%), linear-gradient(135deg, transparent 30%, rgba(201, 44, 255, 0.18)); }
    .live-placeholder { position: absolute; inset: 0; display: grid; place-items: center; color: rgba(255,255,255,.42); font-weight: 900; letter-spacing: .13em; font-size: .72rem; }
    .live-card .card-topline { inset: 10px; }
    .live-body { padding: 12px 13px 14px; }
    .live-title { margin: 0; font-size: 0.96rem; }
    .live-program { margin: 5px 0 0; color: var(--muted); font-size: 0.75rem; white-space: nowrap; overflow: hidden; text-overflow: ellipsis; }

    /* ---------- Filtros y búsqueda ---------- */
    .toolbar-section { margin-top: 36px; }
    .catalog-toolbar {
      display: flex;
      align-items: center;
      justify-content: space-between;
      gap: 18px;
      padding: 16px;
      border: 1px solid var(--line);
      border-radius: 17px;
      background: rgba(17, 23, 34, 0.76);
      backdrop-filter: blur(14px);
    }
    .filter-summary { min-width: 0; }
    .filter-summary strong { display: block; font-size: 0.95rem; }
    .filter-summary span { display: block; margin-top: 3px; color: var(--muted); font-size: 0.75rem; }
    .filter-actions { display: flex; flex-wrap: wrap; justify-content: flex-end; gap: 8px; }
    .filter-chip {
      min-height: 38px;
      display: inline-flex;
      align-items: center;
      gap: 7px;
      padding: 0 13px;
      border: 1px solid var(--line);
      border-radius: 99px;
      background: rgba(255, 255, 255, 0.035);
      cursor: pointer;
      font-size: 0.78rem;
      font-weight: 720;
    }
    .filter-chip:hover, .filter-chip.is-active { border-color: var(--cyan); color: var(--cyan); background: rgba(20, 229, 219, 0.07); }
    .filter-count { min-width: 20px; height: 20px; display: grid; place-items: center; padding: 0 5px; border-radius: 99px; color: #041010; background: var(--cyan); font-size: 0.65rem; }

    .search-view { display: none; padding-top: 30px; }
    .search-view.is-visible { display: block; }
    .search-grid {
      display: grid;
      grid-template-columns: repeat(6, minmax(0, 1fr));
      gap: 26px 14px;
    }
    .empty-state {
      grid-column: 1 / -1;
      display: grid;
      place-items: center;
      min-height: 280px;
      padding: 36px;
      border: 1px dashed rgba(255, 255, 255, 0.15);
      border-radius: var(--radius);
      color: var(--muted);
      text-align: center;
    }
    .empty-state strong { display: block; margin-bottom: 7px; color: #fff; font-size: 1.05rem; }

    .filter-drawer {
      position: fixed;
      inset: 0;
      z-index: 180;
      display: none;
      background: rgba(0, 0, 0, 0.66);
      backdrop-filter: blur(8px);
    }
    .filter-drawer.is-open { display: block; }
    .filter-panel {
      position: absolute;
      top: 0;
      right: 0;
      width: min(480px, 100%);
      height: 100%;
      overflow-y: auto;
      padding: 26px;
      border-left: 1px solid var(--line);
      background: #0c1119;
      box-shadow: -25px 0 70px rgba(0, 0, 0, 0.45);
      animation: slideIn 240ms ease both;
    }
    @keyframes slideIn { from { transform: translateX(24px); opacity: 0; } }
    .panel-heading { display: flex; align-items: center; justify-content: space-between; gap: 20px; }
    .panel-heading h2 { margin: 0; font-size: 1.5rem; }
    .filter-group { padding: 22px 0; border-bottom: 1px solid var(--line); }
    .filter-group:last-of-type { border-bottom: 0; }
    .filter-group-title { margin: 0 0 12px; color: #dce3eb; font-size: 0.82rem; text-transform: uppercase; letter-spacing: 0.09em; }
    .choice-grid { display: flex; flex-wrap: wrap; gap: 8px; }
    .choice-input { position: absolute; opacity: 0; pointer-events: none; }
    .choice-label {
      min-height: 38px;
      display: inline-flex;
      align-items: center;
      justify-content: center;
      padding: 0 13px;
      border: 1px solid var(--line);
      border-radius: 10px;
      color: #cbd3de;
      background: rgba(255, 255, 255, 0.03);
      cursor: pointer;
      font-size: 0.76rem;
      font-weight: 700;
    }
    .choice-input:checked + .choice-label { border-color: var(--cyan); color: var(--cyan); background: rgba(20, 229, 219, 0.08); }
    .select-field {
      width: 100%;
      height: 44px;
      padding: 0 12px;
      border: 1px solid var(--line);
      border-radius: 10px;
      color: #fff;
      background: #111722;
      outline: none;
    }
    .range-row { display: grid; grid-template-columns: 1fr auto; align-items: center; gap: 12px; }
    input[type="range"] { width: 100%; accent-color: var(--cyan); }
    .filter-panel-footer { position: sticky; bottom: -26px; display: grid; grid-template-columns: 1fr 1fr; gap: 10px; margin: 24px -26px -26px; padding: 18px 26px 26px; background: linear-gradient(to top, #0c1119 72%, transparent); }

    .search-overlay {
      position: fixed;
      inset: 0;
      z-index: 170;
      display: none;
      background: rgba(4, 6, 9, 0.9);
      backdrop-filter: blur(18px);
    }
    .search-overlay.is-open { display: block; }
    .search-overlay-inner { width: min(900px, calc(100% - 34px)); margin: 10vh auto 0; }
    .search-box {
      display: grid;
      grid-template-columns: auto 1fr auto;
      align-items: center;
      gap: 14px;
      padding: 0 17px;
      border: 1px solid rgba(20, 229, 219, 0.4);
      border-radius: 15px;
      background: #101620;
      box-shadow: 0 0 42px rgba(20, 229, 219, 0.09);
    }
    .search-box input { height: 62px; border: 0; outline: 0; color: #fff; background: transparent; font-size: clamp(1rem, 2vw, 1.25rem); }
    .search-suggestions { margin-top: 18px; color: var(--muted); font-size: 0.82rem; }
    .suggestion-chips { display: flex; flex-wrap: wrap; gap: 8px; margin-top: 10px; }

    /* ---------- Bloque de app ---------- */
    .app-promo {
      position: relative;
      overflow: hidden;
      margin-top: 72px;
      padding: clamp(38px, 6vw, 76px) 0;
      border-top: 1px solid var(--line);
      border-bottom: 1px solid var(--line);
      background:
        radial-gradient(circle at 10% 50%, rgba(20, 229, 219, 0.14), transparent 25%),
        radial-gradient(circle at 90% 25%, rgba(201, 44, 255, 0.16), transparent 25%),
        #0a0f16;
    }
    .app-promo::before, .app-promo::after {
      content: "";
      position: absolute;
      width: 260px;
      height: 260px;
      border: 1px solid rgba(20, 229, 219, 0.14);
      transform: rotate(45deg);
    }
    .app-promo::before { left: -160px; top: 30px; }
    .app-promo::after { right: -150px; bottom: 10px; border-color: rgba(201,44,255,.18); }
    .promo-inner { position: relative; z-index: 1; text-align: center; }
    .promo-icon {
      width: 72px;
      height: 72px;
      display: grid;
      place-items: center;
      margin: 0 auto 18px;
      border-radius: 20px;
      color: #061013;
      background: linear-gradient(135deg, var(--cyan), #5df4d7);
      box-shadow: 0 0 48px rgba(20, 229, 219, 0.2);
    }
    .promo-icon svg { width: 34px; height: 34px; }
    .promo-title { margin: 0; font-size: clamp(2rem, 4vw, 3.4rem); letter-spacing: -0.05em; }
    .promo-copy { max-width: 700px; margin: 13px auto 0; color: var(--muted); line-height: 1.65; }
    .trust-row { display: flex; flex-wrap: wrap; justify-content: center; gap: 10px; margin-top: 22px; }
    .trust-item { min-height: 43px; display: inline-flex; align-items: center; gap: 8px; padding: 0 13px; border: 1px solid var(--line); border-radius: 11px; background: rgba(255,255,255,.025); color: #dbe2ea; font-size: .73rem; font-weight: 750; }
    .trust-item svg { width: 18px; height: 18px; color: var(--success); }
    .steps-grid { display: grid; grid-template-columns: repeat(3, 1fr); gap: 14px; max-width: 970px; margin: 38px auto 0; }
    .step-card { min-height: 180px; padding: 25px; border: 1px solid var(--line); border-radius: 15px; background: rgba(255,255,255,.035); text-align: left; }
    .step-number { color: var(--cyan); font-size: 2rem; font-weight: 950; }
    .step-card:nth-child(2) .step-number { color: #7b8cff; }
    .step-card:nth-child(3) .step-number { color: var(--purple); }
    .step-title { margin: 8px 0 0; font-size: .9rem; text-transform: uppercase; }
    .step-copy { margin: 8px 0 0; color: var(--muted); font-size: .78rem; line-height: 1.5; }
    .download-row { margin-top: 24px; }
    .button-download { min-width: min(100%, 390px); min-height: 58px; font-size: 1rem; }
    .button[aria-disabled="true"] { opacity: 0.7; cursor: not-allowed; }

    /* ---------- Modal ---------- */
    .modal-backdrop {
      position: fixed;
      inset: 0;
      z-index: 200;
      display: none;
      align-items: center;
      justify-content: center;
      padding: 24px;
      background: rgba(0, 0, 0, 0.78);
      backdrop-filter: blur(10px);
    }
    .modal-backdrop.is-open { display: flex; }
    .detail-modal {
      width: min(940px, 100%);
      max-height: min(90vh, 820px);
      overflow: auto;
      border: 1px solid var(--line);
      border-radius: 22px;
      background: #0c1119;
      box-shadow: var(--shadow);
      animation: modalIn 220ms ease both;
    }
    @keyframes modalIn { from { opacity: 0; transform: translateY(18px) scale(.98); } }
    .modal-hero { position: relative; min-height: 420px; overflow: hidden; background: linear-gradient(135deg, #242c3e, #151a24 55%, #28152f); }
    .modal-image { position: absolute; inset: 0; width: 100%; height: 100%; object-fit: cover; opacity: 0; }
    .modal-image.is-loaded { opacity: 1; }
    .modal-hero::after { content: ""; position: absolute; inset: 0; background: linear-gradient(to top, #0c1119 0%, rgba(12,17,25,.3) 52%, rgba(12,17,25,.1)); }
    .modal-close { position: absolute; z-index: 3; top: 17px; right: 17px; color: #fff; background: rgba(3, 5, 8, .72); }
    .modal-copy { position: absolute; z-index: 2; left: 30px; right: 30px; bottom: 28px; }
    .modal-title { max-width: 700px; margin: 0; font-size: clamp(2.2rem, 5vw, 4.8rem); line-height: .95; letter-spacing: -.05em; }
    .modal-body { display: grid; grid-template-columns: 1.7fr 1fr; gap: 36px; padding: 4px 30px 34px; }
    .modal-description { margin: 0; color: #c6ced9; line-height: 1.7; }
    .detail-list { display: grid; gap: 9px; color: var(--muted); font-size: .82rem; }
    .detail-list strong { color: #fff; }

    /* ---------- Toast ---------- */
    .toast-stack { position: fixed; z-index: 300; right: 20px; bottom: 20px; display: grid; gap: 10px; }
    .toast {
      min-width: min(350px, calc(100vw - 40px));
      padding: 13px 15px;
      border: 1px solid var(--line);
      border-radius: 12px;
      background: rgba(16, 22, 32, 0.96);
      box-shadow: var(--shadow);
      animation: toastIn 220ms ease both;
      font-size: .82rem;
    }
    @keyframes toastIn { from { opacity: 0; transform: translateY(10px); } }

    .back-to-top {
      position: fixed;
      right: 20px;
      bottom: 82px;
      z-index: 120;
      width: 46px;
      height: 46px;
      display: grid;
      place-items: center;
      border: 1px solid rgba(20, 229, 219, 0.3);
      border-radius: 14px;
      color: var(--cyan);
      background: rgba(10, 15, 22, 0.88);
      box-shadow: 0 14px 35px rgba(0, 0, 0, 0.34);
      backdrop-filter: blur(12px);
      cursor: pointer;
      opacity: 0;
      visibility: hidden;
      transform: translateY(12px);
      transition: opacity 180ms ease, visibility 180ms ease, transform 180ms ease, background 180ms ease;
    }
    .back-to-top.is-visible { opacity: 1; visibility: visible; transform: translateY(0); }
    .back-to-top:hover { color: #061013; background: var(--cyan); }
    .back-to-top svg { width: 20px; height: 20px; }

    /* ---------- Pie ---------- */
    .site-footer { padding: 42px 0; color: var(--muted); }
    .footer-inner { display: grid; grid-template-columns: 1fr auto; align-items: end; gap: 30px; }
    .footer-brand { margin-bottom: 10px; }
    .footer-copy { max-width: 560px; margin: 0; font-size: .78rem; line-height: 1.6; }
    .footer-links { display: flex; flex-wrap: wrap; justify-content: flex-end; gap: 18px; font-size: .76rem; }
    .footer-links a:hover { color: var(--cyan); }

    /* ---------- Responsive ---------- */
    @media (max-width: 1180px) {
      .main-nav { display: none; }
      .mobile-menu-button { display: inline-grid; }
      .header-inner { grid-template-columns: auto 1fr auto; }
      .live-grid { grid-template-columns: repeat(3, 1fr); }
      .search-grid { grid-template-columns: repeat(5, minmax(0, 1fr)); }
    }

    @media (max-width: 900px) {
      :root { --header-h: 64px; }
      .container { width: min(calc(100% - 28px), var(--content-max)); }
      .profile-name { display: none; }
      .hero { min-height: 690px; height: 84vh; }
      .hero-copy { width: min(650px, 88vw); }
      .hero-overlay { background: linear-gradient(90deg, rgba(3,5,8,.96) 0%, rgba(3,5,8,.74) 70%, rgba(3,5,8,.4)), linear-gradient(to top, var(--bg), transparent 50%); }
      .hero-placeholder::before { width: 56vw; }
      .live-grid { grid-template-columns: repeat(2, 1fr); }
      .search-grid { grid-template-columns: repeat(4, minmax(0, 1fr)); }
      .steps-grid { grid-template-columns: 1fr; }
      .step-card { min-height: auto; text-align: center; }
      .modal-body { grid-template-columns: 1fr; gap: 22px; }
    }

    @media (max-width: 680px) {
      .header-inner { gap: 10px; }
      .header-actions { gap: 2px; }
      .profile-button { display: none; }
      .hero { min-height: 650px; height: 88svh; }
      .hero-copy { width: 100%; padding-top: 70px; }
      .hero-title { font-size: clamp(3.1rem, 15vw, 5.1rem); }
      .hero-description { display: -webkit-box; overflow: hidden; -webkit-box-orient: vertical; -webkit-line-clamp: 3; }
      .hero-bottom { bottom: 30px; }
      .hero-control-group { display: none; }
      .section { margin-top: 42px; }
      .section:first-child { margin-top: -8px; }
      .section-copy { display: none; }
      .content-row { grid-auto-columns: min(42vw, 175px); }
      .row-actions { display: none; }
      .live-grid { grid-template-columns: 1fr; }
      .live-card { display: grid; grid-template-columns: 43% 1fr; min-height: 126px; }
      .live-art { aspect-ratio: auto; min-height: 126px; }
      .live-body { display: flex; flex-direction: column; justify-content: center; }
      .catalog-toolbar { align-items: flex-start; flex-direction: column; }
      .filter-actions { justify-content: flex-start; }
      .search-grid { grid-template-columns: repeat(2, minmax(0, 1fr)); }
      .promo-title { font-size: 2rem; }
      .trust-row { display: grid; grid-template-columns: 1fr; }
      .footer-inner { grid-template-columns: 1fr; }
      .footer-links { justify-content: flex-start; }
      .modal-backdrop { padding: 0; align-items: end; }
      .detail-modal { max-height: 94svh; border-radius: 22px 22px 0 0; }
      .modal-hero { min-height: 360px; }
      .modal-copy { left: 20px; right: 20px; }
      .modal-body { padding-inline: 20px; }
    }

    /* ---------- Menú móvil ---------- */
    .mobile-nav-drawer {
      position: fixed;
      inset: 0;
      z-index: 190;
      display: none;
      background: rgba(0, 0, 0, 0.66);
      backdrop-filter: blur(8px);
    }
    .mobile-nav-drawer.is-open { display: block; }
    .mobile-nav-panel {
      position: absolute;
      top: 0;
      right: 0;
      width: min(340px, 84vw);
      height: 100%;
      overflow-y: auto;
      padding: 22px;
      border-left: 1px solid var(--line);
      background: #0c1119;
      box-shadow: -25px 0 70px rgba(0, 0, 0, 0.45);
      animation: slideIn 240ms ease both;
    }
    .mobile-nav-header { display: flex; align-items: center; justify-content: space-between; gap: 16px; }
    .mobile-nav-links { display: grid; gap: 3px; margin-top: 26px; }
    .mobile-nav-link {
      display: flex;
      align-items: center;
      min-height: 52px;
      padding: 0 10px;
      border-radius: 11px;
      color: #dde4ec;
      font-size: 1.05rem;
      font-weight: 720;
      transition: background 180ms ease, color 180ms ease;
    }
    .mobile-nav-link:hover, .mobile-nav-link.is-active { color: var(--cyan); background: rgba(20, 229, 219, 0.08); }
    .mobile-nav-foot { display: grid; gap: 8px; margin-top: 22px; padding-top: 20px; border-top: 1px solid var(--line); }
    .mobile-nav-profile {
      display: flex;
      align-items: center;
      gap: 11px;
      min-height: 52px;
      padding: 0 10px;
      border: 0;
      border-radius: 11px;
      background: transparent;
      cursor: pointer;
      color: inherit;
      text-align: left;
    }
    .mobile-nav-profile:hover { background: rgba(255, 255, 255, 0.06); }

    @media (min-width: 1181px) {
      .mobile-nav-drawer { display: none !important; }
    }

    @media (max-width: 380px) {
      .header-actions { gap: 0; }
      .icon-button { width: 38px; height: 38px; }
      .icon-button svg { width: 18px; height: 18px; }
      .hero-title { font-size: clamp(2.5rem, 14vw, 4rem); }
      .search-grid { gap: 20px 10px; }
      .live-card { grid-template-columns: 38% 1fr; }
    }

    @media (prefers-reduced-motion: reduce) {
      *, *::before, *::after { scroll-behavior: auto !important; animation-duration: .01ms !important; animation-iteration-count: 1 !important; transition-duration: .01ms !important; }
    }
  

    /* ===== RESPONSIVE HARDENING ===== */
    /* Evita solapamientos entre el hero, sus controles y el catálogo. */
    .hero {
      height: auto;
      min-height: clamp(760px, 88vh, 920px);
    }

    .hero-content {
      min-height: inherit;
      height: auto;
      padding-top: calc(var(--header-h) + 72px);
      padding-bottom: 142px;
    }

    .hero-copy {
      padding-top: 0;
    }

    /* La compensación negativa anterior afectaba también a la primera fila
       generada dentro de #standardCatalog y hacía que invadiera la toolbar. */
    .section:first-child {
      margin-top: 52px;
    }

    .catalog > .section:first-child {
      margin-top: 0;
      padding-top: 38px;
    }

    #standardCatalog > .section:first-child {
      margin-top: 52px;
    }

    .toolbar-section {
      position: relative;
      z-index: 2;
      margin-top: 40px;
      margin-bottom: 0;
    }

    .catalog-toolbar,
    .section-heading,
    .hero-copy,
    .filter-summary,
    .live-body,
    .modal-copy {
      min-width: 0;
    }

    .hero-title,
    .hero-subtitle,
    .hero-description,
    .section-title,
    .section-copy,
    .filter-summary strong,
    .filter-summary span,
    .live-title,
    .live-program,
    .modal-title,
    .modal-description {
      overflow-wrap: anywhere;
    }

    @media (max-width: 1180px) {
      .hero-copy { width: min(700px, 72vw); }
      .hero-title { font-size: clamp(3.4rem, 8.4vw, 6.5rem); }
      .content-row { grid-auto-columns: clamp(160px, 19vw, 210px); }
    }

    @media (max-width: 900px) {
      .hero {
        min-height: max(760px, 100svh);
      }

      .hero-content {
        align-items: center;
        padding-top: calc(var(--header-h) + 58px);
        padding-bottom: 132px;
      }

      .hero-copy {
        width: min(680px, 92vw);
      }

      .hero-title {
        font-size: clamp(3.2rem, 11vw, 5.8rem);
      }

      .hero-placeholder::before {
        width: 62vw;
        height: 48vh;
        right: -5%;
      }

      .hero-placeholder::after {
        width: 42vw;
        right: 2%;
      }

      .catalog > .section:first-child {
        padding-top: 32px;
      }

      .section-heading {
        align-items: flex-start;
      }

      .catalog-toolbar {
        align-items: flex-start;
      }

      .content-row {
        grid-auto-columns: clamp(160px, 26vw, 205px);
      }
    }

    @media (max-width: 680px) {
      :root { --header-h: 62px; }

      .container {
        width: min(calc(100% - 24px), var(--content-max));
      }

      .site-header {
        background: rgba(6, 8, 12, 0.92);
        backdrop-filter: blur(15px);
      }

      .header-inner {
        grid-template-columns: minmax(0, auto) 1fr auto;
        gap: 6px;
      }

      .brand {
        font-size: clamp(1.25rem, 6vw, 1.55rem);
      }

      .header-actions {
        justify-self: end;
      }

      .hero {
        min-height: max(740px, 100svh);
        overflow: hidden;
      }

      .hero-content {
        align-items: flex-start;
        padding-top: calc(var(--header-h) + 54px);
        padding-bottom: 126px;
      }

      .hero-copy {
        width: 100%;
        max-width: 620px;
      }

      .eyebrow {
        margin-bottom: 13px;
        font-size: 0.68rem;
        letter-spacing: 0.12em;
      }

      .hero-title {
        max-width: 100%;
        font-size: clamp(2.75rem, 13.5vw, 4.6rem);
        line-height: 0.9;
        letter-spacing: -0.055em;
      }

      .hero-subtitle {
        margin-top: 16px;
        font-size: clamp(1rem, 4.8vw, 1.25rem);
      }

      .hero-description {
        display: -webkit-box;
        margin-top: 10px;
        overflow: hidden;
        font-size: 0.9rem;
        line-height: 1.5;
        -webkit-box-orient: vertical;
        -webkit-line-clamp: 3;
        line-clamp: 3;
      }

      .hero-meta {
        gap: 7px;
        margin-top: 15px;
      }

      .meta-pill {
        min-height: 28px;
        padding: 4px 9px;
        font-size: 0.68rem;
      }

      .hero-actions {
        display: grid;
        grid-template-columns: minmax(0, 1fr) minmax(0, 1fr);
        gap: 9px;
        width: 100%;
        margin-top: 20px;
      }

      .hero-actions .button {
        min-width: 0;
        min-height: 48px;
        padding-inline: 12px;
        white-space: normal;
        text-align: center;
        line-height: 1.15;
      }

      .hero-bottom {
        bottom: 38px;
      }

      .catalog {
        padding-bottom: 60px;
      }

      .catalog > .section:first-child {
        margin-top: 0;
        padding-top: 30px;
      }

      .section,
      .section:first-child,
      #standardCatalog > .section:first-child {
        margin-top: 40px;
      }

      .catalog > .section:first-child {
        margin-top: 0;
      }

      .section-heading {
        align-items: flex-start;
        margin-bottom: 15px;
      }

      .section-title {
        font-size: clamp(1.35rem, 7.4vw, 1.8rem);
        line-height: 1.08;
      }

      .section-copy {
        display: block;
        font-size: 0.78rem;
        line-height: 1.45;
      }

      .toolbar-section {
        margin-top: 32px;
      }

      .catalog-toolbar {
        gap: 14px;
        padding: 14px;
        border-radius: 15px;
      }

      .filter-summary {
        width: 100%;
      }

      .filter-actions {
        display: grid;
        grid-template-columns: repeat(2, minmax(0, 1fr));
        width: 100%;
      }

      .filter-chip {
        width: 100%;
        min-width: 0;
        justify-content: center;
        padding-inline: 10px;
      }

      .content-row {
        grid-auto-columns: clamp(145px, 43vw, 178px);
        gap: 11px;
        padding-bottom: 18px;
      }

      .live-card {
        grid-template-columns: minmax(116px, 40%) minmax(0, 1fr);
      }

      .live-body {
        padding: 10px 11px;
      }

      .live-title {
        font-size: 0.9rem;
      }

      .live-program {
        white-space: normal;
        display: -webkit-box;
        -webkit-box-orient: vertical;
        -webkit-line-clamp: 2;
        line-clamp: 2;
      }

      .search-view {
        padding-top: 26px;
      }

      .search-view .section-heading {
        display: grid;
      }

      .search-view .button-ghost {
        width: 100%;
      }

      .filter-panel {
        width: 100%;
        padding: 20px 18px;
      }

      .filter-panel-footer {
        bottom: -20px;
        margin: 20px -18px -20px;
        padding: 16px 18px 20px;
      }

      .modal-copy .hero-actions {
        grid-template-columns: 1fr;
      }

      .modal-title {
        font-size: clamp(2rem, 11vw, 3.4rem);
      }

      .toast-stack {
        right: 12px;
        bottom: 12px;
        left: 12px;
      }

      .toast {
        min-width: 0;
        width: 100%;
      }

      .back-to-top {
        right: 12px;
        bottom: 74px;
      }
    }

    @media (max-width: 480px) {
      .icon-button {
        width: 38px;
        height: 38px;
      }

      .header-actions .icon-button[aria-label="Notificaciones"] {
        display: none;
      }

      .hero {
        min-height: max(720px, 100svh);
      }

      .hero-content {
        padding-top: calc(var(--header-h) + 42px);
        padding-bottom: 122px;
      }

      .hero-title {
        font-size: clamp(2.55rem, 13vw, 3.75rem);
      }

      .hero-actions {
        grid-template-columns: 1fr;
      }

      .hero-actions .button {
        min-height: 46px;
      }

      .hero-bottom {
        bottom: 30px;
      }

      .filter-actions {
        grid-template-columns: 1fr;
      }

      .live-card {
        grid-template-columns: 38% minmax(0, 1fr);
      }

      .search-grid {
        gap: 20px 10px;
      }

      .modal-hero {
        min-height: 330px;
      }

      .modal-copy {
        left: 16px;
        right: 16px;
        bottom: 20px;
      }

      .modal-body {
        padding: 0 16px 26px;
      }
    }

    @media (max-width: 360px) {
      .container {
        width: min(calc(100% - 18px), var(--content-max));
      }

      .brand-mark {
        display: none;
      }

      .hero-title {
        font-size: 2.45rem;
      }

      .meta-pill {
        font-size: 0.64rem;
      }

      .content-row {
        grid-auto-columns: min(70vw, 170px);
      }

      .search-grid {
        grid-template-columns: 1fr;
      }

      .live-card {
        grid-template-columns: 1fr;
      }

      .live-art {
        min-height: 150px;
        aspect-ratio: 16 / 9;
      }
    }

    @media (max-height: 700px) and (min-width: 681px) {
      .hero {
        min-height: 680px;
      }

      .hero-content {
        padding-top: calc(var(--header-h) + 42px);
        padding-bottom: 112px;
      }

      .hero-copy {
        width: min(650px, 68vw);
      }

      .hero-title {
        font-size: clamp(3rem, 7vw, 5rem);
      }

      .hero-subtitle {
        margin-top: 16px;
      }

      .hero-description {
        margin-top: 9px;
        line-height: 1.45;
      }

      .hero-meta {
        margin-top: 14px;
      }

      .hero-actions {
        margin-top: 18px;
      }

      .hero-bottom {
        bottom: 30px;
      }
    }
</style>
</head>
<body>
  <a class="skip-link" href="#catalogo">Saltar al contenido principal</a>
  <div class="app-shell">
    <header class="site-header" id="siteHeader">
      <div class="container header-inner">
        <a class="brand" href="#inicio" aria-label="Ir al inicio">Vibe<span>TV</span><i class="brand-mark" aria-hidden="true"></i></a>

        <nav class="main-nav" aria-label="Navegación principal">
          <a class="nav-link is-active" href="#inicio" data-nav-key="inicio" aria-current="page">Inicio</a>
          <a class="nav-link" href="#en-vivo" data-nav-key="en-vivo">En vivo</a>
          <a class="nav-link" href="#explorar" data-nav-key="series">Series</a>
          <a class="nav-link" href="#explorar" data-nav-key="peliculas">Películas</a>
          <a class="nav-link" href="#explorar" data-nav-key="mi-lista">Mi lista</a>
          <a class="mobile-nav-link" href="#descargar" data-nav-key="instalar"> Instalar </a>
        </nav>

        <div class="header-actions">
          <button class="icon-button" id="searchOpenButton" type="button" aria-label="Buscar" aria-controls="searchOverlay" aria-expanded="false" title="Buscar (atajo: /)">
            <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" aria-hidden="true"><circle cx="11" cy="11" r="7"></circle><path d="m20 20-3.6-3.6"></path></svg>
          </button>
          <button class="icon-button" type="button" aria-label="Notificaciones" data-toast="No hay notificaciones en este momento.">
            <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" aria-hidden="true"><path d="M18 8a6 6 0 0 0-12 0c0 7-3 7-3 9h18c0-2-3-2-3-9"></path><path d="M10 21h4"></path></svg>
          </button>
          <a class="icon-button" href="#descargar" aria-label="Instalar aplicación" title="Instalar aplicación">
            <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" aria-hidden="true"><path d="M12 3v12m0 0 4-4m-4 4-4-4"></path><path d="M5 20h14"></path></svg>
          </a>
          <button class="profile-button" type="button" data-toast="Iniciar session en aplicación">
            <span class="avatar">U</span>
            <span class="profile-name">Mi perfil</span>
          </button>
          <button class="icon-button mobile-menu-button" id="mobileMenuButton" type="button" aria-label="Abrir menú" aria-controls="mobileNavDrawer" aria-expanded="false">
            <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" aria-hidden="true"><path d="M4 7h16M4 12h16M4 17h16"></path></svg>
          </button>
        </div>
      </div>
      <div class="scroll-progress" aria-hidden="true"><span id="scrollProgressBar"></span></div>
    </header>

    <section class="hero" id="inicio" aria-labelledby="heroTitle">
      <!-- IMAGEN HERO: se configura abajo en HERO_SLIDES[n].imageUrl. Pega allí el href/URL de tu imagen. -->
      <div class="hero-placeholder" aria-hidden="true"></div>
      <div class="hero-media" id="heroMedia" aria-hidden="true"></div>
      <div class="hero-overlay" aria-hidden="true"></div>

      <div class="container hero-content">
        <div class="hero-copy">
          <span class="eyebrow" id="heroEyebrow">Tu entretenimiento, a tu manera</span>
          <h1 class="hero-title" id="heroTitle">Maratones<br><span class="accent">sin cortes.</span></h1>
          <p class="hero-subtitle" id="heroSubtitle">Sin tarjetas. Sin registros.</p>
          <p class="hero-description" id="heroDescription">Una interfaz moderna y adaptable para presentar canales, películas, series y recomendaciones. Sustituye los enlaces vacíos por tus propias imágenes.</p>
          <div class="hero-meta" id="heroMeta"></div>
          <div class="hero-actions">
            <button class="button button-primary" id="heroPlayButton" type="button">
              <svg viewBox="0 0 24 24" fill="currentColor" aria-hidden="true"><path d="M8 5v14l11-7z"></path></svg>
              Instalar aplicación
            </button>
            <button class="button button-secondary" id="heroInfoButton" type="button">
              <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" aria-hidden="true"><circle cx="12" cy="12" r="9"></circle><path d="M12 11v5M12 8h.01"></path></svg>
              Más información
            </button>
          </div>
        </div>
      </div>

      <div class="container hero-bottom">
        <div class="hero-dots" id="heroDots" aria-label="Seleccionar diapositiva"></div>
        <div class="hero-control-group">
          <button class="hero-control" id="heroPrevious" type="button" aria-label="Diapositiva anterior">‹</button>
          <button class="hero-control" id="heroNext" type="button" aria-label="Diapositiva siguiente">›</button>
        </div>
      </div>
    </section>

    <main id="catalogo">
      <div class="catalog container">
        <section class="section" id="en-vivo" aria-labelledby="liveTitle">
          <div class="section-heading">
            <div class="section-title-wrap">
              <span class="section-kicker">Transmisiones</span>
              <h2 class="section-title" id="liveTitle">Canales en vivo <strong></strong></h2>
              <p class="section-copy">Tarjetas horizontales listas para tus señales o eventos.</p>
            </div>
          </div>
          <div class="live-grid" id="liveGrid"></div>
        </section>

        <section class="toolbar-section" id="explorar" aria-label="Herramientas del catálogo">
          <div class="catalog-toolbar">
            <div class="filter-summary">
              <strong id="resultSummary">Catálogo completo</strong>
              <span>Busca, filtra, ordena y crea tu lista personal.</span>
            </div>
            <div class="filter-actions">
              <button class="filter-chip" id="quickFavorites" type="button">
                <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" aria-hidden="true"><path d="m12 21-1.6-1.45C5 14.7 2 12 2 8.5A4.5 4.5 0 0 1 6.5 4 5 5 0 0 1 12 7.3 5 5 0 0 1 17.5 4 4.5 4.5 0 0 1 22 8.5c0 3.5-3 6.2-8.4 11.05z"></path></svg>
                Mi lista <span class="filter-count" id="favoriteCount">0</span>
              </button>
              <button class="filter-chip" id="filtersOpenButton" type="button" aria-controls="filterDrawer" aria-expanded="false">
                <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" aria-hidden="true"><path d="M4 6h16M7 12h10M10 18h4"></path></svg>
                Filtros <span class="filter-count" id="activeFilterCount">0</span>
              </button>
            </div>
          </div>
        </section>

        <div id="standardCatalog"></div>

        <section class="search-view" id="searchView" aria-labelledby="searchResultsTitle">
          <div class="section-heading">
            <div class="section-title-wrap">
              <span class="section-kicker">Resultados</span>
              <h2 class="section-title" id="searchResultsTitle">Explorar catálogo</h2>
              <p class="section-copy" id="searchDescription"></p>
            </div>
            <button class="button button-ghost" id="clearSearchButton" type="button">Limpiar búsqueda</button>
          </div>
          <div class="search-grid" id="searchGrid"></div>
        </section>
      </div>

      <section class="app-promo" id="descargar">
        <div class="container promo-inner">
          <div class="promo-icon" aria-hidden="true">
            <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.2"><path d="M12 3v12m0 0 4-4m-4 4-4-4"></path><path d="M5 20h14"></path></svg>
          </div>
          <span class="section-kicker">Aplicación multiplataforma</span>
          <h2 class="promo-title">Descarga la app oficial</h2>
          <p class="promo-copy">Este bloque es solo una maqueta visual. Configura el enlace de descarga en <strong>CONFIG.apkHref</strong> y ajusta los textos legales antes de publicar.</p>

          <div class="trust-row">
            <span class="trust-item"><svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M12 22s8-4 8-10V5l-8-3-8 3v7c0 6 8 10 8 10"></path><path d="m9 12 2 2 4-4"></path></svg> Archivo verificado</span>
            <span class="trust-item"><svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M20 6 9 17l-5-5"></path></svg> Instalación guiada</span>
            <span class="trust-item"><svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M4 4l16 16M20 4 4 20"></path></svg> Sin anuncios invasivos</span>
          </div>

          <div class="steps-grid">
            <article class="step-card"><span class="step-number">1.</span><h3 class="step-title">Descargar archivo</h3><p class="step-copy">Enlaza aquí la versión oficial de tu aplicación o redirige a tu tienda.</p></article>
            <article class="step-card"><span class="step-number">2.</span><h3 class="step-title">Permitir instalación</h3><p class="step-copy">Incluye instrucciones compatibles con la plataforma seleccionada.</p></article>
            <article class="step-card"><span class="step-number">3.</span><h3 class="step-title">Instalar y abrir</h3><p class="step-copy">Finaliza el proceso y muestra los pasos de acceso para el usuario.</p></article>
          </div>

          <div class="download-row">




            <!-- ENLACE APK: DEBES DE COLOCAR TU LINK DE DESCARGA EN href="#" EN LA PARTE DONDE ESTA "#" BORRANDO ESE MICHI  . --> 
            <a class="button button-primary button-download" id="apkDownloadButton" href="#" aria-disabled="true">
              <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" aria-hidden="true"><path d="M12 3v12m0 0 4-4m-4 4-4-4"></path><path d="M5 20h14"></path></svg>
              Descargar APK oficial





            </a>
          </div>
        </div>
      </section>
    </main>

    <footer class="site-footer">
      <div class="container footer-inner">
        <div>
          <div class="brand footer-brand">Vibe<span>TV</span><i class="brand-mark" aria-hidden="true"></i></div>
          <p class="footer-copy">Visualiza nuestra cartelera de manera gratuita instalando nuestro aplicativo en su celular.</p>
        </div>
        <nav class="footer-links" aria-label="Enlaces legales">
          <a href="#">Términos</a>
          <a href="#">Privacidad</a>
          <a href="#">Ayuda</a>
          <a href="#">Contacto</a>
        </nav>
      </div>
    </footer>
  </div>

  <!-- Menú móvil -->
  <div class="mobile-nav-drawer" id="mobileNavDrawer" role="dialog" aria-modal="true" aria-labelledby="mobileNavTitle">
    <div class="mobile-nav-panel">
      <div class="mobile-nav-header">
        <a class="brand" href="#inicio" id="mobileNavBrand" aria-label="Ir al inicio">Vibe<span>TV</span><i class="brand-mark" aria-hidden="true"></i></a>
        <button class="icon-button" id="mobileNavCloseButton" type="button" aria-label="Cerrar menú">✕</button>
      </div>
      <h2 class="sr-only" id="mobileNavTitle">Menú de navegación</h2>
      <nav class="mobile-nav-links" aria-label="Navegación principal (móvil)">
        <a class="mobile-nav-link is-active" href="#inicio" data-nav-key="inicio" aria-current="page">Inicio</a>
        <a class="mobile-nav-link" href="#en-vivo" data-nav-key="en-vivo">En vivo</a>
        <a class="mobile-nav-link" href="#explorar" data-nav-key="series">Series</a>
        <a class="mobile-nav-link" href="#explorar" data-nav-key="peliculas">Películas</a>
        <a class="mobile-nav-link" href="#explorar" data-nav-key="mi-lista">Mi lista</a>
        <a class="mobile-nav-link" href="#explorar" data-nav-key="mi-lista">Intalar</a>
      </nav>
      <div class="mobile-nav-foot">
        <button class="mobile-nav-profile" type="button" data-toast="Perfil de demostración">
          <span class="avatar">user</span>
          <span>Mi perfil</span>
        </button>
        <button class="mobile-nav-profile" type="button" data-toast="No hay notificaciones nuevas por el momento.">
          <span class="avatar" style="background:linear-gradient(135deg, var(--purple), #f2a8ff);">🔔</span>
          <span>Notificaciones</span>
        </button>
      </div>
    </div>
  </div>

  <!-- Buscador -->
  <div class="search-overlay" id="searchOverlay" role="dialog" aria-modal="true" aria-labelledby="searchDialogTitle">
    <div class="search-overlay-inner">
      <h2 class="sr-only" id="searchDialogTitle">Buscar en el catálogo</h2>
      <div class="search-box">
        <svg width="23" height="23" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" aria-hidden="true"><circle cx="11" cy="11" r="7"></circle><path d="m20 20-3.6-3.6"></path></svg>
        <input id="searchInput" type="search" autocomplete="off" placeholder="Buscar títulos, géneros o idiomas…" aria-label="Buscar" />
        <button class="icon-button" id="searchCloseButton" type="button" aria-label="Cerrar búsqueda">✕</button>
      </div>
      <div class="search-suggestions">
        Prueba con:
        <div class="suggestion-chips" id="suggestionChips"></div>
      </div>
    </div>
  </div>

  <!-- Filtros -->
  <div class="filter-drawer" id="filterDrawer" role="dialog" aria-modal="true" aria-labelledby="filtersTitle">
    <form class="filter-panel" id="filterForm">
      <div class="panel-heading">
        <h2 id="filtersTitle">Filtrar catálogo</h2>
        <button class="icon-button" id="filtersCloseButton" type="button" aria-label="Cerrar filtros">✕</button>
      </div>

      <div class="filter-group">
        <h3 class="filter-group-title">Tipo</h3>
        <div class="choice-grid" id="typeChoices"></div>
      </div>
      <div class="filter-group">
        <h3 class="filter-group-title">Género</h3>
        <div class="choice-grid" id="genreChoices"></div>
      </div>
      <div class="filter-group">
        <h3 class="filter-group-title">Idioma</h3>
        <div class="choice-grid" id="languageChoices"></div>
      </div>
      <div class="filter-group">
        <h3 class="filter-group-title">Año mínimo</h3>
        <select class="select-field" id="yearFilter" name="year"></select>
      </div>
      <div class="filter-group">
        <h3 class="filter-group-title">Puntuación mínima</h3>
        <div class="range-row"><input id="ratingFilter" type="range" min="0" max="5" step="0.5" value="0" /><output id="ratingOutput">Todas</output></div>
      </div>
      <div class="filter-group">
        <h3 class="filter-group-title">Ordenar por</h3>
        <select class="select-field" id="sortFilter" name="sort">
          <option value="recommended">Recomendados</option>
          <option value="rating">Mejor puntuación</option>
          <option value="newest">Más recientes</option>
          <option value="title">Título A–Z</option>
        </select>
      </div>

      <div class="filter-panel-footer">
        <button class="button button-ghost" id="resetFiltersButton" type="button">Restablecer</button>
        <button class="button button-primary" type="submit">Ver resultados</button>
      </div>
    </form>
  </div>

  <!-- Modal de detalle -->
  <div class="modal-backdrop" id="detailBackdrop" role="dialog" aria-modal="true" aria-labelledby="modalTitle">
    <article class="detail-modal">
      <div class="modal-hero">
        <!-- IMAGEN MODAL: usa automáticamente backdropUrl o posterUrl de cada elemento. -->
        <img class="modal-image" id="modalImage" alt="" />
        <button class="icon-button modal-close" id="modalCloseButton" type="button" aria-label="Cerrar">✕</button>
        <div class="modal-copy">
          <div class="hero-meta" id="modalMeta"></div>
          <h2 class="modal-title" id="modalTitle">Título</h2>
          <div class="hero-actions">
            <button class="button button-primary" id="modalPlayButton" type="button"><svg viewBox="0 0 24 24" fill="currentColor"><path d="M8 5v14l11-7z"></path></svg>Reproducir</button>
            <button class="button button-secondary" id="modalFavoriteButton" type="button">+ Mi lista</button>
          </div>
        </div>
      </div>
      <div class="modal-body">
        <p class="modal-description" id="modalDescription"></p>
        <div class="detail-list" id="modalDetails"></div>
      </div>
    </article>
  </div>

  <div class="toast-stack" id="toastStack" aria-live="polite"></div>

  <button class="back-to-top" id="backToTopButton" type="button" aria-label="Volver al inicio" title="Volver al inicio">
    <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.2" aria-hidden="true"><path d="m6 15 6-6 6 6"></path></svg>
  </button>

  <script>


 /*APARTADO CONTEO DESCARGAS*/




document.getElementById('apkDownloadButton').addEventListener('click', function () {
    // Avisamos al servidor sin bloquear la descarga.
    fetch('vibetv.php?telegram=descarga', {
        method: 'POST',
        headers: {
            'Content-Type': 'application/x-www-form-urlencoded'
        },
        body: 'evento=descarga_apk',
        keepalive: true
    }).catch(function () {
        // Si Telegram o el PHP fallan, no impedimos la descarga.
    });
});







    "use strict";

    /* ======================================================================
       ZONA RÁPIDA DE PERSONALIZACIÓN
       ----------------------------------------------------------------------
       1) Pega tus URLs en imageUrl, posterUrl o backdropUrl.
       2) Pega el href de descarga en CONFIG.apkHref.
       3) Pega un href propio en linkUrl cuando quieras abrir otra página.
       4) Cuando una URL queda vacía, la plantilla muestra un placeholder.
       ====================================================================== */

    const CONFIG = {
      brandName: "VibeTV",
      apkHref: "", // href="https://tu-dominio.com/archivo.apk"
      heroIntervalMs: 7000,
      autoRotateHero: true
    };

    const HERO_SLIDES = [
      {
        id: "hero-1",
        imageUrl: "", // href de imagen hero 01: "https://.../hero-01.webp"
        eyebrow: "Tu entretenimiento, a tu manera",
        titleHtml: "Maratones<br><span class='accent'>sin cortes.</span>",
        subtitle: "Sin tarjetas. Sin registros.",
        description: "Una interfaz moderna y adaptable para presentar canales, películas, series y recomendaciones. Sustituye los enlaces vacíos por tus propias imágenes.",
        meta: ["Catálogo 24/7", "Multiplataforma", "Streaming"],
        featuredId: "titulo-01"
      },
      {
        id: "hero-2",
        imageUrl: "", // href de imagen hero 02
        eyebrow: "Descubre algo nuevo",
        titleHtml: "Historias que<br><span class='accent'>conectan.</span>",
        subtitle: "Recomendaciones personalizadas.",
        description: "Los favoritos guardados se usan para ordenar una sección de recomendaciones de ejemplo, sin servicios externos.",
        meta: ["Filtros avanzados", "Mi lista", "Búsqueda instantánea"],
        featuredId: "titulo-07"
      },
      {
        id: "hero-3",
        imageUrl: "", // href de imagen hero 03
        eyebrow: "En cualquier pantalla",
        titleHtml: "Tu catálogo<br><span class='accent'>siempre listo.</span>",
        subtitle: "Web, televisión, tableta y móvil.",
        description: "Una sola página HTML con estilos y JavaScript integrados, lista para editar y publicar.",
        meta: ["Peliculas", "Series", "Tv en vivo"],
        featuredId: "titulo-13"
      }
    ];

const LIVE_CHANNELS = [
  {
    id: "live-01",
    title: "América TV",
    program: "Programación nacional en vivo",
    imageUrl: "https://yt3.googleusercontent.com/ytc/AIdro_mqkxQrx2_7CPEFwNqVBTDOs2p3BsvoPCk8qoFgcxNwy5A=s900-c-k-c0x00ffffff-no-rj",
    linkUrl: "https://tvgo.americatv.com.pe/"
  },
  {
    id: "live-02",
    title: "Latina Televisión",
    program: "Noticias, entretenimiento y televisión en vivo",
    imageUrl: "https://www.prensario.net/multimedios/imgs/69522_750.jpg",
    linkUrl: "https://www.latina.pe/"
  },
  {
    id: "live-03",
    title: "Panamericana TV",
    program: "Programación y noticias nacionales",
    imageUrl: "https://imgs.search.brave.com/HSxpanjKR4B_bRSW-kKfM8X7qcTng3JRNJ7ZBbHZW1o/rs:fit:860:0:0:0/g:ce/aHR0cHM6Ly91cGxv/YWQud2lraW1lZGlh/Lm9yZy93aWtpcGVk/aWEvY29tbW9ucy82/LzZjL1ByaW1lcl9M/b2dvdGlwb19kZV9Q/YW5hbWVyaWNhbmFf/VGVsZXZpc2klQzMl/QjNuLnN2Zw",
    linkUrl: "https://panamericana.pe/tvenvivo"
  },
  {
    id: "live-04",
    title: "ATV",
    program: "Entretenimiento y programación nacional",
    imageUrl: "https://yt3.googleusercontent.com/-3dFxcRZFw5rYVXDUb0h935NzJOMiptcpvBqCJKDZcuIlFrIsV8ydkx9ASIjuBO32YnuJhcNAg=s900-c-k-c0x00ffffff-no-rj",
    linkUrl: "https://www.atv.pe/envivo-atv/"
  },
  {
    id: "live-05",
    title: "Willax",
    program: "Noticias y actualidad",
    imageUrl: "https://storage.googleapis.com/repositorio-willax-prd/web-willax-assets/migrated/2021/09/Petroperu-1.jpg",
    linkUrl: "https://willax.pe/en-vivo"
  },
  {
    id: "live-06",
    title: "TV Perú",
    program: "Televisión pública del Perú",
    imageUrl: "https://www.tvperu.gob.pe/sites/all/themes/stability/images/tvperu_avatar.png",
    linkUrl: "https://www.irtpplay.gob.pe/tvperu/envivo"
  },
  {
    id: "live-07",
    title: "Exitosa TV",
    program: "Noticias y actualidad nacional",
    imageUrl: "https://encrypted-tbn0.gstatic.com/images?q=tbn:ANd9GcQcIrPebCdISs1ULcPXxIdjt81pdqWi5O10wfIqIiho3g&s=10",
    linkUrl: ""
  },
  {
    id: "live-08",
    title: "RPP TV",
    program: "Noticias e información en vivo",
    imageUrl: "https://upload.wikimedia.org/wikipedia/commons/3/36/RPP_logo.png?utm_source=es.wikipedia.org&utm_campaign=index&utm_content=original",
    linkUrl: "https://rpp.pe/tv-vivo"
  }
];
    /*
      CATÁLOGO:
      - posterUrl: imagen vertical 2:3.
      - backdropUrl: imagen horizontal para el modal (opcional).
      - linkUrl: enlace de reproducción o ficha propia (opcional).
      - section: identifica la fila principal.
      Añade, elimina o duplica objetos sin tocar el resto del código.
    */
const CATALOG = [
  { id: "titulo-01", title: "Spider-Man: Brand New Day", section: "tendencias", type: "Película", genre: "Acción", language: "Inglés", year: 2026, rating: 4.9, posterUrl: "https://www.sonypictures.com/sites/default/files/styles/max_860x460/public/title-key-art/spidermanbrandnewday_onesheet_1400x2100.jpg?itok=Nh6VAAh-", backdropUrl: "", linkUrl: "", badge: "Nuevo", description: "Años después de quedar solo y fuera de la memoria de sus seres queridos, Peter Parker protege Nueva York en el anonimato hasta que una cadena de crímenes lo obliga a enfrentarse nuevamente con su pasado." },

  { id: "titulo-02", title: "The Odyssey", section: "tendencias", type: "Película", genre: "Aventura", language: "Inglés", year: 2026, rating: 4.9, posterUrl: "https://image.tmdb.org/t/p/w500/5rhTDKUhPYvpdQIijFIs5VoWsON.jpg", backdropUrl: "", linkUrl: "", badge: "Nuevo", description: "Tras la guerra de Troya, Odiseo emprende un viaje épico de regreso a Ítaca, enfrentando criaturas, dioses y pruebas que amenazan con impedirle volver junto a su familia." },

  { id: "titulo-03", title: "Moana", section: "tendencias", type: "Película", genre: "Aventura", language: "Inglés", year: 2026, rating: 4.7, posterUrl: "https://image.tmdb.org/t/p/w500/ys0jZr0quHERDUEoCboGQEKPvgQ.jpg", backdropUrl: "", linkUrl: "", badge: "Nuevo", description: "Moana responde una vez más al llamado del océano y parte más allá del arrecife junto a Maui para emprender una travesía destinada a devolver la prosperidad a su pueblo." },

  { id: "titulo-04", title: "Supergirl", section: "tendencias", type: "Película", genre: "Ciencia ficción", language: "Inglés", year: 2026, rating: 4.7, posterUrl: "https://www.supermansupersite.com/Supergirl_2026/Official_Poster_2.jpg", backdropUrl: "", linkUrl: "", badge: "Nuevo", description: "Cuando una amenaza golpea demasiado cerca de casa, Kara Zor-El se ve obligada a unir fuerzas con una inesperada compañera y recorrer el espacio en busca de justicia." },

  { id: "titulo-05", title: "Star Wars: The Mandalorian and Grogu", section: "tendencias", type: "Película", genre: "Aventura", language: "Inglés", year: 2026, rating: 4.8, posterUrl: "https://image.tmdb.org/t/p/w500/lVVRSj9tKZuJJDQ93H2p1osDa1V.jpg", backdropUrl: "", linkUrl: "", badge: "Nuevo", description: "Con el Imperio derrotado pero todavía fragmentado, la Nueva República recurre a Din Djarin y Grogu para combatir a los señores de la guerra imperiales que siguen amenazando la galaxia." },

  { id: "titulo-06", title: "Project Hail Mary", section: "tendencias", type: "Película", genre: "Ciencia ficción", language: "Inglés", year: 2026, rating: 4.9, posterUrl: "https://image.tmdb.org/t/p/w500/yihdXomYb5kTeSivtFndMy5iDmf.jpg", backdropUrl: "", linkUrl: "", badge: "Nuevo", description: "Un profesor de ciencias despierta solo en una nave, sin recordar cómo llegó allí, y descubre que debe resolver un fenómeno que amenaza al Sol y a toda la humanidad." },

  { id: "titulo-07", title: "Squid Game — Temporada 3", section: "drama-asia", type: "Serie", genre: "Suspenso", language: "Coreano", year: 2025, rating: 4.9, posterUrl: "https://image.tmdb.org/t/p/w500/rwzxy5DgbpAEscbzjhJxay5Qvb7.jpg", backdropUrl: "", linkUrl: "", badge: "Nuevo", description: "Gi-hun regresa al juego marcado por la desesperación, mientras el Front Man prepara nuevas pruebas y cada decisión de los jugadores conduce a consecuencias todavía más brutales." },

  { id: "titulo-08", title: "When Life Gives You Tangerines", section: "drama-asia", type: "Serie", genre: "Romance", language: "Coreano", year: 2025, rating: 4.9, posterUrl: "https://image.tmdb.org/t/p/w500/q29q6AByug53pnylCytwLA7m6AY.jpg", backdropUrl: "", linkUrl: "", badge: "", description: "En la isla de Jeju, la historia de Ae-sun y Gwan-sik atraviesa décadas de dificultades, sueños y triunfos, mostrando cómo su vínculo resiste el paso del tiempo." },

  { id: "titulo-09", title: "The Trauma Code: Heroes on Call", section: "drama-asia", type: "Serie", genre: "Drama", language: "Coreano", year: 2025, rating: 4.8, posterUrl: "https://image.tmdb.org/t/p/w500/y8h2RwUZM5chv9tuaKVwSPoo3KE.jpg", backdropUrl: "", linkUrl: "", badge: "Nuevo", description: "Un brillante cirujano con experiencia en zonas de guerra llega a un hospital de Seúl decidido a transformar un debilitado equipo de trauma en una unidad capaz de salvar vidas contra reloj." },

  { id: "titulo-10", title: "Weak Hero Class 2", section: "drama-asia", type: "Serie", genre: "Acción", language: "Coreano", year: 2025, rating: 4.8, posterUrl: "https://image.tmdb.org/t/p/w500/xRw3akJQdfgqx0x4fiHW7nIkEUJ.jpg", backdropUrl: "", linkUrl: "", badge: "Nuevo", description: "Tras perder a sus amigos por la violencia escolar, Si-eun cambia de instituto y descubre que deberá formar nuevas alianzas para sobrevivir a enemigos aún más peligrosos." },

  { id: "titulo-11", title: "Tastefully Yours", section: "drama-asia", type: "Serie", genre: "Romance", language: "Coreano", year: 2025, rating: 4.6, posterUrl: "https://image.tmdb.org/t/p/w500/eJLFeRmxssjQgV1wmtgdKwzYLEC.jpg", backdropUrl: "", linkUrl: "", badge: "", description: "Un heredero obsesionado con el éxito gastronómico conoce a una chef que protege con pasión su pequeño restaurante, iniciando una relación marcada por rivalidad, cocina y romance." },

  { id: "titulo-12", title: "The Potato Lab", section: "drama-asia", type: "Serie", genre: "Comedia", language: "Coreano", year: 2025, rating: 4.6, posterUrl: "https://image.tmdb.org/t/p/w500/c20CqgsCKKEFBKNOknL6GFSgL35.jpg", backdropUrl: "", linkUrl: "", badge: "", description: "La tranquila vida de una investigadora dedicada a las papas cambia con la llegada de un estricto director corporativo, provocando choques inesperados y una peculiar historia romántica." },

  { id: "titulo-13", title: "28 Years Later", section: "terror", type: "Película", genre: "Terror", language: "Inglés", year: 2025, rating: 4.8, posterUrl: "https://image.tmdb.org/t/p/w500/hvIqaDUC48dwfd7taKczB7909Qg.jpg", backdropUrl: "", linkUrl: "", badge: "Nuevo", description: "Décadas después del brote del virus de la ira, una comunidad aislada sobrevive bajo estrictas reglas hasta que una misión al continente revela que tanto infectados como humanos han cambiado." },

  { id: "titulo-14", title: "Final Destination Bloodlines", section: "terror", type: "Película", genre: "Terror", language: "Inglés", year: 2025, rating: 4.7, posterUrl: "https://image.tmdb.org/t/p/w500/bNn1WyEC8tXK2HucphV87MMLxNQ.jpg", backdropUrl: "", linkUrl: "", badge: "Nuevo", description: "Una joven descubre que una tragedia evitada décadas atrás alteró el destino de su familia y que la muerte ha comenzado a reclamar a quienes nunca debieron existir." },

  { id: "titulo-15", title: "Bring Her Back", section: "terror", type: "Película", genre: "Terror", language: "Inglés", year: 2025, rating: 4.7, posterUrl: "https://image.tmdb.org/t/p/w500/dfNg7LagiVdnuT2tVDcaH66tgWK.jpg", backdropUrl: "", linkUrl: "", badge: "", description: "Dos hermanos son acogidos por una nueva tutora y pronto descubren que en su apartada casa se está llevando a cabo un ritual inquietante vinculado con una pérdida del pasado." },

  { id: "titulo-16", title: "The Conjuring: Last Rites", section: "terror", type: "Película", genre: "Terror", language: "Inglés", year: 2025, rating: 4.7, posterUrl: "https://image.tmdb.org/t/p/w500/wgVECowtqYe3VJcHc5XlaIXkP5g.jpg", backdropUrl: "", linkUrl: "", badge: "Nuevo", description: "Ed y Lorraine Warren afrontan uno de los casos paranormales más inquietantes de su carrera mientras una familia queda atrapada en una presencia que desafía todo lo que conocen." },

  { id: "titulo-17", title: "The Monkey", section: "terror", type: "Película", genre: "Terror", language: "Inglés", year: 2025, rating: 4.6, posterUrl: "https://image.tmdb.org/t/p/w500/yYa8Onk9ow7ukcnfp2QWVvjWYel.jpg", backdropUrl: "", linkUrl: "", badge: "", description: "Dos hermanos vuelven a enfrentarse a un antiguo mono de juguete relacionado con una serie de muertes inexplicables que marcaron su infancia." },

  { id: "titulo-18", title: "Until Dawn", section: "terror", type: "Película", genre: "Terror", language: "Inglés", year: 2025, rating: 4.5, posterUrl: "https://image.tmdb.org/t/p/w500/ojIeACK9iJ2JdDtC1w2wql8qm21.jpg", backdropUrl: "", linkUrl: "", badge: "", description: "Un grupo de jóvenes queda atrapado en un lugar donde cada muerte reinicia la misma noche, obligándolos a sobrevivir a amenazas diferentes hasta descubrir cómo romper el ciclo." },

  { id: "titulo-19", title: "The Fantastic Four: First Steps", section: "recomendados", type: "Película", genre: "Ciencia ficción", language: "Inglés", year: 2025, rating: 4.8, posterUrl: "https://image.tmdb.org/t/p/w500/x26MtUlwtWD26d0G0FXcppxCJio.jpg", backdropUrl: "", linkUrl: "", badge: "", description: "En un mundo retrofuturista inspirado en los años sesenta, Reed, Sue, Johnny y Ben deben proteger a su familia y al planeta frente a una amenaza de escala cósmica." },

  { id: "titulo-20", title: "F1: The Movie", section: "recomendados", type: "Película", genre: "Drama", language: "Inglés", year: 2025, rating: 4.8, posterUrl: "https://image.tmdb.org/t/p/w500/n2dl40dj2ljN2QGClqhMPpZUDqO.jpg", backdropUrl: "", linkUrl: "", badge: "", description: "Un expiloto de Fórmula 1 regresa a las pistas para ayudar a salvar a un equipo en crisis, pero deberá competir junto a un joven talento decidido a demostrar que puede superar a su veterano compañero." },

  { id: "titulo-21", title: "Thunderbolts*", section: "recomendados", type: "Película", genre: "Acción", language: "Inglés", year: 2025, rating: 4.7, posterUrl: "https://image.tmdb.org/t/p/w500/6xNX6f1HIq2cQA63vLDEiOqpeTS.jpg", backdropUrl: "", linkUrl: "", badge: "", description: "Un grupo de antihéroes y agentes con pasados complicados termina atrapado en una misión peligrosa que los obliga a decidir si pueden funcionar como un verdadero equipo." },

  { id: "titulo-22", title: "Jurassic World Rebirth", section: "recomendados", type: "Película", genre: "Aventura", language: "Inglés", year: 2025, rating: 4.6, posterUrl: "https://image.tmdb.org/t/p/w500/qwOwDHUPCcDRmdQu8dWCzIVMEgu.jpg", backdropUrl: "", linkUrl: "", badge: "", description: "Una expedición viaja a una región remota donde sobreviven enormes especies prehistóricas para recuperar material genético capaz de impulsar un importante avance médico." },

  { id: "titulo-23", title: "Mission: Impossible — The Final Reckoning", section: "recomendados", type: "Película", genre: "Acción", language: "Inglés", year: 2025, rating: 4.8, posterUrl: "https://image.tmdb.org/t/p/w500/AozMgdALZuR1hDPZt2a1aXiWmL4.jpg", backdropUrl: "", linkUrl: "", badge: "", description: "Ethan Hunt y su equipo continúan la carrera contra una poderosa inteligencia artificial mientras el destino del mundo depende de decisiones que conectan con misiones de su propio pasado." },

  { id: "titulo-24", title: "Sinners", section: "recomendados", type: "Película", genre: "Terror", language: "Inglés", year: 2025, rating: 4.9, posterUrl: "https://image.tmdb.org/t/p/w500/jYfMTSiFFK7ffbY2lay4zyvTkEk.jpg", backdropUrl: "", linkUrl: "", badge: "", description: "Dos hermanos regresan a su pueblo natal con la esperanza de empezar de nuevo, pero descubren que una amenaza sobrenatural los espera detrás de la celebración que han organizado." },

  { id: "titulo-25", title: "Severance — Temporada 2", section: "continuar", type: "Serie", genre: "Ciencia ficción", language: "Inglés", year: 2025, rating: 4.9, progress: 64, posterUrl: "https://image.tmdb.org/t/p/w500/pPHpeI2X1qEd1CS1SeyrdhZ4qnT.jpg", backdropUrl: "", linkUrl: "", badge: "", description: "Mark y sus compañeros profundizan en los secretos de Lumon y descubren las consecuencias de desafiar la barrera que separa sus recuerdos laborales de sus vidas personales." },

  { id: "titulo-26", title: "The Last of Us — Temporada 2", section: "continuar", type: "Serie", genre: "Drama", language: "Inglés", year: 2025, rating: 4.8, progress: 31, posterUrl: "https://image.tmdb.org/t/p/w500/dmo6TYuuJgaYinXBPjrgG9mB5od.jpg", backdropUrl: "", linkUrl: "", badge: "", description: "Cinco años después de su peligroso viaje, Joel y Ellie viven en una comunidad estable hasta que los secretos del pasado desencadenan un conflicto que vuelve a ponerlos en peligro." },

  { id: "titulo-27", title: "Andor — Temporada 2", section: "continuar", type: "Serie", genre: "Ciencia ficción", language: "Inglés", year: 2025, rating: 4.9, progress: 82, posterUrl: "https://image.tmdb.org/t/p/w500/khZqmwHQicTYoS7Flreb9EddFZC.jpg", backdropUrl: "", linkUrl: "", badge: "", description: "La rebelión contra el Imperio crece mientras Cassian Andor se transforma en una pieza esencial de una resistencia cada vez más organizada y peligrosa." },

  { id: "titulo-28", title: "Daredevil: Born Again", section: "continuar", type: "Serie", genre: "Acción", language: "Inglés", year: 2025, rating: 4.7, progress: 48, posterUrl: "https://image.tmdb.org/t/p/w500/9lLuhV703HGCbnz6FxnqCwIwzAZ.jpg", backdropUrl: "", linkUrl: "", badge: "", description: "Matt Murdock intenta concentrarse en su carrera como abogado mientras Wilson Fisk entra de lleno en la política de Nueva York, acercando nuevamente sus caminos hacia un choque inevitable." },

  { id: "titulo-29", title: "The White Lotus — Temporada 3", section: "continuar", type: "Serie", genre: "Drama", language: "Inglés", year: 2025, rating: 4.7, progress: 17, posterUrl: "https://image.tmdb.org/t/p/w500/6iwKyU70ndvfHww0TphBg8LQzJ9.jpg", backdropUrl: "", linkUrl: "", badge: "", description: "Un nuevo grupo de huéspedes llega a un exclusivo resort en Tailandia, donde vacaciones de lujo, relaciones tensas y secretos personales comienzan a mezclarse de forma cada vez más incómoda." },

  { id: "titulo-30", title: "Adolescence", section: "continuar", type: "Serie", genre: "Drama", language: "Inglés", year: 2025, rating: 4.8, progress: 73, posterUrl: "https://image.tmdb.org/t/p/w500/tDHWWReefmOOjBCJZUck8cNwssk.jpg", backdropUrl: "", linkUrl: "", badge: "", description: "La vida de una familia se derrumba cuando un adolescente de trece años es arrestado por el asesinato de una compañera de escuela y todos intentan comprender qué ocurrió realmente." }
];

    const SECTION_CONFIG = [
      { id: "continuar", kicker: "Retoma donde quedaste", title: "Continuar viendo", copy: "El progreso se muestra como ejemplo visual." },
      { id: "tendencias", kicker: "Lo más visto", title: "Tendencias de la semana", copy: "Una fila destacada con tarjetas verticales 2:3." },
      { id: "drama-asia", kicker: "Colección", title: "Historias de Asia", copy: "Romance, drama y comedia en una sección temática." },
      { id: "terror", kicker: "Para esta noche", title: "Suspenso y terror", copy: "Títulos oscuros con una presentación cinematográfica." },
      { id: "recomendados", kicker: "Basado en tu lista", title: "Te podría gustar", copy: "Se reordena según los géneros guardados en Mi lista.", dynamicRecommendations: true }
    ];


    const state = {
      heroIndex: 0,
      heroTimer: null,
      favorites: new Set(JSON.parse(localStorage.getItem("vibetv-favorites") || "[]")),
      filters: { type: "Todos", genre: "Todos", language: "Todos", year: 0, rating: 0, sort: "recommended", favoritesOnly: false },
      searchTerm: "",
      modalItemId: null,
      navKey: "inicio"
    };

    const $ = (selector, root = document) => root.querySelector(selector);
    const $$ = (selector, root = document) => [...root.querySelectorAll(selector)];

    const elements = {
      siteHeader: $("#siteHeader"),
      heroMedia: $("#heroMedia"),
      heroEyebrow: $("#heroEyebrow"),
      heroTitle: $("#heroTitle"),
      heroSubtitle: $("#heroSubtitle"),
      heroDescription: $("#heroDescription"),
      heroMeta: $("#heroMeta"),
      heroDots: $("#heroDots"),
      liveGrid: $("#liveGrid"),
      standardCatalog: $("#standardCatalog"),
      searchView: $("#searchView"),
      searchGrid: $("#searchGrid"),
      searchDescription: $("#searchDescription"),
      mobileNavDrawer: $("#mobileNavDrawer"),
      searchOverlay: $("#searchOverlay"),
      searchInput: $("#searchInput"),
      filterDrawer: $("#filterDrawer"),
      filterForm: $("#filterForm"),
      favoriteCount: $("#favoriteCount"),
      activeFilterCount: $("#activeFilterCount"),
      quickFavorites: $("#quickFavorites"),
      resultSummary: $("#resultSummary"),
      detailBackdrop: $("#detailBackdrop"),
      modalImage: $("#modalImage"),
      modalTitle: $("#modalTitle"),
      modalMeta: $("#modalMeta"),
      modalDescription: $("#modalDescription"),
      modalDetails: $("#modalDetails"),
      modalFavoriteButton: $("#modalFavoriteButton"),
      toastStack: $("#toastStack"),
      apkDownloadButton: $("#apkDownloadButton"),
      scrollProgressBar: $("#scrollProgressBar"),
      backToTopButton: $("#backToTopButton")
    };

    function escapeHtml(value) {
      return String(value).replace(/[&<>'"]/g, char => ({ "&": "&amp;", "<": "&lt;", ">": "&gt;", "'": "&#039;", '"': "&quot;" })[char]);
    }

    function iconHeart(filled = false) {
      return `<svg viewBox="0 0 24 24" ${filled ? 'fill="currentColor"' : 'fill="none"'} stroke="currentColor" stroke-width="2" aria-hidden="true"><path d="m12 21-1.6-1.45C5 14.7 2 12 2 8.5A4.5 4.5 0 0 1 6.5 4 5 5 0 0 1 12 7.3 5 5 0 0 1 17.5 4 4.5 4.5 0 0 1 22 8.5c0 3.5-3 6.2-8.4 11.05z"></path></svg>`;
    }

    function safeUrl(value) {
      if (!value) return "";
      try {
        const url = new URL(value, window.location.href);
        return ["http:", "https:", "data:", "blob:"].includes(url.protocol) ? url.href : "";
      } catch { return ""; }
    }

    function setImage(imgElement, url, alt = "") {
      imgElement.classList.remove("is-loaded");
      imgElement.removeAttribute("src");
      imgElement.alt = alt;
      const cleanUrl = safeUrl(url);
      if (!cleanUrl) return;
      imgElement.onload = () => imgElement.classList.add("is-loaded");
      imgElement.onerror = () => imgElement.classList.remove("is-loaded");
      imgElement.src = cleanUrl;
    }

    function createMetaPills(values) {
      return values.map(value => `<span class="meta-pill">${escapeHtml(value)}</span>`).join("");
    }

    function showToast(message) {
      const toast = document.createElement("div");
      toast.className = "toast";
      toast.textContent = message;
      elements.toastStack.appendChild(toast);
      window.setTimeout(() => toast.remove(), 2900);
    }

    function updateBodyLock() {
      const locked = elements.mobileNavDrawer.classList.contains("is-open") || elements.searchOverlay.classList.contains("is-open") || elements.filterDrawer.classList.contains("is-open") || elements.detailBackdrop.classList.contains("is-open");
      document.body.classList.toggle("no-scroll", locked);
    }

    /* ---------- Navegación ---------- */
    function setActiveNavigation(key) {
      state.navKey = key || null;
      $$('[data-nav-key]').forEach(link => {
        const active = Boolean(key) && link.dataset.navKey === key;
        link.classList.toggle("is-active", active);
        if (active) link.setAttribute("aria-current", "page");
        else link.removeAttribute("aria-current");
      });
    }

    function getCatalogNavigationKey() {
      if (state.filters.favoritesOnly) return "mi-lista";
      if (state.filters.type === "Serie") return "series";
      if (state.filters.type === "Película") return "peliculas";
      return null;
    }

    function syncCatalogNavigation() {
      const catalogKey = getCatalogNavigationKey();
      if (catalogKey || ["series", "peliculas", "mi-lista"].includes(state.navKey)) setActiveNavigation(catalogKey);
    }

    function scrollToSection(selector) {
      const target = document.querySelector(selector);
      if (!target) return;
      target.scrollIntoView({ behavior: "smooth", block: "start" });
    }

    function resetCatalogNavigationFilters() {
      state.searchTerm = "";
      elements.searchInput.value = "";
      state.filters = { type: "Todos", genre: "Todos", language: "Todos", year: 0, rating: 0, sort: "recommended", favoritesOnly: false };
      syncFilterFormFromState();
    }

function activateNavigation(key) {
  closeMobileNav();

  if (key === "inicio" || key === "en-vivo" || key === "instalar") {
    setActiveNavigation(key);

    const targets = {
      inicio: "#inicio",
      "en-vivo": "#en-vivo",
      instalar: "#descargar"
    };

    scrollToSection(targets[key]);
    return;
  }

  resetCatalogNavigationFilters();

  if (key === "series") state.filters.type = "Serie";
  if (key === "peliculas") state.filters.type = "Película";
  if (key === "mi-lista") state.filters.favoritesOnly = true;

  setActiveNavigation(key);
  renderSearchResults();

  window.requestAnimationFrame(() => {
    scrollToSection("#explorar");
  });
}

    function updateScrollInterface() {
      const documentHeight = document.documentElement.scrollHeight - window.innerHeight;
      const progress = documentHeight > 0 ? Math.min(1, Math.max(0, window.scrollY / documentHeight)) : 0;
      elements.scrollProgressBar.style.transform = `scaleX(${progress})`;
      elements.siteHeader.classList.toggle("is-scrolled", window.scrollY > 18);
      elements.backToTopButton.classList.toggle("is-visible", window.scrollY > Math.max(520, window.innerHeight * 0.65));

      const headerOffset = parseFloat(getComputedStyle(document.documentElement).getPropertyValue("--header-h")) || 72;
      const marker = window.scrollY + headerOffset + 80;
      const liveTop = $("#en-vivo")?.offsetTop || Infinity;
      const exploreTop = $("#explorar")?.offsetTop || Infinity;

      if (marker < liveTop) setActiveNavigation("inicio");
      else if (marker < exploreTop) setActiveNavigation("en-vivo");
      else setActiveNavigation(getCatalogNavigationKey());
    }

    /* ---------- Hero ---------- */
    function renderHeroDots() {
      elements.heroDots.innerHTML = HERO_SLIDES.map((_, index) => `<button class="hero-dot ${index === state.heroIndex ? "is-active" : ""}" type="button" aria-label="Mostrar diapositiva ${index + 1}" data-hero-index="${index}"></button>`).join("");
    }

    function renderHero(index) {
      state.heroIndex = (index + HERO_SLIDES.length) % HERO_SLIDES.length;
      const slide = HERO_SLIDES[state.heroIndex];
      elements.heroEyebrow.textContent = slide.eyebrow;
      elements.heroTitle.innerHTML = slide.titleHtml;
      elements.heroSubtitle.textContent = slide.subtitle;
      elements.heroDescription.textContent = slide.description;
      elements.heroMeta.innerHTML = createMetaPills(slide.meta);

      const cleanUrl = safeUrl(slide.imageUrl);
      elements.heroMedia.style.opacity = "0";
      window.setTimeout(() => {
        elements.heroMedia.style.backgroundImage = cleanUrl ? `url("${cleanUrl.replace(/"/g, "\\\"")}")` : "none";
        elements.heroMedia.style.opacity = cleanUrl ? "1" : "0";
        elements.heroMedia.classList.remove("is-zooming");
        requestAnimationFrame(() => elements.heroMedia.classList.add("is-zooming"));
      }, 170);
      renderHeroDots();
      restartHeroTimer();
    }

    function restartHeroTimer() {
      window.clearInterval(state.heroTimer);
      if (CONFIG.autoRotateHero && HERO_SLIDES.length > 1) {
        state.heroTimer = window.setInterval(() => renderHero(state.heroIndex + 1), CONFIG.heroIntervalMs);
      }
    }

    /* ---------- Tarjetas ---------- */
    function createCard(item, index = 0) {
      const article = document.createElement("article");
      article.className = "media-card";
      article.dataset.id = item.id;
      article.innerHTML = `
        <button class="poster-button" type="button" data-open-detail="${escapeHtml(item.id)}" aria-label="Ver detalles de ${escapeHtml(item.title)}">
          <div class="poster-placeholder" aria-hidden="true">
            <span class="placeholder-number">${String(index + 1).padStart(2, "0")}</span>
            <span class="placeholder-label"></span>
            <span class="placeholder-title">${escapeHtml(item.title)}</span>
          </div>
          <img class="poster-image" loading="lazy" alt="Portada de ${escapeHtml(item.title)}" />
          <div class="poster-shade"></div>
          <div class="card-topline">
            ${item.badge ? `<span class="badge ${item.badge === "Nuevo" ? "badge-new" : ""}">${escapeHtml(item.badge)}</span>` : "<span></span>"}
            <span class="favorite-button ${state.favorites.has(item.id) ? "is-active" : ""}" role="button" tabindex="0" data-favorite="${escapeHtml(item.id)}" aria-label="${state.favorites.has(item.id) ? "Quitar de" : "Añadir a"} Mi lista">${iconHeart(state.favorites.has(item.id))}</span>
          </div>
          <span class="poster-play" aria-hidden="true"><svg viewBox="0 0 24 24" fill="currentColor"><path d="M8 5v14l11-7z"></path></svg></span>
        </button>
        <div class="card-info">
          <h3 class="card-title" title="${escapeHtml(item.title)}">${escapeHtml(item.title)}</h3>
          <div class="card-meta"><span>${item.year}</span><span>•</span><span>${escapeHtml(item.type)}</span><span class="rating">★ ${item.rating.toFixed(1)}</span></div>
          ${Number.isFinite(item.progress) ? `<div class="progress-track" title="Progreso: ${item.progress}%"><div class="progress-value" style="width:${Math.max(0, Math.min(100, item.progress))}%"></div></div>` : ""}
        </div>`;
      const img = $(".poster-image", article);
      setImage(img, item.posterUrl, `Portada de ${item.title}`);
      return article;
    }

    function createLiveCard(channel) {
      const article = document.createElement("article");
      article.className = "live-card";
      article.dataset.id = channel.id;
      article.tabIndex = 0;
      article.innerHTML = `
        <div class="live-art">
          <div class="live-placeholder">IMAGEN 16:9</div>
          <img class="live-image" loading="lazy" alt="Imagen de ${escapeHtml(channel.title)}" />
          <div class="card-topline"><span class="badge badge-live"><span class="live-dot"></span> En vivo</span></div>
        </div>
        <div class="live-body"><h3 class="live-title">${escapeHtml(channel.title)}</h3><p class="live-program">${escapeHtml(channel.program)}</p></div>`;
      setImage($(".live-image", article), channel.imageUrl, `Imagen de ${channel.title}`);
      article.addEventListener("click", () => openConfiguredLink(channel.linkUrl, `El canal “${channel.title}” En la aplicación.`));
      article.addEventListener("keydown", event => { if (["Enter", " "].includes(event.key)) { event.preventDefault(); article.click(); } });
      return article;
    }

    function getRecommendations() {
      const favoriteItems = CATALOG.filter(item => state.favorites.has(item.id));
      const preferredGenres = favoriteItems.reduce((map, item) => map.set(item.genre, (map.get(item.genre) || 0) + 1), new Map());
      return [...CATALOG.filter(item => item.section === "recomendados")].sort((a, b) => {
        const genreScore = (preferredGenres.get(b.genre) || 0) - (preferredGenres.get(a.genre) || 0);
        return genreScore || b.rating - a.rating || b.year - a.year;
      });
    }

    function renderSection(config) {
      const items = config.dynamicRecommendations ? getRecommendations() : CATALOG.filter(item => item.section === config.id);
      const section = document.createElement("section");
      section.className = "section";
      section.id = config.id === "recomendados" ? "mi-lista" : `seccion-${config.id}`;
      const rowId = `row-${config.id}`;
      section.innerHTML = `
        <div class="section-heading">
          <div class="section-title-wrap"><span class="section-kicker">${escapeHtml(config.kicker)}</span><h2 class="section-title">${escapeHtml(config.title)}</h2><p class="section-copy">${escapeHtml(config.copy)}</p></div>
          <div class="row-actions"><button class="row-arrow" type="button" data-scroll-row="${rowId}" data-direction="-1" aria-label="Desplazar a la izquierda">‹</button><button class="row-arrow" type="button" data-scroll-row="${rowId}" data-direction="1" aria-label="Desplazar a la derecha">›</button></div>
        </div>
        <div class="content-row" id="${rowId}"></div>`;
      const row = $(".content-row", section);
      items.forEach((item, index) => row.appendChild(createCard(item, index)));
      return section;
    }

    function renderCatalogSections() {
      elements.standardCatalog.innerHTML = "";
      SECTION_CONFIG.forEach(config => elements.standardCatalog.appendChild(renderSection(config)));
      bindDynamicCardEvents(elements.standardCatalog);
      updateFavoriteUI();
    }

    function renderLiveChannels() {
      elements.liveGrid.innerHTML = "";
      LIVE_CHANNELS.forEach(channel => elements.liveGrid.appendChild(createLiveCard(channel)));
    }

    /* ---------- Búsqueda y filtros ---------- */
    function uniqueValues(key) { return [...new Set(CATALOG.map(item => item[key]))].sort((a, b) => String(a).localeCompare(String(b), "es")); }

    function renderChoiceGroup(container, name, values) {
      container.innerHTML = ["Todos", ...values].map((value, index) => {
        const id = `${name}-${index}`;
        return `<input class="choice-input" id="${id}" type="radio" name="${name}" value="${escapeHtml(value)}" ${index === 0 ? "checked" : ""}><label class="choice-label" for="${id}">${escapeHtml(value)}</label>`;
      }).join("");
    }

    function initFilterControls() {
      renderChoiceGroup($("#typeChoices"), "type", uniqueValues("type"));
      renderChoiceGroup($("#genreChoices"), "genre", uniqueValues("genre"));
      renderChoiceGroup($("#languageChoices"), "language", uniqueValues("language"));
      const years = uniqueValues("year").sort((a, b) => b - a);
      $("#yearFilter").innerHTML = `<option value="0">Cualquier año</option>${years.map(year => `<option value="${year}">${year} o posterior</option>`).join("")}`;
      const suggestionTerms = ["Ciencia ficción", "Terror", "Coreano", "2026", "Documental"];
      $("#suggestionChips").innerHTML = suggestionTerms.map(term => `<button class="filter-chip" type="button" data-search-suggestion="${escapeHtml(term)}">${escapeHtml(term)}</button>`).join("");
    }

    function getFilteredItems() {
      const term = state.searchTerm.trim().toLocaleLowerCase("es");
      let items = CATALOG.filter(item => {
        const matchesTerm = !term || [item.title, item.genre, item.type, item.language, item.year, item.description].join(" ").toLocaleLowerCase("es").includes(term);
        const matchesType = state.filters.type === "Todos" || item.type === state.filters.type;
        const matchesGenre = state.filters.genre === "Todos" || item.genre === state.filters.genre;
        const matchesLanguage = state.filters.language === "Todos" || item.language === state.filters.language;
        const matchesYear = !state.filters.year || item.year >= state.filters.year;
        const matchesRating = item.rating >= state.filters.rating;
        const matchesFavorite = !state.filters.favoritesOnly || state.favorites.has(item.id);
        return matchesTerm && matchesType && matchesGenre && matchesLanguage && matchesYear && matchesRating && matchesFavorite;
      });

      items.sort((a, b) => {
        if (state.filters.sort === "rating") return b.rating - a.rating;
        if (state.filters.sort === "newest") return b.year - a.year || b.rating - a.rating;
        if (state.filters.sort === "title") return a.title.localeCompare(b.title, "es");
        return (state.favorites.has(b.id) - state.favorites.has(a.id)) || b.rating - a.rating || b.year - a.year;
      });
      return items;
    }

    function getActiveFilterCount() {
      return Number(state.filters.type !== "Todos") + Number(state.filters.genre !== "Todos") + Number(state.filters.language !== "Todos") + Number(Boolean(state.filters.year)) + Number(state.filters.rating > 0) + Number(state.filters.sort !== "recommended") + Number(state.filters.favoritesOnly);
    }

    function renderSearchResults() {
      const items = getFilteredItems();
      const isSearchMode = Boolean(state.searchTerm || getActiveFilterCount());
      elements.standardCatalog.hidden = isSearchMode;
      elements.searchView.classList.toggle("is-visible", isSearchMode);
      elements.searchGrid.innerHTML = "";

      if (isSearchMode) {
        if (items.length) items.forEach((item, index) => elements.searchGrid.appendChild(createCard(item, index)));
        else elements.searchGrid.innerHTML = `<div class="empty-state"><div><strong>No encontramos coincidencias</strong>Prueba con otro término o restablece los filtros.</div></div>`;
        const viewTitle = state.filters.favoritesOnly ? "Mi lista" : state.filters.type === "Serie" ? "Series" : state.filters.type === "Película" ? "Películas" : "Explorar catálogo";
        $("#searchResultsTitle").textContent = viewTitle;
        elements.searchDescription.textContent = `${items.length} resultado${items.length === 1 ? "" : "s"}${state.searchTerm ? ` para “${state.searchTerm}”` : ""}.`;
        bindDynamicCardEvents(elements.searchGrid);
      }

      elements.activeFilterCount.textContent = getActiveFilterCount();
      elements.quickFavorites.classList.toggle("is-active", state.filters.favoritesOnly);
      elements.resultSummary.textContent = isSearchMode ? `${items.length} resultado${items.length === 1 ? "" : "s"}` : "Catálogo completo";
      updateFavoriteUI();
      syncCatalogNavigation();
    }

    function openMobileNav() {
      elements.mobileNavDrawer.classList.add("is-open");
      $("#mobileMenuButton").setAttribute("aria-expanded", "true");
      updateBodyLock();
    }
    function closeMobileNav() {
      elements.mobileNavDrawer.classList.remove("is-open");
      $("#mobileMenuButton").setAttribute("aria-expanded", "false");
      updateBodyLock();
    }

    function openSearch() {
      elements.searchOverlay.classList.add("is-open");
      $("#searchOpenButton").setAttribute("aria-expanded", "true");
      updateBodyLock();
      window.setTimeout(() => elements.searchInput.focus(), 50);
    }
    function closeSearch() {
      elements.searchOverlay.classList.remove("is-open");
      $("#searchOpenButton").setAttribute("aria-expanded", "false");
      updateBodyLock();
    }

    function applySearch(term) {
      state.searchTerm = term.trim();
      elements.searchInput.value = state.searchTerm;
      closeSearch();
      renderSearchResults();
      if (state.searchTerm || getActiveFilterCount()) elements.searchView.scrollIntoView({ behavior: "smooth", block: "start" });
    }

    function syncFilterFormFromState() {
      const setRadio = (name, value) => { const field = $(`input[name="${name}"][value="${CSS.escape(value)}"]`); if (field) field.checked = true; };
      setRadio("type", state.filters.type);
      setRadio("genre", state.filters.genre);
      setRadio("language", state.filters.language);
      $("#yearFilter").value = String(state.filters.year);
      $("#ratingFilter").value = String(state.filters.rating);
      $("#ratingOutput").textContent = state.filters.rating ? `${state.filters.rating}+ ★` : "Todas";
      $("#sortFilter").value = state.filters.sort;
    }

    function openFilters() {
      syncFilterFormFromState();
      elements.filterDrawer.classList.add("is-open");
      $("#filtersOpenButton").setAttribute("aria-expanded", "true");
      updateBodyLock();
    }
    function closeFilters() {
      elements.filterDrawer.classList.remove("is-open");
      $("#filtersOpenButton").setAttribute("aria-expanded", "false");
      updateBodyLock();
    }

    function resetFilters() {
      state.filters = { type: "Todos", genre: "Todos", language: "Todos", year: 0, rating: 0, sort: "recommended", favoritesOnly: false };
      syncFilterFormFromState();
      renderSearchResults();
    }

    /* ---------- Favoritos ---------- */
    function toggleFavorite(id) {
      if (state.favorites.has(id)) state.favorites.delete(id); else state.favorites.add(id);
      localStorage.setItem("vibetv-favorites", JSON.stringify([...state.favorites]));
      renderCatalogSections();
      renderSearchResults();
      if (state.modalItemId === id) updateModalFavoriteButton();
      showToast(state.favorites.has(id) ? "Añadido a Mi lista" : "Eliminado de Mi lista");
    }

    function updateFavoriteUI() { elements.favoriteCount.textContent = state.favorites.size; }

    /* ---------- Modal ---------- */
    function openDetail(id) {
      const item = CATALOG.find(entry => entry.id === id);
      if (!item) return;
      state.modalItemId = id;
      elements.modalTitle.textContent = item.title;
      elements.modalMeta.innerHTML = createMetaPills([String(item.year), item.type, item.genre, `★ ${item.rating.toFixed(1)}`]);
      elements.modalDescription.textContent = item.description;
      elements.modalDetails.innerHTML = `<span><strong>Idioma:</strong> ${escapeHtml(item.language)}</span><span><strong>Formato:</strong> ${escapeHtml(item.type)}</span><span><strong>Género:</strong> ${escapeHtml(item.genre)}</span><span><strong>Enlace:</strong> ${item.linkUrl ? "Configurado" : "VibeTV"}</span>`;
      setImage(elements.modalImage, item.backdropUrl || item.posterUrl, `Imagen de ${item.title}`);
      updateModalFavoriteButton();
      elements.detailBackdrop.classList.add("is-open");
      updateBodyLock();
    }

    function closeDetail() { elements.detailBackdrop.classList.remove("is-open"); state.modalItemId = null; updateBodyLock(); }
    function updateModalFavoriteButton() {
      const active = state.favorites.has(state.modalItemId);
      elements.modalFavoriteButton.textContent = active ? "✓ En Mi lista" : "+ Mi lista";
    }

    function playCurrentModalItem() {
      const item = CATALOG.find(entry => entry.id === state.modalItemId);
      if (item) openConfiguredLink(item.linkUrl, `“${item.title}” disponible de manera gratuita en la App.`);
    }

    function openConfiguredLink(url, fallbackMessage) {
      const cleanUrl = safeUrl(url);
      if (cleanUrl) window.open(cleanUrl, "_blank", "noopener,noreferrer");
      else showToast(fallbackMessage);
    }

    /* ---------- Eventos dinámicos ---------- */
    function bindDynamicCardEvents(root) {
      $$('[data-open-detail]', root).forEach(button => button.addEventListener("click", () => openDetail(button.dataset.openDetail)));
      $$('[data-favorite]', root).forEach(button => {
        const activate = event => { event.preventDefault(); event.stopPropagation(); toggleFavorite(button.dataset.favorite); };
        button.addEventListener("click", activate);
        button.addEventListener("keydown", event => { if (["Enter", " "].includes(event.key)) activate(event); });
      });
    }

    function bindEvents() {
      let scrollFrame = null;
      window.addEventListener("scroll", () => {
        if (scrollFrame) return;
        scrollFrame = window.requestAnimationFrame(() => {
          updateScrollInterface();
          scrollFrame = null;
        });
      }, { passive: true });
      window.addEventListener("resize", updateScrollInterface, { passive: true });

      $$('[data-nav-key]').forEach(link => link.addEventListener("click", event => {
        event.preventDefault();
        activateNavigation(link.dataset.navKey);
      }));

      $("#heroPrevious").addEventListener("click", () => renderHero(state.heroIndex - 1));
      $("#heroNext").addEventListener("click", () => renderHero(state.heroIndex + 1));
      elements.heroDots.addEventListener("click", event => { const dot = event.target.closest("[data-hero-index]"); if (dot) renderHero(Number(dot.dataset.heroIndex)); });
      $("#heroPlayButton").addEventListener("click", () => {
        scrollToSection("#descargar");
      });
      $("#heroInfoButton").addEventListener("click", () => openDetail(HERO_SLIDES[state.heroIndex].featuredId));

      $("#searchOpenButton").addEventListener("click", openSearch);
      $("#searchCloseButton").addEventListener("click", closeSearch);
      elements.searchOverlay.addEventListener("click", event => { if (event.target === elements.searchOverlay) closeSearch(); });
      elements.searchInput.addEventListener("keydown", event => { if (event.key === "Enter") applySearch(elements.searchInput.value); });
      $$('[data-search-suggestion]').forEach(button => button.addEventListener("click", () => applySearch(button.dataset.searchSuggestion)));
      $("#clearSearchButton").addEventListener("click", () => { state.searchTerm = ""; elements.searchInput.value = ""; resetFilters(); });

      $("#filtersOpenButton").addEventListener("click", openFilters);
      $("#filtersCloseButton").addEventListener("click", closeFilters);
      elements.filterDrawer.addEventListener("click", event => { if (event.target === elements.filterDrawer) closeFilters(); });
      $("#ratingFilter").addEventListener("input", event => $("#ratingOutput").textContent = Number(event.target.value) ? `${event.target.value}+ ★` : "Todas");
      $("#resetFiltersButton").addEventListener("click", resetFilters);
      elements.filterForm.addEventListener("submit", event => {
        event.preventDefault();
        const data = new FormData(elements.filterForm);
        state.filters.type = data.get("type") || "Todos";
        state.filters.genre = data.get("genre") || "Todos";
        state.filters.language = data.get("language") || "Todos";
        state.filters.year = Number(data.get("year") || 0);
        state.filters.rating = Number($("#ratingFilter").value || 0);
        state.filters.sort = data.get("sort") || "recommended";
        closeFilters();
        renderSearchResults();
        elements.searchView.scrollIntoView({ behavior: "smooth", block: "start" });
      });

      elements.quickFavorites.addEventListener("click", () => {
        state.filters.favoritesOnly = !state.filters.favoritesOnly;
        setActiveNavigation(state.filters.favoritesOnly ? "mi-lista" : null);
        renderSearchResults();
        if (state.filters.favoritesOnly) scrollToSection("#explorar");
      });

      document.addEventListener("click", event => {
        const arrow = event.target.closest("[data-scroll-row]");
        if (arrow) {
          const row = document.getElementById(arrow.dataset.scrollRow);
          row?.scrollBy({ left: Number(arrow.dataset.direction) * Math.min(row.clientWidth * 0.82, 900), behavior: "smooth" });
        }
        const toastTrigger = event.target.closest("[data-toast]");
        if (toastTrigger) showToast(toastTrigger.dataset.toast);
      });

      $("#modalCloseButton").addEventListener("click", closeDetail);
      elements.detailBackdrop.addEventListener("click", event => { if (event.target === elements.detailBackdrop) closeDetail(); });
      elements.modalFavoriteButton.addEventListener("click", () => state.modalItemId && toggleFavorite(state.modalItemId));
      $("#modalPlayButton").addEventListener("click", playCurrentModalItem);

      $("#mobileMenuButton").addEventListener("click", openMobileNav);
      $("#mobileNavCloseButton").addEventListener("click", closeMobileNav);
      elements.mobileNavDrawer.addEventListener("click", event => { if (event.target === elements.mobileNavDrawer) closeMobileNav(); });
      elements.backToTopButton.addEventListener("click", () => {
        setActiveNavigation("inicio");
        scrollToSection("#inicio");
      });

      document.addEventListener("keydown", event => {
        if (event.key === "Escape") { closeSearch(); closeFilters(); closeDetail(); closeMobileNav(); }
        if (event.key === "/" && !["INPUT", "TEXTAREA", "SELECT"].includes(document.activeElement.tagName)) { event.preventDefault(); openSearch(); }
      });

      elements.apkDownloadButton.addEventListener("click", event => {
        if (!safeUrl(CONFIG.apkHref)) { event.preventDefault(); showToast("Configura CONFIG.apkHref antes de activar la descarga."); }
      });
    }

    function configureDownloadButton() {
      const cleanUrl = safeUrl(CONFIG.apkHref);
      if (cleanUrl) {
        elements.apkDownloadButton.href = cleanUrl;
        elements.apkDownloadButton.removeAttribute("aria-disabled");
      } else {
        elements.apkDownloadButton.href = "#";
        elements.apkDownloadButton.setAttribute("aria-disabled", "true");
      }
    }

    function init() {
      renderHero(0);
      renderLiveChannels();
      initFilterControls();
      renderCatalogSections();
      renderSearchResults();
      configureDownloadButton();
      bindEvents();
      updateFavoriteUI();
      updateScrollInterface();
    }

    init();
  </script>





</body>
</html>

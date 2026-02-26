{{--
    resources/views/livewire/tenant/landing/landing-builder.blade.php
--}}
<div class="shell"
     style="font-family:'Instrument Sans',system-ui,sans-serif; background:var(--bg); color:var(--text);"
     x-data="{
        activePicker: null,
        dragId: null,

        primaryPresets: ['#6366f1','#8b5cf6','#3b82f6','#0ea5e9','#06b6d4','#14b8a6','#22c55e','#f59e0b','#ef4444','#ec4899','#1e293b','#18181b'],
        neutralPresets: ['#f1f5f9','#e2e8f0','#cbd5e1','#f5f5f4','#e7e5e4','#d1d5db','#fafaf9','#fef3c7','#d1fae5','#e0f2fe','#fee2e2','#f3f4f6'],
        accentPresets:  ['#f97316','#eab308','#ef4444','#ec4899','#a855f7','#06b6d4','#10b981','#f59e0b','#84cc16','#0ea5e9','#fb7185','#c084fc'],

        quickPalettes: [
            { name:'Índigo',    vibe:'Profesional',  primary:'#6366f1', neutral:'#e2e8f0', accent:'#f97316' },
            { name:'Bosque',    vibe:'Natural',       primary:'#166534', neutral:'#d1fae5', accent:'#f59e0b' },
            { name:'Océano',    vibe:'Tecnológico',  primary:'#0ea5e9', neutral:'#e0f2fe', accent:'#f43f5e' },
            { name:'Artesanal', vibe:'Cálido',        primary:'#b45309', neutral:'#fef3c7', accent:'#6b7280' },
            { name:'Rosa',      vibe:'Editorial',    primary:'#db2777', neutral:'#fce7f3', accent:'#7c3aed' },
            { name:'Violeta',   vibe:'Creativo',     primary:'#7c3aed', neutral:'#f5f3ff', accent:'#22d3ee' },
        ],
     }"
>
    <style>\n
        /* ─────────────────────────────────────────
   RESET & BASE
───────────────────────────────────────── */
        *,
        *::before,
        *::after {
            box-sizing: border-box;
            margin: 0;
            padding: 0;
        }

        :root {
            --bg: #f8fafc;
            --bg-2: #ffffff;
            --bg-3: #f1f5f9;
            --bg-4: #e2e8f0;
            --border: rgba(0, 0, 0, 0.08);
            --border-2: rgba(0, 0, 0, 0.12);
            --text: #0f172a;
            --text-2: #475569;
            --text-3: #64748b;
            --primary: #7c6ff7;
            --primary-2: #9d93ff;
            --accent: #f97316;
            --green: #22c55e;
            --red: #ef4444;
            --radius: 12px;
            --radius-lg: 18px;
            --shadow: 0 8px 32px rgba(0, 0, 0, 0.05);
            --shadow-lg: 0 24px 64px rgba(0, 0, 0, 0.12);
        }

        html {
            background: var(--bg);
            color: var(--text);
            font-family: 'Instrument Sans', sans-serif;
        }

        body {
            min-height: 100vh;
        }

        /* ─────────────────────────────────────────
   LAYOUT SHELL
───────────────────────────────────────── */
        .shell {
            display: grid;
            grid-template-rows: auto 1fr;
            height: 100vh;
            overflow: hidden;
        }

        /* ─────────────────────────────────────────
   TOPBAR
───────────────────────────────────────── */
        .topbar {
            display: flex;
            align-items: center;
            justify-content: space-between;
            padding: 0 28px;
            height: 56px;
            background: var(--bg-2);
            border-bottom: 1px solid var(--border);
            flex-shrink: 0;
            gap: 16px;
        }

        .topbar-left {
            display: flex;
            align-items: center;
            gap: 12px;
        }

        .topbar-logo {
            display: flex;
            align-items: center;
            gap: 8px;
            font-size: 15px;
            font-weight: 700;
            color: var(--text);
            text-decoration: none;
        }

        .topbar-logo-mark {
            width: 28px;
            height: 28px;
            border-radius: 8px;
            background: var(--primary);
            display: flex;
            align-items: center;
            justify-content: center;
        }

        .topbar-sep {
            width: 1px;
            height: 20px;
            background: var(--border-2);
        }

        .topbar-title {
            font-size: 13px;
            color: var(--text-2);
            font-weight: 500;
        }

        .topbar-right {
            display: flex;
            align-items: center;
            gap: 8px;
        }

        /* Status pill */
        .status-pill {
            display: inline-flex;
            align-items: center;
            gap: 6px;
            padding: 4px 10px;
            border-radius: 20px;
            font-size: 11px;
            font-weight: 600;
            background: rgba(234, 179, 8, 0.1);
            color: #fde68a;
            border: 1px solid rgba(234, 179, 8, 0.2);
        }

        .status-pill.live {
            background: rgba(34, 197, 94, 0.1);
            color: #86efac;
            border-color: rgba(34, 197, 94, 0.2);
        }

        .status-dot {
            width: 6px;
            height: 6px;
            border-radius: 50%;
            background: currentColor;
        }

        .status-dot.pulse {
            animation: pulse 1.5s ease infinite;
        }

        @keyframes pulse {

            0%,
            100% {
                opacity: 1;
            }

            50% {
                opacity: 0.4;
            }
        }

        /* Buttons */
        .btn {
            display: inline-flex;
            align-items: center;
            gap: 6px;
            padding: 7px 14px;
            border-radius: 9px;
            font-size: 13px;
            font-weight: 600;
            border: none;
            cursor: pointer;
            transition: all 0.18s ease;
            white-space: nowrap;
        }

        .btn-ghost {
            background: transparent;
            color: var(--text-2);
            border: 1px solid var(--border-2);
        }

        .btn-ghost:hover {
            background: var(--bg-3);
            color: var(--text);
        }

        .btn-primary {
            background: var(--primary);
            color: white;
            box-shadow: 0 4px 16px rgba(124, 111, 247, 0.3);
        }

        .btn-primary:hover {
            background: var(--primary-2);
            transform: translateY(-1px);
            box-shadow: 0 6px 20px rgba(124, 111, 247, 0.4);
        }

        .btn-success {
            background: rgba(34, 197, 94, 0.12);
            color: #86efac;
            border: 1px solid rgba(34, 197, 94, 0.25);
        }

        .btn-success:hover {
            background: rgba(34, 197, 94, 0.2);
        }

        .btn-sm {
            padding: 5px 10px;
            font-size: 12px;
            border-radius: 7px;
        }

        .btn-icon {
            padding: 7px;
            border-radius: 8px;
        }

        /* ─────────────────────────────────────────
   MAIN LAYOUT: sidebar + canvas
───────────────────────────────────────── */
        .main-layout {
            display: grid;
            grid-template-columns: 380px 1fr;
            overflow: hidden;
            height: 100%;
        }

        /* ─────────────────────────────────────────
   SIDEBAR (LEFT PANEL)
───────────────────────────────────────── */
        .sidebar {
            background: var(--bg-2);
            border-right: 1px solid var(--border);
            display: flex;
            flex-direction: column;
            overflow: hidden;
        }

        .sidebar-tabs {
            display: flex;
            border-bottom: 1px solid var(--border);
            padding: 0 4px;
            gap: 2px;
            flex-shrink: 0;
        }

        .sidebar-tab {
            flex: 1;
            padding: 12px 8px;
            font-size: 12px;
            font-weight: 600;
            color: var(--text-3);
            background: none;
            border: none;
            cursor: pointer;
            transition: all 0.15s;
            border-bottom: 2px solid transparent;
            margin-bottom: -1px;
            display: flex;
            align-items: center;
            justify-content: center;
            gap: 5px;
        }

        .sidebar-tab:hover {
            color: var(--text-2);
        }

        .sidebar-tab.active {
            color: var(--primary-2);
            border-bottom-color: var(--primary);
        }

        .sidebar-body {
            flex: 1;
            overflow-y: auto;
            padding: 20px;
            scrollbar-width: thin;
            scrollbar-color: var(--bg-4) transparent;
        }

        .sidebar-body::-webkit-scrollbar {
            width: 4px;
        }

        .sidebar-body::-webkit-scrollbar-thumb {
            background: var(--bg-4);
            border-radius: 4px;
        }

        /* ─────────────────────────────────────────
   TEMPLATE SELECTOR
───────────────────────────────────────── */
        .section-label {
            font-size: 11px;
            font-weight: 700;
            text-transform: uppercase;
            letter-spacing: 0.08em;
            color: var(--text-3);
            margin-bottom: 12px;
        }

        .templates-grid {
            display: grid;
            grid-template-columns: repeat(2, 1fr);
            gap: 8px;
            margin-bottom: 20px;
        }

        .template-card {
            position: relative;
            border-radius: var(--radius);
            overflow: hidden;
            cursor: pointer;
            border: 2px solid var(--border);
            transition: all 0.2s ease;
            aspect-ratio: 16/9;
            background: var(--bg-3);
        }

        .template-card:hover {
            border-color: var(--border-2);
            transform: translateY(-1px);
        }

        .template-card.selected {
            border-color: var(--primary);
            box-shadow: 0 0 0 1px var(--primary), 0 8px 24px rgba(124, 111, 247, 0.2);
        }

        .template-thumb {
            width: 100%;
            height: 100%;
            display: flex;
            flex-direction: column;
            overflow: hidden;
        }

        /* Mini landing previews */
        .tmpl-nav {
            height: 12px;
            display: flex;
            align-items: center;
            gap: 3px;
            padding: 0 6px;
        }

        .tmpl-nav-dot {
            width: 20px;
            height: 3px;
            border-radius: 2px;
        }

        .tmpl-hero {
            flex: 1;
            display: flex;
            flex-direction: column;
            align-items: center;
            justify-content: center;
            padding: 6px;
            text-align: center;
        }

        .tmpl-hero-title {
            font-size: 7px;
            font-weight: 800;
            margin-bottom: 3px;
            line-height: 1.2;
        }

        .tmpl-hero-sub {
            font-size: 5px;
            opacity: 0.5;
            margin-bottom: 5px;
        }

        .tmpl-hero-btn {
            font-size: 5px;
            font-weight: 700;
            padding: 2px 8px;
            border-radius: 3px;
            color: white;
        }

        .tmpl-cards {
            display: grid;
            grid-template-columns: repeat(3, 1fr);
            gap: 2px;
            padding: 4px 6px 6px;
        }

        .tmpl-card-mini {
            height: 14px;
            border-radius: 3px;
        }

        .tmpl-fullscreen {
            flex: 1;
            display: flex;
            flex-direction: column;
            align-items: center;
            justify-content: center;
        }

        .tmpl-gallery {
            display: grid;
            grid-template-columns: repeat(3, 1fr);
            gap: 2px;
            flex: 1;
        }

        .tmpl-gallery-item {
            border-radius: 2px;
        }

        .template-overlay {
            position: absolute;
            inset: 0;
            background: linear-gradient(to top, rgba(0, 0, 0, 0.82), rgba(0,0,0,0.25), transparent);
            display: flex;
            flex-direction: column;
            justify-content: flex-end;
            padding: 8px;
            opacity: 0;
            transition: opacity 0.2s;
        }

        .template-card:hover .template-overlay,
        .template-card.selected .template-overlay {
            opacity: 1;
        }

        .template-label {
            font-size: 10px;
            font-weight: 700;
            color: white;
            margin-bottom: 2px;
        }

        .template-sub {
            font-size: 8px;
            color: rgba(255, 255, 255, 0.6);
        }

        .template-check {
            position: absolute;
            top: 6px;
            right: 6px;
            width: 18px;
            height: 18px;
            border-radius: 50%;
            background: var(--primary);
            display: none;
            align-items: center;
            justify-content: center;
        }

        .template-card.selected .template-check {
            display: flex;
        }

        /* ─────────────────────────────────────────
   BLOCKS LIST
───────────────────────────────────────── */
        .blocks-list {
            display: flex;
            flex-direction: column;
            gap: 4px;
            margin-bottom: 12px;
        }

        .block-item {
            display: flex;
            align-items: center;
            gap: 10px;
            padding: 11px 12px;
            border-radius: var(--radius);
            border: 1px solid var(--border);
            background: var(--bg-3);
            cursor: pointer;
            transition: all 0.15s;
            user-select: none;
            position: relative;
        }

        .block-item:hover {
            border-color: var(--border-2);
            background: var(--bg-4);
        }

        .block-item.selected {
            border-color: var(--primary);
            background: rgba(124, 111, 247, 0.07);
        }

        .block-item.disabled {
            opacity: 0.45;
        }

        .block-drag {
            color: var(--text-3);
            cursor: grab;
            flex-shrink: 0;
        }

        .block-drag:active {
            cursor: grabbing;
        }

        .block-icon {
            width: 30px;
            height: 30px;
            border-radius: 8px;
            display: flex;
            align-items: center;
            justify-content: center;
            flex-shrink: 0;
            font-size: 14px;
        }

        .block-name {
            font-size: 13px;
            font-weight: 600;
            color: var(--text);
            flex: 1;
        }

        .block-tag {
            font-size: 10px;
            color: var(--text-3);
            font-weight: 500;
        }

        /* Toggle switch */
        .toggle {
            position: relative;
            width: 36px;
            height: 20px;
            flex-shrink: 0;
        }

        .toggle input {
            opacity: 0;
            width: 0;
            height: 0;
            position: absolute;
        }

        .toggle-track {
            position: absolute;
            inset: 0;
            border-radius: 20px;
            background: var(--bg-4);
            border: 1px solid var(--border-2);
            cursor: pointer;
            transition: all 0.2s;
        }

        .toggle input:checked+.toggle-track {
            background: var(--green);
            border-color: var(--green);
        }

        .toggle-thumb {
            position: absolute;
            top: 2px;
            left: 2px;
            width: 14px;
            height: 14px;
            border-radius: 50%;
            background: white;
            transition: transform 0.2s cubic-bezier(0.34, 1.56, 0.64, 1);
            box-shadow: 0 1px 4px rgba(0, 0, 0, 0.3);
            pointer-events: none;
        }

        .toggle input:checked~.toggle-thumb {
            transform: translateX(16px);
        }

        /* Edit button */
        .block-edit {
            padding: 4px 10px;
            border-radius: 7px;
            font-size: 11px;
            font-weight: 600;
            background: rgba(0, 0, 0, 0.05);
            border: 1px solid var(--border-2);
            color: var(--text-2);
            cursor: pointer;
            transition: all 0.15s;
            flex-shrink: 0;
        }

        .block-edit:hover {
            background: rgba(0, 0, 0, 0.1);
            color: var(--text);
        }

        /* Add block button */
        .add-block-btn {
            width: 100%;
            padding: 10px;
            border-radius: var(--radius);
            border: 1px dashed rgba(255, 255, 255, 0.1);
            background: transparent;
            color: var(--text-3);
            font-size: 12px;
            font-weight: 600;
            cursor: pointer;
            transition: all 0.15s;
            display: flex;
            align-items: center;
            justify-content: center;
            gap: 6px;
        }

        .add-block-btn:hover {
            border-color: var(--primary);
            color: var(--primary-2);
            background: rgba(124, 111, 247, 0.05);
        }

        /* ─────────────────────────────────────────
   STYLE PANEL
───────────────────────────────────────── */
        .style-section {
            margin-bottom: 24px;
        }

        .style-section:last-child {
            margin-bottom: 0;
        }

        .style-row {
            display: flex;
            align-items: center;
            justify-content: space-between;
            gap: 12px;
            margin-bottom: 10px;
        }

        .style-label {
            font-size: 12px;
            font-weight: 600;
            color: var(--text);
        }

        .style-sublabel {
            font-size: 11px;
            color: var(--text-3);
            margin-bottom: 8px;
        }

        /* Color picker row */
        .color-picker-row {
            display: flex;
            align-items: center;
            gap: 8px;
            padding: 8px 10px;
            border-radius: 10px;
            background: var(--bg-3);
            border: 1px solid var(--border);
            cursor: pointer;
            transition: all 0.15s;
        }

        .color-picker-row:hover {
            border-color: var(--border-2);
        }

        .color-swatch-lg {
            width: 28px;
            height: 28px;
            border-radius: 6px;
            flex-shrink: 0;
            box-shadow: inset 0 0 0 1px rgba(255, 255, 255, 0.1);
        }

        .color-hex {
            font-family: 'Courier New', monospace;
            font-size: 12px;
            color: var(--text);
            flex: 1;
        }

        .color-caret {
            color: var(--text-3);
        }

        .color-presets {
            display: flex;
            flex-wrap: wrap;
            gap: 5px;
            padding: 10px;
            background: var(--bg-3);
            border-radius: 10px;
            border: 1px solid var(--border);
            margin-top: 6px;
        }

        .color-preset {
            width: 22px;
            height: 22px;
            border-radius: 50%;
            cursor: pointer;
            border: 2px solid transparent;
            transition: all 0.15s;
        }

        .color-preset:hover {
            transform: scale(1.15);
        }

        .color-preset.active {
            border-color: white;
            box-shadow: 0 0 0 1px rgba(255, 255, 255, 0.3);
        }

        /* Font selector */
        .font-grid {
            display: grid;
            grid-template-columns: repeat(2, 1fr);
            gap: 6px;
        }

        .font-option {
            padding: 10px;
            border-radius: 9px;
            border: 1px solid var(--border);
            background: var(--bg-3);
            cursor: pointer;
            transition: all 0.15s;
            text-align: center;
        }

        .font-option:hover {
            border-color: var(--border-2);
            background: var(--bg-4);
        }

        .font-option.active {
            border-color: var(--primary);
            background: rgba(124, 111, 247, 0.08);
        }

        .font-option-name {
            font-size: 13px;
            font-weight: 700;
            color: var(--text);
            line-height: 1;
            margin-bottom: 3px;
        }

        .font-option-sub {
            font-size: 9px;
            color: var(--text-3);
            font-weight: 500;
        }

        /* Bg mode */
        .bg-mode-row {
            display: grid;
            grid-template-columns: repeat(3, 1fr);
            gap: 6px;
        }

        .bg-mode-option {
            padding: 10px 6px;
            border-radius: 9px;
            border: 1px solid var(--border);
            background: var(--bg-3);
            cursor: pointer;
            transition: all 0.15s;
            text-align: center;
        }

        .bg-mode-option:hover {
            border-color: var(--border-2);
        }

        .bg-mode-option.active {
            border-color: var(--primary);
            background: rgba(124, 111, 247, 0.08);
        }

        .bg-mode-icon {
            font-size: 18px;
            margin-bottom: 4px;
        }

        .bg-mode-label {
            font-size: 11px;
            font-weight: 600;
            color: var(--text-2);
        }

        /* Sidebar footer */
        .sidebar-footer {
            padding: 14px 20px;
            border-top: 1px solid var(--border);
            display: flex;
            gap: 8px;
            flex-shrink: 0;
        }

        /* ─────────────────────────────────────────
   RIGHT PANEL — CANVAS
───────────────────────────────────────── */
        .canvas-panel {
            display: flex;
            flex-direction: column;
            overflow: hidden;
            background: var(--bg);
        }

        .canvas-toolbar {
            display: flex;
            align-items: center;
            justify-content: space-between;
            padding: 10px 20px;
            border-bottom: 1px solid var(--border);
            background: var(--bg-2);
            flex-shrink: 0;
            gap: 12px;
        }

        .viewport-switcher {
            display: flex;
            background: var(--bg-3);
            border-radius: 9px;
            padding: 3px;
            gap: 2px;
            border: 1px solid var(--border);
        }

        .viewport-btn {
            padding: 5px 10px;
            border-radius: 7px;
            font-size: 12px;
            font-weight: 600;
            background: none;
            border: none;
            color: var(--text-3);
            cursor: pointer;
            transition: all 0.15s;
            display: flex;
            align-items: center;
            gap: 5px;
        }

        .viewport-btn.active {
            background: var(--bg-4);
            color: var(--text);
            box-shadow: 0 1px 4px rgba(0, 0, 0, 0.3);
        }

        .viewport-btn:hover:not(.active) {
            color: var(--text-2);
        }

        .canvas-info {
            font-size: 12px;
            color: var(--text-3);
            display: flex;
            align-items: center;
            gap: 8px;
        }

        .canvas-info span {
            color: var(--text-2);
            font-weight: 600;
        }

        .canvas-area {
            flex: 1;
            overflow: auto;
            padding: 32px;
            display: flex;
            align-items: flex-start;
            justify-content: center;
            background:
                radial-gradient(circle at 20% 20%, rgba(124, 111, 247, 0.04) 0%, transparent 60%),
                radial-gradient(circle at 80% 80%, rgba(249, 115, 22, 0.03) 0%, transparent 50%),
                var(--bg);
        }

        /* Dot grid background */
        .canvas-area::before {
            content: '';
            position: fixed;
            inset: 0;
            pointer-events: none;
            background-image: radial-gradient(circle, rgba(255, 255, 255, 0.06) 1px, transparent 1px);
            background-size: 24px 24px;
            mask-image: radial-gradient(ellipse 80% 80% at 50% 50%, black 0%, transparent 100%);
        }

        .preview-window {
            background: white;
            border-radius: 16px;
            overflow: hidden;
            box-shadow: 0 0 0 1px rgba(255, 255, 255, 0.08), var(--shadow-lg);
            transition: width 0.3s cubic-bezier(0.4, 0, 0.2, 1), max-width 0.3s;
            width: 100%;
            max-width: 900px;
            position: relative;
            z-index: 1;
        }

        .preview-window.tablet {
            max-width: 768px;
        }

        .preview-window.mobile {
            max-width: 390px;
        }

        /* Browser chrome */
        .browser-chrome {
            background: #f0f0f0;
            padding: 8px 12px;
            display: flex;
            align-items: center;
            gap: 8px;
            border-bottom: 1px solid #e0e0e0;
        }

        .chrome-dots {
            display: flex;
            gap: 5px;
        }

        .chrome-dot {
            width: 10px;
            height: 10px;
            border-radius: 50%;
        }

        .chrome-url {
            flex: 1;
            background: white;
            border-radius: 5px;
            padding: 3px 10px;
            font-size: 10px;
            color: #666;
            font-family: monospace;
            border: 1px solid #ddd;
        }

        /* ── MINI LANDING PREVIEW ── */
        .lp-nav {
            padding: 10px 20px;
            display: flex;
            align-items: center;
            justify-content: space-between;
            border-bottom: 1px solid rgba(0, 0, 0, 0.06);
            transition: background 0.4s;
        }

        .lp-logo {
            font-size: 13px;
            font-weight: 800;
            transition: color 0.4s;
        }

        .lp-nav-links {
            display: flex;
            gap: 14px;
        }

        .lp-nav-link {
            font-size: 10px;
            color: #6b7280;
        }

        .lp-nav-cta {
            font-size: 10px;
            font-weight: 700;
            padding: 5px 12px;
            border-radius: 6px;
            color: white;
            transition: background 0.4s;
        }

        .lp-hero {
            padding: 48px 40px;
            text-align: center;
            transition: background 0.4s;
            position: relative;
            overflow: hidden;
        }

        .lp-hero-badge {
            display: inline-flex;
            align-items: center;
            gap: 5px;
            font-size: 10px;
            font-weight: 700;
            padding: 3px 10px;
            border-radius: 20px;
            margin-bottom: 12px;
            transition: all 0.4s;
        }

        .lp-hero-title {
            font-size: 24px;
            font-weight: 900;
            line-height: 1.1;
            letter-spacing: -0.02em;
            margin-bottom: 10px;
            transition: color 0.4s;
            font-family: 'Instrument Serif', serif;
        }

        .lp-hero-sub {
            font-size: 12px;
            color: #6b7280;
            margin-bottom: 20px;
            line-height: 1.5;
        }

        .lp-hero-btns {
            display: flex;
            gap: 8px;
            justify-content: center;
        }

        .lp-hero-btn-primary {
            font-size: 11px;
            font-weight: 700;
            padding: 8px 18px;
            border-radius: 8px;
            color: white;
            transition: background 0.4s, box-shadow 0.4s;
        }

        .lp-hero-btn-secondary {
            font-size: 11px;
            font-weight: 600;
            padding: 8px 18px;
            border-radius: 8px;
            border: 1.5px solid;
            transition: all 0.4s;
            background: transparent;
        }

        /* Hero bg grid */
        .lp-hero::before {
            content: '';
            position: absolute;
            inset: 0;
            background-image: linear-gradient(rgba(0, 0, 0, 0.04) 1px, transparent 1px),
                linear-gradient(90deg, rgba(0, 0, 0, 0.04) 1px, transparent 1px);
            background-size: 32px 32px;
            pointer-events: none;
        }

        .lp-services {
            padding: 32px 32px 24px;
            transition: background 0.4s;
        }

        .lp-services-title {
            font-size: 16px;
            font-weight: 800;
            text-align: center;
            margin-bottom: 16px;
            color: #1e1e2e;
            font-family: 'Instrument Serif', serif;
        }

        .lp-cards {
            display: grid;
            grid-template-columns: repeat(3, 1fr);
            gap: 10px;
        }

        .lp-card {
            padding: 14px;
            border-radius: 10px;
            border: 1px solid rgba(0, 0, 0, 0.07);
            transition: all 0.4s;
        }

        .lp-card-icon {
            width: 28px;
            height: 28px;
            border-radius: 7px;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 14px;
            margin-bottom: 8px;
            transition: background 0.4s;
        }

        .lp-card-title {
            font-size: 10px;
            font-weight: 700;
            color: #1e1e2e;
            margin-bottom: 4px;
        }

        .lp-card-text {
            font-size: 9px;
            color: #9ca3af;
            line-height: 1.4;
        }

        .lp-testimonials {
            padding: 24px 32px;
            transition: background 0.4s;
        }

        .lp-testi-title {
            font-size: 14px;
            font-weight: 800;
            text-align: center;
            margin-bottom: 12px;
            color: #1e1e2e;
            font-family: 'Instrument Serif', serif;
        }

        .lp-testi-grid {
            display: grid;
            grid-template-columns: repeat(2, 1fr);
            gap: 8px;
        }

        .lp-testi-card {
            padding: 12px;
            border-radius: 9px;
            border: 1px solid rgba(0, 0, 0, 0.07);
            background: white;
        }

        .lp-testi-text {
            font-size: 9px;
            color: #374151;
            line-height: 1.5;
            margin-bottom: 8px;
            font-style: italic;
        }

        .lp-testi-author {
            font-size: 9px;
            font-weight: 700;
            color: #1e1e2e;
        }

        .lp-cta-band {
            padding: 28px;
            text-align: center;
            transition: background 0.4s;
        }

        .lp-cta-title {
            font-size: 16px;
            font-weight: 800;
            color: white;
            margin-bottom: 6px;
            font-family: 'Instrument Serif', serif;
        }

        .lp-cta-sub {
            font-size: 11px;
            color: rgba(255, 255, 255, 0.7);
            margin-bottom: 14px;
        }

        .lp-cta-btn {
            display: inline-block;
            padding: 8px 20px;
            border-radius: 8px;
            font-size: 11px;
            font-weight: 700;
            background: white;
            transition: all 0.4s;
        }

        .lp-footer {
            padding: 14px 24px;
            display: flex;
            align-items: center;
            justify-content: space-between;
            border-top: 1px solid rgba(0, 0, 0, 0.06);
            transition: background 0.4s;
        }

        .lp-footer-copy {
            font-size: 9px;
            color: #9ca3af;
        }

        .lp-footer-dots {
            display: flex;
            gap: 5px;
        }

        .lp-footer-dot {
            width: 7px;
            height: 7px;
            border-radius: 50%;
            transition: background 0.4s;
        }

        /* Overlay para bloques desactivados */
        .lp-section-wrap {
            position: relative;
            transition: opacity 0.3s;
        }

        .lp-section-wrap.hidden-block {
            opacity: 0.2;
            pointer-events: none;
        }

        .lp-section-wrap.selected-block::before {
            content: '';
            position: absolute;
            inset: 0;
            border: 2px solid rgba(124, 111, 247, 0.6);
            pointer-events: none;
            z-index: 10;
            border-radius: 2px;
        }

        .lp-block-label {
            position: absolute;
            top: 4px;
            left: 4px;
            background: rgba(124, 111, 247, 0.9);
            color: white;
            font-size: 9px;
            font-weight: 700;
            padding: 2px 7px;
            border-radius: 4px;
            z-index: 11;
            opacity: 0;
            transition: opacity 0.15s;
            pointer-events: none;
        }

        .lp-section-wrap:hover .lp-block-label {
            opacity: 1;
        }

        /* ─────────────────────────────────────────
   BLOCK EDIT PANEL (slide in)
───────────────────────────────────────── */
        .edit-panel {
            position: fixed;
            top: 56px;
            right: 0;
            bottom: 0;
            width: 320px;
            background: var(--bg-2);
            border-left: 1px solid var(--border-2);
            transform: translateX(100%);
            transition: transform 0.25s cubic-bezier(0.4, 0, 0.2, 1);
            z-index: 40;
            display: flex;
            flex-direction: column;
            box-shadow: -8px 0 32px rgba(0, 0, 0, 0.3);
        }

        .edit-panel.open {
            transform: translateX(0);
        }

        .edit-panel-header {
            padding: 14px 16px;
            border-bottom: 1px solid var(--border);
            display: flex;
            align-items: center;
            justify-content: space-between;
        }

        .edit-panel-title {
            font-size: 14px;
            font-weight: 700;
        }

        .edit-panel-body {
            flex: 1;
            overflow-y: auto;
            padding: 16px;
            scrollbar-width: thin;
            scrollbar-color: var(--bg-4) transparent;
        }

        .field-group {
            margin-bottom: 16px;
        }

        .field-label {
            font-size: 11px;
            font-weight: 600;
            color: var(--text-2);
            margin-bottom: 6px;
            display: block;
        }

        .field-input {
            width: 100%;
            background: var(--bg-3);
            border: 1px solid var(--border-2);
            border-radius: 8px;
            padding: 8px 10px;
            font-size: 12px;
            color: var(--text);
            font-family: inherit;
            resize: none;
            outline: none;
            transition: border-color 0.15s;
        }

        .field-input:focus {
            border-color: var(--primary);
        }

        .field-textarea {
            min-height: 72px;
        }

        /* ─────────────────────────────────────────
   MISC
───────────────────────────────────────── */
        .divider {
            height: 1px;
            background: var(--border);
            margin: 16px 0;
        }

        .badge {
            font-size: 10px;
            font-weight: 600;
            padding: 2px 7px;
            border-radius: 20px;
        }

        .badge-new {
            background: rgba(124, 111, 247, 0.15);
            color: var(--primary-2);
        }

        /* Drag ghost */
        .dragging {
            opacity: 0.4;
        }

        /* ─────────────────────────────────────────
   ANIMATIONS
───────────────────────────────────────── */
        @keyframes fadeInUp {
            from {
                opacity: 0;
                transform: translateY(10px);
            }

            to {
                opacity: 1;
                transform: translateY(0);
            }
        }

        .anim-in {
            animation: fadeInUp 0.3s ease both;
        }
    \n</style>

    <!-- ══════════════════════════════════
         TOPBAR
    ══════════════════════════════════ -->
    <header class="topbar">
        <div class="topbar-left">
            <a href="{{ route('dashboard') }}" class="topbar-logo text-slate-700 hover:text-slate-900 transition-colors">
                <div class="topbar-logo-mark" style="background:{{ $colorPrimary }}">
                    <svg width="14" height="14" fill="none" stroke="white" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round" viewBox="0 0 24 24">
                        <path d="M13 2 3 14h9l-1 8 10-12h-9z" />
                    </svg>
                </div>
                SaaSFlow
            </a>
            <div class="topbar-sep"></div>
            <span class="topbar-title">Landing Page</span>
        </div>

        <div class="topbar-right">
            <span class="status-pill {{ $status === 'published' ? 'live' : '' }}">
                <span class="status-dot {{ $status === 'published' ? 'pulse' : '' }}"></span>
                <span>{{ $status === 'published' ? 'En vivo' : 'Borrador' }}</span>
            </span>
            <a href="{{ route('tenant.landing.preview', ['preview' => 'true']) }}" target="_blank" class="btn btn-ghost btn-sm">
                <svg width="13" height="13" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                    <path d="M18 13v6a2 2 0 01-2 2H5a2 2 0 01-2-2V8a2 2 0 012-2h6" />
                    <polyline points="15 3 21 3 21 9" />
                    <line x1="10" y1="14" x2="21" y2="3" />
                </svg>
                Vista previa
            </a>
            <button class="btn btn-success btn-sm" wire:click="togglePublish"
                    @if($status === 'published')
                        style="background: rgba(239, 68, 68, 0.12); color: #dc2626; border-color: rgba(239, 68, 68, 0.25);"
                    @endif
            >
                @if($status === 'published')
                    <svg width="13" height="13" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                        <path d="M18.364 18.364A9 9 0 005.636 5.636m12.728 12.728A9 9 0 015.636 5.636m12.728 12.728L5.636 5.636" />
                    </svg>
                    <span>Despublicar</span>
                @else
                    <svg width="13" height="13" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                        <path d="M5 12l5 5L20 7" />
                    </svg>
                    <span>Publicar</span>
                @endif
            </button>
        </div>
    </header>

    <!-- ══════════════════════════════════
         MAIN
    ══════════════════════════════════ -->
    <div class="main-layout">

        <!-- ──────────────────────────────
             SIDEBAR
        ────────────────────────────────── -->
        <aside class="sidebar">
            <nav class="sidebar-tabs">
                @foreach([
                    'template' => ['label' => 'Plantilla', 'icon' => '<rect x="3" y="3" width="7" height="7" /><rect x="14" y="3" width="7" height="7" /><rect x="14" y="14" width="7" height="7" /><rect x="3" y="14" width="7" height="7" />'],
                    'sections' => ['label' => 'Secciones', 'icon' => '<line x1="8" y1="6" x2="21" y2="6" /><line x1="8" y1="12" x2="21" y2="12" /><line x1="8" y1="18" x2="21" y2="18" /><line x1="3" y1="6" x2="3.01" y2="6" /><line x1="3" y1="12" x2="3.01" y2="12" /><line x1="3" y1="18" x2="3.01" y2="18" />'],
                    'style'    => ['label' => 'Estilo',    'icon' => '<circle cx="13.5" cy="6.5" r=".5" fill="currentColor" /><circle cx="17.5" cy="10.5" r=".5" fill="currentColor" /><circle cx="8.5" cy="7.5" r=".5" fill="currentColor" /><circle cx="6.5" cy="12.5" r=".5" fill="currentColor" /><path d="M12 2C6.5 2 2 6.5 2 12s4.5 10 10 10c.926 0 1.648-.746 1.648-1.688 0-.437-.18-.835-.437-1.125-.29-.289-.438-.652-.438-1.125a1.64 1.64 0 011.668-1.668h1.996c3.051 0 5.555-2.503 5.555-5.554C21.965 6.012 17.461 2 12 2z" />'],
                ] as $tab => $data)
                    <button class="sidebar-tab {{ $activeTab === $tab ? 'active' : '' }}" wire:click="$set('activeTab', '{{ $tab }}')">
                        <svg width="13" height="13" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                            {!! $data['icon'] !!}
                        </svg>
                        {{ $data['label'] }}
                    </button>
                @endforeach
            </nav>

            <!-- ── TAB: PLANTILLA ── -->
            @if($activeTab === 'template')
            <div class="sidebar-body">
                <p class="section-label">Elige tu plantilla base</p>

                <div class="templates-grid">
                    @foreach($this->availableTemplates as $tpl)
                    <div class="template-card {{ $templateKey === $tpl['key'] ? 'selected' : '' }}"
                         wire:click="selectTemplate('{{ $tpl['key'] }}')"
                         @if($templateKey !== $tpl['key'])
                             wire:confirm="¿Cambiar plantilla? Se reemplazarán las secciones actuales."
                         @endif
                    >
                        <div class="template-thumb" style="background: white;">
                             @switch($tpl['key'])
                                @case('corporate')
                                <div class="w-full h-full flex flex-col" style="background:#f8fafc">
                                    <div class="flex items-center gap-1 px-2 py-1.5" style="background:white; border-bottom:1px solid #e5e7eb">
                                        <div class="h-1 w-6 rounded-full" style="background:{{ $colorPrimary }}"></div>
                                        <div class="flex-1"></div>
                                        <div class="h-1.5 w-4 rounded-sm" style="background:{{ $colorPrimary }}"></div>
                                    </div>
                                    <div class="flex-1 flex flex-col items-center justify-center gap-1 px-3" style="background:linear-gradient(135deg,{{ $colorPrimary }}08,white)">
                                        <div class="h-1.5 w-3/5 rounded-full bg-gray-800"></div>
                                        <div class="h-1 w-4/5 rounded-full bg-gray-300"></div>
                                        <div class="h-2 w-8 rounded-md mt-1" style="background:{{ $colorPrimary }}"></div>
                                    </div>
                                    <div class="grid grid-cols-3 gap-1 p-2">
                                        @for($i=0;$i<3;$i++)<div class="h-4 rounded" style="background:white;border:1px solid #e5e7eb"></div>@endfor
                                    </div>
                                </div>
                                @break
                                @case('visual')
                                <div class="w-full h-full relative" style="background:linear-gradient(135deg,#1a1a2e,#16213e)">
                                    <div class="absolute inset-0 opacity-70" style="background:url('https://images.unsplash.com/photo-1414235077428-338989a2e8c0?w=300&q=50') center/cover"></div>
                                    <div class="absolute inset-0 flex flex-col justify-end p-2" style="background:linear-gradient(to top,rgba(0,0,0,0.8),transparent)">
                                        <div class="h-1.5 w-3/4 rounded-full bg-white mb-1"></div>
                                        <div class="h-1 w-1/2 rounded-full mb-2" style="background:rgba(255,255,255,0.4)"></div>
                                        <div class="h-2 w-8 rounded-md" style="background:{{ $colorAccent }}"></div>
                                    </div>
                                </div>
                                @break
                                @case('conversion')
                                <div class="w-full h-full flex flex-col" style="background:#fafafa">
                                    <div class="flex items-center justify-between px-2 py-1.5" style="background:{{ $colorPrimary }}">
                                        <div class="h-1 w-5 rounded-full" style="background:#cbd5e1"></div>
                                        <div class="h-2 w-5 rounded-sm" style="background:{{ $colorAccent }}"></div>
                                    </div>
                                    <div class="flex-1 flex flex-col items-center justify-center gap-1 px-3">
                                        <div class="h-1.5 w-1/2 rounded-full" style="background:#1e1e2e"></div>
                                        <div class="h-1 w-3/4 rounded-full bg-gray-300"></div>
                                        <div class="h-2 w-10 rounded-md mt-1" style="background:{{ $colorPrimary }}"></div>
                                    </div>
                                </div>
                                @break
                                @case('catalog')
                                <div class="w-full h-full flex flex-col" style="background:#f0fdf4">
                                    <div class="flex items-center gap-1 px-2 py-1" style="background:white; border-bottom:1px solid #dcfce7">
                                        <div class="h-1 w-5 rounded-full" style="background:#16a34a"></div>
                                        <div class="flex-1 h-1 rounded-full" style="background:#dcfce7"></div>
                                    </div>
                                    <div class="grid grid-cols-3 gap-1 p-2 flex-1">
                                        @for($i=0;$i<6;$i++)
                                        <div class="rounded flex flex-col p-1" style="background:white; border:1px solid #dcfce7">
                                            <div class="h-3 w-full rounded mb-1" style="background:#dcfce7"></div>
                                            <div class="h-1 w-3/5 rounded" style="background:#9ca3af"></div>
                                        </div>
                                        @endfor
                                    </div>
                                </div>
                                @break
                                @case('storytelling')
                                <div class="w-full h-full flex items-center gap-3 px-3" style="background:#fffbeb">
                                    <div class="size-9 rounded-full flex-shrink-0" style="background:linear-gradient(135deg,#f59e0b,#d97706)"></div>
                                    <div class="flex-1">
                                        <div class="h-1.5 w-3/4 rounded-full mb-1" style="background:#1e1e2e"></div>
                                        <div class="h-1 w-full rounded-full mb-2 bg-gray-300"></div>
                                        <div class="h-2 w-8 rounded-md" style="background:#f59e0b"></div>
                                    </div>
                                </div>
                                @break
                                @default
                                <div class="w-full h-full flex flex-col items-center justify-center gap-2" style="background:white">
                                    <div class="h-2 w-1/2 rounded-full" style="background:#1e1e2e"></div>
                                    <div class="h-1 w-3/4 rounded-full bg-gray-300"></div>
                                    <div class="h-2 w-8 rounded-md mt-1" style="background:#475569"></div>
                                </div>
                            @endswitch
                        </div>

                        <div class="template-overlay">
                            <p class="template-label">{{ $tpl['name'] }}</p>
                            <p class="template-sub">{{ $tpl['vibe'] ?? ($tpl['description'] ?? '') }}</p>
                        </div>

                        <div class="template-check">
                            <svg width="10" height="10" fill="none" stroke="white" stroke-width="3" viewBox="0 0 24 24">
                                <path d="M5 13l4 4L19 7" />
                            </svg>
                        </div>
                    </div>
                    @endforeach
                </div>

                <div class="divider"></div>

                <p class="section-label">Plantilla activa</p>
                <div style="padding:12px;background:var(--bg-3);border-radius:var(--radius);border:1px solid var(--border);display:flex;align-items:center;gap:10px;">
                    <div style="width:36px;height:36px;border-radius:9px;background:rgba(99,102,241,0.15);display:flex;align-items:center;justify-content:center;">
                        <svg width="18" height="18" fill="none" stroke="var(--primary-2)" stroke-width="2" viewBox="0 0 24 24">
                            <rect x="3" y="3" width="7" height="7" />
                            <rect x="14" y="3" width="7" height="7" />
                            <rect x="14" y="14" width="7" height="7" />
                            <rect x="3" y="14" width="7" height="7" />
                        </svg>
                    </div>
                    <div>
                        <p style="font-size:13px;font-weight:700;">
                            {{ collect($this->availableTemplates)->firstWhere('key', $templateKey)['name'] ?? $templateKey }}
                        </p>
                        <p style="font-size:11px;color:var(--text-3);">Plantilla activa</p>
                    </div>
                    <span class="badge badge-new" style="margin-left:auto;">Activa</span>
                </div>
            </div>
            @endif

            <!-- ── TAB: SECCIONES ── -->
            @if($activeTab === 'sections')
            <div class="sidebar-body">
                <p class="section-label">Secciones de la página</p>
                <p style="font-size:11px;color:var(--text-3);margin-bottom:14px;">Arrastra para reordenar · activa/desactiva con el toggle</p>

                <div class="blocks-list" id="sortable-list">
                    @foreach($this->blocks as $block)
                    <div class="block-item {{ $selectedBlockId === $block->id ? 'selected' : '' }} {{ !$block->is_active ? 'disabled' : '' }}"
                         wire:key="block-{{ $block->id }}"
                         draggable="true"
                         x-on:dragstart="dragId = {{ $block->id }}"
                         x-on:dragend="dragId = null"
                         x-on:dragover.prevent
                         x-on:drop.prevent="
                            const ids = [...document.querySelectorAll('[data-block]')].map(el => +el.dataset.block);
                            $wire.reorderFromDrag(ids)
                         "
                         data-block="{{ $block->id }}"
                         wire:click="$set('selectedBlockId', {{ $selectedBlockId === $block->id ? 'null' : $block->id }})"
                    >
                        <!-- Drag handle -->
                        <div class="block-drag text-gray-400">
                            <svg width="14" height="14" fill="currentColor" viewBox="0 0 24 24">
                                <circle cx="9" cy="5" r="1.5" />
                                <circle cx="15" cy="5" r="1.5" />
                                <circle cx="9" cy="12" r="1.5" />
                                <circle cx="15" cy="12" r="1.5" />
                                <circle cx="9" cy="19" r="1.5" />
                                <circle cx="15" cy="19" r="1.5" />
                            </svg>
                        </div>

                        <!-- Icon -->
                        <div class="block-icon" style="background: {{ $block->getColorHex() }}20">
                            <span>{{ $block->getEmoji() }}</span>
                        </div>

                        <!-- Name -->
                        <div style="flex:1;min-width:0;">
                            <p class="block-name truncate" style="line-height:1.2;">{{ $block->getLabel() }}</p>
                            <p class="block-tag truncate">{{ $block->getTag() }}</p>
                        </div>

                        <!-- Toggle -->
                        <label class="toggle" x-on:click.stop>
                            <input type="checkbox"
                                   {{ $block->is_active ? 'checked' : '' }}
                                   wire:click.stop="toggleBlock({{ $block->id }})">
                            <div class="toggle-track"></div>
                            <div class="toggle-thumb"></div>
                        </label>

                        <!-- Edit -->
                        <button class="block-edit" wire:click.stop="openEditPanel({{ $block->id }})">
                            <svg width="10" height="10" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24" style="display:inline-block; margin-right:2px; transform:translateY(-1px);">
                                <path d="M11 4H4a2 2 0 00-2 2v14a2 2 0 002 2h14a2 2 0 002-2v-7" />
                                <path d="M18.5 2.5a2.121 2.121 0 013 3L12 15l-4 1 1-4 9.5-9.5z" />
                            </svg>
                            Editar
                        </button>
                    </div>
                    @endforeach
                </div>

                <button class="add-block-btn" wire:click="$set('activeTab', 'style')">
                    <svg width="14" height="14" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                        <line x1="12" y1="5" x2="12" y2="19" />
                        <line x1="5" y1="12" x2="19" y2="12" />
                    </svg>
                    Añadir nueva sección
                </button>
            </div>
            @endif

            <!-- ── TAB: ESTILO ── -->
            @if($activeTab === 'style')
            <div class="sidebar-body">

                <!-- Site name -->
                <div class="style-section">
                    <span class="style-label mb-2 block">Nombre del sitio</span>
                    <input wire:model.blur="siteName" type="text"
                           class="w-full text-sm font-semibold rounded-lg border-2 border-gray-200 focus:border-indigo-500 focus:ring-0 px-3 py-2 text-slate-800"
                           placeholder="MiEmpresa">
                </div>
                <div class="divider"></div>

                <!-- Colors -->
                <div class="style-section">
                    <p class="section-label">Colores</p>

                    @foreach([
                        ['prop' => 'colorPrimary', 'alpine' => 'primary', 'presets' => 'primaryPresets', 'label' => '🎨 Color de marca',  'hint' => 'Botones · CTA'],
                        ['prop' => 'colorNeutral', 'alpine' => 'neutral', 'presets' => 'neutralPresets', 'label' => '🖼️ Color base',      'hint' => 'Fondos · Bordes'],
                        ['prop' => 'colorAccent',  'alpine' => 'accent',  'presets' => 'accentPresets',  'label' => '✨ Acento',           'hint' => 'Badges · Highlights'],
                    ] as $c)
                    <div style="margin-bottom:10px;">
                        <div style="display:flex;align-items:center;justify-content:space-between;margin-bottom:6px;">
                            <span class="style-label">{{ $c['label'] }}</span>
                            <span style="font-size:10px;color:var(--text-3);">{{ $c['hint'] }}</span>
                        </div>
                        <div class="color-picker-row" @click="activePicker = activePicker === '{{ $c['alpine'] }}' ? null : '{{ $c['alpine'] }}'">
                            <div class="color-swatch-lg" style="background:{{ ${'color'.ucfirst($c['alpine'])} }}; {{ $c['alpine'] === 'neutral' ? 'border:1px solid rgba(0,0,0,0.1)' : '' }}"></div>
                            <span class="color-hex">{{ strtoupper(${'color'.ucfirst($c['alpine'])}) }}</span>
                            <svg class="color-caret" width="14" height="14" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                                <path d="M6 9l6 6 6-6" />
                            </svg>
                        </div>
                        <div x-show="activePicker==='{{ $c['alpine'] }}'" x-transition class="color-presets">
                            <template x-for="color in {{ $c['presets'] }}" :key="color">
                                <div class="color-preset" :class="{active: '{{ ${'color'.ucfirst($c['alpine'])} }}' === color}"
                                     :style="'background:' + color + ';' + ('{{ $c['alpine'] }}' === 'neutral' ? 'border:1px solid rgba(0,0,0,0.1)' : '')"
                                     @click="$wire.set('{{ $c['prop'] }}', color); activePicker=null"></div>
                            </template>
                            <input type="color" value="{{ ${'color'.ucfirst($c['alpine'])} }}" @input="$wire.set('{{ $c['prop'] }}', $event.target.value)"
                                   style="width:22px;height:22px;border:none;border-radius:50%;cursor:pointer;padding:0;overflow:hidden;">
                        </div>
                    </div>
                    @endforeach
                </div>

                <div class="divider"></div>

                <!-- Font -->
                <div class="style-section">
                    <p class="section-label">Tipografía</p>
                    <div class="font-grid">
                        @foreach([
                            ['key' => 'instrument', 'name' => 'Instrument', 'family' => "Instrument Serif, serif", 'sample' => 'Aa'],
                            ['key' => 'slab',       'name' => 'Roboto Slab', 'family' => "Georgia, serif", 'sample' => 'Aa'],
                            ['key' => 'sans',       'name' => 'DM Sans', 'family' => "DM Sans, sans-serif", 'sample' => 'Aa'],
                            ['key' => 'mono',       'name' => 'Mono', 'family' => "DM Mono, monospace", 'sample' => 'Aa'],
                        ] as $font)
                        <div class="font-option {{ $fontFamily === $font['key'] ? 'active' : '' }}" wire:click="$set('fontFamily', '{{ $font['key'] }}')">
                            <div class="font-option-name" style="font-family:'{{ $font['family'] }}'">{{ $font['sample'] }}</div>
                            <div class="font-option-sub">{{ $font['name'] }}</div>
                        </div>
                        @endforeach
                    </div>
                </div>

                <div class="divider"></div>

                <!-- Bg mode -->
                <div class="style-section">
                    <p class="section-label">Estilo de fondo</p>
                    <div class="bg-mode-row">
                        @foreach([
                            ['key' => 'light', 'icon' => '☀️', 'label' => 'Claro'],
                            ['key' => 'soft',  'icon' => '🌤️', 'label' => 'Suave'],
                            ['key' => 'dark',  'icon' => '🌙', 'label' => 'Oscuro'],
                        ] as $m)
                        <div class="bg-mode-option {{ $bgMode === $m['key'] ? 'active' : '' }}" wire:click="$set('bgMode', '{{ $m['key'] }}')">
                            <div class="bg-mode-icon">{{ $m['icon'] }}</div>
                            <div class="bg-mode-label">{{ $m['label'] }}</div>
                        </div>
                        @endforeach
                    </div>
                </div>

                <div class="divider"></div>

                <!-- Quick palettes -->
                <div class="style-section">
                    <p class="section-label">Paletas listas</p>
                    <div style="display:grid;grid-template-columns:1fr 1fr;gap:6px;">
                        <template x-for="p in quickPalettes" :key="p.name">
                            <button @click="$wire.applyPalette(p.primary, p.neutral, p.accent)"
                                    style="padding:10px;border-radius:10px;border:1px solid;cursor:pointer;text-align:left;transition:all 0.15s;display:flex;align-items:center;gap:8px;"
                                    :style="{
                                        borderColor: ('{{ $colorPrimary }}' === p.primary && '{{ $colorNeutral }}' === p.neutral && '{{ $colorAccent }}' === p.accent) ? p.primary + '80' : 'var(--border)',
                                        background: ('{{ $colorPrimary }}' === p.primary && '{{ $colorNeutral }}' === p.neutral && '{{ $colorAccent }}' === p.accent) ? p.primary + '15' : 'var(--bg-3)',
                                    }">
                                <div style="display:flex;gap:2px;flex-shrink:0;">
                                    <div style="width:12px;height:28px;border-radius:4px 0 0 4px;" :style="'background:' + p.primary"></div>
                                    <div style="width:12px;height:28px;" :style="'background:' + p.neutral + ';border:1px solid rgba(0,0,0,0.08);'"></div>
                                    <div style="width:12px;height:28px;border-radius:0 4px 4px 0;" :style="'background:' + p.accent"></div>
                                </div>
                                <div>
                                    <p style="font-size:11px;font-weight:700;color:var(--text);" x-text="p.name"></p>
                                    <p style="font-size:10px;color:var(--text-3);" x-text="p.vibe"></p>
                                </div>
                            </button>
                        </template>
                    </div>
                </div>

            </div>
            @endif

            <!-- Footer -->
            <div class="sidebar-footer">
                <button class="btn btn-ghost" style="flex:1;" wire:click="$set('colorPrimary', collect(['#6366f1','#0ea5e9','#22c55e','#db2777','#7c3aed','#dc2626'])->random())">
                    <svg width="14" height="14" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                        <polyline points="16 3 21 3 21 8" />
                        <line x1="4" y1="20" x2="21" y2="3" />
                        <polyline points="21 16 21 21 16 21" />
                        <line x1="15" y1="15" x2="21" y2="21" />
                    </svg>
                    Aleatorio
                </button>
                <button class="btn btn-primary" style="flex:2;" wire:click="saveAll">
                    <svg width="14" height="14" fill="none" stroke="white" stroke-width="2.5" viewBox="0 0 24 24" wire:loading.remove wire:target="saveAll">
                        <path d="M20 6L9 17l-5-5" />
                    </svg>
                    <span wire:loading.remove wire:target="saveAll">Guardar cambios</span>
                    <span wire:loading wire:target="saveAll">Guardando...</span>
                </button>
            </div>
        </aside>

        <!-- ──────────────────────────────
             CANVAS
        ────────────────────────────────── -->
        <div class="canvas-panel">
            <div class="canvas-toolbar">
                <div class="viewport-switcher">
                    @foreach(['desktop' => ['Escritorio', '<rect x="2" y="3" width="20" height="14" rx="2" /><line x1="8" y1="21" x2="16" y2="21" /><line x1="12" y1="17" x2="12" y2="21" />'],
                               'tablet' => ['Tablet', '<rect x="4" y="2" width="16" height="20" rx="2" /><line x1="12" y1="18" x2="12.01" y2="18" />'],
                               'mobile' => ['Móvil', '<rect x="5" y="2" width="14" height="20" rx="2" /><line x1="12" y1="18" x2="12.01" y2="18" />']] as $vp => $data)
                    <button class="viewport-btn {{ $viewport === $vp ? 'active' : '' }}" wire:click="$set('viewport', '{{ $vp }}')">
                        <svg width="13" height="13" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                            {!! $data[1] !!}
                        </svg>
                        {{ $data[0] }}
                    </button>
                    @endforeach
                </div>

                <div class="canvas-info">
                    Template: <span>{{ collect($this->availableTemplates)->firstWhere('key', $templateKey)['name'] ?? $templateKey }}</span>
                    ·
                    <span>{{ $this->blocks->where('is_active', true)->count() }} secciones activas</span>
                </div>

                <div style="display:flex;gap:6px;">
                    <button class="btn btn-ghost btn-sm btn-icon" title="Zoom out" onclick="document.querySelector('.canvas-area').style.zoom = '0.7'">
                        <svg width="14" height="14" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                            <circle cx="11" cy="11" r="8" />
                            <line x1="21" y1="21" x2="16.65" y2="16.65" />
                            <line x1="8" y1="11" x2="14" y2="11" />
                        </svg>
                    </button>
                    <button class="btn btn-ghost btn-sm btn-icon" title="Centrar" onclick="document.querySelector('.canvas-area').style.zoom = '1'">
                        <svg width="14" height="14" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                            <path d="M8 3H5a2 2 0 00-2 2v3m18 0V5a2 2 0 00-2-2h-3m0 18h3a2 2 0 002-2v-3M3 16v3a2 2 0 002 2h3" />
                        </svg>
                    </button>
                </div>
            </div>

            <!-- Canvas -->
            <div class="canvas-area">
                <div class="preview-window {{ $viewport }}">

                    <!-- Browser chrome -->
                    <div class="browser-chrome">
                        <div class="chrome-dots">
                            <div class="chrome-dot" style="background:#ff5f56;"></div>
                            <div class="chrome-dot" style="background:#ffbd2e;"></div>
                            <div class="chrome-dot" style="background:#27c93f;"></div>
                        </div>
                        <div class="chrome-url">https://{{ strtolower(preg_replace('/s+/', '', $siteName ?: 'miempresa')) }}.saasflow.io</div>
                    </div>

                    <!-- Live preview bloques -->
                    @include('components.tenant.landing.live-preview', [
                        'blocks'         => $this->blocks,
                        'colorPrimary'   => $colorPrimary,
                        'colorNeutral'   => $colorNeutral,
                        'colorAccent'    => $colorAccent,
                        'bgMode'         => $bgMode,
                        'siteName'       => $siteName,
                        'selectedBlockId'=> $selectedBlockId,
                    ])

                </div>
            </div>
        </div>
    </div>

    <!-- ══════════════════════════════════
         EDIT PANEL (slide-in)
    ══════════════════════════════════ -->
    <div class="edit-panel {{ $editPanelOpen ? 'open' : '' }}">
        <div class="edit-panel-header">
            <p class="edit-panel-title">
                @if($this->editingBlock){{ $this->editingBlock->getEmoji() }} {{ $this->editingBlock->getLabel() }}@endif
            </p>
            <button class="btn btn-ghost btn-sm btn-icon" wire:click="closeEditPanel">
                <svg width="14" height="14" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                    <path d="M18 6L6 18M6 6l12 12" />
                </svg>
            </button>
        </div>
        <div class="edit-panel-body bg-white text-gray-800">
            @if($this->editingBlock)
                @includeIf('livewire.tenant.landing.block-settings.' . $this->editingBlock->block_type, [
                    'block'    => $this->editingBlock,
                    'settings' => $editingSettings,
                ])
            @endif
        </div>
        {{-- Save --}}
        <div class="p-4 flex-shrink-0" style="border-top:1px solid #e2e8f0; background:white">
            <button wire:click="saveEditingBlock"
                    class="w-full py-2.5 rounded-xl text-sm font-bold text-white transition-all hover:opacity-90"
                    style="background:{{ $colorPrimary }}">
                Guardar sección
            </button>
        </div>
    </div>

    {{-- Backdrop --}}
    @if($editPanelOpen)
    <div class="fixed inset-0 z-30 bg-black/20" wire:click="closeEditPanel"></div>
    @endif

    <!-- ══════════════════════════════════
         TOAST
    ══════════════════════════════════ -->
    <div x-data="{ show:false, msg:'', type:'success' }"
         @notify.window="show=true; msg=$event.detail.message; type=$event.detail.type; setTimeout(()=>show=false,2800)"
         x-show="show" transition
         class="anim-in"
         style="display:none; position:fixed;bottom:24px;left:50%;transform:translateX(-50%);background:white;border:1px solid rgba(0,0,0,0.12);color:var(--text);padding:10px 20px;border-radius:12px;font-size:13px;font-weight:600;z-index:100;align-items:center;gap:8px;box-shadow:0 8px 32px rgba(0,0,0,0.1);">
        <span style="color:#10b981;" x-show="type==='success'">✓</span>
        <span x-text="msg"></span>
    </div>

</div><!-- end shell -->

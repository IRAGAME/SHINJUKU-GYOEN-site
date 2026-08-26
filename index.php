<!DOCTYPE html>
<html lang="fr">
<head>
<meta charset="utf-8"/>
<meta content="width=device-width, initial-scale=1.0" name="viewport"/>
<script>
    if (typeof navigator !== 'undefined' && navigator.onLine === false) {
        document.documentElement.classList.add('offline');
    }
    document.documentElement.classList.add('dark');
</script>
<link href="images/favicon.svg" rel="icon" type="image/svg+xml"/>
<title>Shinjuku Gyoen National Garden</title>
<link href="assets/fonts/fonts-body-local.css" rel="stylesheet"/>
<link href="assets/fonts/fonts-symbols-local.css" rel="stylesheet"/>
<script src="assets/js/tailwind.js"></script>
<script>window.tailwind = window.tailwind || {};</script>
<script id="tailwind-config">
        tailwind.config = {
            darkMode: "class",
            theme: {
                extend: {
                    "colors": {
                        "on-secondary-fixed-variant": "rgb(var(--on-secondary-fixed-variant) / <alpha-value>)",
                        "primary-fixed": "rgb(var(--primary-fixed) / <alpha-value>)",
                        "surface-bright": "rgb(var(--surface-bright) / <alpha-value>)",
                        "secondary": "rgb(var(--secondary) / <alpha-value>)",
                        "on-primary-container": "rgb(var(--on-primary-container) / <alpha-value>)",
                        "surface-variant": "rgb(var(--surface-variant) / <alpha-value>)",
                        "tertiary-fixed": "rgb(var(--tertiary-fixed) / <alpha-value>)",
                        "primary-container": "rgb(var(--primary-container) / <alpha-value>)",
                        "surface-container-high": "rgb(var(--surface-container-high) / <alpha-value>)",
                        "surface-container-low": "rgb(var(--surface-container-low) / <alpha-value>)",
                        "on-secondary-container": "rgb(var(--on-secondary-container) / <alpha-value>)",
                        "outline": "rgb(var(--outline) / <alpha-value>)",
                        "tertiary": "rgb(var(--tertiary) / <alpha-value>)",
                        "surface-container-lowest": "rgb(var(--surface-container-lowest) / <alpha-value>)",
                        "inverse-on-surface": "rgb(var(--inverse-on-surface) / <alpha-value>)",
                        "surface-dim": "rgb(var(--surface-dim) / <alpha-value>)",
                        "error": "rgb(var(--error) / <alpha-value>)",
                        "on-secondary-fixed": "rgb(var(--on-secondary-fixed) / <alpha-value>)",
                        "on-error": "rgb(var(--on-error) / <alpha-value>)",
                        "on-tertiary-fixed": "rgb(var(--on-tertiary-fixed) / <alpha-value>)",
                        "surface-tint": "rgb(var(--surface-tint) / <alpha-value>)",
                        "on-primary-fixed-variant": "rgb(var(--on-primary-fixed-variant) / <alpha-value>)",
                        "on-secondary": "rgb(var(--on-secondary) / <alpha-value>)",
                        "on-surface-variant": "rgb(var(--on-surface-variant) / <alpha-value>)",
                        "on-tertiary-fixed-variant": "rgb(var(--on-tertiary-fixed-variant) / <alpha-value>)",
                        "on-surface": "rgb(var(--on-surface) / <alpha-value>)",
                        "surface-container": "rgb(var(--surface-container) / <alpha-value>)",
                        "on-primary": "rgb(var(--on-primary) / <alpha-value>)",
                        "gold": "rgb(var(--gold) / <alpha-value>)",
                        "gold-light": "rgb(var(--gold-light) / <alpha-value>)",
                        "gold-dark": "rgb(var(--gold-dark) / <alpha-value>)",
                        "background": "rgb(var(--background) / <alpha-value>)",
                        "inverse-surface": "rgb(var(--inverse-surface) / <alpha-value>)",
                        "tertiary-container": "rgb(var(--tertiary-container) / <alpha-value>)",
                        "tertiary-fixed-dim": "rgb(var(--tertiary-fixed-dim) / <alpha-value>)",
                        "secondary-container": "rgb(var(--secondary-container) / <alpha-value>)",
                        "primary-fixed-dim": "rgb(var(--primary-fixed-dim) / <alpha-value>)",
                        "primary": "rgb(var(--primary) / <alpha-value>)",
                        "secondary-fixed-dim": "rgb(var(--secondary-fixed-dim) / <alpha-value>)",
                        "on-primary-fixed": "rgb(var(--on-primary-fixed) / <alpha-value>)",
                        "error-container": "rgb(var(--error-container) / <alpha-value>)",
                        "surface-container-highest": "rgb(var(--surface-container-highest) / <alpha-value>)",
                        "on-background": "rgb(var(--on-background) / <alpha-value>)",
                        "secondary-fixed": "rgb(var(--secondary-fixed) / <alpha-value>)",
                        "outline-variant": "rgb(var(--outline-variant) / <alpha-value>)",
                        "on-tertiary": "rgb(var(--on-tertiary) / <alpha-value>)",
                        "on-tertiary-container": "rgb(var(--on-tertiary-container) / <alpha-value>)",
                        "surface": "rgb(var(--surface) / <alpha-value>)",
                        "inverse-primary": "rgb(var(--inverse-primary) / <alpha-value>)",
                        "on-error-container": "rgb(var(--on-error-container) / <alpha-value>)"
                    },
                    "borderRadius": {
                        "DEFAULT": "0.125rem",
                        "lg": "0.25rem",
                        "xl": "0.5rem",
                        "full": "0.75rem"
                    },
                    "spacing": {
                        "section-gap": "120px",
                        "margin-tablet": "32px",
                        "gutter": "24px",
                        "unit": "8px",
                        "margin-mobile": "20px",
                        "container-max": "1440px",
                        "margin-desktop": "64px"
                    },
                    "fontFamily": {
                        "body-lg": ["Manrope"],
                        "headline-lg": ["Libre Caslon Text"],
                        "headline-lg-mobile": ["Libre Caslon Text"],
                        "body-md": ["Manrope"],
                        "display-lg": ["Libre Caslon Text"],
                        "headline-md": ["Libre Caslon Text"],
                        "label-sm": ["Manrope"]
                    },
                    "fontSize": {
                        "body-lg": ["18px", { "lineHeight": "28px", "fontWeight": "400" }],
                        "headline-lg": ["48px", { "lineHeight": "56px", "fontWeight": "400" }],
                        "headline-lg-mobile": ["32px", { "lineHeight": "40px", "fontWeight": "400" }],
                        "body-md": ["16px", { "lineHeight": "24px", "fontWeight": "400" }],
                        "display-lg": ["84px", { "lineHeight": "92px", "letterSpacing": "-0.02em", "fontWeight": "400" }],
                        "headline-md": ["32px", { "lineHeight": "40px", "fontWeight": "400" }],
                        "label-sm": ["12px", { "lineHeight": "16px", "letterSpacing": "0.1em", "fontWeight": "600" }]
                    }
                }
            }
        }
    </script>
<style>
        :root {
            --on-secondary-fixed-variant: 99 59 69;
            --primary-fixed: 208 233 212;
            --surface-bright: 249 249 246;
            --secondary: 125 83 92;
            --on-primary-container: 129 153 134;
            --surface-variant: 226 227 224;
            --tertiary-fixed: 195 232 250;
            --primary-container: 27 48 34;
            --surface-container-high: 232 232 229;
            --surface-container-low: 244 244 241;
            --on-secondary-container: 122 80 89;
            --outline: 115 121 115;
            --tertiary: 0 26 36;
            --surface-container-lowest: 255 255 255;
            --inverse-on-surface: 241 241 238;
            --surface-dim: 218 218 215;
            --error: 186 26 26;
            --on-secondary-fixed: 49 17 26;
            --on-error: 255 255 255;
            --on-tertiary-fixed: 0 31 41;
            --surface-tint: 77 100 83;
            --on-primary-fixed-variant: 54 76 60;
            --on-secondary: 255 255 255;
            --on-surface-variant: 67 72 67;
            --on-tertiary-fixed-variant: 40 75 89;
            --on-surface: 26 28 27;
            --surface-container: 238 238 235;
            --on-primary: 255 255 255;
            --gold: 74 168 126;
            --gold-light: 143 214 180;
            --gold-dark: 47 107 79;
            --background: 249 249 246;
            --inverse-surface: 47 49 47;
            --tertiary-container: 6 48 61;
            --tertiary-fixed-dim: 168 204 221;
            --secondary-container: 254 198 209;
            --primary-fixed-dim: 180 205 184;
            --primary: 6 27 14;
            --secondary-fixed-dim: 239 184 195;
            --on-primary-fixed: 11 32 19;
            --error-container: 255 218 214;
            --surface-container-highest: 226 227 224;
            --on-background: 26 28 27;
            --secondary-fixed: 255 217 224;
            --outline-variant: 195 200 193;
            --on-tertiary: 255 255 255;
            --on-tertiary-container: 117 152 168;
            --surface: 249 249 246;
            --inverse-primary: 180 205 184;
            --on-error-container: 147 0 10;
        }
        .dark {
            --on-secondary-fixed-variant: 239 184 195;
            --primary-fixed: 208 233 212;
            --surface-bright: 56 58 55;
            --secondary: 239 184 195;
            --on-primary-container: 191 218 195;
            --surface-variant: 67 72 67;
            --tertiary-fixed: 195 232 250;
            --primary-container: 35 53 42;
            --surface-container-high: 41 44 41;
            --surface-container-low: 26 29 26;
            --on-secondary-container: 255 217 224;
            --outline: 141 147 141;
            --tertiary: 168 204 221;
            --surface-container-lowest: 13 15 13;
            --inverse-on-surface: 47 49 47;
            --surface-dim: 18 20 18;
            --error: 255 180 171;
            --on-secondary-fixed: 255 217 224;
            --on-error: 105 0 5;
            --on-tertiary-fixed: 195 232 250;
            --surface-tint: 180 205 184;
            --on-primary-fixed-variant: 207 233 211;
            --on-secondary: 73 39 50;
            --on-surface-variant: 195 200 193;
            --on-tertiary-fixed-variant: 195 232 250;
            --on-surface: 226 227 222;
            --surface-container: 30 33 30;
            --on-primary: 6 27 14;
            --gold: 88 183 137;
            --gold-light: 159 224 192;
            --gold-dark: 159 224 192;
            --background: 18 20 18;
            --inverse-surface: 226 227 222;
            --tertiary-container: 40 75 89;
            --tertiary-fixed-dim: 168 204 221;
            --secondary-container: 99 59 69;
            --primary-fixed-dim: 180 205 184;
            --primary: 180 205 184;
            --secondary-fixed-dim: 239 184 195;
            --on-primary-fixed: 11 32 19;
            --error-container: 147 0 10;
            --surface-container-highest: 51 55 51;
            --on-background: 226 227 222;
            --secondary-fixed: 255 217 224;
            --outline-variant: 67 72 67;
            --on-tertiary: 0 53 70;
            --on-tertiary-container: 195 232 250;
            --surface: 18 20 18;
            --inverse-primary: 54 76 60;
            --on-error-container: 255 218 214;
        }
        .dark .glass-panel { background: rgba(18, 21, 19, 0.72); border-color: rgba(255, 255, 255, 0.08); }
        .dark .nav-scrolled { background: rgba(18, 20, 18, 0.92); box-shadow: 0 4px 6px -1px rgba(0, 0, 0, 0.4); }
        .dark body::-webkit-scrollbar-track { background: #121412; }
        .dark body::-webkit-scrollbar-thumb { border-color: #121412; }
        html { scroll-behavior: smooth; }
        body::-webkit-scrollbar { width: 10px; }
        body::-webkit-scrollbar-track { background: #f4f4f1; }
        body::-webkit-scrollbar-thumb { background: #58b789; border-radius: 8px; border: 2px solid #f4f4f1; }
        ::-webkit-scrollbar-thumb:hover { background: #2f7d5c; }
        :focus-visible { outline: 2px solid #58b789; outline-offset: 2px; }
        .fade-in-up { opacity: 0; transform: translateY(28px); transition: opacity 1s cubic-bezier(.22,1,.36,1), transform 1s cubic-bezier(.22,1,.36,1); }
        .fade-in-up.visible { opacity: 1; transform: translateY(0); }
        .glass-panel { background: rgba(251, 251, 248, 0.7); backdrop-filter: blur(20px); -webkit-backdrop-filter: blur(20px); border: 1px solid rgba(27, 48, 34, 0.1); }
        /* ---- Arrière-plan saisonnier (scroll-driven) ---- */
        #bgCanvas { position: fixed; inset: 0; z-index: -2; pointer-events: none; will-change: background; }
        #bgCanvas::before { content: ""; position: absolute; inset: 0; background: radial-gradient(52% 46% at 50% 0%, rgb(var(--gold) / 0.14), transparent 70%); animation: backdrop-halo 24s ease-in-out infinite alternate; }
        #bgCanvas::after { content: ""; position: absolute; inset: 0; opacity: 0.06; mix-blend-mode: soft-light; background-image: url("data:image/svg+xml,%3Csvg xmlns='http://www.w3.org/2000/svg' width='160' height='160'%3E%3Cfilter id='n'%3E%3CfeTurbulence type='fractalNoise' baseFrequency='0.85' numOctaves='2' stitchTiles='stitch'/%3E%3C/filter%3E%3Crect width='160' height='160' filter='url(%23n)' opacity='0.5'/%3E%3C/svg%3E"); }
        @keyframes backdrop-halo { from { transform: translate3d(-4%, -2%, 0) scale(1); } to { transform: translate3d(4%, 2%, 0) scale(1.12); } }
        .nav-scrolled { background: rgba(249, 249, 246, 0.92); backdrop-filter: blur(20px); -webkit-backdrop-filter: blur(20px); box-shadow: 0 4px 6px -1px rgba(0, 0, 0, 0.05); }
        /* ---- Navbar & navigation ---- */
        .nav-link { position: relative; font-family: 'Manrope', sans-serif; font-size: 12px; font-weight: 600; letter-spacing: 0.16em; text-transform: uppercase; color: rgb(var(--primary)); padding: 8px 2px; transition: color .3s ease, opacity .3s ease; }
        .nav-link:hover, .nav-link.active { color: rgb(var(--gold-dark)); }
        #mainNav.over-hero .nav-link { color: rgba(255,255,255,.92); }
        #mainNav.over-hero .nav-link:hover, #mainNav.over-hero .nav-link.active { color: #fff; }
        #mainNav.over-hero #brandName { color: #fff; }
        #mainNav.over-hero #brandKanji { color: #9fe0c0; }
        #mainNav.over-hero #btnLogin { color: #fff; }
        #mainNav.over-hero #btnLogin:hover { color: #9fe0c0; }
        /* ---- Tiroir mobile ---- */
        .menu-link { opacity: 0; transform: translateX(-16px); transition: opacity .45s cubic-bezier(.22,1,.36,1), transform .45s cubic-bezier(.22,1,.36,1), background-color .2s ease, color .2s ease; }
        .menu-link.active { color: rgb(var(--primary)); background: rgb(var(--surface-container-high)); }
        #mobileMenu.open .menu-link { opacity: 1; transform: translateX(0); }
        #mobileMenu.open .menu-link:nth-child(1) { transition-delay: .08s; }
        #mobileMenu.open .menu-link:nth-child(2) { transition-delay: .14s; }
        #mobileMenu.open .menu-link:nth-child(3) { transition-delay: .20s; }
        #mobileMenu.open .menu-link:nth-child(4) { transition-delay: .26s; }
        #mobileMenu.open .menu-link:nth-child(5) { transition-delay: .32s; }
        .drawer-fade { opacity: 0; transform: translateY(14px); transition: opacity .5s cubic-bezier(.22,1,.36,1) .25s, transform .5s cubic-bezier(.22,1,.36,1) .25s; }
        #mobileMenu.open .drawer-fade { opacity: 1; transform: translateY(0); }
        .drawer-kanji { color: rgba(6,27,14,.045); }
        .dark .drawer-kanji { color: rgba(226,227,222,.05); }
        @media (prefers-reduced-motion: reduce) { .menu-link, .drawer-fade { transition: none; opacity: 1; transform: none; } #bgCanvas::before { animation: none; } }
        /* ---- Widget Messagerie (design intégré) ---- */
        #chatFab { position: fixed; bottom: 24px; left: 24px; z-index: 62; width: 56px; height: 56px; border-radius: 9999px; background: rgb(var(--primary) / 1); border: 1px solid rgb(var(--gold) / 0.3); cursor: pointer; box-shadow: 0 4px 16px rgba(6,27,14,0.35); display: grid; place-items: center; transition: transform .2s ease, box-shadow .2s ease, background .2s ease; }
        #chatFab:hover { transform: scale(1.08); box-shadow: 0 6px 24px rgba(6,27,14,0.45); background: rgb(var(--primary) / 0.9); }
        #chatFab svg, #chatFab .material-symbols-outlined { color: rgb(var(--on-primary) / 1); width: 26px; height: 26px; }
        .dark #chatFab { background: rgb(var(--primary-fixed-dim) / 1); border-color: rgb(var(--gold) / 0.25); box-shadow: 0 4px 16px rgba(0,0,0,0.5); }
        .dark #chatFab:hover { background: rgb(var(--primary-fixed) / 1); }
        .dark #chatFab svg, .dark #chatFab .material-symbols-outlined { color: rgb(var(--on-primary-fixed) / 1); }

        #chatWidget { position: fixed; bottom: 92px; left: 24px; z-index: 62; width: 400px; max-width: calc(100vw - 32px); height: 540px; max-height: calc(100vh - 140px); border-radius: 20px; overflow: hidden; display: flex; flex-direction: column; background: rgb(var(--surface-bright) / 1); border: 1px solid rgb(var(--outline-variant) / 0.4); box-shadow: 0 16px 48px rgba(0,0,0,0.22), 0 2px 8px rgba(0,0,0,0.08); opacity: 0; transform: translateY(12px) scale(0.97); pointer-events: none; transition: opacity .3s cubic-bezier(.22,1,.36,1), transform .3s cubic-bezier(.22,1,.36,1); }
        #chatWidget.open { opacity: 1; transform: translateY(0) scale(1); pointer-events: auto; }
        .dark #chatWidget { background: rgb(var(--surface-container) / 1); border-color: rgb(var(--outline-variant) / 0.35); box-shadow: 0 16px 48px rgba(0,0,0,0.55), 0 2px 8px rgba(0,0,0,0.25); }

        .chat-header { background: rgb(var(--primary) / 1); color: rgb(var(--on-primary) / 1); padding: 16px 18px; display: flex; align-items: center; gap: 12px; flex-shrink: 0; position: relative; }
        .chat-header::after { content: ""; position: absolute; bottom: 0; left: 0; right: 0; height: 1px; background: linear-gradient(90deg, transparent, rgb(var(--gold) / 0.35), transparent); }
        .dark .chat-header { background: rgb(var(--primary-fixed-dim) / 1); color: rgb(var(--on-primary-fixed) / 1); }
        .chat-header .chat-avatar { width: 42px; height: 42px; border-radius: 14px; background: rgb(var(--gold) / 0.2); border: 1.5px solid rgb(var(--gold) / 0.5); display: grid; place-items: center; flex-shrink: 0; }
        .chat-header .chat-avatar .material-symbols-outlined { font-size: 22px; color: rgb(var(--gold) / 1); }
        .dark .chat-header .chat-avatar { background: rgb(var(--gold) / 0.15); border-color: rgb(var(--gold) / 0.4); }
        .chat-header-info { flex: 1; min-width: 0; }
        .chat-header-info .name { font-family: 'Libre Caslon Text', serif; font-size: 16px; font-weight: 400; letter-spacing: 0.02em; }
        .chat-header-info .status { font-family: 'Manrope', sans-serif; font-size: 11px; letter-spacing: 0.12em; text-transform: uppercase; opacity: 0.7; margin-top: 1px; }
        .chat-header-info .status-dot { display: inline-block; width: 6px; height: 6px; border-radius: 9999px; background: #4ade80; margin-right: 5px; vertical-align: 1px; animation: pulse-dot 2s ease-in-out infinite; }
        @keyframes pulse-dot { 0%, 100% { opacity: 1; } 50% { opacity: 0.4; } }
        .chat-header button { background: none; border: none; color: rgba(255,255,255,0.6); cursor: pointer; padding: 6px; border-radius: 10px; transition: color .15s ease, background .15s ease; display: grid; place-items: center; }
        .chat-header button:hover { color: #fff; background: rgba(255,255,255,0.1); }
        .chat-header button .material-symbols-outlined { font-size: 20px; }

        .chat-messages { flex: 1; overflow-y: auto; display: flex; flex-direction: column; gap: 8px; padding: 16px; background: rgb(var(--surface-container-low) / 0.4); scroll-behavior: smooth; }
        .chat-messages::-webkit-scrollbar { width: 4px; }
        .chat-messages::-webkit-scrollbar-thumb { background: rgb(var(--outline-variant) / 0.5); border-radius: 9999px; }
        .dark .chat-messages { background: rgb(var(--surface-container-lowest) / 0.4); }

        .chat-msg { max-width: 82%; padding: 10px 14px; border-radius: 16px; font-family: 'Manrope', sans-serif; font-size: 14px; line-height: 1.5; word-break: break-word; animation: msg-in .3s cubic-bezier(.22,1,.36,1) both; }
        @keyframes msg-in { from { opacity: 0; transform: translateY(6px) scale(0.97); } to { opacity: 1; transform: translateY(0) scale(1); } }
        .chat-msg.visitor { align-self: flex-end; background: rgb(var(--primary) / 1); color: rgb(var(--on-primary) / 1); border-bottom-right-radius: 6px; }
        .chat-msg.admin { align-self: flex-start; background: rgb(var(--surface-bright) / 1); color: rgb(var(--on-surface) / 1); border: 1px solid rgb(var(--outline-variant) / 0.3); border-bottom-left-radius: 6px; }
        .dark .chat-msg.visitor { background: rgb(--1a3a2a / 1); border: 1px solid rgb(var(--gold) / 0.2); }
        .dark .chat-msg.admin { background: rgb(var(--surface-container-high) / 0.7); border-color: rgb(var(--outline-variant) / 0.25); }
        .chat-msg .time { display: block; font-size: 10px; color: rgb(var(--on-surface-variant) / 0.5); text-align: right; margin-top: 4px; }
        .chat-msg .sender { font-size: 11px; font-weight: 600; letter-spacing: 0.06em; text-transform: uppercase; margin-bottom: 3px; color: rgb(var(--gold) / 1); }
        .chat-msg.visitor .sender { text-align: right; }

        .chat-input-area { display: flex; gap: 8px; padding: 12px 14px; background: rgb(var(--surface-bright) / 1); border-top: 1px solid rgb(var(--outline-variant) / 0.3); flex-shrink: 0; }
        .dark .chat-input-area { background: rgb(var(--surface-container) / 1); border-color: rgb(var(--outline-variant) / 0.2); }
        .chat-input-area input { flex: 1; border: 1px solid rgb(var(--outline-variant) / 0.5); border-radius: 14px; padding: 10px 16px; font-family: 'Manrope', sans-serif; font-size: 14px; background: rgb(var(--surface-bright) / 1); color: rgb(var(--on-surface) / 1); outline: none; transition: border-color .2s ease, box-shadow .2s ease; }
        .chat-input-area input::placeholder { color: rgb(var(--on-surface-variant) / 0.5); }
        .chat-input-area input:focus { border-color: rgb(var(--gold) / 0.7); box-shadow: 0 0 0 3px rgb(var(--gold) / 0.1); }
        .dark .chat-input-area input { background: rgb(var(--surface-container-high) / 0.5); border-color: rgb(var(--outline-variant) / 0.3); }
        .chat-input-area button { width: 40px; height: 40px; border-radius: 12px; background: rgb(var(--gold) / 1); border: none; cursor: pointer; display: grid; place-items: center; transition: background .15s ease, transform .1s ease; flex-shrink: 0; }
        .chat-input-area button:hover { background: rgb(var(--gold-dark) / 1); transform: scale(1.04); }
        .chat-input-area button:active { transform: scale(0.96); }
        .chat-input-area button svg { width: 18px; height: 18px; fill: rgb(var(--on-primary) / 1); }
        .dark .chat-input-area button svg { fill: rgb(var(--on-primary-fixed) / 1); }
        .chat-input-area button:disabled { opacity: 0.4; cursor: not-allowed; transform: none; }

        .chat-init { padding: 28px 22px; display: flex; flex-direction: column; gap: 14px; background: rgb(var(--surface-bright) / 1); flex: 1; }
        .dark .chat-init { background: rgb(var(--surface-container) / 0.5); }
        .chat-init .chat-init-icon { width: 52px; height: 52px; border-radius: 16px; background: rgb(var(--gold) / 0.1); border: 1px solid rgb(var(--gold) / 0.25); display: grid; place-items: center; margin-bottom: 4px; }
        .chat-init .chat-init-icon .material-symbols-outlined { font-size: 26px; color: rgb(var(--gold) / 1); }
        .chat-init h3 { font-family: 'Libre Caslon Text', serif; font-size: 22px; color: rgb(var(--on-surface) / 1); margin: 0; font-weight: 400; }
        .chat-init p { font-family: 'Manrope', sans-serif; font-size: 13px; color: rgb(var(--on-surface-variant) / 0.7); margin: 0; line-height: 1.5; }
        .chat-init input { border: 1px solid rgb(var(--outline-variant) / 0.5); border-radius: 12px; padding: 11px 14px; font-family: 'Manrope', sans-serif; font-size: 14px; background: rgb(var(--surface-bright) / 1); color: rgb(var(--on-surface) / 1); outline: none; transition: border-color .2s ease, box-shadow .2s ease; }
        .chat-init input::placeholder { color: rgb(var(--on-surface-variant) / 0.45); }
        .chat-init input:focus { border-color: rgb(var(--gold) / 0.7); box-shadow: 0 0 0 3px rgb(var(--gold) / 0.1); }
        .dark .chat-init input { background: rgb(var(--surface-container-high) / 0.5); border-color: rgb(var(--outline-variant) / 0.3); }
        .chat-init button { background: rgb(var(--primary) / 1); color: rgb(var(--on-primary) / 1); border: none; border-radius: 12px; padding: 12px; font-family: 'Manrope', sans-serif; font-size: 12px; letter-spacing: 0.1em; text-transform: uppercase; font-weight: 600; cursor: pointer; transition: background .2s ease, transform .1s ease; }
        .chat-init button:hover { background: rgb(var(--primary) / 0.85); }
        .chat-init button:active { transform: translateY(1px); }
        .dark .chat-init button { background: rgb(var(--primary-fixed-dim) / 1); color: rgb(var(--on-primary-fixed) / 1); }
        .dark .chat-init button:hover { background: rgb(var(--primary-fixed) / 1); }
        .chat-init .error { color: rgb(var(--error) / 1); font-family: 'Manrope', sans-serif; font-size: 12px; display: none; background: rgb(var(--error-container) / 0.4); padding: 8px 12px; border-radius: 8px; border: 1px solid rgb(var(--error) / 0.2); }
        .chat-init textarea { border: 1px solid rgb(var(--outline-variant) / 0.5); border-radius: 12px; padding: 11px 14px; font-family: 'Manrope', sans-serif; font-size: 14px; background: rgb(var(--surface-bright) / 1); color: rgb(var(--on-surface) / 1); outline: none; transition: border-color .2s ease, box-shadow .2s ease; resize: none; }
        .chat-init textarea::placeholder { color: rgb(var(--on-surface-variant) / 0.45); }
        .chat-init textarea:focus { border-color: rgb(var(--gold) / 0.7); box-shadow: 0 0 0 3px rgb(var(--gold) / 0.1); }
        .dark .chat-init textarea { background: rgb(var(--surface-container-high) / 0.5); border-color: rgb(var(--outline-variant) / 0.3); }
        .chat-whatsapp-btn { display: flex; align-items: center; justify-content: center; gap: 8px; padding: 12px; border-radius: 12px; background: #25D366; color: #fff; font-family: 'Manrope', sans-serif; font-size: 12px; letter-spacing: 0.1em; text-transform: uppercase; font-weight: 600; text-decoration: none; transition: background .2s ease, transform .1s ease; }
        .chat-whatsapp-btn:hover { background: #1da851; transform: translateY(1px); }
        .chat-whatsapp-btn:active { transform: scale(0.98); }
        /* ---- Widget Météo ---- */
        .weather-spinner { width: 40px; height: 40px; border: 3px solid rgb(var(--outline-variant) / 0.5); border-top-color: rgb(var(--gold) / 1); border-radius: 9999px; animation: auth-spin .7s linear infinite; }
        .weather-icon-wrap { width: 80px; height: 80px; flex-shrink: 0; }
        .weather-icon-wrap img { filter: drop-shadow(0 2px 6px rgba(0,0,0,0.15)); }
        .forecast-card { display: flex; flex-direction: column; align-items: center; gap: 6px; padding: 12px 6px; border-radius: 0.75rem; background: rgb(var(--surface-container-low) / 0.6); border: 1px solid rgb(var(--outline-variant) / 0.3); transition: background .2s ease, border-color .2s ease; }
        .forecast-card:hover { background: rgb(var(--surface-container-high) / 0.8); border-color: rgb(var(--gold) / 0.3); }
        .forecast-day { font-family: 'Manrope', sans-serif; font-size: 11px; font-weight: 600; letter-spacing: 0.08em; text-transform: uppercase; color: rgb(var(--on-surface-variant) / 0.8); }
        .forecast-icon { width: 36px; height: 36px; }
        .forecast-icon img { width: 100%; height: 100%; filter: drop-shadow(0 1px 3px rgba(0,0,0,0.12)); }
        .forecast-temp { font-family: 'Libre Caslon Text', serif; font-size: 18px; font-weight: 400; color: rgb(var(--primary) / 1); line-height: 1; }
        .forecast-temp-min { font-family: 'Manrope', sans-serif; font-size: 12px; color: rgb(var(--on-surface-variant) / 0.6); }
        .dark .forecast-card { background: rgba(30,33,30,0.6); border-color: rgba(67,72,67,0.3); }
        .dark .forecast-card:hover { background: rgba(41,44,41,0.8); }
        @media (max-width: 640px) { .forecast-card { padding: 10px 4px; } .forecast-day { font-size: 10px; } .forecast-icon { width: 30px; height: 30px; } .forecast-temp { font-size: 15px; } }
        /* ---- Fin Widget Météo ---- */
        #chatBadge { position: absolute; top: -3px; right: -3px; min-width: 18px; height: 18px; border-radius: 9999px; background: rgb(var(--error) / 1); color: #fff; font-size: 10px; font-weight: 700; display: none; place-items: center; pointer-events: none; padding: 0 4px; border: 2px solid rgb(var(--surface-bright) / 1); }
        .dark #chatBadge { border-color: rgb(var(--surface-container) / 1); }
        @media (max-width: 480px) { #chatWidget { left: 8px; right: 8px; width: auto; bottom: 84px; height: calc(100vh - 120px); border-radius: 16px; } #chatFab { left: 16px; bottom: 16px; width: 52px; height: 52px; } }
        .slot-btn { transition: all .2s ease; }
        .slot-btn.selected { background: #061b0e; color: #ffffff; border-color: #061b0e; }
        .star-btn { cursor: pointer; transition: transform .15s ease, color .15s ease; }
        .star-btn:hover { transform: scale(1.25); }
        #authModal { display: none; }
        #authModal.open { display: flex; }
        .field { position: relative; }
        .field-icon { position: absolute; left: 13px; top: 50%; transform: translateY(-50%); font-size: 20px; color: rgb(var(--gold) / 0.85); pointer-events: none; line-height: 1; }
        .field-input { width: 100%; background: rgb(var(--surface-bright) / 1); border: 1px solid rgb(var(--outline-variant) / 1); border-radius: 0.5rem; padding: 12px 44px 12px 44px; color: rgb(var(--on-surface) / 1); font-family: 'Manrope', sans-serif; font-size: 15px; line-height: 1.4; transition: border-color .18s ease, box-shadow .18s ease, background .18s ease; }
        .field-input::placeholder { color: rgb(var(--on-surface-variant) / 0.55); }
        .field-input:focus { outline: none; border-color: rgb(var(--gold) / 1); box-shadow: 0 0 0 3px rgb(var(--gold) / 0.18); }
        .field-input.has-error { border-color: rgb(var(--error) / 1); box-shadow: 0 0 0 3px rgb(var(--error) / 0.15); }
        .field-eye { position: absolute; right: 6px; top: 50%; transform: translateY(-50%); display: inline-flex; align-items: center; justify-content: center; width: 34px; height: 34px; border: none; border-radius: 0.375rem; background: transparent; color: rgb(var(--on-surface-variant) / 0.8); cursor: pointer; transition: color .15s ease, background .15s ease; }
        .field-eye:hover { color: rgb(var(--gold-dark) / 1); background: rgb(var(--gold) / 0.1); }
        .field-eye .material-symbols-outlined { font-size: 20px; }
        .pw-meter { display: flex; gap: 4px; margin-top: 8px; }
        .pw-meter span { height: 4px; flex: 1; border-radius: 9999px; background: rgb(var(--outline-variant) / 0.7); transition: background .2s ease; }
        .pw-meter[data-score="1"] span:nth-child(-n+1) { background: rgb(var(--error) / 0.85); }
        .pw-meter[data-score="2"] span:nth-child(-n+2) { background: #d98b3a; }
        .pw-meter[data-score="3"] span:nth-child(-n+3) { background: #b7a63a; }
        .pw-meter[data-score="4"] span:nth-child(-n+4) { background: rgb(var(--gold) / 0.95); }
        .pw-label { display: none; margin-top: 6px; font-family: 'Manrope', sans-serif; font-size: 12px; line-height: 1.4; color: rgb(var(--on-surface-variant) / 0.8); }
        .pw-meter[data-score="1"] ~ .pw-label { display: block; color: rgb(var(--error) / 0.9); }
        .pw-meter[data-score="2"] ~ .pw-label { display: block; color: #d98b3a; }
        .pw-meter[data-score="3"] ~ .pw-label { display: block; color: #b7a63a; }
        .pw-meter[data-score="4"] ~ .pw-label { display: block; color: rgb(var(--gold-dark) / 1); }
        .form-msg { text-align: center; font-family: 'Manrope', sans-serif; font-size: 14px; line-height: 1.5; padding: 10px 14px; border-radius: 0.5rem; }
        .form-msg:not(.hidden) { display: block; }
        .form-msg.is-error { color: rgb(var(--on-error-container) / 1); background: rgb(var(--error-container) / 0.55); border: 1px solid rgb(var(--error) / 0.3); }
        .form-msg.is-ok { color: rgb(var(--gold-dark) / 1); background: rgb(var(--gold) / 0.12); border: 1px solid rgb(var(--gold) / 0.35); }
        .btn-submit { position: relative; width: 100%; display: inline-flex; align-items: center; justify-content: center; gap: 10px; background: rgb(var(--primary) / 1); color: rgb(var(--on-primary) / 1); padding: 13px 24px; font-family: 'Manrope', sans-serif; font-size: 12px; letter-spacing: 0.1em; text-transform: uppercase; font-weight: 600; border: none; border-radius: 0.5rem; cursor: pointer; transition: background .25s ease, transform .15s ease, opacity .2s ease; }
        .btn-submit:hover:not(:disabled) { background: rgb(var(--primary) / 0.88); }
        .btn-submit:active:not(:disabled) { transform: translateY(1px); }
        .btn-submit:disabled { opacity: 0.65; cursor: not-allowed; }
        .btn-spinner { width: 15px; height: 15px; border-radius: 9999px; border: 2px solid rgb(var(--on-primary) / 0.35); border-top-color: rgb(var(--on-primary) / 1); animation: auth-spin .7s linear infinite; }
        .dark .btn-submit { background: rgb(var(--primary-fixed) / 1); color: rgb(var(--on-primary-fixed) / 1); }
        .dark .btn-submit:hover:not(:disabled) { background: rgb(var(--primary-fixed) / 0.85); }
        .dark .btn-spinner { border-color: rgb(var(--on-primary-fixed) / 0.35); border-top-color: rgb(var(--on-primary-fixed) / 1); }
        .dark .form-msg.is-ok { color: rgb(var(--gold-light) / 1); }
        @keyframes auth-spin { to { transform: rotate(360deg); } }
        #toast { transition: opacity .3s ease, transform .3s ease; }
        #mobileMenu.hidden { display: none; }
        #mobileMenu.open { display: block; }
        #mobileMenu.open #mobileMenuPanel { transform: translateX(0); }
        @keyframes scale-in { from { transform: scale(1); } to { transform: scale(1.08); } }
        .hero-slide { position: absolute; inset: 0; width: 100%; height: 100%; object-fit: cover; object-position: center; opacity: 0; transition: opacity 2s ease-in-out; animation: scale-in 20s ease-out infinite alternate; will-change: transform, opacity; }
        .hero-slide.active { opacity: 1; }
        #heroDots { position: absolute; bottom: 8rem; left: 50%; transform: translateX(-50%); z-index: 20; display: flex; gap: 0.5rem; }
        #heroDots button { width: 0.5rem; height: 0.5rem; border-radius: 9999px; background: rgba(249, 249, 246, 0.4); border: none; cursor: pointer; transition: background .3s ease, width .3s ease; padding: 0; }
        #heroDots button.active { background: #f9f9f6; width: 1.25rem; }
        .eyebrow { display: inline-flex; align-items: center; gap: 0.75rem; }
        .gold-rule { display: none; }
        .kanji-watermark { position: absolute; font-family: 'Libre Caslon Text', serif; color: rgba(6, 27, 14, 0.05); font-size: 200px; line-height: 1; user-select: none; pointer-events: none; white-space: nowrap; }
        .img-frame { position: relative; }
        .img-frame::before { content: ""; position: absolute; inset: 1.25rem -1.25rem -1.25rem 1.25rem; border: 1px solid rgba(88, 183, 137, 0.5); z-index: 0; pointer-events: none; }
        @media (max-width: 640px) { .img-frame::before { inset: 0.75rem 0 -0.375rem 0.75rem; } }
        @keyframes petal-fall { 0% { transform: translateY(-10vh) rotate(0deg); opacity: 0; } 10% { opacity: 0.9; } 100% { transform: translateY(110vh) rotate(360deg); opacity: 0.6; } }
        .petal { position: absolute; top: 0; color: rgba(254, 198, 209, 0.8); animation: petal-fall linear infinite; pointer-events: none; }
        /* ---- Pétales emportés par le vent (autour de la citation) ---- */
        .petal-band { position: relative; height: 170px; overflow: hidden; pointer-events: none; }
        .petal-wind { position: absolute; left: 0; top: 0; will-change: transform, opacity; animation: petal-wind linear infinite; }
        .petal-wind svg { display: block; width: 100%; height: 100%; }
        .petal-far { filter: blur(0.6px); opacity: 0.45; }
        @keyframes petal-wind {
            0%   { transform: translate3d(-6vw, 8px, 0) rotate(0deg); opacity: 0; }
            8%   { opacity: 0.95; }
            40%  { transform: translate3d(36vw, 30px, 0) rotate(150deg); }
            68%  { transform: translate3d(72vw, -14px, 0) rotate(300deg); }
            100% { transform: translate3d(114vw, 16px, 0) rotate(450deg); opacity: 0; }
        }
        @media (prefers-reduced-motion: reduce) { .petal-band .petal-wind { animation: none; opacity: 0; } }
        .stat-num { font-family: 'Libre Caslon Text', serif; color: #58b789; }
        .btn-gold { position: relative; overflow: hidden; }
        .btn-gold::after { content: ""; position: absolute; top: 0; left: -120%; width: 60%; height: 100%; background: linear-gradient(120deg, transparent, rgba(255,255,255,0.25), transparent); transform: skewX(-20deg); transition: left .6s ease; }
        .btn-gold:hover::after { left: 160%; }
        #backToTop { transition: opacity .3s ease, transform .3s ease; }
        /* ---- Oiseaux en vol (bandeau après le hero) ---- */
        .bird-band { position: relative; height: 220px; overflow: hidden; background: linear-gradient(180deg, #dde7ee 0%, rgba(221,231,238,0) 45%, var(--surface, #f9f9f6) 100%); }
        .dark .bird-band { background: linear-gradient(180deg, #12171c 0%, rgba(18,23,28,0) 45%, var(--surface, #121412) 100%); }
        .bird { position: absolute; left: -90px; will-change: transform; animation: bird-fly linear infinite; }
        .bird-svg { display: block; width: 100%; height: 100%; }
        .bird-wing { fill: #33414b; transform-box: fill-box; animation: bird-flap .9s ease-in-out infinite alternate; }
        .bird-wing-r { animation-name: bird-flap-r; }
        .bird-body { fill: #33414b; }
        .dark .bird-wing, .dark .bird-body { fill: #dde0da; }
        @keyframes bird-flap { from { transform: rotate(9deg); } to { transform: rotate(-40deg); } }
        @keyframes bird-flap-r { from { transform: rotate(-9deg); } to { transform: rotate(40deg); } }
        @keyframes bird-fly {
            0%   { transform: translateX(0) translateY(0) rotate(0deg); }
            20%  { transform: translateX(24vw) translateY(-16px) rotate(1.5deg); }
            45%  { transform: translateX(52vw) translateY(8px) rotate(-2deg); }
            70%  { transform: translateX(78vw) translateY(-12px) rotate(1.5deg); }
            100% { transform: translateX(114vw) translateY(3px) rotate(0deg); }
        }
        .bird-cloud { position: absolute; border-radius: 9999px; background: rgba(255,255,255,0.6); filter: blur(3px); will-change: transform; animation: cloud-drift linear infinite; }
        .dark .bird-cloud { background: rgba(255,255,255,0.06); }
        @keyframes cloud-drift { from { transform: translateX(-30vw); } to { transform: translateX(130vw); } }
        @media (prefers-reduced-motion: reduce) { .bird, .bird-wing, .bird-cloud { animation: none; } }
        /* ---- Animations continues (section Histoire) ---- */
        @keyframes float-y { 0%, 100% { transform: translateY(0); } 50% { transform: translateY(-14px); } }
        @keyframes kenburns { 0% { transform: scale(1.02); } 100% { transform: scale(1.14); } }
        @keyframes rule-breathe { 0%, 100% { transform: scaleX(1); opacity: 1; } 50% { transform: scaleX(.55); opacity: .45; } }
        @keyframes mote-rise { 0% { transform: translateY(0) translateX(0); opacity: 0; } 12% { opacity: .8; } 85% { opacity: .45; } 100% { transform: translateY(-170px) translateX(28px); opacity: 0; } }
        .animate-float { animation: float-y 7s ease-in-out infinite; }
        .img-kenburns { animation: kenburns 26s ease-in-out infinite alternate; will-change: transform; }
        .rank-ring { animation: ring-spin 26s linear infinite; }
        @keyframes ring-spin { from { transform: rotate(0deg); } to { transform: rotate(360deg); } }
        .rule-live { transform-origin: center; animation: rule-breathe 4.5s ease-in-out infinite; }
        .mote { position: absolute; width: 5px; height: 5px; border-radius: 9999px; background: #9fe0c0; box-shadow: 0 0 8px 2px rgba(159,224,192,.55); opacity: 0; pointer-events: none; animation: mote-rise linear infinite; mix-blend-mode: screen; }
        .dark .mote { background: #9fe0c0; box-shadow: 0 0 8px 2px rgba(159,224,192,.5); }
        @media (prefers-reduced-motion: reduce) { .animate-float, .img-kenburns, .rule-live, .mote { animation: none; } .rank-ring { animation: none; } }
        .map-wrap { background: #fdfcf7; }
        .dark .map-wrap { background: #161915; }
        .map-pin { position: absolute; width: 30px; height: 30px; display: grid; place-items: center; background: transparent; border: none; padding: 0; cursor: pointer; z-index: 2; }
        .map-dot { width: 13px; height: 13px; border-radius: 9999px; background: radial-gradient(circle at 35% 30%, #9fe0c0, #58b789 60%, #2f7d5c); border: 2px solid rgba(255, 255, 255, 0.95); box-shadow: 0 0 0 4px rgba(88, 183, 137, 0.25), 0 2px 6px rgba(0, 0, 0, 0.35); transition: transform .2s ease, box-shadow .2s ease; }
        .map-pin::before { content: ""; position: absolute; width: 30px; height: 30px; border-radius: 9999px; border: 2px solid rgba(88, 183, 137, 0.55); opacity: 0; }
        .map-pin:hover .map-dot, .map-pin:focus-visible .map-dot, .map-pin.active .map-dot { transform: scale(1.35); box-shadow: 0 0 0 6px rgba(88, 183, 137, 0.35), 0 2px 8px rgba(0, 0, 0, 0.4); }
        .map-pin:hover::before, .map-pin:focus-visible::before, .map-pin.active::before { animation: map-pulse 2.2s ease-out infinite; }
        @keyframes map-pulse { 0% { transform: scale(0.6); opacity: 0.8; } 100% { transform: scale(1.9); opacity: 0; } }
        .map-tip { position: absolute; left: 50%; bottom: calc(100% + 14px); transform: translate(-50%, 6px) scale(0.96); transform-origin: bottom center; width: max-content; max-width: 260px; background: #fffdf8; color: #1a1c1b; border: 1px solid rgba(88, 183, 137, 0.45); border-radius: 10px; padding: 12px 16px; box-shadow: 0 12px 32px rgba(0, 0, 0, 0.2); opacity: 0; pointer-events: none; transition: opacity .18s ease, transform .18s ease; z-index: 30; text-align: left; }
        .map-tip::after { content: ""; position: absolute; left: 50%; top: 100%; transform: translateX(-50%); border: 6px solid transparent; border-top-color: #fffdf8; }
        .map-pin:hover .map-tip, .map-pin:focus-visible .map-tip, .map-pin.active .map-tip { opacity: 1; transform: translate(-50%, 0) scale(1); }
        .map-tip strong { font-family: 'Libre Caslon Text', serif; font-size: 17px; line-height: 1.2; display: block; font-weight: 400; color: #1a1c1b; }
        .map-tip .tip-tag { display: block; margin-top: 4px; font-family: 'Manrope', sans-serif; font-size: 10px; letter-spacing: 0.2em; text-transform: uppercase; color: #2f7d5c; }
        .map-tip .tip-desc { display: block; margin-top: 8px; font-family: 'Manrope', sans-serif; font-size: 14px; line-height: 1.45; color: #5b5f5b; }
        .dark .map-tip { background: #1a1d1a; color: #e2e3de; border-color: rgba(88, 183, 137, 0.5); }
        .dark .map-tip::after { border-top-color: #1a1d1a; }
        .dark .map-tip strong { color: #e2e3de; }
        .dark .map-tip .tip-tag { color: #9fe0c0; }
        .dark .map-tip .tip-desc { color: #b9bdb8; }
        .map-lbl { position: absolute; top: 100%; left: 50%; transform: translateX(-50%); margin-top: 6px; white-space: nowrap; font-family: 'Manrope', sans-serif; font-size: 10.5px; letter-spacing: 0.05em; color: #2f7d5c; background: rgba(255, 255, 255, 0.86); border: 1px solid rgba(88, 183, 137, 0.55); border-radius: 999px; padding: 2px 9px; box-shadow: 0 2px 6px rgba(0, 0, 0, 0.12); pointer-events: none; transition: color .18s ease, background .18s ease, border-color .18s ease; z-index: 3; }
        .map-lbl--above { top: auto; bottom: calc(100% + 6px); margin-top: 0; }
        .map-pin:hover .map-lbl, .map-pin:focus-visible .map-lbl, .map-pin.active .map-lbl { color: #2f7d5c; background: #fffdf8; border-color: rgba(88, 183, 137, 0.85); }
        @media (max-width: 640px) { .map-tip { max-width: 200px; padding: 10px 12px; } .map-tip .tip-desc { font-size: 13px; } .map-lbl { font-size: 9.5px; padding: 1px 6px; } }
        @media (max-width: 768px) { .map-lbl { display: none; } }
        /* ---- Visionneuse immersive ---- */
        #siteViewer { visibility: hidden; transition: opacity .8s cubic-bezier(.22, 1, .36, 1), visibility 0s linear .8s; }
        #siteViewer.open { visibility: visible; opacity: 1; pointer-events: auto; transition: opacity .8s cubic-bezier(.22, 1, .36, 1), visibility 0s; }
        .viewer-stage { position: absolute; inset: 0; overflow: hidden; }
        .viewer-img { position: absolute; inset: 0; width: 100%; height: 100%; object-fit: cover; opacity: 0; transition: opacity 1.6s cubic-bezier(.22, 1, .36, 1); will-change: transform, opacity; }
        .viewer-img.active { opacity: 1; }
        @keyframes kb-zoom-in { from { transform: scale(1); } to { transform: scale(1.14); } }
        @keyframes kb-zoom-out { from { transform: scale(1.14); } to { transform: scale(1); } }
        @keyframes kb-pan-left { from { transform: scale(1.1) translateX(1.5%); } to { transform: scale(1.1) translateX(-1.5%); } }
        @keyframes kb-pan-right { from { transform: scale(1.1) translateX(-1.5%); } to { transform: scale(1.1) translateX(1.5%); } }
        @keyframes kb-pan-up { from { transform: scale(1.12) translateY(1.2%); } to { transform: scale(1.12) translateY(-1.2%); } }
        @keyframes kb-pan-down { from { transform: scale(1.12) translateY(-1.2%); } to { transform: scale(1.12) translateY(1.2%); } }
        @keyframes kb-zoom-tl { from { transform: scale(1.12) translate(1.2%, 1.2%); } to { transform: scale(1.12) translate(-1.2%, -1.2%); } }
        @keyframes kb-zoom-br { from { transform: scale(1.12) translate(-1.2%, -1.2%); } to { transform: scale(1.12) translate(1.2%, 1.2%); } }
        .kb-0 { animation: kb-zoom-in 13s cubic-bezier(.22, 1, .36, 1) forwards; }
        .kb-1 { animation: kb-zoom-out 13s cubic-bezier(.22, 1, .36, 1) forwards; }
        .kb-2 { animation: kb-pan-left 13s ease-in-out forwards; }
        .kb-3 { animation: kb-pan-right 13s ease-in-out forwards; }
        .kb-4 { animation: kb-pan-up 13s ease-in-out forwards; }
        .kb-5 { animation: kb-pan-down 13s ease-in-out forwards; }
        .kb-6 { animation: kb-zoom-tl 13s ease-in-out forwards; }
        .kb-7 { animation: kb-zoom-br 13s ease-in-out forwards; }
        .viewer-title { font-family: 'Libre Caslon Text', serif; font-size: clamp(30px, 5vw, 54px); line-height: 1.12; color: #fff; margin: 0; opacity: 0; transform: translateY(18px); transition: opacity .9s cubic-bezier(.22, 1, .36, 1) .75s, transform .9s cubic-bezier(.22, 1, .36, 1) .75s; text-shadow: 0 2px 20px rgba(0, 0, 0, 0.5); }
        .viewer-title.show { opacity: 1; transform: translateY(0); }
        .viewer-tag { display: inline-block; font-family: 'Manrope', sans-serif; font-size: 11px; letter-spacing: 0.32em; text-transform: uppercase; color: #9fe0c0; opacity: 0; transform: translateY(10px); transition: opacity .7s ease .85s, transform .7s ease .85s; }
        .viewer-tag.show { opacity: 1; transform: translateY(0); }
        .viewer-desc { font-family: 'Manrope', sans-serif; font-size: 15px; line-height: 1.55; color: rgba(255, 255, 255, 0.85); max-width: 540px; margin: 0.8rem auto 0; opacity: 0; transform: translateY(10px); transition: opacity .7s ease .95s, transform .7s ease .95s; }
        .viewer-desc.show { opacity: 1; transform: translateY(0); }
        .viewer-close { position: absolute; top: 20px; right: 20px; z-index: 5; width: 48px; height: 48px; border-radius: 9999px; background: rgba(0, 0, 0, 0.35); border: 1px solid rgba(255, 255, 255, 0.25); color: #fff; display: grid; place-items: center; cursor: pointer; transition: background .3s ease, transform .3s ease, opacity .5s ease; backdrop-filter: blur(6px); -webkit-backdrop-filter: blur(6px); }
        .viewer-close:hover { background: rgba(88, 183, 137, 0.4); transform: rotate(90deg); }
        .viewer-hint { font-family: 'Manrope', sans-serif; font-size: 11px; letter-spacing: 0.25em; text-transform: uppercase; color: rgba(255, 255, 255, 0.5); display: block; margin-top: 16px; }
        .viewer-hint .material-symbols-outlined { font-size: 14px; vertical-align: -2px; }
        /* ============================================================
           MODE HORS LIGNE — affichage du site en HTML seul
           (activé via la classe .offline sur <html>/<body> quand la
           connexion internet est indisponible)
           ============================================================ */
        #offlineBanner {
            display: none;
            position: sticky;
            top: 0;
            z-index: 100;
            align-items: center;
            justify-content: center;
            gap: 10px;
            padding: 10px 24px;
            background: #b36b00;
            color: #fff;
            font-family: 'Manrope', ui-sans-serif, system-ui, sans-serif;
            font-size: 13px;
            line-height: 1.4;
            text-align: center;
        }
        html.offline #offlineBanner { display: flex; }
        #offlineBanner svg { flex-shrink: 0; }
        #offlineBanner strong { text-transform: uppercase; letter-spacing: .12em; font-size: 11px; }

        html.offline .hidden { display: none !important; }

        body.offline {
            font-family: ui-sans-serif, system-ui, -apple-system, "Segoe UI", Roboto, "Helvetica Neue", Arial, sans-serif;
            background: rgb(var(--background));
            color: rgb(var(--on-background));
            line-height: 1.6;
            margin: 0;
            overflow-x: hidden;
        }
        body.offline h1, body.offline h2, body.offline h3, body.offline h4 {
            font-family: Georgia, "Times New Roman", serif;
            line-height: 1.2;
        }
        body.offline img { max-width: 100%; height: auto; }
        body.offline a { color: rgb(var(--primary)); }
        body.offline .max-w-container-max { max-width: 1440px; margin-left: auto; margin-right: auto; }
        body.offline .text-primary { color: rgb(var(--on-background)); }
        body.offline .text-on-surface-variant { color: rgb(var(--on-surface-variant)); }
        body.offline .text-gold-light, body.offline .text-gold-dark { color: rgb(var(--gold)); }
        body.offline .material-symbols-outlined { display: none !important; }
        body.offline .kanji-watermark { display: none !important; }

        /* ---- Barre de navigation statique ---- */
        body.offline #mainNav {
            position: sticky; top: 0; z-index: 50;
            display: flex; align-items: center; justify-content: space-between;
            padding: 12px 24px;
            background: rgb(var(--surface-container));
            border-bottom: 1px solid rgb(var(--outline-variant));
        }
        body.offline #mainNav > div { display: flex; align-items: center; justify-content: space-between; gap: 16px; width: 100%; max-width: 1440px; margin: 0 auto; }
        body.offline #mainNav nav { display: flex; flex-wrap: wrap; gap: 18px; }
        body.offline #mainNav nav .nav-link {
            color: rgb(var(--on-surface)); font-size: 12px; letter-spacing: .08em;
            text-transform: uppercase; text-decoration: none; padding: 6px 2px;
        }
        body.offline #mainNav nav .nav-link:hover { color: rgb(var(--gold-dark)); }
        body.offline #btnMenu, body.offline #btnLogin, body.offline #btnBookNow,
        body.offline #btnMenuBook, body.offline #authArea, body.offline #userMenu { display: none !important; }

        /* ---- Hero simplifié ---- */
        body.offline #hero { height: auto; min-height: 0; display: block; padding: 56px 24px 0; }
        body.offline #hero > .absolute { display: none !important; }
        body.offline #heroDots { display: none !important; }
        body.offline #hero > .relative { position: relative; display: block; text-align: center; max-width: 720px; margin: 0 auto; padding-bottom: 40px; }
        body.offline #hero h1 { color: #fff; font-size: 38px; margin: 12px 0; }
        body.offline #hero p, body.offline #hero .eyebrow { color: rgb(var(--on-surface-variant)); }

        /* ---- Bandeau "Parmi les plus visités" ---- */
        body.offline #stats { height: auto; min-height: 0; padding: 64px 24px; }
        body.offline #stats > .absolute { display: none !important; }
        body.offline #stats h2 { color: rgb(var(--on-background)); }
        body.offline #stats p { color: rgb(var(--on-surface-variant)); }

        /* ---- Grilles -> empilement lisible ---- */
        body.offline .grid { display: block; }
        body.offline .grid > * { margin-bottom: 32px; }
        body.offline section { padding: 64px 24px; }
        body.offline section h2 { font-size: 32px; margin: 8px 0; }
        body.offline section h3 { font-size: 26px; margin: 8px 0; }
        body.offline section p { margin: 8px 0; color: rgb(var(--on-surface-variant)); }
        body.offline .text-center { text-align: center; }
        body.offline .eyebrow { color: rgb(var(--gold-dark)); }
        body.offline .glass-panel {
            background: rgb(var(--surface-container-low));
            border: 1px solid rgb(var(--outline-variant));
            border-radius: 12px; padding: 24px;
        }
        body.offline .btn-gold, body.offline .btn-submit {
            display: inline-block; background: rgb(var(--primary)); color: rgb(var(--on-primary));
            padding: 12px 24px; border-radius: 8px; border: none; cursor: pointer;
            font-size: 12px; letter-spacing: .1em; text-transform: uppercase; text-decoration: none;
        }

        /* ---- Interactions réseau désactivées (HTML seul) ---- */
        body.offline #bookingForm, body.offline #commentForm, body.offline #newsletterForm,
        body.offline #mapPins .map-pin, body.offline #siteViewer, body.offline #backToTop,
        body.offline #toast, body.offline #authModal, body.offline #mobileMenu,
        body.offline #myReservations, body.offline #distributionBars,
        body.offline #chatWidget, body.offline #weatherWidget { display: none !important; }
        body.offline #carte .glass-panel > p { color: rgb(var(--on-surface-variant)); }

        /* ---- Pied de page ---- */
        body.offline footer { background: #061b0e; color: rgba(249, 249, 246, .8); padding: 48px 24px; }
        body.offline footer a, body.offline footer h4 { color: #f9f9f6; }
        body.offline footer .grid { display: grid; grid-template-columns: repeat(auto-fit, minmax(200px, 1fr)); gap: 32px; }
        body.offline footer .grid > * { margin-bottom: 0; }
    </style>
</head>
<body class="bg-background text-on-background font-body-md antialiased overflow-x-hidden selection:bg-primary-container selection:text-primary-fixed">
<!-- Bandeau mode hors ligne (affiché uniquement sans connexion internet) -->
<div id="offlineBanner" role="status" aria-live="polite">
<svg width="18" height="18" viewBox="0 0 24 24" fill="currentColor" aria-hidden="true"><path d="M12 2C6.48 2 2 6.48 2 12s4.48 10 10 10 10-4.48 10-10S17.52 2 12 2zm-2 15l-5-5 1.41-1.41L10 14.17l7.59-7.59L19 8l-9 9z"/></svg>
<span><strong>Mode hors ligne</strong> · Affichage du site en HTML seul. Réservation, avis et connexion sont indisponibles jusqu'au retour de la connexion internet.</span>
</div>
<!-- Arrière-plan saisonnier au scroll (peint par app.js) -->
<div id="bgCanvas" aria-hidden="true"></div>
<!-- TopAppBar -->
<header class="fixed top-0 w-full z-50 transition-all duration-500 bg-transparent over-hero" id="mainNav">
<div class="flex items-center justify-between gap-4 px-margin-mobile md:px-margin-desktop py-3 max-w-container-max mx-auto">
<div class="flex items-center gap-3 md:gap-4">
<button aria-label="Ouvrir le menu" id="btnMenu" class="xl:hidden text-primary hover:text-gold-dark transition-colors">
<span class="material-symbols-outlined" style="font-variation-settings: 'FILL' 0;">menu</span>
</button>
<a href="#" class="flex items-center gap-3 leading-none shrink-0" aria-label="Retour en haut">
<span class="inline-flex items-center justify-center w-7 h-7 rounded-full overflow-hidden bg-white border border-black/20 shrink-0" aria-hidden="true">
<span class="block rounded-full" style="width:58%; height:58%; background:#d21f3c;"></span>
</span>
<span class="text-center">
<span id="brandName" class="hidden lg:block font-headline-md text-headline-md tracking-[0.3em] xl:tracking-[0.2em] xl:text-2xl text-primary transition-colors duration-500">SHINJUKU GYOEN</span>
<span id="brandKanji" class="mt-1 block text-xs sm:text-[10px] tracking-[0.5em] sm:tracking-[0.6em] text-gold-dark transition-colors duration-500">新宿御苑</span>
</span>
</a>
</div>
<nav class="hidden xl:flex items-center gap-8" aria-label="Navigation principale">
<a href="#histoire" class="nav-link">Notre histoire</a>
<a href="#jardins" class="nav-link">Les jardins</a>
<a href="#meteo" class="nav-link">Météo</a>
<a href="#carte" class="nav-link">Carte du jardin</a>
<a href="#booking" class="nav-link">Réservation</a>
<a href="#avis" class="nav-link">Avis</a>
</nav>
<div class="flex items-center gap-3 md:gap-4">
<div id="authArea" class="flex items-center gap-3">
<button id="btnLogin" class="font-label-sm text-label-sm text-primary uppercase tracking-widest hover:text-gold-dark transition-colors whitespace-nowrap">Connexion</button>
<span id="userMenu" class="hidden items-center gap-2 font-body-md text-body-md text-primary">
<span id="userName" class="max-w-[120px] truncate"></span>
<button id="btnLogout" class="font-label-sm text-label-sm uppercase tracking-widest text-gold-dark hover:text-error transition-colors" title="Se déconnecter">Déconnexion</button>
</span>
</div>
<button id="btnBookNow" class="hidden sm:inline-flex btn-gold bg-primary text-on-primary px-5 md:px-6 py-2.5 md:py-3 font-label-sm text-label-sm uppercase tracking-widest hover:bg-primary/90 shadow-lg shadow-primary/20 transition-all duration-300 whitespace-nowrap">
                    Book Now
                </button>
</div>
</div>
</header>

<!-- Mobile drawer menu -->
<div id="mobileMenu" class="fixed inset-0 z-[55] hidden">
<div class="absolute inset-0 bg-[#061b0e]/60 backdrop-blur-sm" data-close-menu></div>
<nav class="absolute top-0 left-0 h-full w-80 max-w-[85vw] bg-surface-bright shadow-2xl flex flex-col transition-transform duration-300 -translate-x-full" id="mobileMenuPanel">
<span aria-hidden="true" class="drawer-kanji absolute -right-6 -bottom-8 pointer-events-none select-none font-headline-md leading-none" style="font-size:130px;">御苑</span>
<div class="relative flex items-center justify-between p-8 pb-6">
<span class="leading-none">
<span class="font-headline-md text-headline-md tracking-[0.3em] text-primary block">SHINJUKU GYOEN</span>
<span class="text-[10px] tracking-[0.6em] text-gold-dark mt-1 block">新宿御苑</span>
</span>
<button aria-label="Fermer le menu" data-close-menu class="w-10 h-10 rounded-full border border-outline-variant text-on-surface-variant hover:text-primary hover:border-gold transition-colors flex items-center justify-center">
<span class="material-symbols-outlined" style="font-variation-settings: 'FILL' 0;">close</span>
</button>
</div>
<div class="gold-rule relative mx-8 mb-6"></div>
<div class="relative flex flex-col gap-1 px-4 flex-1 overflow-y-auto">
<a href="#histoire" data-close-menu class="menu-link flex items-center gap-4 px-4 py-3 rounded-lg text-on-surface-variant hover:bg-surface-container-high hover:text-primary transition-colors group">
<span class="font-headline-md text-sm text-gold-dark w-7 shrink-0">01</span>
<span class="flex flex-col leading-tight">
<span class="font-label-sm text-label-sm uppercase tracking-widest">Notre histoire</span>
<span class="text-xs text-on-surface-variant/60 mt-1">Héritage &amp; élégance</span>
</span>
<span class="ml-auto material-symbols-outlined text-lg text-on-surface-variant/40 group-hover:text-gold transition-colors" style="font-variation-settings:'FILL' 0;">arrow_forward</span>
</a>
<a href="#jardins" data-close-menu class="menu-link flex items-center gap-4 px-4 py-3 rounded-lg text-on-surface-variant hover:bg-surface-container-high hover:text-primary transition-colors group">
<span class="font-headline-md text-sm text-gold-dark w-7 shrink-0">02</span>
<span class="flex flex-col leading-tight">
<span class="font-label-sm text-label-sm uppercase tracking-widest">Les trois jardins</span>
<span class="text-xs text-on-surface-variant/60 mt-1">Japon, France, Angleterre</span>
</span>
<span class="ml-auto material-symbols-outlined text-lg text-on-surface-variant/40 group-hover:text-gold transition-colors" style="font-variation-settings:'FILL' 0;">arrow_forward</span>
</a>
<a href="#meteo" data-close-menu class="menu-link flex items-center gap-4 px-4 py-3 rounded-lg text-on-surface-variant hover:bg-surface-container-high hover:text-primary transition-colors group">
<span class="font-headline-md text-sm text-gold-dark w-7 shrink-0">03</span>
<span class="flex flex-col leading-tight">
<span class="font-label-sm text-label-sm uppercase tracking-widest">Météo</span>
<span class="text-xs text-on-surface-variant/60 mt-1">Conditions en temps réel</span>
</span>
<span class="ml-auto material-symbols-outlined text-lg text-on-surface-variant/40 group-hover:text-gold transition-colors" style="font-variation-settings:'FILL' 0;">arrow_forward</span>
</a>
<a href="#carte" data-close-menu class="menu-link flex items-center gap-4 px-4 py-3 rounded-lg text-on-surface-variant hover:bg-surface-container-high hover:text-primary transition-colors group">
<span class="font-headline-md text-sm text-gold-dark w-7 shrink-0">04</span>
<span class="flex flex-col leading-tight">
<span class="font-label-sm text-label-sm uppercase tracking-widest">Carte du jardin</span>
<span class="text-xs text-on-surface-variant/60 mt-1">Points d'intérêt &amp; promenades</span>
</span>
<span class="ml-auto material-symbols-outlined text-lg text-on-surface-variant/40 group-hover:text-gold transition-colors" style="font-variation-settings:'FILL' 0;">arrow_forward</span>
</a>
<a href="#booking" data-close-menu class="menu-link flex items-center gap-4 px-4 py-3 rounded-lg text-on-surface-variant hover:bg-surface-container-high hover:text-primary transition-colors group">
<span class="font-headline-md text-sm text-gold-dark w-7 shrink-0">05</span>
<span class="flex flex-col leading-tight">
<span class="font-label-sm text-label-sm uppercase tracking-widest">Réservation</span>
<span class="text-xs text-on-surface-variant/60 mt-1">Date &amp; créneau horaire</span>
</span>
<span class="ml-auto material-symbols-outlined text-lg text-on-surface-variant/40 group-hover:text-gold transition-colors" style="font-variation-settings:'FILL' 0;">arrow_forward</span>
</a>
<a href="#avis" data-close-menu class="menu-link flex items-center gap-4 px-4 py-3 rounded-lg text-on-surface-variant hover:bg-surface-container-high hover:text-primary transition-colors group">
<span class="font-headline-md text-sm text-gold-dark w-7 shrink-0">06</span>
<span class="flex flex-col leading-tight">
<span class="font-label-sm text-label-sm uppercase tracking-widest">Avis des visiteurs</span>
<span class="text-xs text-on-surface-variant/60 mt-1">Partagez votre expérience</span>
</span>
<span class="ml-auto material-symbols-outlined text-lg text-on-surface-variant/40 group-hover:text-gold transition-colors" style="font-variation-settings:'FILL' 0;">arrow_forward</span>
</a>
</div>
<div class="relative p-8 pt-4 mt-auto">
<div class="drawer-fade flex items-center justify-between mb-5 px-1">
<span class="font-label-sm text-label-sm text-on-surface-variant/70 uppercase tracking-widest">9h00 – 18h00</span>
<span class="font-label-sm text-label-sm text-gold-dark uppercase tracking-widest">Entrée 500 ¥</span>
</div>
<button id="btnMenuBook" data-close-menu class="drawer-fade btn-gold w-full bg-primary text-on-primary px-6 py-4 font-label-sm text-label-sm uppercase tracking-widest hover:bg-primary/90 transition-all duration-300">Réserver une visite</button>
<p class="drawer-fade text-center text-xs text-on-surface-variant/60 mt-4">Fermé le lundi · 11 Naitomachi, Shinjuku, Tokyo</p>
</div>
</nav>
</div>

<!-- Hero Section -->
<section id="hero" class="relative h-screen min-h-[800px] w-full overflow-hidden flex items-center justify-center">
<div class="absolute inset-0 z-0">
<div id="heroSlides" class="absolute inset-0">
<img alt="Shinjuku Gyoen National Garden" class="hero-slide active" src="images/hero.jpg"/>
<img alt="Footbridge over a pond in Shinjuku Gyoen" class="hero-slide" src="images/hero-pont.jpg"/>
<img alt="Japanese garden path in Shinjuku Gyoen" class="hero-slide" src="images/hero-jardin.jpg"/>
<img alt="Cherry blossoms at Shinjuku Gyoen" class="hero-slide" src="images/hero-sakura.jpg"/>
<img alt="Green trees in Shinjuku Gyoen" class="hero-slide" src="images/hero-verdure.jpg"/>
</div>
<div class="absolute inset-0 bg-gradient-to-b from-[#061b0e]/40 via-transparent to-background"></div>
</div>
<div class="relative z-10 text-center px-margin-mobile md:px-margin-desktop max-w-container-max mx-auto fade-in-up visible">
<div class="mb-5 text-gold-light text-2xl tracking-[0.5em]" style="font-family:'Libre Caslon Text',serif;">新宿御苑</div>
<span class="eyebrow font-label-sm text-label-sm text-white uppercase tracking-[0.2em] mb-5" style="gap:8px;">
<span class="inline-flex items-center justify-center w-4 h-4 rounded-full overflow-hidden bg-white border border-white/30 shrink-0" aria-hidden="true"><span class="block rounded-full" style="width:58%; height:58%; background:#d21f3c;"></span></span>
Tokyo · Japan</span>
<h1 class="font-headline-lg-mobile text-headline-lg-mobile md:font-display-lg md:text-display-lg text-white mb-6 drop-shadow-2xl">Une Oasis<br/>de Sérénité</h1>
<div class="gold-rule w-40 mx-auto mb-7"></div>
<p class="font-body-lg text-body-lg text-white/90 max-w-2xl mx-auto">Discover the harmonious blend of history, nature, and tranquility in the heart of the metropolis.</p>
</div>
<div id="heroDots"></div>
<div class="absolute bottom-12 left-1/2 -translate-x-1/2 z-10 flex flex-col items-center animate-bounce opacity-70">
<span class="font-label-sm text-label-sm text-white uppercase tracking-widest mb-2">Scroll to explore</span>
<span class="material-symbols-outlined text-white" style="font-variation-settings: 'FILL' 0;">arrow_downward</span>
</div>
</section>

<!-- Oiseaux en vol -->
<div class="bird-band" aria-hidden="true">
<div class="bird-cloud" style="top:22%; width:160px; height:44px; animation-duration:70s; animation-delay:-20s;"></div>
<div class="bird-cloud" style="top:58%; width:220px; height:54px; animation-duration:95s; animation-delay:-50s; opacity:0.5;"></div>
<div class="bird" style="top:26%; width:42px; height:21px; opacity:.85; animation-duration:32s; animation-delay:-6s;">
<svg class="bird-svg" viewBox="0 0 120 60"><path class="bird-wing" d="M55 32 C 40 10, 20 4, 2 8 C 20 18, 38 27, 55 32 Z"/><path class="bird-wing bird-wing-r" d="M65 32 C 80 10, 100 4, 118 8 C 100 18, 82 27, 65 32 Z"/><path class="bird-body" d="M53 34 C 57 39, 63 39, 67 34 C 64 40, 60 40, 56 34 Z"/></svg>
</div>
<div class="bird" style="top:52%; width:58px; height:29px; opacity:.9; animation-duration:27s; animation-delay:-14s;">
<svg class="bird-svg" viewBox="0 0 120 60"><path class="bird-wing" d="M55 32 C 40 10, 20 4, 2 8 C 20 18, 38 27, 55 32 Z"/><path class="bird-wing bird-wing-r" d="M65 32 C 80 10, 100 4, 118 8 C 100 18, 82 27, 65 32 Z"/><path class="bird-body" d="M53 34 C 57 39, 63 39, 67 34 C 64 40, 60 40, 56 34 Z"/></svg>
</div>
<div class="bird" style="top:38%; width:30px; height:15px; opacity:.7; animation-duration:38s; animation-delay:-2s;">
<svg class="bird-svg" viewBox="0 0 120 60"><path class="bird-wing" d="M55 32 C 40 10, 20 4, 2 8 C 20 18, 38 27, 55 32 Z"/><path class="bird-wing bird-wing-r" d="M65 32 C 80 10, 100 4, 118 8 C 100 18, 82 27, 65 32 Z"/><path class="bird-body" d="M53 34 C 57 39, 63 39, 67 34 C 64 40, 60 40, 56 34 Z"/></svg>
</div>
<div class="bird" style="top:14%; width:70px; height:35px; opacity:.75; animation-duration:44s; animation-delay:-24s;">
<svg class="bird-svg" viewBox="0 0 120 60"><path class="bird-wing" d="M55 32 C 40 10, 20 4, 2 8 C 20 18, 38 27, 55 32 Z"/><path class="bird-wing bird-wing-r" d="M65 32 C 80 10, 100 4, 118 8 C 100 18, 82 27, 65 32 Z"/><path class="bird-body" d="M53 34 C 57 39, 63 39, 67 34 C 64 40, 60 40, 56 34 Z"/></svg>
</div>
</div>

<!-- History Section -->
<section id="histoire" class="py-section-gap px-margin-mobile md:px-margin-desktop max-w-container-max mx-auto relative scroll-mt-24 overflow-hidden">
<div class="kanji-watermark right-[-2rem] top-1/2 -translate-y-1/2" style="font-size:260px;">御苑</div>
<div class="grid grid-cols-12 gap-gutter items-center">
<div class="col-span-12 md:col-span-5 fade-in-up">
<div class="glass-panel p-8 md:p-12 rounded-xl relative z-10 md:-mr-12 animate-float" style="animation-duration: 9s; animation-delay: .4s;">
<div class="eyebrow font-label-sm text-label-sm text-gold-dark uppercase tracking-[0.2em] mb-6 block">Notre histoire · 01</div>
<h2 class="font-headline-lg-mobile text-headline-lg-mobile md:font-headline-lg md:text-headline-lg text-primary mb-6">A Legacy of<br/>Elegance</h2>
<p class="font-body-lg text-body-lg text-on-surface-variant mb-6 leading-relaxed">Originally a residence of the Naitō family in the Edo period, Shinjuku Gyoen was later managed by the Imperial Household Agency before becoming a national garden. It stands as a testament to centuries of meticulous care and landscaping mastery.</p>
<button id="btnStory" class="flex items-center gap-2 font-label-sm text-label-sm text-primary uppercase tracking-widest group hover:text-gold-dark transition-colors">
<span>Read Our Story</span>
<span class="material-symbols-outlined transform group-hover:translate-x-2 transition-transform" style="font-variation-settings: 'FILL' 0;">arrow_forward</span>
</button>
</div>
</div>
<div class="col-span-12 md:col-span-7 fade-in-up" style="transition-delay: 200ms;">
<div class="img-frame relative animate-float">
<div class="aspect-[4/3] w-full rounded-DEFAULT overflow-hidden shadow-2xl relative z-10">
<img class="w-full h-full object-cover img-kenburns" data-alt="A vintage black and white photograph style image showing the historical gates of a grand Japanese estate in the Edo period, soft sepia tones, misty atmosphere, elegant architecture." src="images/history.jpg"/>
<div class="absolute inset-0 z-10 pointer-events-none overflow-hidden">
<span class="mote" style="left:18%; top:70%; animation-duration:9s; animation-delay:0s;"></span>
<span class="mote" style="left:38%; top:55%; animation-duration:11s; animation-delay:2.5s;"></span>
<span class="mote" style="left:62%; top:75%; animation-duration:8s; animation-delay:4.5s;"></span>
<span class="mote" style="left:82%; top:45%; animation-duration:10s; animation-delay:1.5s;"></span>
<span class="mote" style="left:70%; top:85%; animation-duration:12s; animation-delay:6s;"></span>
</div>
</div>
<div class="mt-5 flex items-center justify-center gap-4">
<div class="gold-rule rule-live flex-1 max-w-[120px]"></div>
<span class="font-label-sm text-label-sm text-gold-dark uppercase tracking-[0.25em]">Depuis 1906 · Jardin national</span>
<div class="gold-rule rule-live flex-1 max-w-[120px]" style="animation-delay: 1.6s;"></div>
</div>
</div>
</div>
</div>
</section>

<!-- Symphony of Landscapes (Les trois jardins) -->
<section id="jardins" class="py-section-gap px-margin-mobile md:px-margin-desktop relative overflow-hidden scroll-mt-24">
<div class="kanji-watermark left-[-3rem] top-8" style="font-size:220px;">庭園</div>
<div class="max-w-container-max mx-auto">
<div class="text-center mb-20 fade-in-up">
<span class="eyebrow font-label-sm text-label-sm text-gold-dark uppercase tracking-[0.2em] mb-5 block">Les trois jardins · 02</span>
<h2 class="font-headline-lg-mobile text-headline-lg-mobile md:font-headline-lg md:text-headline-lg text-primary mb-4">Symphony of Landscapes</h2>
<div class="gold-rule w-28 mx-auto mb-6"></div>
<p class="font-body-lg text-body-lg text-on-surface-variant max-w-3xl mx-auto leading-relaxed">Conçu sur le projet du paysagiste français Henri Martinet (1902–1906), Shinjuku Gyoen entrelace trois traditions : un parcours japonais contemplatif, un parterre français géométrique et une prairie anglaise ouverte — 58,3 hectares, 3,5 km de circonférence.</p>
</div>

<div class="grid grid-cols-12 gap-gutter items-center fade-in-up">
<div class="col-span-12 md:col-span-7">
<div class="img-frame relative">
<div class="aspect-[4/3] w-full rounded-DEFAULT overflow-hidden shadow-2xl relative z-10">
<img class="w-full h-full object-cover hover:scale-105 transition-transform duration-1000" alt="Jardin japonais traditionnel à Shinjuku Gyoen" src="images/japanese.jpg"/>
<span class="absolute bottom-4 right-4 bg-[#061b0e]/55 backdrop-blur-sm px-4 py-2 rounded-full border border-gold-light/40 font-label-sm text-label-sm text-white uppercase tracking-[0.25em]">日本庭園</span>
</div>
<div class="mt-5 flex items-center justify-center gap-4">
<div class="gold-rule flex-1 max-w-[120px]"></div>
<span class="font-label-sm text-label-sm text-gold-dark uppercase tracking-[0.25em]">Jardin à parcourir · 01</span>
<div class="gold-rule flex-1 max-w-[120px]"></div>
</div>
</div>
</div>
<div class="col-span-12 md:col-span-5 md:pl-12">
<h3 class="font-headline-lg-mobile text-headline-lg-mobile md:font-headline-lg md:text-headline-lg text-primary mb-2">Japanese Traditional</h3>
<p class="font-label-sm text-label-sm text-gold-dark uppercase tracking-widest mb-5">Nihon-teien · 日本庭園</p>
<p class="font-body-lg text-body-lg text-on-surface-variant leading-relaxed mb-7">Autour de l'étang supérieur, une promenade sinueuse longe îles, ponts et lanternes de pierre. Le pavillon chinois Kyū-Goryō-tei, offert en 1927 à l'occasion du mariage du prince héritier, voisine avec deux salons de thé nichés dans la verdure.</p>
<ul class="space-y-3.5">
<li class="flex items-start gap-3">
<span class="material-symbols-outlined text-gold mt-0.5" style="font-variation-settings:'FILL' 0;">pond</span>
<span class="font-body-md text-body-md text-on-surface-variant">Étangs et îles reliés par des ponts de pierre</span>
</li>
<li class="flex items-start gap-3">
<span class="material-symbols-outlined text-gold mt-0.5" style="font-variation-settings:'FILL' 0;">home</span>
<span class="font-body-md text-body-md text-on-surface-variant">Pavillon chinois Kyū-Goryō-tei et salons de thé Rakuu-tei, Shōten-tei</span>
</li>
<li class="flex items-start gap-3">
<span class="material-symbols-outlined text-gold mt-0.5" style="font-variation-settings:'FILL' 0;">local_florist</span>
<span class="font-body-md text-body-md text-on-surface-variant">Exposition impériale de chrysanthèmes chaque novembre</span>
</li>
</ul>
<div class="gold-rule w-24 mt-7 mb-6"></div>
<div class="flex flex-wrap gap-10">
<div>
<div class="stat-num text-4xl leading-none">1903</div>
<div class="font-label-sm text-label-sm text-on-surface-variant/70 uppercase tracking-widest mt-2">Jardin actuel</div>
</div>
<div>
<div class="stat-num text-4xl leading-none">2</div>
<div class="font-label-sm text-label-sm text-on-surface-variant/70 uppercase tracking-widest mt-2">Salons de thé</div>
</div>
</div>
</div>
</div>

<div class="mt-16 md:mt-24 grid grid-cols-12 gap-gutter items-center fade-in-up">
<div class="col-span-12 md:col-span-5 md:pr-12 order-2 md:order-1">
<h3 class="font-headline-lg-mobile text-headline-lg-mobile md:font-headline-lg md:text-headline-lg text-primary mb-2">French Formal</h3>
<p class="font-label-sm text-label-sm text-gold-dark uppercase tracking-widest mb-5">Furansu-shiki · フランス式庭園</p>
<p class="font-body-lg text-body-lg text-on-surface-variant leading-relaxed mb-7">Symétrie parfaite et géométrie stricte : deux pelouses centrales encadrées de rosiers et de haies basses, des topiaires taillées au cordeau et huit rangées de platanes qui flamboient d'or à l'automne.</p>
<ul class="space-y-3.5">
<li class="flex items-start gap-3">
<span class="material-symbols-outlined text-gold mt-0.5" style="font-variation-settings:'FILL' 0;">local_florist</span>
<span class="font-body-md text-body-md text-on-surface-variant">Pelouses centrales bordées de rosiers et de haies basses</span>
</li>
<li class="flex items-start gap-3">
<span class="material-symbols-outlined text-gold mt-0.5" style="font-variation-settings:'FILL' 0;">forest</span>
<span class="font-body-md text-body-md text-on-surface-variant">Huit rangées de platanes, dorées aux couleurs d'automne</span>
</li>
<li class="flex items-start gap-3">
<span class="material-symbols-outlined text-gold mt-0.5" style="font-variation-settings:'FILL' 0;">architecture</span>
<span class="font-body-md text-body-md text-on-surface-variant">Héritage du plan d'Henri Martinet, achevé en 1906</span>
</li>
</ul>
<div class="gold-rule w-24 mt-7 mb-6"></div>
<div class="flex flex-wrap gap-10">
<div>
<div class="stat-num text-4xl leading-none">500</div>
<div class="font-label-sm text-label-sm text-on-surface-variant/70 uppercase tracking-widest mt-2">Rosiers · 100 espèces</div>
</div>
<div>
<div class="stat-num text-4xl leading-none">160</div>
<div class="font-label-sm text-label-sm text-on-surface-variant/70 uppercase tracking-widest mt-2">Platanes en 8 rangées</div>
</div>
</div>
</div>
<div class="col-span-12 md:col-span-7 order-1 md:order-2">
<div class="img-frame relative">
<div class="aspect-[4/3] w-full rounded-DEFAULT overflow-hidden shadow-2xl relative z-10">
<img class="w-full h-full object-cover hover:scale-105 transition-transform duration-1000" alt="Jardin à la française à Shinjuku Gyoen" src="images/french.jpg"/>
<span class="absolute bottom-4 right-4 bg-[#061b0e]/55 backdrop-blur-sm px-4 py-2 rounded-full border border-gold-light/40 font-label-sm text-label-sm text-white uppercase tracking-[0.25em]">フランス式庭園</span>
</div>
<div class="mt-5 flex items-center justify-center gap-4">
<div class="gold-rule flex-1 max-w-[120px]"></div>
<span class="font-label-sm text-label-sm text-gold-dark uppercase tracking-[0.25em]">Symétrie &amp; roses · 02</span>
<div class="gold-rule flex-1 max-w-[120px]"></div>
</div>
</div>
</div>
</div>

<div class="mt-16 md:mt-24 grid grid-cols-12 gap-gutter items-center fade-in-up">
<div class="col-span-12 md:col-span-7">
<div class="img-frame relative">
<div class="aspect-[4/3] w-full rounded-DEFAULT overflow-hidden shadow-2xl relative z-10">
<img class="w-full h-full object-cover hover:scale-105 transition-transform duration-1000" alt="Jardin paysager anglais à Shinjuku Gyoen" src="images/english.jpg"/>
<span class="absolute bottom-4 right-4 bg-[#061b0e]/55 backdrop-blur-sm px-4 py-2 rounded-full border border-gold-light/40 font-label-sm text-label-sm text-white uppercase tracking-[0.25em]">イギリス式庭園</span>
</div>
<div class="mt-5 flex items-center justify-center gap-4">
<div class="gold-rule flex-1 max-w-[120px]"></div>
<span class="font-label-sm text-label-sm text-gold-dark uppercase tracking-[0.25em]">Pelouses &amp; tulipiers · 03</span>
<div class="gold-rule flex-1 max-w-[120px]"></div>
</div>
</div>
</div>
<div class="col-span-12 md:col-span-5 md:pl-12">
<h3 class="font-headline-lg-mobile text-headline-lg-mobile md:font-headline-lg md:text-headline-lg text-primary mb-2">English Landscape</h3>
<p class="font-label-sm text-label-sm text-gold-dark uppercase tracking-widest mb-5">Eikoku-shiki · イギリス式庭園</p>
<p class="font-body-lg text-body-lg text-on-surface-variant leading-relaxed mb-7">De vastes pelouses ouvertes, plantées de tulipiers et de cèdres de l'Himalaya, s'étendent au soleil. Lieu de pique-nique favori des Tokyoïtes, la prairie s'illumine au printemps de cerisiers plantés en périphérie.</p>
<ul class="space-y-3.5">
<li class="flex items-start gap-3">
<span class="material-symbols-outlined text-gold mt-0.5" style="font-variation-settings:'FILL' 0;">park</span>
<span class="font-body-md text-body-md text-on-surface-variant">Vastes pelouses ouvertes, idéales pour pique-niquer</span>
</li>
<li class="flex items-start gap-3">
<span class="material-symbols-outlined text-gold mt-0.5" style="font-variation-settings:'FILL' 0;">eco</span>
<span class="font-body-md text-body-md text-on-surface-variant">Tulipiers et cèdres de l'Himalaya séculaires</span>
</li>
<li class="flex items-start gap-3">
<span class="material-symbols-outlined text-gold mt-0.5" style="font-variation-settings:'FILL' 0;">straighten</span>
<span class="font-body-md text-body-md text-on-surface-variant">La « Vista Line » ouvre une perspective majestueuse vers le jardin français</span>
</li>
</ul>
<div class="gold-rule w-24 mt-7 mb-6"></div>
<div class="flex flex-wrap gap-10">
<div>
<div class="stat-num text-4xl leading-none">3,5 km</div>
<div class="font-label-sm text-label-sm text-on-surface-variant/70 uppercase tracking-widest mt-2">Périmètre du jardin</div>
</div>
<div>
<div class="stat-num text-4xl leading-none">1 000+</div>
<div class="font-label-sm text-label-sm text-on-surface-variant/70 uppercase tracking-widest mt-2">Cerisiers au printemps</div>
</div>
</div>
</div>
</div>

<div class="mt-24 border-t border-outline-variant/40 pt-16 fade-in-up">
<div class="grid grid-cols-1 md:grid-cols-3 gap-12 text-center">
<div>
<span class="material-symbols-outlined text-gold text-4xl" style="font-variation-settings:'FILL' 0;">forest</span>
<div class="font-headline-md text-headline-md text-primary mt-3">20 000+</div>
<p class="font-body-md text-body-md text-on-surface-variant text-sm leading-relaxed mt-2 max-w-xs mx-auto">Arbres et arbustes composent le couvert du jardin, dont des cèdres de l'Himalaya et un platane de Londres au tronc de plus de 6 mètres de circonférence.</p>
</div>
<div class="md:border-l md:border-r md:border-outline-variant/40">
<span class="material-symbols-outlined text-gold text-4xl" style="font-variation-settings:'FILL' 0;">local_florist</span>
<div class="font-headline-md text-headline-md text-primary mt-3">100</div>
<p class="font-body-md text-body-md text-on-surface-variant text-sm leading-relaxed mt-2 max-w-xs mx-auto">Espèces de rosiers réunies dans le jardin français. En novembre, l'exposition de chrysanthèmes, héritage de la famille impériale, attire les visiteurs.</p>
</div>
<div>
<span class="material-symbols-outlined text-gold text-4xl" style="font-variation-settings:'FILL' 0;">spa</span>
<div class="font-headline-md text-headline-md text-primary mt-3">2 750 m²</div>
<p class="font-body-md text-body-md text-on-surface-variant text-sm leading-relaxed mt-2 max-w-xs mx-auto">La serre, reconstruite en 2012 dans un esprit éco-responsable, abrite près de 1 000 variétés de plantes tropicales et subtropicales, dont des espèces menacées.</p>
</div>
</div>
</div>
</div>
</section>

<!-- Seasonal Flora (Sakura) -->
<section class="py-section-gap px-margin-mobile md:px-margin-desktop max-w-container-max mx-auto relative overflow-hidden">
<div class="petal" style="left:8%; font-size:18px; animation-duration:11s; animation-delay:0s;">❀</div>
<div class="petal" style="left:28%; font-size:13px; animation-duration:14s; animation-delay:3s;">❀</div>
<div class="petal" style="left:55%; font-size:20px; animation-duration:17s; animation-delay:6s;">❀</div>
<div class="petal" style="left:76%; font-size:14px; animation-duration:12s; animation-delay:2s;">❀</div>
<div class="petal" style="left:92%; font-size:16px; animation-duration:15s; animation-delay:8s;">❀</div>
<div class="grid grid-cols-12 gap-gutter items-center">
<div class="col-span-12 md:col-span-7 fade-in-up order-2 md:order-1">
<div class="relative w-full aspect-[16/9] rounded-xl overflow-hidden shadow-2xl">
<img alt="Cherry Blossoms at Shinjuku Gyoen" class="w-full h-full object-cover hover:scale-105 transition-transform duration-1000" src="images/sakura.jpg"/>
<div class="absolute bottom-4 right-4 bg-[#061b0e]/50 backdrop-blur-sm px-4 py-2 rounded-full border border-gold-light/40 font-label-sm text-label-sm text-white uppercase tracking-[0.25em]">Hanami · 花見</div>
</div>
</div>
<div class="col-span-12 md:col-span-5 fade-in-up order-1 md:order-2 md:pl-12">
<div class="eyebrow font-label-sm text-label-sm text-gold-dark uppercase tracking-[0.2em] mb-4 block">Les saisons · 03</div>
<h2 class="font-headline-lg-mobile text-headline-lg-mobile md:font-headline-lg md:text-headline-lg text-primary mb-6">The Fleeting Beauty of Sakura</h2>
<p class="font-body-lg text-body-lg text-on-surface-variant mb-8 leading-relaxed">Spring transforms the garden into a surreal landscape of pink hues. With over a thousand cherry trees of varying species, the bloom period here is longer than almost anywhere else in Tokyo, offering a transcendent hanami experience.</p>
<div class="glass-panel p-6 rounded-lg inline-block relative">
<div class="flex items-center gap-3">
<span class="material-symbols-outlined text-gold" style="font-variation-settings:'FILL' 0;">local_florist</span>
<div>
<div class="font-label-sm text-label-sm text-on-surface-variant uppercase tracking-widest mb-1">Next Bloom Forecast</div>
<div class="font-headline-md text-headline-md text-primary">Late March</div>
</div>
</div>
</div>
    </div>
</div>
</section>

<!-- ============================================================
     MÉTÉO EN TEMPS RÉEL — OpenWeatherMap API
     ============================================================ -->
<section id="meteo" class="py-section-gap px-margin-mobile md:px-margin-desktop max-w-container-max mx-auto relative scroll-mt-24 overflow-hidden">
<div class="kanji-watermark left-[-3rem] top-10" style="font-size:200px;">天気</div>
<div class="text-center mb-16 fade-in-up">
<span class="eyebrow font-label-sm text-label-sm text-gold-dark uppercase tracking-[0.2em] mb-5 block">Météo · 04</span>
<h2 class="font-headline-lg-mobile text-headline-lg-mobile md:font-headline-lg md:text-headline-lg text-primary mb-4">Météo au jardin</h2>
<div class="gold-rule w-28 mx-auto mb-6"></div>
<p class="font-body-lg text-body-lg text-on-surface-variant max-w-2xl mx-auto">Consultez les conditions météorologiques en temps réel pour planifier votre visite au Shinjuku Gyoen.</p>
</div>

<!-- Widget Météo Principal -->
<div id="weatherWidget" class="fade-in-up">
<div class="glass-panel p-6 sm:p-8 md:p-10 rounded-xl relative overflow-hidden">
<!-- Ligne décorative en haut -->
<div class="absolute top-0 left-0 right-0 h-1 bg-gradient-to-r from-gold-dark via-gold to-gold-light"></div>

<!-- État de chargement -->
<div id="weatherLoading" class="flex flex-col items-center justify-center py-12 gap-4">
<div class="weather-spinner"></div>
<p class="font-body-md text-body-md text-on-surface-variant">Chargement de la météo...</p>
</div>

<!-- Message d'erreur (caché par défaut) -->
<div id="weatherError" class="hidden flex-col items-center justify-center py-12 gap-4">
<span class="material-symbols-outlined text-error text-5xl" style="font-variation-settings:'FILL' 0;">cloud_off</span>
<p id="weatherErrorMsg" class="font-body-md text-body-md text-on-surface-variant text-center">Impossible de charger les données météo.</p>
<button id="weatherRetry" class="mt-2 font-label-sm text-label-sm text-gold-dark uppercase tracking-widest hover:text-primary transition-colors">Réessayer</button>
</div>

<!-- Contenu météo (caché au chargement) -->
<div id="weatherContent" class="hidden">
<!-- Ligne du haut : localisation + date -->
<div class="flex flex-wrap items-center justify-between gap-3 mb-6">
<div class="flex items-center gap-2">
<span class="material-symbols-outlined text-gold" style="font-variation-settings:'FILL' 0;">location_on</span>
<span class="font-label-sm text-label-sm text-on-surface-variant uppercase tracking-widest">Shinjuku Gyoen · Tokyo</span>
</div>
<span id="weatherDate" class="font-label-sm text-label-sm text-on-surface-variant/70 uppercase tracking-widest"></span>
</div>

<!-- Zone principale : temp actuelle + prévisions -->
<div class="grid grid-cols-12 gap-6 md:gap-10">

<!-- Colonne gauche : temps actuel -->
<div class="col-span-12 md:col-span-5 text-center md:text-left md:border-r md:border-outline-variant/30 md:pr-10">
<div class="flex flex-col md:flex-row items-center md:items-start gap-6">
<div id="weatherIcon" class="weather-icon-wrap">
<img id="weatherIconImg" src="" alt="" class="w-full h-full"/>
</div>
<div>
<div class="flex items-baseline justify-center md:justify-start gap-1">
<span id="weatherTemp" class="font-display-lg text-display-lg md:text-[72px] text-primary leading-none">--</span>
<span class="text-on-surface-variant/60 text-2xl mt-2">°C</span>
</div>
<div id="weatherDesc" class="font-body-lg text-body-lg text-on-surface-variant mt-1 capitalize">--</div>
<div id="weatherFeelsLike" class="font-label-sm text-label-sm text-on-surface-variant/70 uppercase tracking-widest mt-2">Ressenti : -- °C</div>
</div>
</div>

<!-- Détails -->
<div class="grid grid-cols-3 gap-4 mt-6 pt-6 border-t border-outline-variant/30">
<div class="text-center">
<span class="material-symbols-outlined text-gold text-xl" style="font-variation-settings:'FILL' 0;">water_drop</span>
<div id="weatherHumidity" class="font-headline-md text-headline-md text-primary mt-1">--%</div>
<div class="font-label-sm text-label-sm text-on-surface-variant/60 uppercase tracking-widest text-[10px]">Humidité</div>
</div>
<div class="text-center">
<span class="material-symbols-outlined text-gold text-xl" style="font-variation-settings:'FILL' 0;">air</span>
<div id="weatherWind" class="font-headline-md text-headline-md text-primary mt-1">--</div>
<div class="font-label-sm text-label-sm text-on-surface-variant/60 uppercase tracking-widest text-[10px]">Vent</div>
</div>
<div class="text-center">
<span class="material-symbols-outlined text-gold text-xl" style="font-variation-settings:'FILL' 0;">visibility</span>
<div id="weatherVisibility" class="font-headline-md text-headline-md text-primary mt-1">--</div>
<div class="font-label-sm text-label-sm text-on-surface-variant/60 uppercase tracking-widest text-[10px]">Visibilité</div>
</div>
</div>

<!-- Lever / Coucher du soleil -->
<div class="flex items-center justify-center md:justify-start gap-6 mt-5 pt-5 border-t border-outline-variant/30">
<div class="flex items-center gap-2">
<span class="material-symbols-outlined text-gold text-lg" style="font-variation-settings:'FILL' 0;">wb_twilight</span>
<div>
<div id="weatherSunrise" class="font-label-sm text-label-sm text-on-surface font-semibold">--:--</div>
<div class="font-label-sm text-[10px] text-on-surface-variant/60 uppercase tracking-widest">Lever</div>
</div>
</div>
<div class="flex items-center gap-2">
<span class="material-symbols-outlined text-gold text-lg" style="font-variation-settings:'FILL' 0;">dark_mode</span>
<div>
<div id="weatherSunset" class="font-label-sm text-label-sm text-on-surface font-semibold">--:--</div>
<div class="font-label-sm text-[10px] text-on-surface-variant/60 uppercase tracking-widest">Coucher</div>
</div>
</div>
</div>
</div>

<!-- Colonne droite : prévisions 5 jours -->
<div class="col-span-12 md:col-span-7 mt-6 md:mt-0">
<div class="font-label-sm text-label-sm text-on-surface-variant uppercase tracking-widest mb-4 flex items-center gap-2">
<span class="material-symbols-outlined text-gold text-base" style="font-variation-settings:'FILL' 0;">calendar_month</span>
Prévisions 5 jours
</div>
<div id="weatherForecast" class="grid grid-cols-5 gap-2 sm:gap-3"></div>
</div>
</div>

<!-- Bandeau conseil -->
<div id="weatherAdvice" class="mt-6 pt-5 border-t border-outline-variant/30 flex items-center gap-3">
<span class="material-symbols-outlined text-gold" style="font-variation-settings:'FILL' 0;">tips_and_updates</span>
<span id="weatherAdviceText" class="font-body-md text-body-md text-on-surface-variant"></span>
</div>

<!-- Dernière mise à jour -->
<div class="mt-4 flex items-center justify-between">
<span id="weatherUpdated" class="font-label-sm text-[10px] text-on-surface-variant/50 uppercase tracking-widest">Mis à jour à --:--</span>
<span class="font-label-sm text-[10px] text-on-surface-variant/50 uppercase tracking-widest">Données OpenWeatherMap</span>
</div>
</div>
</div>
</div>
</section>

<!-- Garden Map -->
<section id="carte" class="py-section-gap px-margin-mobile md:px-margin-desktop max-w-container-max mx-auto relative scroll-mt-24 overflow-hidden">
<div class="kanji-watermark left-[-3rem] bottom-10" style="font-size:220px;">地図</div>
<div class="text-center mb-16 fade-in-up">
<span class="eyebrow font-label-sm text-label-sm text-gold-dark uppercase tracking-[0.2em] mb-5 block">Plan du jardin · 05</span>
<h2 class="font-headline-lg-mobile text-headline-lg-mobile md:font-headline-lg md:text-headline-lg text-primary mb-4">Carte du jardin</h2>
<div class="gold-rule w-28 mx-auto mb-6"></div>
<p class="font-body-lg text-body-lg text-on-surface-variant max-w-2xl mx-auto">Trois jardins, des étangs paisibles et des lieux de détente : explorez le plan et survolez les points d'intérêt pour composer votre promenade.</p>
</div>
<div class="fade-in-up">
<div class="glass-panel p-4 sm:p-6 rounded-xl relative">
<div class="map-wrap relative">
<img alt="Plan vectoriel du jardin national de Shinjuku Gyoen" class="w-full h-auto select-none pointer-events-none rounded-lg border border-gold/30" draggable="false" src="images/map-plan.svg"/>
<div class="absolute inset-0" id="mapPins">
<button class="map-pin" data-imgs="images/japanese.jpg|images/japanese-2.jpg|images/japanese-3.jpg" data-audio="audio/japanese.mp3" style="left:23.7%; top:46.2%;" aria-label="Jardin japonais traditionnel">
<span class="map-dot" aria-hidden="true"></span>
<span class="map-lbl map-lbl--above">Jardin japonais</span>
<span class="map-tip" role="tooltip"><strong>Jardin japonais</strong><small class="tip-tag">Nihon-teien · 日本庭園</small><span class="tip-desc">Étangs, îles et pins taillés avec soin autour d'une maison de thé.</span></span>
</button>
<button class="map-pin" data-imgs="images/french.jpg|images/french-2.jpg|images/french-3.jpg" data-audio="audio/french.mp3" style="left:81.8%; top:73.2%;" aria-label="Jardin à la française">
<span class="map-dot" aria-hidden="true"></span>
<span class="map-lbl">Jardin à la française</span>
<span class="map-tip" role="tooltip"><strong>Jardin à la française</strong><small class="tip-tag">Furansu-shiki · フランス風</small><span class="tip-desc">Roseraie et allées géométriques au tracé symétrique.</span></span>
</button>
<button class="map-pin" data-imgs="images/english.jpg|images/english-2.jpg|images/english-3.jpg" data-audio="audio/english.mp3" style="left:63.4%; top:53.6%;" aria-label="Jardin paysager anglais">
<span class="map-dot" aria-hidden="true"></span>
<span class="map-lbl">Jardin anglais</span>
<span class="map-tip" role="tooltip"><strong>Jardin anglais</strong><small class="tip-tag">Eikoku-shiki · 英国式</small><span class="tip-desc">Vastes pelouses, tulipiers et platanes centenaires.</span></span>
</button>
<button class="map-pin" data-imgs="images/teahouse.jpg|images/teahouse-2.jpg|images/teahouse-3.jpg" data-audio="audio/teahouse.mp3" style="left:41.2%; top:57.8%;" aria-label="Maison de thé">
<span class="map-dot" aria-hidden="true"></span>
<span class="map-lbl">Maison de thé</span>
<span class="map-tip" role="tooltip"><strong>Maison de thé</strong><small class="tip-tag">Chashitsu · 茶室</small><span class="tip-desc">La cérémonie du thé, face au miroir des étangs.</span></span>
</button>
<button class="map-pin" data-imgs="images/restaurant.jpg|images/restaurant-2.jpg" data-audio="audio/restaurant.mp3" style="left:35.9%; top:30.4%;" aria-label="Restaurant">
<span class="map-dot" aria-hidden="true"></span>
<span class="map-lbl">Restaurant</span>
<span class="map-tip" role="tooltip"><strong>Restaurant</strong><small class="tip-tag">Cuisine &amp; détente</small><span class="tip-desc">Une pause gourmande au cœur du parc.</span></span>
</button>
<button class="map-pin" data-imgs="images/greenhouse.jpg|images/greenhouse-2.jpg|images/greenhouse-3.jpg" data-audio="audio/greenhouse.mp3" style="left:70.7%; top:31.3%;" aria-label="Serre">
<span class="map-dot" aria-hidden="true"></span>
<span class="map-lbl">Serre</span>
<span class="map-tip" role="tooltip"><strong>Serre</strong><small class="tip-tag">Greenhouse</small><span class="tip-desc">Collections exotiques à contempler toute l'année.</span></span>
</button>
<button class="map-pin" data-imgs="images/forest.jpg|images/forest-2.jpg|images/forest-3.jpg" data-audio="audio/forest.mp3" style="left:50.8%; top:23.1%;" aria-label="Forêt Mère et Enfant">
<span class="map-dot" aria-hidden="true"></span>
<span class="map-lbl">Forêt Mère &amp; Enfant</span>
<span class="map-tip" role="tooltip"><strong>Forêt Mère &amp; Enfant</strong><small class="tip-tag">Haha to ko no mori</small><span class="tip-desc">Un écrin d'ombre pensé pour les familles.</span></span>
</button>
<button class="map-pin" data-imgs="images/pond-kami.jpg|images/pond-kami-2.jpg|images/pond-kami-3.jpg" data-audio="audio/pond-kami.mp3" style="left:28.6%; top:49.0%;" aria-label="Étang Kami no ike">
<span class="map-dot" aria-hidden="true"></span>
<span class="map-lbl">Étang Kami no ike</span>
<span class="map-tip" role="tooltip"><strong>Étang Kami no ike</strong><small class="tip-tag">Étang supérieur</small><span class="tip-desc">Reflets paisibles du jardin japonais.</span></span>
</button>
<button class="map-pin" data-imgs="images/pond-tamamo.jpg|images/pond-tamamo-2.jpg|images/pond-tamamo-3.jpg" data-audio="audio/pond-tamamo.mp3" style="left:23.3%; top:25.3%;" aria-label="Étang Tamamo">
<span class="map-dot" aria-hidden="true"></span>
<span class="map-lbl">Étang Tamamo</span>
<span class="map-tip" role="tooltip"><strong>Étang Tamamo</strong><small class="tip-tag">Tamamo ike</small><span class="tip-desc">Eaux calmes aux abords de la pelouse.</span></span>
</button>
<button class="map-pin" data-imgs="images/gate-okido.jpg|images/gate-okido-2.jpg|images/gate-okido-3.jpg" data-audio="audio/gate-okido.mp3" style="left:78.7%; top:30.6%;" aria-label="Porte Okido">
<span class="map-dot" aria-hidden="true"></span>
<span class="map-lbl map-lbl--above">Porte Okido</span>
<span class="map-tip" role="tooltip"><strong>Porte Okido</strong><small class="tip-tag">Okido gate</small><span class="tip-desc">Un accès paisible pour entrer dans le jardin.</span></span>
</button>
<button class="map-pin" data-imgs="images/gate-shinjuku.jpg|images/gate-shinjuku-2.jpg|images/gate-shinjuku-3.jpg" data-audio="audio/gate-shinjuku.mp3" style="left:31.1%; top:12.1%;" aria-label="Porte Shinjuku">
<span class="map-dot" aria-hidden="true"></span>
<span class="map-lbl">Porte Shinjuku</span>
<span class="map-tip" role="tooltip"><strong>Porte Shinjuku</strong><small class="tip-tag">Shinjuku Gate</small><span class="tip-desc">L'accès principal, à côté du centre d'information.</span></span>
</button>
</div>
</div>
<p class="mt-4 font-body-md text-body-md text-on-surface-variant text-center">Survolez un point pour le détail, cliquez pour une immersion en plein écran.</p>
<p class="mt-1 font-label-sm text-label-sm text-on-surface-variant/60 text-center">Plan vectoriel établi d'après les données © OpenStreetMap contributors (ODbL)</p>
</div>
</div>
</section>

<!-- Pétales portées par le vent (au-dessus de la citation) -->
<div class="petal-band" aria-hidden="true">
<div class="petal-wind" style="top:6%; width:26px; height:26px; animation-duration:15s; animation-delay:-3s;"><svg viewBox="0 0 100 100"><path d="M46 4 C 20 30, 16 64, 50 96 C 84 64, 80 30, 54 4 L 50 18 L 46 4 Z" fill="rgba(246,178,200,0.9)"/></svg></div>
<div class="petal-wind petal-far" style="top:22%; width:14px; height:14px; animation-duration:23s; animation-delay:-9s;"><svg viewBox="0 0 100 100"><path d="M46 4 C 20 30, 16 64, 50 96 C 84 64, 80 30, 54 4 L 50 18 L 46 4 Z" fill="rgba(243,203,217,0.9)"/></svg></div>
<div class="petal-wind" style="top:38%; width:20px; height:20px; animation-duration:17s; animation-delay:-12s;"><svg viewBox="0 0 100 100"><path d="M46 4 C 20 30, 16 64, 50 96 C 84 64, 80 30, 54 4 L 50 18 L 46 4 Z" fill="rgba(231,168,191,0.9)"/></svg></div>
<div class="petal-wind petal-far" style="top:55%; width:12px; height:12px; animation-duration:26s; animation-delay:-6s;"><svg viewBox="0 0 100 100"><path d="M46 4 C 20 30, 16 64, 50 96 C 84 64, 80 30, 54 4 L 50 18 L 46 4 Z" fill="rgba(239,184,203,0.9)"/></svg></div>
<div class="petal-wind" style="top:70%; width:22px; height:22px; animation-duration:19s; animation-delay:-15s;"><svg viewBox="0 0 100 100"><path d="M46 4 C 20 30, 16 64, 50 96 C 84 64, 80 30, 54 4 L 50 18 L 46 4 Z" fill="rgba(250,199,216,0.9)"/></svg></div>
<div class="petal-wind petal-far" style="top:82%; width:16px; height:16px; animation-duration:21s; animation-delay:-1s;"><svg viewBox="0 0 100 100"><path d="M46 4 C 20 30, 16 64, 50 96 C 84 64, 80 30, 54 4 L 50 18 L 46 4 Z" fill="rgba(235,205,220,0.85)"/></svg></div>
</div>

<!-- Le jardin parmi les plus visités du monde -->
<section id="stats" class="relative w-full min-h-screen flex items-center py-24 overflow-hidden">
<div class="absolute inset-0 z-0" style="-webkit-mask-image: linear-gradient(180deg, transparent 0%, black 16%, black 84%, transparent 100%); mask-image: linear-gradient(180deg, transparent 0%, black 16%, black 84%, transparent 100%);">
<img alt="" class="absolute inset-0 w-full h-full object-cover scale-110" style="filter: blur(20px) saturate(0.85) brightness(0.55);" src="images/hero-sakura.jpg"/>
<div class="absolute inset-0 bg-[#061b0e]/50"></div>
</div>
<div class="relative z-10 w-full max-w-container-max mx-auto px-margin-mobile md:px-margin-desktop">
<div class="grid grid-cols-12 gap-gutter items-center">
<div class="col-span-12 lg:col-span-5 fade-in-up">
<span class="eyebrow font-label-sm text-label-sm text-gold-light uppercase tracking-[0.2em] mb-6 block">Shinjuku Gyoen · Tokyo</span>
<h2 class="font-headline-lg-mobile text-headline-lg-mobile md:font-headline-lg md:text-headline-lg text-white mb-6 leading-snug">Parmi les endroits les plus visités de la planète</h2>
<div class="gold-rule w-28 mb-7"></div>
<p class="font-body-lg text-body-lg text-white/85 max-w-lg mb-9">Au cœur de Tokyo, ce jardin national attire des millions de visiteurs chaque année et figure aux palmarès des grands espaces verts du monde, aux côtés de Central Park ou de Hyde Park.</p>
<div class="grid grid-cols-1 sm:grid-cols-3 gap-4 sm:gap-6 mb-10">
<div class="border-l border-gold-light/40 pl-4">
<div class="font-headline-md text-headline-md text-gold-light leading-none mb-1">3,5 M</div>
<div class="font-label-sm text-label-sm text-white/60 uppercase tracking-widest">Visiteurs / an</div>
</div>
<div class="border-l border-gold-light/40 pl-4">
<div class="font-headline-md text-headline-md text-gold-light leading-none mb-1">58 ha</div>
<div class="font-label-sm text-label-sm text-white/60 uppercase tracking-widest">de jardins</div>
</div>
<div class="border-l border-gold-light/40 pl-4">
<div class="font-headline-md text-headline-md text-gold-light leading-none mb-1">20 000+</div>
<div class="font-label-sm text-label-sm text-white/60 uppercase tracking-widest">arbres &amp; plantes</div>
</div>
</div>
<a href="#booking" class="btn-gold inline-flex items-center gap-3 bg-gold text-[#061b0e] px-8 py-3.5 font-label-sm text-label-sm uppercase tracking-widest hover:bg-gold-light transition-colors duration-300">Planifier votre visite <span class="material-symbols-outlined" style="font-variation-settings:'FILL' 0;">arrow_forward</span></a>
</div>
<div class="col-span-12 lg:col-span-7 mt-14 lg:mt-0 fade-in-up" style="transition-delay:150ms;">
<div class="img-frame relative max-w-2xl ml-auto">
<div class="aspect-[4/3] w-full rounded-lg overflow-hidden shadow-2xl relative z-10 border border-gold-light/25">
<img class="w-full h-full object-cover img-kenburns" alt="Cerisiers en fleurs à Shinjuku Gyoen" src="images/hero-sakura.jpg"/>
<span class="absolute bottom-4 left-4 bg-[#061b0e]/55 backdrop-blur-sm px-4 py-2 rounded-full border border-gold-light/40 font-label-sm text-label-sm text-white uppercase tracking-[0.25em]">新宿御苑 · Jardin national</span>
</div>
<div class="absolute -top-9 -right-3 lg:-right-5 z-20 w-28 h-28 flex items-center justify-center">
<div class="absolute inset-0 rounded-full border border-dashed border-gold-light/60 rank-ring"></div>
<div class="absolute inset-2 rounded-full border border-gold-light/25"></div>
<div class="text-center">
<div class="font-headline-md text-headline-md text-gold-light leading-none">訪</div>
<div class="font-label-sm text-label-sm text-white/75 uppercase tracking-[0.2em] mt-0.5">Top mondial</div>
</div>
</div>
</div>
</div>
</div>
</div>
</section>

<!-- Pétales portées par le vent (en dessous de la citation) -->
<div class="petal-band" aria-hidden="true">
<div class="petal-wind" style="top:8%; width:24px; height:24px; animation-duration:16s; animation-delay:-5s;"><svg viewBox="0 0 100 100"><path d="M46 4 C 20 30, 16 64, 50 96 C 84 64, 80 30, 54 4 L 50 18 L 46 4 Z" fill="rgba(246,178,200,0.9)"/></svg></div>
<div class="petal-wind petal-far" style="top:24%; width:15px; height:15px; animation-duration:22s; animation-delay:-10s;"><svg viewBox="0 0 100 100"><path d="M46 4 C 20 30, 16 64, 50 96 C 84 64, 80 30, 54 4 L 50 18 L 46 4 Z" fill="rgba(239,184,203,0.9)"/></svg></div>
<div class="petal-wind" style="top:40%; width:19px; height:19px; animation-duration:18s; animation-delay:-2s;"><svg viewBox="0 0 100 100"><path d="M46 4 C 20 30, 16 64, 50 96 C 84 64, 80 30, 54 4 L 50 18 L 46 4 Z" fill="rgba(231,168,191,0.9)"/></svg></div>
<div class="petal-wind petal-far" style="top:57%; width:13px; height:13px; animation-duration:25s; animation-delay:-14s;"><svg viewBox="0 0 100 100"><path d="M46 4 C 20 30, 16 64, 50 96 C 84 64, 80 30, 54 4 L 50 18 L 46 4 Z" fill="rgba(243,203,217,0.9)"/></svg></div>
<div class="petal-wind" style="top:72%; width:21px; height:21px; animation-duration:20s; animation-delay:-8s;"><svg viewBox="0 0 100 100"><path d="M46 4 C 20 30, 16 64, 50 96 C 84 64, 80 30, 54 4 L 50 18 L 46 4 Z" fill="rgba(250,199,216,0.9)"/></svg></div>
<div class="petal-wind petal-far" style="top:84%; width:15px; height:15px; animation-duration:24s; animation-delay:-18s;"><svg viewBox="0 0 100 100"><path d="M46 4 C 20 30, 16 64, 50 96 C 84 64, 80 30, 54 4 L 50 18 L 46 4 Z" fill="rgba(235,205,220,0.85)"/></svg></div>
</div>

<!-- ============================================================
     RÉSERVATION - branché sur l'API backend
     ============================================================ -->
<section id="booking" class="py-section-gap px-margin-mobile md:px-margin-desktop scroll-mt-24">
<div class="max-w-container-max mx-auto">
<div class="text-center mb-16 fade-in-up">
<span class="eyebrow font-label-sm text-label-sm text-gold-dark uppercase tracking-[0.2em] mb-5 block">Visite · 06</span>
<h2 class="font-headline-lg-mobile text-headline-lg-mobile md:font-headline-lg md:text-headline-lg text-primary mb-4">Réservez votre visite</h2>
<div class="gold-rule w-28 mx-auto mb-6"></div>
<p class="font-body-lg text-body-lg text-on-surface-variant max-w-2xl mx-auto">Choisissez une date et un créneau horaire. La réservation est gratuite, l'entrée au jardin (500 ¥) se règle sur place.</p>
</div>
<div class="grid grid-cols-12 gap-gutter items-start">
<div class="col-span-12 lg:col-span-5 fade-in-up">
<form id="bookingForm" class="glass-panel p-8 rounded-xl space-y-6 relative">
<div>
<label class="font-label-sm text-label-sm uppercase tracking-widest text-on-surface-variant block mb-2" for="visitDate">Date de visite</label>
<input type="date" id="visitDate" class="w-full bg-surface-bright border border-outline-variant px-4 py-3 rounded-lg text-on-surface focus:outline-none focus:border-primary" required/>
<p id="dateHint" class="text-sm text-error mt-1 hidden"></p>
</div>
<div>
<label class="font-label-sm text-label-sm uppercase tracking-widest text-on-surface-variant block mb-2">Créneau horaire</label>
<p id="slotHint" class="font-body-md text-body-md text-on-surface-variant mb-3">Choisissez d'abord une date.</p>
<div id="slotGrid" class="grid grid-cols-3 sm:grid-cols-4 gap-2"></div>
</div>
<div>
<label class="font-label-sm text-label-sm uppercase tracking-widest text-on-surface-variant block mb-2" for="visitVisitors">Nombre de visiteurs</label>
<select id="visitVisitors" class="w-full bg-surface-bright border border-outline-variant px-4 py-3 rounded-lg text-on-surface focus:outline-none focus:border-primary">
<option value="1">1 personne</option>
<option value="2">2 personnes</option>
<option value="3">3 personnes</option>
<option value="4">4 personnes</option>
<option value="5">5 personnes</option>
<option value="6">6 personnes</option>
<option value="7">7 personnes</option>
<option value="8">8 personnes</option>
<option value="9">9 personnes</option>
<option value="10">10 personnes</option>
</select>
</div>
<button type="submit" id="bookSubmit" class="btn-gold w-full bg-primary text-on-primary px-6 py-3 font-label-sm text-label-sm uppercase tracking-widest hover:bg-primary/90 transition-all duration-300 disabled:opacity-50 disabled:cursor-not-allowed">Réserver une place</button>
<p id="bookingMsg" class="hidden text-center font-body-md"></p>
</form>
</div>
<div class="col-span-12 lg:col-span-7 fade-in-up">
<div class="glass-panel p-8 rounded-xl relative">
<div class="flex items-center justify-between mb-4">
<h3 class="font-headline-md text-headline-md text-primary">Mes réservations</h3>
<span class="font-label-sm text-label-sm text-gold-dark uppercase tracking-widest flex items-center gap-1"><span class="material-symbols-outlined text-sm" style="font-variation-settings:'FILL' 0;">confirmation_number</span> 500 ¥ / pers.</span>
</div>
<div id="myReservations" class="space-y-4"></div>
<p id="noReservations" class="font-body-md text-body-md text-on-surface-variant">Vous n'avez aucune réservation pour le moment.</p>
</div>
</div>
</div>
</div>
</section>

<!-- ============================================================
     AVIS DES VISITEURS - branché sur l'API backend
     ============================================================ -->
<section id="avis" class="py-section-gap px-margin-mobile md:px-margin-desktop max-w-container-max mx-auto scroll-mt-24 relative overflow-hidden">
<div class="kanji-watermark right-[-3rem] bottom-10" style="font-size:220px;">感想</div>
<div class="text-center mb-16 fade-in-up">
<span class="eyebrow font-label-sm text-label-sm text-gold-dark uppercase tracking-[0.2em] mb-5 block">Témoignages · 07</span>
<h2 class="font-headline-lg-mobile text-headline-lg-mobile md:font-headline-lg md:text-headline-lg text-primary mb-4">Ils ont visité le jardin</h2>
<div class="gold-rule w-28 mx-auto mb-6"></div>
<p class="font-body-lg text-body-lg text-on-surface-variant max-w-2xl mx-auto">Chaque avis enrichit la promenade des prochains visiteurs. Notez votre expérience et inspirez les autres.</p>
</div>

<div class="glass-panel rounded-xl p-8 md:p-10 mb-16 relative fade-in-up">
<div class="grid grid-cols-12 gap-gutter items-center">
<div class="col-span-12 md:col-span-4 text-center md:text-left md:border-r md:border-outline-variant/50 md:pr-10">
<div class="font-label-sm text-label-sm text-on-surface-variant uppercase tracking-widest">Note moyenne</div>
<div class="flex items-baseline justify-center md:justify-start gap-2 mt-3">
<span id="avgScore" class="font-headline-lg-mobile text-headline-lg-mobile md:font-headline-lg md:text-headline-lg text-primary leading-none">–</span>
<span class="text-on-surface-variant/70">/ 5</span>
</div>
<div id="avgStars" class="text-xl tracking-widest mt-2"></div>
<p id="totalCount" class="font-label-sm text-label-sm text-gold-dark uppercase tracking-widest mt-3"></p>
</div>
<div class="col-span-12 md:col-span-8 md:pl-10 mt-8 md:mt-0">
<div class="font-label-sm text-label-sm text-on-surface-variant uppercase tracking-widest mb-5">Répartition des notes</div>
<div id="distributionBars" class="space-y-2.5"></div>
</div>
</div>
</div>

<div class="grid grid-cols-12 gap-gutter items-start">
<div class="col-span-12 lg:col-span-4 fade-in-up">
<form id="commentForm" class="glass-panel p-8 rounded-xl space-y-6 relative">
<div>
<label class="font-label-sm text-label-sm uppercase tracking-widest text-on-surface-variant block mb-3">Votre note</label>
<div id="starPicker" class="flex gap-1.5 text-4xl text-primary-fixed-dim" data-value="0">
<span class="star-btn" data-v="1">★</span>
<span class="star-btn" data-v="2">★</span>
<span class="star-btn" data-v="3">★</span>
<span class="star-btn" data-v="4">★</span>
<span class="star-btn" data-v="5">★</span>
</div>
<p id="starLabel" class="font-label-sm text-label-sm text-gold-dark uppercase tracking-widest mt-3 h-4"></p>
</div>
<div>
<label class="font-label-sm text-label-sm uppercase tracking-widest text-on-surface-variant block mb-2" for="commentContent">Votre avis</label>
<textarea id="commentContent" rows="5" maxlength="1000" placeholder="Partagez votre expérience au jardin..." class="w-full bg-surface-bright border border-outline-variant px-4 py-3 rounded-lg text-on-surface focus:outline-none focus:border-primary resize-none"></textarea>
<div class="flex items-center justify-between mt-2">
<span class="text-xs text-on-surface-variant/60">Votre souvenir, en quelques mots.</span>
<span id="commentCount" class="font-label-sm text-label-sm text-on-surface-variant/60">0 / 1000</span>
</div>
</div>
<button type="submit" class="btn-gold w-full bg-primary text-on-primary px-6 py-3 font-label-sm text-label-sm uppercase tracking-widest hover:bg-primary/90 transition-all duration-300 disabled:opacity-50 disabled:cursor-not-allowed">Publier mon avis</button>
<p id="commentMsg" class="hidden text-center font-body-md"></p>
</form>
</div>
<div class="col-span-12 lg:col-span-8 fade-in-up">
<div class="flex items-center justify-between mb-6">
<h3 class="font-headline-md text-headline-md text-primary">Derniers avis</h3>
<span class="font-label-sm text-label-sm text-gold-dark uppercase tracking-widest flex items-center gap-1.5"><span class="material-symbols-outlined text-base" style="font-variation-settings:'FILL' 0;">rate_review</span><span id="commentCountLabel"></span></span>
</div>
<div id="commentsList" class="space-y-5"></div>
</div>
</div>
</section>

<!-- Footer -->
<footer class="w-full bg-[#061b0e] text-[#f9f9f6] font-body-md relative overflow-hidden">
<span aria-hidden="true" style="position:absolute; bottom:-70px; right:-30px; font-family:'Libre Caslon Text',serif; color:rgba(249,249,246,0.035); font-size:230px; line-height:1; user-select:none; pointer-events:none; white-space:nowrap; letter-spacing:0.06em;">新宿御苑</span>
<div aria-hidden="true" class="absolute -top-48 left-1/2 -translate-x-1/2 w-[900px] h-[380px] rounded-full bg-gold/10 blur-[130px] pointer-events-none"></div>
<div class="relative max-w-container-max mx-auto px-margin-mobile md:px-margin-desktop pt-20 pb-10">
<div class="relative mb-16 rounded-xl border border-white/10 bg-white/[0.04] px-5 py-9 md:px-12 md:py-10 overflow-hidden">
<div class="flex flex-col lg:flex-row lg:items-center gap-8">
<div class="lg:max-w-sm">
<h4 class="font-headline-md text-headline-md text-[#f9f9f6]">Restez au fil des saisons</h4>
<div class="gold-rule w-24 mt-4 mb-5"></div>
<p class="text-[#f9f9f6]/60 text-sm leading-relaxed">Recevez nos actualités, les périodes de floraison et les événements du jardin, une fois par mois.</p>
</div>
<form id="newsletterForm" class="flex-1 flex flex-col sm:flex-row gap-3">
<label class="sr-only" for="newsletterEmail">Adresse email</label>
<input id="newsletterEmail" type="email" required placeholder="Votre adresse email" class="w-full flex-1 bg-[#061b0e]/70 border border-white/15 rounded-lg px-5 py-3.5 text-[#f9f9f6] placeholder:text-[#f9f9f6]/35 focus:outline-none focus:border-gold transition-colors"/>
<button type="submit" class="btn-gold shrink-0 w-full sm:w-auto bg-gold text-[#061b0e] px-8 py-3.5 font-label-sm text-label-sm uppercase tracking-widest hover:bg-gold-light transition-colors">S'abonner</button>
</form>
</div>
</div>
<div class="grid grid-cols-12 gap-x-6 md:gap-x-12 gap-y-12">
<div class="col-span-12 md:col-span-4">
<div class="font-headline-md text-headline-md tracking-[0.3em] text-[#f9f9f6]">SHINJUKU GYOEN</div>
<div class="mt-2 text-xs tracking-[0.6em] text-gold-light">新宿御苑</div>
<div class="gold-rule w-24 mt-6 mb-6"></div>
<p class="text-[#f9f9f6]/60 leading-relaxed max-w-xs">Un jardin national au cœur de Tokyo, où se mêlent avec harmonie les traditions japonaises, françaises et anglaises.</p>
<div class="flex items-center gap-3 mt-8">
<a href="#" aria-label="Instagram" class="w-10 h-10 rounded-full border border-white/15 bg-white/[0.04] text-[#f9f9f6]/70 hover:text-gold-light hover:border-gold hover:bg-gold/10 transition-all duration-300 flex items-center justify-center">
<svg viewBox="0 0 24 24" fill="currentColor" class="w-4 h-4" aria-hidden="true"><path d="M12 2.163c3.204 0 3.584.012 4.85.07 3.252.148 4.771 1.691 4.919 4.919.058 1.265.069 1.645.069 4.849 0 3.205-.012 3.584-.069 4.849-.149 3.225-1.664 4.771-4.919 4.919-1.266.058-1.644.07-4.85.07-3.204 0-3.584-.012-4.849-.07-3.26-.149-4.771-1.699-4.919-4.92-.058-1.265-.07-1.644-.07-4.849 0-3.204.013-3.583.07-4.849.149-3.227 1.664-4.771 4.919-4.919 1.266-.057 1.645-.069 4.849-.069zm0-2.163c-3.259 0-3.667.014-4.947.072-4.358.2-6.78 2.618-6.98 6.98-.059 1.281-.073 1.689-.073 4.948 0 3.259.014 3.668.072 4.948.2 4.358 2.618 6.78 6.98 6.98 1.281.058 1.689.072 4.948.072 3.259 0 3.668-.014 4.948-.072 4.354-.2 6.782-2.618 6.979-6.98.059-1.28.073-1.689.073-4.948 0-3.259-.014-3.667-.072-4.947-.196-4.354-2.617-6.78-6.979-6.98-1.281-.059-1.69-.073-4.949-.073zm0 5.838c-3.403 0-6.162 2.759-6.162 6.162s2.759 6.163 6.162 6.163 6.162-2.759 6.162-6.163c0-3.403-2.759-6.162-6.162-6.162zm0 10.162c-2.209 0-4-1.79-4-4 0-2.209 1.791-4 4-4s4 1.791 4 4c0 2.21-1.791 4-4 4zm6.406-11.845c-.796 0-1.441.645-1.441 1.44s.645 1.44 1.441 1.44c.795 0 1.439-.645 1.439-1.44s-.644-1.44-1.439-1.44z"/></svg>
</a>
<a href="#" aria-label="X (Twitter)" class="w-10 h-10 rounded-full border border-white/15 bg-white/[0.04] text-[#f9f9f6]/70 hover:text-gold-light hover:border-gold hover:bg-gold/10 transition-all duration-300 flex items-center justify-center">
<svg viewBox="0 0 24 24" fill="currentColor" class="w-4 h-4" aria-hidden="true"><path d="M18.244 2.25h3.308l-7.227 8.26 8.502 11.24H16.17l-5.214-6.817L4.99 21.75H1.68l7.73-8.835L1.254 2.25H8.08l4.713 6.231zm-1.161 17.52h1.833L7.084 4.126H5.117z"/></svg>
</a>
<a href="#" aria-label="Facebook" class="w-10 h-10 rounded-full border border-white/15 bg-white/[0.04] text-[#f9f9f6]/70 hover:text-gold-light hover:border-gold hover:bg-gold/10 transition-all duration-300 flex items-center justify-center">
<svg viewBox="0 0 24 24" fill="currentColor" class="w-4 h-4" aria-hidden="true"><path d="M24 12.073c0-6.627-5.373-12-12-12s-12 5.373-12 12c0 5.99 4.388 10.954 10.125 11.854v-8.385H7.078v-3.47h3.047V9.43c0-3.007 1.792-4.669 4.533-4.669 1.312 0 2.686.235 2.686.235v2.953H15.83c-1.491 0-1.956.925-1.956 1.874v2.25h3.328l-.532 3.47h-2.796v8.385C19.612 23.027 24 18.062 24 12.073z"/></svg>
</a>
</div>
</div>
<div class="col-span-12 sm:col-span-6 md:col-span-2">
<h4 class="font-label-sm text-label-sm text-gold-light uppercase tracking-widest mb-5 flex items-center gap-2"><span class="w-5 h-px bg-gold/60"></span>Explorer</h4>
<div class="space-y-3">
<a class="block text-[#f9f9f6]/70 hover:text-gold-light transition-colors text-sm" href="#histoire">Notre histoire</a>
<a class="block text-[#f9f9f6]/70 hover:text-gold-light transition-colors text-sm" href="#carte">Carte du jardin</a>
<a class="block text-[#f9f9f6]/70 hover:text-gold-light transition-colors text-sm" href="#booking">Réservation</a>
<a class="block text-[#f9f9f6]/70 hover:text-gold-light transition-colors text-sm" href="#avis">Avis des visiteurs</a>
</div>
</div>
<div class="col-span-12 sm:col-span-6 md:col-span-2">
<h4 class="font-label-sm text-label-sm text-gold-light uppercase tracking-widest mb-5 flex items-center gap-2"><span class="w-5 h-px bg-gold/60"></span>Horaires</h4>
<ul class="space-y-3 text-[#f9f9f6]/70 text-sm">
<li class="flex items-center gap-3"><span class="material-symbols-outlined text-gold-light text-lg" style="font-variation-settings:'FILL' 0;">schedule</span>Tous les jours<br class="sm:hidden"/>9h00 – 18h00</li>
<li class="flex items-center gap-3"><span class="material-symbols-outlined text-gold-light text-lg" style="font-variation-settings:'FILL' 0;">event_busy</span>Fermé le lundi</li>
<li class="flex items-center gap-3"><span class="material-symbols-outlined text-gold-light text-lg" style="font-variation-settings:'FILL' 0;">payments</span>Entrée : 500 ¥</li>
</ul>
</div>
<div class="col-span-12 md:col-span-4">
<h4 class="font-label-sm text-label-sm text-gold-light uppercase tracking-widest mb-5 flex items-center gap-2"><span class="w-5 h-px bg-gold/60"></span>Contact &amp; Accès</h4>
<ul class="space-y-3.5 text-sm">
<li class="flex items-start gap-3">
<span class="material-symbols-outlined text-gold-light text-lg mt-0.5" style="font-variation-settings:'FILL' 0;">location_on</span>
<p class="text-[#f9f9f6]/70 leading-relaxed">11 Naitomachi, Shinjuku City,<br/>Tokyo 160-0014, Japon <span class="inline-flex items-center justify-center w-4 h-4 align-[-2px] rounded-full overflow-hidden bg-white border border-white/20 shrink-0" aria-hidden="true"><span class="block rounded-full" style="width:58%; height:58%; background:#d21f3c;"></span></span></p>
</li>
<li class="flex items-center gap-3">
<span class="material-symbols-outlined text-gold-light text-lg" style="font-variation-settings:'FILL' 0;">mail</span>
<a href="mailto:contact@shinjukugyoen.jp" class="text-[#f9f9f6]/70 hover:text-gold-light transition-colors">contact@shinjukugyoen.jp</a>
</li>
<li class="flex items-center gap-3">
<span class="material-symbols-outlined text-gold-light text-lg" style="font-variation-settings:'FILL' 0;">call</span>
<a href="tel:+81333500151" class="text-[#f9f9f6]/70 hover:text-gold-light transition-colors">+81 3-3350-0151</a>
</li>
</ul>
<div class="mt-7">
<a class="inline-flex items-center gap-2 border border-gold/40 hover:border-gold rounded-lg px-5 py-2.5 font-label-sm text-label-sm text-gold-light uppercase tracking-widest hover:bg-gold/10 transition-all duration-300" href="https://www.google.com/maps/place/Shinjuku+Gyoen+National+Garden,+11+Naitomachi,+Shinjuku+City,+Tokyo+160-0014" target="_blank" rel="noopener"><span class="material-symbols-outlined text-base" style="font-variation-settings:'FILL' 0;">map</span>Itinéraire</a>
</div>
</div>
</div>
</div>
<div class="relative max-w-container-max mx-auto px-margin-mobile md:px-margin-desktop pt-8 mt-2 border-t border-white/10 flex flex-col md:flex-row justify-between items-center gap-4">
<div class="text-[#f9f9f6]/50 text-sm flex items-center gap-2"><span class="inline-flex items-center justify-center w-4 h-4 rounded-full overflow-hidden bg-white border border-white/20 shrink-0" aria-hidden="true"><span class="block rounded-full" style="width:58%; height:58%; background:#d21f3c;"></span></span>© 2024 Shinjuku Gyoen National Garden. Tous droits réservés.</div>
<div class="flex items-center gap-6">
<a href="#" class="font-label-sm text-label-sm text-[#f9f9f6]/50 uppercase tracking-widest hover:text-gold-light transition-colors">Mentions légales</a>
<a href="#" class="font-label-sm text-label-sm text-[#f9f9f6]/50 uppercase tracking-widest hover:text-gold-light transition-colors">Confidentialité</a>
</div>
</div>
<div class="relative max-w-container-max mx-auto px-margin-mobile md:px-margin-desktop pb-8">
<div class="text-[#f9f9f6]/30 text-xs leading-relaxed text-center md:text-right">Photos : Basile Morin, Jakub Hałun, Christophe95, Bernie Ongewe, Dick Thomas Johnson, Maeda Ak, Nesnad, Suicasmo, Yoshikazu TAKADA, Keiichi Yasu, Arashiyama, Carbonium, CarstenOtto, Another Believer, Rob Young, Ryohei Noda, Kakidai, Suikotei, Syohei Arai, Terabita34, Japanexperterna.se, Dexs, Syced — Wikimedia Commons (CC BY / CC BY-SA / CC0). Musiques : Kevin MacLeod (incompetech.com, CC BY 3.0) — « Ishikari Lore », « Gymnopédie n° 1 » (Satie), « Almost in F », « Senbazuru », « Air Prelude », « Eastern Thought », « Rumination », « Ripples », « Private Reflection », « Heartbreaking », « Aftermath ».</div>
</div>
</footer>

<!-- Back to top -->
<button id="backToTop" aria-label="Retour en haut" class="fixed bottom-6 right-6 z-[65] opacity-0 pointer-events-none w-12 h-12 rounded-full bg-primary text-on-primary border border-gold/50 shadow-xl shadow-primary/30 hover:bg-primary/90 flex items-center justify-center">
<span class="material-symbols-outlined" style="font-variation-settings:'FILL' 0;">arrow_upward</span>
</button>

<!-- ============================================================
     MODALE CONNEXION / INSCRIPTION
     ============================================================ -->
<div id="authModal" class="fixed inset-0 z-[60] items-center justify-center bg-[#061b0e]/60 backdrop-blur-sm p-6">
<div class="glass-panel w-full max-w-md p-8 rounded-xl relative">
<button id="authClose" aria-label="Fermer" class="absolute top-4 right-4 text-on-surface-variant hover:text-primary transition-colors">
<span class="material-symbols-outlined" style="font-variation-settings: 'FILL' 0;">close</span>
</button>
<div class="flex gap-2 mb-6">
<button id="tabLogin" class="flex-1 px-4 py-2 font-label-sm text-label-sm uppercase tracking-widest rounded-lg bg-primary text-on-primary transition-colors">Connexion</button>
<button id="tabRegister" class="flex-1 px-4 py-2 font-label-sm text-label-sm uppercase tracking-widest rounded-lg bg-surface-container-high text-on-surface-variant transition-colors">Inscription</button>
</div>

<form id="loginForm" class="space-y-5" novalidate>
<div>
<label class="font-label-sm text-label-sm uppercase tracking-widest text-on-surface-variant block mb-2" for="loginEmail">Email ou pseudo</label>
<div class="field">
<span class="material-symbols-outlined field-icon" style="font-variation-settings:'FILL' 0;" aria-hidden="true">person</span>
<input id="loginEmail" name="email" type="text" autocomplete="username" inputmode="email" placeholder="vous@exemple.jp ou pseudo" class="field-input" required/>
</div>
</div>
<div>
<label class="font-label-sm text-label-sm uppercase tracking-widest text-on-surface-variant block mb-2" for="loginPassword">Mot de passe</label>
<div class="field">
<span class="material-symbols-outlined field-icon" style="font-variation-settings:'FILL' 0;" aria-hidden="true">lock</span>
<input id="loginPassword" name="password" type="password" autocomplete="current-password" placeholder="••••••••" class="field-input" required/>
<button type="button" class="field-eye" data-eye="loginPassword" aria-label="Afficher le mot de passe"><span class="material-symbols-outlined" style="font-variation-settings:'FILL' 0;" aria-hidden="true">visibility</span></button>
</div>
</div>
<button type="submit" id="loginSubmit" class="btn-submit"><span class="btn-label">Se connecter</span><span class="btn-spinner hidden" aria-hidden="true"></span></button>
<p id="loginMsg" class="form-msg hidden" role="status"></p>
</form>

<form id="registerForm" class="space-y-5 hidden" novalidate>
<div>
<label class="font-label-sm text-label-sm uppercase tracking-widest text-on-surface-variant block mb-2" for="regUsername">Nom d'utilisateur</label>
<div class="field">
<span class="material-symbols-outlined field-icon" style="font-variation-settings:'FILL' 0;" aria-hidden="true">badge</span>
<input id="regUsername" name="username" type="text" autocomplete="username" minlength="3" maxlength="60" pattern="[a-zA-Z0-9_]{3,60}" placeholder="3 à 60 caractères (lettres, chiffres, _)" class="field-input" required/>
</div>
</div>
<div>
<label class="font-label-sm text-label-sm uppercase tracking-widest text-on-surface-variant block mb-2" for="regEmail">Email</label>
<div class="field">
<span class="material-symbols-outlined field-icon" style="font-variation-settings:'FILL' 0;" aria-hidden="true">mail</span>
<input id="regEmail" name="email" type="email" autocomplete="email" inputmode="email" placeholder="vous@exemple.jp" class="field-input" required/>
</div>
</div>
<div>
<label class="font-label-sm text-label-sm uppercase tracking-widest text-on-surface-variant block mb-2" for="regFullName">Nom complet <span class="normal-case tracking-normal text-on-surface-variant/70">(optionnel)</span></label>
<div class="field">
<span class="material-symbols-outlined field-icon" style="font-variation-settings:'FILL' 0;" aria-hidden="true">person_outline</span>
<input id="regFullName" name="full_name" type="text" maxlength="120" autocomplete="name" placeholder="Prénom Nom" class="field-input"/>
</div>
</div>
<div>
<label class="font-label-sm text-label-sm uppercase tracking-widest text-on-surface-variant block mb-2" for="regPassword">Mot de passe</label>
<div class="field">
<span class="material-symbols-outlined field-icon" style="font-variation-settings:'FILL' 0;" aria-hidden="true">lock</span>
<input id="regPassword" name="password" type="password" autocomplete="new-password" minlength="6" placeholder="6 caractères minimum" class="field-input" required/>
<button type="button" class="field-eye" data-eye="regPassword" aria-label="Afficher le mot de passe"><span class="material-symbols-outlined" style="font-variation-settings:'FILL' 0;" aria-hidden="true">visibility</span></button>
</div>
<div class="pw-meter" id="pwMeter" data-score="0" aria-hidden="true"><span></span><span></span><span></span><span></span></div>
<p class="pw-label" id="pwLabel">Faible</p>
</div>
<div>
<label class="font-label-sm text-label-sm uppercase tracking-widest text-on-surface-variant block mb-2" for="regPassword2">Confirmer le mot de passe</label>
<div class="field">
<span class="material-symbols-outlined field-icon" style="font-variation-settings:'FILL' 0;" aria-hidden="true">lock</span>
<input id="regPassword2" name="password2" type="password" autocomplete="new-password" placeholder="Répétez le mot de passe" class="field-input" required/>
<button type="button" class="field-eye" data-eye="regPassword2" aria-label="Afficher le mot de passe"><span class="material-symbols-outlined" style="font-variation-settings:'FILL' 0;" aria-hidden="true">visibility</span></button>
</div>
</div>
<button type="submit" id="registerSubmit" class="btn-submit"><span class="btn-label">Créer mon compte</span><span class="btn-spinner hidden" aria-hidden="true"></span></button>
<p id="registerMsg" class="form-msg hidden" role="status"></p>
</form>
</div>
</div>

<!-- Toast -->
<div id="toast" class="fixed bottom-6 right-6 z-[70] hidden items-center gap-3 px-6 py-4 rounded-xl glass-panel shadow-xl">
<span id="toastIcon" class="material-symbols-outlined"></span>
<span id="toastText" class="font-body-md text-body-md"></span>
</div>

<!-- ============================================================
     WIDGET MESSAGERIE WHATSAPP (Vonage)
     ============================================================ -->
<button id="chatFab" aria-label="Ouvrir la messagerie">
<span class="material-symbols-outlined" style="font-variation-settings:'FILL' 0;">chat</span>
<span id="chatBadge">1</span>
</button>

<div id="chatWidget">
<div class="chat-header">
<div class="chat-avatar">
<span class="material-symbols-outlined" style="font-variation-settings:'FILL' 0;">park</span>
</div>
<div class="chat-header-info">
<div class="name">Shinjuku Gyoen</div>
<div class="status"><span class="status-dot"></span>En ligne</div>
</div>
<button id="chatClose" aria-label="Fermer">
<span class="material-symbols-outlined" style="font-variation-settings:'FILL' 0;">close</span>
</button>
</div>

<!-- Écran d'init : formulaire pour commencer -->
<div class="chat-init" id="chatInit">
<div class="chat-init-icon">
<span class="material-symbols-outlined" style="font-variation-settings:'FILL' 0;">chat</span>
</div>
<h3>Besoin d'aide ?</h3>
<p>Écrivez-nous directement ici ou via WhatsApp.</p>
<input type="text" id="chatName" placeholder="Votre nom" maxlength="120"/>
<textarea id="chatFirstMsg" rows="3" maxlength="4000" placeholder="Décrivez votre question ou demande..."></textarea>
<p class="error" id="chatInitError"></p>
<button id="chatStart">Envoyer</button>
<a id="chatWhatsApp" href="https://wa.me/25766061745?text=Bonjour%2C%20je%20souhaite%20des%20informations%20sur%20le%20jardin%20Shinjuku%20Gyoen." target="_blank" rel="noopener" class="chat-whatsapp-btn">
<svg viewBox="0 0 32 32" width="18" height="18" aria-hidden="true"><path d="M16.004 0h-.008C7.174 0 0 7.176 0 16c0 3.5 1.132 6.744 3.058 9.378L1.054 31.2l6.074-1.98A15.907 15.907 0 0016.004 32C24.826 32 32 24.822 32 16S24.826 0 16.004 0zm9.326 22.594c-.39 1.098-1.932 2.008-3.168 2.27-.842.178-1.94.32-5.654-1.216-4.756-1.966-7.806-6.79-8.04-7.104-.226-.314-1.896-2.524-1.896-4.814s1.2-3.41 1.626-3.878c.39-.428.926-.564 1.232-.564.15 0 .284.008.406.014.426.018.64.044.916.71.34.836 1.164 2.844 1.264 3.05.1.206.2.444.06.714-.134.28-.266.452-.496.698-.23.246-.464.55-.664.74-.2.198-.408.41-.174.796.234.384 1.038 1.716 2.226 2.782 1.528 1.37 2.816 1.796 3.21 1.994.394.198.624.166.852-.1.234-.268.996-1.162 1.262-1.56.262-.396.528-.332.894-.2.232.086 1.47.694 1.722.82.252.126.422.19.486.296.066.104.066.6-.324 1.1z" fill="currentColor"/></svg>
Ouvrir dans WhatsApp
</a>
</div>

<!-- Zone des messages (cachée au début) -->
<div class="chat-messages" id="chatMessages" style="display:none;"></div>

<!-- Barre d'input (cachée au début) -->
<div class="chat-input-area" id="chatInputArea" style="display:none;">
<input type="text" id="chatInput" placeholder="Écrivez un message..." maxlength="4000"/>
<button id="chatSend" aria-label="Envoyer" disabled>
<svg viewBox="0 0 24 24" aria-hidden="true"><path d="M2.01 21L23 12 2.01 3 2 10l15 2-15 2z"/></svg>
</button>
</div>
</div>

<!-- ============================================================
     VISIONNEUSE IMMERSIVE - clic sur un point de la carte
     ============================================================ -->
<div id="siteViewer" class="fixed inset-0 z-[80] opacity-0 pointer-events-none" aria-hidden="true">
<div class="absolute inset-0 bg-black"></div>
<div class="viewer-stage">
<img id="viewerImg" class="viewer-img" alt="" src=""/>
<img id="viewerImg2" class="viewer-img" alt="" src=""/>
</div>
<div class="absolute inset-0 bg-gradient-to-t from-black/75 via-black/5 to-black/45"></div>
<div class="absolute bottom-0 left-0 right-0 p-8 md:p-14 text-center">
<span class="viewer-tag" id="viewerTag"></span>
<h3 class="viewer-title" id="viewerTitle"></h3>
<p class="viewer-desc" id="viewerDesc"></p>
<div class="gold-rule w-24 mx-auto mt-6"></div>
<span class="viewer-hint"><span class="material-symbols-outlined" style="font-variation-settings:'FILL' 0;">music_note</span> Échap pour revenir · 新宿御苑</span>
</div>
<button id="viewerClose" aria-label="Fermer la visionneuse" class="viewer-close">
<span class="material-symbols-outlined" style="font-variation-settings: 'FILL' 0;">close</span>
</button>
</div>
<audio id="siteAudio" loop preload="auto"></audio>

<script src="assets/js/app.js"></script>
<script>
document.addEventListener('DOMContentLoaded', function () {
    var form = document.getElementById('newsletterForm');
    if (!form) return;
    form.addEventListener('submit', function (e) {
        e.preventDefault();
        var input = document.getElementById('newsletterEmail');
        var value = input.value.trim();
        if (!value || !/^[^\s@]+@[^\s@]+\.[^\s@]+$/.test(value)) {
            showToast('Veuillez saisir une adresse email valide.', false);
            input.focus();
            return;
        }
        showToast('Merci, votre abonnement est confirmé !');
        form.reset();
    });
});
</script>

<script>
(function () {
    var API = 'api/index.php?route=';
    var chatFab    = document.getElementById('chatFab');
    var chatWidget = document.getElementById('chatWidget');
    var chatClose  = document.getElementById('chatClose');
    var chatInit   = document.getElementById('chatInit');
    var chatMessages = document.getElementById('chatMessages');
    var chatInputArea = document.getElementById('chatInputArea');
    var chatInput  = document.getElementById('chatInput');
    var chatSend   = document.getElementById('chatSend');
    var chatStart  = document.getElementById('chatStart');
    var chatName   = document.getElementById('chatName');
    var chatFirstMsg = document.getElementById('chatFirstMsg');
    var chatInitError = document.getElementById('chatInitError');
    var chatWhatsApp = document.getElementById('chatWhatsApp');

    var conversationId = null;
    var lastMessageCount = 0;
    var pollTimer = null;

    chatFab.addEventListener('click', function () {
        chatWidget.classList.toggle('open');
        if (chatWidget.classList.contains('open')) {
            document.getElementById('chatBadge').style.display = 'none';
        }
    });
    chatClose.addEventListener('click', function () {
        chatWidget.classList.remove('open');
    });

    chatStart.addEventListener('click', startConversation);
    chatName.addEventListener('keydown', function (e) { if (e.key === 'Enter') { e.preventDefault(); startConversation(); } });
    chatFirstMsg.addEventListener('keydown', function (e) { if (e.key === 'Enter' && (e.ctrlKey || e.metaKey)) { e.preventDefault(); startConversation(); } });

    // Mettre à jour le lien WhatsApp en temps réel
    function updateWhatsAppLink() {
        var name = chatName.value.trim() || 'Visiteur';
        var msg = chatFirstMsg.value.trim() || 'Bonjour, je souhaite des informations sur le jardin.';
        chatWhatsApp.href = 'https://wa.me/25766061745?text=' + encodeURIComponent(name + ' : ' + msg);
    }
    chatName.addEventListener('input', updateWhatsAppLink);
    chatFirstMsg.addEventListener('input', updateWhatsAppLink);

    function startConversation() {
        var name = chatName.value.trim();
        var firstMsg = chatFirstMsg.value.trim();
        if (!name) {
            chatInitError.textContent = 'Veuillez entrer votre nom.';
            chatInitError.style.display = 'block';
            chatName.focus();
            return;
        }
        if (!firstMsg) {
            chatInitError.textContent = 'Veuillez écrire votre message.';
            chatInitError.style.display = 'block';
            chatFirstMsg.focus();
            return;
        }
        chatInitError.style.display = 'none';
        chatStart.disabled = true;
        chatStart.textContent = 'Envoi...';

        // Mettre à jour le lien WhatsApp avec le message de l'utilisateur
        var waText = encodeURIComponent(name + ' : ' + firstMsg);
        chatWhatsApp.href = 'https://wa.me/25766061745?text=' + waText;

        var payload = {
            visitor_name: name,
            body: firstMsg
        };

        fetch(API + 'messages', {
            method: 'POST',
            headers: { 'Content-Type': 'application/json' },
            body: JSON.stringify(payload)
        })
        .then(function (r) { return r.json(); })
        .then(function (res) {
            if (!res.success) {
                chatInitError.innerHTML = 'Erreur lors de l\'envoi. <a href="' + chatWhatsApp.href + '" target="_blank" rel="noopener" style="color:rgb(var(--gold));text-decoration:underline;">Ouvrir dans WhatsApp</a>';
                chatInitError.style.display = 'block';
                chatStart.disabled = false;
                chatStart.textContent = 'Envoyer';
                return;
            }
            conversationId = res.data.conversation_id;
            addMessage('visitor', firstMsg, new Date().toISOString());
            lastMessageCount = 1;
            showChat();
            startPolling();
        })
        .catch(function () {
            chatInitError.innerHTML = 'Erreur réseau. <a href="' + chatWhatsApp.href + '" target="_blank" rel="noopener" style="color:rgb(var(--gold));text-decoration:underline;">Ouvrir dans WhatsApp</a>';
            chatInitError.style.display = 'block';
            chatStart.disabled = false;
            chatStart.textContent = 'Envoyer';
        });
    }

    function showChat() {
        chatInit.style.display = 'none';
        chatMessages.style.display = 'flex';
        chatInputArea.style.display = 'flex';
        chatInput.focus();
    }

    function addMessage(sender, body, time) {
        var div = document.createElement('div');
        div.className = 'chat-msg ' + sender;
        var label = sender === 'visitor' ? 'Vous' : 'Shinjuku Gyoen';
        var t = new Date(time);
        var timeStr = t.getHours().toString().padStart(2,'0') + ':' + t.getMinutes().toString().padStart(2,'0');
        div.innerHTML = '<span class="sender">' + label + '</span>' +
                        '<span>' + escapeHtml(body) + '</span>' +
                        '<span class="time">' + timeStr + '</span>';
        chatMessages.appendChild(div);
        chatMessages.scrollTop = chatMessages.scrollHeight;
    }

    function escapeHtml(text) {
        var d = document.createElement('div');
        d.textContent = text;
        return d.innerHTML;
    }

    function startPolling() {
        if (pollTimer) clearInterval(pollTimer);
        if (conversationId) pollTimer = setInterval(pollMessages, 4000);
    }

    function pollMessages() {
        if (!conversationId) return;
        fetch(API + 'messages/' + conversationId)
        .then(function (r) { return r.json(); })
        .then(function (res) {
            if (!res.success) return;
            var msgs = res.data.messages || [];
            if (msgs.length > lastMessageCount) {
                for (var i = lastMessageCount; i < msgs.length; i++) {
                    if (msgs[i].sender === 'admin') {
                        addMessage('admin', msgs[i].body, msgs[i].created_at);
                    }
                }
                lastMessageCount = msgs.length;
                showBadge();
            }
        })
        .catch(function () {});
    }

    function showBadge() {
        var badge = document.getElementById('chatBadge');
        if (!chatWidget.classList.contains('open')) {
            badge.style.display = 'grid';
            badge.textContent = '1';
        }
    }

    chatInput.addEventListener('keydown', function (e) {
        if (e.key === 'Enter' && !e.shiftKey) { e.preventDefault(); sendMessage(); }
    });
    chatSend.addEventListener('click', sendMessage);

    function sendMessage() {
        var text = chatInput.value.trim();
        if (!text) return;

        chatSend.disabled = true;
        chatInput.value = '';

        var payload = { visitor_name: chatName.value.trim(), body: text };
        if (conversationId) payload.conversation_id = conversationId;

        fetch(API + 'messages', {
            method: 'POST',
            headers: { 'Content-Type': 'application/json' },
            body: JSON.stringify(payload)
        })
        .then(function (r) { return r.json(); })
        .then(function (res) {
            if (res.success) {
                if (res.data.conversation_id) conversationId = res.data.conversation_id;
                addMessage('visitor', text, new Date().toISOString());
                lastMessageCount++;
            } else {
                chatInput.value = text;
            }
            chatSend.disabled = false;
            chatInput.focus();
        })
        .catch(function () {
            chatInput.value = text;
            chatSend.disabled = false;
        });
    }
})();
</script>
</body></html>

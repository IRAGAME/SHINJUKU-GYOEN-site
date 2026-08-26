/* ============================================================
 *  SHINJUKU GYOEN - Front-end dynamique (app.js)
 *  Client de l'API REST PHP/MYSQL située dans /EXAMEN/api
 *  ============================================================
 *  - Authentification (session cookie, même origine)
 *  - Réservation de visite avec créneaux dynamiques
 *  - Avis / évaluations
 * ============================================================ */

'use strict';

const API = '/api/index.php';

/* ---------------- État global ---------------- */
const state = {
    user: null,
    slots: [],
    selectedSlot: null,
    pendingAction: null,
};

/* ---------------- Utilitaires ---------------- */
const $ = (sel) => document.querySelector(sel);

/* ---------------- Mode hors ligne (HTML seul) ---------------- */
function isOffline() {
    return typeof navigator !== 'undefined' && navigator.onLine === false;
}

function applyOfflineMode(offline) {
    document.documentElement.classList.toggle('offline', offline);
    document.body.classList.toggle('offline', offline);
    if (offline) {
        state.user = null;
        if (heroSliderApi) heroSliderApi.stop();
        if (window.closeSiteViewer) window.closeSiteViewer();
        const list = $('#commentsList');
        if (list) list.innerHTML = '<p class="text-center">Les avis sont indisponibles hors connexion.</p>';
        const total = $('#totalCount');
        if (total) total.textContent = '';
        const dist = $('#distributionBars');
        if (dist) dist.innerHTML = '';
    } else {
        if (heroSliderApi) heroSliderApi.start();
        refreshAuth();
    }
}

function esc(str) {
    return String(str ?? '')
        .replaceAll('&', '&amp;')
        .replaceAll('<', '&lt;')
        .replaceAll('>', '&gt;')
        .replaceAll('"', '&quot;')
        .replaceAll("'", '&#039;');
}

function today() {
    const d = new Date();
    const p = (n) => String(n).padStart(2, '0');
    return `${d.getFullYear()}-${p(d.getMonth() + 1)}-${p(d.getDate())}`;
}

/* ---------------- Client API ---------------- */
async function api(path, { method = 'GET', body } = {}) {
    if (isOffline()) {
        const err = new Error('Connexion internet indisponible : fonctionnalité hors ligne.');
        err.code = 'offline';
        throw err;
    }
    const [routePath, query] = path.split('?');
    let url = API + '?route=' + encodeURIComponent(routePath);
    if (query) url += '&' + query;
    const init = { method, credentials: 'same-origin', headers: {} };
    if (body !== undefined) {
        init.headers['Content-Type'] = 'application/json';
        init.body = JSON.stringify(body);
    }
    const res = await fetch(url, init);
    let json = null;
    try { json = await res.json(); } catch (e) { /* corps non JSON */ }
    if (!res.ok || !json || json.success !== true) {
        const err = new Error((json && json.error && json.error.message) || 'Erreur inattendue.');
        err.status = res.status;
        err.code = json && json.error && json.error.code;
        throw err;
    }
    return json.data;
}

/* ---------------- Toast ---------------- */
let toastTimer = null;
function showToast(text, ok = true) {
    const toast = $('#toast');
    $('#toastText').textContent = text;
    $('#toastIcon').textContent = ok ? 'check_circle' : 'error';
    $('#toastIcon').className = 'material-symbols-outlined ' + (ok ? 'text-primary' : 'text-error');
    toast.classList.remove('hidden');
    toast.classList.add('flex');
    toast.style.opacity = '0';
    toast.style.transform = 'translateY(12px)';
    requestAnimationFrame(() => {
        toast.style.opacity = '1';
        toast.style.transform = 'translateY(0)';
    });
    clearTimeout(toastTimer);
    toastTimer = setTimeout(() => {
        toast.style.opacity = '0';
        toast.style.transform = 'translateY(12px)';
        setTimeout(() => toast.classList.add('hidden'), 350);
    }, 3500);
}

/* ---------------- Authentification ---------------- */
function renderAuth() {
    const area = $('#authArea');
    const loginBtn = $('#btnLogin');
    const userMenu = $('#userMenu');
    const avatar = $('#userAvatar');
    const logoutMobile = $('#btnLogoutMobile');

    area.classList.remove('hidden');
    area.classList.add('flex');

    if (state.user) {
        loginBtn.classList.add('hidden');
        userMenu.classList.remove('hidden');
        userMenu.classList.add('flex');
        const displayName = state.user.full_name || state.user.username;
        $('#userName').textContent = displayName;
        if (avatar) {
            const initials = displayName.split(' ').map(w => w[0]).join('').substring(0, 2).toUpperCase();
            avatar.textContent = initials;
        }
    } else {
        loginBtn.classList.remove('hidden');
        userMenu.classList.add('hidden');
        userMenu.classList.remove('flex');
    }
    renderComments();
    if (state.user) renderMyReservations();
}

async function refreshAuth() {
    try {
        state.user = await api('me');
    } catch (e) {
        state.user = null;
    }
    renderAuth();
}

function openAuthModal(tab = 'login', pending = null) {
    state.pendingAction = pending;
    $('#authModal').classList.add('open');
    switchAuthTab(tab);
    document.body.style.overflow = 'hidden';
}

function closeAuthModal() {
    $('#authModal').classList.remove('open');
    document.body.style.overflow = '';
}

function switchAuthTab(tab) {
    const login = tab === 'login';
    $('#loginForm').classList.toggle('hidden', !login);
    $('#registerForm').classList.toggle('hidden', login);
    $('#tabLogin').classList.toggle('active', login);
    $('#tabRegister').classList.toggle('active', !login);
    $('#loginMsg').classList.add('hidden');
    $('#registerMsg').classList.add('hidden');
    ['loginEmail', 'loginPassword', 'regUsername', 'regEmail', 'regFullName', 'regPassword', 'regPassword2']
        .forEach((id) => { const el = document.getElementById(id); if (el) el.classList.remove('has-error'); });
}

function showFormMsg(id, text, ok) {
    const el = $(id);
    el.textContent = text;
    el.classList.remove('hidden', 'is-error', 'is-ok');
    el.classList.add(ok ? 'is-ok' : 'is-error');
}

function setSubmitLoading(btn, loading) {
    if (!btn) return;
    const label = btn.querySelector('.btn-label');
    const spinner = btn.querySelector('.btn-spinner');
    btn.disabled = loading;
    if (spinner) spinner.classList.toggle('hidden', !loading);
    if (label && loading) {
        btn.dataset.origLabel = label.textContent;
        label.textContent = btn.dataset.loadingLabel || 'Veuillez patienter…';
    } else if (label && btn.dataset.origLabel) {
        label.textContent = btn.dataset.origLabel;
    }
}

function setFieldError(input, hasError) {
    input.classList.toggle('has-error', hasError);
}

function initPasswordEyes() {
    document.querySelectorAll('[data-eye]').forEach((btn) => {
        btn.addEventListener('click', () => {
            const input = document.getElementById(btn.dataset.eye);
            if (!input) return;
            const show = input.type === 'password';
            input.type = show ? 'text' : 'password';
            const icon = btn.querySelector('.material-symbols-outlined');
            if (icon) icon.textContent = show ? 'visibility_off' : 'visibility';
            btn.setAttribute('aria-label', show ? 'Masquer le mot de passe' : 'Afficher le mot de passe');
        });
    });
    document.querySelectorAll('.field-input').forEach((input) => {
        input.addEventListener('input', () => input.classList.remove('has-error'));
    });
}

function initPasswordMeter() {
    const input = $('#regPassword');
    const meter = $('#pwMeter');
    const label = $('#pwLabel');
    if (!input || !meter) return;
    const LABELS = ['', 'Faible', 'Moyen', 'Bon', 'Excellent'];
    input.addEventListener('input', () => {
        const v = input.value;
        let score = 0;
        if (v.length >= 6) score++;
        if (v.length >= 10) score++;
        if (/[a-z]/i.test(v) && /[0-9]/.test(v)) score++;
        if (/[^a-zA-Z0-9]/.test(v) || v.length >= 14) score++;
        meter.dataset.score = String(score);
        if (label) label.textContent = LABELS[score];
    });
}

async function handleLogin(e) {
    e.preventDefault();
    const btn = e.target.querySelector('button[type=submit]');
    const emailInput = $('#loginEmail');
    const passInput = $('#loginPassword');
    setFieldError(emailInput, false);
    setFieldError(passInput, false);
    if (!emailInput.value.trim() || !passInput.value) {
        setFieldError(emailInput, !emailInput.value.trim());
        setFieldError(passInput, !passInput.value);
        showFormMsg('#loginMsg', 'Renseignez votre identifiant et votre mot de passe.', false);
        return;
    }
    setSubmitLoading(btn, true);
    try {
        state.user = await api('login', {
            method: 'POST',
            body: { email: emailInput.value.trim(), password: passInput.value },
        });
        closeAuthModal();
        e.target.reset();
        renderAuth();
        showToast('Bienvenue, ' + (state.user.full_name || state.user.username) + ' !');
        if (state.pendingAction === 'booking') goToBooking();
    } catch (err) {
        setFieldError(emailInput, true);
        setFieldError(passInput, true);
        showFormMsg('#loginMsg', err.message, false);
    } finally {
        setSubmitLoading(btn, false);
    }
}

async function handleRegister(e) {
    e.preventDefault();
    const btn = e.target.querySelector('button[type=submit]');
    const usernameInput = $('#regUsername');
    const emailInput = $('#regEmail');
    const passInput = $('#regPassword');
    const pass2Input = $('#regPassword2');
    [usernameInput, emailInput, passInput, pass2Input].forEach((i) => setFieldError(i, false));

    const username = usernameInput.value.trim();
    const email = emailInput.value.trim();
    const password = passInput.value;
    const password2 = pass2Input.value;

    if (!/^[a-zA-Z0-9_]{3,60}$/.test(username)) {
        setFieldError(usernameInput, true);
        showFormMsg('#registerMsg', "Le nom d'utilisateur doit contenir 3 à 60 caractères (lettres, chiffres, _).", false);
        return;
    }
    if (!/^[^\s@]+@[^\s@]+\.[^\s@]+$/.test(email)) {
        setFieldError(emailInput, true);
        showFormMsg('#registerMsg', "L'adresse email n'est pas valide.", false);
        return;
    }
    if (password.length < 6) {
        setFieldError(passInput, true);
        showFormMsg('#registerMsg', 'Le mot de passe doit contenir au moins 6 caractères.', false);
        return;
    }
    if (password !== password2) {
        setFieldError(pass2Input, true);
        showFormMsg('#registerMsg', 'Les mots de passe ne correspondent pas.', false);
        return;
    }

    setSubmitLoading(btn, true);
    try {
        state.user = await api('register', {
            method: 'POST',
            body: {
                username,
                email,
                full_name: $('#regFullName').value.trim() || null,
                password,
            },
        });
        closeAuthModal();
        e.target.reset();
        if ($('#pwMeter')) $('#pwMeter').dataset.score = '0';
        if ($('#pwLabel')) $('#pwLabel').textContent = 'Faible';
        renderAuth();
        showToast('Compte créé. Bienvenue ' + (state.user.full_name || state.user.username) + ' !');
        if (state.pendingAction === 'booking') goToBooking();
    } catch (err) {
        if (err.status === 409) setFieldError(usernameInput, true);
        showFormMsg('#registerMsg', err.message, false);
    } finally {
        setSubmitLoading(btn, false);
    }
}

async function handleLogout() {
    try { await api('logout', { method: 'POST' }); } catch (e) { /* déjà déconnecté */ }
    state.user = null;
    renderAuth();
    showToast('Vous êtes déconnecté.');
}

function goToBooking() {
    document.getElementById('booking').scrollIntoView({ behavior: 'smooth' });
}

/* ---------------- Réservation ---------------- */
async function loadSlots() {
    const date = $('#visitDate').value;
    const hint = $('#dateHint');
    const slotGrid = $('#slotGrid');
    state.slots = [];
    state.selectedSlot = null;

    hint.classList.add('hidden');
    slotGrid.innerHTML = '';
    $('#slotHint').textContent = 'Chargement des créneaux...';

    if (!date) {
        $('#slotHint').textContent = 'Choisissez d\'abord une date.';
        return;
    }
    if (isMonday(date)) {
        $('#slotHint').textContent = 'Le jardin est fermé le lundi.';
        return;
    }

    try {
        const data = await api('availability?date=' + date);
        state.slots = data.slots;
        renderSlots();
    } catch (err) {
        $('#slotHint').textContent = err.message;
        if (err.code === 'closed') hint.classList.remove('hidden');
    }
}

function isMonday(date) {
    return new Date(date + 'T00:00:00').getDay() === 1;
}

function renderSlots() {
    const grid = $('#slotGrid');
    const open = state.slots.length;
    $('#slotHint').textContent = open
        ? open + ' créneaux disponibles · capacité 100 visiteurs / créneau'
        : 'Aucun créneau disponible.';

    grid.innerHTML = '';
    for (const slot of state.slots) {
        const btn = document.createElement('button');
        btn.type = 'button';
        btn.className = 'slot-btn text-left px-3 py-2 rounded-lg border border-outline-variant bg-surface-bright '
            + (slot.full ? 'opacity-40 cursor-not-allowed' : 'cursor-pointer hover:border-primary');
        if (slot.full) btn.disabled = true;
        btn.innerHTML = '<span class="font-label-sm text-label-sm font-semibold">' + esc(slot.time) + '</span>'
            + '<span class="block text-xs ' + (slot.full ? 'text-error' : 'text-on-surface-variant') + '">'
            + (slot.full ? 'Complet' : (slot.remaining + ' places')) + '</span>';
        btn.dataset.time = slot.time;
        btn.addEventListener('click', () => selectSlot(slot.time));
        grid.appendChild(btn);
    }
}

function selectSlot(time) {
    if (!time) return;
    state.selectedSlot = time;
    document.querySelectorAll('#slotGrid .slot-btn').forEach((b) => {
        b.classList.toggle('selected', b.dataset.time === time);
    });
}

async function handleBooking(e) {
    e.preventDefault();
    $('#bookingMsg').classList.add('hidden');

    if (!state.user) {
        showToast('Connectez-vous pour réserver.', false);
        openAuthModal('login', 'booking');
        return;
    }
    const date = $('#visitDate').value;
    if (!date) { showToast('Choisissez une date.', false); return; }
    if (isMonday(date)) { showToast('Le jardin est fermé le lundi.', false); return; }
    if (!state.selectedSlot) { showToast('Choisissez un créneau horaire.', false); return; }

    const btn = $('#bookSubmit');
    btn.disabled = true;
    try {
        await api('reservations', {
            method: 'POST',
            body: {
                visit_date: date,
                visit_time: state.selectedSlot,
                visitors: parseInt($('#visitVisitors').value, 10),
            },
        });
        showToast('Réservation confirmée !');
        renderMyReservations();
        loadSlots();
        e.target.reset();
        state.selectedSlot = null;
    } catch (err) {
        showToast(err.message, false);
    } finally {
        btn.disabled = false;
    }
}

async function renderMyReservations() {
    const wrap = $('#myReservations');
    const empty = $('#noReservations');
    if (!state.user) {
        wrap.innerHTML = '';
        empty.classList.remove('hidden');
        empty.textContent = 'Connectez-vous pour voir vos réservations.';
        return;
    }
    try {
        const reservations = await api('reservations');
        wrap.innerHTML = '';
        if (reservations.length === 0) {
            empty.textContent = 'Vous n\'avez aucune réservation pour le moment.';
            empty.classList.remove('hidden');
            return;
        }
        empty.classList.add('hidden');
        for (const r of reservations) {
            const div = document.createElement('div');
            const cancelled = r.status === 'cancelled';
            div.className = 'flex flex-wrap items-center justify-between gap-4 p-5 rounded-lg border '
                + (cancelled ? 'border-outline-variant opacity-60' : 'border-outline-variant bg-surface-bright');
            const badge = cancelled
                ? '<span class="font-label-sm text-label-sm uppercase tracking-widest text-error">Annulée</span>'
                : '<span class="font-label-sm text-label-sm uppercase tracking-widest text-primary">Confirmée</span>';
            let actions = '';
            if (!cancelled && r.visit_date >= today()) {
                actions = '<button class="font-label-sm text-label-sm uppercase tracking-widest text-secondary hover:text-error transition-colors" data-cancel="' + r.id + '">Annuler</button>';
            }
            div.innerHTML = '<div><div class="font-headline-md text-headline-md text-primary text-lg">'
                + esc(r.visit_date_fr) + ' à ' + esc(r.visit_time_fr) + '</div>'
                + '<div class="font-body-md text-body-md text-on-surface-variant">' + r.visitors + ' visiteur'
                + (r.visitors > 1 ? 's' : '') + ' · ' + badge + '</div></div>'
                + '<div>' + actions + '</div>';
            const cancelBtn = div.querySelector('[data-cancel]');
            if (cancelBtn) cancelBtn.addEventListener('click', () => cancelReservation(r.id));
            wrap.appendChild(div);
        }
    } catch (err) {
        showToast(err.message, false);
    }
}

async function cancelReservation(id) {
    try {
        await api('reservations/' + id, { method: 'DELETE' });
        showToast('Réservation annulée.');
        renderMyReservations();
    } catch (err) {
        showToast(err.message, false);
    }
}

/* ---------------- Avis / évaluations ---------------- */
function starsHtml(rating) {
    let out = '';
    for (let i = 1; i <= 5; i++) {
        out += '<span class="' + (i <= rating ? 'text-gold-dark' : 'text-outline-variant/70') + '">★</span>';
    }
    return out;
}

async function renderComments() {
    try {
        const data = await api('comments?limit=50');
        const avg = data.average_rating;
        const total = data.total_comments;
        const dist = data.distribution || {};

        const avgScore = $('#avgScore');
        const avgStars = $('#avgStars');
        const totalCount = $('#totalCount');
        const countLabel = $('#commentCountLabel');
        const distBox = $('#distributionBars');

        if (total > 0) {
            avgScore.textContent = avg.toFixed(1).replace('.', ',');
            avgStars.innerHTML = starsHtml(Math.round(avg));
            totalCount.textContent = total + (total > 1 ? ' avis publiés' : ' avis publié');
            if (countLabel) countLabel.textContent = total + (total > 1 ? ' avis' : ' avis');
            distBox.innerHTML = '';
            for (let s = 5; s >= 1; s--) {
                const n = dist[s] || 0;
                const pct = Math.round((n / total) * 100);
                distBox.innerHTML += '<div class="flex items-center gap-3">'
                    + '<span class="font-label-sm text-label-sm text-on-surface-variant w-2">' + s + '</span>'
                    + '<span class="material-symbols-outlined text-base text-gold-dark" style="font-variation-settings:\'FILL\' 1;">star</span>'
                    + '<div class="flex-1 h-2 rounded-full bg-surface-container-high overflow-hidden">'
                    + '<div class="h-full rounded-full bg-gradient-to-r from-gold-dark to-gold-light transition-all duration-700" style="width:' + pct + '%"></div></div>'
                    + '<span class="font-label-sm text-label-sm text-on-surface-variant/70 w-8 text-right">' + n + '</span>'
                    + '</div>';
            }
        } else {
            avgScore.textContent = '–';
            avgStars.innerHTML = starsHtml(0);
            totalCount.textContent = 'Aucun avis pour le moment';
            if (countLabel) countLabel.textContent = '';
            distBox.innerHTML = '<p class="font-body-md text-body-md text-on-surface-variant">Soyez le premier à donner votre note.</p>';
        }

        const list = $('#commentsList');
        list.innerHTML = '';
        if (data.comments.length === 0) {
            list.innerHTML = '<p class="font-body-md text-body-md text-on-surface-variant text-center py-8">Soyez le premier à donner votre avis.</p>';
            return;
        }
        for (const c of data.comments) {
            const div = document.createElement('div');
            const mine = state.user && parseInt(c.user_id, 10) === parseInt(state.user.id, 10);
            const del = mine
                ? '<button class="font-label-sm text-label-sm uppercase tracking-widest text-secondary hover:text-error transition-colors" data-delcomment="' + c.id + '">Supprimer</button>'
                : '';
            const initial = esc((c.author || '?').charAt(0).toUpperCase());
            div.className = 'relative p-6 rounded-xl border border-outline-variant bg-surface-bright';
            div.innerHTML = '<div class="flex flex-wrap items-center justify-between gap-3 mb-3">'
                + '<div class="flex items-center gap-3">'
                + '<div class="w-11 h-11 rounded-full bg-gradient-to-br from-primary to-primary/70 text-on-primary flex items-center justify-center font-headline-md text-lg">' + initial + '</div>'
                + '<div><div class="font-label-sm text-label-sm font-semibold text-primary">' + esc(c.author) + '</div>'
                + '<div class="text-xs text-on-surface-variant">' + esc(c.created_at_fr) + '</div></div>'
                + '</div><div class="text-lg tracking-widest">' + starsHtml(c.rating) + '</div>'
                + '</div>'
                + '<blockquote class="font-body-md text-body-md text-on-surface leading-relaxed">“ ' + esc(c.content) + ' ”</blockquote>'
                + (del ? '<div class="mt-3 text-right">' + del + '</div>' : '');
            const delBtn = div.querySelector('[data-delcomment]');
            if (delBtn) delBtn.addEventListener('click', () => deleteComment(c.id));
            list.appendChild(div);
        }
    } catch (err) {
        const avgScore = $('#avgScore');
        if (avgScore) avgScore.textContent = '–';
        $('#commentsList').innerHTML = '<p class="text-error text-center">Impossible de charger les avis : ' + esc(err.message) + '</p>';
    }
}

function setupStarPicker() {
    const picker = $('#starPicker');
    const stars = picker.querySelectorAll('.star-btn');
    const labels = { 1: 'Décevant', 2: 'Mitigé', 3: 'Agréable', 4: 'Enchanté', 5: 'Inoubliable' };
    const paint = (val) => {
        picker.dataset.value = String(val);
        stars.forEach((s) => s.classList.toggle('text-primary', parseInt(s.dataset.v, 10) <= val));
        const lbl = $('#starLabel');
        if (lbl) lbl.textContent = val > 0 ? '« ' + labels[val] + ' »' : '';
    };
    stars.forEach((s) => {
        s.classList.add('text-primary-fixed-dim');
        s.addEventListener('mouseenter', () => paint(parseInt(s.dataset.v, 10)));
        s.addEventListener('click', () => { paint(parseInt(s.dataset.v, 10)); });
    });
    picker.addEventListener('mouseleave', () => paint(parseInt(picker.dataset.value, 10) || 0));
    paint(0);
}

async function handleComment(e) {
    e.preventDefault();
    $('#commentMsg').classList.add('hidden');

    if (!state.user) {
        showToast('Connectez-vous pour laisser un avis.', false);
        openAuthModal('login', 'comments');
        return;
    }
    const rating = parseInt($('#starPicker').dataset.value, 10) || 0;
    const content = $('#commentContent').value.trim();
    if (rating < 1) { showToast('Choisissez une note de 1 à 5 étoiles.', false); return; }
    if (!content) { showToast('Écrivez un petit mot.', false); return; }

    const btn = e.target.querySelector('button[type=submit]');
    btn.disabled = true;
    try {
        await api('comments', { method: 'POST', body: { rating, content } });
        showToast('Merci, votre avis a été publié !');
        e.target.reset();
        $('#starPicker').dataset.value = '0';
        document.querySelectorAll('#starPicker .star-btn').forEach((s) => s.classList.add('text-primary-fixed-dim'));
        const lbl = $('#starLabel');
        if (lbl) lbl.textContent = '';
        renderComments();
    } catch (err) {
        showToast(err.message, false);
    } finally {
        btn.disabled = false;
    }
}

async function deleteComment(id) {
    if (!confirm('Supprimer cet avis ?')) return;
    try {
        await api('comments/' + id, { method: 'DELETE' });
        showToast('Avis supprimé.');
        renderComments();
    } catch (err) {
        showToast(err.message, false);
    }
}

/* ---------------- Menu mobile (drawer) ---------------- */
function openMobileMenu() {
    $('#mobileMenu').classList.remove('hidden');
    requestAnimationFrame(() => $('#mobileMenu').classList.add('open'));
    document.body.style.overflow = 'hidden';
}

function closeMobileMenu() {
    $('#mobileMenu').classList.remove('open');
    setTimeout(() => $('#mobileMenu').classList.add('hidden'), 300);
    document.body.style.overflow = '';
}

function initMobileMenu() {
    $('#btnMenu').addEventListener('click', openMobileMenu);
    $('#mobileMenu').querySelectorAll('[data-close-menu]').forEach((el) =>
        el.addEventListener('click', closeMobileMenu)
    );
    document.addEventListener('keydown', (e) => { if (e.key === 'Escape') closeMobileMenu(); });
}

/* ---------------- Animations au scroll + navbar ---------------- */
function initScrollEffects() {
    const observer = new IntersectionObserver((entries) => {
        entries.forEach((entry) => {
            if (entry.isIntersecting) entry.target.classList.add('visible');
        });
    }, { threshold: 0.1, rootMargin: '0px 0px -50px 0px' });
    document.querySelectorAll('.fade-in-up').forEach((el) => observer.observe(el));

    const nav = $('#mainNav');
    const progress = $('#scrollProgress');
    const sections = ['histoire', 'jardins', 'meteo', 'carte', 'booking', 'avis']
        .map((id) => document.getElementById(id))
        .filter(Boolean);
    const navLinks = document.querySelectorAll('.nav-link, .menu-link');
    const onScroll = () => {
        const y = window.scrollY;
        if (y > 50) {
            nav.classList.add('nav-scrolled');
            nav.classList.remove('bg-transparent');
            nav.classList.remove('over-hero');
        } else {
            nav.classList.remove('nav-scrolled');
            nav.classList.add('bg-transparent');
            nav.classList.add('over-hero');
        }
        const max = document.documentElement.scrollHeight - window.innerHeight;
        if (progress && max > 0) progress.style.transform = 'scaleX(' + Math.min(y / max, 1) + ')';
        let current = sections[0] ? sections[0].id : '';
        sections.forEach((s) => { if (s.getBoundingClientRect().top <= 140) current = s.id; });
        navLinks.forEach((l) => l.classList.toggle('active', l.getAttribute('href') === '#' + current));
    };
    window.addEventListener('scroll', onScroll, { passive: true });
    onScroll();
}

/* ---------------- Arrière-plan saisonnier au scroll ---------------- */
const BACKDROP_STOPS = [
    [0.00, '#21241f', '#27302a', '#1c201b'],
    [0.18, '#20241f', '#29322b', '#1b211c'],
    [0.42, '#1b241e', '#213027', '#191f1a'],
    [0.68, '#1d241e', '#243129', '#1a201b'],
    [1.00, '#1a2127', '#1d2833', '#181d24']
];

function initSeasonalBackdrop() {
    const canvas = $('#bgCanvas');
    if (!canvas) return;

    const hexRgb = (h) => [parseInt(h.slice(1, 3), 16), parseInt(h.slice(3, 5), 16), parseInt(h.slice(5, 7), 16)];
    const mixC = (a, b, t) => [
        Math.round(a[0] + (b[0] - a[0]) * t),
        Math.round(a[1] + (b[1] - a[1]) * t),
        Math.round(a[2] + (b[2] - a[2]) * t)
    ];
    const rgbStr = (c) => 'rgb(' + c[0] + ',' + c[1] + ',' + c[2] + ')';

    const stops = BACKDROP_STOPS.map((s) => [s[0], hexRgb(s[1]), hexRgb(s[2]), hexRgb(s[3])]);

    const paint = () => {
        const max = document.documentElement.scrollHeight - window.innerHeight;
        const p = max > 0 ? Math.min(window.scrollY / max, 1) : 0;
        let a = stops[0], b = stops[stops.length - 1], t = 0;
        for (let i = 0; i < stops.length - 1; i++) {
            if (p >= stops[i][0] && p <= stops[i + 1][0]) { a = stops[i]; b = stops[i + 1]; t = (p - a[0]) / (b[0] - a[0]); break; }
        }
        if (p <= stops[0][0]) { a = stops[0]; b = stops[0]; }
        if (p >= stops[stops.length - 1][0]) { a = stops[stops.length - 1]; b = stops[stops.length - 1]; }
        canvas.style.background = 'linear-gradient(180deg, '
            + rgbStr(mixC(a[1], b[1], t)) + ' 0%, '
            + rgbStr(mixC(a[2], b[2], t)) + ' 48%, '
            + rgbStr(mixC(a[3], b[3], t)) + ' 100%)';
    };

    if (window.matchMedia('(prefers-reduced-motion: reduce)').matches) {
        canvas.style.background = 'linear-gradient(180deg,#1b241e 0%,#213027 48%,#191f1a 100%)';
        return;
    }

    let ticking = false;
    window.addEventListener('scroll', () => {
        if (!ticking) { ticking = true; requestAnimationFrame(() => { paint(); ticking = false; }); }
    }, { passive: true });
    paint();
}

/* ---------------- Retour en haut ---------------- */
function initBackToTop() {
    const btn = $('#backToTop');
    const onScroll = () => {
        const show = window.scrollY > 600;
        btn.classList.toggle('opacity-0', !show);
        btn.classList.toggle('pointer-events-none', !show);
    };
    window.addEventListener('scroll', onScroll, { passive: true });
    btn.addEventListener('click', () => window.scrollTo({ top: 0, behavior: 'smooth' }));
    onScroll();
}

/* ---------------- Slider hero ---------------- */
let heroSliderApi = null;

function initHeroSlider() {
    const slides = document.querySelectorAll('#heroSlides .hero-slide');
    const dotsWrap = $('#heroDots');
    if (slides.length < 2) { dotsWrap.remove(); return; }

    let current = 0;
    let timer = null;
    const INTERVAL = 6000;

    const dots = [];
    slides.forEach((_, i) => {
        const dot = document.createElement('button');
        dot.setAttribute('aria-label', 'Image ' + (i + 1));
        if (i === 0) dot.classList.add('active');
        dot.addEventListener('click', () => goTo(i));
        dotsWrap.appendChild(dot);
        dots.push(dot);
    });

    function goTo(i) {
        if (i === current) return;
        slides[current].classList.remove('active');
        dots[current].classList.remove('active');
        current = i;
        slides[current].classList.add('active');
        dots[current].classList.add('active');
        start();
    }

    function next() {
        goTo((current + 1) % slides.length);
    }

    function start() {
        clearInterval(timer);
        timer = setInterval(next, INTERVAL);
    }

    function stop() {
        clearInterval(timer);
        timer = null;
    }

    heroSliderApi = { start, stop };
    if (isOffline()) stop();
    else start();
}

/* ---------------- Carte du jardin ---------------- */
let openSiteViewer = null;

function initSiteViewer() {
    const viewer = $('#siteViewer');
    const layers = [$('#viewerImg'), $('#viewerImg2')];
    const titleEl = $('#viewerTitle');
    const tagEl = $('#viewerTag');
    const descEl = $('#viewerDesc');
    const audio = $('#siteAudio');
    if (!viewer) return;

    const KB = ['kb-0', 'kb-1', 'kb-2', 'kb-3', 'kb-4', 'kb-5', 'kb-6', 'kb-7'];
    const SLIDE_MS = 7000;
    let timers = [];
    let musicOn = false;
    let slideTimer = null;
    let imgs = [];
    let idx = 0;
    let active = 0;
    let lastKb = -1;

    function clearTimers() {
        timers.forEach(clearTimeout);
        timers = [];
        if (slideTimer) { clearInterval(slideTimer); slideTimer = null; }
    }

    function fadeAudio(target, duration, done) {
        if (!audio) { if (done) done(); return; }
        clearInterval(audio._fade);
        const start = audio.volume;
        const t0 = performance.now();
        audio._fade = setInterval(() => {
            const t = Math.min(1, (performance.now() - t0) / duration);
            audio.volume = start + (target - start) * t;
            if (t >= 1) { clearInterval(audio._fade); if (done) done(); }
        }, 40);
    }

    function pickKb() {
        let k;
        do { k = Math.floor(Math.random() * KB.length); } while (k === lastKb && KB.length > 1);
        lastKb = k;
        return KB[k];
    }

    function clearLayer(layer) {
        const img = layers[layer];
        img.onload = null;
        img.classList.remove('active', 'kb-0', 'kb-1', 'kb-2', 'kb-3', 'kb-4', 'kb-5', 'kb-6', 'kb-7');
    }

    function setLayerSrc(layer, src) {
        const img = layers[layer];
        img.src = src;
        void img.offsetWidth;
    }

    function showLayer(layer) {
        const img = layers[layer];
        img.classList.add(pickKb());
        void img.offsetWidth;
        img.classList.add('active');
    }

    function preloadNext() {
        if (imgs.length < 3) return;
        const idle = 1 - active;
        const following = (idx + 1) % imgs.length;
        layers[idle].src = imgs[following];
    }

    function advance() {
        if (imgs.length < 2) return;
        const prev = active;
        const next = 1 - active;
        idx = (idx + 1) % imgs.length;
        clearLayer(next);
        setLayerSrc(next, imgs[idx]);
        const done = () => {
            if (layers[next]._pending !== done) return;
            layers[next]._pending = null;
            clearLayer(prev);
            showLayer(next);
            active = next;
            preloadNext();
        };
        layers[next]._pending = done;
        if (layers[next].complete && layers[next].naturalWidth) done();
        else layers[next].onload = done;
    }

    function openSite(data) {
        clearTimers();
        viewer.classList.add('open');
        viewer.setAttribute('aria-hidden', 'false');
        document.body.classList.add('overflow-hidden');
        titleEl.classList.remove('show');
        tagEl.classList.remove('show');
        descEl.classList.remove('show');
        titleEl.textContent = data.title;
        tagEl.textContent = data.tag;
        descEl.textContent = data.desc;

        imgs = (data.imgs && data.imgs.length) ? data.imgs : [data.img];
        idx = 0;
        active = 0;
        clearLayer(0);
        clearLayer(1);
        setLayerSrc(0, imgs[0]);
        const first = () => {
            if (layers[0]._pending !== first) return;
            layers[0]._pending = null;
            showLayer(0);
            if (imgs.length > 1) setLayerSrc(1, imgs[1]);
        };
        layers[0]._pending = first;
        if (layers[0].complete && layers[0].naturalWidth) first();
        else layers[0].onload = first;

        timers.push(setTimeout(() => {
            titleEl.classList.add('show');
            tagEl.classList.add('show');
            descEl.classList.add('show');
        }, 1100));
        if (imgs.length > 1) slideTimer = setInterval(advance, SLIDE_MS);

        if (audio) {
            const src = data.audio || '';
            if (src && audio.getAttribute('src') !== src) {
                audio.src = src;
                audio.currentTime = 0;
            }
            if (!musicOn) {
                musicOn = true;
                audio.volume = 0;
                audio.currentTime = 0;
                const p = audio.play();
                if (p && p.catch) p.catch(() => {});
                fadeAudio(0.65, 1400);
            }
        }
    }

    function closeViewer() {
        if (!viewer.classList.contains('open')) return;
        clearTimers();
        fadeAudio(0, 500, () => { if (audio) { audio.pause(); musicOn = false; } });
        layers.forEach((img) => { img.onload = null; img._pending = null; });
        layers.forEach((img) => img.classList.remove('active', 'kb-0', 'kb-1', 'kb-2', 'kb-3', 'kb-4', 'kb-5', 'kb-6', 'kb-7'));
        titleEl.classList.remove('show');
        tagEl.classList.remove('show');
        descEl.classList.remove('show');
        timers.push(setTimeout(() => {
            viewer.classList.remove('open');
            viewer.setAttribute('aria-hidden', 'true');
            document.body.classList.remove('overflow-hidden');
            layers.forEach((img) => img.removeAttribute('src'));
        }, 700));
    }

    $('#viewerClose').addEventListener('click', closeViewer);
    viewer.addEventListener('click', (e) => {
        if (e.target.closest('#viewerClose')) return;
        closeViewer();
    });
    document.addEventListener('keydown', (e) => {
        if (e.key === 'Escape' && viewer.classList.contains('open')) closeViewer();
    });

    openSiteViewer = openSite;
    window.closeSiteViewer = closeViewer;
}

function initMapPins() {
    const pins = document.querySelectorAll('.map-pin');
    if (!pins.length) return;
    pins.forEach((pin) => {
        const tip = pin.querySelector('.map-tip');
        if (!tip) return;
        const data = {
            imgs: (pin.dataset.imgs || pin.dataset.img || '').split('|').filter(Boolean),
            img: pin.dataset.img,
            audio: pin.dataset.audio || '',
            title: tip.querySelector('strong').textContent,
            tag: tip.querySelector('.tip-tag').textContent,
            desc: tip.querySelector('.tip-desc').textContent
        };
        pin.addEventListener('click', (e) => {
            e.stopPropagation();
            if (openSiteViewer) openSiteViewer(data);
        });
    });
}

/* ---------------- Météo (OpenWeatherMap) ---------------- */
const WEATHER_API_KEY = '416934bea723a1c18e9d9a935c4a8a82';
const WEATHER_LAT = 35.6852;
const WEATHER_LON = 139.6917;
const WEATHER_REFRESH_MS = 30 * 60 * 1000;

const WEATHER_ICONS = {
    '01d': '☀️', '01n': '🌙',
    '02d': '⛅', '02n': '☁️',
    '03d': '☁️', '03n': '☁️',
    '04d': '☁️', '04n': '☁️',
    '09d': '🌧️', '09n': '🌧️',
    '10d': '🌦️', '10n': '🌧️',
    '11d': '⛈️', '11n': '⛈️',
    '13d': '❄️', '13n': '❄️',
    '50d': '🌫️', '50n': '🌫️',
};

const WEATHER_TIPS = {
    clear: 'Temps idéal pour une promenade en plein air. N\'oubliez pas votre crème solaire !',
    clouds: 'Ciel couvert mais agréable pour explorer les jardins. Températures douces.',
    rain: 'Prévoyez un parapluie ! Les jardins sous la pluie ont un charme unique.',
    drizzle: 'Légère bruine, parfaite pour une ambiance contemplative dans le jardin japonais.',
    thunderstorm: 'Attention, orage annoncé. Reportez votre visite si possible.',
    snow: 'Le jardin sous la neige est magique ! Enfilez des vêtements chauds.',
    mist: 'Brume matinale au jardin, atmosphère mystérieuse et poétique.',
    fog: 'Brouillard épais, visibilité réduite. Les formes du jardin se devinent à peine.',
};

const WMO_DESCRIPTIONS = {
    0: 'Ciel dégagé', 1: 'Peu nuageux', 2: 'Partiellement nuageux', 3: 'Couvert',
    45: 'Brouillard', 48: 'Brouillard givrant',
    51: 'Bruine légère', 53: 'Bruine modérée', 55: 'Bruine forte',
    56: 'Bruine verglaçante', 57: 'Bruine verglaçante forte',
    61: 'Pluie légère', 63: 'Pluie modérée', 65: 'Pluie forte',
    66: 'Pluie verglaçante', 67: 'Pluie verglaçante forte',
    71: 'Neige légère', 73: 'Neige modérée', 75: 'Neige forte',
    76: 'Neige fondue', 77: 'Grésil',
    80: 'Averses légères', 81: 'Averses modérées', 82: 'Averses violentes',
    85: 'Averses de neige', 86: 'Averses de neige fortes',
    95: 'Orage', 96: 'Orage avec grêle', 99: 'Orage violent',
};

const DAY_NAMES_FR = ['Dim', 'Lun', 'Mar', 'Mer', 'Jeu', 'Ven', 'Sam'];
const MONTH_NAMES_FR = ['janvier', 'février', 'mars', 'avril', 'mai', 'juin', 'juillet', 'août', 'septembre', 'octobre', 'novembre', 'décembre'];

function getWeatherIconUrl(iconCode) {
    return 'https://openweathermap.org/img/wn/' + iconCode + '@2x.png';
}

function wmoToOwmIcon(wmoCode) {
    if (wmoCode === 0) return '01d';
    if (wmoCode === 1) return '02d';
    if (wmoCode === 2) return '03d';
    if (wmoCode === 3) return '04d';
    if (wmoCode === 45 || wmoCode === 48) return '50d';
    if (wmoCode >= 51 && wmoCode <= 57) return '10d';
    if (wmoCode >= 61 && wmoCode <= 67) return '10d';
    if (wmoCode >= 71 && wmoCode <= 77) return '13d';
    if (wmoCode >= 80 && wmoCode <= 82) return '09d';
    if (wmoCode >= 85 && wmoCode <= 86) return '13d';
    if (wmoCode >= 95) return '11d';
    return '03d';
}

function formatTimeUnix(unix, timezoneOffset) {
    const d = new Date((unix + timezoneOffset) * 1000);
    const h = d.getUTCHours().toString().padStart(2, '0');
    const m = d.getUTCMinutes().toString().padStart(2, '0');
    return h + ':' + m;
}

function formatForecastDay(dt, timezoneOffset) {
    const d = new Date((dt + timezoneOffset) * 1000);
    return DAY_NAMES_FR[d.getUTCDay()];
}

async function fetchWeather() {
    const loadingEl = $('#weatherLoading');
    const errorEl = $('#weatherError');
    const contentEl = $('#weatherContent');

    loadingEl.classList.remove('hidden');
    loadingEl.classList.add('flex');
    errorEl.classList.add('hidden');
    contentEl.classList.add('hidden');

    try {
        const currentUrl = 'https://api.openweathermap.org/data/2.5/weather?lat=' + WEATHER_LAT + '&lon=' + WEATHER_LON + '&appid=' + WEATHER_API_KEY + '&units=metric&lang=fr';
        const forecastUrl = 'https://api.openweathermap.org/data/2.5/forecast?lat=' + WEATHER_LAT + '&lon=' + WEATHER_LON + '&appid=' + WEATHER_API_KEY + '&units=metric&lang=fr';

        const [currentRes, forecastRes] = await Promise.all([
            fetch(currentUrl),
            fetch(forecastUrl)
        ]);

        if (!currentRes.ok || !forecastRes.ok) {
            throw new Error('Erreur API météo (' + currentRes.status + ')');
        }

        const currentData = await currentRes.json();
        const forecastData = await forecastRes.json();

        renderWeather(currentData, forecastData);

        loadingEl.classList.add('hidden');
        loadingEl.classList.remove('flex');
        contentEl.classList.remove('hidden');

        const now = new Date();
        $('#weatherUpdated').textContent = 'Mis à jour à ' + now.getHours().toString().padStart(2, '0') + ':' + now.getMinutes().toString().padStart(2, '0');

    } catch (err) {
        loadingEl.classList.add('hidden');
        loadingEl.classList.remove('flex');
        errorEl.classList.remove('hidden');
        errorEl.classList.add('flex');
        $('#weatherErrorMsg').textContent = 'Impossible de charger les données météo. ' + err.message;
    }
}

function renderWeather(current, forecast) {
    const tzOffset = forecast.city.timezone;

    const now = new Date();
    const dayOfWeek = DAY_NAMES_FR[now.getDay()];
    const dayOfMonth = now.getDate();
    const monthName = MONTH_NAMES_FR[now.getMonth()];
    $('#weatherDate').textContent = dayOfWeek + ' ' + dayOfMonth + ' ' + monthName;

    $('#weatherTemp').textContent = Math.round(current.main.temp);
    const wmoCode = current.weather[0].id;
    const weatherDesc = current.weather[0].description;
    $('#weatherDesc').textContent = weatherDesc.charAt(0).toUpperCase() + weatherDesc.slice(1);
    $('#weatherFeelsLike').textContent = 'Ressenti : ' + Math.round(current.main.feels_like) + ' °C';

    const iconCode = current.weather[0].icon;
    const iconImg = $('#weatherIconImg');
    iconImg.src = getWeatherIconUrl(iconCode);
    iconImg.alt = weatherDesc;

    $('#weatherHumidity').textContent = current.main.humidity + '%';
    $('#weatherWind').textContent = Math.round(current.wind.speed * 3.6) + ' km/h';
    const vis = current.visibility;
    if (vis >= 10000) {
        $('#weatherVisibility').textContent = '10+ km';
    } else {
        $('#weatherVisibility').textContent = Math.round(vis / 1000) + ' km';
    }

    $('#weatherSunrise').textContent = formatTimeUnix(current.sys.sunrise, tzOffset);
    $('#weatherSunset').textContent = formatTimeUnix(current.sys.sunset, tzOffset);

    const mainWeather = current.weather[0].main.toLowerCase();
    let tipKey = 'clear';
    if (mainWeather.includes('rain')) tipKey = 'rain';
    else if (mainWeather.includes('drizzle')) tipKey = 'drizzle';
    else if (mainWeather.includes('thunder')) tipKey = 'thunderstorm';
    else if (mainWeather.includes('snow')) tipKey = 'snow';
    else if (mainWeather.includes('mist') || mainWeather.includes('fog')) tipKey = 'fog';
    else if (mainWeather.includes('cloud')) tipKey = 'clouds';
    else if (mainWeather === 'mist') tipKey = 'mist';
    $('#weatherAdviceText').textContent = WEATHER_TIPS[tipKey] || WEATHER_TIPS.clear;

    const forecastContainer = $('#weatherForecast');
    forecastContainer.innerHTML = '';

    const dailyForecasts = {};
    for (const entry of forecast.list) {
        const date = new Date((entry.dt + tzOffset) * 1000);
        const dateKey = date.getUTCFullYear() + '-' + (date.getUTCMonth() + 1) + '-' + date.getUTCDate();
        if (dateKey === now.getFullYear() + '-' + (now.getMonth() + 1) + '-' + now.getDate()) continue;

        if (!dailyForecasts[dateKey]) {
            dailyForecasts[dateKey] = {
                dt: entry.dt,
                temps: [],
                icons: [],
                descriptions: [],
                wmoCodes: [],
            };
        }
        dailyForecasts[dateKey].temps.push(entry.main.temp);
        dailyForecasts[dateKey].icons.push(entry.weather[0].icon);
        dailyForecasts[dateKey].wmoCodes.push(entry.weather[0].id);
        dailyForecasts[dateKey].descriptions.push(entry.weather[0].description);
    }

    const days = Object.values(dailyForecasts).slice(0, 5);

    for (const day of days) {
        const avgTemp = day.temps.reduce((a, b) => a + b, 0) / day.temps.length;
        const minTemp = Math.min(...day.temps);
        const dayName = formatForecastDay(day.dt, tzOffset);

        const midIconIdx = Math.floor(day.icons.length / 2);
        const iconCode = day.icons[midIconIdx];

        const card = document.createElement('div');
        card.className = 'forecast-card';
        card.innerHTML = '<span class="forecast-day">' + dayName + '</span>'
            + '<span class="forecast-icon"><img src="' + getWeatherIconUrl(iconCode) + '" alt=""/></span>'
            + '<span class="forecast-temp">' + Math.round(avgTemp) + '°</span>'
            + '<span class="forecast-temp-min">' + Math.round(minTemp) + '°</span>';
        forecastContainer.appendChild(card);
    }
}

function initWeather() {
    if (isOffline()) return;
    fetchWeather();
    setInterval(fetchWeather, WEATHER_REFRESH_MS);

    const retryBtn = $('#weatherRetry');
    if (retryBtn) retryBtn.addEventListener('click', fetchWeather);
}
document.addEventListener('DOMContentLoaded', () => {
    initScrollEffects();
    initMobileMenu();
    initHeroSlider();
    initBackToTop();
    initMapPins();
    initSiteViewer();
    initSeasonalBackdrop();
    setupStarPicker();
    initPasswordEyes();
    initPasswordMeter();
    initWeather();

    $('#btnLogin').addEventListener('click', () => openAuthModal('login'));
    $('#btnLogout').addEventListener('click', handleLogout);
    if ($('#btnLogoutMobile')) $('#btnLogoutMobile').addEventListener('click', handleLogout);
    $('#btnStory').addEventListener('click', () => {
        document.getElementById('histoire').scrollIntoView({ behavior: 'smooth' });
    });
    $('#btnMenuBook').addEventListener('click', () => {
        if (state.user) goToBooking();
        else openAuthModal('login', 'booking');
    });
    $('#btnBookNow').addEventListener('click', () => {
        if (state.user) goToBooking();
        else openAuthModal('login', 'booking');
    });
    $('#authClose').addEventListener('click', closeAuthModal);
    $('#authModal').addEventListener('click', (e) => { if (e.target === $('#authModal')) closeAuthModal(); });
    document.addEventListener('keydown', (e) => { if (e.key === 'Escape') closeAuthModal(); });
    $('#tabLogin').addEventListener('click', () => switchAuthTab('login'));
    $('#tabRegister').addEventListener('click', () => switchAuthTab('register'));

    $('#loginForm').addEventListener('submit', handleLogin);
    $('#registerForm').addEventListener('submit', handleRegister);

    $('#visitDate').min = today();
    $('#visitDate').addEventListener('change', loadSlots);
    $('#bookingForm').addEventListener('submit', handleBooking);
    $('#commentForm').addEventListener('submit', handleComment);

    const ta = $('#commentContent');
    const cc = $('#commentCount');
    if (ta && cc) ta.addEventListener('input', () => { cc.textContent = ta.value.length + ' / 1000'; });

    applyOfflineMode(isOffline());
    window.addEventListener('online', () => applyOfflineMode(false));
    window.addEventListener('offline', () => applyOfflineMode(true));
});

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="utf-8"/>
    <meta content="width=device-width, initial-scale=1.0" name="viewport"/>
    <title>Admin - Messagerie | Shinjuku Gyoen</title>
    <link href="../assets/fonts/fonts-body-local.css" rel="stylesheet"/>
    <link href="../assets/fonts/fonts-symbols-local.css" rel="stylesheet"/>
    <script src="../assets/js/tailwind.js"></script>
    <script>window.tailwind = window.tailwind || {};</script>
    <script>
        tailwind.config = {
            darkMode: "class",
            theme: {
                extend: {
                    "colors": {
                        "primary": "rgb(6, 27, 14)",
                        "on-primary": "rgb(255, 255, 255)",
                        "surface": "rgb(249, 249, 246)",
                        "surface-container": "rgb(238, 238, 235)",
                        "surface-container-high": "rgb(232, 232, 229)",
                        "on-surface": "rgb(26, 28, 27)",
                        "on-surface-variant": "rgb(67, 72, 67)",
                        "outline-variant": "rgb(195, 200, 193)",
                        "gold": "rgb(74, 168, 126)",
                        "gold-dark": "rgb(47, 107, 79)",
                    }
                }
            }
        }
    </script>
    <style>
        :root {
            --primary: 6 27 14;
            --on-primary: 255 255 255;
            --surface: 249 249 246;
            --surface-container: 238 238 235;
            --surface-container-high: 232 232 229;
            --on-surface: 26 28 27;
            --on-surface-variant: 67 72 67;
            --outline-variant: 195 200 193;
            --gold: 74 168 126;
            --gold-dark: 47 107 79;
            --error: 186 26 26;
        }
        body { font-family: 'Manrope', sans-serif; background: rgb(var(--surface)); color: rgb(var(--on-surface)); margin: 0; }
        .conv-item { border-bottom: 1px solid rgb(var(--outline-variant) / 0.5); cursor: pointer; transition: background .15s ease; }
        .conv-item:hover { background: rgb(var(--surface-container-high) / 0.6); }
        .conv-item.active { background: rgb(var(--gold) / 0.1); border-left: 3px solid rgb(var(--gold)); }
        .msg-admin { background: #DCF8C6; border-radius: 12px 12px 4px 12px; }
        .msg-visitor { background: #fff; border-radius: 12px 12px 12px 4px; box-shadow: 0 1px 1px rgba(0,0,0,.06); }
        .status-open { color: #25D366; }
        .status-closed { color: #999; }
    </style>
</head>
<body>
<div id="app" class="flex h-screen">
    <!-- Sidebar : liste des conversations -->
    <aside class="w-80 border-r border-outline-variant/50 flex flex-col bg-white/60 flex-shrink-0">
        <div class="p-4 border-b border-outline-variant/50">
            <h1 class="text-lg font-bold text-primary">Messagerie</h1>
            <p class="text-xs text-on-surface-variant mt-1">Conversations des visiteurs</p>
        </div>
        <div id="convList" class="flex-1 overflow-y-auto"></div>
    </aside>

    <!-- Zone principale -->
    <main class="flex-1 flex flex-col min-w-0">
        <!-- Header conversation -->
        <div id="convHeader" class="p-4 border-b border-outline-variant/50 bg-white/60 flex items-center justify-between">
            <div>
                <div id="convName" class="font-bold text-primary">Sélectionnez une conversation</div>
                <div id="convMeta" class="text-xs text-on-surface-variant mt-0.5"></div>
            </div>
            <button id="btnCloseConv" class="hidden px-3 py-1.5 text-xs font-semibold uppercase tracking-wider bg-red-50 text-red-600 border border-red-200 rounded-lg hover:bg-red-100 transition-colors">Fermer</button>
        </div>

        <!-- Messages -->
        <div id="msgContainer" class="flex-1 overflow-y-auto p-4 space-y-3 bg-gray-50/50">
            <p class="text-on-surface-variant/60 text-center mt-20">Choisissez une conversation dans la liste.</p>
        </div>

        <!-- Input reply -->
        <div id="replyArea" class="hidden p-4 border-t border-outline-variant/50 bg-white/60 flex gap-3">
            <input id="replyInput" type="text" placeholder="Votre réponse (sera envoyée sur WhatsApp)..." class="flex-1 border border-outline-variant rounded-xl px-4 py-2.5 text-sm outline-none focus:border-gold transition-colors"/>
            <button id="btnReply" class="px-5 py-2.5 bg-primary text-on-primary rounded-xl font-semibold text-sm hover:opacity-90 transition-opacity disabled:opacity-50" disabled>Envoyer</button>
        </div>
    </main>
</div>

<script>
(function () {
    var API = '/api/index.php?route=';
    var convList = document.getElementById('convList');
    var convName = document.getElementById('convName');
    var convMeta = document.getElementById('convMeta');
    var msgContainer = document.getElementById('msgContainer');
    var replyArea = document.getElementById('replyArea');
    var replyInput = document.getElementById('replyInput');
    var btnReply = document.getElementById('btnReply');
    var btnCloseConv = document.getElementById('btnCloseConv');

    var currentConvId = null;
    var pollTimer = null;

    loadConversations();

    function loadConversations() {
        fetch(API + 'admin/conversations', { credentials: 'include' })
        .then(function (r) { return r.json(); })
        .then(function (res) {
            if (!res.success) {
                convList.innerHTML = '<p class="p-4 text-sm text-red-500">Erreur : ' + (res.error ? res.error.message : 'Non autorisé') + '</p>';
                return;
            }
            renderConversations(res.data);
        })
        .catch(function () {
            convList.innerHTML = '<p class="p-4 text-sm text-red-500">Erreur réseau.</p>';
        });
    }

    function renderConversations(convs) {
        if (convs.length === 0) {
            convList.innerHTML = '<p class="p-4 text-sm text-on-surface-variant/60">Aucune conversation.</p>';
            return;
        }
        convList.innerHTML = convs.map(function (c) {
            var lastMsg = c.last_message ? c.last_message.substring(0, 60) : 'Aucun message';
            var time = c.last_message_at ? new Date(c.last_message_at).toLocaleTimeString('fr-FR', {hour:'2-digit',minute:'2-digit'}) : '';
            var statusClass = c.status === 'open' ? 'status-open' : 'status-closed';
            var activeClass = c.id === currentConvId ? ' active' : '';
            return '<div class="conv-item px-4 py-3' + activeClass + '" data-id="' + c.id + '">' +
                '<div class="flex items-center justify-between">' +
                '<span class="font-semibold text-sm text-primary">' + escapeHtml(c.visitor_name) + '</span>' +
                '<span class="' + statusClass + ' text-xs font-medium">' + (c.status === 'open' ? 'Ouvert' : 'Fermé') + '</span>' +
                '</div>' +
                '<div class="text-xs text-on-surface-variant mt-1 truncate">' + escapeHtml(lastMsg) + '</div>' +
                '<div class="flex items-center justify-between mt-1">' +
                '<span class="text-xs text-on-surface-variant/50">' + c.message_count + ' message(s)</span>' +
                '<span class="text-xs text-on-surface-variant/50">' + time + '</span>' +
                '</div>' +
                '</div>';
        }).join('');

        convList.querySelectorAll('.conv-item').forEach(function (el) {
            el.addEventListener('click', function () {
                selectConversation(parseInt(el.dataset.id));
            });
        });
    }

    function selectConversation(id) {
        currentConvId = id;
        if (pollTimer) clearInterval(pollTimer);
        loadMessages(id);
        pollTimer = setInterval(function () { loadMessages(id, true); }, 5000);
        // Mettre à jour la liste
        convList.querySelectorAll('.conv-item').forEach(function (el) {
            el.classList.toggle('active', parseInt(el.dataset.id) === id);
        });
    }

    function loadMessages(id, isPoll) {
        fetch(API + 'admin/messages/' + id, { credentials: 'include' })
        .then(function (r) { return r.json(); })
        .then(function (res) {
            if (!res.success) return;
            var conv = res.data.conversation;
            var msgs = res.data.messages;

            convName.textContent = conv.visitor_name;
            convMeta.textContent = (conv.visitor_phone || '') + (conv.visitor_email ? ' · ' + conv.visitor_email : '') + ' · ' + conv.status;

            btnCloseConv.classList.toggle('hidden', conv.status !== 'open');
            replyArea.classList.toggle('hidden', conv.status === 'open' ? false : true);

            if (!isPoll || msgContainer.dataset.lastCount !== String(msgs.length)) {
                renderMessages(msgs);
                msgContainer.dataset.lastCount = String(msgs.length);
            }
        });
        .catch(function () {});
    }

    function renderMessages(msgs) {
        if (msgs.length === 0) {
            msgContainer.innerHTML = '<p class="text-on-surface-variant/60 text-center mt-10">Aucun message dans cette conversation.</p>';
            return;
        }
        msgContainer.innerHTML = msgs.map(function (m) {
            var isVisitor = m.sender === 'visitor';
            var align = isVisitor ? 'justify-end' : 'justify-start';
            var cls = isVisitor ? 'msg-visitor' : 'msg-admin';
            var label = isVisitor ? 'Visiteur' : 'Admin';
            var t = new Date(m.created_at);
            var timeStr = t.toLocaleTimeString('fr-FR', {hour:'2-digit',minute:'2-digit'});
            return '<div class="flex ' + align + '"><div class="' + cls + ' max-w-lg px-4 py-2.5">' +
                '<div class="text-xs font-semibold mb-1 ' + (isVisitor ? 'text-blue-600' : 'text-green-700') + '">' + label + '</div>' +
                '<div class="text-sm">' + escapeHtml(m.body) + '</div>' +
                '<div class="text-xs text-on-surface-variant/40 mt-1 text-right">' + timeStr + '</div>' +
                '</div></div>';
        }).join('');
        msgContainer.scrollTop = msgContainer.scrollHeight;
    }

    // Répondre
    btnReply.addEventListener('click', sendReply);
    replyInput.addEventListener('keydown', function (e) { if (e.key === 'Enter') sendReply(); });

    function sendReply() {
        var text = replyInput.value.trim();
        if (!text || !currentConvId) return;
        btnReply.disabled = true;

        fetch(API + 'admin/messages/' + currentConvId, {
            method: 'POST',
            credentials: 'include',
            headers: { 'Content-Type': 'application/json' },
            body: JSON.stringify({ body: text })
        })
        .then(function (r) { return r.json(); })
        .then(function (res) {
            if (res.success) {
                replyInput.value = '';
                loadMessages(currentConvId);
            } else {
                alert('Erreur : ' + (res.error ? res.error.message : 'Inconnue'));
            }
            btnReply.disabled = false;
        })
        .catch(function () {
            btnReply.disabled = false;
            alert('Erreur réseau.');
        });
    }

    // Fermer conversation
    btnCloseConv.addEventListener('click', function () {
        if (!currentConvId) return;
        if (!confirm('Fermer cette conversation ?')) return;

        fetch(API + 'admin/conversations/' + currentConvId + '/close', {
            method: 'POST',
            credentials: 'include'
        })
        .then(function (r) { return r.json(); })
        .then(function (res) {
            if (res.success) {
                loadConversations();
                loadMessages(currentConvId);
            }
        })
        .catch(function () {});
    });

    function escapeHtml(text) {
        var d = document.createElement('div');
        d.textContent = text;
        return d.innerHTML;
    }
})();
</script>
</body>
</html>

<div id="chat-widget-root"></div>
<meta name="csrf-token" content="{{ csrf_token() }}">

<style>
:root{
  --chat-primary: var(--primary, #111);
  --chat-bg: var(--bg-primary, #fff);
  --chat-text: var(--text, #111);
  --chat-border: var(--border, #ddd);
  --chat-muted: var(--bg-secondary, #f3f4f6);
  --chat-shadow: 0 8px 30px rgba(0,0,0,.15);
}

#chat-widget-button{
  position:fixed;
  right:18px;
  bottom:18px;
  z-index:9999;
  width:54px;
  height:54px;
  border-radius:999px;
  border:1px solid var(--chat-border);
  background: var(--chat-bg);
  box-shadow: var(--chat-shadow);
  cursor:pointer;
  display:flex;
  align-items:center;
  justify-content:center;
  padding:0;
}

.chat-widget-icon{
  width:26px;
  height:26px;
  background-color: var(--chat-primary);
  display:inline-block;

  -webkit-mask-image: url('/images/chatbot.png');
  -webkit-mask-repeat: no-repeat;
  -webkit-mask-position: center;
  -webkit-mask-size: contain;

  mask-image: url('/images/chatbot.png');
  mask-repeat: no-repeat;
  mask-position: center;
  mask-size: contain;
}

#chat-widget-button:hover{ transform: translateY(-1px); }
#chat-widget-button:focus{
  outline: 2px solid color-mix(in srgb, var(--chat-primary) 60%, transparent);
  outline-offset: 3px;
}

#chat-widget-panel{
  position:fixed;
  right:18px;
  bottom:70px;
  width:360px;
  max-width:calc(100vw - 36px);
  height:520px;
  max-height:calc(100vh - 110px);
  z-index:9999;
  border:1px solid var(--chat-border);
  border-radius:14px;
  background:var(--chat-bg);
  box-shadow:var(--chat-shadow);
  display:none;
  overflow:hidden;
  color: var(--chat-text);
}

#chat-widget-header{
  display:flex;
  align-items:center;
  justify-content:space-between;
  padding:10px 12px;
  border-bottom:1px solid var(--chat-border);
  font-weight:600;
}

#chat-widget-close{
  border:1px solid var(--chat-border);
  background:transparent;
  color:var(--chat-text);
  border-radius:10px;
  width:34px;
  height:34px;
  cursor:pointer;
}

#chat-widget-messages{
  height:400px;
  overflow:auto;
  padding:12px;
  display:flex;
  flex-direction:column;
  gap:10px;
}

.chat-msg{
  max-width:85%;
  padding:10px 12px;
  border-radius:12px;
  white-space:pre-wrap;
  word-break:break-word;
  border:1px solid var(--chat-border);
}

.chat-user{
  align-self:flex-end;
  background: var(--chat-primary);
  color: color-mix(in srgb, var(--chat-bg) 92%, #fff);
  border-color: color-mix(in srgb, var(--chat-primary) 55%, var(--chat-border));
}

.chat-ai{
  align-self:flex-start;
  background: var(--chat-muted);
  color: var(--chat-text);
}

#chat-widget-input{
  display:flex;
  gap:8px;
  padding:10px 12px;
  border-top:1px solid var(--chat-border);
}

#chat-widget-text{
  flex:1;
  border:1px solid var(--chat-border);
  border-radius:10px;
  padding:10px;
  background: var(--chat-bg);
  color: var(--chat-text);
}

#chat-widget-send{
  border-radius:10px;
  padding:10px 12px;
  border:1px solid var(--chat-border);
  background: var(--chat-primary);
  color: color-mix(in srgb, var(--chat-bg) 92%, #fff);
  cursor:pointer;
}
</style>

<script>
(function () {
  var root = document.getElementById('chat-widget-root');

  root.innerHTML = ''
    + '<button id="chat-widget-button" aria-label="Open chat">'
    + '  <span class="chat-widget-icon" aria-hidden="true"></span>'
    + '</button>'
    + '<div id="chat-widget-panel" role="dialog" aria-modal="true" aria-label="Support chat">'
    + '  <div id="chat-widget-header">'
    + '    <span>LOGIQ Support</span>'
    + '    <button id="chat-widget-close" aria-label="Close chat">✕</button>'
    + '  </div>'
    + '  <div id="chat-widget-messages"></div>'
    + '  <div id="chat-widget-input">'
    + '    <input id="chat-widget-text" placeholder="Ask about orders, returns, products..." />'
    + '    <button id="chat-widget-send">Send</button>'
    + '  </div>'
    + '</div>';

  var btn = document.getElementById('chat-widget-button');
  var panel = document.getElementById('chat-widget-panel');
  var closeBtn = document.getElementById('chat-widget-close');
  var messagesEl = document.getElementById('chat-widget-messages');
  var textEl = document.getElementById('chat-widget-text');
  var sendEl = document.getElementById('chat-widget-send');

  var conversationId = localStorage.getItem('logiq_chat_conversation_id');

  function addMsg(role, text) {
    var div = document.createElement('div');
    div.className = 'chat-msg ' + (role === 'user' ? 'chat-user' : 'chat-ai');
    div.textContent = text;
    messagesEl.appendChild(div);
    messagesEl.scrollTop = messagesEl.scrollHeight;
  }

  function getCsrf() {
    var tag = document.querySelector('meta[name="csrf-token"]');
    return tag ? tag.getAttribute('content') : '';
  }

  async function doPost(messageText, convId) {
    var csrf = getCsrf();

    try {
      var resp = await fetch('/chat/messages', {
        method: 'POST',
        credentials: 'same-origin',
        headers: {
          'Content-Type': 'application/json',
          'X-Requested-With': 'XMLHttpRequest',
          'X-CSRF-TOKEN': csrf
        },
        body: JSON.stringify({
          conversation_id: convId ? Number(convId) : null,
          message: messageText
        })
      });

      if (resp.ok) {
        return { ok: true, data: await resp.json() };
      }

      var txt = await resp.text().catch(function () { return ''; });
      return { ok: false, status: resp.status, text: txt };

    } catch (e) {
      return { ok: false, status: 0, text: '' };
    }
  }

  async function send() {
    var msg = (textEl.value || '').trim();
    if (!msg) return;

    textEl.value = '';
    addMsg('user', msg);

    // Try normal request
    var r = await doPost(msg, conversationId);

    // Handle common errors (self-heal where possible)
    if (!r.ok) {

      // Network / server down
      if (r.status === 0) {
        addMsg('assistant', 'Network error. Check your connection and try again.');
        return;
      }

      // Not logged in / session issues
      if (r.status === 401) {
        addMsg('assistant', 'Please sign in again, then retry.');
        return;
      }
      if (r.status === 419) {
        addMsg('assistant', 'Session expired. Refresh the page and try again.');
        return;
      }

      // Rate limit
      if (r.status === 429) {
        addMsg('assistant', 'Too many messages. Please wait a moment and try again.');
        return;
      }

      // Server errors
      if (r.status === 500 || r.status === 502 || r.status === 503 || r.status === 504) {
        addMsg('assistant', 'Service is temporarily unavailable. Please try again shortly.');
        return;
      }

      // Invalid conversation (ownership changed etc.) -> clear and retry once
      if (r.status === 422 && r.text && r.text.indexOf('Invalid conversation') !== -1) {
        localStorage.removeItem('logiq_chat_conversation_id');
        conversationId = null;

        var retry = await doPost(msg, null);
        if (retry.ok) {
          conversationId = retry.data.conversation_id;
          localStorage.setItem('logiq_chat_conversation_id', String(conversationId));
          addMsg('assistant', retry.data.assistant_message || '');
          return;
        }

        addMsg('assistant', 'Sorry — something went wrong. Please try again.');
        return;
      }

      // Conversation missing (DB reset) -> clear stored id
      if (r.status === 404 && r.text &&
          (r.text.indexOf('No query results for model') !== -1 || r.text.indexOf('ChatConversation') !== -1)) {
        localStorage.removeItem('logiq_chat_conversation_id');
        conversationId = null;
        addMsg('assistant', 'Chat was reset. Please try again.');
        return;
      }

      // Everything else
      addMsg('assistant', 'Sorry — something went wrong. Please try again.');
      return;
    }

    var data = r.data;
    conversationId = data.conversation_id;
    localStorage.setItem('logiq_chat_conversation_id', String(conversationId));

    addMsg('assistant', data.assistant_message || '');

    if (data.ticket && data.ticket.ticket_id) {
      addMsg('assistant', 'Ticket created: #' + data.ticket.ticket_id);
    }
    if (data.ticket && data.ticket.ticket_number) {
      addMsg('assistant', 'Ticket created: #' + data.ticket.ticket_number);
    }
  }

  btn.onclick = function () { panel.style.display = 'block'; };
  closeBtn.onclick = function () { panel.style.display = 'none'; };
  sendEl.onclick = send;

  textEl.addEventListener('keydown', function (e) {
    if (e.key === 'Enter') send();
  });

  addMsg('assistant', 'Hi — how can I help?');
})();
</script>
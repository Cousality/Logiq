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

/* Floating button */
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


#chat-widget-button:hover{
  transform: translateY(-1px);
}
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
  gap:10px;
  display:flex;
  flex-direction:column;
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
(() => {
  const root = document.getElementById('chat-widget-root');
  root.innerHTML = `
    <button id="chat-widget-button" aria-label="Open chat">
    <span class="chat-widget-icon" aria-hidden="true"></span>
    </button>
    <div id="chat-widget-panel" role="dialog" aria-modal="true" aria-label="Support chat">
      <div id="chat-widget-header">
        <span>LOGIQ Support</span>
        <button id="chat-widget-close" aria-label="Close chat">✕</button>
      </div>
      <div id="chat-widget-messages"></div>
      <div id="chat-widget-input">
        <input id="chat-widget-text" placeholder="Ask about orders, returns, products..." />
        <button id="chat-widget-send">Send</button>
      </div>
    </div>
  `;

  const btn = document.getElementById('chat-widget-button');
  const panel = document.getElementById('chat-widget-panel');
  const close = document.getElementById('chat-widget-close');
  const messagesEl = document.getElementById('chat-widget-messages');
  const textEl = document.getElementById('chat-widget-text');
  const sendEl = document.getElementById('chat-widget-send');

  let conversationId = localStorage.getItem('logiq_chat_conversation_id');

  function addMsg(role, text) {
    const div = document.createElement('div');
    div.className = `chat-msg ${role === 'user' ? 'chat-user' : 'chat-ai'}`;
    div.textContent = text;
    messagesEl.appendChild(div);
    messagesEl.scrollTop = messagesEl.scrollHeight;
  }

  async function send() {
    const msg = textEl.value.trim();
    if (!msg) return;
    textEl.value = '';
    addMsg('user', msg);

    const csrf = document.querySelector('meta[name="csrf-token"]').getAttribute('content');

    const resp = await fetch('/chat/messages', {
    method: 'POST',
    credentials: 'same-origin',
    headers: {
        'Content-Type': 'application/json',
        'X-Requested-With': 'XMLHttpRequest',
        'X-CSRF-TOKEN': csrf
     },
    body: JSON.stringify({
        conversation_id: conversationId ? Number(conversationId) : null,
        message: msg
     })
});

        
    if (!resp.ok) {
  const txt = await resp.text().catch(() => '');

  // If conversation ownership changed (guest -> logged in), reset and retry once
  if (resp.status === 422 && txt.includes('Invalid conversation')) {
    localStorage.removeItem('logiq_chat_conversation_id');
    conversationId = null;

    // retry once
    const retry = await fetch('/api/chat/messages', {
      method: 'POST',
      credentials: 'same-origin',
      headers: { 'Content-Type': 'application/json', 'X-Requested-With': 'XMLHttpRequest' },
      body: JSON.stringify({ conversation_id: null, message: msg })
    });

    if (!retry.ok) {
      const t2 = await retry.text().catch(() => '');
      addMsg('assistant', `Error ${retry.status}: ${t2.slice(0, 300)}`);
      return;
    }

    if (!resp.ok) {
  const txt = await resp.text().catch(() => '');

  // Conversation deleted/reset in DB -> wipe local storage and start fresh
  if (
    resp.status === 404 &&
    (txt.includes('No query results for model') || txt.includes('ChatConversation'))
  ) {
    localStorage.removeItem('logiq_chat_conversation_id');
    conversationId = null;
  }

  addMsg('assistant', 'Sorry — something went wrong. Please try again.');
  return;
}

  if (resp.status === 401) {
  addMsg('assistant', 'Please sign in again, then retry.');
  return;
}
if (resp.status === 419) {
  addMsg('assistant', 'Session expired. Refresh the page and try again.');
  return;
}
if ([500,502,503,504].includes(resp.status)) {
  addMsg('assistant', 'Service is temporarily unavailable. Please try again shortly.');
  return;
}
if ([500,502,503,504].includes(resp.status)) {
  addMsg('assistant', 'Service is temporarily unavailable. Please try again shortly.');
  return;
}

    const data2 = await retry.json();
    conversationId = data2.conversation_id;
    localStorage.setItem('logiq_chat_conversation_id', String(conversationId));
    addMsg('assistant', data2.assistant_message || '');
    return;
  }

  addMsg('assistant', `Error ${resp.status}: ${txt.slice(0, 300)}`);
  return;
}

    const data = await resp.json();
    conversationId = data.conversation_id;
    localStorage.setItem('logiq_chat_conversation_id', String(conversationId));

    addMsg('assistant', data.assistant_message || '');
    if (data.ticket && data.ticket.ticket_id) {
      addMsg('assistant', `Ticket created: #${data.ticket.ticket_id}`);
    }
  }

  btn.onclick = () => panel.style.display = 'block';
  close.onclick = () => panel.style.display = 'none';
  sendEl.onclick = send;
  textEl.addEventListener('keydown', (e) => { if (e.key === 'Enter') send(); });

  addMsg('assistant', 'Hi — how can I help?');
})();
</script>
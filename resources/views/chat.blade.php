<?php
// chat.php
session_start();

// 👇 Tema vem da sessão (ou GET para testes)
$tema = $_SESSION['tema'] ?? ($_GET['tema'] ?? 'ansiedade');
$tema = strtolower(trim($tema));
$temas_validos = ['ansiedade','depressao','vicios','autocuidado'];
if (!in_array($tema, $temas_validos)) { $tema = 'ansiedade'; }

// Caminhos dos vídeos locais
$videos = [
  'ansiedade'   => 'public/src/video_ansiedade.mp4',
  'depressao'   => 'public/src/video_depressao.mp4',
  'vicios'      => 'public/src/video_vicios.mp4',
  'autocuidado' => 'public/src/video_autoajuda.mp4',
];
$video_src = $videos[$tema] ?? $videos['ansiedade'];

// Título legível
$titulo_tema = [
  'ansiedade'   => 'Ansiedade',
  'depressao'   => 'Depressão',
  'vicios'      => 'Vícios',
  'autocuidado' => 'Autocuidado/Autoconhecimento',
][$tema];
?>
<!DOCTYPE html>
<html lang="pt-BR">
<head>
<meta charset="UTF-8" />
<meta name="viewport" content="width=device-width, initial-scale=1.0"/>
<title>Sala Ao Vivo - Conexus | Tema: <?php echo htmlspecialchars($titulo_tema); ?></title>
<style>
  :root{
    --bg1:#111; --grad1:#5c3fa0; --grad2:#00c1c1; --primary:#5c3fa0; --light:#e0f7fa; --text:#fff; --ink:#111;
  }
  *{box-sizing:border-box}
  body{margin:0;font-family:Arial,Helvetica,sans-serif;background:#111;color:#fff}
  .container{
    display:flex;flex-direction:column;min-height:100vh;width:100%;
    background:linear-gradient(90deg,var(--grad1),var(--grad2));
    padding:16px;
  }
  .header{
    text-align:center;font-size:24px;font-weight:700;margin-bottom:8px;
  }
  .subheader{
    text-align:center;font-size:14px;opacity:.9;margin-bottom:16px;
  }
  .chat-room{
    display:grid;grid-template-columns:2.2fr 1fr 1.6fr;gap:16px;flex:1;min-height:0;
  }

  /* ─── Vídeos (Dr grande + Usuário menor) ─────────────────────────────── */
  .video-stack{display:flex;flex-direction:column;gap:12px;min-height:0}
  .video-box{
    background:#000;border-radius:12px;position:relative;display:flex;align-items:center;justify-content:center;min-height:220px;overflow:hidden;
  }
  .video-box.doctor{flex:1.2}
  .video-box.user{flex:.8}
  .avatar{
    width:110px;height:110px;border-radius:50%;background:#5c3fa0;color:#fff;display:flex;align-items:center;justify-content:center;
    font-size:36px;font-weight:800;letter-spacing:.5px;box-shadow:0 6px 20px rgba(0,0,0,.35);
  }
  video{width:100%;height:100%;object-fit:cover;display:block}

  .controls{
    position:absolute;bottom:12px;right:12px;display:flex;gap:8px;
  }
  .controls button{
    width:40px;height:40px;border:none;border-radius:50%;background:#ffffff22;color:#fff;cursor:pointer;font-size:18px;
    backdrop-filter: blur(3px);
  }

  /* ─── Participantes (avatares circulares com iniciais) ───────────────── */
  .participants{
    display:flex;flex-direction:column;gap:10px;overflow:auto;padding-right:2px;
  }
  .participant{
    display:flex;align-items:center;gap:10px;background:#ffffff10;border:1px solid #ffffff22;border-radius:12px;padding:8px;
  }
  .p-avatar{
    width:40px;height:40px;border-radius:50%;display:flex;align-items:center;justify-content:center;font-weight:800;
    color:#fff;box-shadow:0 2px 10px rgba(0,0,0,.25);
  }
  .p-name{font-weight:700}
  .bot-tag{opacity:.8;font-size:12px}

  /* ─── Chat box ───────────────────────────────────────────────────────── */
  .chat-box{
    display:flex;flex-direction:column;background:var(--light);color:#000;border-radius:12px;padding:10px;min-height:0;
  }
  .messages{flex:1;overflow:auto;margin-bottom:8px}
  .message{margin:6px 0;line-height:1.35}
  .message .who{font-weight:800}
  .chip{
    display:inline-flex;align-items:center;gap:6px;background:#ffffff; border-radius:999px; padding:6px 10px; font-size:12px; color:#333; margin-bottom:6px;
  }
  .chat-input{display:flex;gap:8px}
  .chat-input input{
    flex:1;padding:10px;border-radius:10px;border:1px solid #ccc;font-size:14px;
  }
  .chat-input button{
    padding:10px 16px;border:none;border-radius:10px;background:var(--primary);color:#fff;font-weight:700;cursor:pointer;
  }
  .tiny{font-size:12px;opacity:.85}
</style>
</head>
<body>
<div class="container">
  <div class="header">Salas Ao Vivo - Conexus</div>
  <div class="subheader">Tema: <strong><?php echo htmlspecialchars($titulo_tema); ?></strong></div>

  <div class="chat-room">
    <!-- Coluna 1: Vídeos -->
    <div class="video-stack">
      <!-- Dr. Lucas: vídeo de abertura por tema -->
      <div class="video-box doctor" id="doctorBox">
        <div id="doctorAvatar" class="avatar" style="display:none;">DR</div>
        <video id="doctorVideo" preload="metadata">
          <source src="<?php echo htmlspecialchars($video_src); ?>" type="video/mp4">
          Seu navegador não suporta vídeo.
        </video>
      </div>

      <!-- Usuário (câmera simulada - avatar) -->
      <div class="video-box user">
        <div class="avatar">V</div>
        <div class="controls">
          <button title="Câmera">📷</button>
          <button title="Chamada">📞</button>
          <button title="Microfone">🎤</button>
          <button title="Mais">⋮</button>
        </div>
      </div>
    </div>

    <!-- Coluna 2: Participantes -->
    <div class="participants" id="participants">
      <!-- Preenchido via JS para manter 100% dinâmico (iniciais automáticas) -->
    </div>

    <!-- Coluna 3: Chat -->
    <div class="chat-box">
      <div class="chip">
        <span>👨‍⚕️ Moderador: Dr. Lucas</span>
        <span>•</span>
        <span>🤖 7 bots ativos</span>
      </div>
      <div class="messages" id="messages"></div>
      <div class="chat-input">
        <input type="text" id="userInput" placeholder="Escrever..." autocomplete="off">
        <button id="sendBtn">Enviar</button>
      </div>
      <div class="tiny">O moderador inicia e novos ciclos acontecem automaticamente a cada 60s.</div>
    </div>
  </div>
</div>

<script>
  // ---------- Configurações iniciais ----------
  const temaAtual = "<?php echo htmlspecialchars($tema); ?>"; // "ansiedade" | "depressao" | "vicios" | "autocuidado"

  // Lista de participantes (1 humano + 1 moderador + 7 bots)
  const participantes = [
    { nome: "Você", corBg:"#000000", corTxt:"#ffffff", bot:false, rotulo:"" },
    { nome: "Dr. Lucas", corBg:"#ff6f61", corTxt:"#ffffff", bot:true, rotulo:"🤖 Moderador" },
    { nome: "Bárbara",  corBg:"#2b2aff", corTxt:"#ffffff", bot:true, rotulo:"🤖" },
    { nome: "João",     corBg:"#a42bff", corTxt:"#ffffff", bot:true, rotulo:"🤖" },
    { nome: "Satoru",   corBg:"#5b2bff", corTxt:"#ffffff", bot:true, rotulo:"🤖" },
    { nome: "Paul",     corBg:"#ff2b5b", corTxt:"#ffffff", bot:true, rotulo:"🤖" },
    { nome: "Caleb",    corBg:"#2bffa0", corTxt:"#111111", bot:true, rotulo:"🤖" },
    { nome: "Ana",      corBg:"#ffcc00", corTxt:"#111111", bot:true, rotulo:"🤖" },
    { nome: "Felipe",   corBg:"#00bfff", corTxt:"#111111", bot:true, rotulo:"🤖" },
  ];

  // ---------- UI helpers ----------
  const messagesEl = document.getElementById('messages');
  const participantsEl = document.getElementById('participants');

  function inicial(nome){
    if (nome.toUpperCase() === "DR. LUCAS") return "DR";
    return nome.trim().charAt(0).toUpperCase();
  }

  function renderParticipantes(){
    participantsEl.innerHTML = "";
    participantes.forEach(p => {
      const el = document.createElement('div');
      el.className = 'participant';
      el.innerHTML = `
        <div class="p-avatar" style="background:${p.corBg};color:${p.corTxt}">${inicial(p.nome)}</div>
        <div>
          <div class="p-name">${p.nome}</div>
          ${p.bot ? `<div class="bot-tag">${p.rotulo}</div>` : ``}
        </div>
      `;
      participantsEl.appendChild(el);
    });
  }

  function addMessage(quem, cor, texto){
    const div = document.createElement('div');
    div.className = 'message';
    div.innerHTML = `<span class="who" style="color:${cor}">${quem}:</span> ${texto}`;
    messagesEl.appendChild(div);
    messagesEl.scrollTop = messagesEl.scrollHeight;
  }

  // ---------- Conteúdo por tema ----------
  const falasModerador = {
    ansiedade: [
      "Hoje vamos conversar sobre ansiedade. Como ela tem afetado o dia a dia de vocês?",
      "Quais estratégias vocês têm usado para lidar com os picos de ansiedade?",
      "Alguém gostaria de compartilhar uma situação recente e como lidou com ela?"
    ],
    depressao: [
      "Vamos falar sobre depressão. O que tem ajudado vocês nos momentos mais difíceis?",
      "Quais pequenas ações do dia têm trazido algum alívio ou ânimo?",
      "Como vocês percebem o papel do apoio social nesse processo?"
    ],
    vicios: [
      "Nosso tema hoje é vícios. Quais desafios vocês têm encontrado para manter a mudança?",
      "Que alternativas práticas têm funcionado como substitutos saudáveis?",
      "Como lidam com gatilhos e recaídas no cotidiano?"
    ],
    autocuidado: [
      "O assunto é autocuidado/autoconhecimento. O que têm feito para se cuidar melhor?",
      "Quais práticas de rotina fazem diferença no bem-estar de vocês?",
      "De que forma vocês têm se conhecido e se respeitado mais ultimamente?"
    ]
  };

  const falasBots = {
    ansiedade: [
      "Uso respiração guiada e noto alívio em minutos.",
      "Evitar café e notícias antes de dormir ajudou bastante.",
      "Exercícios leves têm reduzido minha tensão.",
      "Escrever num diário me acalma quando a mente acelera.",
      "Tento organizar o dia em blocos curtos; diminui a pressão.",
      "Mindfulness 10 minutos por dia já fez diferença.",
      "Compartilhar aqui me faz sentir acolhido."
    ],
    depressao: [
      "A terapia tem sido essencial para mim.",
      "Voltei a caminhar ao sol e ajudou no humor.",
      "Apoio da família tem sido um pilar importante.",
      "Escrever sobre sentimentos trouxe clareza.",
      "Medicação ajustada estabilizou meus ciclos.",
      "Retomar hobbies antigos reacendeu um pouco de ânimo.",
      "Conversar com amigos me tira do isolamento."
    ],
    vicios: [
      "Troquei redes sociais por leitura à noite.",
      "Busquei ajuda profissional e fez toda a diferença.",
      "Hobbies manuais me ajudam a lidar com gatilhos.",
      "Aviso amigos quando estou vulnerável; me apoiam.",
      "Evito ambientes de risco e combino rotas alternativas.",
      "Pratico exercícios quando a vontade aperta.",
      "Anoto vitórias pequenas para manter o foco."
    ],
    autocuidado: [
      "Caminhadas diárias têm sido meu ponto de equilíbrio.",
      "Dormir mais cedo transformou minhas manhãs.",
      "Meditação curta antes do trabalho me centra.",
      "Faço um diário de gratidão com 3 itens/dia.",
      "Simplifiquei a alimentação e me sinto melhor.",
      "Separei tempo real para meus hobbies.",
      "Estabeleci limites com pessoas que me drenam."
    ]
  };

  // ---------- Sequência: Vídeo → Moderador → Bots (com ciclos) ----------
  const doctorVideo = document.getElementById('doctorVideo');
  const doctorAvatar = document.getElementById('doctorAvatar');

  function falaModerador(){
    const lista = falasModerador[temaAtual] || falasModerador.ansiedade;
    return lista[Math.floor(Math.random()*lista.length)];
    }

  function falaBot(){
    const lista = falasBots[temaAtual] || falasBots.ansiedade;
    return lista[Math.floor(Math.random()*lista.length)];
  }

  function iniciarRodada(){
    // moderador fala primeiro
    addMessage('Dr. Lucas', '#ff6f61', falaModerador());
    // bots respondem em sequência com delays 3–5s entre cada
    const ordemBots = participantes.filter(p => p.bot && p.nome !== 'Dr. Lucas');
    let acumulado = 1200; // pequena pausa após moderador
    ordemBots.forEach(b => {
      const jitter = 3000 + Math.floor(Math.random()*2000); // 3000–5000ms
      acumulado += jitter;
      setTimeout(() => addMessage(b.nome, b.corBg, falaBot()), acumulado);
    });
  }

  function iniciarCiclos(){
    // primeira rodada imediatamente após o vídeo
    iniciarRodada();
    // novas rodadas a cada 60s
    setInterval(iniciarRodada, 60000);
  }

  // ---------- Envio do usuário ----------
  const inputEl = document.getElementById('userInput');
  const sendBtn = document.getElementById('sendBtn');
  function enviarMensagem(){
    const txt = (inputEl.value || '').trim();
    if(!txt) return;
    addMessage('Você', '#000000', txt);
    inputEl.value = '';
  }
  inputEl.addEventListener('keydown', (e)=>{ if(e.key==='Enter') enviarMensagem(); });
  sendBtn.addEventListener('click', enviarMensagem);

  // ---------- Boot ----------
  renderParticipantes();

  // Assim que a página carregar, o vídeo do Dr. já está com o src do tema (definido em PHP).
  // Reproduz e, ao terminar, esconde o vídeo e mostra o avatar DR, iniciando a conversa.
  doctorVideo.addEventListener('ended', () => {
    doctorVideo.parentElement.style.display = 'none'; // esconde o quadro do vídeo
    doctorAvatar.style.display = 'flex';              // mostra o avatar DR
    iniciarCiclos();
  });

  // autoplay pode falhar em alguns navegadores; garantimos o play com interação mínima:
  (async () => {
    try { await doctorVideo.play(); } catch(e){ /* ignore */ }
  })();
</script>
</body>
</html>

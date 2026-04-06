
// =========================
// SEGURANÇA (evita erros)
// =========================
function existe(id) {
    return document.getElementById(id);
}

// =========================
// DEFINIR TIPO (CARDS)
// =========================
function definirTipo(tipo, el) {
    const campo = document.getElementById("tipo");
    const texto = document.getElementById("tipoSelecionado");

    if (campo) campo.value = tipo;
    if (texto) texto.innerHTML = "Tipo selecionado: <strong>" + tipo + "</strong>";

    // efeito visual
    let cards = document.querySelectorAll(".card");
    cards.forEach(card => card.classList.remove("ativo"));

    if (el) el.classList.add("ativo");
}

// =========================
// HORÁRIOS DE COLETA
// =========================
const coletas = {
    "Votorantim": {
        "Centro": "08:00",
        "Vila Nova": "10:00",
        "Itapeva": "14:00"
    },
    "Sorocaba": {
        "Éden": "07:30",
        "Campolim": "09:00",
        "Wanel Ville": "13:30"
    }
};

function buscarColeta() {
    if (!existe("bairro")) return;

    const bairro = document.getElementById("bairro").value.trim();
    const cidade = document.getElementById("cidade").value;
    const resultado = document.getElementById("resultado");

    if (!bairro || !cidade) {
        resultado.innerHTML = `
            <div class="card">
                <h3>⚠️ Atenção</h3>
                <p>Preencha todos os campos.</p>
            </div>
        `;
        return;
    }

    const bairroFormatado =
        bairro.charAt(0).toUpperCase() + bairro.slice(1).toLowerCase();

    const horario = coletas[cidade]?.[bairroFormatado];

    if (horario) {
        resultado.innerHTML = `
            <div class="card">
                <h3>Coleta encontrada 🚛</h3>
                <p><strong>Bairro:</strong> ${bairroFormatado}</p>
                <p><strong>Horário:</strong> ${horario}</p>
            </div>
        `;
    } else {
        resultado.innerHTML = `
            <div class="card">
                <h3>❌ Não encontrado</h3>
                <p>Não temos dados para esse bairro.</p>
            </div>
        `;
    }
}

// =========================
// STATUS DE SOLICITAÇÃO
// =========================
function verificarStatus() {
    if (!existe("id")) return;

    const id = document.getElementById("id").value;
    const statusDiv = document.getElementById("status");

    if (!id) {
        statusDiv.innerHTML = `
            <div class="card">
                <p>Digite um número de solicitação.</p>
            </div>
        `;
        return;
    }

    const statusFake = {
        "001": "Agendado",
        "002": "Em rota 🚛",
        "003": "Concluído ✅"
    };

    const status = statusFake[id] || "Não encontrado";

    statusDiv.innerHTML = `
        <div class="card">
            <h3>Status</h3>
            <p>${status}</p>
        </div>
    `;
}

// =========================
// FORMULÁRIO ECOLETA
// =========================
if (existe('form-ecoleta')) {
    document.getElementById('form-ecoleta').addEventListener('submit', function(event) {
        event.preventDefault();

        alert('Solicitação enviada com sucesso! 🚀');

        this.reset();
    });
}

// =========================
// ADMIN (opcional)
// =========================
function alterarStatus(buttonElement) {
    const li = buttonElement.closest('li');
    const statusSpan = li.querySelector('.status');

    let statusAtual = statusSpan ? statusSpan.textContent : "Pendente";
    let novoStatus = "Em andamento";

    if (statusAtual.includes("Em andamento")) {
        novoStatus = "Concluído";
        buttonElement.disabled = true;
    }

    if (statusSpan) {
        statusSpan.textContent = "Status: " + novoStatus;
    } else {
        li.innerHTML += `<span class="status">Status: ${novoStatus}</span>`;
    }
}

// =========================
// SCROLL SUAVE
// =========================
document.querySelectorAll('a[href^="#"]').forEach(anchor => {
    anchor.addEventListener('click', function (e) {
        const target = document.querySelector(this.getAttribute('href'));
        if (target) {
            e.preventDefault();
            target.scrollIntoView({ behavior: 'smooth' });
        }
    });
});
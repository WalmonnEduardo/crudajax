const URL_BASE = document.getElementById("confUrlBase").dataset.urlBase;
const turma = document.getElementById("confCategoria")?.dataset.turma ?? null;
const equipe = document.getElementById("confEquipe")?.dataset.equipe ?? null;
const robo = document.getElementById("confRobo")?.dataset.robo ?? null;
function carregarEstudantes()
{
    let table = document.getElementsByTagName("table")[0]
    const dados = new FormData()
    dados.append("acao","selectall");
    let url = URL_BASE+"/controller/EstudanteController.php";
    let xhttp = new XMLHttpRequest();
    xhttp.open("POST",url,true);
    xhttp.onload = () => {
        let lines = xhttp.responseText;
        table.innerHTML = `
            <tr>
                <th class="border-4 bg-gray-700 text-white">Id</th>
                <th class="border-4 bg-gray-600 text-white">Nome</th>
                <th class="border-4 bg-gray-700 text-white">Data de Nascimento</th>
                <th class="border-4 bg-gray-600 text-white">Turma</th>
                <th class="border-4 bg-gray-700 text-white">Robô</th>
                <th class="border-4 bg-gray-600 text-white">Equipe</th>
                <th class="border-4 bg-gray-700 text-white">Editar</th>
                <th class="border-4 bg-gray-600 text-white">Excluir</th>
            </tr>
            ${lines}
        `;

    }
    xhttp.send(dados);
    
}
function carregarSelectEquipe() {
    let selectE = document.getElementById("equipe");
    if (!selectE) return; // se está no listar, ignora

    const dados = new FormData();
    dados.append("acao", "selectallSel");

    let url = URL_BASE + "/controller/EquipeController.php";
    let xhttp = new XMLHttpRequest();
    xhttp.open("POST", url, true);

    xhttp.onload = () => {
        let json = JSON.parse(xhttp.responseText);

        json.forEach(element => {
            let option = document.createElement("option");
            option.value = element.id;
            option.innerText = element.nome;

            if (equipe !== null && String(equipe) === String(element.id)) {
                option.selected = true;
            }


            selectE.appendChild(option);
        });
    };

    xhttp.send(dados);
}
function carregarSelectTurma() {
    let selectT = document.getElementById("turma");
    if (!selectT) return; // se está no listar, ignora

    const dados = new FormData();
    dados.append("acao", "selectallSel");

    let url = URL_BASE + "/controller/TurmaController.php";
    let xhttp = new XMLHttpRequest();
    xhttp.open("POST", url, true);

    xhttp.onload = () => {
        let json = JSON.parse(xhttp.responseText);

        json.forEach(element => {
            let option = document.createElement("option");
            option.value = element.id;
            option.innerText = element.nome;

            if (equipe !== null && String(equipe) === String(element.id)) {
                option.selected = true;
            }


            selectT.appendChild(option);
        });
    };

    xhttp.send(dados);
}
function carregarSelectRobo()
{
    let selectR = document.getElementById("id_robo");
    if (!selectR) return; // se está no listar, ignora

    const dados = new FormData();
    dados.append("acao", "selectallSel");
    dados.append("equipe", document.getElementById("equipe").value);

    let url = URL_BASE + "/controller/TurmaController.php";
    let xhttp = new XMLHttpRequest();
    xhttp.open("POST", url, true);

    xhttp.onload = () => {
        let json = JSON.parse(xhttp.responseText);

        json.forEach(element => {
            let option = document.createElement("option");
            option.value = element.id;
            option.innerText = element.nome;

            if (equipe !== null && String(equipe) === String(element.id)) {
                option.selected = true;
            }


            selectR.appendChild(option);
        });
    };

    xhttp.send(dados);
}

carregarSelectEquipe();
carregarSelectTurma();
//carregarSelectRobo();
carregarEstudantes()
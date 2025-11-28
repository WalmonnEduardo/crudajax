// Pegando a URL base (este span sempre existe)
const URL_BASE = document.getElementById("confUrlBase").dataset.urlBase;

const categoria = document.getElementById("confCategoria")?.dataset.categoria ?? null;
const equipe = document.getElementById("confEquipe")?.dataset.equipe ?? null;

function carregarRobos() {
    let table = document.getElementsByTagName("table")[0];
    const dados = new FormData();
    dados.append("acao", "selectall");
    let url = URL_BASE + "/controller/RoboController.php";
    let xhttp = new XMLHttpRequest();
    xhttp.open("POST", url, true);
    
    xhttp.onload = () => {
        let lines = xhttp.responseText;
        table.innerHTML = `
            <tr>
                <th class="border-4 bg-gray-700 text-white">Id</th>
                <th class="border-4 bg-gray-600 text-white">Nome</th>
                <th class="border-4 bg-gray-700 text-white">Categoria</th>
                <th class="border-4 bg-gray-600 text-white">Equipe</th>
                <th class="border-4 bg-gray-700 text-white">Editar</th>
                <th class="border-4 bg-gray-600 text-white">Excluir</th>
            </tr>
            ${lines}
        `;
    };
    
    xhttp.send(dados);
}

function carregarSelectCategoria() {
    let selectC = document.getElementById("categoria");
    if (!selectC) return; 

    const dados = new FormData();
    dados.append("acao", "selectallSel");

    let url = URL_BASE + "/controller/CategoriaController.php";
    let xhttp = new XMLHttpRequest();
    xhttp.open("POST", url, true);

    xhttp.onload = () => {
        let json = JSON.parse(xhttp.responseText);

        json.forEach(element => {
            let option = document.createElement("option");
            option.value = element.id;
            option.innerText = element.nome;

            if (categoria !== null && String(categoria) === String(element.id)) {
                option.selected = true;
            }


            selectC.appendChild(option);
        });
    };

    xhttp.send(dados);
}

function carregarSelectEquipe() {
    let selectE = document.getElementById("equipe");
    if (!selectE) return;

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

carregarSelectCategoria();
carregarSelectEquipe();
carregarRobos();

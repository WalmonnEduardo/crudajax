const URL_BASE = document.getElementById("confUrlBase").dataset.urlBase;
function carregarUsuarios()
{
    let table = document.getElementsByTagName("table")[0]
    const dados = new FormData()
    dados.append("acao","selectall");
    let url = URL_BASE+"/controller/TurmaController.php";
    let xhttp = new XMLHttpRequest();
    xhttp.open("POST",url,true);
    xhttp.onload = () => {
        let lines = xhttp.responseText;
        table.innerHTML = `
            <tr>
                <th class="border-4 bg-gray-700 text-white">Id</th>
                <th class="border-4 bg-gray-600 text-white">Nome</th>
                <th class="border-4 bg-gray-700 text-white">Editar</th>
                <th class="border-4 bg-gray-600 text-white">Excluir</th>
            </tr>
            ${lines}
        `;

    }
    xhttp.send(dados);
    
}
carregarUsuarios()
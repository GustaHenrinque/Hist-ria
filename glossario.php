<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Glossário</title>
    <link rel="stylesheet" href="glossario.css">
    <script src="js.js" defer></script>
</head>
<body>
    <header>
        <div class="container">
            <nav class="sidebar" id="sidebar">
                <ul>
                    <li><a href="INDEX.php">Início</a></li>
                    <li><a href="pre-historia.php">História Primitiva</a></li>
                    <li><a href="antiga.php">História Antiga</a></li>
                    <li><a href="media.php">Idade Média</a></li>
                    <li><a href="moderna.php">Idade Moderna</a></li>
                    <li><a href="contempo.php">Idade Contemporânea</a></li>
                    <li><a href="glossario.php">Glossário Histórico</a></li>
                   
                </ul>
                <img src="./img/png.png" alt="Imagem da Idade Primitiva">
            </nav>
            <div class="menu-toggle" id="menuToggle">
                <span>☰</span>
            </div>
        </div>
    </header>

    <div class="glossary">
        <h1><span class="highlight"><strong>Glossário</strong></span> Histórico</h1>

        <!-- Barra de busca -->
        <div class="search-container">
            <input type="text" id="searchInput" placeholder="Pesquisar termo..." onkeyup="filterGlossary()" />
            <div id="suggestions"></div>
        </div>

        <!-- Botão para adicionar novo termo -->
        <div class="add-term">
            <button onclick="addGlossaryTerm()">Adicionar Termo</button>
        </div>

        <ul id="glossaryList">
            <!-- Os termos serão carregados aqui -->
        </ul>
    </div>

    <script>
        // Função para carregar os termos do localStorage
        function loadGlossary() {
            const glossaryList = document.getElementById("glossaryList");
            const savedTerms = JSON.parse(localStorage.getItem("glossary")) || []; // Carregar termos ou criar um array vazio

            // Limpa a lista antes de adicionar os termos
            glossaryList.innerHTML = "";

            // Adiciona os termos salvos à lista
            savedTerms.forEach(term => {
                const listItem = document.createElement("li");
                listItem.innerHTML = `<strong>${term.name}:</strong> ${term.definition} 
                                      <button onclick="removeTerm(this)">Excluir</button> 
                                      <button onclick="editTerm('${term.name}')">Editar</button>`;
                glossaryList.appendChild(listItem);
            });
        }

        // Função para adicionar um termo ao glossário
        function addGlossaryTerm() {
            const termo = prompt("Digite o termo:");
            const definicao = prompt("Digite a definição:");

            if (termo && definicao) {
                const newTerm = { name: termo, definition: definicao };

                // Carregar termos existentes do localStorage
                const savedTerms = JSON.parse(localStorage.getItem("glossary")) || [];

                // Adicionar o novo termo à lista
                savedTerms.push(newTerm);

                // Salvar a lista atualizada no localStorage
                localStorage.setItem("glossary", JSON.stringify(savedTerms));

                // Atualizar a lista exibida
                loadGlossary();
            } else {
                alert("Por favor, insira tanto o termo quanto a definição.");
            }
        }

        // Função para remover um termo da lista
        function removeTerm(button) {
            const termoParaRemover = button.parentElement; // Seleciona o item <li> pai do botão
            const termoName = termoParaRemover.querySelector("strong").textContent.slice(0, -1); // Obtém o nome do termo

            // Carregar termos existentes do localStorage
            const savedTerms = JSON.parse(localStorage.getItem("glossary")) || [];

            // Filtrar o termo removido
            const updatedTerms = savedTerms.filter(term => term.name !== termoName);

            // Atualizar o localStorage com a nova lista
            localStorage.setItem("glossary", JSON.stringify(updatedTerms));

            // Remover o item da lista visível
            termoParaRemover.remove();
        }

        // Função de filtro (se for necessário para a barra de pesquisa)
        function filterGlossary() {
            const input = document.getElementById("searchInput");
            const filter = input.value.toLowerCase();
            const listItems = document.querySelectorAll("#glossaryList li");

            listItems.forEach(item => {
                const term = item.querySelector("strong").textContent.toLowerCase();
                if (term.includes(filter)) {
                    item.style.display = "";
                } else {
                    item.style.display = "none";
                }
            });
        }

        // Função para editar um termo existente
        function editTerm(termName) {
            const savedTerms = JSON.parse(localStorage.getItem("glossary")) || [];

            // Encontrar o termo que deve ser editado
            const termToEdit = savedTerms.find(term => term.name === termName);

            if (termToEdit) {
                const newDefinition = prompt("Editar definição:", termToEdit.definition);

                if (newDefinition) {
                    // Atualizar a definição do termo
                    termToEdit.definition = newDefinition;

                    // Atualizar o localStorage com a lista de termos modificada
                    localStorage.setItem("glossary", JSON.stringify(savedTerms));

                    // Recarregar os termos na página
                    loadGlossary();
                }
            }
        }

        // Carregar a lista de termos quando a página for carregada
        window.onload = () => {
            // Carregar termos pré-definidos, se não existirem no localStorage
            const defaultTerms = [
                { name: "Absolutismo", definition: "Sistema de governo em que o monarca detinha poder absoluto." },
                { name: "Aculturação", definition: "Processo de troca de elementos culturais entre diferentes grupos." },
                { name: "Agricultura", definition: "Técnica de cultivo de plantas e criação de animais." },
                { name: "Alienação", definition: "Processo em que o indivíduo se sente desconectado da sociedade ou do trabalho." },
                { name: "América", definition: "Continente descoberto por Cristóvão Colombo em 1492." },
                { name: "Antigo Egito", definition: "Civilização antiga localizada no nordeste da África, às margens do Rio Nilo." },
                { name: "Arte Rupestre", definition: "Pinturas e gravuras feitas nas rochas, principalmente na pré-história." },
                { name: "Associação", definition: "Ato de se agrupar com outros com o objetivo de atingir fins comuns." },
                { name: "Atividade Industrial", definition: "Produção de bens em grande escala utilizando máquinas e recursos naturais." },
                { name: "Autoritarismo", definition: "Forma de governo em que o poder é centralizado nas mãos de uma única pessoa." },
                { name: "Capitulacões", definition: "Tratados que garantiam direitos especiais para estrangeiros em territórios dominados." },
                { name: "Capitalismo", definition: "Sistema econômico baseado na produção para o mercado e propriedade privada." },
                { name: "Cidades-Estado", definition: "Cidades autônomas com governo próprio, como na Grécia Antiga." },
                { name: "Cidadania", definition: "Direitos e deveres que uma pessoa tem dentro de uma nação." },
                { name: "Colonialismo", definition: "Processo de exploração e dominação de outros territórios para benefícios econômicos." },
                { name: "Comunismo", definition: "Sistema político e econômico que visa a igualdade social e a eliminação da propriedade privada." },
                { name: "Conquista", definition: "Processo de tomada de territórios por meio de guerras e expedições." },
                { name: "Constituição", definition: "Conjunto de leis que estabelece os direitos e deveres de um país." },
                { name: "Democracia", definition: "Sistema político em que o poder é exercido pelo povo, por meio de eleições." },
                { name: "Despotismo", definition: "Governo absoluto de um monarca ou líder." },
                { name: "Difusão Cultural", definition: "Espalhamento de elementos culturais entre diferentes grupos sociais." },
                { name: "Ditadura", definition: "Governo em que o poder é concentrado nas mãos de uma única pessoa ou grupo." },
                { name: "Divisão do Trabalho", definition: "Distribuição de tarefas de acordo com as especialidades de cada trabalhador." }
            ];

            if (!localStorage.getItem("glossary")) {
                localStorage.setItem("glossary", JSON.stringify(defaultTerms));
            }

            loadGlossary();
        }
    </script>
</body>
</html>

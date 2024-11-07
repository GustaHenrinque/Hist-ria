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
                    <li><a href="dev.php">Devs</a></li>
                </ul>
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
                listItem.innerHTML = `<strong>${term.name}:</strong> ${term.definition} <button onclick="removeTerm(this)">Excluir</button>`;
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
                { name: "Divisão do Trabalho", definition: "Organização de tarefas em uma sociedade, com especialização em diferentes funções." },
                { name: "Doutrina Monroe", definition: "Política externa dos Estados Unidos, que visava impedir a intervenção europeia nas Américas." },
                { name: "Empirismo", definition: "Teoria filosófica que defende o conhecimento como resultado da experiência." },
                { name: "Enlightenment", definition: "Movimento intelectual do século XVIII que enfatizava razão, ciência e direitos humanos." },
                { name: "Escambo", definition: "Troca direta de bens sem o uso de dinheiro." },
                { name: "Escravidão", definition: "Sistema de trabalho forçado, onde os indivíduos são considerados propriedade de outro." },
                { name: "Estado-nação", definition: "Forma de organização política em que um território corresponde a um Estado independente." },
                { name: "Feudalismo", definition: "Sistema social e econômico medieval baseado nas relações de vassalagem e posse de terras." },
                { name: "Filosofia", definition: "Estudo das questões fundamentais sobre existência, conhecimento e ética." },
                { name: "Fronteira", definition: "Linha que demarca os limites de um território ou estado." },
                { name: "Globalização", definition: "Processo de integração econômica, política e cultural em uma escala mundial." },
                { name: "Guerra Fria", definition: "Período de tensão política e militar entre os Estados Unidos e a União Soviética após a Segunda Guerra Mundial." },
                { name: "Guerra Fria", definition: "Conflito ideológico entre blocos capitalista e comunista no século XX." },
                { name: "Guerra dos Trinta Anos", definition: "Conflito religioso e político entre países europeus, que durou de 1618 a 1648." },
                { name: "Humanismo", definition: "Movimento cultural do Renascimento que enfatizava o valor do ser humano e suas capacidades." },
                { name: "Iluminismo", definition: "Movimento intelectual do século XVIII que defendia a razão, a ciência e os direitos humanos." }
            ];

            const savedTerms = JSON.parse(localStorage.getItem("glossary")) || [];
            if (savedTerms.length === 0) {
                localStorage.setItem("glossary", JSON.stringify(defaultTerms));
            }

            loadGlossary();
        };
    </script>
</body>
</html>

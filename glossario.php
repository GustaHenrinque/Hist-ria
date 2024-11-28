<?php
session_start();
// Verifique se o tipo de usuário é 'aluno'
$isAluno = isset($_SESSION['tipo']) && $_SESSION['tipo'] === 'aluno';
?>

<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Glossário</title>
    <link rel="stylesheet" href="glossario.css">
    <script src="js.js" defer></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
</head>

<body>
    <header>
        <div class="container">
            <nav class="sidebar" id="sidebar">
                <ul>
                    <li><a href="INDEX.php">Início</a></li>
                    <li><a href="periodos.php">Períodos</a></li>
                    <li><a href="pre-historia.php">História Primitiva</a></li>
                    <li><a href="antiga.php">História Antiga</a></li>
                    <li><a href="media.php">Idade Média</a></li>
                    <li><a href="moderna.php">Idade Moderna</a></li>
                    <li><a href="contempo.php">Idade Contemporânea</a></li>
                    <li><a href="glossario.php">Glossário Histórico</a></li>
                </ul>
                <img src="./img/logo-hist.jpeg" alt="Imagem da Idade Primitiva">
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
            <button class="btn-add-term" onclick="addGlossaryTerm()">Adicionar Termo</button>
        </div>

        <ul id="glossaryList">
            <!-- Os termos serão carregados aqui -->
        </ul>
    </div>

    <button id="backToTopBtn" onclick="scrollToTop()">↑</button>

    <script>
        // Variável global para saber se o usuário é aluno
        const isAluno = <?php echo $isAluno ? 'true' : 'false'; ?>;

        // Função para carregar os termos do localStorage
        function loadGlossary() {
            const glossaryList = document.getElementById("glossaryList");
            const savedTerms = JSON.parse(localStorage.getItem("glossary")) || [];

            glossaryList.innerHTML = "";
            savedTerms.forEach(term => {
                const listItem = document.createElement("li");
                listItem.classList.add("glossary-item");
                
                // fiz uma validação simples pra saber ser o cara logado é um aluno. A variavel está criada na linha 4
                if (!isAluno) {
                    const editButton = `<button onclick="editTerm('${term.name}')" style="background-color: transparent; color: #006400; border: 2px solid #006400; padding: 5px; border-radius: 4px;">✏️</button>`;
                    const deleteButton = `<button onclick="removeTerm('${term.name}')" style="background-color: transparent; color: #800000; border: 2px solid #800000; padding: 5px; border-radius: 4px;">🗑️</button>`;
                    listItem.innerHTML = `
                        <strong>${term.name}:</strong> ${term.definition} 
                        ${editButton}
                        ${deleteButton}
                    `;
                } else {
                    listItem.innerHTML = `
                        <strong>${term.name}:</strong> ${term.definition}
                    `;
                }

                glossaryList.appendChild(listItem);
            });
        }

        function addGlossaryTerm() {
            Swal.fire({
                title: 'Digite o termo',
                input: 'text',
                showCancelButton: true,
                confirmButtonText: 'Próximo',
                cancelButtonText: 'Cancelar',
                inputValidator: (value) => {
                    if (!value) {
                        return 'Por favor, insira um termo!';
                    }
                }
            }).then((result) => {
                if (result.isConfirmed) {
                    const termo = result.value;

                    Swal.fire({
                        title: 'Digite a definição',
                        input: 'text',
                        showCancelButton: true,
                        confirmButtonText: 'Adicionar',
                        cancelButtonText: 'Cancelar',
                        inputValidator: (value) => {
                            if (!value) {
                                return 'Por favor, insira uma definição!';
                            }
                        }
                    }).then((defResult) => {
                        if (defResult.isConfirmed) {
                            const definicao = defResult.value;
                            const newTerm = { name: termo, definition: definicao };
                            const savedTerms = JSON.parse(localStorage.getItem("glossary")) || [];
                            savedTerms.push(newTerm);
                            localStorage.setItem("glossary", JSON.stringify(savedTerms));
                            loadGlossary();

                            Swal.fire({
                                icon: 'success',
                                title: 'Termo adicionado',
                                text: 'O termo foi adicionado com sucesso!',
                                confirmButtonColor: '#3085d6'
                            });
                        }
                    });
                }
            });
        }

        // Função para remover um termo da lista
        function removeTerm(termName) {
            Swal.fire({
                title: 'Tem certeza?',
                text: "Essa ação não pode ser desfeita!",
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: 'Sim, excluir',
                cancelButtonText: 'Cancelar'
            }).then((result) => {
                if (result.isConfirmed) {
                    const savedTerms = JSON.parse(localStorage.getItem("glossary")) || [];
                    const updatedTerms = savedTerms.filter(term => term.name !== termName);
                    localStorage.setItem("glossary", JSON.stringify(updatedTerms));
                    loadGlossary();

                    Swal.fire('Excluído!', 'O termo foi removido com sucesso.', 'success');
                }
            });
        }

        // Função para editar um termo existente
        function editTerm(termName) {
            const savedTerms = JSON.parse(localStorage.getItem("glossary")) || [];
            const termToEdit = savedTerms.find(term => term.name === termName);

            if (termToEdit) {
                Swal.fire({
                    title: `Editar definição de "${termName}"`,
                    input: 'text',
                    inputValue: termToEdit.definition,
                    showCancelButton: true,
                    confirmButtonText: 'Salvar',
                    cancelButtonText: 'Cancelar',
                    inputValidator: (value) => {
                        if (!value) {
                            return 'A definição não pode estar vazia!';
                        }
                    }
                }).then((result) => {
                    if (result.isConfirmed) {
                        const newDefinition = result.value;
                        if (newDefinition) {
                            termToEdit.definition = newDefinition;
                            localStorage.setItem("glossary", JSON.stringify(savedTerms));
                            loadGlossary();

                            Swal.fire({
                                icon: 'success',
                                title: 'Definição atualizada!',
                                text: 'A definição foi editada com sucesso.',
                                confirmButtonColor: '#3085d6'
                            });
                        }
                    }
                });
            }
        }

        // Função de filtro (para a barra de pesquisa)
        function filterGlossary() {
            const input = document.getElementById("searchInput");
            const filter = input.value.toLowerCase();
            const listItems = document.querySelectorAll("#glossaryList li");

            listItems.forEach(item => {
                const term = item.querySelector("strong").textContent.toLowerCase();
                item.style.display = term.includes(filter) ? "" : "none";
            });
        }

        // Função para voltar ao topo da página
        function scrollToTop() {
            window.scrollTo({ top: 0, behavior: 'smooth' });
        }

        window.onload = () => {
            if (!localStorage.getItem("glossary")) {
                const defaultTerms = [
                    { name: "Absolutismo", definition: "Sistema de governo em que o monarca detinha poder absoluto." },
                    { name: "Aculturação", definition: "Processo de troca de elementos culturais entre diferentes grupos." },
                    { name: "Agricultura", definition: "Técnica de cultivo de plantas e criação de animais." },
                    { name: "Alienação", definition: "Processo em que o indivíduo se sente desconectado da sociedade." },
                    { name: "Antigo Egito", definition: "Civilização antiga localizada no nordeste da África, às margens do Rio Nilo." },
                    { name: "Arte Rupestre", definition: "Pinturas e gravuras feitas nas rochas, principalmente na pré-história." },
                    { name: "Associação", definition: "Ato de se agrupar com outros com o objetivo de atingir fins comuns." },
                    { name: "Atividade Industrial", definition: "Produção de bens em grande escala utilizando máquinas e recursos naturais." },
                    { name: "Autoritarismo", definition: "Forma de governo em que o poder é centralizado nas mãos de uma única pessoa." },
                    { name: "Barroco", definition: "Estilo artístico dos séculos XVII e XVIII, marcado pelo exagero e pelo detalhamento." },
                    { name: "Bipolaridade", definition: "Período da Guerra Fria marcado pela divisão de poder entre EUA e URSS." },
                    { name: "Capitulacões", definition: "Tratados que garantiam direitos especiais para estrangeiros em territórios dominados." },
                    { name: "Capitalismo", definition: "Sistema econômico baseado na produção para o mercado e propriedade privada." }
                ];
                localStorage.setItem("glossary", JSON.stringify(defaultTerms));
            }

            loadGlossary();
        };
    </script>
</body>
</html>

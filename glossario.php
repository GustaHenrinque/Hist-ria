<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Glossário</title>
    <link rel="stylesheet" href="glossario.css">
    <script src="js.js" defer></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <button id="backToTopBtn" onclick="scrollToTop()">↑</button>
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
            <button class="btn-add-term" onclick="addGlossaryTerm()">Adicionar Termo</button>
        </div>

        <ul id="glossaryList">
            <!-- Os termos serão carregados aqui -->
        </ul>
    </div>

    <button id="backToTop" onclick="scrollToTop()">↑</button>

    <script>
        // Função para carregar os termos do localStorage
        function loadGlossary() {
            const glossaryList = document.getElementById("glossaryList");
            const savedTerms = JSON.parse(localStorage.getItem("glossary")) || [];

            glossaryList.innerHTML = "";
            savedTerms.forEach(term => {
                const listItem = document.createElement("li");
                listItem.classList.add("glossary-item");
                listItem.innerHTML = `
                    <strong>${term.name}:</strong> ${term.definition} 
                    <button onclick="removeTerm('${term.name}')" style="background-color: transparent; color: #800000; border: 2px solid #800000; padding: 5px; border-radius: 4px;">🗑️</button> 
                    <button onclick="editTerm('${term.name}')" style="background-color: transparent; color: #006400; border: 2px solid #006400; padding: 5px; border-radius: 4px;">✏️</button>
                `;

                glossaryList.appendChild(listItem);
            });
        }

        // Função para adicionar um termo ao glossário
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
                    { name: "Alienação", definition: "Processo em que o indivíduo se sente desconectado da sociedade ou do trabalho." },
                    { name: "América", definition: "Continente descoberto por Cristóvão Colombo em 1492." },
                    { name: "Anarquismo", definition: "Ideologia política que defende a ausência de governo e hierarquias." },
            { name: "Antigo Egito", definition: "Civilização antiga localizada no nordeste da África, às margens do Rio Nilo." },
            { name: "Arte Rupestre", definition: "Pinturas e gravuras feitas nas rochas, principalmente na pré-história." },
            { name: "Associação", definition: "Ato de se agrupar com outros com o objetivo de atingir fins comuns." },
            { name: "Atividade Industrial", definition: "Produção de bens em grande escala utilizando máquinas e recursos naturais." },
            { name: "Autoritarismo", definition: "Forma de governo em que o poder é centralizado nas mãos de uma única pessoa." },
            { name: "Barroco", definition: "Estilo artístico dos séculos XVII e XVIII, marcado pelo exagero e pelo detalhamento." },
            { name: "Bipolaridade", definition: "Período da Guerra Fria marcado pela divisão de poder entre EUA e URSS." },
            { name: "Capitulacões", definition: "Tratados que garantiam direitos especiais para estrangeiros em territórios dominados." },
            { name: "Capitalismo", definition: "Sistema econômico baseado na produção para o mercado e propriedade privada." },
            { name: "Cidadania", definition: "Direitos e deveres que uma pessoa tem dentro de uma nação." },
            { name: "Cidades-Estado", definition: "Cidades autônomas com governo próprio, como na Grécia Antiga." },
            { name: "Cientificismo", definition: "Crença na ciência como a única forma válida de conhecimento." },
            { name: "Colonialismo", definition: "Processo de exploração e dominação de outros territórios para benefícios econômicos." },
            { name: "Comunismo", definition: "Sistema político e econômico que visa a igualdade social e a eliminação da propriedade privada." },
            { name: "Conquista", definition: "Processo de tomada de territórios por meio de guerras e expedições." },
            { name: "Constituição", definition: "Conjunto de leis que estabelece os direitos e deveres de um país." },
            { name: "Cristandade", definition: "Conjunto dos países e povos que seguem a religião cristã." },
            { name: "Democracia", definition: "Sistema político em que o poder é exercido pelo povo, por meio de eleições." },
            { name: "Descolonização", definition: "Processo de independência de colônias, especialmente no século XX." },
            { name: "Despotismo", definition: "Governo absoluto de um monarca ou líder." },
            { name: "Difusão Cultural", definition: "Espalhamento de elementos culturais entre diferentes grupos sociais." },
            { name: "Ditadura", definition: "Governo em que o poder é concentrado nas mãos de uma única pessoa ou grupo." },
            { name: "Divisão do Trabalho", definition: "Distribuição de tarefas de acordo com as especialidades de cada trabalhador." },
            { name: "Economia de Mercado", definition: "Sistema econômico onde os preços são determinados pela oferta e demanda." },
            { name: "Efeitos da Globalização", definition: "Impactos da interconexão mundial em economia, cultura e política." },
            { name: "Empirismo", definition: "Teoria filosófica que afirma que o conhecimento vem da experiência sensorial." },
            { name: "Escravidão", definition: "Sistema onde indivíduos são propriedade de outros e trabalham sem liberdade." },
            { name: "Estado de Bem-Estar Social", definition: "Modelo de governo que oferece serviços públicos como saúde e educação." },
            { name: "Feudalismo", definition: "Sistema político e econômico medieval baseado em relações de dependência entre senhores e vassalos." },
            { name: "Guerra Fria", definition: "Período de tensão política e militar entre EUA e URSS após a Segunda Guerra Mundial." },
            { name: "Globalização Cultural", definition: "Difusão de culturas no mundo, criando uma cultura global compartilhada." },
            { name: "Hegemonia", definition: "Predomínio de um estado ou grupo sobre os outros em termos de poder político ou econômico." },
            { name: "Humanismo", definition: "Movimento cultural do Renascimento que valoriza o ser humano e a razão." },
            { name: "Imperialismo", definition: "Política de expansão de poder e domínio sobre outras nações." },
            { name: "Iluminismo", definition: "Movimento intelectual do século XVIII que promovia a razão e os direitos humanos." },
            { name: "Independência", definition: "Processo pelo qual um território se torna livre do domínio de outra nação." },
            { name: "Industrialização", definition: "Processo de desenvolvimento das indústrias e aumento da produção em massa." },
            { name: "Mercantilismo", definition: "Política econômica dos séculos XV a XVIII que valorizava a acumulação de metais preciosos." },
            { name: "Monarquia", definition: "Sistema de governo liderado por um monarca, como rei ou imperador." },
            { name: "Movimento Operário", definition: "Lutas e organizações dos trabalhadores por direitos e melhores condições de trabalho." },
            { name: "Nacionalismo", definition: "Sentimento de valorização e defesa dos interesses de uma nação." },
            { name: "Neocolonialismo", definition: "Dominação econômica e cultural de nações mais ricas sobre países em desenvolvimento." },
            { name: "Neoliberalismo", definition: "Modelo econômico que enfatiza a redução do papel do Estado na economia." },
            { name: "Oligarquia", definition: "Sistema de governo em que o poder é controlado por um pequeno grupo de pessoas." },
            { name: "Pacto Colonial", definition: "Sistema de comércio exclusivo entre colônias e suas metrópoles na era colonial." },
            { name: "Panteísmo", definition: "Doutrina que identifica Deus com o universo e a natureza." },
            { name: "Proletariado", definition: "Classe de trabalhadores que dependem da venda de sua força de trabalho para sobreviver." },
            { name: "Racionalismo", definition: "Doutrina filosófica que defende o uso da razão como fonte principal do conhecimento." },
            { name: "Reforma Protestante", definition: "Movimento religioso que levou à criação de igrejas protestantes na Europa." },
            { name: "Renascimento", definition: "Movimento cultural dos séculos XIV a XVI que resgatou valores da cultura clássica." },
            { name: "Revolução Francesa", definition: "Movimento revolucionário que instaurou princípios de liberdade, igualdade e fraternidade na França." },
            { name: "Revolução Industrial", definition: "Período de grandes mudanças tecnológicas e industriais nos séculos XVIII e XIX." },
            { name: "Revolução Russa", definition: "Movimento revolucionário de 1917 que levou ao surgimento da União Soviética." },
            { name: "Secularização", definition: "Processo de separação entre religião e estado." },
            { name: "Socialismo", definition: "Sistema político e econômico que propõe a socialização dos meios de produção." },
            { name: "Sufrágio Feminino", definition: "Movimento pela conquista do direito de voto das mulheres." },
            { name: "Surrealismo", definition: "Movimento artístico que explora o inconsciente e a imaginação." },
            { name: "Teocracia", definition: "Sistema de governo onde líderes religiosos controlam o poder político." },
            { name: "Tradição Oral", definition: "Prática de transmitir conhecimentos e histórias de geração em geração através da fala." },
            { name: "Trégua de Natal", definition: "Pausa informal nos combates durante a Primeira Guerra Mundial, celebrada entre soldados." },
            { name: "Urbanização", definition: "Processo de crescimento das cidades e aumento da população urbana." },
            { name: "Vanguardas Artísticas", definition: "Movimentos artísticos inovadores e experimentais, como o cubismo e o dadaísmo." }
                ];
                localStorage.setItem("glossary", JSON.stringify(defaultTerms));
            }
            loadGlossary();
            
        }
        
    </script>
</body>
</html>



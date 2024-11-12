
function isProfessor() {
    const userRole = localStorage.getItem("userRole"); // Armazenando o tipo de usuário no localStorage
    return userRole === "professor";  // Verifica se o tipo de usuário é "professor"
}

// Função para exibir botões de editar/excluir para professores
function showAdminControls() {
    if (isProfessor()) {
        const editButtons = document.querySelectorAll('.edit-btn');
        const deleteButtons = document.querySelectorAll('.delete-btn');
        const addItemContainer = document.querySelector('.add-item-container');

        // Exibe os botões de edição/exclusão para todos os itens
        editButtons.forEach(button => button.style.display = 'inline');
        deleteButtons.forEach(button => button.style.display = 'inline');

        // Exibe a opção de adicionar novos termos
        addItemContainer.style.display = 'block';
    }
}

// Função para adicionar um novo termo ao glossário
function addItem() {
    const newTerm = document.getElementById('newTerm').value;
    const newDefinition = document.getElementById('newDefinition').value;

    if (newTerm && newDefinition) {
        const ul = document.getElementById('glossaryList');
        const li = document.createElement('li');
        li.classList.add('glossary-item');
        li.innerHTML = `<strong>${newTerm}:</strong> ${newDefinition}
                        <button class="edit-btn" style="display:none;" onclick="editItem(this)">Editar</button>
                        <button class="delete-btn" style="display:none;" onclick="deleteItem(this)">Excluir</button>`;
        ul.appendChild(li);
    }
}

// Função para editar um item (simples)
function editItem(button) {
    const li = button.parentElement;
    const term = li.querySelector('strong').textContent.replace(':', '');  // Pega o termo
    const definition = li.textContent.replace(term + ':', '').trim(); // Pega a definição

    const newTerm = prompt("Editar Termo", term);
    const newDefinition = prompt("Editar Definição", definition);

    if (newTerm && newDefinition) {
        li.querySelector('strong').textContent = newTerm + ':';
        li.querySelector('span').textContent = newDefinition;
    }
}

// Função para excluir um item
function deleteItem(button) {
    const li = button.parentElement;
    li.remove();  // Remove o item
}

// Função para revelar elementos ao rolar a página
function revealOnScroll() {
    const reveals = document.querySelectorAll('.content-box'); // Seleciona todos os elementos com a classe "content-box"

    for (let i = 0; i < reveals.length; i++) {
        const windowHeight = window.innerHeight; // Altura da janela do navegador
        const revealTop = reveals[i].getBoundingClientRect().top; // Posição do topo do elemento em relação à janela
        const revealPoint = 150; // Ponto onde o elemento começa a aparecer (a 150px do fundo da janela)

        // Se o topo do elemento estiver dentro da janela de visualização
        if (revealTop < windowHeight - revealPoint) {
            reveals[i].classList.add('show'); // Adiciona a classe "show" para revelar o elemento
        } else {
            reveals[i].classList.remove('show'); // Remove a classe "show" se não estiver visível
        }
    }
}

// Adiciona um listener de scroll para executar a função sempre que o usuário rolar a página
window.addEventListener('scroll', revealOnScroll);

// Função para alternar a visibilidade do menu lateral ao clicar no ícone de menu
document.getElementById('menuToggle').addEventListener('click', function() {
    var sidebar = document.getElementById('sidebar');
    sidebar.classList.toggle('active'); // Alterna a classe 'active' para mostrar ou ocultar a sidebar
});

// Função para filtrar os termos do glossário conforme o usuário digita na barra de pesquisa
function filterGlossary() {
    const input = document.getElementById('searchInput'); // Obtém o campo de entrada
    const filter = input.value.toLowerCase(); // Obtém o valor digitado e converte para minúsculas
    const ul = document.getElementById('glossaryList'); // Obtém a lista do glossário
    const items = ul.getElementsByTagName('li'); // Obtém todos os itens da lista (termos do glossário)

    // Loop para verificar cada item da lista
    for (let i = 0; i < items.length; i++) {
        const term = items[i].textContent || items[i].innerText; // Obtém o texto do item (termo)

        // Verifica se o termo contém o valor digitado
        if (term.toLowerCase().includes(filter)) {
            items[i].style.display = ""; // Mostra o item
        } else {
            items[i].style.display = "none"; // Oculta o item
        }
    }
}

// Inicializa o controle de exibição baseado no tipo de usuário
showAdminControls();

const input = document.querySelector(".todo-input");
const addButton = document.querySelector(".add-button");
const todosHtml = document.querySelector(".todos");
let todosJson = JSON.parse(localStorage.getItem("todos")) || [];
const deleteAllButton = document.querySelector(".delete-all");
const filters = document.querySelectorAll(".filter");
let filter = '';

showTodos();

function getTodoHtml(todo, index) {
    let checked = todo.status == "completed" ? "checked" : "";
    return `
        <li class="todo">
            <label for="${index}">
                <input id="${index}" onclick="updateStatus(this)" type="checkbox" ${checked}>
                <span class="${checked}">${todo.name}</span>
                <span class="due-date">${todo.dueDate}</span>
            </label>
            <button class="delete-btn" data-index="${index}" onclick="remove(this)"><i class="fa fa-times"></i></button>
        </li>
    `;
}

function showTodos() {
    if (todosJson.length == 0) {
        todosHtml.innerHTML = '';
    } else {
        todosHtml.innerHTML = todosJson.map(getTodoHtml).join('');
    }
}

function addTodo() {
    const billName = input.value.trim();
    const dueDate = document.querySelector("[name='dueDate']").value.trim();
    if (!billName || !dueDate) {
        return;
    }
    const newTodo = { name: billName, dueDate: dueDate, status: "pending" };
    todosJson.unshift(newTodo);
    localStorage.setItem("todos", JSON.stringify(todosJson));
    showTodos();
}

input.addEventListener("keyup", e => {
    if (e.key === "Enter") {
        addTodo();
    }
});

addButton.addEventListener("click", () => {
    addTodo();
});

function updateStatus(todo) {
    let todoName = todo.parentElement.lastElementChild;
    if (todo.checked) {
        todoName.classList.add("checked");
        todosJson[todo.id].status = "completed";
    } else {
        todoName.classList.remove("checked");
        todosJson[todo.id].status = "pending";
    }
    localStorage.setItem("todos", JSON.stringify(todosJson));
}

function remove(todo) {
    const index = todo.dataset.index;
    todosJson.splice(index, 1);
    localStorage.setItem("todos", JSON.stringify(todosJson));
    showTodos();
}

filters.forEach(function (el) {
    el.addEventListener("click", (e) => {
        if (el.classList.contains('active')) {
            el.classList.remove('active');
            filter = '';
        } else {
            filters.forEach(tag => tag.classList.remove('active'));
            el.classList.add('active');
            filter = e.target.dataset.filter;
        }
        showTodos();
    });
});

deleteAllButton.addEventListener("click", () => {
    todosJson = [];
    localStorage.setItem("todos", JSON.stringify(todosJson));
    showTodos();
});

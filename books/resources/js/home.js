document.addEventListener('DOMContentLoaded', function () {
    var table = document.getElementById('dataTable');
    var form = document.getElementById('addBookForm');
    var toggleButton = document.getElementById('toggleButton')
    var containerAdd = document.getElementById('containerAdd');

    toggleButton.addEventListener('click', function () {
        form.classList.toggle('hidden');
        containerAdd.classList.toggle('border');
        if (form.classList.contains('hidden')) {
            toggleButton.innerText = 'Добавить книгу';
        } else {
            toggleButton.innerText = 'Скрыть';
        }
    });


});


//table.addEventListener('click', function (event)
function tableClick(){
    var selectedRow = event.target.closest('tr');

    if (selectedRow) {
        var columns = selectedRow.getElementsByTagName('td');
        // Установить значения в модальное окно
        document.getElementById('modalId').textContent = selectedRow.dataset.bookId;
        document.getElementById('modalGenre').textContent = columns[0].textContent;
        document.getElementById('modalBook').textContent = columns[1].textContent;
        document.getElementById('modalAuthor').textContent = columns[2].textContent;
        document.getElementById('modalPublishingHouse').textContent = columns[3].textContent;
        document.getElementById('modalYear').textContent = columns[4].textContent;
        document.getElementById('modalRating').textContent = columns[5].textContent;

        // Добавим атрибут onclick к кнопке удаления
        var deleteButton = document.getElementById('deleteButton');
        deleteButton.onclick = function () {
            deleteData(selectedRow.dataset.bookId);
        };
        // Открыть модальное окно
        openModal();
    }
}
// function authorTableClick(){
//
//     var selectedRow = event.target.closest('tr');
//
//     if (selectedRow) {
//         var columns = selectedRow.getElementsByTagName('td');
//         // Установить значения в модальное окно
//         document.getElementById('modalId').textContent = selectedRow.dataset.authorId;
//         document.getElementById('modalLname').textContent = columns[0].textContent;
//         document.getElementById('modalFname').textContent = columns[1].textContent;
//         document.getElementById('modalMname').textContent = columns[2].textContent;
//         // Добавим атрибут onclick к кнопке удаления
//         // var deleteButton = document.getElementById('deleteButton');
//         // deleteButton.onclick = function () {
//         //     deleteData(selectedRow.dataset.bookId);
//         // };
//         // Открыть модальное окно
//         openModal();
//     }
// }
function openModal() {
    document.getElementById('myModal').style.display = 'block';
}
function enableEdit() {
    document.getElementById('edit').classList.toggle('hidden');

    document.getElementById("modalGenre").innerHTML = '<input type="text" class="form-control" id="genreField" value="' +
        document.getElementById("modalGenre").textContent + '">';
    document.getElementById("modalBook").innerHTML = '<input type="text" class="form-control" id="bookField" value="' +
        document.getElementById("modalBook").textContent + '">';
    document.getElementById("modalAuthor").innerHTML = '<input type="text" class="form-control" id="authorField" value="' +
        document.getElementById("modalAuthor").textContent + '">';
    document.getElementById("modalPublishingHouse").innerHTML = '<input type="text" class="form-control" id="publishingHouseField" value="' +
        document.getElementById("modalPublishingHouse").textContent + '">';
    document.getElementById("modalYear").innerHTML = '<input type="text" class="form-control" id="yearField" value="' +
        document.getElementById("modalYear").textContent + '">';
    document.getElementById("modalRating").innerHTML = '<input type="text" class="form-control" id="ratingField" value="' +
        document.getElementById("modalRating").textContent + '">';

    var saveButton = document.createElement('button');
    saveButton.type = 'button';
    saveButton.className = 'btn btn-success';
    saveButton.textContent = 'Сохранить';
    saveButton.onclick = saveChanges;
    var modalFooter = document.querySelector('.modal-footer');

    // Добавляем кнопку "Сохранить" в конец модального футера
    modalFooter.appendChild(saveButton);
}

function closeModal() {
    if (document.getElementById('edit').classList.toggle('hidden')) {
        document.getElementById('edit').classList.toggle('hidden');
    }
    var saveButton = document.querySelector('.btn-success');

    // Скрываем или удаляем кнопку "Сохранить"
    if (saveButton) {
        // Способ 1: Скрыть кнопку
        //saveButton.style.display = 'none';
        saveButton.parentNode.removeChild(saveButton);
    }
    document.getElementById('myModal').style.display = 'none';
}

function deleteData(bookId) {
    fetch('table/deleteBook/' + bookId, {
        method: 'DELETE',
        headers: {
            'Content-Type': 'application/json',
            'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content')
        },
    })
        .then(response => {
            if (!response.ok) {
                throw new Error('Ошибка при удалении книги');
            }
            console.log('Книга успешно удалена');
        })
        .catch(error => {
            console.error('Ошибка при удалении книги:', error);
        });
}
function saveChanges() {
    document.getElementById('edit').classList.toggle('hidden');
    // Обновить текст в элементах с новыми значениями
    fetch('table/editBook/' + document.getElementById("modalId").innerHTML, {
        method: 'PATCH',
        headers: {
            'Content-Type': 'application/json',
            'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content')
        },
        body: JSON.stringify({
            genre: document.getElementById("genreField").value,
            book: document.getElementById("bookField").value,
            author: document.getElementById("authorField").value,
            publishingHouse: document.getElementById("publishingHouseField").value,
            year: document.getElementById("yearField").value,
            rating: document.getElementById("ratingField").value,
        })
    })

        .then(response => {
            if (!response.ok) {
                throw new Error('Ошибка при изменении книги');
            }
            document.getElementById("modalGenre").innerHTML = document.getElementById("genreField").value;
            document.getElementById("modalBook").innerHTML = document.getElementById("bookField").value;
            document.getElementById("modalAuthor").innerHTML = document.getElementById("authorField").value;
            document.getElementById("modalPublishingHouse").innerHTML = document.getElementById("publishingHouseField").value;
            document.getElementById("modalYear").innerHTML = document.getElementById("yearField").value;
            document.getElementById("modalRating").innerHTML = document.getElementById("ratingField").value;
            console.log('Книга успешно изменена');
           // return response.json();
        })
        // .then(data => {
        //     // Вывести данные в консоль
        //     console.log('Данные книги:', data);
        // })
        .catch(error => {
            console.error('Ошибка при изменении книги:', error);
        });
    var saveButton = document.querySelector('.btn-success');
    // удаляем кнопку "Сохранить"
    if (saveButton) {
        saveButton.parentNode.removeChild(saveButton);
    }
    closeModal();
    window.location.href = '/';
}

document.getElementById('edit').addEventListener('click', function() {
    enableEdit();
});
document.getElementById('closeModalButton').addEventListener('click', function() {
    closeModal();
});
document.getElementById('closeModalForm').addEventListener('click', function() {
    closeModal();
});
document.getElementById('deleteButton').addEventListener('click', function() {
   deleteData();
});
document.getElementById('dataTable').addEventListener('click', function() {
   tableClick();
});
// document.getElementById('dataAuthorTable').addEventListener('click', function() {
//     authorTableClick();
// });

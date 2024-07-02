$(window).on('load', function () {
    // Загружаем данные с сервера
    $.ajax({
        url: 'http://coursuch/entity/readbooks.php',
        method: 'get',
        dataType: 'json',
        success: function (response) {
            let i = 0;
            $('main').append(`<button class='create'>Создать</button><div class='all-users'></div> `);
            response.forEach(books => {
                $('.all-users').append(`<div id='books${i}' class='user-container'>
                    <div class='user-info'>
                    <br>
                    Название книги: ${books.name}<br>
                    Автор: ${books.author}<br>
                    Дата выхода: ${books.date}<br>
                    Описание: ${books.description}<br>
                    <button class='ren' id='rent${i}'>Забронировать</button><br>
                    <button class='red' id='update${i}'>Редактировать</button><br>
                    <button class='del' id='delete${i}'>Удалить</button><br> 
                `);
                $(`#rent${i}`).on('click', function () {

                    event.preventDefault(); 
                    let dataform = $(this).serialize();
                    $.ajax({
                        url: 'http://coursuch/entity/createrent.php',
                        method: 'post',
                        dataType: 'json',
                        data: dataform,
                        success: function (message) {
                            alert(message.message);
                            location.reload(true);
                        }
                    });
                })
                $(`#delete${i}`).on('click', function () {
                    $.ajax({
                        url: 'http://coursuch/entity/deletebooks.php',
                        method: 'post',
                        dataType: 'json',
                        data: {
                            'id': books.id
                        },
                        success: function (message) {
                            alert(message.message);
                            location.reload(true);
                        }
                    });
                });

                $('.create').on('click', function () {
                    $('main').empty();
                    $('main').append(`<div class='update-form'>
                                        <form id='create'>
                                            <div class='update-film-form-container'>
                                                <label>Название:</label><br>
                                                <input name='name' type='text' placeholder='Название' required><br>
                                                <label>Автор:</label><br>
                                                <input name='author' type='text' placeholder='Автор' required><br>
                                                <label>Дата выхода</label><br>
                                                <input name='date' type='text' placeholder='Дата выхода' required><br>
                                                <label>Описание</label><br>
                                                <input name='description' type='text' placeholder='Описание' required><br>
                                                <button type='submit'>Добавить книгу</button>
                                                <button class='back'>Назад</button>
                                            </div>
                                        </form>
                                    </div>`);
                    $('.back').on('click', function () {
                        location.reload(true);
                    });
                    $('#create').on('submit', function (event) {
                        event.preventDefault();
                        let dataform = $(this).serialize();

                        $.ajax({
                            url: 'http://coursuch/entity/createbooks.php',
                            method: 'post',
                            dataType: 'json',
                            data: dataform,
                            success: function (message) {
                                alert(message.message);
                                location.reload(true);
                            }
                        });
                    });
                });

                $(`#update${i}`).on('click', function () {
                    $('main').empty();
                    $('main').append(`<div class='update-form'>
                                        <form id='update-film-form'>
                                            <div class='update-film-form-container'>
                                                <input name='id' type="hidden" value="${books.id}">
                                                <label>Название:</label><br>
                                                <input name='name' type='text' placeholder='Название' value='${books.name}'><br>
                                                <label>Автор:</label><br>
                                                <input name='author' type='text' placeholder='Автор' value='${books.author}'><br>
                                                <label>Год выпуска:</label><br>
                                                <input name='date' type='text' placeholder='Год выпуска' value='${books.date}'><br>
                                                <label>Описание:</label><br>
                                                <input name='description' type='text' placeholder='Описание' value='${books.description}'><br>
                                                <button type='submit'>Сохранить изменения</button>
                                                <button class='back'>Назад</button>
                                            </div>
                                        </form>
                                    </div>`);
                    $('.back').on('click', function () {
                        location.reload(true)
                    });
                    $('#update-film-form').on('submit', function (event) {
                        event.preventDefault();
                        let dataform = $(this).serialize();

                        $.ajax({
                            url: 'http://coursuch/entity/updatebooks.php',
                            method: 'post',
                            dataType: 'json',
                            data: dataform,
                            success: function (message) {
                                alert(message.message);
                                location.reload(true);
                            }
                        });
                    });
                });

                i++;
            });
        }
    });
});

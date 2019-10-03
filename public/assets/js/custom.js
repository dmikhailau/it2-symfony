
waitForScriptsToBeReady();

// отправить запрос с типом json
// выбрать все фильмы и отдать json в ответ
// обработать ответ и вывести фильмы

function waitForScriptsToBeReady() {

    if(!$) {
        return setTimeout(waitForScriptsToBeReady, 100);
    }

    $(document).ready(function() {
        $('#getFilms').click(function () {
            console.log('click');

            $.ajax({
                url: '/api/films/list',
                dataType: 'json',
                }).done(function (dataFromServer) {
                    console.log(dataFromServer);
                   //1 получить данные ! из базы или из файла ! file_get_contents
                   // преобразовать данные в массив
                   // передать данные в виде json   return new JsonResponse
                   //TODO построить табилцу или блоки для вывода фильмов
                });

            $.get('/api/films/list', function(dataFromServer){
                console.log(dataFromServer);
            }, "json");

        });


    });

}
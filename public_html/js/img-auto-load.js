$(document).ready(function () {
  $("#imgLoad").hide(); // Скрываем прелоадер
});

let num = 3; //чтобы знать с какой записи вытаскивать данные

$(function () {
  $("#load div").click(function () { // Выполняем если по кнопке кликнули

    $("#imgLoad").show(); // Показываем прелоадер

    $.ajax({
      url: "../main/action.php", // Обработчик
      type: "GET",       // Отправляем методом GET
      data: {"num": num},
      cache: false,
      success: function (response) {
        if (response == 0) { // Смотрим ответ от сервера и выполняем соответствующее действие
          alert("Больше нет записей");
          $("#imgLoad").hide();
        } else {
          $("#content").append(response);
          num = num + 3;
          $("#imgLoad").hide();
        }
      }
    });
  });
});

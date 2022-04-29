/*!
 * Start Bootstrap - SB Admin v7.0.4 (https://startbootstrap.com/template/sb-admin)
 * Copyright 2013-2021 Start Bootstrap
 * Licensed under MIT (https://github.com/StartBootstrap/startbootstrap-sb-admin/blob/master/LICENSE)
 */
//
// Scripts
// handle notification
$(document).ready(function () {
  // if txt book id is empty all input tab will clear
  $("#form_txtbookid").keyup(function () {
    if ($("#form_txtbookid").val() == "") {
      $("#booktitle").val("");
      // author name
      $("#authorname").val("");
      // publisher
      $("#publisher").val("");
      // year
      $("#year").val("");
      // month
      $("#month").val("");
      // day
      $("#day").val("");
      $("#bookimage").attr("src", "");
      $("#form_book_img").val("");
    }
  });
});
function showToast(message, type) {
  setTimeout(function () {
    $("#errormessage").fadeOut("fast");
  }, 3000); // <-- time in milliseconds

  // handle Notification
  var option = {
    animation: true,
    autohide: true,
    delay: 2000,
  };

  if (type == "error") {
    var Notification = $("#toastNotificationError");
    $("#toast-mess-error").text(message);
  }
  if (type == "success") {
    var Notification = $("#toastNotificationSuccess");
    $("#toast-mess-success").text(message);
  }

  var bsNotification = new bootstrap.Toast(Notification, option);
  bsNotification.show();
}

// sidebar event handle template
$(window).on("DOMContentLoaded", (event) => {
  // Toggle the side navigation
  const sidebarToggle = document.getElementById("sidebarToggle"); //$("#sidebarToggle");
  if (sidebarToggle) {
    sidebarToggle.addEventListener("click", (event) => {
      event.preventDefault();
      document.body.classList.toggle("sb-sidenav-toggled");
      localStorage.setItem(
        "sb|sidebar-toggle",
        document.body.classList.contains("sb-sidenav-toggled")
      );
    });
  }
});

//---------------------------------handle mtbooks-----------------------------------------
function showError(key, mess) {
  return $("#err_" + key).html(mess);
}

function getValueById(id) {
  return $.trim($(`#${id}`).val());
}

function checkYear(year) {
  if (!Number.isInteger(Number(year)) || Number(year) < 0) {
    return false;
  } else {
    return true;
  }
}

function checkMonth(month) {
  if (
    !Number.isInteger(Number(month)) ||
    Number(month) < 1 ||
    Number(month) > 12
  ) {
    return false;
  } else {
    return true;
  }
}

function checkLeapYear(year) {
  if (Number(year) % 400 == 0) return true;
  if (Number(year) % 4 == 0 && Number(year) % 100 != 0) return true;
  return false;
}

function checkDay(day, month, year) {
  if (!Number.isInteger(Number(day)) || Number(day) < 1 || Number(day) > 31) {
    return false;
  } else {
    var month30 = [4, 6, 9, 11];
    if (month30.indexOf(Number(month)) != -1) {
      // if month have 30 day
      if (Number(day) > 30) {
        return false;
      }
    } else if (Number(month) == 2) {
      if (!checkLeapYear(year)) {
        if (Number(day) > 28) {
          return false;
        }
      } else {
        if (Number(day) > 29) {
          return false;
        }
      }
    }
  }
  return true;
}

function handleAdd() {
  // validate
  var flag = true;
  // book id
  var bookid = getValueById("form_txtbookid");
  // book title
  var booktitle = getValueById("booktitle");
  // author name
  var authorname = getValueById("authorname");
  // publisher
  var publisher = getValueById("publisher");
  // year
  var year = getValueById("year");
  // month
  var month = getValueById("month");
  // day
  var day = getValueById("day");

  // reset Notification
  showError("bookid", "");
  showError("booktitle", "");
  showError("authorname", "");
  showError("publisher", "");
  showError("year", "");
  showError("month", "");
  showError("day", "");

  // check book id
  if (bookid == "") {
    flag = false;
    showError("bookid", "本IDを入力してください。"); //MSG 01
  } else if (bookid.length > 4) {
    flag = false;
    showError("bookid", "本IDは半角英数字で入力してください。"); //MSG 02
  }

  //check book title
  if (booktitle == "") {
    flag = false;
    showError("booktitle", "本タイトルを入力してください。"); //MSG 06
  }

  // check author name
  if (authorname == "") {
    flag = false;
    showError("authorname", "著者名を入力してください。"); //MSG 07
  }

  // check publisher
  if (publisher == "") {
    flag = false;
    showError("publisher", "出版社を入力してください。"); //MSG 08
  }

  //check empty date
  if (year == "") {
    flag = false;
    showError("year", "出版年月日を入力してください。"); //MSG 09
  } else if (!checkYear(year)) {
    flag = false;
    showError("year", "出版年月日は半角数字で入力してください。"); //MSG 10
  }

  if (month == "") {
    flag = false;
    showError("month", "出版年月日を入力してください。"); //MSG 09
  } else if (!checkMonth(month)) {
    flag = false;
    showError("month", "出版年月日は半角数字で入力してください。"); //MSG 10
  }

  if (day == "") {
    flag = false;
    showError("day", "出版年月日を入力してください。"); //MSG 09
  } else if (!checkDay(day, month, year)) {
    flag = false;
    showError("day", "出版年月日は半角数字で入力してください。"); //MSG 10
  }
  if (flag == true) {
    //========================================= handle with ajax ==========================================
    var formData = new FormData();
    var files = $("#form_book_img")[0].files;
    var checkFile = "true";
    if (files.length == 0) {
      checkFile = "false";
    }
    formData.append("checkFile", checkFile);
    if (checkFile == "true") {
      formData.append("files", files[0]);
    }
    var bookId = $("#form_txtbookid").val();
    var booktitle = $("#booktitle").val();
    var authorname = $("#authorname").val();
    var publisher = $("#publisher").val();
    var year = $("#year").val();
    var month = $("#month").val();
    var day = $("#day").val();
    formData.append("bookId", bookId);
    formData.append("booktitle", booktitle);
    formData.append("authorname", authorname);
    formData.append("publisher", publisher);
    formData.append("year", year);
    formData.append("month", month);
    formData.append("day", day);
    $.ajax({
      url: "/masterbook/create",
      type: "POST",
      data: formData,
      contentType: false,
      processData: false,

      success: function (response) {
        var decode = JSON.parse(response);
        if (decode.error_mess) {
          showToast(decode.error_mess, "error");
        } else {
          showToast(decode.success_mess, "success");
          var mtbook = decode.mtbook;
          $("#form_txtbookid").val(mtbook?.id);
          $("#booktitle").val(mtbook?.book_title);
          $("#authorname").val(mtbook?.author_name);
          $("#publisher").val(mtbook?.publisher);
          $("#bookimage").attr("src", "/assets/img/" + mtbook?.book_img);
          var publication_day = new Date(mtbook?.publication_day);
          var year = publication_day.getFullYear();
          var month = publication_day.getMonth() + 1;
          var day = publication_day.getDate();
          $("#year").val(year);
          $("#month").val(month);
          $("#day").val(day);
        }
      },
      error: function (xhr, textStatus, errorThrown) {
        showToast("Ajax request failed.", "error");
      },
    });
  }
  return false;
}

function handleUpdate() {
  // validate
  var flag = true;
  // book id
  var bookid = getValueById("form_txtbookid");
  // book title
  var booktitle = getValueById("booktitle");
  // author name
  var authorname = getValueById("authorname");
  // publisher
  var publisher = getValueById("publisher");
  // year
  var year = getValueById("year");
  // month
  var month = getValueById("month");
  // day
  var day = getValueById("day");

  // reset Notification
  showError("bookid", "");
  showError("booktitle", "");
  showError("authorname", "");
  showError("publisher", "");
  showError("year", "");
  showError("month", "");
  showError("day", "");
  // check book id
  if (bookid == "") {
    flag = false;
    showError("bookid", "本IDを入力してください。"); // MSG 01
  } else if (bookid.length > 4) {
    flag = false;
    showError("bookid", "本IDは半角英数字で入力してください。"); // MSG 02
  }
  //check book title
  if (booktitle == "") {
    flag = false;
    showError("booktitle", "本タイトルを入力してください。"); // MSG 06
  }

  // check author name
  if (authorname == "") {
    flag = false;
    showError("authorname", "著者名を入力してください。"); // MSG 07
  }

  // check publisher
  if (publisher == "") {
    flag = false;
    showError("publisher", "出版社を入力してください。"); // MSG 08
  }

  //check empty date
  if (year == "") {
    flag = false;
    showError("year", "出版年月日を入力してください。"); // MSG 09
  } else if (!checkYear(year)) {
    flag = false;
    showError("year", "出版年月日は半角数字で入力してください。"); //MSG 10
  }

  if (month == "") {
    flag = false;
    showError("month", "出版年月日を入力してください。"); // MSG 09
  } else if (!checkMonth(month)) {
    flag = false;
    showError("month", "出版年月日は半角数字で入力してください。"); // MSG 10
  }

  if (day == "") {
    flag = false;
    showError("day", "出版年月日を入力してください。"); // MSG 09
  } else if (!checkDay(day, month, year)) {
    flag = false;
    showError("day", "出版年月日は半角数字で入力してください。"); // MSG 10
  }
  if (flag) {
    //========================================= handle with ajax ==========================================
    var formData = new FormData();
    var files = $("#form_book_img")[0].files;

    var checkFile = "true";
    if (files.length == 0) {
      checkFile = "false";
    }
    formData.append("checkFile", checkFile);
    if (checkFile == "true") {
      formData.append("files", files[0]);
    }
    var bookId = $("#form_txtbookid").val();
    var booktitle = $("#booktitle").val();
    var authorname = $("#authorname").val();
    var publisher = $("#publisher").val();
    var year = $("#year").val();
    var month = $("#month").val();
    var day = $("#day").val();
    formData.append("bookId", bookId);
    formData.append("booktitle", booktitle);
    formData.append("authorname", authorname);
    formData.append("publisher", publisher);
    formData.append("year", year);
    formData.append("month", month);
    formData.append("day", day);
    $.ajax({
      url: "/masterbook/update",
      type: "POST",
      data: formData,
      contentType: false,
      processData: false,

      success: function (response) {
        var decode = JSON.parse(response);
        if (decode.error_mess) {
          showToast(decode.error_mess, "error");
        } else {
          showToast(decode.success_mess, "success");
          var mtbook = decode.mtbook;
          $("#form_txtbookid").val(mtbook?.id);
          $("#booktitle").val(mtbook?.book_title);
          $("#authorname").val(mtbook?.author_name);
          $("#publisher").val(mtbook?.publisher);
          $("#bookimage").attr("src", "/assets/img/" + mtbook?.book_img);
          var publication_day = new Date(mtbook?.publication_day);
          var year = publication_day.getFullYear();
          var month = publication_day.getMonth() + 1;
          var day = publication_day.getDate();
          $("#year").val(year);
          $("#month").val(month);
          $("#day").val(day);
        }
      },
      error: function () {
        showToast("Ajax request failed.", "error");
      },
    });
  }
  return false;
}

function handleFind() {
  var bookid = getValueById("form_txtbookid");
  if (bookid == "") {
    showToast("本IDを入力してください。", "error"); // MSG 01
    return false;
  } else if (bookid.length != 4) {
    showToast("本IDは半角英数字で入力してください。", "error"); // MSG 02
    return false;
  }
  var formData = new FormData();
  var bookId = $("#form_txtbookid").val();
  formData.append("bookId", bookId);
  $.ajax({
    url: "/masterbook/find",
    type: "POST",
    data: formData,
    contentType: false,
    processData: false,

    success: function (response) {
      var decode = JSON.parse(response);
      if (decode.error_mess) {
        showToast(decode.error_mess, "error");
      } else {
        var mtbook = decode.mtbook;
        $("#form_txtbookid").val(mtbook?.id);
        $("#booktitle").val(mtbook?.book_title);
        $("#authorname").val(mtbook?.author_name);
        $("#publisher").val(mtbook?.publisher);
        $("#bookimage").attr("src", "/assets/img/" + mtbook?.book_img);
        var publication_day = new Date(mtbook?.publication_day);
        var year = publication_day.getFullYear();
        var month = publication_day.getMonth() + 1;
        var day = publication_day.getDate();
        $("#year").val(year);
        $("#month").val(month);
        $("#day").val(day);
        showToast(decode.success_mess, "success");
      }
    },
    error: function (xhr, textStatus, errorThrown) {
      showToast("Ajax request failed.", "error");
    },
  });
  return false;
}

function handleDelete() {
  // validate
  var flag = true;
  var bookid = getValueById("form_txtbookid");
  if (bookid == "") {
    showToast("本IDを入力してください。", "error"); // MSG 01
    flag = false;
  } else if (bookid.length != 4) {
    showToast("本IDは半角英数字で入力してください。", "error"); // MSG 02
    flag = false;
  }

  if (flag) {
    var formData = new FormData();
    var bookId = $("#form_txtbookid").val();
    formData.append("bookId", bookId);
    $.ajax({
      url: "/masterbook/delete",
      type: "POST",
      data: formData,
      contentType: false,
      processData: false,

      success: function (response) {
        var decode = JSON.parse(response);
        if (decode.error_mess) {
          showToast(decode.error_mess, "error");
        } else {
          $("#form_txtbookid").val("");
          $("#booktitle").val("");
          $("#authorname").val("");
          $("#publisher").val("");
          $("#bookimage").attr("src", "");
          $("#year").val("");
          $("#month").val("");
          $("#day").val("");
          $("#form_book_img").val("");
          showToast(decode.success_mess, "success");
        }
      },
      error: function (xhr, textStatus, errorThrown) {
        showToast("Ajax request failed.", "error");
      },
    });
  }
  return false;
}
function handleclear() {
  // book id
  $("#form_txtbookid").val("");
  // book title
  $("#booktitle").val("");
  // author name
  $("#authorname").val("");
  // publisher
  $("#publisher").val("");
  // year
  $("#year").val("");
  // month
  $("#month").val("");
  // day
  $("#day").val("");
  return false;
}

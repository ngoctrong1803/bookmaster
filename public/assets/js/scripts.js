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
    var Notification = document.getElementById("toastNotificationError");
    document.getElementById("toast-mess-error").textContent = message;
  }
  if (type == "success") {
    var Notification = document.getElementById("toastNotificationSuccess");
    document.getElementById("toast-mess-success").textContent = message;
  }

  var bsNotification = new bootstrap.Toast(Notification, option);
  bsNotification.show();
}

// sidebar evetn
window.addEventListener("DOMContentLoaded", (event) => {
  // Toggle the side navigation
  const sidebarToggle = document.body.querySelector("#sidebarToggle");
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
  return (document.getElementById("err_" + key).innerHTML = mess);
}

function getValueById(id) {
  return document.getElementById(id).value.trim();
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
  var bookid = document.getElementById("form_txtbookid").value;

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
    let formData = new FormData();
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
    console.log("form data:", formData);
    $.ajax({
      url: "/masterbook/create",
      type: "POST",
      data: formData,
      contentType: false,
      processData: false,

      success: function (response) {
        let decode = JSON.parse(response);
        if (decode.error_mess) {
          showToast(decode.error_mess, "error");
        } else {
          showToast(decode.success_mess, "success");
          let mtbook = decode.mtbook;
          $("#form_txtbookid").val(mtbook?.id);
          $("#booktitle").val(mtbook?.book_title);
          $("#authorname").val(mtbook?.author_name);
          $("#publisher").val(mtbook?.publisher);
          $("#bookimage").attr("src", "data:image;base64," + mtbook?.book_img);
          let publication_day = new Date(mtbook?.publication_day);
          let year = publication_day.getFullYear();
          let month = publication_day.getMonth() + 1;
          let day = publication_day.getDate();
          $("#year").val(year);
          $("#month").val(month);
          $("#day").val(day);
        }
      },
      error: function (xhr, textStatus, errorThrown) {
        alert("Ajax request failed.");
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
    let formData = new FormData();
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
    console.log("form data:", formData);
    $.ajax({
      url: "/masterbook/update",
      type: "POST",
      data: formData,
      contentType: false,
      processData: false,

      success: function (response) {
        let decode = JSON.parse(response);
        console.log("ajax update:", decode);
        if (decode.error_mess) {
          showToast(decode.error_mess, "error");
        } else {
          showToast(decode.success_mess, "success");
          let mtbook = decode.mtbook;
          $("#form_txtbookid").val(mtbook?.id);
          $("#booktitle").val(mtbook?.book_title);
          $("#authorname").val(mtbook?.author_name);
          $("#publisher").val(mtbook?.publisher);
          $("#bookimage").attr("src", "data:image;base64," + mtbook?.book_img);
          let publication_day = new Date(mtbook?.publication_day);
          let year = publication_day.getFullYear();
          let month = publication_day.getMonth() + 1;
          let day = publication_day.getDate();
          $("#year").val(year);
          $("#month").val(month);
          $("#day").val(day);
        }
      },
      error: function () {
        alert("Ajax request failed.");
      },
    });
  }
  return false;
}

function handleFind() {
  var bookid = getValueById("form_txtbookid");
  if (bookid == "") {
    alert("本IDを入力してください。"); // MSG 01
    return false;
  } else if (bookid.length != 4) {
    alert("本IDは半角英数字で入力してください。"); // MSG 02
    return false;
  }
  let formData = new FormData();
  var bookId = $("#form_txtbookid").val();
  formData.append("bookId", bookId);
  $.ajax({
    url: "/masterbook/find",
    type: "POST",
    data: formData,
    contentType: false,
    processData: false,

    success: function (response) {
      let decode = JSON.parse(response);
      if (decode.error_mess) {
        showToast(decode.error_mess, "error");
      } else {
        let mtbook = decode.mtbook;
        $("#form_txtbookid").val(mtbook?.id);
        $("#booktitle").val(mtbook?.book_title);
        $("#authorname").val(mtbook?.author_name);
        $("#publisher").val(mtbook?.publisher);
        $("#bookimage").attr("src", "data:image;base64," + mtbook?.book_img);
        let publication_day = new Date(mtbook?.publication_day);
        let year = publication_day.getFullYear();
        let month = publication_day.getMonth() + 1;
        let day = publication_day.getDate();
        $("#year").val(year);
        $("#month").val(month);
        $("#day").val(day);
        showToast(decode.success_mess, "success");
      }
    },
    error: function (xhr, textStatus, errorThrown) {
      alert("Ajax request failed.");
    },
  });
  return false;
}

function handleDelete() {
  // validate
  var flag = true;
  var bookid = getValueById("form_txtbookid");
  if (bookid == "") {
    alert("本IDを入力してください。"); // MSG 01
    flag = false;
  } else if (bookid.length != 4) {
    alert("本IDは半角英数字で入力してください。"); // MSG 02
    flag = false;
  }

  let formData = new FormData();
  var bookId = $("#form_txtbookid").val();
  formData.append("bookId", bookId);
  $.ajax({
    url: "/masterbook/delete",
    type: "POST",
    data: formData,
    contentType: false,
    processData: false,

    success: function (response) {
      let decode = JSON.parse(response);
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
        $("#day").val("day");
        showToast(decode.success_mess, "success");
      }
    },
    error: function (xhr, textStatus, errorThrown) {
      alert("Ajax request failed.");
    },
  });
  //   return flag;
  return false;
}
function handleclear() {
  // book id
  document.getElementById("form_txtbookid").value = "";
  // book title
  document.getElementById("booktitle").value = "";
  // author name
  document.getElementById("authorname").value = "";
  // publisher
  document.getElementById("publisher").value = "";
  // year
  document.getElementById("year").value = "";
  // month
  document.getElementById("month").value = "";
  // day
  document.getElementById("day").value = "";
  return false;
}

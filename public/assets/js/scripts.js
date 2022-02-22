/*!
    * Start Bootstrap - SB Admin v7.0.4 (https://startbootstrap.com/template/sb-admin)
    * Copyright 2013-2021 Start Bootstrap
    * Licensed under MIT (https://github.com/StartBootstrap/startbootstrap-sb-admin/blob/master/LICENSE)
    */
    // 
// Scripts
    // handle notification 
    $(document).ready(function() {

        // hide error message
        setTimeout(function() {
            $('#errormessage').fadeOut('fast');
        }, 3000); // <-- time in milliseconds

        // handle Notification
        var option={
            animation: true,
            autohide: true, 
            delay: 2000
        }

        var Notification = document.getElementById('toastNotification'); // select id of toast
        var bsNotification = new bootstrap.Toast(Notification, option);
        bsNotification.show();  
    });

    // sidebar evetn
    window.addEventListener('DOMContentLoaded', event => {
        // Toggle the side navigation
        const sidebarToggle = document.body.querySelector('#sidebarToggle');
        if (sidebarToggle) {
            sidebarToggle.addEventListener('click', event => {
                event.preventDefault();
                document.body.classList.toggle('sb-sidenav-toggled');
                localStorage.setItem('sb|sidebar-toggle', document.body.classList.contains('sb-sidenav-toggled'));
            });
        }

    });

    //---------------------------------handle mtbooks-----------------------------------------
    function showError(key, mess){
        return document.getElementById('err_' + key).innerHTML = mess;
    }

    function getValueById(id){
        return document.getElementById(id).value.trim();
    }

    function checkYear(year){
        if (!(Number.isInteger(Number(year))) || Number(year)< 0){
            return false;
        }else{
            return true;
        }
    }

    function checkMonth(month){
        if (!(Number.isInteger(Number(month))) || Number(month)< 1 || Number(month)> 12){
            return false;
        }else{
            return true;
        }

    }

    function checkLeapYear(year){
        if (Number(year) % 400 == 0) 
            return true; 
        if (Number(year) % 4 == 0 && Number(year) % 100 != 0) 
            return true;
        return false; 

    }

    function checkDay(day, month, year){
        if (!(Number.isInteger(Number(day))) || Number(day)< 1 || Number(day)> 31){
            return false;
        }else{   
            var month30= [4, 6, 9, 11];
            if(month30.indexOf(Number(month)) != -1){
                // if month have 30 day
                if(Number(day)> 30){
                    return false;
                }
            }else if(Number(month) == 2){
                if(!checkLeapYear(year)){
                    if(Number(day)> 28){
                    return false;
                    }
                }else{
                    if(Number(day)> 29){
                    return false;
                    }
                }
            }


        }
        return true;
    }

    function handleAdd(){
        //change action
            const formAdd = document.getElementById('crud_form');
            formAdd.action = "/posts/create";

        // validate
            var flag = true;
            // book id
            //var bookid= document.getElementById("form_txtbookid").value;

            var bookid= getValueById("form_txtbookid");
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
            if(bookid == ''){
                flag = false;
                showError("bookid", "本IDを入力してください。"); //MSG 01
            }
            else if(bookid.length > 4){
                flag = false;
                showError("bookid", "本IDは半角英数字で入力してください。"); //MSG 02
            }

            //check book title
            if(booktitle == ''){
                flag = false;
                showError("booktitle", "本タイトルを入力してください。"); //MSG 06
            }

            // check author name
            if(authorname == ''){
                flag = false;
                showError("authorname", "著者名を入力してください。"); //MSG 07
            }

            // check publisher
            if(publisher == ''){
                flag = false;
                showError("publisher", "出版社を入力してください。"); //MSG 08
            }

            //check empty date
            if(year == ''){
                flag = false;
                showError("year", "出版年月日を入力してください。"); //MSG 09
            }else if (!checkYear(year)){
                flag = false;
                showError("year", "出版年月日は半角数字で入力してください。");//MSG 10
            }

            if(month == ''){
                flag = false;
                showError("month", "出版年月日を入力してください。"); //MSG 09
            }else if (!checkMonth(month)){
                flag = false;
                showError("month", "出版年月日は半角数字で入力してください。");//MSG 10
            }

            if(day == ''){
                flag = false;
                showError("day", "出版年月日を入力してください。");//MSG 09
            }else if (!checkDay(day, month, year)){
                flag = false;
                showError("day", "出版年月日は半角数字で入力してください。");//MSG 10
            }
        return flag;
        
    }

    function handleUpdate(){
        // change action
            const formAdd = document.getElementById('crud_form');
            formAdd.action = "/posts/update";
        // validate
            var flag = true;
            // book id
            var bookid= getValueById("form_txtbookid");
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
            if(bookid == ''){
                flag = false;
                showError("bookid", "本IDを入力してください。"); // MSG 01
            }
            else if(bookid.length > 4){
                flag = false;
                showError("bookid", "本IDは半角英数字で入力してください。"); // MSG 02
            }
            //check book title
            if(booktitle == ''){
                flag = false;
                showError("booktitle", "本タイトルを入力してください。"); // MSG 06
            }

            // check author name
            if(authorname == ''){
                flag = false;
                showError("authorname", "著者名を入力してください。"); // MSG 07
            }

            // check publisher
            if(publisher == ''){
                flag = false;
                showError("publisher", "出版社を入力してください。"); // MSG 08
            }

            //check empty date
            if(year == ''){
                flag = false;
                showError("year", "出版年月日を入力してください。"); // MSG 09
            }else if (!checkYear(year)){
                flag = false;
                showError("year", "出版年月日は半角数字で入力してください。"); //MSG 10
            }

            if(month == ''){
                flag = false;
                showError("month", "出版年月日を入力してください。"); // MSG 09
            }else if (!checkMonth(month)){
                flag = false;
                showError("month", "出版年月日は半角数字で入力してください。"); // MSG 10
            }

            if(day == ''){
                flag = false;
                showError("day", "出版年月日を入力してください。"); // MSG 09
            }else if (!checkDay(day, month, year)){
                flag = false;
                showError("day", "出版年月日は半角数字で入力してください。"); // MSG 10
            }     
        return flag;

    }

    function handleFind(){
        const formAdd = document.getElementById('crud_form');
        formAdd.action = "/posts/find";
        var flag = true;
        var bookid= getValueById("form_txtbookid");
        if(bookid == ""){
            alert("本IDを入力してください。"); // MSG 01
            flag = false;
        }
        else if(bookid.length != 4 ){
            alert("本IDは半角英数字で入力してください。"); // MSG 02
            flag = false;
        }
        return flag;
    }

    function handleDelete(){
        // change action
            const formAdd = document.getElementById('crud_form');
            formAdd.action = "/posts/delete";
        // validate
        var flag = true;
        var bookid= getValueById("form_txtbookid");
        if(bookid == ""){
            alert("本IDを入力してください。"); // MSG 01
            flag = false;
        }
        else if(bookid.length != 4 ){
            alert("本IDは半角英数字で入力してください。"); // MSG 02
            flag = false;
        }
        return flag;

    }
    function handleclear(){
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



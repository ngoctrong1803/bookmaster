       
        <div class="container" style="margin-top: 20px">
        <div class="row">
            <div class="col-8">
            <!--form CURD book-->
            <?= Form::open(array('action'=>'posts/CRUD', 'method'=>'post'));?>
            <div class="row g-3">
                <div
                    style="
                        width: 100%;
                        height: 100px;
                        background-color: rgb(247, 247, 247);
                    ">
                    <div class="row">
                        <div class="col">
                            <h1>本マスタメンテ</h1>
                        </div>
                        <div class="col" style="text-align: end">
                            <a href="#">閉じる</a>
                        </div>
                    </div>
                </div>
                <div style="display: flex; align-items: flex-end;">
                        <div class="col-md-6">
                            <?= Form::label("本ID：", "title");?>
                                <?php if(isset($mtbook)== false){?>
                                    <?= Form::input('txtbookid', '', array('class' => 'form-control'));?>
                                <?php }else {?>
                                    <?= Form::input('txtbookid', $mtbook->id, array('class' => 'form-control'));?>
                                <?php }?>
                              
                        </div>
                        <div
                            class="col-md-6"
                            style="display: flex; align-items: flex-end"
                        >
                            <?= Form::button('find', '検索', array("value" => "btnfind",'id' => 'btnfind','type' => 'submit', 'class' => 'btn btn-secondary',  'style'=> 'margin-left:15px'));?>
                        </div> 
                </div>
                <span style="color: red;" id="err_bookid"></span>
                    
               

                <!--handle attribute of book-->
                <?php if(isset($mtbook)== false){?>
                    <!--if book was not found or index page-->
                        <!--attribute of book-->
                        <div class="col-12">
                            <label for="booktitle" class="form-label"
                                >本タイトル：(Title)</label
                            >
                            <input
                                type="text"
                                name="txtbooktitle"
                                class="form-control"
                                id="booktitle"
                                placeholder="" 
                            />
                            <span style="color: red;" id="err_booktitle"></span>
                         
                        </div>
                        <div class="col-12">
                            <label for="authorname" class="form-label"
                                >著者名：(Authorname)</label
                            >
                            <input
                                type="text"
                                name="txtauthorname"
                                class="form-control"
                                id="authorname"
                                placeholder=""
                            />
                            <span style="color: red;" id="err_authorname"></span>
                        </div>
                        <div class="col-12">
                            <label for="publisher" class="form-label"
                                >出版社：</label
                            >
                            <input
                                type="text"
                                name="txtpublisher"
                                class="form-control"
                                id="publisher"
                                placeholder=""
                            />
                            <span style="color: red;" id="err_publisher"></span>
                        </div>
                        <label for="insert_day" class="form-label">出版年月日：</label>
                        <div class="public_day" style="display:flex;">
                            <div class="year">
                                    <div
                                        class="col-md-11"
                                        style="display: flex; align-items: center"
                                    >
                                        <input type="text" class="form-control" id="year" name="txtyear"/>
                                        <label style="display: block; margin-left: 7px"> 年</label>
                                    </div>
                                    <span style="color: red;" id="err_year"></span>
                                </div>
                            <div class="month">
                                    <div
                                        class="col-md-11"
                                        style="display: flex; align-items: center"
                                    >
                                        <input type="text" class="form-control" id="month" name="txtmonth"/>
                                        <label style="display: block; margin-left: 7px"> 月</label>
                                    </div>
                                    <span style="color: red;" id="err_month"></span>
                                </div>
                            <div class="day">
                                    <div
                                        class="col-md-11"
                                        style="display: flex; align-items: center"
                                    >
                                        <input type="text" class="form-control" id="day" name="txtday"/>
                                        <label style="display: block; margin-left: 7px"> 日</label>
                                    </div>
                                    <span style="color: red;" id="err_day"></span>
                            </div>
                        </div>
             
                        <!--attribute of book-->
                    
                <?php }else {?>
                    <!--if found the book-->
                         <!--attribute of book-->
                         <div class="col-12">
                            <label for="booktitle" class="form-label"
                                >本タイトル：(Title)</label
                            >
                            <input  type="text"
                                class="form-control"
                                id="booktitle"
                                name="txtbooktitle"
                                placeholder=""
                                value=  '<?php echo $mtbook-> book_title?>' 
                                >
                            </input>
                            <span style="color: red;" id="err_booktitle"></span>
                        </div>
                        <div class="col-12">
                            <label for="authorname" class="form-label"
                                >著者名：(Authorname)</label
                            >
                            <input
                                type="text"
                                class="form-control"
                                id="authorname"
                                name="txtauthorname"
                                placeholder=""
                                value=  '<?php echo $mtbook-> author_name?>' 
                            />
                            <span style="color: red;" id="err_authorname"></span>
                        </div>
                        <div class="col-12">
                            <label for="publisher" class="form-label"
                                >出版社：(Publisher)</label
                            >
                            <input
                                type="text"
                                class="form-control"
                                id="publisher"
                                name="txtpublisher"
                                placeholder=""
                                value=  '<?php echo $mtbook-> publisher?>' 
                            />
                            <span style="color: red;" id="err_publisher"></span>
                        </div>
                        <label for="insert_day" class="form-label">出版年月日：(Publication day)</label>
                        <?php $publicaionDay=  strtotime($mtbook->publication_day)?>
                        <div class="public_day" style="display:flex;">
                            <div class="year">
                                    <div
                                        class="col-md-11"
                                        style="display: flex; align-items: center"
                                    >
                                        <input type="text" class="form-control" id="year" name="txtyear" value=  '<?php echo date("Y",$publicaionDay)?>' />
                                        <label style="display: block; margin-left: 7px"> 年</label>
                                    </div>
                                    <span style="color: red;" id="err_year"></span>
                                </div>
                            <div class="month">
                                    <div
                                        class="col-md-11"
                                        style="display: flex; align-items: center"
                                    >
                                        <input type="text" class="form-control" id="month" name="txtmonth" value=  '<?php echo date("m",$publicaionDay)?>'/>
                                        <label style="display: block; margin-left: 7px"> 月</label>
                                    </div>
                                    <span style="color: red;" id="err_month"></span>
                                </div>
                            <div class="day">
                                    <div
                                        class="col-md-11"
                                        style="display: flex; align-items: center"
                                    >
                                        <input type="text" class="form-control" id="day" name="txtday"  value=  '<?php echo date("d",$publicaionDay)?>' />
                                        <label style="display: block; margin-left: 7px"> 日</label>
                                    </div>
                                    <span style="color: red;" id="err_day"></span>
                            </div>
                        </div>
                        <!-------------------------------------------------------------->
                        <!--attribute of book-->
                    
                <?php }?>
                <!--handle attribute of book-->

               


                <div class="col-12" style="display: flex">
                    <div class="col-4"></div>
                    <div
                        class="col-8"
                        style="display: flex; justify-content: flex-end"
                    >
                        <!-- <button
                            style="margin-left: 15px"
                            type="submit"
                            class="btn btn-secondary"
                        >
                            追加(Add)
                        </button> -->
                        <?= Form::button('add', '追加(Add)', array("onclick"=>"return validateFind()", "value" => "btnadd';" ,'id' => 'btnadd','type' => 'submit', 'class' => 'btn btn-secondary',  'style'=> 'margin-left:15px'));?>
                        <!-- <button
                            style="margin-left: 15px"
                            type="submit"
                            class="btn btn-secondary"
                        >
                            更新(Update)
                        </button> -->
                        <?= Form::button('update', '更新(Update)', array("onclick"=>"return validateUpdate()", "value" => "btnupdate';" ,'id' => 'btnupdate','type' => 'submit', 'class' => 'btn btn-secondary',  'style'=> 'margin-left:15px'));?>
                        <!-- <button
                            style="margin-left: 15px"
                            type="submit"
                            class="btn btn-secondary"
                        >
                            削除(Delete)
                        </button> -->
                        <?= Form::button('delete', '検索(Delete)', array("value" => "btndelete';" ,'id' => 'btndelete','type' => 'submit', 'class' => 'btn btn-secondary',  'style'=> 'margin-left:15px'));?>
                        <!-- <button
                            style="margin-left: 15px"
                            type="submit"
                            class="btn btn-secondary"
                        >
                            クリア(Clear)
                        </button> -->
                        <?= Form::button('clear', 'クリア(Clear)', array("value" => "btnclear';" ,'id' => 'btnclear','type' => 'submit', 'class' => 'btn btn-secondary',  'style'=> 'margin-left:15px'));?>
                    </div>
                </div>
            </div>
            <?= Form::close('posts/CRUD')?>
                <!--form CURD book-->
            </div>

            <div class="col-4">
                <h3>本のリスト</h3>
                <table class="table table-striped table-hover">
                    <thead>
                        <tr>
                        <th>番号</th>
                        <th>ID</th>
                        <th>本の名前</th>
                        </tr>  
                    </thead>
                    <tbody>
                        <?php $i=1;
                        foreach($mtbooks as $mtbook):?>
                        <tr>
                        <td><?php echo $i; ?></td>
                        <td><?php echo $mtbook->id; ?></td>
                        <td><?php echo $mtbook->book_title; ?></td>
                        </tr>
                        <?php  $i++; ?>
                        <?php endforeach;?>
                        
                    </tbody>
                </table>
            </div>
           
             <!--message-->
                <!--error-->
                <?php if(isset($error_mess)){?>
                    <div class="toast" id="toastNotification" style="font-size: 16px; position: absolute; top:0px; right:15px;">
                       <div class="toast-header" style="background-color: #f84f31; color:#e8eaee">
                           <Strong class="mr-auto">Thông báo!</Strong>
                           <i class="bi bi-bell-fill"></i>
                       </div>
                       <div class="toast-body">
                        <label for="txtbookid" style="color: red; font-weight: 500;">
                            <?php echo $error_mess?>
                        </label>
                       </div>
                   </div>
                <?php }?>
                <!--success-->
                <?php if(isset($success_mess)){?>
                    <div class="toast" id="toastNotification" style="font-size: 16px; position: absolute; top:0px; right:15px;">
                       <div class="toast-header" style="background-color: #23c552; color:#e8eaee">
                           <Strong class="mr-auto">Thông báo!</Strong>
                           <i class="bi bi-bell-fill"></i>
                       </div>
                       <div class="toast-body">
                            <label for="txtbookid" style="color: #23c552; font-weight: 500;">
                                <?php echo $success_mess?>
                            </label>
                       </div>
                   </div>
                <?php }?>
            <!--message-->
        </div>
        </div>
        <script>
         //--------------------------------------------------------------------------
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

            function validateFind(){
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
                    showError("bookid", "Vui lòng nhập mã sách!");
                }
                else if(bookid.length > 4){
                    flag = false;
                    showError("bookid", "Mã sách không đúng định dạng!");
                }

                //check book title
                if(booktitle == ''){
                    flag = false;
                    showError("booktitle", "Vui lòng nhập tiêu đề!");
                }

                // check author name
                if(authorname == ''){
                    flag = false;
                    showError("authorname", "Vui lòng nhập tên tác giả!");
                }

                // check publisher
                if(publisher == ''){
                    flag = false;
                    showError("publisher", "Vui lòng nhập nhà xuất bản!");
                }

                //check empty date
                if(year == ''){
                    flag = false;
                    showError("year", "Vui lòng nhập năm!");
                }else if (!checkYear(year)){
                    flag = false;
                    showError("year", "Năm không đúng định dạng!");
                }

                if(month == ''){
                    flag = false;
                    showError("month", "Vui lòng nhập tháng");
                }else if (!checkMonth(month)){
                    flag = false;
                    showError("month", "Tháng không đúng định dạng!");
                }

                if(day == ''){
                    flag = false;
                    showError("day", "Vui lòng nhập ngày");
                }else if (!checkDay(day, month, year)){
                    flag = false;
                    showError("day", "Ngày không đúng định dạng!");
                }
   
                return flag;
                
            }

            function validateUpdate(){
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
                    showError("bookid", "Vui lòng nhập mã sách!");
                }
                else if(bookid.length > 4){
                    flag = false;
                    showError("bookid", "Mã sách không đúng định dạng!");
                }
                //check book title
                if(booktitle == ''){
                    flag = false;
                    showError("booktitle", "Vui lòng nhập tiêu đề!");
                }

                // check author name
                if(authorname == ''){
                    flag = false;
                    showError("authorname", "Vui lòng nhập tên tác giả!");
                }

                // check publisher
                if(publisher == ''){
                    flag = false;
                    showError("publisher", "Vui lòng nhập nhà xuất bản!");
                }

                //check empty date
                if(year == ''){
                    flag = false;
                    showError("year", "Vui lòng nhập năm!");
                }else if (!checkYear(year)){
                    flag = false;
                    showError("year", "Năm không đúng định dạng!");
                }

                if(month == ''){
                    flag = false;
                    showError("month", "Vui lòng nhập tháng");
                }else if (!checkMonth(month)){
                    flag = false;
                    showError("month", "Tháng không đúng định dạng!");
                }

                if(day == ''){
                    flag = false;
                    showError("day", "Vui lòng nhập ngày");
                }else if (!checkDay(day, month, year)){
                    flag = false;
                    showError("day", "Ngày không đúng định dạng!");
                }
                
                return flag;

            }



         //--------------------------------------------------------------------------   

        </script>
        
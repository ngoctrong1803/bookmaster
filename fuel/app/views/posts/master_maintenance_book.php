 
        <div class="container" style="margin-top: 20px">
        <div class="row">
            <div class="col-12">
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
                            <a href="/home">閉じる</a>
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
                            <?= Form::button('find', '検索', array("onclick"=>"return validateFind()", "value" => "btnfind",'id' => 'btnfind','type' => 'submit', 'class' => 'btn btn-secondary',  'style'=> 'margin-left:15px'));?>
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

               

            <!--form CURD book-->
                <div class="col-12" style="display: flex">
                    <div class="col-4"></div>
                    <div
                        class="col-8"
                        style="display: flex; justify-content: flex-end"
                    >
                        <?= Form::button('add', '追加(Add)', array("onclick"=>"return validateAdd()", "value" => "btnadd';" ,'id' => 'btnadd','type' => 'submit', 'class' => 'btn btn-secondary',  'style'=> 'margin-left:15px'));?>
                      
                        <?= Form::button('update', '更新(Update)', array("onclick"=>"return validateUpdate()", "value" => "btnupdate';" ,'id' => 'btnupdate','type' => 'submit', 'class' => 'btn btn-secondary',  'style'=> 'margin-left:15px'));?>
                       
                        <?= Form::button('delete', '検索(Delete)', array("onclick"=>"return validateDelete()", "value" => "btndelete';" ,'id' => 'btndelete','type' => 'submit', 'class' => 'btn btn-secondary',  'style'=> 'margin-left:15px'));?>
                     
                        <?= Form::button('clear', 'クリア(Clear)', array("onclick"=>"return handleclear()", "value" => "btnclear';" ,'id' => 'btnclear', 'class' => 'btn btn-secondary',  'style'=> 'margin-left:15px'));?>
                    </div>
                </div>
            </div>
            <?= Form::close('posts/CRUD')?>
            
            </div>

         
           
             <!--message-->
                <!--error-->
                <?php if(isset($error_mess)){?>
                    <div class="toast" id="toastNotification" style="font-size: 16px; position: absolute; top:0px; right:15px;">
                       <div class="toast-header" style="background-color: #f84f31; color:#e8eaee">
                           <Strong class="mr-auto">メッセージ</Strong>
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
        
        


<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8" />
        <meta http-equiv="X-UA-Compatible" content="IE=edge" />
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
        <meta name="description" content="" />
        <meta name="author" content="" />
        <title>Masterbook</title>
        <link href="css/styles.css" rel="stylesheet" />
        <script src="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/js/all.min.js" crossorigin="anonymous"></script>
        <!-- Latest compiled and minified CSS -->
           <link
            href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.2/dist/css/bootstrap.min.css"
            rel="stylesheet"
        />
        <!-- Latest compiled JavaScript -->
            <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.2/dist/js/bootstrap.bundle.min.js"></script>
        <!--cdn ajax-->
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
        

        <!--Link css, js-->
        <?= Asset::css('styles.css')?>
        <?= Asset::js('scripts.js')?>
        <!--Link css, js-->
        
    </head>
    <body>
        <nav class="sb-topnav navbar navbar-expand navbar-dark bg-dark">
            <!-- Navbar Brand-->
            <a class="navbar-brand ps-3" href="#">TNT</a>
            <!-- Sidebar Toggle-->
            <button class="btn btn-link btn-sm order-1 order-lg-0 me-4 me-lg-0" id="sidebarToggle" href="#!"><i class="fas fa-bars"></i></button>
            <!-- Navbar Search-->
            <form class="d-none d-md-inline-block form-inline ms-auto me-0 me-md-3 my-2 my-md-0">
                <div class="input-group">
                    <input class="form-control" type="text" placeholder="Search for..." aria-label="Search for..." aria-describedby="btnNavbarSearch" />
                    <button class="btn btn-primary" id="btnNavbarSearch" type="button"><i class="fas fa-search"></i></button>
                </div>
            </form>
            <!-- Navbar-->
            <ul class="navbar-nav ms-auto ms-md-0 me-3 me-lg-4">
                <li class="nav-item dropdown">
                    <a class="nav-link dropdown-toggle" id="navbarDropdown" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false"><i class="fas fa-user fa-fw"></i></a>
                    <ul class="dropdown-menu dropdown-menu-end" aria-labelledby="navbarDropdown">
                        <li><a class="dropdown-item" href="#!">Settings</a></li>
                        <li><a class="dropdown-item" href="#!">Activity Log</a></li>
                        <li><hr class="dropdown-divider" /></li>
                        <li><a class="dropdown-item" href="#!">Logout</a></li>
                    </ul>
                </li>
            </ul>
        </nav>
        <div id="layoutSidenav">
            <div id="layoutSidenav_nav">
                <nav class="sb-sidenav accordion sb-sidenav-dark" id="sidenavAccordion">
                    <div class="sb-sidenav-menu">
                        <div class="nav">
                            <div class="sb-sidenav-menu-heading">Core</div>
                            <a class="nav-link" href="/masterbook">
                                <div class="sb-nav-link-icon"><i class="fas fa-tachometer-alt"></i></div>
                                本マスタメンテ
                            </a>
                            <div class="sb-sidenav-menu-heading">Interface</div>
                            <a class="nav-link collapsed" href="#" data-bs-toggle="collapse" data-bs-target="#collapseLayouts" aria-expanded="false" aria-controls="collapseLayouts">
                                <div class="sb-nav-link-icon"><i class="fas fa-columns"></i></div>
                                Layouts
                                <div class="sb-sidenav-collapse-arrow"><i class="fas fa-angle-down"></i></div>
                            </a>
                            <div class="collapse" id="collapseLayouts" aria-labelledby="headingOne" data-bs-parent="#sidenavAccordion">
                                <nav class="sb-sidenav-menu-nested nav">
                                    <a class="nav-link" href="layout-static.html">Static Navigation</a>
                                    <a class="nav-link" href="layout-sidenav-light.html">Light Sidenav</a>
                                </nav>
                            </div>
                            <a class="nav-link collapsed" href="#" data-bs-toggle="collapse" data-bs-target="#collapsePages" aria-expanded="false" aria-controls="collapsePages">
                                <div class="sb-nav-link-icon"><i class="fas fa-book-open"></i></div>
                                Pages
                                <div class="sb-sidenav-collapse-arrow"><i class="fas fa-angle-down"></i></div>
                            </a>
                            <div class="collapse" id="collapsePages" aria-labelledby="headingTwo" data-bs-parent="#sidenavAccordion">
                                <nav class="sb-sidenav-menu-nested nav accordion" id="sidenavAccordionPages">
                                    <a class="nav-link collapsed" href="#" data-bs-toggle="collapse" data-bs-target="#pagesCollapseAuth" aria-expanded="false" aria-controls="pagesCollapseAuth">
                                        Authentication
                                        <div class="sb-sidenav-collapse-arrow"><i class="fas fa-angle-down"></i></div>
                                    </a>
                                    <div class="collapse" id="pagesCollapseAuth" aria-labelledby="headingOne" data-bs-parent="#sidenavAccordionPages">
                                        <nav class="sb-sidenav-menu-nested nav">
                                            <a class="nav-link" href="login.html">Login</a>
                                            <a class="nav-link" href="register.html">Register</a>
                                            <a class="nav-link" href="password.html">Forgot Password</a>
                                        </nav>
                                    </div>
                                    <a class="nav-link collapsed" href="#" data-bs-toggle="collapse" data-bs-target="#pagesCollapseError" aria-expanded="false" aria-controls="pagesCollapseError">
                                        Error
                                        <div class="sb-sidenav-collapse-arrow"><i class="fas fa-angle-down"></i></div>
                                    </a>
                                    <div class="collapse" id="pagesCollapseError" aria-labelledby="headingOne" data-bs-parent="#sidenavAccordionPages">
                                        <nav class="sb-sidenav-menu-nested nav">
                                            <a class="nav-link" href="401.html">401 Page</a>
                                            <a class="nav-link" href="404.html">404 Page</a>
                                            <a class="nav-link" href="500.html">500 Page</a>
                                        </nav>
                                    </div>
                                </nav>
                            </div>
                            <div class="sb-sidenav-menu-heading">Addons</div>
                            <a class="nav-link" href="charts.html">
                                <div class="sb-nav-link-icon"><i class="fas fa-chart-area"></i></div>
                                Charts
                            </a>
                            <a class="nav-link" href="tables.html">
                                <div class="sb-nav-link-icon"><i class="fas fa-table"></i></div>
                                Tables
                            </a>
                        </div>
                    </div>
                    <div class="sb-sidenav-footer">
                        <div class="small">Logged in as:</div>
                        Start Bootstrap
                    </div>
                </nav>
            </div>
            <div id="layoutSidenav_content">
                <!--code in here-->
                <main>
                     
        <div class="container" style="margin-top: 20px">
        <div class="row">
            <div class="col-12">
            <!--form CURD book-->
            <?= Form::open(array( 'method'=>'post', 'id' => 'crud_form', "enctype" => "multipart/form-data"));?>
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
                        <div class="col-md-5">
                            <?= Form::label("本ID：", "title");?>
                                <?= Form::input('txtbookid', '', array('class' => 'form-control'));?>
                        </div>
                        <div
                            class="col-md-1"
                            style="display: flex; align-items: flex-end"
                        >
                            <?= Form::button('find', '検索', array("onclick"=>"return handleFind()", "value" => "btnfind",'id' => 'btn-find','type' => 'submit', 'class' => 'btn btn-secondary',  'style'=> 'margin-left:15px'));?>
                        </div> 
                        <div class="col-md-6" style="display: flex; align-items: flex-start;flex-direction: column;">
                            <?= Form::label("image：", "image");?>
                            <?= Form::input('book_img', '', array("placeholder"=> "choose image file", "name" => "book_img", 'class' => 'form-control', "type"=> "file"));?>
                        </div>
                     
                </div>
                <span style="color: red;" id="err_bookid"></span>
                    
                <!--handle attribute of book-->
                    <!--if book was not found or index page-->
                        <!--attribute of book-->
                        <div class="col-9">
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
                        </div>
                        <div class="col-3">
                            <img  id="bookimage" with="250px" height="250px" >
                        </div>
                        <label for="public_day" class="form-label">出版年月日：</label>
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

            <!--form CURD book-->
                <div class="col-12" style="display: flex">
                    <div class="col-4"></div>
                    <div
                        class="col-8"
                        style="display: flex; justify-content: flex-end"
                    >
                        <?= Form::button('add', '追加(Add)', array("onclick"=>"return handleAdd()", "value" => "btnadd';" ,'id' => 'btn-add','type' => 'submit', 'class' => 'btn btn-secondary',  'style'=> 'margin-left:15px'));?>
                      
                        <?= Form::button('update', '更新(Update)', array("onclick"=>"return handleUpdate()", "value" => "btnupdate';" ,'id' => 'btn-update','type' => 'submit', 'class' => 'btn btn-secondary',  'style'=> 'margin-left:15px'));?>
                       
                        <?= Form::button('delete', '削除(Delete)', array("onclick"=>"return handleDelete()", "value" => "btndelete';" ,'id' => 'btn-delete','type' => 'submit', 'class' => 'btn btn-secondary',  'style'=> 'margin-left:15px'));?>
                     
                        <?= Form::button('clear', 'クリア(Clear)', array("onclick"=>"return handleclear()", "value" => "btnclear';" ,'id' => 'btnclear', 'class' => 'btn btn-secondary',  'style'=> 'margin-left:15px'));?>
                    </div>
                </div>
            </div>
            <?= Form::close('posts/CRUD')?>
            
            </div>
             <!--message-->
                <!--error-->
                    <div class="toast" id="toastNotificationError" style="font-size: 16px; position: absolute; top:0px; right:15px;">
                       <div class="toast-header" style="background-color: #f84f31; color:#e8eaee">
                           <Strong class="mr-auto">メッセージ</Strong>
                           <i class="bi bi-bell-fill"></i>
                       </div>
                       <div class="toast-body">
                        <label for="txtbookid" style="color: red; font-weight: 500;">
                           <span id="toast-mess-error"></span>
                        </label>
                       </div>
                   </div>
        
                <!--success-->
                    <div class="toast" id="toastNotificationSuccess" style="font-size: 16px; position: absolute; top:0px; right:15px;">
                       <div class="toast-header" style="background-color: #23c552; color:#e8eaee">
                           <Strong class="mr-auto">メッセージ!</Strong>
                           <i class="bi bi-bell-fill"></i>
                       </div>
                       <div class="toast-body">
                            <label for="txtbookid" style="color: #23c552; font-weight: 500;">
                                <span id="toast-mess-success"></span>
                            </label>
                       </div>
                   </div>
            <!--message-->
        </div>

        </div>       
                </main>
                <footer class="py-4 bg-light mt-auto">
                    <div class="container-fluid px-4">
                        <div class="d-flex align-items-center justify-content-between small">
                            <div class="text-muted">Copyright &copy; Your Website 2021</div>
                            <div>
                                <a href="#">Privacy Policy</a>
                                &middot;
                                <a href="#">Terms &amp; Conditions</a>
                            </div>
                        </div>
                    </div>
                    <!--demo ajax-->
                        <div id="employee"></div>
                    <!--demo ajax-->
                </footer>
            </div>
        </div>
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js" crossorigin="anonymous"></script>
        <script src="js/scripts.js"></script>

    </body>
</html>

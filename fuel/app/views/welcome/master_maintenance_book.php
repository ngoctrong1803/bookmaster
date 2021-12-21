<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8" />
        <meta http-equiv="X-UA-Compatible" content="IE=edge" />
        <meta name="viewport" content="width=device-width, initial-scale=1.0" />
        <title>本マスタメンテ</title>
        <link rel="stylesheet" href="./style.css" />
        <!-- Latest compiled and minified CSS -->
        <link
            href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.2/dist/css/bootstrap.min.css"
            rel="stylesheet"
        />
        <!-- Latest compiled JavaScript -->
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.2/dist/js/bootstrap.bundle.min.js"></script>
    </head>
    <body>
        <div class="container" style="margin-top: 20px">
        <div class="row">
            <div class="col-8">
            <form class="row g-3">
                <div
                    style="
                        width: 100%;
                        height: 100px;
                        background-color: rgb(247, 247, 247);
                    "
                >
                    <div class="row">
                        <div class="col">
                            <h1>本マスタメンテ</h1>
                        </div>
                        <div class="col" style="text-align: end">
                            <a href="#">閉じる</a>
                        </div>
                    </div>
                </div>
                <div class="col-md-6">
                    <label for="inputEmail4" class="form-label">本ID：</label>
                    <input
                        type="userid"
                        class="form-control"
                        id="inputuserid"
                    />
                </div>
                <div
                    class="col-md-6"
                    style="display: flex; align-items: flex-end"
                >
                    <button
                        type="button"
                        class="btn btn-secondary"
                        style="align-self: end"
                    >
                        検索
                    </button>
                </div>
                <div class="col-12">
                    <label for="inputAddress" class="form-label"
                        >本タイトル：</label
                    >
                    <input
                        type="text"
                        class="form-control"
                        id="inputAddress"
                        placeholder=""
                    />
                </div>
                <div class="col-12">
                    <label for="inputAddress2" class="form-label"
                        >著者名：</label
                    >
                    <input
                        type="text"
                        class="form-control"
                        id="inputAddress2"
                        placeholder=""
                    />
                </div>
                <div class="col-12">
                    <label for="inputAddress2" class="form-label"
                        >出版社：</label
                    >
                    <input
                        type="text"
                        class="form-control"
                        id="inputAddress2"
                        placeholder=""
                    />
                </div>
                <label for="inputCity" class="form-label">出版年月日：</label>
                <div
                    class="col-md-3"
                    style="display: flex; align-items: center"
                >
                    <input type="text" class="form-control" id="inputCity" />
                    <label style="display: block; margin-left: 7px"> 年</label>
                </div>
                <div
                    class="col-md-3"
                    style="display: flex; align-items: center"
                >
                    <input type="text" class="form-control" id="inputZip" />
                    <label style="display: block; margin-left: 7px"> 月</label>
                </div>
                <div
                    class="col-md-3"
                    style="display: flex; align-items: center"
                >
                    <input type="text" class="form-control" id="inputZip" />
                    <label style="display: block; margin-left: 7px"> 日</label>
                </div>

                <div class="col-12" style="display: flex">
                    <div class="col-4"></div>
                    <div
                        class="col-8"
                        style="display: flex; justify-content: flex-end"
                    >
                        <button
                            style="margin-left: 15px"
                            type="submit"
                            class="btn btn-secondary"
                        >
                            追加
                        </button>
                        <button
                            style="margin-left: 15px"
                            type="submit"
                            class="btn btn-secondary"
                        >
                            更新
                        </button>
                        <button
                            style="margin-left: 15px"
                            type="submit"
                            class="btn btn-secondary"
                        >
                            削除
                        </button>
                        <button
                            style="margin-left: 15px"
                            type="submit"
                            class="btn btn-secondary"
                        >
                            クリア
                        </button>
                    </div>
                </div>
            </form>
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
                    <tr>
                    <td>1</td>
                    <td>KN01</td>
                    <td>Nhà giả kim</td>
                    </tr>
                    <tr>
                        <td>2</td>
                        <td>KN02</td>
                        <td>Đắc nhân tâm</td>
                    </tr>
                    
                </tbody>
            </table>
            </div>
        </div>
        </div>
    </body>
</html>

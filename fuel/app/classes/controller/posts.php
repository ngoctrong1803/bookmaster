<?php
    class Controller_Posts extends Controller_Template{

        public function action_index(){
            try {
                $mtbook = null;
                //notification
                $errormessage = null;
                $successmessage = null;
                if(Session::get_flash('errormessage') !=null){
                    $errormessage = Session::get_flash('errormessage');
                }
                else if(Session::get_flash('successmessage') !=null){
                    $successmessage = Session::get_flash('successmessage');
                }
                if(Session::get_flash('mtbook') !=null){
                    $mtbook = Session::get_flash('mtbook');
                }
                $data = array('mtbook'=> $mtbook ,'error_mess' => $errormessage, 'success_mess' =>$successmessage);
                $this->template->title = "本マスタメンテ";
                $this->template->content = View::forge('posts/master_maintenance_book', $data);
            }
            catch (Exception $e) {
                Session::set_flash('errormessage',  "サーバー処理で例外が発生しました。");
                Response::redirect('/'); 
            }
         
        }
        public function action_CRUD(){
            // FIND
            function find($bookid, $errormessage, $successmessage){  

                    $mtbook = Model_MtBook::findBook($bookid);
                    // check book
                    if($bookid == ""){
                        $errormessage = "本IDを入力してください。";
                    }
                    else if(strlen($bookid) != 4){
                        $errormessage = "本IDは半角英数字で入力してください。";
                    }
                    // handle find book
                    else if($mtbook->id == null){
                        $errormessage = "本ID".$bookid."が見つかりません。";
                    }
                    else{
                        $successmessage = "本が見つかりました。";
                    }
    
                    if( $errormessage !=null){
                        Session::set_flash('errormessage',  $errormessage);
                    }
                    else if( $successmessage !=null){
                        Session::set_flash('successmessage', $successmessage);
                    }

                    Session::set_flash('mtbook', $mtbook);

            }
            // INSERT
            function insert($bookid, $booktitle, $authorname, $publisher, $year, $month, $day, $errormessage, $successmessage){
                 // new book object to add.
                 $mtbook = new Model_MtBook();

                 // check exist of book
                 $bookidcheck = $bookid;
                 $mtbookcheck = Model_MtBook::findBook($bookidcheck);

                 // creat a book
                 $mtbook->id = $bookid;
                 $mtbook->book_title = $booktitle;
                 $mtbook->author_name =  $authorname;
                 $mtbook->publisher = $publisher;

                 // publication_day
                 if($year == null ||  $month == null || $day == null){
                     $errormessage = "出版年月日が不正です。";
                     Session::set_flash('errormessage',  $errormessage);
                     Session::set_flash('mtbook', $mtbook);
                     Response::redirect('/');
                 }

                 $checkDay= checkdate($month, $day, $year);
                 if ($checkDay == false){
                     $errormessage = "出版年月日が不正です。";
                     Session::set_flash('errormessage',  $errormessage);
                     Session::set_flash('mtbook', $mtbook);
                     Response::redirect('/');
                 }

                 // set publication day
                 $publicationDay = ''.$year.'-'.$month.'-'.$day.'';
                 $date = date($publicationDay);

                 $mtbook->publication_day = $date;
                 // insert_day
                 $today = date("Y-m-d H:i:s");
                 $mtbook->insert_day = $today;
                 // update_day
                 $mtbook->update_day = null;

                 // book doesn't exist
                 if($mtbookcheck->id == null){     
                     $result= Model_MtBook::insertBook($mtbook);
                     $successmessage ="本を登録しました。"; 
                 }
                 // book exist
                 else{
                     $errormessage = "本ID".$mtbook->id."は登録されています。別のIDを入力してください。";
                 }
             
                 if( $errormessage != null){
                     Session::set_flash('errormessage',  $errormessage);
                 }
                 else if( $successmessage != null){
                     Session::set_flash('successmessage', $successmessage);
                 }
                 Session::set_flash('mtbook', $mtbook); 

            }
            // UPDATE
            function update($bookid, $booktitle, $authorname, $publisher, $year, $month, $day, $errormessage, $successmessage){
                $mtbook = Model_MtBook::find($bookid);

                if($mtbook == null){
                    Session::set_flash('errormessage', "本ID".$bookid."が見つかりません。");
                    Response::redirect('/');
                }
                else if($mtbook != null){     

                    // book_title
                    $mtbook->book_title = $booktitle;
                    // author_name
                    $mtbook->author_name = $authorname;
                    // publisher
                    $mtbook->publisher =  $publisher;

                    // publication_day
                    if($year == null ||  $month == null || $day == null){
                        $errormessage = "出版年月日が不正です。";
                        Session::set_flash('errormessage',  $errormessage);
                        Session::set_flash('mtbook', $mtbook);
                        Response::redirect('/');
                    }
                
                    $checkDay= checkdate($month, $day, $year);
                    if ($checkDay == false){
                        $errormessage = "出版年月日が不正です。";
                        Session::set_flash('errormessage',  $errormessage);
                        Session::set_flash('mtbook', $mtbook);
                        Response::redirect('/');
                    }

                    $publicationDay = ''.$year.'-'.$month.'-'.$day.'';
                    $date = date($publicationDay);
                    $mtbook->publication_day = $date;
            
                    // update_day
                    $today = date("Y-m-d H:i:s");
                    $mtbook->update_day = $today;
                    //$mtbook->save();
                    Model_MtBook::updateBook($mtbook);
                    $successmessage ="本を更新しました。";
                }
                if( $errormessage != null){
                    Session::set_flash('errormessage',  $errormessage);
                }
                else if( $successmessage != null){
                    Session::set_flash('successmessage', $successmessage);
                }

                Session::set_flash('mtbook', $mtbook);
                
            }
            // DELETE
            function delete($bookid, $errormessage, $successmessage){
                $mtbook = Model_MtBook::find($bookid);
                    if($mtbook != null){   
                        Model_MtBook::deleteBook($bookid);
                        $successmessage = "本ID".$mtbook->id."を削除しました。";
                    }
                    else{
                        $errormessage = "本ID".Input::post('txtbookid')."が見つかりません。";
                    }
                    if( $errormessage != null){
                        Session::set_flash('errormessage',  $errormessage);
                    }
                    else if( $successmessage != null){
                        Session::set_flash('successmessage', $successmessage);
                    }
            }

             try {
                // find book
                if(Input::post('find'))
                {
                    // notification variable
                    $errormessage = null;
                    $successmessage = null;

                    $bookid = Input::post('txtbookid');

                    find($bookid, $errormessage, $successmessage);
                  
                    Response::redirect('/');
                }
                // insert book
                if(Input::post('add')){
                    
                    // notification variable
                    $errormessage = null;
                    $successmessage = null;
                    // book_id
                    $bookid = Input::post('txtbookid');
                    // book_title
                    $booktitle  = Input::post('txtbooktitle');
                    // author_name
                    $authorname = Input::post('txtauthorname');
                    // publisher
                    $publisher = Input::post('txtpublisher');
                    // publication_day
                    $year = Input::post('txtyear');
                    $month = Input::post('txtmonth');
                    $day = Input::post('txtday');
                    
                    insert($bookid, $booktitle, $authorname, $publisher, $year, $month, $day, $errormessage, $successmessage);
                   
                    Response::redirect('/');
                }
                // update book
                if(Input::post('update')){    
                    $errormessage = null;
                    $successmessage = null;
                    // book_id
                    $bookid = Input::post('txtbookid');
                    // book_title
                    $booktitle  = Input::post('txtbooktitle');
                    // author_name
                    $authorname = Input::post('txtauthorname');
                    // publisher
                    $publisher = Input::post('txtpublisher');
                    // publication_day
                    $year = Input::post('txtyear');
                    $month = Input::post('txtmonth');
                    $day = Input::post('txtday');
                    update($bookid, $booktitle, $authorname, $publisher, $year, $month, $day, $errormessage, $successmessage);
                    Response::redirect('/');
                }
                if(Input::post('delete')){
                    $errormessage = null;
                    $successmessage = null;
                    $bookid = Input::post('txtbookid');
                    delete($bookid,  $errormessage,  $successmessage);
                    Response::redirect('/');
                }
              }
              catch (Exception $e) {
                Session::set_flash('errormessage',  "サーバー処理で例外が発生しました。");
                Response::redirect('/');
              }     
        }
        public function action_about(){
            $data = array();
            $this->template->title = "About me";
            $this->template->content = View::forge('posts/about', $data);
        }
        public function action_home(){
            $data = array();
            $this->template->title = "Home";
            $this->template->content = View::forge('posts/Home', $data);
        }
    }

?> 
<?php
    class Controller_Posts extends Controller_Template{

        public function action_index(){
            try {
                //notification
                $errormessage = null;
                $successmessage = null;
                if(Session::get_flash('errormessage') !=null){
                    $errormessage = Session::get_flash('errormessage');
                }
                else if(Session::get_flash('successmessage') !=null){
                    $successmessage = Session::get_flash('successmessage');
                }
                $data = array('error_mess' => $errormessage, 'success_mess' =>$successmessage);
                $this->template->title = "本マスタメンテ";
                $this->template->content = View::forge('posts/master_maintenance_book', $data);
            }
            catch (Exception $e) {
                Session::set_flash('errormessage',  "サーバー処理で例外が発生しました。");
                Response::redirect('/'); 
            }
         
        }

        public function action_find(){
             try {
                $bookid = Input::post('txtbookid');
                $data;
                // check bookid
                if($bookid == ""){
                    $errormessage = "本IDを入力してください。"; // MSG 01
                    $data = array('error_mess' => $errormessage);
                }
                else if(strlen($bookid) != 4){
                    $errormessage = "本IDは半角英数字で入力してください。";// MSG 02
                    $data = array('error_mess' => $errormessage);
                }
                else if(Model_MtBook::findBook($bookid)->id != null){
                    $mtbook = Model_MtBook::findBook($bookid);
                    $successmessage = "本が見つかりました。"; //MSG 03
                    $data = array('mtbook'=> $mtbook, 'success_mess' =>$successmessage);
                }
                else{
                    $errormessage = "本ID".$bookid."が見つかりません。"; //MSG 04
                    $data = array('error_mess' => $errormessage);
                }
              
                $this->template->title = "本マスタメンテ";
                $this->template->content = View::forge('posts/master_maintenance_book', $data);
             }
             catch (Exception $e) {
                Session::set_flash('errormessage',  "サーバー処理で例外が発生しました。"); // MSG 05
                Response::redirect('/');
              }     
             
        }
        public function action_create(){
             try{
                $data;
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
       
                $mtbook = array('id' => $bookid, 'book_title' => $booktitle, 'author_name' => $authorname, 'publisher' => $publisher);
    
               // publication_day
               if($year == null ||  $month == null || $day == null){
                   $errormessage = "出版年月日が不正です。"; // MSG 16
                   $data = array('mtbook'=> (object) $mtbook ,'error_mess' => $errormessage);  
                   $this->template->title = "本マスタメンテ";
                   $this->template->content = View::forge('posts/master_maintenance_book', $data);   
                   return;       
               }
               else if (checkdate($month, $day, $year) == false){
                   $errormessage = "出版年月日が不正です。"; // MSG 16
                   $data = array('mtbook'=> (object) $mtbook ,'error_mess' => $errormessage);  
                   $this->template->title = "本マスタメンテ";
                   $this->template->content = View::forge('posts/master_maintenance_book', $data);
                   return;
               }
   
               // set publication day
               $publicationDay = ''.$year.'-'.$month.'-'.$day.'';
               $publicationDay = date($publicationDay);
               // insert_day
               $today = date("Y-m-d H:i:s");
               // update_day
               $update_day = null;
               // add property to array
               $mtbook = array_merge( $mtbook, array('publication_day' => $publicationDay, 'insert_day' => $today, 'update_day' => $update_day));

               
               // check exist of book
               $mtbookcheck = Model_MtBook::find($bookid);
   
               if($mtbookcheck != null){    
                   $errormessage = "本ID".$bookid."は登録されています。別のIDを入力してください。";// MSG 11
                   $data = array('mtbook'=> ((object) $mtbook) ,'error_mess' => $errormessage); 
               }
               else{
                   $book = Model_MtBook::insertBook($mtbook);
                   $successmessage ="本を登録しました。"; //MSG 12
                   $data = array('mtbook'=> $book , 'success_mess' =>$successmessage);
               }
               $this->template->title = "本マスタメンテ";
               $this->template->content = View::forge('posts/master_maintenance_book', $data);
            }
            catch (Exception $e){
                Session::set_flash('errormessage',  "サーバー処理で例外が発生しました。"); // MSG 05
                Response::redirect('/');
            }
        }

        public function action_update(){
           try{
                $data;
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

                $mtbook = array('id' => $bookid, 'book_title' => $booktitle, 'author_name' => $authorname, 'publisher' => $publisher);

                 // publication_day
                 if($year == null ||  $month == null || $day == null){
                    $errormessage = "出版年月日が不正です。"; // MSG 16
                    $data = array('mtbook'=> ((object)$mtbook) ,'error_mess' => $errormessage);
                    $this->template->title = "本マスタメンテ";
                    $this->template->content = View::forge('posts/master_maintenance_book', $data);
                    return;
                }
                else if ( checkdate($month, $day, $year) == false){
                    $errormessage = "出版年月日が不正です。"; // MSG 16
                    $data = array('mtbook'=> ((object)$mtbook) ,'error_mess' => $errormessage);
                    $this->template->title = "本マスタメンテ";
                    $this->template->content = View::forge('posts/master_maintenance_book', $data);
                    return;
                }


                // search book_id
                if( Model_MtBook::find($bookid) != null){              
                    //publication_day
                    $publicationDay = ''.$year.'-'.$month.'-'.$day.'';
                    $publicationDay = date($publicationDay);
            
                    // update_day
                    $update_day = date("Y-m-d H:i:s");
                                        
                    $mtbook = array_merge( $mtbook, array('publication_day' => $publicationDay, 
                                                            'update_day' => $update_day));
                    $book = Model_MtBook::updateBook($mtbook);
                    
                    $successmessage ="本を更新しました。"; // MSG 13
                    $data = array('mtbook'=> $book , 'success_mess' =>$successmessage);   
                }
                else{
                    $errormessage = "本ID".$bookid."が見つかりません。"; // MSG 14
                    $data = array('mtbook'=> $mtbook ,'error_mess' => $errormessage);               
                }
                $this->template->title = "本マスタメンテ";
                $this->template->content = View::forge('posts/master_maintenance_book', $data);
            }
            catch (Exception $e){
                Session::set_flash('errormessage',  "サーバー処理で例外が発生しました。"); // MSG 05
                Response::redirect('/');
            }
        }

        public function action_delete(){
            try{
                $data;
                $bookid = Input::post('txtbookid');

                if(Model_MtBook::find($bookid) != null){   
                    Model_MtBook::deleteBook($bookid);
                    $successmessage = "本ID".$bookid."を削除しました。"; // MSG 15
                    $data = array('success_mess' =>$successmessage);  
                }
                else{
                    $errormessage = "本ID".$bookid."が見つかりません。"; // MSG 14
                    $data = array('error_mess' => $errormessage);
                }
                $this->template->title = "本マスタメンテ";
                $this->template->content = View::forge('posts/master_maintenance_book', $data);      
            }
            catch (Exception $e){
                Session::set_flash('errormessage',  "サーバー処理で例外が発生しました。"); // MSG 05
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
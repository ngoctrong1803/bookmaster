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
                $errormessage = null;
                $successmessage = null;
   
                $bookid = Input::post('txtbookid');
   
                $mtbook = Model_MtBook::find($bookid);
                // check bookid
                if($bookid == ""){
                    $errormessage = "本IDを入力してください。"; // MSG 01
                }
                else if(strlen($bookid) != 4){
                    $errormessage = "本IDは半角英数字で入力してください。";// MSG 02
                }
                // handle find book 
                else if($mtbook != null){
                    $successmessage = "本が見つかりました。"; //MSG 03
                    $data = array('mtbook'=> $mtbook ,'error_mess' => $errormessage, 'success_mess' =>$successmessage);
                    $this->template->title = "本マスタメンテ";
                    $this->template->content = View::forge('posts/master_maintenance_book', $data);
                }
                else{
                    $errormessage = "本ID".$bookid."が見つかりません。"; //MSG 04
                    $data = array('error_mess' => $errormessage, 'success_mess' =>$successmessage);
                    $this->template->title = "本マスタメンテ";
                    $this->template->content = View::forge('posts/master_maintenance_book', $data);
    
                }
             }
             catch (Exception $e) {
                Session::set_flash('errormessage',  "サーバー処理で例外が発生しました。"); // MSG 05
                Response::redirect('/');
              }     
             
        }
        public function action_create(){
            try{
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
       
               // new book object to add.
               $mtbook = new Model_MtBook();
               // creat a book
               $mtbook->id = $bookid;
               $mtbook->book_title = $booktitle;
               $mtbook->author_name =  $authorname;
               $mtbook->publisher = $publisher;
   
               // publication_day
               if($year == null ||  $month == null || $day == null){
                   $errormessage = "出版年月日が不正です。"; // MSG 16
                   $data = array('mtbook'=> $mtbook ,'error_mess' => $errormessage, 'success_mess' =>$successmessage);
                   $this->template->title = "本マスタメンテ";
                   $this->template->content = View::forge('posts/master_maintenance_book', $data);
               }
   
               $checkDay= checkdate($month, $day, $year);
               if ($checkDay == false){
                   $errormessage = "出版年月日が不正です。"; // MSG 16
                   $data = array('mtbook'=> $mtbook ,'error_mess' => $errormessage, 'success_mess' =>$successmessage);
                   $this->template->title = "本マスタメンテ";
                   $this->template->content = View::forge('posts/master_maintenance_book', $data);
               }
   
               // set publication day
               $publicationDay = ''.$year.'-'.$month.'-'.$day.'';
               $date = date($publicationDay);
   
               //public day
               $mtbook->publication_day = $date;
   
               // insert_day
               $today = date("Y-m-d H:i:s");
               $mtbook->insert_day = $today;
   
               // update_day
               $mtbook->update_day = null;
               
               // check exist of book
               $bookidcheck = $bookid;
               $mtbookcheck = Model_MtBook::find($bookidcheck);
   
               if($mtbookcheck != null){    
                   $errormessage = "本ID".$mtbook->id."は登録されています。別のIDを入力してください。";// MSG 11
   
                   $data = array('mtbook'=> $mtbook ,'error_mess' => $errormessage, 'success_mess' =>$successmessage);
                   $this->template->title = "本マスタメンテ";
                   $this->template->content = View::forge('posts/master_maintenance_book', $data);
   
               }
               else{// book doesn't exist
                   if($mtbookcheck == null){     
                       $mtbook->save();
                       $successmessage ="本を登録しました。"; //MSG 12
                   }
                   $data = array('mtbook'=> $mtbook ,'error_mess' => $errormessage, 'success_mess' =>$successmessage);
                   $this->template->title = "本マスタメンテ";
                   $this->template->content = View::forge('posts/master_maintenance_book', $data);
               }
            }
            catch (Exception $e){
                Session::set_flash('errormessage',  "サーバー処理で例外が発生しました。"); // MSG 05
                Response::redirect('/');
            }
        }

        public function action_update(){
           try{
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

                $mtbook = new Model_MtBook();
                // creat a book
                $mtbook->id = $bookid;
                $mtbook->book_title = $booktitle;
                $mtbook->author_name =  $authorname;
                $mtbook->publisher = $publisher;

                 // publication_day
                 if($year == null ||  $month == null || $day == null){
                    $errormessage = "出版年月日が不正です。"; // MSG 16
                    $data = array('mtbook'=> $mtbook ,'error_mess' => $errormessage, 'success_mess' =>$successmessage);
                    $this->template->title = "本マスタメンテ";
                    $this->template->content = View::forge('posts/master_maintenance_book', $data);
                }
            
                $checkDay= checkdate($month, $day, $year);
                if ($checkDay == false){
                    $errormessage = "出版年月日が不正です。"; // MSG 16
                    $data = array('mtbook'=> $mtbook ,'error_mess' => $errormessage, 'success_mess' =>$successmessage);
                    $this->template->title = "本マスタメンテ";
                    $this->template->content = View::forge('posts/master_maintenance_book', $data);
                }


                // search book_id
                $mtbookUpdate = Model_MtBook::find($bookid);   
                if($mtbookUpdate != null){     

                    $mtbookUpdate->book_title = $booktitle;
                    $mtbookUpdate->author_name =  $authorname;
                    $mtbookUpdate->publisher = $publisher;

                    $publicationDay = ''.$year.'-'.$month.'-'.$day.'';
                    $date = date($publicationDay);
                    $mtbookUpdate->publication_day = $date;
            
                    // update_day
                    $today = date("Y-m-d H:i:s");
                    $mtbookUpdate->update_day = $today;
                    $mtbookUpdate->save();
                    $successmessage ="本を更新しました。"; // MSG 13
                    $data = array('mtbook'=> $mtbook ,'error_mess' => $errormessage, 'success_mess' =>$successmessage);
                    $this->template->title = "本マスタメンテ";
                    $this->template->content = View::forge('posts/master_maintenance_book', $data);

                }
                else if($mtbookUpdate == null){
                    $errormessage = "本ID".$bookid."が見つかりません。"; // MSG 14
                    $data = array('mtbook'=> $mtbook ,'error_mess' => $errormessage, 'success_mess' =>$successmessage);
                    $this->template->title = "本マスタメンテ";
                    $this->template->content = View::forge('posts/master_maintenance_book', $data);                    
                }
            }
            catch (Exception $e){
                Session::set_flash('errormessage',  "サーバー処理で例外が発生しました。"); // MSG 05
                Response::redirect('/');
            }
        }

        public function action_delete(){
            try{
                $errormessage = null;
                $successmessage = null;

                $bookid = Input::post('txtbookid');

                $mtbook = Model_MtBook::find($bookid);
                if($mtbook != null){   
                    $mtbook->delete();
                    $successmessage = "本ID".$mtbook->id."を削除しました。"; // MSG 15
                    $data = array('error_mess' => $errormessage, 'success_mess' =>$successmessage);
                    $this->template->title = "本マスタメンテ";
                    $this->template->content = View::forge('posts/master_maintenance_book', $data);     

                }
                else{
                    $errormessage = "本ID".Input::post('txtbookid')."が見つかりません。"; // MSG 14
                    $data = array('error_mess' => $errormessage, 'success_mess' =>$successmessage);
                    $this->template->title = "本マスタメンテ";
                    $this->template->content = View::forge('posts/master_maintenance_book', $data);   
                }
                
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
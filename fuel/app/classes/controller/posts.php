<?php

    class Controller_Posts extends Controller_Template{

        public function action_index(){
            $mtbooks = Model_MtBook::find('all');
            $mtbook = null;
            // notification
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


            $data = array( 'mtbooks' => $mtbooks, 'mtbook'=> $mtbook ,'error_mess' => $errormessage, 'success_mess' =>$successmessage);
            $this->template->title = "本マスタメンテ";
            $this->template->content = View::forge('posts/master_maintenance_book', $data);
        }


        public function action_CRUD(){
            // find book
            if(Input::post('find'))
            {
                // notification variable
                $errormessage = null;
                $successmessage = null;
                // list books
                $mtbooks = Model_MtBook::find('all');
                // find by id
                $bookid = Input::post('txtbookid');
                $mtbook = Model_MtBook::find('first', array(
                    'where' => array(
                        'id'=>$bookid
                    )
                ));

                if($bookid == ""){
                    $errormessage = "vui lòng nhập mã sách!";
                }
                else if(strlen($bookid) != 4){
                    $errormessage = "Sai định dạng mã sách!";
                }
                // handle find book
                else if($mtbook == null){
                    $errormessage = "không tìm thấy sách có ID: ".$bookid;
                }
                else{
                    $successmessage = "nội dung sách ". $bookid." đã hiển thị!";
                }
 
                if( $errormessage !=null){
                    Session::set_flash('errormessage',  $errormessage);
                }
                else if( $successmessage !=null){
                    Session::set_flash('successmessage', $successmessage);
                }

                Session::set_flash('mtbook', $mtbook);
                
                Response::redirect('/');
            }
            if(Input::post('add')){
                
                // notification variable
                $errormessage = null;
                $successmessage = null;

                // new book object to add.
                $mtbook = new Model_MtBook();

                // check exist of book
                $bookidcheck = Input::post('txtbookid');
                $mtbookcheck = Model_MtBook::find('first', array(
                    'where' => array(
                        'id'=>$bookidcheck
                    )
                ));
                // creat a book
                // book_id
                $mtbook->id = Input::post('txtbookid');
                // book_title
                $mtbook->book_title = Input::post('txtbooktitle');
                // author_name
                $mtbook->author_name = Input::post('txtauthorname');
                // publisher
                $mtbook->publisher = Input::post('txtpublisher');
                // publication_day
                $year= Input::post('txtyear');
                $month= Input::post('txtmonth');
                $day= Input::post('txtday');
                $publicationDay= ''.$year.'-'.$month.'-'.$day.'';
                $date=date($publicationDay);
                $mtbook->publication_day = $date;
                // insert_day
                $today = date("Y-m-d H:i:s");
                $mtbook->insert_day = $today;
                // update_day
                $mtbook->update_day = null;

                // book doesn't exist
                if($mtbookcheck == null){     
                    // save book
                    $mtbook->save();  
                    $successmessage ="thêm mới thành công!"; 
                }
                // book exist.
                else{
                    $errormessage = "mã sách đã tồn tại! thêm thất bại!!!";
                }
               

                if( $errormessage !=null){
                    Session::set_flash('errormessage',  $errormessage);
                }
                else if( $successmessage !=null){
                    Session::set_flash('successmessage', $successmessage);
                }

                Session::set_flash('mtbook', $mtbook);
                
                Response::redirect('/');
               
                // $data = array('mtbook'=> $mtbook, 'mtbooks' => $mtbooks, 'error_mess' => $errormessage, 'success_mess' =>$successmessage);
                // $this->template->title = "本マスタメンテ";
                // $this->template->content = View::forge('posts/master_maintenance_book', $data);
            }
            if(Input::post('update')){

                $errormessage = null;
                $successmessage = null;
                $mtbook = Model_MtBook::find( Input::post('txtbookid'));
                if($mtbook != null){     
                    // book_id
                    //$mtbook->id = Input::post('txtbookid');
                    // book_title
                    $mtbook->book_title = Input::post('txtbooktitle');
                    // author_name
                    $mtbook->author_name = Input::post('txtauthorname');
                    // publisher
                    $mtbook->publisher = Input::post('txtpublisher');
                    // publication_day
                    $year= Input::post('txtyear');
                    $month= Input::post('txtmonth');
                    $day= Input::post('txtday');
                    $publicationDay= ''.$year.'-'.$month.'-'.$day.'';
                    $date=date($publicationDay);
                    $mtbook->publication_day = $date;
                    //  // insert_day
                    //  $today = date("Y-m-d H:i:s");
                    //  $mtbook->insert_day = $today;
                    // update_day
                    $today = date("Y-m-d H:i:s");
                    $mtbook->update_day = $today;
                    $mtbook->save();
                    $successmessage ="đã cập nhật sách: ".$mtbook->id;
                }
                else{
                    $errormessage ="không tìm thấy sách muốn cập nhật";
                }
                if( $errormessage !=null){
                    Session::set_flash('errormessage',  $errormessage);
                }
                else if( $successmessage !=null){
                    Session::set_flash('successmessage', $successmessage);
                }

                Session::set_flash('mtbook', $mtbook);
                Response::redirect('/');
            }

            if(Input::post('delete')){
                $errormessage = null;
                $successmessage = null;
                $mtbook = Model_MtBook::find( Input::post('txtbookid'));
                if($mtbook != null){   
                    $mtbook->delete();
                    $successmessage = "Đã xóa sách: ".$mtbook->id;
                }
                else{
                    $errormessage = "không tìm thấy sách cần xóa!";
                }
                if( $errormessage !=null){
                    Session::set_flash('errormessage',  $errormessage);
                }
                else if( $successmessage !=null){
                    Session::set_flash('successmessage', $successmessage);
                }
               
                Response::redirect('/');

                
            }
            if(Input::post('clear')){
                Response::redirect('/');
            }
           

  
        }

        public function action_about(){
            $data = array();
            $this->template->title = "About me";
            $this->template->content = View::forge('posts/about', $data);
        }
    }

?> 
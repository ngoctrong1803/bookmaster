<?php  
// this controller handle with ajax
   class Controller_Masterbook extends Controller { 
        public function action_index() { 
            return View::forge("masterbook/index"); 
        } 
        public function action_find(){          
            if(Input::is_ajax()) { 
                    try {
                        $bookId = Input::post("bookId");
                        $data;
                        // check bookId
                        if($bookId == ""){
                            $errormessage = "本IDを入力してください。"; // MSG 01
                            $data = array('error_mess' => $errormessage);
                        }
                        else if(strlen($bookId) != 4){
                            $errormessage = "本IDは半角英数字で入力してください。";// MSG 02
                            $data = array('error_mess' => $errormessage);
                        }
                        else if(Model_MtBook::findBook($bookId)->id != null){
                            $mtbook =  Model_MtBook::findBook($bookId);
                            $mtbook = array( 'id' => $mtbook->id,
                                            'book_title' => $mtbook->book_title,
                                            'book_img' => $mtbook->book_img, 
                                            'author_name' =>$mtbook->author_name,
                                            'publisher' =>$mtbook->publisher,
                                            'publication_day' =>$mtbook->publication_day,
                                            'insert_day' =>$mtbook->insert_day,
                                            'update_day' =>$mtbook->update_day );

                            $successmessage = "本が見つかりました。"; //MSG 03
                            $data = array('mtbook'=> $mtbook, 'success_mess' =>$successmessage);
                        }
                        else{
                            $errormessage = "本ID".$bookId."が見つかりません。"; //MSG 04
                            $data = array('error_mess' => $errormessage);
                        }    
                        echo json_encode($data);
                        return;
                    }
                    catch (Exception $e) {
                        $errormessage = "サーバー処理で例外が発生しました。";// MSG 11
                        $data = array('error_mess' => $errormessage);
                        echo json_encode($data);
                    }     
            }  
      
        }
        public function action_create(){
            if(Input::is_ajax()) { 
                    try{
                        $data;
                        $bookid = Input::post("bookId");
                        $booktitle = Input::post("booktitle");
                        $authorname = Input::post("authorname");
                        $publisher = Input::post("publisher");
                        $year = Input::post("year");
                        $month = Input::post("month");
                        $day = Input::post("day");
                        $checkFile = Input::post("checkFile");
                        $imageUpload= "";
                    
                
                        $mtbookcheck = Model_MtBook::find($bookid);
                        if($mtbookcheck != null){    
                            $errormessage = "本ID".$bookid."は登録されています。別のIDを入力してください。";// MSG 11
                            $data = array('error_mess' => $errormessage);
                            echo json_encode($data);
                            return;
                        }

                        $mtbook = array('id' => $bookid, 'book_title' => $booktitle, 'author_name' => $authorname, 'publisher' => $publisher);
                            // check null
                            if($bookid == null ||  $booktitle == null || $authorname == null || $publisher == null){
                                $errormessage = "The book information is incomplete."; // MSG 16
                                $data = array('error_mess' => $errormessage);
                                echo json_encode($data);
                                return;     
                            }
                            // publication_day
                            if($year == null ||  $month == null || $day == null){
                                $errormessage = "出版年月日が不正です。"; // MSG 16
                                $data = array('error_mess' => $errormessage);     
                                echo json_encode($data);
                                return;
                            }
                            else if (checkdate($month, $day, $year) == false){
                                $errormessage = "出版年月日が不正です。"; // MSG 16
                                $data = array('error_mess' => $errormessage);  
                                echo json_encode($data);
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

                            if($checkFile == "true"){
                                $config = array( 
                                    'path' => DOCROOT.'/assets/img', 
                                    'randomize' => true, 
                                    'auto_rename' => false,
                                    'ext_whitelist' => array( 'jpg', 'gif', 'png'), 
                                );  
                                Upload::process($config);  
                                // if there are any valid files 
                                if (Upload::is_valid()) { 
                                    Upload::save(); 
                                    $fileUpload = Upload::get_files(0)['saved_as'];
                                    $mtbook = array_merge( $mtbook, array('book_img' => $fileUpload));
                                }   
                                else {
                                    $errormessage = "Can you upload image with extension are .png, .jpg, .gif。"; // MSG 16
                                    $data = array('error_mess' => $errormessage);  
                                    echo json_encode($data);
                                    return;
                                }
                            } else {
                                $errormessage = "No file have been upload"; // MSG 16
                                $data = array('error_mess' => $errormessage);  
                                echo json_encode($data);
                                return;
                            }
 
                            $book = Model_MtBook::insertBook($mtbook);
                            $book = array( 'id' => $book->id,
                            'book_title' => $book->book_title,
                            'book_img' => $book->book_img, 
                            'author_name' =>$book->author_name,
                            'publisher' =>$book->publisher,
                            'publication_day' =>$book->publication_day,
                            );
                            $successmessage ="本を登録しました。"; //MSG 12
                            $data = array('mtbook'=> $book , 'success_mess' =>$successmessage);
        
                            echo json_encode($data);
                            return;
                        //echo json_encode($mtbook); 
                    } 
                    catch (Exception $e) {
                        $errormessage = "サーバー処理で例外が発生しました。";// MSG 11
                        $data = array('error_mess' => $errormessage);
                        echo json_encode($data);
                       
                    }     
            }
        }
        public function action_update(){
            if(Input::is_ajax()) { 
                try{ 
                    $data;
                    $bookid = Input::post("bookId");
                    $booktitle = Input::post("booktitle");
                    $authorname = Input::post("authorname");
                    $publisher = Input::post("publisher");
                    $year = Input::post("year");
                    $month = Input::post("month");
                    $day = Input::post("day");
                    $checkFile = Input::post("checkFile");
                    $imageUpload= "";
                    $mtbook = array('id' => $bookid, 'book_title' => $booktitle, 'author_name' => $authorname, 'publisher' => $publisher);
                    if( Model_MtBook::find($bookid) != null){
                        // check null
                        if($bookid == null ||  $booktitle == null || $authorname == null || $publisher == null){
                        $errormessage = "The book information is incomplete."; // MSG 16
                        $data = array('error_mess' => $errormessage);
                        echo json_encode($data);
                        return;     
                        }
                        // publication_day
                        if($year == null ||  $month == null || $day == null){
                            $errormessage = "出版年月日が不正です。"; // MSG 16
                            $data = array('error_mess' => $errormessage);     
                            echo json_encode($data);
                            return;
                        }
                        else if (checkdate($month, $day, $year) == false){
                            $errormessage = "出版年月日が不正です。"; // MSG 16
                            $data = array('error_mess' => $errormessage);  
                            echo json_encode($data);
                            return;
                        }

                        if($checkFile == "true"){
                            $config = array( 
                                'path' => DOCROOT.'/assets/img', 
                                'randomize' => true, 
                                'auto_rename' => false,
                                'ext_whitelist' => array( 'jpg', 'gif', 'png'), 
                            );  
                            Upload::process($config);  
                            // if there are any valid files 
                            if (Upload::is_valid()) { 
                                Upload::save(); 
                                $fileUpload = Upload::get_files(0)['saved_as'];
                                $mtbook = array_merge( $mtbook, array('book_img' => $fileUpload));
                            }   
                            else {
                                $errormessage = "Can you upload image with extension are .png, .jpg, .gif。"; // MSG 16
                                $data = array('error_mess' => $errormessage);  
                                echo json_encode($data);
                                return;
                            }
                        } else {
                            $errormessage = "No file have been upload"; // MSG 16
                            $data = array('error_mess' => $errormessage);  
                            echo json_encode($data);
                            return;
                        }
                        // search book_id
                                    
                        //publication_day
                        $publicationDay = ''.$year.'-'.$month.'-'.$day.'';
                        $publicationDay = date($publicationDay);
                        // update_day
                        $update_day = date("Y-m-d H:i:s");
                                            
                        $mtbook = array_merge( $mtbook, array('publication_day' => $publicationDay, 
                                                                'update_day' => $update_day));

                        $imgName = Model_MtBook::find($bookid)->book_img;
                        File::delete(DOCROOT.'/assets/img/'.$imgName);
                        $book = Model_MtBook::updateBook($mtbook);
                        $mtbook = array( 
                        'id' => $mtbook["id"],
                        'book_title' => $mtbook["book_title"],
                        'book_img' => $mtbook["book_img"], 
                        'author_name' =>$mtbook["author_name"],
                        'publisher' =>$mtbook["publisher"],
                        'publication_day' =>$mtbook["publication_day"],
                        );
                        $successmessage ="本を更新しました。"; // MSG 13
                        $data = array('mtbook'=> $mtbook , 'success_mess' =>$successmessage);   
                    }
                    else{
                        $errormessage = "本ID".$bookid."が見つかりません。"; // MSG 14
                        $data = array('error_mess' => $errormessage);               
                    }
                    echo json_encode($data);
                    return;
                } 
                catch (Exception $e) {
                    $errormessage = "サーバー処理で例外が発生しました。";// MSG 11
                    $data = array('error_mess' => $errormessage);
                    echo json_encode($data);
                }                 
            }
        }
        public function action_delete(){
            if(Input::is_ajax()) { 
                    try{
                        $data;
                        $bookId = Input::post("bookId"); 
                        if(Model_MtBook::find($bookId) != null){  

                            $imgName = Model_MtBook::find($bookId)->book_img;
                            File::delete(DOCROOT.'/assets/img/'.$imgName);

                            Model_MtBook::deleteBook($bookId);
                            $successmessage = "本ID".$bookId."を削除しました。"; // MSG 15
                            $data = array('success_mess' =>$successmessage);  
                        }
                        else{
                        
                            $errormessage = "本ID".$bookId."が見つかりません。"; // MSG 14
                            $data = array('error_mess' => $errormessage);
                        }
                        echo json_encode($data);
                        return;
                    }
                    catch (Exception $e){
                        $errormessage = "サーバー処理で例外が発生しました。";// MSG 11
                        $data = array('error_mess' => $errormessage);
                        echo json_encode($data);
                    } 
            } 
        }
        public function action_home(){
            return View::forge("masterbook/home"); 
        }
   }
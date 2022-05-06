<?php
//namespace Model; 
class Model_MtBook extends Orm\Model{
    protected static $_properties = array(
        'id',
        'book_title',
        'book_img', 
        'author_name',
        'publisher',
        'publication_day',
        'insert_day',
        'update_day',
    );
    // find book
    public static function findBook($bookid) { 
        try {
            $book = new Model_MtBook();
            $query = DB::select('*')->from('mt_books');
            $query = $query->where('id', '=', $bookid); 
            $result  = $query->as_assoc()->execute();
            foreach ($result as $row) { 
                $book->id = $row['id'];
                $book->book_title = $row['book_title'];
                $book->book_img = $row['book_img'];
                $book->author_name = $row['author_name'];
                $book->publisher = $row['publisher'];
                $book->publication_day = $row['publication_day'];
                $book->insert_day = $row['insert_day'];
                $book->update_day = $row['update_day'];
            }
            return $book; 
        } catch(Exception $e) {
            $errormessage = MSG05;
            $data = array('error_mess' => $errormessage);
            echo json_encode($data);
        }
    }
    // insert book
    public static function insertBook($mtbook) { 
        try{
            $mtbookUpdate = array( 'id' => $mtbook['id'], 'book_title' => $mtbook['book_title'],'book_img' => $mtbook['book_img'], 'author_name' => $mtbook['author_name'],
                                    'publisher' => $mtbook['publisher'], 'publication_day' => $mtbook['publication_day'],
                                    'insert_day' => $mtbook['insert_day'], 'update_day' => $mtbook['update_day']);
            DB::insert('mt_books')->set($mtbookUpdate)->execute();
            $book = Model_MtBook::find($mtbook['id']);
            return $book; 
        } catch(Exception $e) {
            $errormessage = MSG05;
            $data = array('error_mess' => $errormessage);
            echo json_encode($data);
        }
    }
    // update book
    public static function updateBook($mtbook) {   
        try{
            $mtbookUpdate = array('book_title' =>  $mtbook['book_title'], 'book_img' => $mtbook['book_img'], 'author_name' => $mtbook['author_name'],
                                    'publisher' => $mtbook['publisher'], 'publication_day' => $mtbook['publication_day'],
                                    'update_day' => $mtbook['update_day']);
            DB::update('mt_books')->set($mtbookUpdate)->where('id', '=', $mtbook['id'])->execute();
            $book = Model_MtBook::find($mtbook['id']);
            return $book; 
        } catch(Exception $e) {
            $errormessage = MSG05;
            $data = array('error_mess' => $errormessage);
            echo json_encode($data);
        }
    }
    //delete book
    public static function deleteBook($bookid) { 
        try{
            $query = DB::delete('mt_books'); 
            $query = $query->where('id', '=', $bookid); 
            $result = $query->execute(); 
        } catch(Exception $e) {
            $errormessage = MSG05;
            $data = array('error_mess' => $errormessage);
            echo json_encode($data);
        }
         
    }
     


} 
<?php
//namespace Model; 
class Model_MtBook extends Orm\Model{
    protected static $_properties = array(
        'id',
        'book_title', 
        'author_name',
        'publisher',
        'publication_day',
        'insert_day',
        'update_day'
    );
    // find book
    public static function findBook($bookid) { 
        $book = new Model_MtBook();
        
        // lấy dữ liệu lên
        $query = DB::query('SELECT * FROM mt_books WHERE id= "'.$bookid.'"', DB::SELECT);    
        $result = $query->as_assoc()->execute(); 
        foreach ($result as $row) { 
            $book->id = $row['id'];
            $book->book_title = $row['book_title'];
            $book->author_name = $row['author_name'];
            $book->publisher = $row['publisher'];
            $book->publication_day = $row['publication_day'];
            $book->insert_day = $row['insert_day'];
            $book->update_day = $row['update_day'];
        }
        return $book; 
    }
    // insert book
    public static function insertBook($book) { 

        $query = DB::insert('mt_books', array('id', 'book_title', 'author_name','publisher','publication_day','insert_day'));
        $query = $query->values(array($book->id, $book->book_title, $book->author_name, $book->publisher, $book->publication_day, $book->insert_day));
        $result = $query->execute(); 
    }
    // update book
    public static function updateBook($book) {   
        $query = DB::query('UPDATE mt_books SET book_title = "'.$book->book_title.'",
                                                author_name = "'.$book->author_name.'",
                                                publisher = "'.$book->publisher.'",
                                                publication_day = "'. $book->publication_day.'",
                                                insert_day = "'.$book->insert_day.'",
                                                update_day = "'.$book->update_day.'"
                                            WHERE ID = "'.$book->id.'"', DB::UPDATE); 
        $result = $query->execute(); 
    }
    //delete book
    public static function deleteBook($bookid) { 
          $query = DB::query('DELETE  FROM mt_books WHERE ID ="'.$bookid.'"', DB::DELETE); 
          $result = $query->execute(); 
    }
     
} 
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
        $query = DB::select('*')->from('mt_books');
        $query = $query->where('id', '=', $bookid); 
        $result  = $query->as_assoc()->execute();
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
    public static function insertBook($mtbook) { 

        $query = DB::insert('mt_books', array('id', 'book_title', 'author_name','publisher','publication_day','insert_day'));
        $query = $query->values(array($mtbook['id'], $mtbook['book_title'], $mtbook['author_name'], $mtbook['publisher'], $mtbook['publication_day'], $mtbook['insert_day']));
        $result = $query->execute(); 
        $book = new Model_MtBook();
            $book->id = $mtbook['id'];
            $book->book_title = $mtbook['book_title'];
            $book->author_name = $mtbook['author_name'];
            $book->publisher = $mtbook['publisher'];
            $book->publication_day = $mtbook['publication_day'];
            $book->insert_day = $mtbook['insert_day'];
            $book->update_day = $mtbook['update_day'];
        return $book; 
    }
    // update book
    public static function updateBook($mtbook) {   

        $query = DB::update('mt_books');
        $query = $query->value('book_title', $mtbook['book_title']);
        $query = $query->value('author_name', $mtbook['author_name']);
        $query = $query->value('publisher', $mtbook['publisher']);
        $query = $query->value('publication_day', $mtbook['publication_day']);
        $query = $query->value('insert_day', $mtbook['insert_day']);
        $query = $query->value('update_day', $mtbook['update_day']);
        $query = $query->where('id', '=', $mtbook['id']); 
        $result = $query->execute(); 
    
        $book = new Model_MtBook();
            $book->id = $mtbook['id'];
            $book->book_title = $mtbook['book_title'];
            $book->author_name = $mtbook['author_name'];
            $book->publisher = $mtbook['publisher'];
            $book->publication_day = $mtbook['publication_day'];
            $book->insert_day = $mtbook['insert_day'];
            $book->update_day = $mtbook['update_day'];
        return $book; 

    }
    //delete book
    public static function deleteBook($bookid) { 
          $query = DB::delete('mt_books'); 
          $query = $query->where('id', '=', $bookid); 
          $result = $query->execute(); 
    }
     


} 
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
        $mtbookUpdate = array( 'id' => $mtbook['id'], 'book_title' => $mtbook['book_title'], 'author_name' => $mtbook['author_name'],
                               'publisher' => $mtbook['publisher'], 'publication_day' => $mtbook['publication_day'],
                               'insert_day' => $mtbook['insert_day'], 'update_day' => $mtbook['update_day']);
        DB::insert('mt_books')->set($mtbookUpdate)->execute();

        $book = Model_MtBook::find($mtbook['id']);
        return $book; 
    }
    // update book
    public static function updateBook($mtbook) {   

        $mtbookUpdate = array('book_title' =>  $mtbook['book_title'], 'author_name' => $mtbook['author_name'],
                              'publisher' => $mtbook['publisher'], 'publication_day' => $mtbook['publication_day'],
                              'update_day' => $mtbook['update_day']);
        DB::update('mt_books') ->set($mtbookUpdate) ->where('id', '=', $mtbook['id'])->execute();
    
        $book = Model_MtBook::find($mtbook['id']);
        return $book; 

    }
    //delete book
    public static function deleteBook($bookid) { 
          $query = DB::delete('mt_books'); 
          $query = $query->where('id', '=', $bookid); 
          $result = $query->execute(); 
    }
     


} 
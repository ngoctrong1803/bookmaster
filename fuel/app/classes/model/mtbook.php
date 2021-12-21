<?php
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

} 

?>
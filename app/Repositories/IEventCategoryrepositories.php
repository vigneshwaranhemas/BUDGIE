<?php

namespace App\Repositories;

interface IEventCategoryrepositories{
       public function insert_event_category($data);      
       public function fetch_event_category_all();      
       public function event_category_delete($id);      
       public function fetch_select_option_event_category();      
       public function fetch_selected_event_category($id);             
}

?>

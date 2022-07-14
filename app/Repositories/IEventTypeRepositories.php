<?php

namespace App\Repositories;


interface IEventTypeRepositories{
       public function insert_event_type($data);      
       public function fetch_event_type_all();      
       public function event_type_delete($id);      
       public function fetch_select_op_event_type();      
       public function fetch_selected_event_type($id);      
}

?>

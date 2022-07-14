<?php

namespace App\Repositories;

interface IEventRepositories{
       public function add_event_insert($data);      
       // public function fetch_category_details_all();      
       public function insertEventCode($event_unique_code, $last_inserted_id);      
       public function fetch_event_filter();      
       public function fetch_event_with_filter($data);      
       public function fetch_event_edit($id);      
       public function event_delete($id);      
       public function event_attendees_delete($id);      
       public function event_attendees_get($id);      
       public function event_update($data);      
       public function event_update_file($data);      
       public function attendees_filter($data);      
       
}

?>

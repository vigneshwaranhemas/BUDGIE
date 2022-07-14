<?php
namespace App\Repositories;
use Illuminate\Support\Facades\DB;
use Auth;
use App\PeopleStar; 

class PeopleRepository implements IPeopleRepository
{
  
   public function fetch_customuser_list()
   { 
      $response = DB::table("customusers")->get()->toArray();
      return $response;
   }
   public function fetch_starred_customusers_list()
   {           
      $login_id = Auth::user()->empID;      
      $check = PeopleStar::where('created_by', $login_id)->value('starred');

      if(!empty($check)){
         
         $arrayStarred =json_decode($check);
         
         $response = '';

         foreach($arrayStarred as $starred_empID){
            // dd($starred_empID);
            $username = DB::table("customusers")->where('empID', $starred_empID)->value('username');
            $designation = DB::table("customusers")->where('empID', $starred_empID)->value('designation');

            $response .= '<li class="clearfix people_list_ul_li" data-id="'.$starred_empID.'"><img class="rounded-circle user-image" src="../assets/images/user/1.jpg" alt="">';
            $response .= '<div class="about">';
            $response .= '<div class="name">'.$username.' <small><span class="digits">(#'.$starred_empID.')</span></small></div>';
            $response .= '<div class="status"><i class="fa fa-share font-success"></i>  '.$designation.'</div>';
            $response .= '</div>';
            $response .= '</li>';

         }

      }else{
         $response = 'empty';
      }
      
      return $response;
   } 
   public function fetch_starred_customusers_list_with_filter($data)
   {           
      $login_id = Auth::user()->empID;      
      $check = PeopleStar::where('created_by', $login_id)->value('starred');

      if(!empty($check)){
         
         $arrayStarred =json_decode($check);
         
         $response = '';

         foreach($arrayStarred as $starred_empID){
            // dd($starred_empID);

            if($data['people_filter_dept'] == "All" && $data['people_filter_design'] == "All" && $data['people_filter_location'] == "All"){
               $username = DB::table("customusers")->where('empID', $starred_empID)->value('username');
               $designation = DB::table("customusers")->where('empID', $starred_empID)->value('designation');
               $gender = DB::table("customusers")->where('empID', $starred_empID)->value('gender');
            }elseif($data['people_filter_dept'] != "All" && $data['people_filter_design'] != "All" && $data['people_filter_location'] == "All"){

               $username = DB::table("customusers")->where('empID', $starred_empID)->where('department', $data['people_filter_dept'])->where('designation', $data['people_filter_design'])->value('username');
               $designation = DB::table("customusers")->where('empID', $starred_empID)->where('worklocation', $data['people_filter_location'])->value('designation');
               $gender = DB::table("customusers")->where('empID', $starred_empID)->where('worklocation', $data['people_filter_location'])->value('gender');

            }elseif($data['people_filter_dept'] == "All" && $data['people_filter_design'] != "All" && $data['people_filter_location'] != "All"){
               
               $username = DB::table("customusers")->where('empID', $starred_empID)->value('username');
               $designation = DB::table("customusers")->where('empID', $starred_empID)->where('department', $data['people_filter_dept'])->where('designation', $data['people_filter_design'])->where('worklocation', $data['people_filter_location'])->value('designation');
               $gender = DB::table("customusers")->where('empID', $starred_empID)->where('department', $data['people_filter_dept'])->value('gender');
            
            }elseif($data['people_filter_dept'] != "All" && $data['people_filter_design'] == "All" && $data['people_filter_location'] != "All"){
               
               $username = DB::table("customusers")->where('empID', $starred_empID)->where('department', $data['people_filter_dept'])->value('username');
               $designation = DB::table("customusers")->where('empID', $starred_empID)->where('designation', $data['people_filter_design'])->where('worklocation', $data['people_filter_location'])->value('designation');
               $gender = DB::table("customusers")->where('empID', $starred_empID)->where('designation', $data['people_filter_design'])->value('gender');
            
            }elseif($data['people_filter_dept'] != "All" && $data['people_filter_design'] != "All" && $data['people_filter_location'] != "All"){
               
               $username = DB::table("customusers")->where('empID', $starred_empID)->where('worklocation', $data['people_filter_location'])->where('designation', $data['people_filter_design'])->where('designation', $data['people_filter_design'])->value('username');
               $designation = DB::table("customusers")->where('empID', $starred_empID)->where('worklocation', $data['people_filter_location'])->where('designation', $data['people_filter_design'])->where('designation', $data['people_filter_design'])->value('designation');      
               $gender = DB::table("customusers")->where('empID', $starred_empID)->where('worklocation', $data['people_filter_location'])->where('designation', $data['people_filter_design'])->where('designation', $data['people_filter_design'])->value('gender');                     

            }else{
               
               if($data['people_filter_dept'] != "All" && $data['people_filter_design'] == "All" && $data['people_filter_location'] == "All"){
                  $username = DB::table("customusers")->where('empID', $starred_empID)->where('department', $data['people_filter_dept'])->value('username');
                  $designation = DB::table("customusers")->where('empID', $starred_empID)->where('department', $data['people_filter_dept'])->value('designation');
                  $gender = DB::table("customusers")->where('empID', $starred_empID)->where('department', $data['people_filter_dept'])->value('gender');
               }elseif($data['people_filter_dept'] == "All" && $data['people_filter_design'] == "All" && $data['people_filter_location'] != "All"){
                  $username = DB::table("customusers")->where('empID', $starred_empID)->where('worklocation', $data['people_filter_location'])->value('username');
                  $designation = DB::table("customusers")->where('empID', $starred_empID)->where('worklocation', $data['people_filter_location'])->value('designation');
                  $gender = DB::table("customusers")->where('empID', $starred_empID)->where('worklocation', $data['people_filter_location'])->value('gender');
               }elseif($data['people_filter_dept'] == "All" && $data['people_filter_design'] != "All" && $data['people_filter_location'] == "All"){
                  $username = DB::table("customusers")->where('empID', $starred_empID)->where('designation', $data['people_filter_design'])->value('username');
                  $designation = DB::table("customusers")->where('empID', $starred_empID)->where('designation', $data['people_filter_design'])->value('designation');
                  $gender = DB::table("customusers")->where('empID', $starred_empID)->where('designation', $data['people_filter_design'])->value('gender');
               }
            }            

            $profile_images = DB::table('images')->where('emp_id', $starred_empID)->value('path');

            if(!empty($username) || !empty($designation)){

               if(!empty($profile_images)){
                  // dd($profile_images); 
                  $response .= '<li class="clearfix people_list_ul_li '.$starred_empID.'" id="'.$starred_empID.'" data-id="'.$starred_empID.'"><img class="img-50 rounded-circle user-image" src="../uploads/'.$profile_images.'" alt="#">';

               }else{
               
                  if($gender == "Male"){
                     $response .= '<li class="clearfix people_list_ul_li '.$starred_empID.'" id="'.$starred_empID.'" data-id="'.$starred_empID.'"><img class="rounded-circle user-image" src="../assets/images/user/1.jpg" alt="">';
                  }else{
                     $response .= '<li class="clearfix people_list_ul_li '.$starred_empID.'" id="'.$starred_empID.'" data-id="'.$starred_empID.'"><img class="rounded-circle user-image" src="../assets/images/user/4.jpg" alt="">';
                  }

               }

               // $response .= '<li class="clearfix people_list_ul_li '.$starred_empID.'" data-id="'.$starred_empID.'"><img class="rounded-circle user-image" src="../assets/images/user/1.jpg" alt="">';
               $response .= '<div class="about">';
               $response .= '<div class="name">'.$username.' <small><span class="digits">(#'.$starred_empID.')</span></small></div>';
               $response .= '<div class="status"><i class="fa fa-share font-success"></i>  '.$designation.'</div>';
               $response .= '</div>';
               $response .= '</li>';
            }
            
         }

         if($response == ''){
            $response = 'empty';
         }

      }else{
         $response = 'empty';
      }
      
      return $response;
   } 
   public function fetch_everyone_customusers_list()
   {           
      $customusers = DB::table("customusers")->get();

      if(!empty($customusers)){
                  
         $response = '';

         foreach($customusers as $customuser){

            $login_id = Auth::user()->empID;      
            $check = PeopleStar::where('created_by', $login_id)->value('starred');
            $emp_id = $customuser->empID;

            if(!empty($check)){
                              
               $arrayStarred =json_decode($check);

               if(($key = array_search($emp_id, $arrayStarred)) !== false){
                  // dd("have");
                  // <i id="star_class_name" style="color: rgb(255, 199, 23);" class="fa fa-star"></i>

                  $response .= '<li class="clearfix people_list_ul_li '.$customuser->empID.'" data-id="'.$customuser->empID.'"><img class="rounded-circle user-image" src="../assets/images/user/1.jpg" alt="">';
                  $response .= '<div class="about">';
                  $response .= '<div class="name">'.$customuser->username.' <small><span class="digits">(#'.$customuser->empID.') <i id="star_class_name" style="color: rgb(255, 199, 23);" class="fa fa-star star_class_name"></i></span></small></div>';
                  $response .= '<div class="status"><i class="fa fa-share font-success"></i>  '.$customuser->designation.'</div>';
                  $response .= '</div>';
                  $response .= '</li>';                  

               }else{

                  $response .= '<li class="clearfix people_list_ul_li '.$customuser->empID.'" data-id="'.$customuser->empID.'"><img class="rounded-circle user-image" src="../assets/images/user/1.jpg" alt="">';
                  $response .= '<div class="about">';
                  $response .= '<div class="name">'.$customuser->username.' <small><span class="digits">(#'.$customuser->empID.')</span></small></div>';
                  $response .= '<div class="status"><i class="fa fa-share font-success"></i>  '.$customuser->designation.'</div>';
                  $response .= '</div>';
                  $response .= '</li>';

               }

            }else{

               $response .= '<li class="clearfix people_list_ul_li '.$customuser->empID.'" data-id="'.$customuser->empID.'"><img class="rounded-circle user-image" src="../assets/images/user/1.jpg" alt="">';
               $response .= '<div class="about">';
               $response .= '<div class="name">'.$customuser->username.' <small><span class="digits">(#'.$customuser->empID.')</span></small></div>';
               $response .= '<div class="status"><i class="fa fa-share font-success"></i>  '.$customuser->designation.'</div>';
               $response .= '</div>';
               $response .= '</li>';

            }            

         }

      }else{
         $response = 'empty';
      }

      // $response .= '<li class="clearfix"><img class="rounded-circle user-image" src="../assets/images/user/1.jpg" alt="">';
      // $response .= '<div class="about">';
      // $response .= '<div class="name">fsdgs <small><span class="digits">(#fsdgs)</span></small></div>';
      // $response .= '<div class="status"><i class="fa fa-share font-success"></i>  fsdgs</div>';
      // $response .= '</div>';
      // $response .= '</li>';
      // $response .= '<li class="clearfix"><img class="rounded-circle user-image" src="../assets/images/user/1.jpg" alt="">';
      // $response .= '<div class="about">';
      // $response .= '<div class="name">fsdgs<small><span class="digits">(#fsdgs)</span></small></div>';
      // $response .= '<div class="status"><i class="fa fa-share font-success"></i>  fsdgs</div>';
      // $response .= '</div>';
      // $response .= '</li>';
      
      return $response;
   }  
   public function fetch_everyone_customusers_list_with_filter($data)
   {           
      if($data['people_filter_dept'] == "All" && $data['people_filter_design'] == "All" && $data['people_filter_location'] == "All"){
         $customusers = DB::table("customusers")->get();
      }elseif($data['people_filter_dept'] != "All" && $data['people_filter_design'] != "All" && $data['people_filter_location'] == "All"){
         $customusers = DB::table("customusers")->where('department', $data['people_filter_dept'])->where('designation', $data['people_filter_design'])->get();
      }elseif($data['people_filter_dept'] == "All" && $data['people_filter_design'] != "All" && $data['people_filter_location'] != "All"){
         $customusers = DB::table("customusers")->where('designation', $data['people_filter_design'])->get();      
      }elseif($data['people_filter_dept'] != "All" && $data['people_filter_design'] == "All" && $data['people_filter_location'] != "All"){
         $customusers = DB::table("customusers")->where('department', $data['people_filter_dept'])->where('worklocation', $data['people_filter_location'])->get();   
      }elseif($data['people_filter_dept'] != "All" && $data['people_filter_design'] != "All" && $data['people_filter_location'] != "All"){         
         $customusers = DB::table("customusers")->where('department', $data['people_filter_dept'])->where('worklocation', $data['people_filter_location'])->where('designation', $data['people_filter_design'])->get();      
      }else{

         if($data['people_filter_dept'] != "All" && $data['people_filter_design'] == "All" && $data['people_filter_location'] == "All"){
            $customusers = DB::table("customusers")->where('department', $data['people_filter_dept'])->get();
         }elseif($data['people_filter_dept'] == "All" && $data['people_filter_design'] == "All" && $data['people_filter_location'] != "All"){
            $customusers = DB::table("customusers")->where('worklocation', $data['people_filter_location'])->get();
         }elseif($data['people_filter_dept'] == "All" && $data['people_filter_design'] != "All" && $data['people_filter_location'] == "All"){
            $customusers = DB::table("customusers")->where('designation', $data['people_filter_design'])->get();
         }
      }

      if(!empty($customusers)){
                  
         $response = '';

         foreach($customusers as $customuser){

            $login_id = Auth::user()->empID;      
            $check = PeopleStar::where('created_by', $login_id)->value('starred');
            $emp_id = $customuser->empID;
            $profile_images = DB::table('images')->where('emp_id', $customuser->empID)->value('path');

            if(!empty($check)){
                              
               $arrayStarred =json_decode($check);

               if(($key = array_search($emp_id, $arrayStarred)) !== false){
                  // dd("have");
                  // <i id="star_class_name" style="color: rgb(255, 199, 23);" class="fa fa-star"></i>

                  if(!empty($profile_images)){
                     // dd($profile_images); 
                     $response .= '<li class="clearfix people_list_ul_li '.$customuser->empID.'" id="'.$customuser->empID.'" data-id="'.$customuser->empID.'"><img class="img-50 rounded-circle user-image" src="../uploads/'.$profile_images.'" alt="#">';

                 }else{
                
                     if($customuser->gender == "Male"){
                        $response .= '<li class="clearfix people_list_ul_li '.$customuser->empID.'" id="'.$customuser->empID.'" data-id="'.$customuser->empID.'"><img class="rounded-circle user-image" src="../assets/images/user/1.jpg" alt="">';
                     }else{
                        $response .= '<li class="clearfix people_list_ul_li '.$customuser->empID.'" id="'.$customuser->empID.'" data-id="'.$customuser->empID.'"><img class="rounded-circle user-image" src="../assets/images/user/4.jpg" alt="">';
                     }
 
                 }
 
                  $response .= '<div class="about">';
                  $response .= '<div class="name">'.$customuser->username.' <small><span class="digits">(#'.$customuser->empID.') <i id="star_class_name" style="color: rgb(255, 199, 23);" class="fa fa-star star_class_name"></i></span></small></div>';
                  $response .= '<div class="status"><i class="fa fa-share font-success"></i>  '.$customuser->designation.'</div>';
                  $response .= '</div>';
                  $response .= '</li>';                  

               }else{

                  if(!empty($profile_images)){
                     // dd($profile_images); 
                     $response .= '<li class="clearfix people_list_ul_li '.$customuser->empID.'" id="'.$customuser->empID.'" data-id="'.$customuser->empID.'"><img class="img-50 rounded-circle user-image" src="../uploads/'.$profile_images.'" alt="#">';

                  }else{
                  
                     if($customuser->gender == "Male"){
                        $response .= '<li class="clearfix people_list_ul_li '.$customuser->empID.'" id="'.$customuser->empID.'" data-id="'.$customuser->empID.'"><img class="rounded-circle user-image" src="../assets/images/user/1.jpg" alt="">';
                     }else{
                        $response .= '<li class="clearfix people_list_ul_li '.$customuser->empID.'" id="'.$customuser->empID.'" data-id="'.$customuser->empID.'"><img class="rounded-circle user-image" src="../assets/images/user/4.jpg" alt="">';
                     }
   
                  }
                  
                  // $response .= '<li class="clearfix people_list_ul_li '.$customuser->empID.'" data-id="'.$customuser->empID.'"><img class="rounded-circle user-image" src="../assets/images/user/1.jpg" alt="">';
                  $response .= '<div class="about">';
                  $response .= '<div class="name">'.$customuser->username.' <small><span class="digits">(#'.$customuser->empID.')</span></small></div>';
                  $response .= '<div class="status"><i class="fa fa-share font-success"></i>  '.$customuser->designation.'</div>';
                  $response .= '</div>';
                  $response .= '</li>';

               }

            }else{

               if(!empty($profile_images)){
                  // dd($profile_images); 
                  $response .= '<li class="clearfix people_list_ul_li '.$customuser->empID.'" id="'.$customuser->empID.'" data-id="'.$customuser->empID.'"><img class="img-50 rounded-circle user-image" src="../uploads/'.$profile_images.'" alt="#">';

               }else{
               
                  if($customuser->gender == "Male"){
                     $response .= '<li class="clearfix people_list_ul_li '.$customuser->empID.'" id="'.$customuser->empID.'" data-id="'.$customuser->empID.'"><img class="rounded-circle user-image" src="../assets/images/user/1.jpg" alt="">';
                  }else{
                     $response .= '<li class="clearfix people_list_ul_li '.$customuser->empID.'" id="'.$customuser->empID.'" data-id="'.$customuser->empID.'"><img class="rounded-circle user-image" src="../assets/images/user/4.jpg" alt="">';
                  }

               }

               // $response .= '<li class="clearfix people_list_ul_li '.$customuser->empID.'" data-id="'.$customuser->empID.'"><img class="rounded-circle user-image" src="../assets/images/user/1.jpg" alt="">';
               $response .= '<div class="about">';
               $response .= '<div class="name">'.$customuser->username.' <small><span class="digits">(#'.$customuser->empID.')</span></small></div>';
               $response .= '<div class="status"><i class="fa fa-share font-success"></i>  '.$customuser->designation.'</div>';
               $response .= '</div>';
               $response .= '</li>';

            }            

         }

      }else{
         $response = 'empty';
      }

      return $response;
   } 
   public function fetch_people_starred_first_empid_with_filter($data)
   {           
      $login_id = Auth::user()->empID;      
      $check = PeopleStar::where('created_by', $login_id)->value('starred');
      // dd($check);

      if(!empty($check)){  

         $arrayStarred =json_decode($check);
         
         if($data['people_filter_dept'] == "All" && $data['people_filter_design'] == "All" && $data['people_filter_location'] == "All"){
            
            if(!empty($arrayStarred[0])){ 
               $response = $arrayStarred[0];
            }else{
               $response = 'empty';
            }       

         }elseif($data['people_filter_dept'] != "All" && $data['people_filter_design'] != "All" && $data['people_filter_location'] == "All"){

            $filter_arrayStarred = array();

            foreach($arrayStarred as $star_arr){
               
               $customusers = DB::table("customusers")->where('empID', $star_arr)->where('department', $data['people_filter_dept'])->where('designation', $data['people_filter_design'])->value('empID');
               if(!empty($customusers)){          
                  array_push($filter_arrayStarred, $star_arr);
               }
            }
            if(!empty($filter_arrayStarred[0])){ 
               $response = $filter_arrayStarred[0];
            }else{
               $response = 'empty';
            }  
            
         }elseif($data['people_filter_dept'] == "All" && $data['people_filter_design'] != "All" && $data['people_filter_location'] != "All"){
         
            $filter_arrayStarred = array();

            foreach($arrayStarred as $star_arr){
               
               $customusers = DB::table("customusers")->where('empID', $star_arr)->where('designation', $data['people_filter_design'])->where('worklocation', $data['people_filter_location'])->value('empID');
               if(!empty($customusers)){          
                  array_push($filter_arrayStarred, $star_arr);
               }
            }
            if(!empty($filter_arrayStarred[0])){ 
               $response = $filter_arrayStarred[0];
            }else{
               $response = 'empty';
            }  
            
         
         }elseif($data['people_filter_dept'] != "All" && $data['people_filter_design'] == "All" && $data['people_filter_location'] != "All"){
         
            $filter_arrayStarred = array();

            foreach($arrayStarred as $star_arr){
               
               $customusers = DB::table("customusers")->where('empID', $star_arr)->where('department', $data['people_filter_dept'])->where('worklocation', $data['people_filter_location'])->value('empID');
               if(!empty($customusers)){          
                  array_push($filter_arrayStarred, $star_arr);
               }
            }
            if(!empty($filter_arrayStarred[0])){ 
               $response = $filter_arrayStarred[0];
            }else{
               $response = 'empty';
            }  
            
         }elseif($data['people_filter_dept'] != "All" && $data['people_filter_design'] != "All" && $data['people_filter_location'] != "All"){
            
            $filter_arrayStarred = array();

            foreach($arrayStarred as $star_arr){
               
               $customusers = DB::table("customusers")->where('empID', $star_arr)->where('department', $data['people_filter_dept'])->where('designation', $data['people_filter_design'])->where('worklocation', $data['people_filter_location'])->value('empID');
               if(!empty($customusers)){          
                  array_push($filter_arrayStarred, $star_arr);
               }
            }
            if(!empty($filter_arrayStarred[0])){ 
               $response = $filter_arrayStarred[0];
            }else{
               $response = 'empty';
            }  
            

         }else{

           
            if($data['people_filter_dept'] != "All" && $data['people_filter_design'] == "All" && $data['people_filter_location'] == "All"){  
               
               $filter_arrayStarred = array();

               foreach($arrayStarred as $star_arr){
                  
                  $customusers = DB::table("customusers")->where('empID', $star_arr)->where('department', $data['people_filter_dept'])->value('empID');
                  if(!empty($customusers)){          
                     array_push($filter_arrayStarred, $star_arr);
                  }
               }
               if(!empty($filter_arrayStarred[0])){ 
                  $response = $filter_arrayStarred[0];
               }else{
                  $response = 'empty';
               }  

            }elseif($data['people_filter_dept'] == "All" && $data['people_filter_design'] == "All" && $data['people_filter_location'] != "All"){  
               
               $filter_arrayStarred = array();

               foreach($arrayStarred as $star_arr){
                  
                  $customusers = DB::table("customusers")->where('empID', $star_arr)->where('worklocation', $data['people_filter_location'])->value('empID');
                  if(!empty($customusers)){          
                     array_push($filter_arrayStarred, $star_arr);
                  }
               }
               if(!empty($filter_arrayStarred[0])){ 
                  $response = $filter_arrayStarred[0];
               }else{
                  $response = 'empty';
               }  

            }elseif($data['people_filter_dept'] == "All" && $data['people_filter_design'] != "All" && $data['people_filter_location'] == "All"){

               $filter_arrayStarred = array();

               foreach($arrayStarred as $star_arr){
                  
                  $customusers = DB::table("customusers")->where('empID', $star_arr)->where('designation', $data['people_filter_design'])->value('empID');
                  if(!empty($customusers)){          
                     array_push($filter_arrayStarred, $star_arr);
                  }
               }
               if(!empty($filter_arrayStarred[0])){ 
                  $response = $filter_arrayStarred[0];
               }else{
                  $response = 'empty';
               }  

            }
               
         }
         
      }else{
         $response = 'empty';
      }
      
      return $response;
   }
   public function fetch_people_starred_first_empid()
   {           
      $login_id = Auth::user()->empID;      
      $check = PeopleStar::where('created_by', $login_id)->value('starred');
      // dd($check);

      if(!empty($check)){         
         $arrayStarred =json_decode($check);
         
         if(!empty($arrayStarred[0])){ 
            $response = $arrayStarred[0];
         }else{
            $response = 'empty';
         }
      }else{
         $response = 'empty';
      }
      
      return $response;
   }
   public function fetch_people_everyone_first_empid()
   {           

      $customusers = DB::table("customusers")->value("empID");
      
      if(!empty($customusers)){         
         $response = $customusers;
      }else{
         $response = 'empty';
      }
      
      return $response;
   }   
   public function fetch_people_everyone_first_empid_with_filter($data)
   {           

      if($data['people_filter_dept'] == "All" && $data['people_filter_design'] == "All" && $data['people_filter_location'] == "All"){
         $customusers = DB::table("customusers")->value("empID");
      }elseif($data['people_filter_dept'] != "All" && $data['people_filter_design'] != "All" && $data['people_filter_location'] == "All"){
         $customusers = DB::table("customusers")->where('department', $data['people_filter_dept'])->where('designation', $data['people_filter_design'])->value("empID");
      }elseif($data['people_filter_dept'] == "All" && $data['people_filter_design'] != "All" && $data['people_filter_location'] != "All"){      
         $customusers = DB::table("customusers")->where('designation', $data['people_filter_design'])->where('worklocation', $data['people_filter_location'])->value("empID");      
      }elseif($data['people_filter_dept'] != "All"  && $data['people_filter_design'] == "All" && $data['people_filter_location'] != "All"){
         $customusers = DB::table("customusers")->where('department', $data['people_filter_dept'])->where('worklocation', $data['people_filter_location'])->value("empID");      
      }elseif($data['people_filter_dept'] != "All" && $data['people_filter_design'] != "All" && $data['people_filter_location'] != "All"){
         $customusers = DB::table("customusers")->where('department', $data['people_filter_dept'])->where('worklocation', $data['people_filter_location'])->where('designation', $data['people_filter_design'])->value("empID");
                  
      }else{
         if($data['people_filter_dept'] != "All" && $data['people_filter_design'] == "All" && $data['people_filter_location'] == "All"){
            $customusers = DB::table("customusers")->where('department', $data['people_filter_dept'])->value("empID");
         }elseif($data['people_filter_dept'] == "All" && $data['people_filter_design'] == "All" && $data['people_filter_location'] != "All"){
            $customusers = DB::table("customusers")->where('worklocation', $data['people_filter_location'])->value("empID");
         }elseif($data['people_filter_dept'] == "All" && $data['people_filter_design'] != "All" && $data['people_filter_location'] == "All"){
            $customusers = DB::table("customusers")->where('designation', $data['people_filter_design'])->value("empID");
         }
      }   

      // $customusers = DB::table("customusers")->first("empID");
      // dd($customusers);

      if(!empty($customusers)){         
         $response = $customusers;
      }else{
         $response = 'empty';
      }
      
      return $response;
   }
   public function fetch_people_list_filter($employee)
   {      
      $result = DB::table("customusers")->where('empID', $employee)->orwhere('username', $employee)->get();      
      if(!empty($result)){
         $response = $result;
      }else{
         $response = 'empty';
      }
      return $response;
   }
   public function fetch_people_list_filter_with_filter($data)
   {      
      if($data['people_filter_dept'] == "All" && $data['people_filter_design'] == "All" && $data['people_filter_location'] == "All"){
         $result = DB::table("customusers")->where('empID', $data['employee'])->orwhere('username', $data['employee'])->get();      
      }elseif($data['people_filter_dept'] != "All" && $data['people_filter_design'] != "All" && $data['people_filter_location'] == "All"){
         $result = DB::table("customusers")->where('empID', $data['employee'])->where('department', $data['people_filter_dept'])->where('designation', $data['people_filter_design'])->orwhere('username', $data['employee'])->get();      
      }elseif($data['people_filter_dept'] == "All" && $data['people_filter_design'] != "All" && $data['people_filter_location'] != "All"){
         $result = DB::table("customusers")->where('empID', $data['employee'])->where('designation', $data['people_filter_design'])->where('worklocation', $data['people_filter_location'])->orwhere('username', $data['employee'])->get();                  
      }elseif($data['people_filter_dept'] != "All" && $data['people_filter_design'] == "All" && $data['people_filter_location'] != "All"){
         $result = DB::table("customusers")->where('empID', $data['employee'])->where('department', $data['people_filter_dept'])->where('worklocation', $data['people_filter_location'])->orwhere('username', $data['employee'])->get();            
      }elseif($data['people_filter_dept'] != "All" && $data['people_filter_design'] != "All" && $data['people_filter_location'] != "All"){
         $result = DB::table("customusers")->where('empID', $data['employee'])->where('department', $data['people_filter_dept'])->where('worklocation', $data['people_filter_location'])->where('designation', $data['people_filter_design'])->orwhere('username', $data['employee'])->get();      
                  
      }else{

         if($data['people_filter_dept'] != "All" && $data['people_filter_design'] == "All" && $data['people_filter_location'] == "All"){
            $result = DB::table("customusers")->where('empID', $data['employee'])->where('department', $data['people_filter_dept'])->orwhere('username', $data['employee'])->get();      
         }elseif($data['people_filter_dept'] == "All" && $data['people_filter_design'] == "All" && $data['people_filter_location'] != "All"){
            $result = DB::table("customusers")->where('empID', $data['employee'])->where('worklocation', $data['people_filter_location'])->orwhere('username', $data['employee'])->get();      
         }elseif($data['people_filter_dept'] == "All" && $data['people_filter_design'] != "All" && $data['people_filter_location'] == "All"){
            $result = DB::table("customusers")->where('empID', $data['employee'])->where('designation', $data['people_filter_design'])->orwhere('username', $data['employee'])->get();      
         }

      }

      if(!empty($result[0])){
         $response = $result;              
      }else{
         $response = 'empty';         
      }
      // dd($response);

      return $response;
   }
   public function fetch_people_list_filter_starred_with_filter($data)
   {      
      $login_id = Auth::user()->empID;      
      $check = PeopleStar::where('created_by', $login_id)->value('starred');
      // dd($check);

      if(!empty($check)){         
         $arrayStarred =json_decode($check);
         
         if(($key = array_search($data['employee'], $arrayStarred)) !== false) {
            // dd("have");

            if($data['people_filter_dept'] == "All" && $data['people_filter_design'] == "All" && $data['people_filter_location'] == "All"){
               $result = DB::table("customusers")->where('empID', $data['employee'])->orwhere('username', $data['employee'])->get();      
            }elseif($data['people_filter_dept'] != "All" && $data['people_filter_design'] != "All" && $data['people_filter_location'] == "All"){
               $result = DB::table("customusers")->where('empID', $data['employee'])->where('department', $data['people_filter_dept'])->where('designation', $data['people_filter_design'])->orwhere('username', $data['employee'])->get();      
            
            }elseif($data['people_filter_dept'] == "All" && $data['people_filter_design'] != "All" && $data['people_filter_location'] != "All"){            
               $result = DB::table("customusers")->where('empID', $data['employee'])->where('designation', $data['people_filter_design'])->where('worklocation', $data['people_filter_location'])->orwhere('username', $data['employee'])->get();      
            
            }elseif($data['people_filter_dept'] != "All" && $data['people_filter_design'] == "All" && $data['people_filter_location'] != "All"){
               $result = DB::table("customusers")->where('empID', $data['employee'])->where('department', $data['people_filter_dept'])->where('worklocation', $data['people_filter_location'])->orwhere('username', $data['employee'])->get();      

            }elseif($data['people_filter_dept'] != "All" && $data['people_filter_design'] != "All" && $data['people_filter_location'] == "All"){
               $result = DB::table("customusers")->where('empID', $data['employee'])->where('department', $data['people_filter_dept'])->where('worklocation', $data['people_filter_location'])->where('designation', $data['people_filter_design'])->orwhere('username', $data['employee'])->get();                     
               
            }else{
               if($data['people_filter_dept'] != "All" && $data['people_filter_design'] == "All" && $data['people_filter_location'] == "All"){
                  $result = DB::table("customusers")->where('empID', $data['employee'])->where('department', $data['people_filter_dept'])->orwhere('username', $data['employee'])->get();      
               }elseif($data['people_filter_dept'] == "All" && $data['people_filter_design'] == "All" && $data['people_filter_location'] != "All"){
                  $result = DB::table("customusers")->where('empID', $data['employee'])->where('worklocation', $data['people_filter_location'])->orwhere('username', $data['employee'])->get();      
               }elseif($data['people_filter_dept'] == "All" && $data['people_filter_design'] != "All" && $data['people_filter_location'] == "All"){
                  $result = DB::table("customusers")->where('empID', $data['employee'])->where('designation', $data['people_filter_design'])->orwhere('username', $data['employee'])->get();      
               }
            }
      
            if(!empty($result[0])){
               $response = $result;              
            }else{
               $response = 'empty';         
            }

         }else{
            // dd("new");
            $response = 'empty';                     
         }

      }else{
         $response = 'empty';
      }
            
      return $response;
   }
   public function fetch_people_star_add($emp_id)
   {      
      $login_id = Auth::user()->empID;
      
      $check = PeopleStar::where('created_by', $login_id)->value('starred');
            
      //New entry
      if(!empty($check)){
         // dd($check);

         //delete element in array by value "un starred empID"
         $arrayStarred =json_decode($check);

         if(($key = array_search($emp_id, $arrayStarred)) !== false) {
            // dd("have");
            unset($arrayStarred[$key]);

            if(count($arrayStarred) == 0){
               $response = PeopleStar::where('created_by', $login_id)->delete();
            }else{
               $update_arrayStarred = array();

               foreach($arrayStarred as $value){            
                  
                  array_push($update_arrayStarred,$value);
   
               }
   
               // dd($update_arrayStarred);
   
               $response = PeopleStar::where('created_by', $login_id)
                                 ->update([
                                    'starred' => json_encode($update_arrayStarred)
                                 ]);
            }           

            $response = 'star_removed';

         }else{
            // dd("new");
            $arrayStarred =json_decode($check);
            array_push($arrayStarred,$emp_id);  

            // dd($arrayStarred);

            $response = PeopleStar::where('created_by', $login_id)
                              ->update([
                                 'starred' => json_encode($arrayStarred)
                              ]);
            $response = 'star_addded';
         }

                 
      }else{
         // dd("new entry empID");

         $arrayStarred = array();

         array_push($arrayStarred,$emp_id);

         // dd(json_encode($arrayStarred));
         
         $data = array(
            'created_by' => $login_id,
            'starred' => json_encode($arrayStarred),
         );

         $response = PeopleStar::insert($data);

         $response = 'star_addded';
      }
      
      return $response;
   }   
   public function fetch_people_list_filter_star($employee)
   {      
      $login_id = Auth::user()->empID;
      $check = PeopleStar::where('created_by', $login_id)->value('starred');
      $username = DB::table("customusers")->where('empID', $employee)->value('username');      
      $empID = DB::table("customusers")->where('empID', $employee)->value('empID');      
      
      // dd($employee['empID']);

      if(!empty($check)){
         
         $arrayStarred =json_decode($check);
         
         if(($key = array_search($employee, $arrayStarred)) !== false){
            // dd("have");
            $response = '<a href="javascript:void(0);" class="people_star_add" id="people_star_add" data-id="'.$empID.'"><i id="star_class_name" style="color: rgb(255, 199, 23);" class="fa fa-star star_class_name"></i></a>';
         }else{
            // dd("no");
            // $response = '<a href="javascript:void(0);" class="people_star_add" id="people_star_add" data-id="'.$employee.'" data-username="'.$username.'"><i id="star_class_name" class="fa fa-star star_class_name"></i></a>';
            $response = '<a href="javascript:void(0);" class="people_star_add" id="people_star_add" data-id="'.$empID.'"><i id="star_class_name" class="fa fa-star star_class_name"></i></a>';
         }

      }else{
         $response = '<a href="javascript:void(0);" class="people_star_add" id="people_star_add" data-id="'.$empID.'"><i id="star_class_name" class="fa fa-star star_class_name"></i></a>';
      }
      
      
      return $response;
   }
   public function fetch_people_list_filter_img($employee)
   {      
      // dd($employee);

      $profile_images = DB::table('images')->where('emp_id', $employee)->value('path');
      $gender = DB::table('customusers')->where('empID', $employee)->value('gender');

      if(!empty($profile_images)){
         $response = '<img class="img-50 user-image rounded-circle" src="../uploads/'.$profile_images.'" alt="#">';
      }else{

         if($gender == "Male"){
            $response = '<img style="width:50px;height:50px" class="rounded-circle" src="../assets/images/user/1.jpg" alt="">';
         }else{
            $response = '<img style="width:50px;height:50px" class="rounded-circle" src="../assets/images/user/4.jpg" alt="">';
         }

      }

      return $response;
   }
}

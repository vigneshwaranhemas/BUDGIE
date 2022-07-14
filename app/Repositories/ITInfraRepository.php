<?php
namespace App\Repositories;
use Illuminate\Support\Facades\DB;
use App\Models\CustomUser;
use App\Models\Email_InfoModel;
use App\Models\UsersInfoModel;
use App\Models\EmailCreationModel;
class ITInfraRepository implements IITInfraRepository {

public function get_candidate_email_info($data)
{
       $candidate_info=EmailCreationModel::join('customusers','customusers.empID','=','candidate_email_request.empID')
                       ->where('candidate_email_request.empID',$data['empID'])
                       ->select('customusers.username','customusers.email',
                                'customusers.doj','customusers.sup_name',
                                'customusers.sup_emp_code','customusers.contact_no',
                                'customusers.reviewer_emp_code','candidate_email_request.hr_suggested_mail',
                                'customusers.designation')
                       ->first();
       $info['supervisor_info']=CustomUser::where('empID',$candidate_info['sup_emp_code'])->select('email')->first();
       $info['reviewer_info']=CustomUser::where('empID',$candidate_info['reviewer_emp_code'])->select('email')->first();
       $info['email_info']=Email_InfoModel::where('header_id',5)->first();
       $info['candidate_info']=$candidate_info;
       return $info;
}

public function update_itInfra_EmailStatus($data)
{
        //    $result=EmailCreationModel::where('empID',$data['empID'])->update(['status'=>2,'hr_suggested_mail'=>$data['Email']]);
           $result=EmailCreationModel::where('empID',$data['empID'])->update(['status'=>2]);
           if($result){
               CustomUser::where('empID',$data['empID'])->update(['email'=>$data['Email']]);
           }
           return $result;
}
}

?>

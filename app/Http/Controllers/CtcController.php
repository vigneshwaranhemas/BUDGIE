<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Repositories\IGoalRepository;
use Illuminate\Support\Facades\DB;
use Yajra\DataTables\Facades\DataTables;
use Auth;
use Session;
use Mail;
use App\Models\CustomUser;
use PhpOffice\PhpSpreadsheet\Spreadsheet;
use PhpOffice\PhpSpreadsheet\Writer\Xlsx;
use Illuminate\Support\Facades\Crypt;

class CtcController extends Controller
{
    public function __construct(IGoalRepository $goal)
    {
        $this->middleware('is_admin');
        $this->goal = $goal;
        $this->middleware(function($request,$next){
              $session_val=Session::get('session_info');
              if($session_val=="" || $session_val === null){
                  return redirect('login');
              }
              else{
               return $next($request);
              }
        });
    }

    public function employee_ctc_pdf_create(Request $req)
    {

// echo'<pre>';print_r($req->all());die;

            /*ctc amount from tb*/
        $get_cs_pa = $req->input('or_closed_salary');

        $sc_basic_pa = round($get_cs_pa * 0.4);
        $sc_basic_pm = round($sc_basic_pa / 12);

        $sc_hra_pa = round($sc_basic_pa / 2);
        $sc_hra_pm = round($sc_hra_pa / 12);

        $sc_medical_allowance_pa = round(1250 * 12);
        $sc_medical_allowance_pm = "1250";

        $sc_conveyance_expence_pa = "19200";
        $sc_conveyance_expence_pm = round($sc_conveyance_expence_pa / 12);

        $sc_special_allowance_pa = 0;
        $sc_special_allowance_pm = 3729;
        
        $sc_monthly_gross_pm_a = round($sc_basic_pm + $sc_hra_pm + $sc_conveyance_expence_pm + $sc_special_allowance_pm + $sc_medical_allowance_pm);
        $sc_monthly_gross_pa_a = round($sc_basic_pa + $sc_hra_pa + $sc_conveyance_expence_pa + $sc_special_allowance_pa + $sc_medical_allowance_pa);

        $get_pf_eligible_amt = $sc_basic_pm + $sc_conveyance_expence_pm + $sc_medical_allowance_pm + $sc_special_allowance_pm;

        if ($get_pf_eligible_amt <= 15000)
        {
            $emp_pf_cont_pa = round($get_pf_eligible_amt * 12 * 0.12);
        }
        else
        {
            $emp_pf_cont_pa = round(15000 * 0.12);
        }

        $emp_pf_cont_pm = round($emp_pf_cont_pa / 12);

        if ($sc_monthly_gross_pm_a <= 21000)
        {
            $get_emp_esi_cont_pm = round($sc_monthly_gross_pm_a * 0.0325);
            $emp_esi_cont_pm = round($sc_monthly_gross_pm_a * 0.0325);
            $emp_esi_cont_pa = round($get_emp_esi_cont_pm * 12);

            $sub_total_b_pm = $emp_pf_cont_pm + $emp_esi_cont_pm;
            $sub_total_b_pa = $emp_pf_cont_pa + $emp_esi_cont_pa;
            $get_sub_total_b_pa = $emp_pf_cont_pa + $emp_esi_cont_pa;

        }
        else
        {
            $get_emp_esi_cont_pm = 0;

            $emp_esi_cont_pm = 0;
            $emp_esi_cont_pa = 0;

            $sub_total_b_pm = $emp_pf_cont_pm;
            $sub_total_b_pa = $emp_pf_cont_pa;

        }

        $gratity_pa = round((15 / 26) * $sc_basic_pm);
        $gratity_pm = round($gratity_pa / 12);

        $bonus_pa = "9820";
        $bonus_pm = round($bonus_pa / 12);

        $sub_total_c_pm = round($gratity_pm + $bonus_pm);
        $sub_total_c_pa = round($gratity_pa + $bonus_pa);

        $abc_ctc_pm = round($sc_monthly_gross_pm_a + $sub_total_b_pm + $sub_total_c_pm);
        $abc_ctc_pa = round($sc_monthly_gross_pa_a + $sub_total_b_pa + $sub_total_c_pa);

        /*==*/
        if ($abc_ctc_pa < $get_cs_pa)
        {
            $get_sa_dif = $get_cs_pa - $abc_ctc_pa;
            $sc_special_allowance_pa = $get_sa_dif;
            $sc_monthly_gross_pa_a = round($sc_basic_pa + $sc_hra_pa + $sc_conveyance_expence_pa + $sc_special_allowance_pa + $sc_medical_allowance_pa);

            $abc_ctc_pa = round($sc_monthly_gross_pa_a + $sub_total_b_pa + $sub_total_c_pa);
            $sc_special_allowance_pm = round($sc_special_allowance_pa / 12);

            $get_pf_eligible_amt = $sc_basic_pm + $sc_conveyance_expence_pm + $sc_medical_allowance_pm + $sc_special_allowance_pm;

            
            if ($get_pf_eligible_amt <= 15000)
            {
                $emp_pf_cont_pa = round($get_pf_eligible_amt * 12 * 0.12);
            }
            else
            {
                $emp_pf_cont_pa = round(15000 * 0.12);
            }
    
            $emp_pf_cont_pm = round($emp_pf_cont_pa / 12);

            $sc_monthly_gross_pm_a = round($sc_basic_pm + $sc_hra_pm + $sc_conveyance_expence_pm + $sc_special_allowance_pm + $sc_medical_allowance_pm);

            // repeat the process
            if ($sc_monthly_gross_pm_a <= 21000)
            {
                $emp_esi_cont_pm = round($sc_monthly_gross_pm_a * 0.0325);
                $emp_esi_cont_pa = round($get_emp_esi_cont_pm * 12);
                
                $sub_total_b_pm = $emp_pf_cont_pm + $emp_esi_cont_pm;
                $sub_total_b_pa = $get_sub_total_b_pa;
                
            }
            else
            {
                $emp_esi_cont_pm = 0;
                $emp_esi_cont_pa = 0;

                $sub_total_b_pm = $emp_pf_cont_pm;
                $sub_total_b_pa = $emp_pf_cont_pa;

            }

            $abc_ctc_pm = round($sc_monthly_gross_pm_a + $sub_total_b_pm + $sub_total_c_pm);
            $abc_ctc_pa = round($sc_monthly_gross_pa_a + $sub_total_b_pa + $sub_total_c_pa);

        }
        
        if ($emp_esi_cont_pm >= 1)
        {
            $n23 = ($sc_monthly_gross_pm_a * 0.0075);
        }
        else
        {
            $n23 = 0;
        }
        
        $n25 = (($sc_monthly_gross_pm_a - $emp_pf_cont_pm) - $n23);
       
        $n26 = ($n25 - 208);
        
        $netpay = round($n26);

        $amount_in_words = $this->convert_number($req->input('or_closed_salary'));

        $cur_date = date('d-m-Y');
        $accept_end_date = date('F d, Y', strtotime($cur_date) + (24 * 3600 * 3));

        $session_user_details = auth()->user();
        $or_recruiter_name = $session_user_details->name;
        $or_recruiter_email = $session_user_details->email;
        $or_recruiter_mobile_no = $session_user_details->mobile_no;

        // get buddy info
        $input_details_bi = array(
            'buddy_id' => $req->input('welcome_buddy_id') ,
        );

        $get_buddy_result = $this
            ->corepo
            ->get_buddy_details($input_details_bi);

        $or_buddy_name = $get_buddy_result[0]->name;
        $or_buddy_email = $get_buddy_result[0]->email;
        $or_buddy_mobile_no = $get_buddy_result[0]->mobile_no;

        $closed_salary_tb = $this->moneyFormatIndia($req->input('or_closed_salary'));

        $logo_path = public_path('assets/images/logo/logo_bk.jpg');

        $user_details = auth()->user();
        $created_by = $user_details->empID;

        $ctc_calculation_data =[
            'cdID' => $req->input('cdID'), 
            'basic_pm' => $sc_basic_pm, 
            'basic_pa' => $sc_basic_pa, 
            'hra_pm' => $sc_hra_pm, 
            'hra_pa' => $sc_hra_pa, 
            'medi_al_pm' => $sc_medical_allowance_pm, 
            'medi_al_pa' => $sc_medical_allowance_pa, 
            'conv_pm' => $sc_conveyance_expence_pm, 
            'conv_pa' => $sc_conveyance_expence_pa, 
            'spl_al_pm' => $sc_special_allowance_pm, 
            'spl_al_pa' => $sc_special_allowance_pa, 
            'comp_a_pm' => $sc_monthly_gross_pm_a, 
            'comp_a_pa' => $sc_monthly_gross_pa_a, 
            'ec_pf_pm' => $emp_pf_cont_pm, 
            'ec_pf_pa' => $emp_pf_cont_pa, 
            'ec_esi_pm' => $emp_esi_cont_pm, 
            'ec_esi_pa' => $emp_esi_cont_pa, 
            'sub_totalb_pm' => $sub_total_b_pm, 
            'sub_totalb_pa' => $sub_total_b_pa, 
            'gratuity_pm' => $gratity_pm, 
            'gratuity_pa' => $gratity_pa, 
            'st_bonus_pm' => $bonus_pm, 
            'st_bonus_pa' => $bonus_pa, 
            'sub_totalc_pm' => $sub_total_c_pm, 
            'sub_totalc_pa' => $sub_total_c_pa, 
            'abc_pm' => $abc_ctc_pm, 
            'abc_pa' => $abc_ctc_pa, 
            'net_pay' => $netpay, 
            'created_by' => $created_by, 
            'modified_by' => $created_by, 

        ];
        
        // check record already exits

        $path = public_path().'/offer_letter/'.$req->input('cdID');
        File::isDirectory($path) or File::makeDirectory($path, 0777, true, true);

        $check_ctc_calc_result = $this->recrepo->check_ctc_calc( $input_details_cd );

        if($check_ctc_calc_result ==0){

            $insert_ctc_calc_result = $this->recrepo->insert_ctc_calc( $ctc_calculation_data );

        }else{
            if (\File::exists($path)) \File::deleteDirectory($path);

            $update_ctc_calc_result = $this->recrepo->update_ctc_calc( $ctc_calculation_data );

        }

        $data = [
            'date' => date('d-m-Y') , 
            'logo_path' => $logo_path, 
            'amount_in_words' => $amount_in_words, 
            'position_title' => $get_tblrfh_result[0]->position_title, 
            'join_date' => date("d-m-Y", strtotime($req->input('or_doj'))) ,
            'rfh_no' => $get_candidate_details_result[0]->hepl_recruitment_ref_number, 
            'closed_salary' => $closed_salary_tb, 
            'candidate_name' => $get_candidate_details_result[0]->candidate_name, 
            'location' => $get_tblrfh_result[0]->location, 
            'business' => $get_tblrfh_result[0]->business,
            'function' => $get_tblrfh_result[0]->function, 
            'band_title' => $get_tblrfh_result[0]->band_title,
            'sc_basic_pm' => $this->moneyFormatIndia($sc_basic_pm) , 
            'sc_basic_pa' => $this->moneyFormatIndia($sc_basic_pa) , 
            'sc_hra_pm' => $this->moneyFormatIndia($sc_hra_pm) , 
            'sc_hra_pa' => $this->moneyFormatIndia($sc_hra_pa) , 
            'sc_conveyance_expence_pm' => $this->moneyFormatIndia($sc_conveyance_expence_pm) , 
            'sc_conveyance_expence_pa' => $this->moneyFormatIndia($sc_conveyance_expence_pa) , 
            'sc_medical_allowance_pm' => $this->moneyFormatIndia($sc_medical_allowance_pm) , 
            'sc_medical_allowance_pa' => $this->moneyFormatIndia($sc_medical_allowance_pa) , 
            'sc_special_allowance_pm' => $this->moneyFormatIndia($sc_special_allowance_pm) , 
            'sc_special_allowance_pa' => $this->moneyFormatIndia($sc_special_allowance_pa) , 
            'sc_monthly_gross_pm' => $this->moneyFormatIndia($sc_monthly_gross_pm_a) , 
            'sc_monthly_gross_pa' => $this->moneyFormatIndia($sc_monthly_gross_pa_a) , 
            'emp_pf_cont_pm' => $this->moneyFormatIndia($emp_pf_cont_pm) , 
            'emp_pf_cont_pa' => $this->moneyFormatIndia($emp_pf_cont_pa) , 
            'emp_esi_cont_pm' => $this->moneyFormatIndia($emp_esi_cont_pm), 
            'emp_esi_cont_pa' => $this->moneyFormatIndia($emp_esi_cont_pa), 
            'sub_total_b_pm' => $this->moneyFormatIndia($sub_total_b_pm) , 
            'sub_total_b_pa' => $this->moneyFormatIndia($sub_total_b_pa) , 
            'bonus_pm' => $this->moneyFormatIndia($bonus_pm) , 
            'bonus_pa' => $this->moneyFormatIndia($bonus_pa) , 
            'gratity_pm' => $this->moneyFormatIndia($gratity_pm) , 
            'gratity_pa' => $this->moneyFormatIndia($gratity_pa) , 
            'sub_total_c_pm' => $this->moneyFormatIndia($sub_total_c_pm) , 
            'sub_total_c_pa' => $this->moneyFormatIndia($sub_total_c_pa) , 
            'abc_ctc_pm' => $this->moneyFormatIndia($abc_ctc_pm) , 
            'abc_ctc_pa' => $this->moneyFormatIndia($abc_ctc_pa) , 
            'netpay' => $this->moneyFormatIndia($netpay) , 
            'or_recruiter_name' => $or_recruiter_name, 
            'or_recruiter_email' => $or_recruiter_email, 
            'or_recruiter_mobile_no' => $or_recruiter_mobile_no, 
            'or_buddy_name' => $or_buddy_name, 
            'or_buddy_email' => $or_buddy_email, 
            'or_buddy_mobile_no' => $or_buddy_mobile_no, 
            'accept_end_date' => $accept_end_date,
            'department' => $req->input('or_department'),

        ];
        
        $pdf = PDF::loadView('offer_letter_pdf', $data);
        // $path = public_path('offer_letter/');

        $path = public_path().'/offer_letter/'.$req->input('cdID');
        File::isDirectory($path) or File::makeDirectory($path, 0777, true, true);


        $fileName = time() . '.' . 'pdf';
        $pdf->save($path . '/' . $fileName);


        return 'offer_letter/'.$req->input('cdID').'/'.$fileName;

    }

}

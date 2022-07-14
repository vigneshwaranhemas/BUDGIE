@extends('layouts.simple.candidate_master')
@section('title', 'Welcome Aboard')

@section('css')
<link rel="stylesheet" type="text/css" href="../assets/css/prism.css">
    <!-- Plugins css start-->
<link rel="stylesheet" type="text/css" href="../assets/css/chartist.css">
<link rel="stylesheet" type="text/css" href="../assets/css/date-picker.css">

@endsection

@section('style')
<style>
    .card-body p{
        margin-bottom: 3% !important;
        font-size: 15px !important;
    }
    .card-body td{
        margin-bottom: 3% !important;
        font-size: 15px !important;
        padding-bottom: 43px;
        padding-left: 0px;
    }
    .card-body h5{
        margin-bottom: 3% !important;
    }

    /* input field css start*/
    .input {
    background-color: transparent;
    border: none;
    border-bottom: 1px solid #ccc;
    color: #555;
    box-sizing: border-box;
    font-family: "Arvo";
    font-size: 18px;
    width: 200px;
    color: #008CBA;
    }

    input::-webkit-input-placeholder {
    color: #aaa;
    }

    input:focus::-webkit-input-placeholder {
    color: dodgerblue;
    }

    .input:focus + .underline {
    transform: scale(1);
    }
    /* input field css end*/

    .table td
    {
        border-top: none !important;
    }

    .editor
    {
        margin-left: -49px;
        margin-top: -58px;
    }

    .interesting_facts
    {
        width: 70%;
    }
    .text-warning
    {
        color: #ff0000!important;
    }


</style>
@endsection

@section('breadcrumb-title')
	<h2>Welcome Aboard<span> </span></h2>
@endsection

@section('breadcrumb-items')
    <a href="{{ url('welcome_aboard') }}"><button class="btn btn-primary" type="button">Add Welcome Aboard</button></a>
   {{-- <li class="breadcrumb-item">Dashboard</li>
	<li class="breadcrumb-item active">Default</li> --}}
@endsection

@section('content')

  <!-- Container-fluid starts-->
  <div class="container-fluid">
    <div class="row">
      <div class="col-sm-12">
          <form method="POST" action="javascript:void(0);" id="add_welcome_aboard">
            <div class="card">
                <div class="card-body">

                    <p style="text-align: justify;">Dear Newbie at HEMA’s!  We are delighted that you are onboard our inspiring HEMA’s bandwagon and we would like to share the joy with all our team mates!  Please help us with interesting information about you, which you would like our HEMA’s Fraternity Fellas to know. </p>

                    <p style="text-align: justify;">Here’s a template which could be of help to you, to introduce yourself. Disclosing of Facts in this Sheet is entirely Voluntary.You may choose to answer/omit any queries listed in the DID YOU KNOW Section.</p>

                    <p>I <input class="input" type="text" name="name" id="name" placeholder="Enter Your Name" required readonly> have joined as <input type="text" class="input" name="designation" id="designation" placeholder="Enter Your Designation" readonly>at <input class="input" type="text" name="department" id="department" placeholder="Enter Your Department" readonly>            today      /     on <input class="input" type="date" name="today_date" id="today_date" placeholder="Choose The Date" readonly>    </p>


                    <h5><b>EDUCATION (in chronological order, starting from the oldest to the latest)</b></h5>
                    <table class="table" id="education-tb">
                        <thead>
                        </thead>
                        <tbody>
                            <tr id="did_my">
                                {{-- <td>I did my <input class="input" type="text" name="did_my" id="did_my">
                                from <input class="input" type="text" name="did_from" id="did_from">
                                in <input class="input" type="text" name="did_in" id="did_in"></td> --}}

                            </tr>
                        </tbody>
                    </table>

                    <h5 style="margin-top: 37px;"><b>My Achievements in Education,which I’d like my peers to know : </b></h5>

                        <div class="card-body editor">
                            <div id="achievements_education" name="achievements_education">

                            </div>
                        </div>

                    <h5><b>WORK EXPERIENCE  (in chronological order, starting from the oldest to the latest) </b></h5>

                    <p>I Started my professional Career in <input class="input" type="text" name="work_in" id="work_in" readonly> and as<input class="input" type="text" name="work_designation" id="work_designation" readonly> (designation) and worked there for about<input class="input" type="text" name="work_years" id="work_years" readonly> Years  and </p>

                    <table class="table" id="work-tb">
                        <thead>
                            {{-- <tr>
                                <button class="btn btn-primary" type="button" id="add_worked_more" style="margin-bottom: 25px;" onclick="additional_work();">Add More</button>
                            </tr> --}}
                        </thead>
                        <tbody>
                            <tr id="work_experience">
                                {{-- <td>I worked at <input class="input" type="text" name="work_experience_at[]" id="work_experience_at"> as <input class="input" type="text" name="work_experience_as[]" id="work_experience_as"> for about <input class="input" type="text" name="work_experience_years[]" id="work_experience_years"> years</td> --}}
                            </tr>
                        </tbody>
                    </table>

                    <p style="margin-top: 33px;">My Recent Work Experience before Joining HEMA’s was at <input class="input" type="text" name="joining_at" id="joining_at" readonly> As<input class="input" type="text" name="joining_as" id="joining_as" readonly>  </p>

                    <h5><b>My Achievements at Work , which I’d like my peers to know : </b></h5>

                        <div class="card-body editor">
                            <div name="achievements_work" id="achievements_work">

                            </div>
                        </div>

                    <h5><b>DID YOU KNOW SECTION: </b></h5>

                    <h5><b>Some Interesting facts about me, on the personal front, which I’d like to share with my peers : </b></h5>

                    <p>My favorite pastime/ pursuits <input class="input" type="text" name="my_favorite_pastime" id="my_favorite_pastime" readonly>  </p>
                    <p>My favorite hobbies <input class="input" type="text" name="my_favorite_hobbies" id="my_favorite_hobbies" readonly>  </p>
                    <p>Three places Id love to visit <input class="input" type="text" name="my_favorite_places" id="my_favorite_places" readonly>  </p>
                    <p>Three Foods I relish <input class="input" type="text" name="my_favorite_foods" id="my_favorite_foods" readonly>  </p>
                    <p>My Favorite Sports <input class="input" type="text" name="my_favorite_sports" id="my_favorite_sports" readonly>  </p>
                    <p>My Favorite Movies <input class="input" type="text" name="my_favorite_movies" id="my_favorite_movies" readonly>  </p>
                    <p>My Favorite <input class="input" type="text" name="my_favorite" id="my_favorite" readonly>  </p>
                    <p>My Extracurricular Specialities  <input class="input" type="text" name="my_extracurricular_specialities" id="my_extracurricular_specialities" readonly> </p>
                    <p>My Career Aspirations <input class="input" type="text" name="my_career_aspirations" id="my_career_aspirations" readonly>  </p>
                    <p>I can speak these Languages fluently <input class="input" type="text" name="languages" id="languages" readonly>  </p>
                    <p>Some Interesting Facts about me that my peers can know! <input class="input interesting_facts" type="text" name="interesting_facts" id="interesting_facts" readonly>  </p>
                    <p>My Motto ! <input class="input" type="text" name="my_motto" id="my_motto" readonly>  </p>
                    <p>Books that I Read / Love to Recommend <input class="input" type="text" name="books" id="books" readonly>  </p>

                    <div class="text-center">
                        <a href="{{url('welcome_aboard_generate_pdf')}}" target="_blank"><button class="btn btn-primary" type="button" id="pdf_button">Download</button></a>
                    </div>

                </div>
            </div>
        </form>
      </div>
    </div>
  </div>
  <!-- Container-fluid Ends-->

@endsection

@section('script')

<script src="../assets/pro_js/view_welcome_aboard.js"></script>

<script>
var add_welcome_aboard_process_link = "{{url('add_welcome_aboard_process')}}";
var get_welcome_aboard_details_link = "{{url('get_welcome_aboard_details')}}";
</script>
@endsection

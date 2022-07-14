<?php
// echo json_encode(count($get_education_my)); die();

?>

<!DOCTYPE html>
<html lang="en">
  <head>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="Poco admin is super flexible, powerful, clean &amp; modern responsive bootstrap 4 admin template with unlimited possibilities.">
    <meta name="keywords" content="admin template, Poco admin template, dashboard template, flat admin template, responsive admin template, web app (Laravel 8)">
    <meta name="author" content="pixelstrap">
    <meta name="csrf-token" content="{{ csrf_token() }}" />
    <link rel="icon" href="../assets/images/favicon.png" type="image/x-icon">
    <link rel="shortcut icon" href="../assets/images/favicon.png" type="image/x-icon">
    <title>Welcome Aboard</title>
    @include('layouts.simple.css')

<link rel="stylesheet" type="text/css" href="../assets/css/prism.css">
    <!-- Plugins css start-->
<link rel="stylesheet" type="text/css" href="../assets/css/chartist.css">
<link rel="stylesheet" type="text/css" href="../assets/css/date-picker.css">

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
    width: 150px;
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
    h2{
        text-align: center;
    }
    .answer
    {
        /* font-style: italic; */
        font-weight: bold;
        color: #008CBA;
    }


</style>

</head>
<body>
  <!-- Container-fluid starts-->
  <div class="container-fluid">
    <div class="row">
      <div class="col-sm-12">
            <div class="card">
                <div class="card-body">

                    <h2>Welcome Aboard<span> </span></h2>

                    <p style="text-align: justify;">Dear Newbie at HEMA’s!  We are delighted that you are onboard our inspiring HEMA’s bandwagon and we would like to share the joy with all our team mates!  Please help us with interesting information about you, which you would like our HEMA’s Fraternity Fellas to know. </p>

                    <p style="text-align: justify;">Here’s a template which could be of help to you, to introduce yourself. Disclosing of Facts in this Sheet is entirely Voluntary.You may choose to answer/omit any queries listed in the DID YOU KNOW Section.</p>

                    <p>I <span class="answer">{{$info['name']}}</span> have joined as <span class="answer">{{$info['designation']}}</span> at <span class="answer">{{$info['department'] }}</span>            today      /     on <span class="answer">{{$info['today_date'] }}</span> (strike off which is irrelevant)</p>

                    <h5><b>EDUCATION (in chronological order, starting from the oldest to the latest)</b></h5>
                    <table class="table" id="education-tb">
                        <thead>
                        </thead>
                        <tbody>
                            <tr>
                            <table>
                                <tbody>
                                    <?php $i=0; ?>
                                    @foreach ($info['get_education_my'] as $link)
                                    <tr>
                                        <td>I did my <span class="answer">{{ $link }}</span> from <span class="answer">{{$info['get_education_from'][$i] }}</span> in <span class="answer">{{$info['get_education_in'][$i] }}</span><td>
                                    </tr>
                                    <?php $i++;?>
                                    @endforeach
                                </tbody>
                            </table>
                            </tr>
                        </tbody>
                    </table>

                    <h4 style="margin-top: -10px;"><b>My Achievements in Education,which I’d like my peers to know : </b></h4>

                        <div class="card-body editor">
                            <div id="achievements_education" name="achievements_education" style="margin-left: 50px; margin-top: 10px;">
                                <p class="answer">{{ $info['achievements_education'] }}</p>
                            </div>
                        </div>

                    <h5><b>WORK EXPERIENCE  (in chronological order, starting from the oldest to the latest) </b></h5>

                    <p>I Started my professional Career in <span class="answer">{{$info['work_in'] }}</span> and as <span class="answer">{{$info['work_designation'] }}</span> (designation) and worked there for about <span class="answer">{{$info['work_years'] }}</span> Years  and </p>

                    <table class="table" id="work-tb">
                        <thead>
                        </thead>
                        <tbody>
                            <tr>
                            <table>
                                <tbody>
                                    <?php $i=0; ?>
                                    @foreach ($info['work_experience_at'] as $link)
                                    <tr>
                                        <td>I did my <span class="answer">{{ $link }}</span> from <span class="answer">{{$info['work_experience_as'][$i] }}</span> in <span class="answer">{{$info['work_experience_years'][$i] }}</span><td>
                                    </tr>
                                    <?php $i++;?>
                                    @endforeach
                                </tbody>
                            </table>
                            </tr>
                        </tbody>
                    </table>

                    <p style="margin-top: -10px;">My Recent Work Experience before Joining HEMA’s was at <span class="answer">{{$info['joining_at'] }}</span> As <span class="answer">{{$info['joining_as'] }}</span> </p>

                    <h4><b>My Achievements at Work , which I’d like my peers to know : </b></h4>

                        <div class="card-body editor">
                            <div name="achievements_work" id="achievements_work" style="margin-left: 50px; margin-top: 10px;">
                                <p class="answer">{{ $info['achievements_work'] }}</p>
                            </div>
                        </div>

                    <h5><b>DID YOU KNOW SECTION: </b></h5>

                    <h4><b>Some Interesting facts about me, on the personal front, which I’d like to share with my peers : </b></h4>

                    <p>My favorite pastime/ pursuits <span class="answer">{{$info['my_favorite_pastime'] }}</span> </p>
                    <p>My favorite hobbies <span class="answer">{{$info['my_favorite_hobbies'] }}</span> </p>
                    <p>Three places Id love to visit <span class="answer">{{$info['my_favorite_places'] }}</span>  </p>
                    <p>Three Foods I relish <span class="answer">{{$info['my_favorite_foods'] }}</span> </p>
                    <p>My Favorite Sports <span class="answer">{{$info['my_favorite_sports'] }}</span>  </p>
                    <p>My Favorite Movies <span class="answer">{{$info['my_favorite_movies'] }}</span>  </p>
                    <p>My Favorite <span class="answer">{{$info['my_favorite'] }}</span>  </p>
                    <p>My Extracurricular Specialities  <span class="answer">{{$info['my_extracurricular_specialities'] }}</span> </p>
                    <p>My Career Aspirations <span class="answer">{{$info['my_career_aspirations'] }}</span> </p>
                    <p>I can speak these Languages fluently <span class="answer">{{$info['languages'] }}</span> </p>
                    <p>Some Interesting Facts about me that my peers can know! <span class="answer">{{$info['interesting_facts'] }}</span>  </p>
                    <p>My Motto ! <span class="answer">{{$info['my_motto'] }}</span> </p>
                    <p>Books that I Read / Love to Recommend <span class="answer">{{$info['books'] }}</span>  </p>

                </div>
            </div>
      </div>
    </div>
  </div>
  <!-- Container-fluid Ends-->

</body>
</html>

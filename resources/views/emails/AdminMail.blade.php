<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
</head>
<body>

      {{-- @if ($worklocation=="Onsite")
                <p><b>Dear Team,</b></p>

                <p>Please note that {{$candidate_name}}is joining with HEPL in {{$candidate_department}}" team.</p>
                <p>Please take advise of Supervisor - "{{$supervisor_name}}." to allot system / laptop for them. </p>
                <p> Date of joining that is "{{$candidate_doj}}".</p>
                <p>Kindly let me know once completed.</p>

                <p><b>Thank you,</b></p>
                <p>HR OP.S Team - HEPL";</p>
      @else --}}
                <p><b>Dear Team,</b></p>

                {{-- <p>Please note that {{$candidate_name}}is joining with HEPL in {{$candidate_department}}" team and is Working From Home.</p>
                <p>Please take advise of Supervisor - "{{$supervisor_name}}." to hand hold them for setting up MS OUTLOOK </p>
                <p>account and TEAMS account on their date of joining that is "{{$candidate_doj}}".</p>
                <p>Kindly let me know once completed.</p> --}}


                <p>Please note that {{$candidate_name}}is joining with HEPL in {{$candidate_department}}" team.</p>
                <p>Please take advise of Supervisor - "{{$supervisor_name}}." </p>
                <p> to allot seat for them before his/her Date of Joining that is "{{$candidate_doj}}".</p>
                <p>Kindly let me know once completed.</p>

                <p><b>Thank you,</b></p>
                <p>HR OP.S Team - HEPL</p>
      {{-- @endif --}}


</body>
</html>

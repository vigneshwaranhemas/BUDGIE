@foreach($sticky_note as $note)
    <div id="stickyBox_{{$note->id}}" class="col-md-12 sticky-note"  style='margin-top: 12px;'>
        <div class="well
             @if($note->color == 'red')
                bg-danger
             @endif
        @if($note->color == 'green')
                bg-success
             @endif
        @if($note->color == 'yellow')
                bg-warning
             @endif
        @if($note->color == 'blue')
                bg-info
             @endif
        @if($note->color == 'purple')
                bg-primary
             @endif
                b-none">
            <p  style='padding-top: 24px; margin-left: 24px;'>{!! nl2br($note->Notes)  !!}</p>
            <hr>
            <div class="row font-12">
                <div class="col-xs-9"  style='margin-left: 39px;margin-bottom: 17px;'>
                    Updated: {{ $Time->diffForHumans($note->updated_at,true)." ".'ago' }}
                </div>
                <div class="col-xs-3" style="margin-left: 38px;">
                    <a href="javascript:;"  onclick="showEditNoteModal({{$note->id}})"><i class="fa fa-pencil text-white"></i></a>
                    <a href="javascript:;" class="m-l-5" onclick="deleteSticky({{$note->id}})" ><i class="fa fa-trash text-white"></i></a>
                </div>
            </div>
        </div>
    </div>
@endforeach





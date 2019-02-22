@foreach(['success','danger','warning','info'] as $status)
    @if(session()->has($status))
        <div class="alert alert-{{$status}} alert-dismissible" role="alert">
            <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
            <strong>{{session('success')}}</strong>
        </div>
    @endif
@endforeach
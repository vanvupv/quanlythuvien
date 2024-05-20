@if(Session::has('message'))
    <div class= "@if(session('status') == 200) alert alert-primary @else alert alert-danger @endif"  role="alert">
        {{session('message')}}
    </div>
@endif



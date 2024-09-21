@extends('user.main.main')

@section('user-content')
<div class="container">
  @if (Session::has('success'))
  <div class="alert alert-success" role="alert" id="success-message">
      {{Session::get('success')}}
  </div>
  @endif

  @if(session('fail'))        
    <div class="alert alert-danger" id="error-message">
        {{session('fail')}}
    </div>          
  @endif
</div>

<script>
   setTimeout(function() {
        $('#success-message').fadeOut('fast')
    },4000);

    setTimeout(function() {
        $('#error-message').fadeOut('fast')
    },4000);
</script>
@endsection
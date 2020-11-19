@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header">Dashboard</div>

                    <div class="card-body">
                        @if (session('status'))
                            <div class="alert alert-success" role="alert">
                                {{ session('status') }}
                            </div>
                        @endif

                        You are logged in!
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script type="application/javascript">
      $.post('/logo', {
        /*company: {
          'id_number': '5687445795478'
        },*/
        // 'id_number': '587445795478',
        "_token": "{{ csrf_token() }}"
      }, function(data){
        if (data.success){
          // window.location = '/login';
        }
      }, 'json');
    </script>
@endsection

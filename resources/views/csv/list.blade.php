@extends('admin.layouts.app')
@section('content')

<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card" style="width: 40rem;">
                <div class="card-header">
                    Generated Zip File Lists
                    <a href="/choose-date"><button class="btn-success btn-small float-right">Generate zip</button></a>
                </div>
                <ul class="list-group list-group-flush">
                @foreach($ziplists as $ziplist)
                    <li class="list-group-item"><a href="download/{{trim($ziplist->filename,'download/')}}">{{trim($ziplist->filename,'download/')}}</a>
                    <a href="{{route('removefile',[$ziplist->id,trim($ziplist->filename,'download/')])}}"><button class="btn-danger btn-small">Delete</button></a>
                    </li>
                    
                @endforeach
                </ul>
            </div>
            <div class="col-md-4 my-4">
            {{ $ziplists->links() }}
            </div>
            
        </div>
        
   </div>
  
</div>

@endsection

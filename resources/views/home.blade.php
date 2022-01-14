<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Todo list</title>
    <link rel="stylesheet" href="{{asset('css/mycss.css')}}">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
    <link rel="stylesheet" href="https://pro.fontawesome.com/releases/v5.10.0/css/all.css" integrity="sha384-AYmEC3Yw5cVb3ZcuHtOA93w35dYTsvhLPVnYs9eStHfGJvOvKxVfELGroGkvsg+p" crossorigin="anonymous"/>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js" integrity="sha256-/xUj+3OJU5yExlq6GSYGSHk7tPXikynS7ogEvDej/m4=" crossorigin="anonymous"></script>
</head>
<body class="bg-info">
  <div class="container pt-5">
     <div class="card shadow-sm">
         <div class="card-body">
             <h3 class="TitleMain">To-do list</h3>
             <form action="{{ route('store')}}" method="Post" autocomplete="off">
                 @csrf
                 <div class="input-group">
                     <input type="text" name="content" class="form-control" placeholder="Add Your Todo">
                            <button class="btn btn-primary" type="submit">Add</button>
                 </div>

             </form>
             @if(count($todolists ) > 0)
             <ul class="list-group list-group-flush mt-3">
                    @foreach($todolists as $todolist)
                    
                    <form action="{{ route('destroy', $todolist->id)}}" method="Post" autocomplete="off">
                    <div class="input-group mt-2">
                        @csrf
                        @method('DELETE')
                        @if($todolist->completed)
                        <input  style="background-color:green; color:white;text-decoration: line-through;" id="namid" type="text" name="content" class="form-control" value="{{ $todolist->content }}" disabled>
                        <button class="btn btn-danger float-end" onclick="return confirm('Are you sure?')"  type="submit">Delete</button>
                       
                
            @else 
            <input type="text" id="namid" name="content" class="form-control" value="{{ $todolist->content }}" disabled>
            <button class="btn btn-danger float-end" onclick="return confirm('Are you sure?')" type="submit">Delete</button>
            @endif
            <a class="btn btn-warning" href="{{asset('/' . $todolist->id . '/completed')}}">Completed</a>
                        </div>
                    </form>
                    
                </li>
                    @endforeach
             </ul>
             @else
             <p class="text-center mt-3">No tasks</p>
                @endif
          </div>
          {{ $todolists->links() }}
          @if (count($todolists))
           <div class="card-footer"> 
                You have {{ $todolists->count() }} tasks on page 
                
            </div>
          @endif
          <div class="flash-message">
    @foreach (['danger', 'warning', 'success', 'info'] as $msg)
      @if(Session::has('alert-' . $msg))

      <p class="alert alert-{{ $msg }}">{{ Session::get('alert-' . $msg) }} <a href="/" class="close" data-dismiss="alert" aria-label="close">&times;</a></p>
      @endif
    @endforeach
  </div> <!-- end .flash-message -->
        </div>
    </div>
    <script>
$(".flash-message").slideDown(500, function(){
    setTimeout(function(){
$(".flash-message").slideUp(500);  
},2000);
});
    </script>
    
    @include('sweetalert::alert') 
</body>
<script src="https://cdnjs.cloudflare.com/ajax/libs/sweetalert/1.1.3/sweetalert.min.js" integrity="sha512-7VTiy9AhpazBeKQAlhaLRUk+kAMAb8oczljuyJHPsVPWox/QIXDFOnT9DUk1UC8EbnHKRdQowT7sOBe7LAjajQ==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p" crossorigin="anonymous"></script>
</html>
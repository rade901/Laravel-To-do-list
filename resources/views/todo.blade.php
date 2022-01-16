@extends('layouts.master')
@section('title', 'Todo')
@section('content')
<main>
  <div class="d-flex flex-column flex-shrink-0 p-3 text-white bg-dark" style="width: 280px;">
    <a href="/" class="d-flex align-items-center mb-3 mb-md-0 me-md-auto text-white text-decoration-none">
      <svg class="bi me-2" width="40" height="32">
        <use xlink:href="#bootstrap" />
      </svg>
      <span class="fs-4">Learning</span>
    </a>
    <hr>
    <ul class="nav nav-pills flex-column mb-auto">
      <li class="nav-item">
        <a href="/" class="nav-link active" aria-current="page">
          <svg class="bi me-2" width="16" height="16">
            <use xlink:href="#home" />
          </svg>
          Home
        </a>
      </li>
      <li>
        <a href="/todo" class="nav-link text-white">
          <svg class="bi me-2" width="16" height="16">
            <use xlink:href="#grid" />
          </svg>
          To-do list
        </a>
      </li>
    </ul>
    <!--<hr>
    <div class="dropdown">
      <a href="#" class="d-flex align-items-center text-white text-decoration-none dropdown-toggle" id="dropdownUser1" data-bs-toggle="dropdown" aria-expanded="false">
        <img src="https://www.cae.net/wp-content/uploads/2015/11/consejos-sacar-maximo-partido-elearning.jpg" alt="" width="32" height="32" class="rounded-circle me-2">
        <strong>mdo</strong>
      </a>
      <ul class="dropdown-menu dropdown-menu-dark text-small shadow" aria-labelledby="dropdownUser1">
        <li><a class="dropdown-item" href="#">New project...</a></li>
        <li><a class="dropdown-item" href="#">Settings</a></li>
        <li><a class="dropdown-item" href="#">Profile</a></li>
        <li>
          <hr class="dropdown-divider">
        </li>
        <li><a class="dropdown-item" href="#">Sign out</a></li>
      </ul>
    </div>
-->
</div>
  <div class="container pt-5 overflow-auto" >
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
              <div class="form-control" style="background-color:green; color:white;text-decoration: line-through;">{{$todolist->content}}</div>
              <button class="btn btn-danger float-end" onclick="return confirm('Are you sure?')" type="submit">Delete</button>


              @else
              @if(str_starts_with($todolist->content, 'http'))
              <div class="form-control"><a target="about:blank" href="{{ $todolist->content }}">{{$todolist->content}}</a></div>
              @else
              <div class="form-control">{{ $todolist->content }}</div>
              @endif
              <button class="btn btn-danger float-end" onclick="return confirm('Are you sure?')" type="submit">Delete</button>
              @endif
              <a class="btn btn-warning" href="{{asset('/todo' . $todolist->id . '/completed')}}">Completed</a>
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
      @endif
      </div>
      <div class="flash-message">
        @foreach (['danger', 'warning', 'success', 'info'] as $msg)
        @if(Session::has('alert-' . $msg))

        <p class="alert alert-{{ $msg }}">{{ Session::get('alert-' . $msg) }} <a href="/" class="close" data-dismiss="alert" aria-label="close">&times;</a></p>
        @endif
        @endforeach
      </div> <!-- end .flash-message -->
      </div>
    </div>
</main>

@endsection
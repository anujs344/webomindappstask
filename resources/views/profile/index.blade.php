@include('header')
@include('profile.layouts.navbar')

<br>
<button type="button" class="btn btn-primary" data-toggle="modal" data-target="#exampleModal" data-whatever="@mdo">Add Post</button>

<div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">New message</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <form method="POST" action="{{route('createpost')}}" enctype="multipart/form-data">
            @csrf
          <div class="form-group">
            <label for="recipient-name" class="col-form-label">Title:</label>
            <input type="text" class="form-control" id="recipient-name" name="title">@error('title')
                {{$message}}
            @enderror
          </div>
          <div class="form-group">
            <label for="message-text" class="col-form-label">Description:</label>
            <textarea class="form-control" id="message-text" name="desc"></textarea>@error('desc')
            {{$message}}
        @enderror
          </div>
          <div class="form-group">
            <label for="message-text" class="col-form-label">Image:</label>
            <input type="file" class="form-control" id="recipient-name" name="image">@error('image')
            {{$message}}
        @enderror

          </div>
          <div class="modal-footer">
            <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
            <button type="submit" class="btn btn-primary">Submit</button>
          </div>
        </form>
      </div>
      
    </div>
  </div>
</div>
<br><br>

@foreach ($post as $item)
<div class="card" style="width: 18rem;">
    <img class="card-img-top" src="{{asset('posts').'/'.$item->image}}" alt="Card image cap" width="200px" height="200px">
    <div class="card-body">
      <h5 class="card-title">{{$item->title}}</h5>
      <p class="card-text">{{$item->desc}}.</p>
    </div>
    <div class="card-body">
        <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#exampleModal2" data-whatever="@mdo" style="display:inline;">Edit</button>

        <div class="modal fade" id="exampleModal2" tabindex="-1" role="dialog" aria-labelledby="exampleModal2Label" aria-hidden="true">
          <div class="modal-dialog" role="document">
            <div class="modal-content">
              <div class="modal-header">
                <h5 class="modal-title" id="exampleModal2Label">New message</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                  <span aria-hidden="true">&times;</span>
                </button>
              </div>
              <div class="modal-body">
                <form method="POST" action="{{route('updatepost')}}" enctype="multipart/form-data">
                    @csrf
                    <input name="id" value="{{$item->id}}" type="hidden">
                  <div class="form-group">
                    <label for="recipient-name" class="col-form-label">Title:</label>
                    <input type="text" class="form-control" id="recipient-name" name="title" value="{{$item->title}}">@error('title')
                        {{$message}}
                    @enderror
                  </div>
                  <div class="form-group">
                    <label for="message-text" class="col-form-label">Description:</label>
                    <textarea class="form-control" id="message-text" name="desc" >{{$item->desc}}</textarea>@error('desc')
                    {{$message}}
                @enderror
                  </div>
                  <div class="form-group">
                    <img src="{{asset('posts').'/'.$item->image}}" width="200px"  height="100px">
                    <label for="message-text" class="col-form-label">Image:</label>
                    <input type="file" class="form-control" id="recipient-name" name="image">@error('image')
                    {{$message}}
                @enderror
        
                  </div>
                  <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                    <button type="submit" class="btn btn-primary">Submit</button>
                  </div>
                </form>
              </div>
              
            </div>
          </div>
        </div>
        <form action="{{route('deletepost')}}" method="POST" style="display:inline;">
            @csrf
            <input type="hidden" name="id" value="{{$item->id}}">
            <button type="submit" class="btn btn-danger">Delete</button>
        </form>
    </div>
  </div>    
@endforeach

@include('footer')
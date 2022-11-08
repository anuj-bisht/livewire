<div style="text-align: center">
    @error('newComment')
    {{$message}}
    @enderror
    <form wire:submit.prevent="addComment">
    <input type="text" placeholder="Add comment" wire:model.debounce.500ms="newComment">
    {{-- 1000ms kai baad ajax request send kraiga --}}
    <input type="text" placeholder="Add name" wire:model.lazy="newName">
    {{-- input field sai focus htnai kai baad ajax request send kraiga --}}

    {{-- <button wire:click="addComment">Add Button</button><br> --}}
    <button type="submit" >Add Button</button><br>
   {{-- <div style="color:red;">{{$message}}</div> --}}


@if(session()->has('message'))
{{session('message')}}
@endif


    </form>
    <div class="container ">
        <div class="row mt-2">

                @foreach ($data as $comment)
                <div class="col-sm-4">
                <div class="card " style="width: 18rem;">
                    <div class="card-body">
                      <h6 class="card-subtitle mb-2 text-muted">{{$comment->creator->name}}</h6>
                      <p class="card-text">{{$comment->body}}</p>
                      <a href="#" class="card-link">{{$comment->created_at->diffForHumans()}}</a>
                    </div>
                    <i class="fa-solid fa-xmark" wire:click="remove({{$comment->id}})"></i>
                  </div>
                </div>

                @endforeach
                {{$data->links()}}

        </div>
    </div>


    {{-- <button wire:click="decrement">-</button> --}}

</div>

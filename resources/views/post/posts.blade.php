@extends('dashboard')
@section('content')

    <div class="overflow-x-auto ml-10 ">
        <div class="flex justify-between mb-4">
            @if (Auth::user()->role == '0')
                <button onclick="window.location.href='{{ route('postAdd') }}'"
                    class="btn btn-outline btn-success btn-sm ">Add
                    Post</button>
            @endif

            <div class="flex">
                <form action="postsFilter" method="post" class="flex">
                    @csrf
                    <div class=" mb-3 form-control">
                        <label style="width: 300px;height:30px" class="input-group" for="inputGroupSelect01">
                            <span>Category</span>
                            <select style="width: 200px;height:30px" name='role' class="input input-bordered"
                                id="inputGroupSelect01">
                                <option class="text-black" style="width: 300px;" selected disabled>Category</option>
                                @if ($categories->count())
                                    @foreach ($categories as $country)
                                        <option class="text-black" value="{{ $country->id }}">{{ $country->name }}</option>
                                    @endForeach
                                @else
                                    No Record Found
                                @endif
                            </select>
                        </label>
                    </div>
                    <div>
                        <button class="btn btn-info btn-xs" type="submit">Filter</button>
                    </div>
                </form>

            </div>
        </div>
        {{-- <table class="table table-compact w-full">
                    <!-- head -->
                    <thead>
                        <tr>
                            <th>Author</th>
                            <th>Category</th>
                            <th>Title</th>
                            <th>Desciption</th>
                            <th>Operation</th>


                        </tr>
                    </thead>
                    <tbody>
                        <!-- row 1 -->
                        @foreach ($posts as $user)
                            <tr>
                                <td>
                                    <div>
                                        <div class="font-bold">{{ $user->author_name }}</div>
                                    </div>
                                </td>
                                <td>
                                    <div>
                                        <div class="font-bold">{{ $user->category_name }}</div>
                                    </div>
                                </td>
                                <td>
                                    <div>
                                        <div class="font-bold">{!! Str::words("$user->title", 3, ' ...') !!}</div>
                                    </div>
                                </td>
                                <td>
                                    <div>
                                        <div class="font-bold">{!! Str::words("$user->description", 3, ' ...') !!}</div>
                                    </div>
                                </td>
                                <th>

                                    @if (Auth::user()->role == '0')
                                        <button onclick="window.location.href='{{ route('postDetails', $user->id) }}'"
                                            class="btn btn-info btn-xs">Details</button>
                               </div>
            <button onclick="window.location.href='{{ route('postEdit', $user->id) }}'"
                class="btn btn-secondary btn-xs">Edit</button></div>
            <button onclick="window.location.href='{{ route('postDelete', $user->id) }}'"
                class="btn btn-error btn-xs">Delete</button></div>
        @elseif (Auth::user()->role == '1')
            <button onclick="window.location.href='{{ route('postDetails', $user->id) }}'"
                class="btn btn-info btn-xs">Details</button>
        @else
            <button onclick="window.location.href='{{ route('postDetails', $user->id) }}'"
                class="btn btn-info btn-xs">Details</button>
            @endif
            </th>

            </tr>
            @endforeach


            </tbody>

            </table> --}}
            @if (Auth::user()->role == '0' || Auth::user()->role == '2')
        <div class="flex flex-wrap ">
            @foreach ($posts as $user)
                <div class="card w-96 bg-primary text-dark-content m-4">
                    <div class="card-body  ">
                       <div >
                        <h2 style="color:rgb(170, 25, 25)" class="card-title">Title : {!! Str::words("$user->title", 8, ' ..') !!}</h2>
                        <h4 style="" >Author : {{ $user->author_name }}</h4>
                        <h4 style="color:red" >Category : {{ $user->category_name }}</h4>
                       </div>
                        <p style="font-family:Papyrus,fantasy" class="text-center">Description </p>
                        <p style="">{!! Str::words("$user->description", 20, ' ..') !!}</p>
                                    <div class="flex justify-around mt-3">
                                     @if (Auth::user()->role == '0')
                                    <button onclick="window.location.href='{{ route('postDetails', $user->id) }}'"
                                        class="btn btn-secondary btn-xs">Details</button>
                                    
                                    <button onclick="window.location.href='{{ route('postEdit', $user->id) }}'"
                                     class="btn btn-accent btn-xs">Edit</button>
                                    
                                    <button onclick="window.location.href='{{ route('postDelete', $user->id) }}'"
                                     class="btn btn-error btn-xs">Delete</button>
                                     <button id="toggleButton"  onclick="toggleButtonClicked('{{$user->isapproved}}' , '{{$user->id}}')">
                                        {{ $user->isapproved == '1' ? 'Approved' : 'Not Approved' }}
                                    </button>
                                    @elseif (Auth::user()->role == '1')
                                    <button onclick="window.location.href='{{ route('postDetails', $user->id) }}'"
                                     class="btn btn-secondary btn-xs">Details</button>
                                     @else
                                     <button onclick="window.location.href='{{ route('postDetails', $user->id) }}'"
                                     class="btn btn-secondary btn-xs">Details</button>
                                     @endif  
                      
                        
                                    </div>
               </div>
             </div>
          @endforeach
    </div>
   
    @elseif(Auth::user()->role == '1' )
    <div class="flex flex-wrap ">
            @foreach ($posts as $user)
              @if($user->isapproved == '1')
                <div class="card w-96 bg-primary text-dark-content m-4">
                    <div class="card-body  ">
                       <div >
                        <h2 style="color:rgb(170, 25, 25)" class="card-title">Title : {!! Str::words("$user->title", 8, ' ..') !!}</h2>
                        <h4 style="" >Author : {{ $user->author_name }}</h4>
                        <h4 style="color:red" >Category : {{ $user->category_name }}</h4>
                       </div>
                        <p style="font-family:Papyrus,fantasy" class="text-center">Description </p>
                        <p style="">{!! Str::words("$user->description", 20, ' ..') !!}</p>
                                    <div class="flex justify-around mt-3">
                                     @if (Auth::user()->role == '0')
                                    <button onclick="window.location.href='{{ route('postDetails', $user->id) }}'"
                                        class="btn btn-secondary btn-xs">Details</button>
                                    
                                    <button onclick="window.location.href='{{ route('postEdit', $user->id) }}'"
                                     class="btn btn-accent btn-xs">Edit</button>
                                    
                                    <button onclick="window.location.href='{{ route('postDelete', $user->id) }}'"
                                     class="btn btn-error btn-xs">Delete</button>
                                     <button id="toggleButton"  onclick="toggleButtonClicked('{{$user->isapproved}}' , '{{$user->id}}')">
                                        {{ $user->isapproved == '1' ? 'Approved' : 'Not Approved' }}
                                    </button>
                                    @elseif (Auth::user()->role == '1')
                                    <button onclick="window.location.href='{{ route('postDetails', $user->id) }}'"
                                     class="btn btn-secondary btn-xs">Details</button>
                                     @else
                                     <button onclick="window.location.href='{{ route('postDetails', $user->id) }}'"
                                     class="btn btn-secondary btn-xs">Details</button>
                                     @endif  
                      
                        
                                    </div>
               </div>
              @endif 
             </div>
          @endforeach
    </div>
    @endif 
    </div>
      
@endsection

<script src="https://cdn.jsdelivr.net/npm/axios/dist/axios.min.js"></script>
<script>
    // JavaScript code to handle toggle functionality
    function toggleButtonClicked(isapproved , id){
        let toggleButton = document.getElementById('toggleButton');
    let isEnabled = isapproved ;
    let postId =id;
    console.log(isEnabled , postId);
    if(isEnabled == '1' )
    {
        isEnabled = '0';
    }
    else{
        isEnabled = '1';
    }
    console.log('after change' , isEnabled)
   
        // Implement AJAX request here to update the value on the server
        // For example, using fetch or jQuery.ajax

        // Sample fetch request
        axios.post(`/update-toggle/${postId}`, { isEnabled: isEnabled })
            .then(response => {
                const toggleButton = document.getElementById('toggleButton');
               
                toggleButton.textContent = response.data == 1 ? 'Approved' : 'Not Approved';
                window.location.reload();
            })
            .catch(error => {
                console.error('There was a problem with the request:', error);
            });

    }
</script>
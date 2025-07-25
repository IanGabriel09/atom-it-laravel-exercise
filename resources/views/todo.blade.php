@extends('_layouts.app')

{{-- Page internal styles --}}
@section('internal-styles')
    <style>
        .ribbon {
            width: 80px;
            height: 80px;
            overflow: hidden;
            position: absolute;
            top: -5px;
            right: -5px;
            z-index: 1;
        }

        .ribbon span {
            position: absolute;
            display: block;
            width: 120px;
            padding: 5px 0;
            background-color: gray;
            color: white;
            text-align: center;
            font-size: 12px;
            transform: rotate(45deg);
            top: 20px;
            right: -25px;
            box-shadow: 0 2px 6px rgba(0,0,0,0.15);
        }

        .ribbon.done span {
            background-color: #28a745;
        }
    </style>
@endsection

{{-- Page content --}}
@section('content')
    <div class="container">
        <h1>To-Do List</h1>

        @include('_components.nav')

        @if(session('message'))
            <div class="alert alert-secondary alert-dismissible fade show w-50" role="alert" id="flashMessage">
                {{ session('message') }}
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
        @endif

        {{-- Create New Post --}}
        <div class="card shadow-sm mb-5">
            <div class="card-header bg-primary text-white">Create New Task</div>
            <div class="card-body">
                <form action="{{ route('todo.store') }}" method="POST">
                    @csrf
                    <div class="mb-3">
                        <label class="form-label">Title</label>
                        <input type="text" name="title" class="form-control" placeholder="Enter post title" required>
                    </div>
                    <div class="mb-3">
                        <label class="form-label">Content</label>
                        <textarea name="content" rows="5" class="form-control" placeholder="Write your content here..." required></textarea>
                    </div>

                    <div class="text-center">
                        <button type="submit" class="btn btn-success">Add Post</button>
                    </div>
                    
                </form>
            </div>
        </div>

        {{-- List Existing todo --}}
        <div class="row">
            @foreach ($tasks as $task)
                <div class="col-lg-4 col-md-6 col-sm-12 mb-4">
                    <div class="card h-100 shadow-sm position-relative">
                        @if ($task->status === 'done')
                            <div class="ribbon done"><span>Done</span></div>
                        @else
                            <div class="ribbon"><span>Pending</span></div>
                        @endif
                        <div class="card-body d-flex flex-column">
                            <h5 class="card-title">{{ $task->title }}</h5>

                            <small class="text-muted mb-2">
                                Created: {{ $task->created_at->format('M d, Y - h:i A') }}
                                @if ($task->updated_at != $task->created_at)
                                    <br>Updated at: {{ $task->updated_at->format('M d, Y - h:i A') }}
                                @endif
                            </small>

                            {{-- Update Form --}}
                            <form action="{{ route('todo.update', $task->id) }}" method="POST" class="mb-3 mt-auto">
                                @csrf
                                <div class="mb-2">
                                    <label class="form-label">Edit Title</label>
                                    <input type="text" name="title" value="{{ $task->title }}" class="form-control" required>
                                </div>
                                <div class="mb-2">
                                    <label class="form-label">Edit Content</label>
                                    <textarea name="content" rows="4" class="form-control" required>{{ $task->content }}</textarea>
                                </div>
                                <button type="submit" class="btn btn-sm btn-outline-primary w-100">Update</button>
                            </form>

                            {{-- Delete Form --}}
                            <form action="{{ route('todo.destroy', $task->id) }}" method="POST">
                                @csrf
                                <button type="submit" class="btn btn-sm btn-outline-danger w-100">Delete</button>
                            </form>

                            <hr>
                            <form action="{{ route('todo.declare', $task->id) }}" method="POST">
                                @csrf
                                <div class="text-end">
                                    @if($task->status === 'not-done')
                                        <button type="submit" class="btn btn-success">Done</button>
                                    @else
                                        <button type="submit" class="btn btn-secondary">Not Done</button>
                                    @endif
                                    
                                </div>
                                
                            </form>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>

    </div>
@endsection

{{-- Page scripts --}}
@section('scripts')
    <script>
        $(document).ready(function () {
            setTimeout(function () {
                $('#flashMessage').fadeOut('slow');
            }, 4000); // 4000ms = 4 seconds

            // Intercept all form submissions
            $('form').on('submit', function (e) {
                const confirmed = confirm('Are you sure you want to proceed?');
                if (!confirmed) {
                    e.preventDefault(); // Cancel form submission
                }
            });
        });
    </script>
@endsection
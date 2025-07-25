@php
    $currentRoute = Route::currentRouteName();
@endphp

<div class="my-3">
    <div class="d-flex justify-content-between">
        <div>
            <a href="{{ route('hello.world') }}"
            class="btn {{ $currentRoute === 'hello.world' ? 'btn-secondary' : 'btn-outline-secondary' }}">
                Hello World
            </a>

            <a href="{{ route('todo.main') }}"
            class="btn {{ $currentRoute === 'todo.main' ? 'btn-secondary' : 'btn-outline-secondary' }}">
                To-Do App
            </a>

            <a href="{{ route('books.spa') }}"
            class="btn {{ $currentRoute === 'books.spa' ? 'btn-secondary' : 'btn-outline-secondary' }}">
                Book Manager
            </a>
        </div>

        <div>
            <a href="{{ route('auth.signOut') }}" class="btn btn-outline-danger">Logout</a>
        </div>

    </div>

</div>

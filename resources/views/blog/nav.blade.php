<div class="nav-scroller py-1 mb-2">
    <nav class="nav d-flex justify-content-between">
        @php
        $head = \Illuminate\Support\Facades\Request::segment(2);
        $url = \Illuminate\Support\Facades\Request::url();
        @endphp
        @foreach($categories as $c)
            <a class="p-2 link-secondary text-capitalize" href='{{ $head == 'detail' ?  "$url/?category=$c->slug" : "/?category=$c->slug" }}'>{{ $c->title }}</a>
        @endforeach
    </nav>

</div>

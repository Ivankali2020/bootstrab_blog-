

<li class="menu-item">
    <a href="{{ $link }}" class="menu-item-link text-capitalize
    {{ \Illuminate\Support\Facades\Request::url() == $link ? 'active' : $link }}">
    <span>
       <i class="{{ $class }} fa-1x mr-3 fa-fw"></i>
        {{ $name }}
    </span>
        @if( $count >= 1 )
         <span class="badge badge-pill badge-light">
            {{ $count }}
        </span>

        @endif
    </a>
</li>

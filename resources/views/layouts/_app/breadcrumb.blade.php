{{-- <ol class="breadcrumb d-md-flex d-none">
    <li class="breadcrumb-item">
        <i class="bi bi-house"></i>
        <a href="index.html">Home</a>
    </li>
    <li class="breadcrumb-item breadcrumb-active" aria-current="page">Sales</li>
</ol> --}}

@if (count($breadcrumbs))

    <ol class="breadcrumb d-md-flex d-none">
        @foreach ($breadcrumbs as $breadcrumb)

            @if ($breadcrumb->url && !$loop->last)
                <li class="breadcrumb-item">
                    <a href="{{ $breadcrumb->url }}">{{ $breadcrumb->title }}</a>
                </li>
            @else
                <li class="breadcrumb-item active">{{ $breadcrumb->title }}</li>
            @endif

        @endforeach
    </ol>

@endif
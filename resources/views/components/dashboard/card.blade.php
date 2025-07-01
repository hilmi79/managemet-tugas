@props(['title', 'value', 'color', 'icon'])

<div class="col-md-4">
    <div class="card border-0 shadow-sm h-100">
        <div class="card-body d-flex align-items-center justify-content-between">
            <div>
                <h6 class="text-muted">{{ $title }}</h6>
                <h2 class="fw-bold text-{{ $color }}">{{ $value }}</h2>
            </div>
            <i class="{{ $icon }} fs-1 text-{{ $color }}"></i>
        </div>
    </div>
</div>

<div class="card">
    <div class="card-body">
        <a href="{{ route('product.show', $product->slug) }}">
            <img src="{{ $product->image }}" alt="{{ $product->title }}" class="img-fluid">
        </a>
        <h4 class="mt-4">
            <a href="{{ route('product.show', $product->slug) }}">{{ $product->title }}</a>
        </h4>
        <p>{{ $product->description }}</p>
    </div>
</div>

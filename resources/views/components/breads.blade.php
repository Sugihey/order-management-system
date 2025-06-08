@props([
    'scheme' => '',
    'nodes' => [],
    'current' => '',
])
<div class="mb-4">
    <x-link :scheme="$scheme" :href="route($scheme=='scraft'?'dashboard':'artisan.dashboard')">ダッシュボード</x-link>
    @foreach ($nodes as $node)
        &gt; <x-link :scheme="$scheme" :href="route($node['route'])">{{ $node['title'] }}</x-link>
    @endforeach
    &gt; {{ $current }}
</div>
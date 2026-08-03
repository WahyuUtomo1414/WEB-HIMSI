@props(['socials' => [], 'size' => 'md', 'variant' => 'default'])

@php
    $normalized = [];

    if (is_array($socials)) {
        foreach ($socials as $key => $item) {
            $platform = null;
            $url = null;

            if (is_array($item)) {
                $platform = $item['platform'] ?? $key;
                $url = $item['url'] ?? $item['value'] ?? null;
            } elseif (is_string($item)) {
                $platform = is_numeric($key) ? 'link' : $key;
                $url = $item;
            }

            if (! empty($url) && trim($url) !== '') {
                $platformKey = strtolower(trim((string) $platform));
                $normalized[] = [
                    'platform' => $platformKey,
                    'url' => trim($url),
                ];
            }
        }
    }

    $sizeClasses = [
        'sm' => 'h-8 w-8 text-xs',
        'md' => 'h-10 w-10 text-sm',
        'lg' => 'h-12 w-12 text-base',
    ][$size] ?? 'h-10 w-10 text-sm';

    $iconSizes = [
        'sm' => 'w-4 h-4',
        'md' => 'w-5 h-5',
        'lg' => 'w-6 h-6',
    ][$size] ?? 'w-5 h-5';
@endphp

@if (count($normalized) > 0)
    <div {{ $attributes->merge(['class' => 'flex flex-wrap items-center gap-2.5']) }}>
        @foreach ($normalized as $item)
            @php
                $p = $item['platform'];
                $url = $item['url'];
                if ($p === 'email' && ! str_starts_with($url, 'mailto:') && filter_var($url, FILTER_VALIDATE_EMAIL)) {
                    $fullUrl = 'mailto:' . $url;
                } elseif (($p === 'wa' || $p === 'whatsapp') && ! str_starts_with($url, 'http') && is_numeric(preg_replace('/[^0-9]/', '', $url))) {
                    $fullUrl = 'https://wa.me/' . preg_replace('/[^0-9]/', '', $url);
                } else {
                    $fullUrl = str_starts_with($url, 'http') || str_starts_with($url, 'mailto:') ? $url : 'https://' . $url;
                }
            @endphp

            <a href="{{ $fullUrl }}" 
               target="_blank" 
               rel="noopener noreferrer" 
               title="{{ ucfirst($p) }}"
               class="{{ $sizeClasses }} rounded-xl flex items-center justify-center transition-all duration-300 shadow-xs hover:scale-110
               @if ($variant === 'footer')
                   bg-white/10 hover:bg-[#356ee7] text-white hover:shadow-lg
               @elseif ($variant === 'contact')
                   bg-white border border-[#c5c5d4]/60 text-[#001b79] hover:bg-[#001b79] hover:text-white hover:border-[#001b79] shadow-sm
               @else
                   bg-[#f0f4ff] hover:bg-[#001b79] text-[#0453cd] hover:text-white border border-[#356ee7]/20 shadow-xs
               @endif">

                @if ($p === 'instagram')
                    <!-- Instagram Icon -->
                    <svg class="{{ $iconSizes }}" fill="none" stroke="currentColor" viewBox="0 0 24 24" stroke-width="2">
                        <rect x="2" y="2" width="20" height="20" rx="5" ry="5"/>
                        <path d="M16 11.37A4 4 0 1112.63 8 4 4 0 0116 11.37z"/>
                        <line x1="17.5" y1="6.5" x2="17.51" y2="6.5"/>
                    </svg>
                @elseif ($p === 'email')
                    <!-- Email Icon -->
                    <svg class="{{ $iconSizes }}" fill="none" stroke="currentColor" viewBox="0 0 24 24" stroke-width="2">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M21.75 6.75v10.5a2.25 2.25 0 01-2.25 2.25h-15a2.25 2.25 0 01-2.25-2.25V6.75m19.5 0A2.25 2.25 0 0019.5 4.5h-15a2.25 2.25 0 00-2.25 2.25m19.5 0v.243a2.25 2.25 0 01-1.07 1.916l-7.5 4.615a2.25 2.25 0 01-2.36 0L3.32 8.91a2.25 2.25 0 01-1.07-1.916V6.75"/>
                    </svg>
                @elseif ($p === 'linkedin')
                    <!-- LinkedIn Icon -->
                    <svg class="{{ $iconSizes }}" fill="currentColor" viewBox="0 0 24 24">
                        <path d="M19 3a2 2 0 0 1 2 2v14a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2V5a2 2 0 0 1 2-2h14m-.5 15.5v-5.3a3.26 3.26 0 0 0-3.26-3.26c-.85 0-1.84.52-2.28 1.3v-1.11h-2.79v8.37h2.79v-4.93c0-.77.62-1.4 1.39-1.4a1.4 1.4 0 0 1 1.4 1.4v4.93h2.75M6.88 8.56a1.68 1.68 0 0 0 1.68-1.68c0-.93-.75-1.69-1.68-1.69a1.69 1.69 0 0 0-1.69 1.69c0 .93.76 1.68 1.69 1.68m1.39 9.94v-8.37H5.5v8.37h2.77z"/>
                    </svg>
                @elseif ($p === 'tiktok')
                    <!-- TikTok Icon -->
                    <svg class="{{ $iconSizes }}" fill="currentColor" viewBox="0 0 24 24">
                        <path d="M16.6 5.82A4.28 4.28 0 0 1 15.54 3h-3.09v12.4a2.59 2.59 0 1 1-2.59-2.5 2.5 2.5 0 0 1 1.09.25V9.92a5.64 5.64 0 0 0-1.09-.1 5.68 5.68 0 1 0 5.68 5.68V9.33a7.35 7.35 0 0 0 4.26 1.36V7.58a4.27 4.27 0 0 1-3.2-1.76z"/>
                    </svg>
                @elseif ($p === 'youtube')
                    <!-- YouTube Icon -->
                    <svg class="{{ $iconSizes }}" fill="currentColor" viewBox="0 0 24 24">
                        <path d="M23.498 6.186a3.016 3.016 0 0 0-2.122-2.136C19.505 3.545 12 3.545 12 3.545s-7.505 0-9.377.505A3.017 3.017 0 0 0 .502 6.186C0 8.07 0 12 0 12s0 3.93.502 5.814a3.016 3.016 0 0 0 2.122 2.136c1.871.505 9.376.505 9.376.505s7.505 0 9.377-.505a3.015 3.015 0 0 0 2.122-2.136C24 15.93 24 12 24 12s0-3.93-.502-5.814zM9.545 15.568V8.432L15.818 12l-6.273 3.568z"/>
                    </svg>
                @elseif ($p === 'facebook')
                    <!-- Facebook Icon -->
                    <svg class="{{ $iconSizes }}" fill="currentColor" viewBox="0 0 24 24">
                        <path d="M22 12c0-5.52-4.48-10-10-10S2 6.48 2 12c0 4.84 3.44 8.87 8 9.8V15H7.5v-3H10V9.5C10 7.01 11.49 5.6 13.78 5.6c1.1 0 2.25.2 2.25.2v2.47h-1.27c-1.24 0-1.63.77-1.63 1.56V12h2.77l-.44 3h-2.33v6.8c4.56-.93 8-4.96 8-9.8z"/>
                    </svg>
                @elseif ($p === 'wa' || $p === 'whatsapp')
                    <!-- WhatsApp Icon -->
                    <svg class="{{ $iconSizes }}" fill="currentColor" viewBox="0 0 24 24">
                        <path d="M12.012 2c-5.506 0-9.989 4.478-9.99 9.984 0 1.765.459 3.488 1.334 5.006L2 22l5.12-1.341c1.472.802 3.136 1.225 4.887 1.226h.005c5.505 0 9.988-4.478 9.989-9.984 0-2.668-1.038-5.176-2.924-7.062A9.923 9.923 0 0 0 12.012 2zm0 18.258h-.004a8.272 8.272 0 0 1-4.22-1.161l-.303-.18-3.135.821.836-3.054-.197-.314a8.261 8.261 0 0 1-1.265-4.386c0-4.564 3.714-8.278 8.28-8.278 2.21 0 4.288.862 5.852 2.427a8.232 8.232 0 0 1 2.425 5.853c-.001 4.565-3.715 8.279-8.279 8.279zm4.536-6.195c-.248-.124-1.469-.724-1.696-.807-.227-.083-.393-.124-.559.124-.165.248-.641.807-.786.972-.145.165-.29.186-.538.062-.248-.124-1.047-.386-1.995-1.231-.738-.659-1.236-1.472-1.38-1.72-.146-.248-.016-.382.108-.506.112-.112.248-.29.372-.434.124-.145.165-.248.248-.414.083-.165.041-.31-.021-.434-.062-.124-.559-1.346-.765-1.842-.201-.484-.405-.418-.559-.426l-.476-.008c-.165 0-.434.062-.661.31-.227.248-.868.848-.868 2.07 0 1.221.889 2.4 1.013 2.565.124.165 1.75 2.673 4.239 3.748.592.256 1.055.409 1.416.523.595.19 1.136.163 1.564.1.477-.07 1.469-.6 1.675-1.179.207-.579.207-1.075.145-1.179-.062-.104-.227-.166-.475-.29z"/>
                    </svg>
                @else
                    <!-- Generic Link Icon -->
                    <svg class="{{ $iconSizes }}" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M13.828 10.172a4 4 0 00-5.656 0l-4 4a4 4 0 105.656 5.656l1.102-1.101m-.758-4.899a4 4 0 005.656 0l4-4a4 4 0 00-5.656-5.656l-1.1 1.1"/>
                    </svg>
                @endif

            </a>
        @endforeach
    </div>
@endif

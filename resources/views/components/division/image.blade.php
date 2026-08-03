@props(['division'])

<section class="rounded-3xl overflow-hidden border border-slate-200 shadow-xl min-h-[250px] max-h-[450px]">
    <x-common.image :src="$division['image_url']" :alt="$division['name']" class="h-full w-full object-cover" />
</section>

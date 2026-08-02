<x-layouts.public title="Cabang & DPC - HIMSI UBSI">

    {{-- 1. Hero Section --}}
    <x-branch.hero 
        :title="$hero['title']" 
        :subtitle="$hero['subtitle']" 
        badge="Wilayah Kepengurusan" />

    {{-- 2. List Cabang Section (Search & Filter) --}}
    <x-branch.list 
        :branches="$branches" 
        :sektors="$sektors" 
        :currentSearch="$currentSearch" 
        :currentSektor="$currentSektor" 
        :currentType="$currentType" />

</x-layouts.public>

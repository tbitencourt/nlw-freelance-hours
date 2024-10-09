@php use App\Enums\ProjectStatus; @endphp
@props(['status'])
<span
    {{ $attributes ->class ([
        'rounded-full font-bold text-center uppercase py-[6px] px-[14px] text-[12px] tracking-wide',
        'bg-[#C0F7B4] text-[#1D8338]' => $status == ProjectStatus::Open,
        'bg-[#FECDD3] text-[#881337]' => $status == ProjectStatus::Closed,
    ]) }}
    class="">
    {{ $status->label() }}
</span>

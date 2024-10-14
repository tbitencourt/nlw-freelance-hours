
<div class="flex items-center justify-between mt-4 text-[14px]" wire:poll.1s>
    <div class="text-[#8C8C9A] leading-6">{{ __('Encerra em') }}:</div>
    <div class="font-bold flex items-center space-x-1">
        <span class="text-white ">{{ str_pad($days, 2 , '0' , STR_PAD_LEFT) }}</span><span>:</span>
        <span class="text-white ">{{ str_pad($hours, 2 , '0' , STR_PAD_LEFT) }}</span><span>:</span>
        <span class="text-white ">{{ str_pad($minutes, 2 , '0' , STR_PAD_LEFT) }}</span><span>:</span>
        <span class="text-white ">{{ str_pad($seconds, 2 , '0' , STR_PAD_LEFT) }}</span>
    </div>
</div>

<th scope="col" wire:click="setOrderField('{{ $name }}')" style="cursor: pointer;">
    {{ $label }}
    @if ($visible)
        @if ($direction === 'ASC')
            <i class="fa-solid fa-angle-up"></i>
        @else
            <i class="fa-solid fa-angle-down"></i>
        @endif
    @endif
</th>

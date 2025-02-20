<p>
    @if(!empty($item->claim_from_month) &&  !empty($item->claim_to_month))
    From {{ getMonthName($item->claim_from_month) }} To {{ getMonthName($item->claim_to_month) }} Of {{$item->financial_year}}    
    @endif
</p>
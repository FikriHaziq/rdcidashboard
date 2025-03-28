<div id="chargeline_info" class="alert alert-secondary-soft fade show d-flex align-items-center d-none" role="alert">
    <div class="grid grid-cols-12 gap-3 w-full">
        <div class="g-col-4 box p-5 cursor-pointer zoom-in" style="background-color: #212A31;">
            <div class="fw-medium fs-base text-white">Baki</div>
            <div class="fw-bold fs-lg text-white" id="chargeline_balance"></div>
        </div>
        <div class="g-col-4 box p-5 cursor-pointer zoom-in" style="background-color: #2E3944">
            <div class="fw-medium fs-base text-white">Agihan</div>
            <div class="fw-bold fs-lg text-white" id="chargeline_allocation"></div>
        </div>
        <div class="g-col-4 box p-5 cursor-pointer zoom-in" style="background-color: #748D92">
            <div class="fw-medium fs-base text-white">Belanja</div>
            <div class="fw-bold fs-lg text-white" id="chargeline_expenses"></div>
        </div>
    </div>
</div>
@push('custom-js')
@parent
<script>
    function displayChargelineInfo(balance, allocation, expenses){
        let parent = $('#chargeline_info');
        if(parent.hasClass('d-none')){
            parent.removeClass('d-none');
            parent.addClass('d-block');
        }
        parent.find('#chargeline_balance').html(formatCurrency(balance));
        $('#fund_balance').val(balance);
        parent.find('#chargeline_allocation').html(formatCurrency(allocation));
        parent.find('#chargeline_expenses').html(formatCurrency(expenses));
    }

    function formatCurrency(value){
        return new Intl.NumberFormat('en-US', {
            style: 'currency',
            currency: 'MYR'
        }).format(value).replace('MYR', 'RM');
    }

</script>
@endpush
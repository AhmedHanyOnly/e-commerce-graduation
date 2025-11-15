<div class="box-cart mb-3 mt-0"
     x-cloak
     x-show="$wire.payment_method == 'bank'"
     x-transition.enter.duartion.500ms

>
    <h4 class="my-4">{{ __('Choose a bank account') }}</h4>
    <div class="row g-3">
        @foreach(\App\Models\BankAccount::whereActive(1)->get() as $bank)
        <div wire:click="$set('bank_id',{{$bank->id}})" class="col-md-4">
            <div class="check-bank {{$bank->id == $bank_id ? 'active' : ''}}">
            <img src="{{$bank->image ? display_file($bank->image) : asset('front-asset/img/bank.png')}}" class="bank-img" alt="img">
                <div class="title">{{$bank->bank_name}}</div>
                <p class="item">{{ __('account number') }} : {{$bank->number}}</p>
                <p class="item">{{ __('IBAN') }} : {{$bank->iban}}</p>
                <p class="item">{{ __('payee\'s name') }} : {{$bank->owner_name}}</p>
            </div>
        </div>
        @endforeach
    </div>
    <div class="row row-cols-1 row-cols-sm-2 g-4 mt-4">
        <div class="col">
            <label>{{ __('Transfer receipt') }}</label>
            <input type="file" class="form-control" wire:model="transfer_img">
        </div>
        <div class="col">
            <label>{{ __('The account number it is transferred from') }}</label>
            <input type="number" min="0" class="form-control" wire:model="transfer_account_number">
        </div>
    </div>
</div>

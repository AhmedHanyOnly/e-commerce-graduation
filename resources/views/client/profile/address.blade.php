<div class="col-content col-xl-9 col-lg-9 col-md-12 col-sm-12 col-12">
    <x-admin-alert></x-admin-alert>
    <div class="card ">
        <div class="card-body">
            <div class="row gutters g-2">
                <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 col-12">
                    <h5 class="mb-2 text-primary">{{ __('my address') }}</h5>
                    <div class="alert alert-secondary" role="alert">
                        {{ __('Add your address to ship orders') }}
                    </div>
                </div>
                <div class=" col-lg-4 col-md-6 col-sm-6 col-12">
                    <div class="form-group">
                        <label for="city" class="mb-2">{{ __('City') }}</label>
                        <select wire:model.live="city_id" id="city" class="form-select">
                            <option value="">{{ __('Select city') }}</option>
                            @foreach ($cities as $id => $name)
                            <option value="{{ $id }}">{{ $name }}</option>
                            @endforeach
                        </select>
                    </div>
                </div>
                <div class=" col-lg-4 col-md-6 col-sm-6 col-12">
                    <div class="form-group">
                        <label for="city" class="mb-2">{{ __('neighborhood') }}</label>
                        <select wire:model="neighborhood_id" id="neighborhood_id" class="form-select">
                            <option value="">{{ __('Select Neighborhood') }}</option>
                            @foreach ($neighborhoods as $id => $name)
                            <option value="{{ $id }}">{{ $name }}</option>
                            @endforeach
                        </select>
                    </div>
                </div>

                <div class=" col-lg-4 col-md-6 col-sm-6 col-12">
                    <div class="form-group">
                        <label for="" class="mb-2">{{ __('Address in detail') }}</label>
                        <input type="text" wire:model.defer="address" class="form-control">
                    </div>
                </div>

            </div>
        </div>

        <div class="d-flex  justify-content-center  my-3">
            <div class="text-right">
                <button type="button" wire:click="submitAddress" class="btn btn-sm btn-success">{{ __('Save Changes') }}</button>
            </div>
        </div>
    </div>
</div>

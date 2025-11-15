<x-admin-alert></x-admin-alert>

<div class="row row-gap-24 ">
    <div class="row row-cols-1 row-cols-sm-2 row-cols-md-3 row-cols-lg-4 row-cols-xl-4 mb-2 g-3">

        <div class="col">
            <div class="inp-holder">
                <label class="special-input">
                    <span>@lang('admin.WebsiteName')</span>
                    <input type="text" wire:model="website_name" id="website_name" class="form-control">
                </label>
            </div>
        </div>

        <div class="col">
            <div class="inp-holder">
                <label class="special-input">
                    <span>@lang('admin.WebsiteURL')</span>
                    <input type="url" wire:model="website_url" id="website_url" class="form-control">
                </label>
            </div>
        </div>

        <div class="col">
            <div class="inp-holder">
                <label class="special-input">
                    <span>@lang('admin.TaxNumber')</span>
                    <input type="number" min="0" wire:model="tax_number" id="tax_number" class="form-control">
                </label>
            </div>
        </div>

        <div class="col">
            <div class="inp-holder">
                <label class="special-input">
                    <span>@lang('admin.Address')</span>
                    <input type="text" wire:model="address" id="address" class="form-control">
                </label>
            </div>
        </div>

      <div class="col">
    <div class="inp-holder">
        <label class="special-input">
            <span>@lang('admin.BuildingNumber')</span>
            <input 
                type="number" 
                min="0" 
                wire:model="building_number" 
                id="building_number" 
                class="form-control" 
                oninput="this.value = this.value < 0 ? 0 : this.value;"
                onkeydown="if(event.key === '-' || event.key === 'e'){ event.preventDefault(); }"
            >
        </label>
    </div>
</div>

        <div class="col">
            <div class="inp-holder">
                <label class="special-input">
                    <span>@lang('admin.Street')</span>
                    <input type="text" wire:model="street_number" id="street_number" class="form-control">
                </label>
            </div>
        </div>

        <div class="col">
            <div class="inp-holder">
                <label class="special-input">
                    <span>@lang('admin.Phone')</span>
                    <input type="tel" wire:model="phone" id="phone" class="form-control">
                </label>
            </div>
        </div>

        <div class="col">
            <div class="inp-holder">
                <label class="special-input">
                    <span>@lang('admin.Email')</span>
                    <input type="email" class="form-control" wire:model="email" id="email">
                </label>
            </div>
        </div>

     <div class="col">
    <div class="inp-holder">
        <label class="special-input">
            <span>@lang('admin.Tax')</span>
            <input 
                type="number" 
                class="form-control" 
                wire:model="tax" 
                id="tax"
                min="0"
                oninput="this.value = this.value < 0 ? 0 : this.value;"
                onkeydown="if(event.key === '-' || event.key === 'e'){ event.preventDefault(); }"
            >
        </label>
    </div>
</div>

<div class="col">
    <div class="inp-holder">
        <label class="special-input">
            <span>@lang('admin.ShippingPrice')</span>
            <input 
                type="number" 
                class="form-control" 
                wire:model="shipping_price" 
                id="shipping_price" 
                min="0"
                oninput="this.value = this.value < 0 ? 0 : this.value;"
                onkeydown="if(event.key === '-' || event.key === 'e'){ event.preventDefault(); }"
            >
        </label>
    </div>
</div>

<div class="col">
    <div class="inp-holder">
        <label class="special-input">
            <span>@lang('admin.CashOnDeliveryFee')</span>
            <input 
                type="number" 
                class="form-control" 
                wire:model="cash_on_delivery_tax" 
                id="cash_on_delivery_tax" 
                min="0"
                oninput="this.value = this.value < 0 ? 0 : this.value;"
                onkeydown="if(event.key === '-' || event.key === 'e'){ event.preventDefault(); }"
            >
        </label>
    </div>
</div>

        <div class="col">
            <div class="inp-holder">
                <label class="special-label" for="is_tax">@lang('admin.TaxEnabled')</label>
                <select wire:model="is_tax" id="is_tax" class="form-select">
                    <option value="">@lang('admin.Choose')</option>
                    <option value="1">@lang('admin.Enabled')</option>
                    <option value="0">@lang('admin.Disabled')</option>
                </select>
            </div>
        </div>

        <div class="col">
            <div class="inp-holder">
                <label class="special-input">
                    <span>@lang('admin.Currency')</span>
                    <input type="text" class="form-control" wire:model="currency" id="currency">
                </label>
            </div>
        </div>

        <div class="col">
            <div class="inp-holder">
                <label class="special-input">
                    <span>@lang('admin.MostSold')</span>
                    <select name="most_sold_products" wire:model="most_sold_products" class="form-control">
                        <option value="1">@lang('admin.Enabled')</option>
                        <option value="0">@lang('admin.Disabled')</option>
                    </select>
                </label>
            </div>
        </div>

        <div class="col">
            <div class="inp-holder">
                <label class="special-input">
                    <span>@lang('admin.is_active_pre_order')</span>
                    <select name="is_active_pre_order" wire:model="is_active_pre_order" class="form-control">
                        <option value="">@lang('admin.Choose')</option>
                        <option value="1">@lang('admin.Enabled')</option>
                        <option value="0">@lang('admin.Disabled')</option>
                    </select>
                </label>
            </div>
        </div>
        <div class="col">
            <div class="inp-holder">
                <label class="special-input">
                    <span>@lang('admin.pre order days')</span>
                    <input name="pre_order_days" wire:model="pre_order_days" class="form-control" min="1" max="30">
                </label>
            </div>
        </div>

        <div class="col-12 col-md-12 col-lg-12 col-xl-12">
            <hr>
            <h6 class="main-head m-0">
                @lang('admin.SocialMedia')
            </h6>
        </div>

        <div class="col">
            <div class="inp-holder">
                <label class="special-input">
                    <span>@lang('admin.Whatsapp')</span>
                    <input type="text" wire:model='whatsapp' class="form-control" id="whatsapp">
                </label>
            </div>
        </div>

        <div class="col">
            <div class="inp-holder">
                <label class="special-input">
                    <span>@lang('admin.Youtube')</span>
                    <input type="text" wire:model='snapchat' class="form-control" id="snapchat">
                </label>
            </div>
        </div>

        <div class="col">
            <div class="inp-holder">
                <label class="special-input">
                    <span>@lang('admin.Twitter')</span>
                    <input type="text" class="form-control" wire:model="twitter" id="twitter">
                </label>
            </div>
        </div>

        <div class="col">
            <div class="inp-holder">
                <label class="special-input">
                    <span>@lang('admin.Facebook')</span>
                    <input type="text" wire:model='facebook' class="form-control" id="facebook">
                </label>
            </div>
        </div>

        <div class="col">
            <div class="inp-holder">
                <label class="special-input">
                    <span>@lang('admin.Instagram')</span>
                    <input type="text" class="form-control" wire:model="instagram" id="instagram">
                </label>
            </div>
        </div>
        <div class="col-12 col-md-12 col-lg-12 col-xl-12">
            <hr>
            <h6 class="main-head m-0">
                @lang('admin.AppDownloadLinks')
            </h6>
        </div>
        <div class="col">
            <div class="inp-holder">
                <label class="special-input">
                    <span>@lang('admin.Android')</span>
                    <input type="url" class="form-control" wire:model="android_store_url" id="android_store_url">
                </label>
            </div>
        </div>
        <div class="col">
            <div class="inp-holder">
                <label class="special-input">
                    <span>@lang('admin.IOS')</span>
                    <input type="url" class="form-control" wire:model="ios_store_url" id="ios_store_url">
                </label>
            </div>
        </div>

        <!-- حالة الموقع -->
        <div class="col-12 col-md-12 col-lg-12 col-xl-12">
            <hr>
        </div>
        <div class="col">
            <div class="inp-holder">
                <label class="special-label" for="website_status">@lang('admin.WebsiteStatus')</label>
                <select wire:model="website_status" id="website_status" class="form-select">
                    <option value="">@lang('admin.Choose')</option>
                    <option value="1">@lang('admin.Enabled')</option>
                    <option value="0">@lang('admin.Disabled')</option>
                </select>
            </div>
        </div>

        <div class="col-12 col-md-12 col-lg-12 col-xl-4 transform-up-xl">
            <label class="special-label" for="maintainance_message">@lang('admin.MaintenanceMessage')</label>
            <textarea wire:model="maintainance_message" id="maintainance_message" rows="4" class="form-control" placeholder="@lang('admin.MaintenanceMessagePlaceholder')"></textarea>
        </div>

        <!-- الشعار والأيقونة -->
        <div class="col">
            <div class="inp-holder">
                <label class="special-input mb-1">
                    <span>@lang('admin.Logo')</span>
                    <input type="file" wire:model="logo" id="logo" class="form-control">
                </label>
                @if (setting('logo'))
                <img src="{{ display_file(setting('logo')) }}" alt="" width='50'>
                @endif
            </div>
        </div>

        <div class="col">
            <div class="inp-holder">
                <label class="special-input mb-1">
                    <span>@lang('admin.Favicon')</span>
                    <input type="file" wire:model="fav" id="fav" class="form-control">
                </label>
                @if (setting('fav'))
                <img src="{{ display_file(setting('fav')) }}" alt="" width='50'>
                @endif
            </div>
        </div>

        <!-- زر الحفظ -->
        <div class="col-12 col-md-12 col-lg-12 col-xl-12">
            <div class="btn-holder d-flex justify-content-center mt-4">
                <button wire:click='save' type="button" class="main-btn">@lang('admin.SaveChanges')</button>
            </div>
        </div>
    </div>
</div>

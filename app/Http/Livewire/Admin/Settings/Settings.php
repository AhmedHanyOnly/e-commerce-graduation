<?php

namespace App\Http\Livewire\Admin\Settings;

use App\Models\Setting;
use Livewire\Component;
use Livewire\WithFileUploads;

class Settings extends Component
{
    use WithFileUploads;

    public $screen = 'general';
    public $website_name, $website_url, $tax_number, $address, $building_number, $street_number, $phone, $iban, $is_tax, $is_can_send_email, $website_status, $logo, $fav, $maintainance_message, $show_logo, $show_fav;
    public $email, $whatsapp, $snapchat, $twitter, $facebook, $instagram;
    public $vendor_add_drivers_directly, $active_vendor, $most_sold_products;
    public $vendor_registration, $client_registration, $product_active, $driver_registration, $active_client, $tax;
    public $max_driver_for_transporter, $commission, $currency,
    $complaint;
    public $shipping_price, $cash_on_delivery_tax;
    public $accept_comment_automatically, $android_store_url, $ios_store_url;
    // gateways
    public $is_stc_active, $is_banks_active, $is_tamara_active, $is_slider_active, $is_about_us_active, $is_comments_active, $product_colors_active;
    public $is_clickpay_active = false,
    $clickpay_profile_id,
    $clickpay_server_key, $stcpay_phone, $success_payment;
    public $enable_default_banner;

    protected $queryString = ['screen'];
    public $is_active_pre_order = false;
    public $pre_order_days;

    public $rules = [
        'website_name' => 'nullable',
        'website_url' => 'nullable',
        'tax_number' => 'nullable',
        'address' => 'nullable',
        'building_number' => 'nullable',
        'street_number' => 'nullable',
        'phone' => 'nullable',
        'iban' => 'nullable',
        'is_tax' => 'nullable',
        'is_can_send_email' => 'nullable',
        'website_status' => 'nullable',
        'logo' => 'nullable',
        'fav' => 'nullable',
        'maintainance_message' => 'nullable',
        'whatsapp' => 'nullable',
        'snapchat' => 'nullable',
        'twitter' => 'nullable',
        'facebook' => 'nullable',
        'instagram' => 'nullable',
        'email' => 'nullable',
        'active_vendor' => 'nullable',
        'vendor_add_drivers_directly' => 'nullable',
        'max_driver_for_transporter' => 'nullable',
        'vendor_registration' => 'nullable',
        'client_registration' => 'nullable',
        'driver_registration' => 'nullable',
        'product_active' => 'nullable',
        'active_client' => 'nullable',
        'tax' => 'nullable',
        'commission' => 'nullable',
        'currency' => 'nullable',
        'complaint' => 'nullable',
        'shipping_price' => 'nullable',
        'cash_on_delivery_tax' => 'nullable',
        'accept_comment_automatically' => 'nullable',
        'android_store_url' => 'nullable',
        'ios_store_url' => 'nullable',
        'success_payment' => 'nullable',

        //gateways
        'is_clickpay_active' => 'nullable',
        'clickpay_profile_id' => 'required_if:is_clickpay_active,1',
        'clickpay_server_key' => 'required_if:is_clickpay_active,1',
        'is_stc_active' => 'nullable',
        'is_banks_active' => 'nullable',
        'is_tamara_active' => 'nullable',
        'stcpay_phone' => 'nullable',
        'is_slider_active' => 'nullable',
        'product_colors_active' => 'nullable',
        'enable_default_banner' => 'nullable',
        'is_comments_active' => 'nullable',
        'is_about_us_active' => 'nullable',
        'most_sold_products' => 'nullable',
        'is_active_pre_order' => 'nullable',
        'pre_order_days' => 'nullable',
    ];
    public $files = [
        'logo',
        'fav'
    ];

    public $booleanFileds = [
        'is_tax',
        'is_can_send_email',
        'active_vendor',
        'vendor_add_drivers_directly',
        'vendor_registration',
        'client_registration',
        'product_active',
        'driver_registration',
        'active_client',
        'is_clickpay_active',
        'is_stc_active',
        'is_banks_active',
        'is_tamara_active',
        'is_slider_active',
        'product_colors_active',
        'enable_default_banner',
        'is_comments_active',
        'is_about_us_active',
    ];

    public function render()
    {
        return view('livewire.admin.settings.settings');
    }

    public function mount()
    {
        $this->setScreenData();
    }

    public function setScreenData()
    {
        $keys = array_keys($this->rules);
        foreach ($keys as $item) {
            if (!in_array($item, $this->files)) {
                $this->{$item} = setting($item);
            } else {
                $this->{'show_' . $item} = setting($item);
            }
        }

        foreach ($this->booleanFileds as $item) {
            $this->{$item} = (bool) $this->{$item};
        }

    }

    public function save()
    {
        $data = $this->validate();
        // dd($data);
        foreach ($this->files as $file) {
            if (!is_null($data[$file]) && !empty($data[$file])) {
                delete_file($data[$file]);
                $data[$file] = store_file($data[$file], 'settings');
            } else {
                $data[$file] = setting($file);
            }
        }
        //         dd($data);
        \DB::table('settings')->delete();
        setting($data)->save();
        session()->flash('success', 'تم الحفظ بنجاح');
    }
}

<?php

namespace App\Models\Settings;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class GeneralSetting extends Model
{
    use HasFactory;

    protected $fillable = ['logo', 'favicon', 'title', 'footer','copyright','colors','loader','admin_loader','talkto','disqus','currency_format','withdraw_fee','withdraw_charge','tax','mail_driver','mail_host', 'mail_port', 'mail_encryption', 'mail_user','mail_pass','from_email','from_name','is_affiliate','affiliate_charge','affiliate_banner','fixed_commission','percentage_commission','multiple_shipping','vendor_ship_info','is_verification_email','is_captcha','error_banner','popup_time','invoice_logo','is_secure','footer_logo','maintain_text','breadcrumb_banner','register_id','preloaded','deactivated_text','notify_popup_time','cert_sign','cert_text','youtube_api_key','is_faq'];

    public $timestamps = false;

    public function upload($name,$file,$oldname)
    {
        $file->move('assets/images',$name);
        if($oldname != null)
        {
            if(file_exists(base_path('../assets/frontend/images/'.$oldname))){
                unlink(base_path('../assets/frontend/images/'.$oldname));
            }
        }
    }

    public function owner(){
		return $this->belongsTo('App\Models\Admin','register_id')->withDefault();
    }

    public function ownerupload($name,$file,$oldname,$owner)
    {
        $file->move('assets/'.$owner.'/owner/images',$name);
        if($oldname != null)
        {
            if(file_exists(base_path('../assets/'.$owner.'/owner/images/'.$oldname))){
                unlink(base_path('../assets/'.$owner.'/owner/images/'.$oldname));
            }
        }
    }
}

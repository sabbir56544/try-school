<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Settings\GeneralSetting;
use Illuminate\Http\Request;
use Validator;
use Artisan;
use Illuminate\Support\Facades\Artisan as FacadesArtisan;
use Illuminate\Support\Facades\Validator as FacadesValidator;

class GeneralSettingController extends Controller
{
    protected $rules =
    [
        'logo'              => 'mimes:jpeg,jpg,png,svg',
        'favicon'           => 'mimes:jpeg,jpg,png,svg',
        'loader'            => 'mimes:gif',
        'admin_loader'      => 'mimes:gif',
        'affiliate_banner'   => 'mimes:jpeg,jpg,png,svg',
        'error_banner'      => 'mimes:jpeg,jpg,png,svg',
        'popup_background'  => 'mimes:jpeg,jpg,png,svg',
        'invoice_logo'      => 'mimes:jpeg,jpg,png,svg',
        'breadcrumb_banner'  => 'mimes:jpeg,jpg,png,svg',
        'footer_logo'       => 'mimes:jpeg,jpg,png,svg',
        'cert_sign'         => 'mimes:jpeg,jpg,png,svg',
    ];

    private function setEnv($key, $value,$prev)
    {
        file_put_contents(app()->environmentFilePath(), str_replace(
            $key . '=' . $prev,
            $key . '=' . $value,
            file_get_contents(app()->environmentFilePath())
        ));
    }

    public function generalUpdate(Request $request)
    {
        //--- Validation Section
        $validator = FacadesValidator::make($request->all(), $this->rules);

        if ($validator->fails()) {
          return response()->json(array('errors' => $validator->getMessageBag()->toArray()));
        }
        //--- Validation Section Ends

        //--- Logic Section
        else {
        $input = $request->all();
        $data = GeneralSetting::findOrFail(1);
            if ($file = $request->file('logo'))
            {
                $name = time().str_replace(' ', '', $file->getClientOriginalName());
                $data->upload($name,$file,$data->logo);
                $input['logo'] = $name;
            }
            if ($file = $request->file('favicon'))
            {
                $name = time().str_replace(' ', '', $file->getClientOriginalName());
                $data->upload($name,$file,$data->favicon);
                $input['favicon'] = $name;
            }
            if ($file = $request->file('loader'))
            {
                $name = time().str_replace(' ', '', $file->getClientOriginalName());
                $data->upload($name,$file,$data->loader);
                $input['loader'] = $name;
            }
            if ($file = $request->file('admin_loader'))
            {
                $name = time().str_replace(' ', '', $file->getClientOriginalName());
                $data->upload($name,$file,$data->admin_loader);
                $input['admin_loader'] = $name;
            }
            if ($file = $request->file('affiliate_banner'))
            {
                $name = time().str_replace(' ', '', $file->getClientOriginalName());
                $data->upload($name,$file,$data->affiliate_banner);
                $input['affiliate_banner'] = $name;
            }
             if ($file = $request->file('error_banner'))
            {
                $name = time().str_replace(' ', '', $file->getClientOriginalName());
                $data->upload($name,$file,$data->error_banner);
                $input['error_banner'] = $name;
            }
            if ($file = $request->file('popup_background'))
            {
                $name = time().str_replace(' ', '', $file->getClientOriginalName());
                $data->upload($name,$file,$data->popup_background);
                $input['popup_background'] = $name;
            }
            if ($file = $request->file('invoice_logo'))
            {
                $name = time().str_replace(' ', '', $file->getClientOriginalName());
                $data->upload($name,$file,$data->invoice_logo);
                $input['invoice_logo'] = $name;
            }
            if ($file = $request->file('breadcrumb_banner'))
            {
                $name = time().str_replace(' ', '', $file->getClientOriginalName());
                $data->upload($name,$file,$data->breadcrumb_banner);
                $input['breadcrumb_banner'] = $name;
            }

            if ($file = $request->file('footer_logo'))
            {
                $name = time().str_replace(' ', '', $file->getClientOriginalName());
                $data->upload($name,$file,$data->footer_logo);
                $input['footer_logo'] = $name;
            }

            if ($file = $request->file('cert_sign'))
            {
                $name = time().str_replace(' ', '', $file->getClientOriginalName());
                $data->upload($name,$file,$data->cert_sign);
                $input['cert_sign'] = $name;
            }

        $data->update($input);
        //--- Logic Section Ends


        FacadesArtisan::call('cache:clear');
        FacadesArtisan::call('config:clear');
        FacadesArtisan::call('route:clear');
        FacadesArtisan::call('view:clear');

        //--- Redirect Section
        return redirect()->back()->with('message', 'Settings updated Successfully');
        //--- Redirect Section Ends
        }
    }

    public function logo()
    {
        $data['title'] = "Website Logo";

        return view('backend.general-settings.logo', $data);
    }

    public function favicon()
    {
        $data['title'] = "Website Favicon";

        return view('backend.general-settings.favicon', $data);
    }

    public function breadcrumb()
    {
        $data['title'] = "Website breadcrumb";

        return view('backend.general-settings.breadcrumb', $data);
    }

    public function contents()
    {
        $data['title'] = "Website Contents";

        return view('backend.general-settings.contents', $data);
    }

    public function certificate()
    {
        $data['title'] = "Website Certificate";

        return view('backend.general-settings.certificate', $data);
    }

    public function certificate_show()
    {
        $data['title'] = "Certificate Design";

        return view('backend.general-settings.certificate-design', $data);
    }

    public function error_banner()
    {
        $data['title'] = "Error Banner";

        return view('backend.general-settings.error', $data);
    }

    public function status($field,$value)
    {
        $prev = '';
        $data = GeneralSetting::find(1);
        if($field == 'is_debug'){
            $prev = $data->is_debug == 1 ? 'true':'false';
        }

        $data[$field] = $value;
        $data->update();
        if($field == 'is_debug'){
            $now = $data->is_debug == 1 ? 'true':'false';
            $this->setEnv('APP_DEBUG',$now,$prev);
        }

        return redirect()->route('general-setting.contents')->with('message', 'Settings updated Successfully');
    }
}

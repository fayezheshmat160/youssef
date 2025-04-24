<?php

namespace App\Http\Controllers\Dashboard\Settings;

use App\Helpers\File;
use App\Helpers\Response;
use Illuminate\Http\Request;
use App\Models\Dashboard\Settings;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;
use App\Models\Dashboard\ReceivingEmails;

class SettingsController extends Controller
{
    use SettingComponents;

    // Data Array

    private array $data;

    // Upload Options For Image
    const PATH   = 'settings';





    public function __construct()
    {
        $this->settingId();
    }

    // Get Row From Database
    private function settingId()
    {
        // Fetch First Row
        $row = Settings::limit(1)->first('id');

        // Check IF Exist Set Id Else Set null
        $this->data['id'] = empty($row) ? null : $row->id;
    }




    // Get Row From Database
    public function getRow($select = 'id')
    {
        return Settings::limit(1)->select($select)->first();
    }


    // // Check IF Have Row IN Database And Return "nullable" Else Return "required" Use For Validate
    public function requiredOnInsertNullableOnUpdate()
    {
        return $this->data['id'] == null ? 'required' : 'nullable';
    }



    // Main View
    public function index()
    {

        return view('dashboard.settings.index', [
            'tabs' => self::$tabs,
            'links' => self::$socialMedia,
            'row'   => $this->getRow(['*']),
            'receivingEmails'   => DB::table('receiving_emails')->get(['id', 'email']),
            'requiredOrUpdate' => $this->requiredOnInsertNullableOnUpdate(),
        ]);
    }





    /*
     |
     | Components
     |
     */
    public function general($request)
    {

        $request->validate([
            'logo' => $this->requiredOnInsertNullableOnUpdate() . '|mimes:' . $this->pattern['image'],
            'website_icon' => $this->requiredOnInsertNullableOnUpdate() . '|mimes:' .  $this->pattern['image'],
        ]);

        // Get Setting Row
        $row = $this->getRow(['logo', 'website_icon']);

        // Image Options
        $logoOptions = ['path' => self::PATH];
        $websiteIconOptions = ['path' => self::PATH];


        // Check IF Have Row In Database
        if (!empty($row)) {
            // Set Old File Name In Image Options
            $logoOptions['delete'] =  $row->logo;
            $websiteIconOptions['delete'] =  $row->website_icon;
        }

        // Upload And Get Files Name For Append To $data
        $this->data['data']['logo'] = File::upload('logo', $logoOptions);
        $this->data['data']['website_icon'] = File::upload('website_icon', $websiteIconOptions);
    }


    public function social($request)
    {

        // Get All Social And Loop For Set To Validate Array
        foreach (self::$socialMedia as $key => $val) {
            $validate[$key] = 'nullable|url|max:255';
        }

        $this->data['data'] = $request->validate($validate);
    }



    public function contact($request)
    {

        $this->data['data'] = $request->validate([
            'email.*' => 'nullable|email|max:120',
            'phone.*' => 'nullable|numeric|digits_between:0,60'
        ]);
    }

    public function receivingEmails($request)
    {


        $this->data['data'] = $request->validate([
            'email.*' => 'email|max:120',
        ]);


        $emailLength = count($request->email);
        /**
         * Delete Old
         */

        if ($emailLength != null) {

            ReceivingEmails::truncate();

            for ($i = 0; $i < $emailLength; $i++) {
                $email = $request->email[$i];
                ReceivingEmails::create([
                    'email' => $email,
                ]);
            }

            return Response::success('تم تحديث البيانات بنجاح', ['style' => 'toastr']);
        } else {
            return Response::success('يجب اضافة حساب واحد على الاقل لإستقبال رسائل البريد', ['style' => 'toastr']);
        }
    }



    public function logos($request)
    {


        $request->validate([
            'website_name' => 'required|max:50',
            'logo_white' => 'nullable|mimes:' . mimesType('image'),
            'logo_dark' => 'nullable|mimes:' . mimesType('image'),
            'cover' => 'nullable|mimes:' . mimesType('image'),
        ]);


        // Upload
        $logo_white = File::upload('logo_white', [
            'path' => self::PATH,
            'delete' => $this->getRow('logo_white')->logo_white
        ]);

        // Upload
        $logo_dark = File::upload('logo_dark', [
            'path' => self::PATH,
            'delete' => $this->getRow('logo_dark')->logo_dark
        ]);

        // Upload
        $cover = File::upload('cover', [
            'path' => self::PATH,
            'large' => '1920*1080*75',
            'extension' => 'webp',
            'delete' => $this->getRow('cover')->cover
        ]);



        $this->data['data']['logo_white'] = $logo_white;
        $this->data['data']['logo_dark'] = $logo_dark;
        $this->data['data']['cover'] = $cover;
    }





    // Store
    public function store(Request $request)
    {


        // Action
        $action = $request->action;


        /**
         * receiving-emails
         */
        if ($action == 'receiving-emails') {
            return $this->receivingEmails($request);
        }


        // Loop And Get All Tab Names
        foreach (self::$tabs as $method => $val) {

            //Check IF $action parameter Equal $method tab
            if ($action == $method) {


                // Check If Method Exist In Controller
                if (method_exists(SettingsController::class, $method)) {
                    // Run The Method
                    $this->$method($request);

                    if ($method == 'contact') {
                        $this->data['data']['email'] = implode('|', $this->data['data']['email']);
                        $this->data['data']['phone'] = implode('|', $this->data['data']['phone']);
                    }
                } else {
                    // Else Not Exist Method Return Error
                    return Response::error("Method ( $method ) Not Exist");
                }
            }
        }



        // Store Or Update
        $row = Settings::updateOrCreate(['id' => $this->data['id']], $this->data['data']);


        // IF Data Saved
        if ($row->save()) {
            return Response::success('Successfully Updated ' . textCapitalize($action) . ' Section');
        } else {
            return Response::error('Error Updated ' . textCapitalize($action) . ' Section');
        }
    }
}

<?php
 
namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin_panel_settings_Request;
use App\Models\Panel_settings;

class Admin_panel_settingsController extends Controller
{
    public function index()
    {
        check_permission_sub_menue_actions_redirect(39);
        $data = Panel_settings::first();
        return view('admin.admin_panel_settings.index', ['data' => $data]);
    }
    public function edit()
    {
        check_permission_sub_menue_actions_redirect(40);
        $data = Panel_settings::select()->first();
        return view('admin.admin_panel_settings.edit', ['data' => $data]);
    }
    public function update(Admin_panel_settings_Request $request)
    {
        check_permission_sub_menue_actions_redirect(40);
        try {
            $admin_panel_setting = Panel_settings::select()->first();
            $admin_panel_setting->ar_contract = $request->ar_contract;
            $admin_panel_setting->en_contract = $request->en_contract;
            $admin_panel_setting->system_name = $request->system_name;
            $admin_panel_setting->address = $request->address;
            $admin_panel_setting->phone_one = $request->phone_one;
            $admin_panel_setting->phone_two = $request->phone_two;
            $admin_panel_setting->email = $request->email;
            $admin_panel_setting->cr_number = $request->cr_number;
            $admin_panel_setting->intro = $request->intro;
            $admin_panel_setting->currency_type = $request->currency_type;
            $admin_panel_setting->tax_number = $request->tax_number;
            $admin_panel_setting->updated_by = auth()->user()->id;
            $admin_panel_setting->updated_at = date("Y-m-d H:i:s");
            if ($request->has('photo')) {
                $request->validate([
                    'photo' => 'required|mimes:png,jpg,jpeg|max:2000',
                ]);
                $admin_panel_setting->photo = $this->updateImage($request->photo, $admin_panel_setting->photo);
            }
            if ($request->has('mark_image')) {
                $request->validate([
                    'mark_image' => 'required|mimes:png,jpg,jpeg|max:2000',
                ]);
                $admin_panel_setting->mark_image = $this->updateImage($request->mark_image, $admin_panel_setting->mark_image);
            }
            $admin_panel_setting->save();
            return redirect()->route('admin.adminPanelSetting.index')->with(['success' => 'تم تحديث البيانات بنجاح']);
        } catch (\Exception $ex) {
            return redirect()->route('admin.adminPanelSetting.index')->with(['error' => 'عفوا حدث خطأ ما' . $ex->getMessage()]);
        }
    }
    public function updateImage($requestImage, $dataImage)
    {
        $image = $requestImage;
        if ($image) {
            $extension = strtolower($image->extension());
            $filename = time() . rand(100, 999) . '.' . $extension;
            $image->getClientOriginalName = $filename;
            $folder = 'assets/admin/uploads';
            $image->move($folder, $filename);
            if (file_exists('assets/admin/uploads/' . $dataImage) and !empty($dataImage)) {
                unlink('assets/admin/uploads/' . $dataImage);
            }
            return $filename;
        }
    }
}

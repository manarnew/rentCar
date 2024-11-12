<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\communiqueRequest;
use App\Models\Contract;
use App\Models\communique;
use Illuminate\Http\Request;

class CommuniqueController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
         check_permission_sub_menue_actions_redirect(5);
        $data = communique::select()->orderby('id', 'DESC')->paginate(10);
        return view('admin.communique.index', ['data' => $data]);
    }



    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
         check_permission_sub_menue_actions_redirect(6);
        try {
            $id = auth()->user()->id;
           //check if not exsits
            $checkExists = communique::where(['contract_id' => $request->contract_id])->first();
            if ($checkExists == null) {
                $data['added_by'] = $id;  
                $data['contract_id'] = $request->contract_id;
             if( $request->communique_number == null ){
                 return redirect()->back()
                 ->with(['error' => 'عفوا رقم البلاغ مطلوب  ' ])
                  ->withInput();
                 }
                 if( $request->communique_place == null ){
    return redirect()->back()
->with(['error' => 'عفوا مكان البلاغ مطلوب  ' ])
->withInput();
}

if( $request->date == null ){
    return redirect()->back()
->with(['error' => 'عفوا تاريخ البلاغ مطلوب  ' ])
->withInput();
}
                $data['communique_number'] = $request->communique_number;
                $data['communique_place'] = $request->communique_place;
                $data['details'] = $request->details;
                $data['date'] = $request->date;
                $data['created_at'] = date("Y-m-d H:i:s");
                communique::create($data);
                return redirect()->route('communique.index')->with(['success' => 'لقد تم اضافة البيانات بنجاح']);
            } else {
              return redirect()->back()
->with(['error' => 'عفوا تم فتح بلاغ من قبل'])
->withInput();
            }
        } catch (\Exception $ex) {
            return redirect()->back()
                ->with(['error' => 'عفوا حدث خطأ ما' . $ex->getMessage()])
                ->withInput();
        }
    }

   

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
         check_permission_sub_menue_actions_redirect(7);
        $data = communique::select()->find($id);
        return view('admin.communique.edit', ['data' => $data]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(communiqueRequest $request, string $id)
    {
         check_permission_sub_menue_actions_redirect(7);
        try {
            $data = communique::select()->find($id);
            if (empty($data)) {
                return redirect()->route('communique.index')->with(['error' => 'عفوا غير قادر علي الوصول الي البيانات المطلوبة !!']);
            }
        
              $data_to_update['communique_number'] = $request->communique_number;
                $data_to_update['communique_place'] = $request->communique_place;
                $data_to_update['details'] = $request->details;
                $data_to_update['date'] = $request->date;
            
            $data_to_update['updated_at'] = date("Y-m-d H:i:s");
            $ids = auth()->user()->id;
            $data_to_update['updated_by'] = $ids;
            communique::where(['id' => $id])->update($data_to_update);
            return redirect()->route('communique.index')->with(['success' => 'لقد تم تحديث البيانات بنجاح']);
        } catch (\Exception $ex) {
            return redirect()->back()
                ->with(['error' => 'عفوا حدث خطأ ما' . $ex->getMessage()])
                ->withInput();
        }
    }
    public function show(string $id){
        $data_communique = communique::select()->find($id);
        $data = Contract::find($data_communique->contract_id);
        return view('admin.communique.show', ['data' => $data,'data_communique'=>$data_communique]);
    }
    /**
     * Remove the specified resource from storage.
     */
    public function delete(string $id)
    {
         check_permission_sub_menue_actions_redirect(8);
        try {
            $communique = communique::find($id);
            if (!empty($communique)) {
               
                    $flag = $communique->delete();
                    if ($flag) {
                        return redirect()->back()
                            ->with(['success' => '   تم حذف البيانات بنجاح']);
                    } else {
                        return redirect()->back()
                            ->with(['error' => 'عفوا حدث خطأ ما']);
                    }
                }else {
                    return redirect()->back()
                        ->with(['error' => 'عفوا لا  يمكن حذف البيانات لوجود منتجات  مرتبطة به']);
                }
        } catch (\Exception $ex) {
            return redirect()->back()
                ->with(['error' => 'عفوا حدث خطأ ما' . $ex->getMessage()]);
        }
    }
}

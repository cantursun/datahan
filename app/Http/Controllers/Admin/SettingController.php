<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\Setting\StoreRequest;
use App\Http\Requests\Admin\Setting\UpdateRequest;
use App\Models\Setting;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Yajra\DataTables\Facades\DataTables;

class SettingController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('admin.pages.setting.index');
    }

    public function dataList()
    {
        //Ayarlar Sayfası view datatable.

        $model = Setting::query();

        return DataTables::eloquent($model)
            ->addColumn('process', function (Setting $setting) {
                return '<div class="d-flex">
                            <a title="Düzenle" href="' . route('panel.setting.edit', ['setting' => $setting->id]) . '" class="btn btn-info mr-3"><i class="fa fa-edit"></i></a>
                            <form class="deleteForm" method="post"
                                  data-id="' . $setting->id . '">
                                <button title="Sil" type="submit" class="btn btn-danger"><i
                                        class="fa fa-trash"></i></button>
                            </form>
                        </div>';
            })
            ->rawColumns(['process'])
            ->editColumn('value',function (Setting $setting){
                return Str::limit($setting->value, 40);
            })
            ->editColumn('title',function (Setting $setting){
                return Str::limit($setting->title, 20);
            })
            ->make();
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.pages.setting.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreRequest $request)
    {
        $data = [
            'status' => false,
            'message' => 'Kayıt başarısız!',
        ];

        try{
            $setting = Setting::query()
                ->create([
                    'title' => $request->input('title'),
                    'type' => $request->input('type'),
                    'key' => $request->input('key'),
                    'value' => $request->input('value'),
                ]);

            if ($setting) {
                $data['status'] = true;
                $data['message'] = 'Başarıyla kayıt edildi.';
            }
        }catch (\Exception $exception){
            $data['message']=$exception->getMessage();
        }

        return response()->json($data);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function edit(Setting $setting)
    {
        return view('admin.pages.setting.edit', [
            'setting' => $setting,
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateRequest $request, Setting $setting)
    {
        $data = [
            'status' => false,
            'message' => 'Güncelleme başarısız!',
        ];

        try{
            $setting->title = $request->input('title');
            $setting->type = $request->input('type');
            $setting->value = $request->input('value');
            $setting->save();

            switch ($setting->key){
                case 'emailHost':
                    $this->setEnv('MAIL_HOST',$request->input('value'));
                    break;
                case 'emailAddress':
                    $this->setEnv('MAIL_USERNAME',$request->input('value'));
                    break;
                case 'emailPassword':
                    $this->setEnv('MAIL_PASSWORD',$request->input('value'));
                    break;
                case 'emailPort':
                    $this->setEnv('MAIL_PORT',$request->input('value'));
                    break;
            }

            $data['status'] = true;
            $data['message'] = 'Başarıyla güncellendi.';
        }catch (\Exception $exception){
            $data['message']=$exception->getMessage();
        }

        return response()->json($data);
    }

    function setEnv($name, $value)
    {
        $path = base_path('.env');
        if (file_exists($path)) {
            file_put_contents($path, str_replace(
                $name . '=' . env($name), $name . '=' . $value, file_get_contents($path)
            ));
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @return \Illuminate\Http\Response
     */
    public function destroy(Setting $setting)
    {
        $data = [
            'status' => false,
            'message' => 'Ayar silinemedi!'
        ];

        try{
            $settingControl = $setting->delete();

            if ($settingControl) {
                $data['status'] = true;
                $data['message'] = 'Ayar silindi.';
            }
        }catch (\Exception $exception){
            $data['message']=$exception->getMessage();
        }

        return response()->json($data);
    }
}

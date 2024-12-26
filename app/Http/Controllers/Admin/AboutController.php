<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\About\StoreRequest;
use App\Http\Requests\Admin\About\UpdateRequest;
use App\Models\About;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Yajra\DataTables\Facades\DataTables;

class AboutController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return view('admin.pages.about.index');
    }

    public function dataList()
    {
        //Soru Listesi view datatable.

        $model = About::query();

        return DataTables::eloquent($model)
            ->addColumn('type', function (About $about) {
                return ($about->type == 1) ? 'Birden Çok Yanıt' : (($about->type == 2) ? 'Çoktan Seçmeli' : 'Boşluk Doldurma');
            })
            ->addColumn('process', function (About $about) {
                return '<div class="d-flex">
                            <a title="Düzenle" href="' . route('panel.about.edit', ['about' => $about->id]) . '" class="btn btn-info mr-3"><i class="fa fa-edit"></i></a>
                            <form class="deleteForm" method="post"
                                  data-id="' . $about->id . '">
                                <button title="Sil" type="submit" class="btn btn-danger"><i
                                        class="fa fa-trash"></i></button>
                            </form>
                        </div>';
            })
            ->editColumn('is_published',function (About $about){
                if ($about->is_published == 1)
                    return 'Yayında';
                else
                    return 'Gizle';
            })
            ->rawColumns(['process'])
            ->make();
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('admin.pages.about.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreRequest $request)
    {
        $data = [
            'status' => false,
            'message' => 'Kayıt edilemedi.',
        ];

        try {
            $aboutControl=About::query()
                ->where('slug',Str::slug($request->title,'-'))
                ->count();

            $slug= $aboutControl>1 ? Str::slug($request->title,'-').'-'.uniqid() : Str::slug($request->title,'-');

            $about = About::query()
                ->create([
                    'title' => $request->title,
                    'slug' => $slug,
                    'description' => $request->description,
                    'is_published' => $request->is_published
                ]);

            if ($about) {
                $data['status'] = true;
                $data['message'] = 'Kayıt başarıyla tamamlandı.';
            }
        }catch (\Exception $exception){
            $data['message']=$exception->getMessage();
        }

        return response()->json($data);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(About $about)
    {
        return view('admin.pages.about.edit', compact('about'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateRequest $request, About $about)
    {
        $data = [
            'status' => false,
            'message' => 'Kayıt güncellenemedi.',
        ];
        try {
            $aboutControl=About::query()
                ->where('slug',Str::slug($request->title,'-'))
                ->count();

            $slug= $aboutControl>1 ? Str::slug($request->title,'-').'-'.uniqid() : Str::slug($request->title,'-');

            $about->update([
                'title' => $request->title,
                'slug' => $slug,
                'description' => $request->description,
                'is_published' => $request->is_published
            ]);

            if ($about) {
                $data['status'] = true;
                $data['message'] = 'Kayıt başarıyla güncellendi.';
            }
        }catch (\Exception $exception){
            $data['message']=$exception->getMessage();
        }

        return response()->json($data);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(About $about)
    {
        $data=[
            'status'=>false,
            'message'=>'Kayıt silinemedi!',
        ];

        try{
            $about->delete();

            $data['status']=true;
            $data['message']='Başarıyla silindi!';

        }catch (\Exception $exception){
            $data['message']=$exception->getMessage();
        }

        return response()->json($data);
    }
}

<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\Portfolio\StoreRequest;
use App\Http\Requests\Admin\Portfolio\UpdateRequest;
use App\Models\Portfolio;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Yajra\DataTables\Facades\DataTables;

class PortfolioController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return view('admin.pages.portfolio.index');
    }

    public function dataList()
    {
        //Soru Listesi view datatable.

        $model = Portfolio::query();

        return DataTables::eloquent($model)
            ->addColumn('type', function (Portfolio $portfolio) {
                return ($portfolio->type == 1) ? 'Birden Çok Yanıt' : (($portfolio->type == 2) ? 'Çoktan Seçmeli' : 'Boşluk Doldurma');
            })
            ->addColumn('process', function (Portfolio $portfolio) {
                return '<div class="d-flex">
                            <a title="Düzenle" href="' . route('panel.portfolio.edit', ['portfolio' => $portfolio->id]) . '" class="btn btn-info mr-3"><i class="fa fa-edit"></i></a>
                            <form class="deleteForm" method="post"
                                  data-id="' . $portfolio->id . '">
                                <button title="Sil" type="submit" class="btn btn-danger"><i
                                        class="fa fa-trash"></i></button>
                            </form>
                        </div>';
            })
            ->editColumn('is_published',function (Portfolio $portfolio){
                if ($portfolio->is_published == 1)
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
        return view('admin.pages.portfolio.create');
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
            $portfolioControl=Portfolio::query()
                ->where('slug',Str::slug($request->title,'-'))
                ->count();

            $slug= $portfolioControl>1 ? Str::slug($request->title,'-').'-'.uniqid() : Str::slug($request->title,'-');

            $portfolio = Portfolio::query()
                ->create([
                    'title' => $request->title,
                    'slug' => $slug,
                    'description' => $request->description,
                    'is_published' => $request->is_published
                ]);

            if ($portfolio) {
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
    public function edit(Portfolio $portfolio)
    {
        return view('admin.pages.portfolio.edit', compact('portfolio'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateRequest $request, Portfolio $portfolio)
    {
        $data = [
            'status' => false,
            'message' => 'Kayıt güncellenemedi.',
        ];
        try {
            $portfolioControl=Portfolio::query()
                ->where('slug',Str::slug($request->title,'-'))
                ->count();

            $slug= $portfolioControl>1 ? Str::slug($request->title,'-').'-'.uniqid() : Str::slug($request->title,'-');

            $portfolio->update([
                'title' => $request->title,
                'slug' => $slug,
                'description' => $request->description,
                'is_published' => $request->is_published
            ]);

            if ($portfolio) {
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
    public function destroy(Portfolio $portfolio)
    {
        $data=[
            'status'=>false,
            'message'=>'Kayıt silinemedi!',
        ];

        try{
            $portfolio->delete();

            $data['status']=true;
            $data['message']='Başarıyla silindi!';

        }catch (\Exception $exception){
            $data['message']=$exception->getMessage();
        }

        return response()->json($data);
    }
}

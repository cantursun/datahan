<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Message;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Yajra\DataTables\Facades\DataTables;

class MessageController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('admin.pages.message.index');
    }

    public function dataList()
    {
        $model = Message::query();

        return DataTables::eloquent($model)
            ->addColumn('process', function (Message $message) {
                return '<div class="d-flex">
                            <a title="Görüntüle" href="' . route('panel.message.show', ['message' => $message->id]) . '" class="btn btn-info mr-3"><i class="fa-solid fa-magnifying-glass-arrow-right"></i></a>
                            <form class="deleteForm" method="post"
                                  data-id="' . $message->id . '">
                                <button title="Sil" type="submit" class="btn btn-danger"><i
                                        class="fa fa-trash"></i></button>
                            </form>
                        </div>';
            })
            ->editColumn('created_at', function (Message $message) {
                return date(date($message->created_at));
            })
            ->editColumn('name', function (Message $message) {
                return Str::limit($message->name, 50);
            })
            ->editColumn('email', function (Message $message) {
                return Str::limit($message->email, 50);
            })
            ->editColumn('message', function (Message $message) {
                return Str::limit($message->message, 20);
            })
            ->rawColumns(['process'])
            ->make();
    }

    /**
     * Display the specified resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function show(Message $message)
    {
        return view('admin.pages.message.show', [
            'message' => $message,
        ]);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Message $message)
    {
        $data = [
            'status' => false,
            'message' => 'Mesaj silinemedi!'
        ];

        try{
            $messageControl = $message->delete();
            if ($messageControl) {
                $data['status'] = true;
                $data['message'] = 'Mesaj başarıyla silindi.';
            }
        }catch (\Exception $exception){
            $data['message'] = $exception->getMessage();
        }

        return response()->json($data);
    }
}

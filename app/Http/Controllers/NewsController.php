<?php

namespace App\Http\Controllers;

use App\Models\News;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class NewsController extends Controller
{
    public function index()
    {
        $news = News::all();
        return view('admin.news.list', compact('news'));
    }

    public function create()
    {
        $authors = User::query()
            ->where('role', 'editor')
            ->get();
        return view('admin.news.create-update', compact('authors'));
    }

    public function store(Request $request)
    {
        dd($request->all());
        $folder = "news";
        $publicPath = "storage/" . $folder;

        if(!is_null($request->image))
        {
            $imageFile = $request->file("image");
            $originalName = $imageFile->getClientOriginalName();
            $originalExtension = $imageFile->getClientOriginalExtension();
            $explodeName = explode(".", $originalName)[0];
            $fileName = Str::slug($explodeName) . "." . $originalExtension;

            if (file_exists(public_path($publicPath . $fileName)))
            {
                return redirect()
                    ->back()
                    ->withErrors([
                        'image' => "The same image has been uploaded before."
                    ]);
            }
        }

        $data = $request->except('_token');


        if (!is_null($request->image))
        {
            $data["image"] = $publicPath . "/" . $fileName;
        }

        try {
            News::create($data);

            if (!is_null($request->image))
            {
                $imageFile->storeAs($folder,  $fileName, 'public');
            }
        } catch (\Exception $exception) {
            abort(404, $exception->getMessage());
        }

        return redirect()->route('new.list');
    }

    public function edit(Request $request)
    {
        $new = News::query()
            ->where('id', $request->id)
            ->firstOrFail();

        $authors = User::query()
        ->where('role', 'editor')
        ->get();

        return view('admin.news.create-update', compact('new', 'authors'));
    }

    public function update(Request $request)
    {
        $new = News::query()
            ->where('id', $request->id)
            ->firstOrFail();

        $data = $request->except("_token");

        $folder = "news";
        $publicPath = "storage/" . $folder;

        if (!is_null($request->image))
        {
            $imageFile = $request->file("image");
            $originalName = $imageFile->getClientOriginalName();
            $originalExtension = $imageFile->getClientOriginalExtension();
            $explodeName = explode(".", $originalName)[0];
            $fileName = Str::slug($explodeName) . "." . $originalExtension;

            if (file_exists(public_path($publicPath . $fileName)))
            {
                return redirect()
                    ->back()
                    ->withErrors([
                        'image' => "The same image has been uploaded before."
                    ]);
            }

            $data["image"] = $publicPath . "/" . $fileName;
        }


        $newsQuery = News::query()
            ->where("id", $new->id);

        $newsFind = $newsQuery->first();

        try {
            $newsQuery->update($data);

            if (!is_null($request->image))
            {
                if (file_exists(public_path($newsFind->image)))
                {
                    \File::delete(public_path($newsFind->image));
                }
                $imageFile->storeAs($folder,  $fileName, 'public');
            }
        } catch (\Exception $exception) {
            abort(404, $exception->getMessage());
        }

        return redirect()->route('new.list');
    }

    public function delete(Request $request)
    {
        $news = News::query()
            ->where('id', $request->id)
            ->firstOrFail();

        if (!is_null($news->image))
        {
            if (file_exists(public_path($news->image)))
            {
                \File::delete(public_path($news->image));
            }
        }

        $news->delete();

        return response()->json([
            'status' => 'success',
            'message' => 'Başarılı'
        ])->setStatusCode(200);
    }
}

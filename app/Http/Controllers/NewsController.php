<?php

namespace App\Http\Controllers;

use App\Models\News;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Spatie\Permission\Models\Role;

class NewsController extends Controller
{
    public function index()
    {
        $authUser = session()->get('user');

        $adminRole = Role::query()
            ->where('name', 'admin')
            ->firstOrFail();
        if($authUser->role_id == $adminRole->id)
        {
            $news = News::all();
        }else{
            $news = News::query()
            ->where('author_id', $authUser->id)
            ->get();
        }
        return view('admin.news.list', compact('news'));
    }

    public function create()
    {
        $editorRole = Role::query()
            ->where('name', 'editor')
            ->firstOrFail();

        $authors = User::query()
            ->where('role_id', $editorRole->id)
            ->get();

        return view('admin.news.create-update', compact('authors'));
    }

    public function store(Request $request)
    {
        $data = $request->except('_token');

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

            $data["image"] = $publicPath . "/" . $fileName;
        }

        if(is_null($request->author_id))
        {
            $data['author_id'] = session('user.id');
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

        $editorRole = Role::query()
        ->where('name', 'editor')
        ->firstOrFail();

        $authors = User::query()
            ->where('role_id', $editorRole->id)
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

        if(is_null($request->author_id))
        {
            $data['author_id'] = session('user.id');
        }

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
            'message' => 'Success'
        ])->setStatusCode(200);
    }
}

<?php

namespace App\Http\Controllers\Front;

use App\Http\Controllers\Controller;
use App\Models\News;
use Illuminate\Support\Str;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    public function index()
    {
        $news = News::query()
            ->orderBy('created_at', 'DESC')
            ->paginate(4);

        $news->withPath(route('news.paginate'));

        return view('front.index', compact('news'));
    }

    public function paginateNews(Request $request)
    {
        $news = News::query()
            ->orderBy('created_at', 'DESC')
            ->paginate(4);

        $news->withPath(route('news.paginate'));

        $view = view('layouts.sections.front.partials_newlist', ['news' => $news])->render();

        return response()->json([
            'html' => $view,
            'pagination' => $news->links('pagination::bootstrap-4')->toHtml()
        ])->setStatusCode(200);
    }

    public function newsDetail(Request $request)
    {
        $new = News::query()
            ->with('author')
            ->where('id', $request->id)
            ->firstOrFail();

        return view('front.news-detail', compact('new'));
    }

    public function newsList(Request $request)
    {
        $news = News::query()
            ->with('author')
            ->where('author_id', $request->id)
            ->get();

        return view('front.news-list', compact('news'));
    }

    public function newsCreate()
    {
        return view('front.news-create-update');
    }

    public function newsEdit(Request $request)
    {
        $new = News::query()
            ->where('id', $request->id)
            ->firstOrFail();

        return view('front.news-create-update', compact('new'));
    }

    public function newsStore(Request $request)
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

        $data['author_id'] = session('user.id');

        try {
            News::create($data);

            if (!is_null($request->image))
            {
                $imageFile->storeAs($folder,  $fileName, 'public');
            }
        } catch (\Exception $exception) {
            abort(404, $exception->getMessage());
        }

        return redirect()->route('news.auth-list', ['id' => session('user')['id']]);

    }

    public function newsUpdate(Request $request)
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

        $data['author_id'] = session('user.id');

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

        return redirect()->route('news.auth-list', ['id' => session('user')['id']]);
    }
}

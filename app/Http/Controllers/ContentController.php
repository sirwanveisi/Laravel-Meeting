<?php

namespace App\Http\Controllers;

use App\Http\Requests\UpdateContentRequest;
use App\Models\Content;
use Illuminate\Support\Facades\Cache;

class ContentController extends Controller
{
    /**
     * Manage site content.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        $data = Content::paginate(config('app.pagination'));

        return view('admin.content.index', [
            'page' => __('Content'),
            'data' => $data,
        ]);
    }

    //return the content page
    public function edit($id)
    {
        $model = Content::find($id);

        return view('admin.content.edit', [
            'page' => __('Content'),
            'model' => $model,
        ]);
    }

    //update content
    public function update(UpdateContentRequest $request)
    {
        if (isDemoMode()) return back()->with('error', __('This feature is not available in demo mode'));
        
        $model = Content::find($request->id);
        $model->value = $request->value;
        $model->save();
        Cache::forget('content');
        return redirect('/content')->with('success', __('Settings saved.'));
    }
}

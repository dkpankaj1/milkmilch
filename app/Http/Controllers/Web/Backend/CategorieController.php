<?php

namespace App\Http\Controllers\Web\Backend;

use App\Http\Controllers\Controller;
use App\Http\Requests\Web\Backend\CategorieStoreRequest;
use App\Http\Requests\Web\Backend\CategorieUpdateRequest;
use App\Models\Categorie;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\View\View;

class CategorieController extends Controller
{
    /**
     * Display a paginated listing of categories.
     *
     * @return View
     */
    public function index(): View
    {
        $categories = Categorie::latest()->paginate(10);
        return view('backend.categorie.index', compact('categories'));
    }

    /**
     * Show the form for creating a new category.
     *
     * @return View
     */
    public function create(): View
    {
        return view('backend.categorie.create');
    }

    /**
     * Store a newly created category in the storage.
     *
     * @param  CategorieStoreRequest  $request
     * @return RedirectResponse
     */
    public function store(CategorieStoreRequest $request): RedirectResponse
    {
        try {
            Categorie::create([
                'name' => $request->name,
                'slug' => $request->slug,
                'description' => $request->description,
                'status' => $request->status
            ]);

            // Display success message and redirect back
            toastr()->success(trans('crud.create', ['model' => 'category']));
            return redirect()->back();

        } catch (\Exception $e) {
            // Display error message and redirect back in case of an exception
            toastr()->error($e->getMessage());
            return redirect()->back();
        }
    }

    /**
     * Show the form for editing an existing category.
     *
     * @param  Categorie  $category
     * @return View
     */
    public function edit(Categorie $category): View
    {
        return view('backend.categorie.edit', ['categorie' => $category]);
    }

    /**
     * Update the specified category in the storage.
     *
     * @param  CategorieUpdateRequest  $request
     * @param  Categorie  $category
     * @return RedirectResponse
     */
    public function update(CategorieUpdateRequest $request, Categorie $category): RedirectResponse
    {
        try {
            $category->update([
                'name' => $request->name ?? $category->name,
                'slug' => $request->slug ?? $category->slug,
                'description' => $request->description ?? $category->description,
                'status' => $request->status
            ]);

            // Display success message and redirect back
            toastr()->success(trans('crud.update', ['model' => 'category']));
            return redirect()->back();

        } catch (\Exception $e) {
            // Display error message and redirect back in case of an exception
            toastr()->error($e->getMessage());
            return redirect()->back();
        }
    }

    /**
     * Show the confirmation for deleting a category.
     *
     * @param  Categorie  $category
     * @return View
     */
    public function delete(Categorie $category): View
    {
        return view('backend.categorie.delete', ['categorie' => $category]);
    }

    /**
     * Remove the specified category from storage.
     *
     * @param  Categorie  $category
     * @return RedirectResponse
     */
    public function destroy(Categorie $category): RedirectResponse
    {
        try {
            // Delete the specified category
            $category->delete();

            // Display success message and redirect back
            toastr()->success(trans('crud.delete', ['model' => 'category']));
            return redirect()->back();
        } catch (\Exception $e) {
            // Display error message and redirect back in case of an exception
            toastr()->error($e->getMessage());
            return redirect()->back();
        }
    }
}

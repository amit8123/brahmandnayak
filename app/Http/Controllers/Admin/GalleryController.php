<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\GalleryRequest;
use App\Models\Gallery;
use App\Models\GalleryCategory;
use Illuminate\Http\Request;

class GalleryController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $galleryList = Gallery::orderBy('id', 'DESC')->get();
        return view('layouts.backend.pages.admin.gallery.index', compact('galleryList'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $categoryList = GalleryCategory::orderBy('id', 'DESC')->get();
        return view('layouts.backend.pages.admin.gallery.create', compact('categoryList'));
    }


    /**
     * Upload the selected attachments
     * @param Request $request
     * @return JsonResponse
     * @throws Exception
     */
    public function imageUpload(GalleryRequest $request)
    {
        $image = $request->file('document');
        //attach files to the file
        if ($request->hasFile('document')) {

            if ($image->isValid()) {

                $fileOriginalExtension = $image->getClientOriginalExtension();
                $allowed_file_types = ['JPG', 'PNG', 'BMP', 'JPEG', 'jpg', 'png', 'gif', 'bmp', 'jpeg',]; // allowed extensions

                if (in_array($fileOriginalExtension, $allowed_file_types)) {
                    $fileName = 'file_attachment_' . mt_rand() . time() . '.' . $image->getClientOriginalExtension();
                    $image->move(public_path('assets/backend/images/gallery_images'), $fileName);
                    $completePath = asset('assets/backend/images/gallery_images') . '/' . $fileName;
                    return response()->json(array('success' => true, 'message' => 'Your file was successfully uploaded', 'image_path' => $completePath, 'image_name' => $fileName));
                } else {
                    return response()->json(array('success' => false, 'message' => 'Only JPG,PNG,GIF,BMP files are allowed'));
                }
            } else {
                return response()->json(array('success' => false, 'message' => 'A valid file was not selected. '));
            }
        } else {
            return response()->json(array('success' => false, 'message' => 'No file was selected. '));
        }
    }


    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(GalleryRequest $request)
    {
        $operationStatus = true;

        $category = $request->input('category');
        $galleryImages = $request->input('document');
        foreach ($galleryImages as $key => $galleryImage) {
            //store in database
            $newFile = new Gallery();
            $newFile->category_id = $category;
            $newFile->file_name = $key;
            $newFile->file_path = $galleryImage;
            if (!$newFile->save()) {
                $operationStatus = false;
            }
        }
        if ($operationStatus) {
            $request->session()->flash('flash_notification.message', 'New Gallery was successfully created.');
            $request->session()->flash('flash_notification.level', 'success');
            return redirect()->route('admin.gallery.index');
        } else {

            $request->session()->flash('flash_notification.message', 'Something went wrong, please try again later.');
            $request->session()->flash('flash_notification.level', 'danger');
            return redirect()->route('admin.gallery.create');
        }
    }


    /**
     * Remove the specified resource from storage.
     *
     * @param GalleryRequest $request
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(GalleryRequest $request, $id)
    {
        $gallery = Gallery::find($id);
        if (isset($gallery)) {

            $operationStatus = $gallery->delete();

            if ($operationStatus) {

                $request->session()->flash('flash_notification.message', 'Photo was successfully deleted.');
                $request->session()->flash('flash_notification.level', 'success');
                return redirect()->route('admin.gallery.index');
            } else {
                $request->session()->flash('flash_notification.message', 'Something went wrong, please try again later.');
                $request->session()->flash('flash_notification.level', 'danger');
                return redirect()->route('admin.gallery.index');
            }
        } else {
            $request->session()->flash('flash_notification.message', 'Something went wrong, please try again later.');
            $request->session()->flash('flash_notification.level', 'danger');
            return redirect()->route('admin.gallery.index');
        }
    }
    /**
     * Display the deleted resources
     *
     * @return \Illuminate\Http\Response
     */

    public function showDeleted()
    {
        $galleryList = Gallery::onlyTrashed()->get();
        return view('layouts.backend.pages.admin.gallery.deleted', compact('galleryList'));
    }

    /**
     * Restore the selected resource
     *
     * @param GalleryRequest $request
     * @param $id
     * @return \Illuminate\Http\RedirectResponse
     */

    public function restoreDeleted(GalleryRequest $request, $id)
    {

        $gallery = Gallery::withTrashed()->find($id);
        if (isset($gallery)) {

            $operationStatus = $gallery->restore();

            if ($operationStatus) {
                $request->session()->flash('flash_notification.message', 'Photo successfully restored. ');
                $request->session()->flash('flash_notification.level', 'success');
                return redirect()->route('admin.gallery.deleted.show');
            } else {
                $request->session()->flash('flash_notification.message', 'An error occurred, please try again later. ');
                $request->session()->flash('flash_notification.level', 'danger');
                return redirect()->route('admin.gallery.deleted.show');
            }
        } else {
            $request->session()->flash('flash_notification.message', 'An error occurred, please try again later. ');
            $request->session()->flash('flash_notification.level', 'danger');
            return redirect()->route('admin.gallery.deleted.show');
        }
    }
}

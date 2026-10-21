<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\SliderRequest;
use App\Models\Slider;
use Illuminate\Http\Request;

class SliderController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $sliderList = Slider::orderBy('id', 'DESC')->get();
        return view('layouts.backend.pages.admin.slider.index', compact('sliderList'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('layouts.backend.pages.admin.slider.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(SliderRequest $request)
    {
        //upload the file and link it up
        if ($request->hasFile('slider-image')) {

            if ($request->file('slider-image')->isValid()) {

                $title = $request->input('title');
                $image_file = $request->file('slider-image'); // the image  file
                $image_file_name = $image_file->getClientOriginalName(); //the file name with extension
                $image_file_extension = $image_file->getClientOriginalExtension(); // the file extension
                $image_file_path = pathinfo($image_file_name, PATHINFO_FILENAME) . '_' . time() . '.' . $image_file_extension; //generate new random name of the file

                $allowed_file_types = ['jpg', 'jpeg', 'png', 'JPEG', 'JPG', 'PNG']; // allowed extensions

                if (in_array($image_file_extension, $allowed_file_types)) {

                    // move uploaded files to directories and generate url
                    $image_file->move(public_path('assets/backend/images/slider_images'), $image_file_path);

                    //store in database
                    $newFile = new Slider();
                    $newFile->title = $title;
                    $newFile->image_name = $image_file_name;
                    $newFile->image_path = $image_file_path;
                    $fileUploadStatus = $newFile->save();

                    if ($fileUploadStatus) {
                        $request->session()->flash('flash_notification.message', 'New Slider was successfully created.');
                        $request->session()->flash('flash_notification.level', 'success');
                        return redirect()->route('admin.slider.index')->withInput();
                    } else {

                        $request->session()->flash('flash_notification.message', 'Something went wrong, please try again later.');
                        $request->session()->flash('flash_notification.level', 'danger');
                        return redirect()->route('admin.slider.create');
                    }
                } else {

                    $request->session()->flash('flash_notification.message', 'Only JPG,JPEG,PNG files are allowed, no other format is allowed.');
                    $request->session()->flash('flash_notification.level', 'danger');
                    return redirect()->route('admin.slider.create')->withInput();
                }
            }
        } else {
            $request->session()->flash('flash_notification.message', 'Something went wrong, please try again later.');
            $request->session()->flash('flash_notification.level', 'danger');
            return redirect()->route('admin.slider.create');
        }
    }


    /**
     * Show the form for editing the specified resource.
     *
     * @param SliderRequest $request
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function edit(SliderRequest $request, $id)
    {
        $slider = Slider::find($id);
        if (isset($slider)) {
            return view('layouts.backend.pages.admin.slider.edit', compact('slider'));
        } else {
            $request->session()->flash('flash_notification.message', 'Something went wrong, please try again later.');
            $request->session()->flash('flash_notification.level', 'danger');
            return redirect()->route('admin.slider.index');
        }
    }

    /**
     * Update the specified resource in storage.
     *
     * @param Request $request
     * @param  int $id
     * @return void
     */
    public function update(SliderRequest $request, $id)
    {
        $title = $request->input('title');

        //store in database
        $updateFile = Slider::find($id);
        $updateFile->title = $title;
        $UpdateStatus = $updateFile->save();

        if ($UpdateStatus) {

            if ($request->hasFile('slider-image')) {
                if ($request->file('slider-image')->isValid()) {

                    $image_file = $request->file('slider-image'); // the image  file
                    $image_file_name = $image_file->getClientOriginalName(); //the file name with extension
                    $image_file_extension = $image_file->getClientOriginalExtension(); // the file extension
                    $image_file_path = pathinfo($image_file_name, PATHINFO_FILENAME) . '_' . time() . '.' . $image_file_extension; //generate new random name of the file
                    $allowed_file_types = ['jpg', 'jpeg', 'png', 'JPEG', 'JPG', 'PNG']; // allowed extensions

                    if (in_array($image_file_extension, $allowed_file_types)) {

                        // move uploaded files to directories and generate url
                        $image_file->move(public_path('assets/backend/images/slider_images'), $image_file_path);

                        //store in database
                        $updateFile = Slider::find($id);
                        $updateFile->image_name = $image_file_name;
                        $updateFile->image_path = $image_file_path;
                        $FileUpdateStatus = $updateFile->save();

                        if ($FileUpdateStatus) {
                            $request->session()->flash('flash_notification.message', 'New Slider was successfully updated.');
                            $request->session()->flash('flash_notification.level', 'success');
                            return redirect()->route('admin.slider.index')->withInput();
                        } else {
                            $request->session()->flash('flash_notification.message', 'Something went wrong, please try again later.');
                            $request->session()->flash('flash_notification.level', 'danger');
                            return redirect()->route('admin.slider.edit', $id);
                        }
                    } else {
                        $request->session()->flash('flash_notification.message', 'Only JPG,JPEG,PNG files are allowed, no other format is allowed.');
                        $request->session()->flash('flash_notification.level', 'danger');
                        return redirect()->route('admin.slider.edit', $id)->withInput();
                    }
                }
            } else {
                $request->session()->flash('flash_notification.message', 'New Slider was successfully updated.');
                $request->session()->flash('flash_notification.level', 'success');
                return redirect()->route('admin.slider.index');
            }
        } else {
            $request->session()->flash('flash_notification.message', 'Something went wrong, please try again');
            $request->session()->flash('flash_notification.level', 'danger');
            return redirect()->route('admin.slider.edit', $id);
        }
    }


    /**
     * Remove the specified resource from storage.
     *
     * @param SliderRequest $request
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(SliderRequest $request, $id)
    {
        $slider = Slider::find($id);
        if (isset($slider)) {

            $operationStatus = $slider->delete();

            if ($operationStatus) {

                $request->session()->flash('flash_notification.message', 'Slider was successfully deleted.');
                $request->session()->flash('flash_notification.level', 'success');
                return redirect()->route('admin.slider.index');
            } else {
                $request->session()->flash('flash_notification.message', 'Something went wrong, please try again later.');
                $request->session()->flash('flash_notification.level', 'danger');
                return redirect()->route('admin.slider.index');
            }
        } else {
            $request->session()->flash('flash_notification.message', 'Something went wrong, please try again later.');
            $request->session()->flash('flash_notification.level', 'danger');
            return redirect()->route('admin.slider.index');
        }
    }
    /**
     * Display the deleted resources
     *
     * @return \Illuminate\Http\Response
     */

    public function showDeleted()
    {
        $sliderList = Slider::onlyTrashed()->get();
        return view('layouts.backend.pages.admin.slider.deleted', compact('sliderList'));
    }

    /**
     * Restore the selected resource
     *
     * @param SliderRequest $request
     * @param $id
     * @return \Illuminate\Http\RedirectResponse
     */

    public function restoreDeleted(SliderRequest $request, $id)
    {

        $slider = Slider::withTrashed()->find($id);
        if (isset($slider)) {

            $operationStatus = $slider->restore();

            if ($operationStatus) {
                $request->session()->flash('flash_notification.message', 'Slider successfully restored. ');
                $request->session()->flash('flash_notification.level', 'success');
                return redirect()->route('admin.slider.deleted.show');
            } else {
                $request->session()->flash('flash_notification.message', 'An error occurred, please try again later. ');
                $request->session()->flash('flash_notification.level', 'danger');
                return redirect()->route('admin.slider.deleted.show');
            }
        } else {
            $request->session()->flash('flash_notification.message', 'An error occurred, please try again later. ');
            $request->session()->flash('flash_notification.level', 'danger');
            return redirect()->route('admin.slider.deleted.show');
        }
    }
}

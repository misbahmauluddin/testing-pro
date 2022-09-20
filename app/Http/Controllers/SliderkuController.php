<?php

namespace App\Http\Controllers;

use App;
use Botble\Base\Enums\BaseStatusEnum;
use Botble\Base\Http\Responses\BaseHttpResponse;
use Botble\Base\Supports\RepositoryHelper;
use Botble\Blog\Repositories\Interfaces\PostInterface;
use Botble\Location\Repositories\Interfaces\CityInterface;
use Botble\RealEstate\Enums\ModerationStatusEnum;
use Botble\RealEstate\Enums\PropertyStatusEnum;
use Botble\RealEstate\Enums\PropertyTypeEnum;
use Botble\RealEstate\Models\Account;
use Botble\RealEstate\Repositories\Interfaces\AccountInterface;
use Botble\RealEstate\Repositories\Interfaces\ProjectInterface;
use Botble\RealEstate\Repositories\Interfaces\PropertyInterface;
use Botble\Theme\Http\Controllers\PublicController;
use Illuminate\Http\Response;
use RealEstateHelper;
use SeoHelper;
use Theme;
use Theme\FlexHome\Http\Resources\AgentHTMLResource;
use Theme\FlexHome\Http\Resources\PostResource;
use Theme\FlexHome\Http\Resources\PropertyHTMLResource;
use Theme\FlexHome\Http\Resources\PropertyResource;

use Illuminate\Http\Request;
use App\Models\Sliderku;


class SliderkuController extends Controller
{
    public function index()
    {
        //
        return view('sliderku.index');
    }

    public function store(Request $request)
    {
        if ($request->idslider == '') {
            $slider = new Sliderku();
            $slider->name = $request->name;
            $slider->link = $request->link;

            if ($request->file('img')) {

                $upload_file =  $request->file('img');
                $fileoriginal = $upload_file->getClientOriginalName();
                $nama_file = date('mdYHis') . uniqid() . $fileoriginal;
                $destinationPath = 'public/uploaded/sliderku/';
                $extension_file = $upload_file->getClientOriginalExtension();
                $upload_success_file = $upload_file->move($destinationPath, $nama_file);

                $slider->img = $nama_file;
            }

            $slider->save();

            $this->response['status'] = 'success';
            $this->response['message'] = 'Slider berhasil di tambah!';
            return response($this->response);
        } else {

            $slider = Sliderku::where('id', $request->idslider)->first();
            $slider->name = $request->name;
            $slider->link = $request->link;

            if ($request->file('img')) {
                if ($slider->img != '') {
                    $path = 'uploaded/sliderku/' . $slider->img;
                    unlink(public_path($path));
                }

                $upload_file =  $request->file('img');
                $fileoriginal = $upload_file->getClientOriginalName();
                $nama_file = date('mdYHis') . uniqid() . $fileoriginal;
                $destinationPath = 'public/uploaded/sliderku/';
                $extension_file = $upload_file->getClientOriginalExtension();
                $upload_success_file = $upload_file->move($destinationPath, $nama_file);

                $slider->img = $nama_file;
            }

            $slider->save();

            $this->response['status'] = 'success';
            $this->response['message'] = 'Slider berhasil di update!';
            return response($this->response);
        }
    }

    public function data()
    {
        try {

            $datas = Sliderku::get();

            if ($datas) {
                $report_data    = '';
                $no             = 1;

                $report_data .= '<table class="table mt-4">
                                <thead>
                                    <tr>
                                        <th scope="col" width="5%">#</th>
                                        <th scope="col" width="25%">Nama File</th>
                                        <th scope="col">Link</th>
                                        <th scope="col" class="text-center" width="15%">File Image</th>
                                        <th scope="col" class="text-center" width="15%">Action</th>
                                    </tr>
                                </thead>
                                <tbody>';
                foreach ($datas as $data) {
                    $urlimg =   url('/uploaded/sliderku/' . $data->img);
                    $report_data .= '<tr>
                                        <td scope="row">' . $no++ . '</td>
                                        <td>' . $data->name . '</td>
                                        <td>' . $data->link . '</td>
                                        <td class="text-center"><img height="40" width="120" src="' . $urlimg . '" alt="' . $data->name . '" style="border-radius: 5px;"></td>
                                        <td class="text-center">
                                            <a href="javascript:void(0)" class="btn btn-info btn-sm editslider" ket-id="' . encrypt($data->id) . '"><i class="fas fa-edit"></i></a>
                                            <a href="javascript:void(0)" class="btn btn-danger btn-sm hapuslider" ket-id="' . encrypt($data->id) . '" ket-data="' . $data->name . '"><i class="fa fa-trash"></i></a>
                                        </td>
                                        ';
                }

                $report_data .= '</tbody>
                            </table>';

                $response['status']     = 'success';
                $response['message']    = 'Data berhasil ditampilkan';
                $response['data']       = $report_data;
            } else {
                $response['status']     = 'fail';
                $response['message']    = 'Data tidak tersedia!';
            }
        } catch (QueryException $ex) {
            $response['status']     = 'fail';
            $response['message']    = 'Gagal memuat data, coba lagi!';
        }



        return response()->json($response);
    }

    public function show($id)
    {
        $sumber = Sliderku::where('id', decrypt($id))->first();
        return response()->json(['data' => $sumber]);
    }

    public function destroy(Request $request)
    {
        $id = decrypt($request->ketid);
        $sumber = Sliderku::where('id', $id)->first();

        if ($sumber->img != '') {
            $path = 'uploaded/sliderku/' . $sumber->img;
            unlink(public_path($path));
        }

        $sumber->delete();

        $this->response['status'] = 'success';
        $this->response['msg'] = 'Slider berhasil di hapus!';
        return response($this->response);
    }
}

<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use App\Models\admin\getNews;
use App\Models\admin\searchNews;
use Illuminate\Http\Request;

use function PHPUnit\Framework\isEmpty;

class AdminNewsController extends Controller
{
    //
    public function show(getNews $getNews)
    {
        $news = $getNews->getDataNews();
        // dd($news);

        return view('admin.data.newsList', compact('news'));
    }

    public function searchNews(Request $request, searchNews $searchNews, getNews $getNews)
    {
        $startDate = $request->input(('start-date'));
        $endDate = $request->input('end-date');



        if (empty($startDate) && empty($endDate)) {
            $news = $getNews->getDataNews();
        } else if (empty($startDate)) {
            $news = $searchNews->findByNewsEndDate($endDate);
        } else if (isEmpty($endDate)) {
            $news = $searchNews->findByNewsStartDate($startDate);
        } else {
            $news = $searchNews->findByNews($startDate, $endDate);
        }

        return view('admin.data.newsList', compact('news', 'startDate', 'endDate'));
    }

    public function detailsNews(Request $request)
    {
        $id = $request->id;
        $details = getNews::find($id);
        // dd($details->getfillable()[0]);

        return view('admin.data.news', compact('details'));
    }

    public function edit(Request $request)
    {
        $NewsData = getNews::find($request->id);
        $object = $request->object;
        $NewsData->$object = $request->dataNews;
        $NewsData->save();

        return response()->json(['message' => $object . ' updated successfully']);
    }

    public function updateImages(Request $request)
    {
        $imageName = $this->saveImage($request->image);

        // Cập nhật thông tin ảnh vào cơ sở dữ liệu
        $dataNews = getNews::find($request->id);
        if ($dataNews) {
            $dataNews->images = $imageName; // Cập nhật trường 'images'
            $dataNews->save(); // Lưu thay đổi
            return response()->json(['message' => '画像をアップデートしました。', 'fileName' => $imageName]);
        } else {
            return response()->json(['message' => 'まだログインしていません。'], 404);
        }
    }

    private function saveImage($image)
    {
        if ($image) {
            // Tạo một tên file duy nhất cho ảnh
            $filename = time() . '_' . $image->getClientOriginalName();

            // Xác định đường dẫn lưu file
            $imagePath = public_path('images');

            // Di chuyển file đến thư mục đích
            $image->move($imagePath, $filename);

            // Trả về ten file
            return $filename;
        }

        return null; // Trả về null nếu không có ảnh
    }
}

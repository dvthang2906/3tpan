<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use App\Models\admin\getNews;
use App\Models\admin\searchNews;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;

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

    public function addNews()
    {
        return view("admin.data.addNews");
    }

    public function postAddNews(Request $request)
    {
        $title = $request->title;
        $content = $request->content;
        $images = $request->images;
        $audio = $request->audio;


        $imageName = $this->saveImage($images);
        $audioName = $this->saveAudio($audio);

        $data = [
            "title" => $title,
            "content" => $content,
            "images" => $imageName,
            "audio" => $audioName,
            "created_at" => now(),
            "updated_at" => now()
        ];

        $addNews = new getNews();
        if ($addNews) {
            $addNews->insertdata($data);
            return redirect()->route('show-news')->with('msg', 'データをupdate成功。');
        } else {
            return redirect()->route('show-news')->with('msg', 'error');
        }
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
        if ($request->hasFile('file') && $request->has('id') && $request->has('object')) {
            // Lấy file từ request
            $file = $request->file;
            $id = $request->id;
            $object = $request->object;
        }
        $imageName = $this->saveImage($file);

        // Cập nhật thông tin ảnh vào cơ sở dữ liệu
        $dataNews = getNews::find($id);
        if ($dataNews) {
            $dataNews->$object = $imageName; // Cập nhật trường 'images'
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

    private function saveAudio($audio)
    {
        if ($audio) {
            // Tạo một tên file duy nhất cho audio
            $filename = time() . '_' . uniqid() . '_' . $audio->getClientOriginalName();

            try {
                // Xác định đường dẫn lưu file
                $audioPath = public_path('audio');

                // Di chuyển file đến thư mục đích
                $audio->move($audioPath, $filename);

                // Trả về tên file
                return $filename;
            } catch (\Exception $e) {
                // Xử lý lỗi và trả về null hoặc thông báo lỗi
                return null; // hoặc trả về thông tin lỗi
            }
        }

        return null; // Nếu không có file được cung cấp
    }
}

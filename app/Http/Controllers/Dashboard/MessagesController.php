<?php

namespace App\Http\Controllers\Dashboard;

use App\Helpers\File;
use App\Helpers\Response;
use Illuminate\Http\Request;
use App\Models\Dashboard\Books;
use App\Models\Dashboard\Messages;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Storage;
use Pion\Laravel\ChunkUpload\Receiver\FileReceiver;
use Pion\Laravel\ChunkUpload\Handler\HandlerFactory;

class MessagesController extends Controller
{

    // Cover Attr
    const COVER_PATH      = 'messages/covers';
    const COVER_MEDIUM    = '720*400*90';
    const COVER_SMALL     = '370*205*90';
    const COVER_LARGE     = '1000*600*75';
    const COVER_EXTENSION = 'webp';
    const COVER_HASH_NAME = false;

    // File Attr
    const FILES_PATH = 'messages/files';
    const FILES_HASH_NAME = false;


    public function index()
    {

        // Check If Have Search
        $qName = request('name');

        $rows = Messages::orderByDesc('id');

        if ($qName != null) {
            $rows = $rows->where('normalize_name', 'like', "%" . normalizeName($qName) . "%");
        }


        return view('dashboard.messages.index', [
            'qName' => $qName,
            'rows' => $rows->paginate(50)
        ]);
    }


    public function create()
    {
        // Check If HAVE Upload
        // $id = intval(request('upload'));
        // if ($id == 0) {
        //     return redirect(adminUrl('books'));
        // } else {
        //     // Check If Have This Row
        //     echo $id;
        //     $row = Messages::where('id', $id)->first();
        // }
        // die();
        return view('dashboard.messages.create');
    }


    public function store(Request $request)
    {
        // Validate
        $data = $request->validate([
            'cover'     => 'required|mimes:jpeg,jpg,png,webp,bmp,tiff|max:5400',
            //    'book_file' => 'required|mimes:pdf',
            'name'      => 'required|unique:books,name|max:255',
            'desc'      => 'required|min:40|max:1500',
            'have_book' => 'required|in:1,0',
        ]);

        // Upload Cover
        $data['cover'] = File::upload('cover', [
            'path'      => self::COVER_PATH,
            'large'     => self::COVER_LARGE,
            'medium'    => self::COVER_MEDIUM,
            'small'     => self::COVER_SMALL,
            'extension' => self::COVER_EXTENSION,
            'hash'      => self::COVER_HASH_NAME,
        ]);

        // Upload File
        $data['book_file'] = '0';


        // Set Admin Id In $data
        $data['add_by'] = adminId();
        $data['normalize_name'] = normalizeName($data['name']);


        // Insert Data
        $insert =  Messages::create($data);


        // Return Message
        return Response::success('تم اضافة معلومات عن الرسالة وجاري توجيهك لرفع ملف الرسالة ', ['style' => 'toastr', 'reset' => true, 'time_out' => '1.5', 'redirect' => adminUrl('messages/edit/' . $insert->id . '?upload=show')]);
    }



    public function edit($id)
    {
        $row = Messages::find($id);
        if ($row == null) {
            return redirect(adminUrl('books'));
        }
        return view('dashboard.messages.edit', compact('row'));
    }


    public function update(Request $request, Books $books)
    {
        // Get Row
        $row = Messages::where('id', $request->id)->first();

        if ($row == null) {
            // Return Message
            return Response::error('البيانات المطلوب تعديلها غير موجودة !', ['style' => 'toastr']);
        }


        // Validate
        $data = $request->validate([
            'cover'     => 'nullable|mimes:jpeg,jpg,png,webp,bmp,tiff|max:5400',
            'book_file' => 'nullable|mimes:pdf',
            'name'      => 'required|unique:books,name,' . $request->id . '|max:255',
            'desc'      => 'required|min:40|max:1500',
            'have_book' => 'required|in:1,0',

        ]);

        // Upload Cover
        $data['cover'] = File::upload('cover', [
            'path'      => self::COVER_PATH,
            'large'     => self::COVER_LARGE,
            'medium'    => self::COVER_MEDIUM,
            'small'     => self::COVER_SMALL,
            'extension' => self::COVER_EXTENSION,
            'hash'      => self::COVER_HASH_NAME,
            'delete'    => $row->cover
        ]);

        // Upload File
        $data['book_file'] = File::upload('book_file', [
            'path'     => self::FILES_PATH,
            'hash'     => self::FILES_HASH_NAME,
            'delete'   => $row->book_file
        ]);


        // Set Admin Id In $data
        $data['add_by'] = adminId();
        $data['normalize_name'] = normalizeName($data['name']);



        // Insert Data
        $row->update($data);


        // Return Message
        return Response::success('تم تحديث بيانات الرسالة بنجاح', ['style' => 'toastr']);
    }


    public function destroy()
    {
        $id = request('id');

        // Get Row And Check IF IN Database
        $row = Messages::find($id);

        // Check If Not Exist The Row IN Database
        if (empty($row)) {

            // Message
            return Response::error('لا يمكن تنفيذ هذا الإجراء، فهذه البيانات غير متوفرة في النظام', ['style' => 'toastr']);
        } else {

            File::delete(self::COVER_PATH, $row->cover);
            File::delete(self::FILES_PATH, $row->book_file);
            $row->delete();

            // Message
            return Response::success("تم الحذف بنجاح", ['style' => 'toastr']);
        }
    }













    public function uploadLargeFiles(Request $request)
    {
        $receiver = new FileReceiver('file', $request, HandlerFactory::classFromRequest($request));

        if (!$receiver->isUploaded()) {
            // file not uploaded
        }

        $fileReceived = $receiver->receive(); // receive file
        if ($fileReceived->isFinished()) { // file uploading is complete / all chunks are uploaded
            $file = $fileReceived->getFile(); // get file
            $extension = $file->getClientOriginalExtension();
            $fileName = str_replace('.' . $extension, '', $file->getClientOriginalName()); //file name without extenstion
            $fileName .= '_' . time() . '.' . $extension; // a unique file name

            $disk = Storage::disk(config('filesystems.default'));
            $path = $disk->putFileAs('public/large/messages/files', $file, $fileName);

            // delete chunked file
            unlink($file->getPathname());

            $row = Messages::where('id', $request->id)->first();

            File::delete(self::FILES_PATH, $row->book_file);

            // Update Row
            $row->update(['book_file' => $fileName]);

            return [
                'path' => largeAsset('messages/files/' . $fileName),
                'filename' => $fileName
            ];
        }

        // otherwise return percentage informatoin
        $handler = $fileReceived->handler();
        return [
            'done' => $handler->getPercentageDone(),
            'status' => true
        ];
    }
}

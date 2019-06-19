<?php
namespace App\Http\Controllers;


use Illuminate\Http\Request;
// use Validator;

class UploadController extends Controller
{
	public function upload(){
		return view('upload');
	}

	public function proses_upload(Request $request){
		// menyimpan data file yang diupload ke variabel $file
		// $this->validate($request, [
		//    'file' => 'required',
		//    'zip' => 'required',
  //       ]);
        $pdf = $request->file('pdf');
		$file = $request->file('zip');
		// return $pdf;
		if($pdf != null){
			$userId = $request->session()->get('activeUser')->user_id;
	        $pdf->move('extract/'.$userId.'/'.'pdf/',$pdf->getClientOriginalName());
		}
		if($file != null){
	        $filename = substr($file->getClientOriginalName(),0,-4);
	        $fileExtension = $file->getClientOriginalExtension();
	        $fileNameWithExtension = $filename.'.'.$fileExtension;
	        // $filePath = $file->getRealPath();
	        // $fileSize = $file->getSize();
	        // $fileType = $file->getMimeType();
	    	$uploadFolder = 'uploaded File';

	        $newName = substr($filename,9);
	        $file->move($uploadFolder,$fileNameWithExtension);

	        // Ekstraksi file
	        $userId = $request->session()->get('activeUser')->user_id;
	        $Path = public_path('uploaded File/'.$fileNameWithExtension);
	        \Zipper::make($Path)->extractTo('extract/'.$userId.'/'.'zip/');

	        // Renaming File
	        $length = strlen($filename);
	        $renamePath = 'extract/'.$userId.'/'.'zip/';
	        $filesInFolder = \File::files($renamePath);
	        foreach($filesInFolder as $path) { 
	              $file = pathinfo($path);
	              $name = $file['basename'];
	              $fullExtension = substr($name,$length);
	              rename($renamePath.$name,$renamePath.$userId.$fullExtension);
	        }
		}

		
        
  // menyimpan data file yang diupload ke variabel $file



		// return $path;
		echo "success";



  //     	        // nama file
		// echo 'File Name: '.$file->getClientOriginalName();
		// echo '<br>';

  //     	        // ekstensi file
		// echo 'File Extension: '.$file->getClientOriginalExtension();
		// echo '<br>';

  //     	        // real path
		// echo 'File Real Path: '.$file->getRealPath();
		// echo '<br>';

  //     	        // ukuran file
		// echo 'File Size: '.$file->getSize();
		// echo '<br>';

  //     	        // tipe mime
		// echo 'File Mime Type: '.$file->getMimeType();

  //     	        // isi dengan nama folder tempat kemana file diupload
		// $tujuan_upload = public_path('3578');

  //               // upload file
		// $file->move($tujuan_upload,$file->getClientOriginalName());
	}
}
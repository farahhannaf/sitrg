<?php
namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\PdfModel;
use Illuminate\Filesystem\Filesystem;
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
			$userId = $request->session()->get('activeUser')->kode_wil;
	        $path = $pdf->move('uploaded File/'.$userId.'/'.'Pdf/',$pdf->getClientOriginalName());
	        $datapdf = new PdfModel();
	        $datapdf->file_pdf=$path;
	        $datapdf->kode_wil=$userId;
	        $datapdf->id_pdf=strtotime(date("Y-m-d H:i:s"));
	        $datapdf->save();

		}
		if($file != null){
	        $filename = substr($file->getClientOriginalName(),0,-4);
	        $fileExtension = $file->getClientOriginalExtension();
	        $fileNameWithExtension = $filename.'.'.$fileExtension;
	        // $filePath = $file->getRealPath();
	        // $fileSize = $file->getSize();
	        // $fileType = $file->getMimeType();
	    	
	        $userId = $request->session()->get('activeUser')->kode_wil;
	        $uploadFolder = 'uploaded File';

	        // code buat rename file double
	        $zipFolder = 'uploaded File/'.$userId.'/'.'Zip/';
	        $i = 1;
	        while (file_exists($zipFolder.$fileNameWithExtension)) {
	            $new_fname = $filename.'-'.$i;
	            $fileNameWithExtension = $new_fname.'.'.$fileExtension;
	            $i++;
	        }

	        $newName = substr($filename,9);
	        $file->move($zipFolder,$fileNameWithExtension);

	        // Hapus directory temp dulu sbl ekstrak
	        $deleteDir = new Filesystem;
	        $deleteDir->cleanDirectory('uploaded File/'.$userId.'/'.'Temp/');

	        // Ekstraksi file
	        $Path = public_path('uploaded File/'.$userId.'/'.'Zip/'.$fileNameWithExtension);
	        \Zipper::make($Path)->extractTo('uploaded File/'.$userId.'/'.'Temp/');
 
	        // Renaming File
	        $length = strlen($filename);
	        $renamePath = 'uploaded File/'.$userId.'/'.'Temp/';
	        $filesInFolder = \File::files($renamePath);
	        foreach($filesInFolder as $path) { 
	              $file = pathinfo($path);
	              $name = $file['basename'];
	              $fullExtension = substr($name,$length);
	              rename($renamePath.$name,$renamePath.$newName.$fullExtension);
	        }

	        $userId = $request->session()->get('activeUser')->kode_wil;
	        $pathTemp = public_path('uploaded File/'.$userId.'/'.'Temp/'.$newName.);

	        //upload ke postgre
	        //dd(glob($filenameZip . "/*.prj"));
	        foreach (glob($pathTemp . "/*.prj") as $filename) {
	            $file_prj = str_replace("/", "\\", $filename);
	        }

	        $epsg = (int) shell_exec("python C:\Users\ASUS\Documents\Python Scripts\getEPSG.py ".$file_prj);
	        // globe-> mengambil isi dari folder yang dipilih
	        foreach (glob($renamePath . "/*.shp") as $filename) {
	            $filename_new = str_replace("/", "\\", $filename);
	            $table_name = basename($filename_new, ".shp");
	            $table_name_new = str_replace(" ", "_", $table_name);
	        }
			// here 4326 is spatial reference system or coordinate system of the shape file.
	        shell_exec('"C:\Program Files\PostgreSQL\11\bin\shp2pgsql" -I -s '. $epsg .' '. $filename_new . ' ' . $userId . '.' . $table_name_new . ' | "C:\Program Files\PostgreSQL\11\bin\psql" -U postgres -d sitrg');

	        
		}

		return redirect('/upload')->with('sukses','Data berhasil diinput');
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
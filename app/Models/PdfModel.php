<?php
namespace App\Models;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Session;

class PdfModel extends Model
{
    protected $fillable = ['id_pdf', 'file_pdf', 'kode_wil','created_at'];
    protected $table = 'pdf';
    protected $primaryKey = 'id_pdf';
}
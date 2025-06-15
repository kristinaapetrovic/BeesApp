<?php

namespace App\Http\Controllers;

use App\Models\Komentar;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use PhpOffice\PhpWord\PhpWord;
use Illuminate\Support\Facades\Storage;
use PhpOffice\PhpWord\TemplateProcessor;


class KomentarDownload extends Controller
{

    public function pogled()
    {
        return view('components.button');
    }

    public function generateKomentarDoc($id)
    {
        $komentar = Komentar::with(['user'])->findOrFail($id);

        $phpWord = new PhpWord();
        $section = $phpWord->addSection();

        // Datum
        $section->addText('Datum: ' . $komentar->datum, [
            'name' => 'Arial',
            'size' => 12,
        ]);
        $section->addTextBreak(1);

        // Ime
        $section->addText('Autor: ' . $komentar->user->name, [
            'name' => 'Arial',
            'size' => 12,
            'bold' => true,
        ]);
        $section->addTextBreak(1);

        // Sadržaj komentara
        $section->addText($komentar->sadrzaj, [
            'name' => 'Arial',
            'size' => 12,
        ]);

        // Snimanje dokumenta
        $filename = 'Komentar_' . $komentar->id . '.docx';
        $filepath = storage_path($filename);
        $phpWord->save($filepath);

        return response()->download($filepath, $filename)->deleteFileAfterSend(true);
    }
}

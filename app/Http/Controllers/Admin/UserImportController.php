<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;
use PhpOffice\PhpSpreadsheet\IOFactory;
use Illuminate\Support\Facades\Hash;

class UserImportController extends Controller
{
    public function form()
    {
        return view('admin.users.import');
    }

    public function upload(Request $request)
    {
        $request->validate([
            'file' => 'required|mimes:xlsx,xls,csv'
        ]);

        $file = $request->file('file');
        $spreadsheet = IOFactory::load($file->getPathname());
        $rows = $spreadsheet->getActiveSheet()->toArray();

        foreach ($rows as $index => $row) {
            if ($index === 0) continue; // Skip header

            // Pastikan kolom tidak kosong
            if (!isset($row[0], $row[1], $row[2], $row[3])) continue;

            User::create([
                'name'     => $row[0],
                'email'    => $row[1],
                'password' => Hash::make($row[2]),
                'usertype' => $row[3],
            ]);
        }

        return redirect()->route('users.index')->with('success', 'Import user berhasil!');
    }
}

<?php

namespace App\Http\Controllers;

use App\Models\Student;
use App\Models\Admin;
use Illuminate\Http\Request;

class StudentController extends Controller
{

    // CEK KELULUSAN
    public function check($nisn)
    {
        $student = Student::where('nisn', $nisn)->first();

        if (!$student) {
            return response()->json([
                'message' => 'Data tidak ditemukan'
            ], 404);
        }

        return response()->json($student);
    }

    // LOGIN ADMIN
    public function login(Request $request)
    {
        $admin = Admin::where('username', $request->username)
            ->where('password', $request->password)
            ->first();

        if (!$admin) {
            return response()->json([
                'message' => 'Login gagal'
            ], 401);
        }

        return response()->json([
            'message' => 'Login berhasil'
        ]);
    }

    // TAMBAH SISWA
    public function store(Request $request)
    {
        $student = Student::create([
            'nisn' => $request->nisn,
            'nama' => $request->nama,
            'kelas' => $request->kelas,
            'status' => $request->status
        ]);

        return response()->json([
            'message' => 'Data berhasil ditambahkan',
            'data' => $student
        ]);
    }
    // TAMPILKAN SEMUA DATA
    public function index()
    {
        return response()->json(
         Student::all()
        );
    }


// UPDATE DATA
    public function update(Request $request, $id)
{
    try {

        $student = Student::where('id', $id)->first();

        if (!$student) {

            return response()->json([
                'message' => 'Data tidak ditemukan'
            ], 404);
        }

        $student->update([
            'nisn' => $request->nisn,
            'nama' => $request->nama,
            'kelas' => $request->kelas,
            'status' => $request->status
        ]);

        return response()->json([
            'message' => 'Data berhasil diupdate'
        ]);

    } catch (\Exception $e) {

        return response()->json([
            'error' => $e->getMessage()
        ], 500);
    }
}

// HAPUS DATA
    public function destroy($id)
    {
        $student = Student::find($id);

        if (!$student) {
        return response()->json([
            'message' => 'Data tidak ditemukan'
        ], 404);
    }

        $student->delete();

        return response()->json([
        'message' => 'Data berhasil dihapus'
        ]);
}
public function ai(Request $request)
{
    $prompt = $request->prompt;

    $client = new \GuzzleHttp\Client();

    $response = $client->post(
        'http://localhost:11434/api/generate',
        [
            'json' => [
                'model' => 'gemma:2b',
                'prompt' => $prompt,
                'stream' => false
            ]
        ]
    );

    $data = json_decode(
        $response->getBody(),
        true
    );

    return response()->json([
        'response' => $data['response']
    ]);
}
}

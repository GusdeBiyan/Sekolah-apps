<?php

namespace App\Http\Controllers;

use App\Models\Kelas;
use App\Models\Teacher;
use Illuminate\Database\QueryException;
use Illuminate\Http\Request;

class TeacherController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $kelas = Kelas::all();


        $teachers = Teacher::query();
        if ($request->has('class_id') && $request->class_id) {
            $teachers = Teacher::where('class_id', $request->class_id)->get();
        } else {
            $teachers = $teachers->get();
        }

        return view('teacher-page.index', compact('kelas', 'teachers'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'nama' => 'required|string|max:255',
            'email' => 'required|email|unique:teachers,email',
            'mata_pelajaran' => 'required|string|max:100',
            'class_id' => 'required',
            'nomor_telepon' => 'required|regex:/^[0-9]+$/|min:10|max:15',
            'status' => 'required|string',
            'nip' => 'required|unique:teachers,nip|digits:18',
            'tanggal_lahir' => 'required|date',
            'jenis_kelamin' => 'required|in:L,P',
            'alamat' => 'required|string',
        ]);



        Teacher::create($validatedData);

        session()->flash('toast_message', 'Data berhasil ditambahkan');
        session()->flash('toast_icon', 'success');



        return redirect()->route('teachers.index')->with('success', 'Data guru berhasil disimpan!');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $teacher = Teacher::findOrFail($id);
        $kelas = Kelas::all();
        return view('teacher-page.edit', compact('teacher', 'kelas'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {

        $validatedData = $request->validate([
            'nama' => 'required|string|max:255',
            'email' => 'required|email|unique:teachers,email,' . $id,
            'mata_pelajaran' => 'required|string|max:100',
            'class_id' => 'required',
            'nomor_telepon' => 'required|regex:/^[0-9]+$/|min:10|max:15',
            'status' => 'required|string',
            'nip' => 'required||digits:18|unique:teachers,nip,' . $id,
            'tanggal_lahir' => 'required|date',
            'jenis_kelamin' => 'required|in:L,P',
            'alamat' => 'required|string',
        ]);



        $teacher = Teacher::findOrFail($id);
        $teacher->update($validatedData);

        session()->flash('toast_message', 'Data berhasil ditambahkan');
        session()->flash('toast_icon', 'success');



        return redirect()->route('teachers.index')->with('success', 'Data guru berhasil disimpan!');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $data = Teacher::find($id);


        if (!$data) {
            return response()->json(['message' => 'Data not found'], 404);
        }

        try {

            $data->delete();

            session()->flash('toast_message', 'Data berhasil dihapus');
            session()->flash('toast_icon', 'success');

            return redirect()->route('teachers.index');
        } catch (QueryException $e) {
            session()->flash('toast_message', 'Terdapat data terhubung, data tidak dapat dihapus');
            session()->flash('toast_icon', 'error');

            return redirect()->route('teachers.index');
        }
    }
}

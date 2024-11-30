<?php

namespace App\Http\Controllers;

use App\Models\Kelas;
use App\Models\Student;
use Illuminate\Database\QueryException;
use Illuminate\Http\Request;

class StudentController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {

        $kelas = Kelas::all();


        $students = Student::query();
        if ($request->has('class_id') && $request->class_id) {
            $students = Student::where('class_id', $request->class_id)->get();
        } else {
            $students = $students->get();
        }

        return view('student-page.index', compact('kelas', 'students'));
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
            'email' => 'required|email|unique:students,email',
            'nisn' => 'required|unique:students,nisn|digits:10',
            'class_id' => 'required',
            'tanggal_lahir' => 'required|date',
            'jenis_kelamin' => 'required|in:L,P',
            'alamat' => 'required|string',
        ]);



        Student::create($validatedData);

        session()->flash('toast_message', 'Data berhasil ditambahkan');
        session()->flash('toast_icon', 'success');



        return redirect()->route('students.index')->with('success', 'Data siswa berhasil disimpan!');
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
    public function edit($id)
    {
        $student = Student::findOrFail($id);
        $kelas = Kelas::all();
        return view('student-page.edit', compact('student', 'kelas'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
        $validatedData = $request->validate([
            'nama' => 'required|string|max:255',
            'nisn' => 'required|digits:10|unique:students,nisn,' . $id,
            'class_id' => 'required|exists:class,id',
            'email' => 'required|email|unique:students,email,' . $id,
            'tanggal_lahir' => 'required|date',
            'jenis_kelamin' => 'required|in:L,P',
            'alamat' => 'nullable|string|max:500',
        ]);

        $student = Student::findOrFail($id);
        $student->update($validatedData);

        session()->flash('toast_message', 'Data berhasil diubah');
        session()->flash('toast_icon', 'success');


        return redirect()->route('students.index')->with('success', 'Data siswa berhasil diperbarui.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        $data = Student::find($id);


        if (!$data) {
            return response()->json(['message' => 'Data not found'], 404);
        }

        try {

            $data->delete();

            session()->flash('toast_message', 'Data berhasil dihapus');
            session()->flash('toast_icon', 'success');

            return redirect()->route('students.index');
        } catch (QueryException $e) {
            session()->flash('toast_message', 'Terdapat data terhubung, data tidak dapat dihapus');
            session()->flash('toast_icon', 'error');

            return redirect()->route('students.index');
        }
    }
}

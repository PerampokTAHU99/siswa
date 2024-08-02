<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Siswa;
use Carbon\Carbon;

class SiswaController extends Controller
{
    // Display the list of students
    public function index()
    {
        // Retrieve all siswa records, ordered by name
        $siswa = Siswa::orderBy('nama', 'asc')->get();

        // Pass the data to a view
        return view('siswa.index', compact('siswa'));
    }

    // Store a new student record
    public function store(Request $request)
    {
        // Validate the request data
        $request->validate([
            'name' => 'required|string|max:255',
            'placeOfBirth' => 'required|string|max:255',
            'tanggal_lahir' => 'required|date',
            'jenis_kelamin' => 'required|string|in:L,P',
            'address' => 'required|string',
            'class' => 'required|integer',
            'prestation' => 'required|string',
        ]);

        // Create a new student record
        Siswa::create([
            'nama' => $request->input('name'),
            'tempat_lahir' => $request->input('placeOfBirth'),
            'tanggal_lahir' => $request->input('tanggal_lahir'),
            'jenis_kelamin' => $request->input('jenis_kelamin'),
            'alamat' => $request->input('address'),
            'kelas' => $request->input('class'),
            'prestasi' => $request->input('prestation'),
        ]);

        // Redirect back with a success message
        return redirect()->route('siswa.index')->with('success', 'Siswa berhasil ditambahkan.');
    }

    // Update an existing student record
    public function update(Request $request, $id)
    {
        // Validate the request data
        $request->validate([
            'name' => 'required|string|max:255',
            'placeOfBirth' => 'required|string|max:255',
            'tanggal_lahir' => 'required|date',
            'jenis_kelamin' => 'required|string|in:L,P',
            'address' => 'required|string',
            'class' => 'required|integer',
            'prestation' => 'required|string',
        ]);

        // Find the student record by ID
        $siswa = Siswa::findOrFail($id);

        // Update the student record with new data
        $siswa->update([
            'nama' => $request->input('name'),
            'tempat_lahir' => $request->input('placeOfBirth'),
            'tanggal_lahir' => $request->input('tanggal_lahir'),
            'jenis_kelamin' => $request->input('jenis_kelamin'),
            'alamat' => $request->input('address'),
            'kelas' => $request->input('class'),
            'prestasi' => $request->input('prestation'),
        ]);

        // Redirect back with a success message
        return redirect()->route('siswa.index')->with('success', 'Siswa berhasil diupdate.');
    }

    // Delete an existing student record
    public function destroy($id)
    {
        // Find the student record by ID
        $siswa = Siswa::findOrFail($id);

        // Delete the student record
        $siswa->delete();

        // Redirect back with a success message
        return redirect()->route('siswa.index')->with('success', 'Siswa berhasil dihapus.');
    }
}

<?php

namespace App\Http\Controllers;

use App\Models\Note;
use App\Services\FileService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage; // Storage sınıfını ekle

class NoteController extends Controller
{
    protected $fileService;

    public function __construct(FileService $fileService)
    {
        $this->fileService = $fileService;
    }

    public function index()
    {
        $notes = Note::where('is_approved', true)
            ->with(['faculty', 'department', 'classRoom', 'course'])
            ->latest()
            ->paginate(12);
        
        return view('notes.index', compact('notes'));
    }

    public function create()
    {
        $faculties = \App\Models\Faculty::all();
        return view('notes.create', compact('faculties'));
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'nullable|string',
            'file' => 'required|file|mimes:pdf,doc,docx,jpg,jpeg,png|max:10240',
            'faculty_id' => 'required|exists:faculties,id',
            'department_id' => 'required|exists:departments,id',
            'class_id' => 'required|integer|min:1',
            'course_name' => 'required|string|max:255',
        ]);

        if ($request->hasFile('file')) {
            $file = $request->file('file');
            $fileName = time() . '_' . $file->getClientOriginalName();
            $filePath = $file->storeAs('public/notes', $fileName);
            
            $note = Note::create([
                'title' => $validated['title'],
                'description' => $validated['description'],
                'file_path' => str_replace('public/', '', $filePath), // storage/public/ ön ekini kaldır
                'file_type' => $file->getClientMimeType(),
                'faculty_id' => $validated['faculty_id'],
                'department_id' => $validated['department_id'],
                'class_id' => $validated['class_id'],
                'course_name' => $validated['course_name'],
                'user_id' => auth()->id(),
            ]);

            return redirect()->route('notes.index')->with('success', 'Not başarıyla yüklendi.');
        }

        return back()->with('error', 'Dosya yüklenirken bir hata oluştu.');
    }

    public function search(Request $request)
    {
        $query = $request->input('query');
        
        $notes = Note::where('is_approved', true)
            ->where(function($q) use ($query) {
                $q->where('title', 'LIKE', "%{$query}%")
                  ->orWhere('description', 'LIKE', "%{$query}%");
            })
            ->with(['faculty', 'department', 'classRoom', 'course'])
            ->paginate(12);

        return view('notes.index', compact('notes', 'query'));
    }

    public function show(Note $note)
    {
        // Not onay kontrolü
        if (!$note->is_approved && !auth()->user()->isAdmin()) {
            abort(403, 'Bu nota erişim izniniz yok.');
        }

        // Dosyanın varlığını kontrol et
        if (!Storage::disk('public')->exists($note->file_path)) {
            abort(404, 'Dosya bulunamadı.');
        }

        return view('notes.show', compact('note'));
    }

    public function view(Note $note)
    {
        // Notun görüntülenmesi için gerekli yetkilendirme kontrolü
        if (!auth()->user()->isAdmin() && $note->user_id !== auth()->id()) {
            abort(403);
        }

        return view('notes.view', compact('note'));
    }
}
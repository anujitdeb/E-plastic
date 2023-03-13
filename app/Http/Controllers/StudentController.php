<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreStudentRequest;
use App\Http\Requests\UpdateStudentRequest;
use App\Models\Student;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Illuminate\Http\JsonResponse;

class StudentController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return Application|Factory|View
     */
    public function index()
    {
        $data = Student::all();
        return view('backend.pages.student.index', compact('data'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param StoreStudentRequest $request
     * @return JsonResponse
     */
    public function store(StoreStudentRequest $request)
    {
        $student = Student::create($request->validated());
        return response()->json([
            'message' => 'Student created successfully',
            'data' => $student,
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return string
     */
    public function create()
    {
        $view = view('backend.pages.student.create');
        return response()->json([
            'html' => $view->render(),
        ]);
    }

    /**
     * Display the specified resource.
     *
     * @param Student $student
     * @return JsonResponse
     */
    public function show(Student $student)
    {
        return response()->json([
            'data' => $student,
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param Student $student
     * @return JsonResponse
     */
    public function edit(Student $student)
    {
        $view = view('backend.pages.student.edit', compact('student'));
        return response()->json([
            'html' => $view->render(),
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param UpdateStudentRequest $request
     * @param Student $student
     * @return JsonResponse
     */
    public function update(UpdateStudentRequest $request, Student $student)
    {
        $student->update($request->validated());
        return response()->json([
            'message' => 'Student updated successfully',
            'data' => $student,
        ]);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param Student $student
     * @return JsonResponse
     */
    public function destroy(Student $student)
    {
        $student->delete();
        return response()->json([
            'message' => 'Student deleted successfully',
        ]);
    }

    public function list()
    {
        $data = Student::all();
        $view = view('backend.pages.student.list', compact('data'));
        return response()->json([
            'html' => $view->render(),
        ]);
    }
}

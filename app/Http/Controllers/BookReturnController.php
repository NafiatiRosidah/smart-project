<?php

namespace App\Http\Controllers;

use App\Models\BorrowingBook;
use App\Models\BorrowingBookDetail;
use Carbon\Carbon;
use Illuminate\Http\Request;

class BookReturnController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        // $data = [
        //     'title' => 'Returned Books List'
        // ];

        // return view("library.return.index", $data);
        // $returns = BorrowingBook::getInactiveBorrowingBook($this->defaultCurriculum->id);

        // $data = [
        //     'title' => 'Returned Books List',
        //     'returns' => $returns 
        // ];

        // return view('library.return.index', $data);


                $startDate = $request->input("startDate");
        $endDate = $request->input("endDate");

        $now = Carbon::now();

        $startDate = $startDate ? $startDate : $now->format('Y-m-d');
        $endDate = $endDate ? $endDate : $now->format('Y-m-d');

        $filterByDate = BorrowingBook::getInactiveBorrowingBook($this->defaultCurriculum->id, $startDate , $endDate);

        // $filterByDate = $filterByDateQuery->get();


        $data = [
            'title' => 'Borrowed Book List',
            'filterByDate' => $filterByDate,
            'startDate' => $startDate,
            'endDate' => $endDate,
        ];

        return view('library.return.index', $data);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $data = [
            'title' => 'Return a Book'
        ];

        return view("library.return.return_form", $data);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
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
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }

}

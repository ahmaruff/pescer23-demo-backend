<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreBookRequest;
use App\Http\Requests\UpdateBookRequest;
use App\Models\Book;
use DB;

class BookController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        try {
            $books = Book::all();
            $res = [
                'status' => 'success',
                'code' => 200,
                'message' => 'return all books',
                'data' => [
                    'books' => $books,
                ],
            ];
            return response()->json($res, 200);

        } catch (\Throwable $th) {
            $res = [
                'status' => 'error',
                'code' => 400,
                'message' => $th->getMessage()
            ];

            return response()->json($res, 400);
        }
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
    public function store(StoreBookRequest $request)
    {
        $validated = $request->validated();

        try {
            $stored_book = Book::create($validated);

            $res = [
                'status' => 'success',
                'code' => 200,
                'message' => 'return single book',
                'data' => $stored_book
            ];
            return response()->json($res, 200);
        } catch (\Throwable $th) {
            $res = [
                'status' => 'error',
                'code' => 400,
                'message' => $th->getMessage()
            ];

            return response()->json($res, 400);
        }
    }

    /**
     * Display the specified resource.
     */
    public function show($id)
    {
        try {
            $book = Book::where('id', $id)->first();

            if($book == null){
                $res = [
                    'status' => 'fail',
                    'code' => 400,
                    'message' => 'book record is empty',
                    'data' => $book
                ];
                return response()->json($res, 200);
            }
            $res = [
                'status' => 'success',
                'code' => 200,
                'message' => 'return single book',
                'data' => $book
            ];
            return response()->json($res, 200);
        } catch (\Throwable $th) {
            $res = [
                'status' => 'error',
                'code' => 400,
                'message' => $th->getMessage()
            ];

            return response()->json($res, 400);
        }
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Book $book)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateBookRequest $request, Book $book)
    {
        $validated = $request->validated();
        try {
            $updated = $book->update($validated);

            if(!$updated) {
                $res = [
                    'status' => 'error',
                    'code' => 400,
                    'message' => 'failed to update book',
                ];
                return response()->json($res, 400);
            }
            $updated_book = Book::find($book->id)->first()->toArray();
            $res = [
                'status' => 'success',
                'code' => 200,
                'message' => 'return updated single book',
                'data' => $updated_book
            ];
            return response()->json($res, 200);
        } catch (\Throwable $th) {
            $res = [
                'status' => 'error',
                'code' => 400,
                'message' => $th->getMessage()
            ];

            return response()->json($res, 400);
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Book $book)
    {
        try {
            $deleted = $book->delete();
            $res = [
                'status' => 'success',
                'code' => 200,
                'message' => 'book deleted',
                'data' => $deleted
            ];
            return response()->json($res, 200);

        } catch (\Throwable $th) {
            $res = [
                'status' => 'error',
                'code' => 400,
                'message' => $th->getMessage()
            ];

            return response()->json($res, 400);
        }
    }
}

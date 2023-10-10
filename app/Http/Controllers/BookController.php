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
            if(!$books) {
                $res = [
                    'status' => 'fail',
                    'code' => 404,
                    'message' => 'Book not found',
                    'data' => $books
                ];
                return response()->json($res, 404);
            }

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
     * Store a newly created resource in storage.
     */
    public function store(StoreBookRequest $request)
    {
        // return response()->json($request->all());
        $validated = $request->validated();
        try {
            $stored_book = Book::create($validated);
            $res = [
                'status' => 'success',
                'code' => 201,
                'message' => "new book's record is created",
                'data' => $stored_book
            ];
            return response()->json($res, 201);

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

            if(!$book){
                $res = [
                    'status' => 'fail',
                    'code' => 404,
                    'message' => 'Book not found',
                    'data' => $book
                ];
                return response()->json($res, 404);
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
     * Update the specified resource in storage.
     */
    public function update(UpdateBookRequest $request, $id)
    {
        $book = Book::where('id', $id)->first();
        if(!$book) {
            $res = [
                'status' => 'error',
                'code' => 404,
                'message' => 'Book not found, cannot update',
            ];
            return response()->json($res, 404);
        }

        $validated = $request->validated();

        try {
            $updated = $book->update($validated);

            if(!$updated) {
                $res = [
                    'status' => 'fail',
                    'code' => 400,
                    'message' => 'failed to update book',
                ];
                return response()->json($res, 400);
            }

            $updated_book = Book::where('id', $id)->first();
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
    public function destroy($id)
    {
        try {
            $book = Book::where('id', $id)->first();
            if(!$book) {
                $res = [
                    'status' => 'fail',
                    'code' => 404,
                    'message' => 'Book not found',
                    'data' => $book
                ];
                return response()->json($res, 404);
            }

            $deleted = $book->delete();
            if(!$deleted){
                $res = [
                    'status' => 'fail',
                    'code' => 400,
                    'message' => 'failed to delete book',
                ];
                return response()->json($res, 400);
            }
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

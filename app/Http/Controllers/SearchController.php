<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;
use App\Models\SearchResult;

class SearchController extends Controller
{
    public function index()
    {
        return view('search');
    }

    public function search(Request $request)
    {
        $searchString = $request->input('search');

        $searchResult = SearchResult::where('search_string', $searchString)->first();

        if (!$searchResult) {
            $response = Http::get('https://api.github.com/search/repositories?q=' . $searchString);

            if ($response->successful()) {
                $result = $response->json();

                SearchResult::create([
                    'search_string' => $searchString,
                    'result' => json_encode($result),
                ]);

                return redirect()->route('results', ['page' => 1, 'searchString' => $searchString])->with('searchString', $searchString);
            } else {
                return redirect()->back()->with('error', 'Не удалось выполнить поиск.');
            }
        } else {
            return redirect()->route('results', ['page' => 1, 'searchString' => $searchString])->with('searchString', $searchString);
        }
    }


    public function results(Request $request)
    {
        $searchString = $request->input('searchString');
        $currentPage = $request->input('page', 1);

        $searchResult = SearchResult::where('search_string', $searchString)->first();

        if ($searchResult) {
            $results = json_decode($searchResult->result, true);
            $totalResults = $results['total_count'];

            $totalPages = ceil($totalResults / 30);
            $currentPage = min(max(1, $currentPage), $totalPages);

            $startIndex = ($currentPage - 1) * 30;
            $endIndex = min($startIndex + 29, $totalResults - 1);

            foreach (array_slice($results['items'], $startIndex, $endIndex - $startIndex + 1) as &$result) {
                $result['watchers_count'] = $result['watchers'];
            }

            return view('results', [
                'results' => $results,
                'currentPage' => $currentPage,
                'searchString' => $searchString,
                'totalPages' => $totalPages,
                'searchResult' => $searchResult,
            ]);
        }

        return redirect()->route('index')->with('error', 'Результаты не найдены.');
    }

}

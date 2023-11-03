<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\SearchResult;
use Illuminate\Support\Facades\Http;

class ApiController extends Controller
{
    public function find(Request $request)
    {
        $searchString = $request->input('search');

        $searchResult = SearchResult::where('search_string', $searchString)->first();

        if (!$searchResult) {
            $response = $this->searchRepositories($searchString);

            if ($response->successful()) {
                $result = $response->json();

                SearchResult::create([
                    'search_string' => $searchString,
                    'result' => $result,
                ]);

                return response()->json($result);
            }
        } else {
            return response()->json($searchResult->result);
        }

        return response()->json(['message' => 'Не удалось выполнить поиск.'], 500);
    }

    public function getSearches(Request $request)
    {
        $perPage = $request->input('perPage', 10); // Получить количество элементов на странице из параметра запроса или использовать значение по умолчанию (10)
        $searches = SearchResult::paginate($perPage);

        return response()->json($searches);
    }


    public function deleteSearch($id)
    {
        $searchResult = SearchResult::find($id);

        if ($searchResult) {
            $searchResult->delete();

            return response()->json(['message' => 'Результаты поиска успешно удалены.']);
        }

        return response()->json(['message' => 'Результаты поиска не найдены.'], 404);
    }

    private function searchRepositories($searchString)
    {
        return Http::get('https://api.github.com/search/repositories', [
            'q' => $searchString
        ]);
    }
}

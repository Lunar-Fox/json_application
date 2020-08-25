<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Str;
use App\Document;

class DocumentsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $perPage = $request->validate([
            'perPage' => 'integer',
        ]);

        $paginate = Document::orderBy('created_at', 'desc')->paginate((isset($perPage['perPage']) ? $perPage['perPage'] : 20));

        $documents = [];
        foreach ($paginate as $document) {
            $document->payload = json_decode($document->payload, true);
            $documents[] = $document;
        }

        $result = [
            'document' => $documents,
            'pagination' => [
                'page' => $paginate->currentPage(),
                'perPage' => $paginate->perPage(),
                'total' => $paginate->total(),
            ],
        ];

        return response($result)->withHeaders(['application/json']);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $document = Document::create([
            'id' => Str::uuid(),
            'payload' => json_encode([]),
        ]);

        $document->payload = json_decode($document->payload, true);

        return response(['document' => $document])->withHeaders(['application/json']);
    }

    /**
     * Display the specified resource.
     *
     * @param  Document  $document
     * @return \Illuminate\Http\Response
     */
    public function show(Document $document)
    {
        $document->payload = json_decode($document->payload, true);

        return response(['document' => $document])->withHeaders(['application/json']);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  Document  $document
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Document $document)
    {
        function filterNotNull($array) {
            $array = array_map(function($item) {
                return is_array($item) ? filterNotNull($item) : $item;
            }, $array);
            return array_filter($array, function($item) {
                return $item !== "" && $item !== null && (!is_array($item) || count($item) > 0);
            });
        }

        try {
            $data = json_decode($request->getContent(), true);
            if($document['status'] == 'draft' && isset($data['document']['payload'])) {
                $payload = json_decode($document['payload'], true);
                $mergedArray = array_merge($payload, $data['document']['payload']);

                $document->fill(['payload' => filterNotNull($mergedArray)]);
                $document->save();

                return response(['document' => $document])->withHeaders(['application/json']);
            } else {
                return response('', 400);
            }
        } catch (Exception $e) {
            return response('', 400);
        }
    }

    /**
     * Publish resource.
     *
     * @param  string  $id
     * @return \Illuminate\Http\Response
     */
    public function publish($id)
    {
        $document = Document::findOrFail($id);
        $document->status = 'published';
        $document->save();

        $document->payload = json_decode($document->payload, true);

        return response(['document' => $document])->withHeaders(['application/json']);
    }
}

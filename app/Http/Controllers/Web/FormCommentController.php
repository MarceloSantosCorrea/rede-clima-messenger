<?php

namespace App\Http\Controllers\Web;

use App\Events\SendMessagePusher;
use App\Http\Controllers\Controller;
use App\Models\Comment;
use App\Models\Lead;
use Illuminate\Http\Request;

class FormCommentController extends Controller
{
    public function index()
    {
        $comments = Comment::orderBy('id', 'DESC')->get();

        return view('pages.form-comment.index', compact('comments'));
    }

    public function store(Request $request)
    {
        $data = $request->all();

        if (isset($data['action'])) {
            switch ($data['action']) {
                case "new-comment":

                    \Log::info(json_encode($data));

                    $lead = Lead::where('external_id', $data['dataUser']['id'])->first();
                    if (! $lead) {
                        $lead = Lead::create([
                            'external_id' => $data['dataUser']['id'] ?? null,
                            'name'        => $data['dataUser']['name'],
                            'email'       => $data['dataUser']['email'] ?? null,
                            'thumbnail'   => \Str::slug($data['dataUser']['name']).".jpeg",
                        ]);
                    } else {
                        $lead->thumbnail = \Str::slug($data['dataUser']['name']).".jpeg";
                        $lead->save();
                    }

                    $create = Comment::create([
                        'comment' => $data['comment'],
                        'status'  => 'active',
                        'lead_id' => $lead->id,
                    ]);

                    try {
                        $filename = storage_path("app/public/".\Str::slug($data['dataUser']['name']).".jpeg");
                        file_put_contents(
                            $filename,
                            file_get_contents($data['dataUser']['picture']['data']['url'])
                        );
                    } catch (\Exception $e) {
                        return response()->json($e->getMessage(), 500);
                    }

                    $pucherData = [
                        'action'  => $data['action'],
                        'comment' => Comment::find($create->id)->toArray(),
                    ];

                    event(new SendMessagePusher($pucherData));
                    return response()->json($pucherData);

                    break;
                default:
                    abort(404);
                    break;
            }
        } else {

            abort(404);
        }
    }

    public function ajax(Request $request)
    {
        if ($request->ajax()) {
            $data = $request->all();

            if (isset($data['action'])) {

                /**
                 * Array (
                 *    action => new-comment,
                 *    userAgent => 4253,
                 *    dataUser => Array (
                 *        picture => Array (
                 *            data => Array (
                 *                height => 50,
                 *                is_silhouette => false,
                 *                url => https://platform-lookaside.fbsbx.com/platform/profilepic/?asid=2758925297561219&height=50&width=50&ext=1589263647&hash=AeR8CeziG2N9C3sE,
                 *                width => 50,
                 *            ),
                 *        ),
                 *        email => marcelocorrea229@gmail.com,
                 *        name => Marcelo Santos Corrêa,
                 *        id => 2758925297561219,
                 *     ),
                 *     comment => Teste 09
                 * )
                 */

                switch ($data['action']) {
                    case "new-comment":

                        \Log::info(json_encode($data));

                        $lead = Lead::where('external_id', $data['dataUser']['id'])->first();
                        if (! $lead) {
                            $lead = Lead::create([
                                'external_id' => $data['dataUser']['id'] ?? null,
                                'name'        => $data['dataUser']['name'],
                                'email'       => $data['dataUser']['email'] ?? null,
                                'thumbnail'   => \Str::slug($data['dataUser']['name']).".jpeg",
                            ]);
                        } else {
                            $lead->thumbnail = \Str::slug($data['dataUser']['name']).".jpeg";
                            $lead->save();
                        }

                        $create = Comment::create([
                            'comment' => $data['comment'],
                            'status'  => 'active',
                            'lead_id' => $lead->id,
                        ]);

                        try {
                            $filename = storage_path("app/public/".\Str::slug($data['dataUser']['name']).".jpeg");
                            file_put_contents(
                                $filename,
                                file_get_contents($data['dataUser']['picture']['data']['url'])
                            );
                        } catch (\Exception $e) {
                            return response()->json($e->getMessage(), 500);
                        }

                        $pucherData = [
                            'action'  => $data['action'],
                            'comment' => Comment::find($create->id)->toArray(),
                        ];

                        event(new SendMessagePusher($pucherData));
                        return response()->json($pucherData);

                        break;
                    default:
                        abort(404);
                        break;
                }
            } else {

                abort(404);
            }
        }
    }
}

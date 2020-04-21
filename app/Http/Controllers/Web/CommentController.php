<?php

namespace App\Http\Controllers\Web;

use App\Events\SendMessagePusher;
use App\Http\Controllers\Controller;
use App\Models\Comment;

class CommentController extends Controller
{
    public function index()
    {
        $data = Comment::orderBy('id', 'DESC')->paginate();
        return view('pages.comments.index', compact('data'));
    }

    public function json()
    {
        $data = Comment::with('lead')->orderBy('id', 'DESC')->paginate();
        return response()->json($data);
    }

    /**
     * @param $uid
     * @return \Illuminate\Http\RedirectResponse
     * @throws \Exception
     */
    public function destroy($uid)
    {
        try {
            $comment = Comment::where('uid', $uid)->firstOrFail();
        } catch (\Exception $e) {
            return redirect()->route('web.comments.index');
        }

        $data = [
            'action'     => 'remove-comment',
            'comment_id' => $comment->uid,
        ];

        if ($comment->delete()) {
            event(new SendMessagePusher($data));

            return redirect()->route('web.comments.index')->with('success', 'Deletado com sucesso');
        }

        return redirect()->route('web.comments.index')->with('error', 'Erro ao deletar');
    }
}

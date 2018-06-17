<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use App\Models\Quest;
use App\Models\UsersQuest;
use App\Models\User;

class QuestController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function allQuests()
    {
        $quests = Quest::where('author_id', '!=', auth()->id())->paginate();
        return view('quest.all', compact(['quests']));
    }

    public function show(User $user, Quest $quest)
    {
        if ($quest->author->id === $user->id) {
            $quest_in_process = UsersQuest::where([
                ['user_id', auth()->id()],
                ['quest_id', $quest->id]
            ])->first();
            return view('quest.info', compact(['quest', 'user', 'quest_in_process']));
        }
        return redirect()->route('quest.all');
    }

    public function add(User $user)
    {
        if (auth()->user()->can('view', $user)) {
            return view('quest.add', compact(['user']));
        }
        return redirect()->route('quest.all');
    }

    public function create(User $user, Request $request)
    {
        if (auth()->user()->can('view', $user)) {
            $request->validate([
                'title' => 'required|max:191|unique:quests',
                'photo' => 'required|image',
                'short_desc' => 'required',
                'desc' => 'required',
                'answer' => 'required',
                'exec_time' => 'required|numeric',
            ]);

            $saved_photo = $request->file('photo')->store(env('QUEST_FOLDER'));
            $saved_photo = substr($saved_photo, strrpos($saved_photo, '/') + 1);
            Quest::create([
                'title' => $request->title,
                'short_description' => $request->short_desc,
                'description' => $request->desc,
                'photo' => $saved_photo,
                'answer' => $request->answer,
                'execution_time' => $request->exec_time,
                'published' => $request->published ?? 0,
                'author_id' => auth()->id(),
            ]);
            return redirect()->route('user.all-quests', ['user' => $user->load('quests')]);
        }
        return redirect()->route('quest.all');
    }

    public function edit(User $user, Quest $quest)
    {
        if ($quest->author->id === $user->id) {
            if (auth()->user()->can('view', $user)) {
                return view('quest.edit', compact(['user', 'quest']));
            }
        }
        return redirect()->route('quest.all');
    }

    public function update(User $user, Quest $quest, Request $request)
    {
        if ($quest->author->id === $user->id) {
            if (auth()->user()->can('view', $user)) {
                $request->validate([
                    'title' => 'required|max:191|unique:quests,title,' . $quest->id,
                    'photo' => 'required|image',
                    'short_desc' => 'required',
                    'desc' => 'required',
                    'answer' => 'required',
                    'exec_time' => 'required|numeric',
                ]);
                $quest_folder = env('QUEST_FOLDER');
                $saved_photo = $request->file('photo')->store($quest_folder);
                $saved_photo = substr($saved_photo, strrpos($saved_photo, '/') + 1);
                if ($quest->photo) {
                    Storage::delete($quest_folder . '/' . $quest->photo);
                }
                $quest->title = $request->title;
                $quest->short_description = $request->short_desc;
                $quest->description = $request->desc;
                $quest->photo = $saved_photo;
                $quest->answer = $request->answer;
                $quest->execution_time = $request->exec_time;
                $quest->save();
                return redirect()->route('quest.show', [$user->name, $quest->title]);
            }
        }
        return redirect()->route('quest.show');
    }
}

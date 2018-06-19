<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use App\Models\Quest;
use App\Models\UsersQuest;
use App\Models\User;

class UserController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function home()
    {
        $quests = Quest::where('author_id', '!=', auth()->id())->orderBy('created_at', 'desc')->take(5)->get()->load('author');
        $quests_in_process = UsersQuest::where([
            ['user_id', auth()->id()],
            ['status', 0],
        ])->orderBy('created_at', 'desc')->take(3)->get()->load(['quest']);
        return view('user.home', compact(['quests', 'quests_in_process']));
    }

    public function allQuests(User $user)
    {
        return view('user.quests', ['user' => $user->load('quests')]);
    }

    public function profile(User $user)
    {
        return view('user.profile', compact(['user']));
    }

    public function edit(User $user)
    {
        if (auth()->user()->can('view', $user)) {
            return view('user.edit', compact(['user']));
        }
        return redirect()->route('user.profile', [$user->name]);
    }

    public function update(User $user, Request $request)
    {
        if (auth()->user()->can('update', $user)) {
            $request->validate([
                'email' => 'required|max:191|unique:users,email,' . $user->id,
                'photo' => 'required|image'
            ]);
            $avatar_folder = env('AVATAR_FOLDER');
            $saved_avatar = $request->file('photo')->store($avatar_folder);
            $saved_avatar = substr($saved_avatar, strrpos($saved_avatar, '/') + 1);
            if ($user->photo !== "default.png") {
                Storage::delete($avatar_folder . '/' . $user->photo);
            }
            $user->email = $request->email;
            $user->photo = $saved_avatar;
            $user->save();
        }
        return redirect()->route('user.profile', [$user->name]);
    }

    public function questsInProcess(User $user)
    {
        if (auth()->user()->can('view', $user)) {
            $quests_in_process = UsersQuest::where([
                ['user_id', auth()->id()],
                ['status', 0],
            ])->orderBy('created_at', 'desc')->get()->load('quest');
            return view('user.quests-in-process', compact(['quests_in_process']));
        }
        return redirect()->route('user.all-quests', [$user->name]);
    }

    public function questsFinished(User $user)
    {
        if (auth()->user()->can('view', $user)) {
            $quests_finished = UsersQuest::where([
                ['user_id', auth()->id()],
                ['status', 1],
            ])->orderBy('created_at', 'desc')->get()->load('quest');
            return view('user.quests-finished', compact(['quests_finished']));
        }
        return redirect()->route('user.all-quests', [$user->name]);
    }

    public function questsFailed(User $user)
    {
        if (auth()->user()->can('view', $user)) {
            $quests_failed = UsersQuest::where([
                ['user_id', auth()->id()],
                ['status', 2],
            ])->orderBy('created_at', 'desc')->get()->load('quest');
            return view('user.quests-failed', compact(['quests_failed']));
        }
        return redirect()->route('user.all-quests', [$user->name]);
    }

    public function startQuest(User $user, Quest $quest)
    {
        if ($quest->author->id === $user->id) {
            UsersQuest::create([
                'user_id' => auth()->id(),
                'quest_id' => $quest->id,
                'time_start' => date("Y-m-d H:i:s", time()),
                'time_end' => date("Y-m-d H:i:s", time() + $quest->execution_time),
            ]);
            if ($quest->editable) {
                $quest->editable = 0;
                $quest->save();
            }
            return redirect()->route('user.quests-in-process', [auth()->user()->name]);
        }
        return redirect()->route('quest.all');
    }

    public function finishQuest(User $user, Quest $quest, Request $request)
    {
        if ($quest->author->id === $user->id) {
            $request->validate([
                'answer' => 'required',
            ]);
            if(strcasecmp($request->answer, $quest->answer) !== 0) {
                return redirect()->back()->withErrors(['error' => 'The answer is wrong']);
            }
            $finished_quest = UsersQuest::where([
                ['user_id', auth()->id()],
                ['quest_id', $quest->id]
            ])->first();
            if($finished_quest->time_end > date("Y-m-d H:i:s", time())) {
                $finished_quest->status = 1;
            } else {
                $finished_quest->status = 2;
            }
            $finished_quest->time_end = date("Y-m-d H:i:s", time());
            $finished_quest->save();
            return redirect()->route('quest.show', [auth()->user()->name, $quest->title]);
        }
        return redirect()->route('quest.all');
    }
}

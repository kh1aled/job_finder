<?php

namespace App\Http\Controllers;

use App\Http\Requests\JobRequest;
use App\Models\Job;
use App\Models\Employer;
use App\Models\Tag;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;

class JobController extends Controller
{
    public function index()
    {
        // dd(Tag::all());
        $jobs = Job::with('tags', 'employer')->orderBy('featured', 'desc')->get();

        // تقسيم الوظائف featured و regular
        [$featuredJobs, $regularJobs] = $jobs->partition(fn($job) => $job->featured);

        // ترتيب الوظائف الأخيرة حسب التاريخ
        $regularJobs = $regularJobs->sortByDesc('created_at');

        return view('jobs.index', [
            'featuredJobs' => $featuredJobs,
            'regularJobs' => $regularJobs,
            'tags' => Tag::all()
        ]);
    }

    public function create()
    {
        return view("jobs.create");
    }

    public function store(JobRequest $request)
    {
        $tags = json_decode($request->input('tags'), true);
        $tagIds = [];

        foreach ($tags as $tagName) {
            $tag = Tag::firstOrCreate(['name' => $tagName]);
            $tagIds[] = $tag->id;
        }

        $employer = Employer::firstOrCreate(
            ['user_id' => Auth::id()],
            ['name' => Auth::user()->name, 'logo' => Auth::user()->avatar]
        );

        $validatedData = $request->validated();
        $validatedData["employer_id"] = $employer->id;

        // رفع الصورة قبل إنشاء الوظيفة
        $validatedData['avatar'] = $this->uploadAvatar($request, null);

        $job = Job::create($validatedData);
        $job->tags()->sync($tagIds);

        return redirect()->route('jobs.index')->with('success', 'Job added successfully!');
    }

    public function show(Job $job)
    {
        return view("jobs.show", ["job" => $job, "employer" => $job->employer]);
    }

    public function edit(Job $job)
    {
        return view("jobs.edit", ["job" => $job, "tags" => $job->tags]);
    }

    public function update(JobRequest $request, Job $job)
    {
        $tags = json_decode($request->input('tags'), true);
        $tagIds = [];

        if (is_array($tags)) {
            foreach ($tags as $tag) {
                if (isset($tag['id']) && isset($tag['name'])) {
                    Tag::where("id", $tag['id'])->update(["name" => $tag['name']]);
                    $tagIds[] = $tag['id'];
                }
            }
        }

        $employer = Employer::firstOrCreate(
            ['user_id' => Auth::id()],
            ['name' => Auth::user()->name, 'logo' => Auth::user()->avatar]
        );

        $validatedData = $request->validated();
        $validatedData["employer_id"] = $employer->id;
        $validatedData['avatar'] = $this->uploadAvatar($request, $job->avatar);

        $job->update($validatedData);
        $job->tags()->sync($tagIds);

        return redirect()->route('jobs.show', $job->id)->with('success', 'Job updated successfully!');
    }

    public function destroy(Job $job)
    {
        Storage::disk('public')->delete('posts/' . $job->avatar);
        $job->delete();

        return redirect()->route('jobs.index')->with('success', 'Job deleted successfully.');
    }

    public function search(Request $request)
    {
        $query = $request->input("query");

        if (!$query) {
            return redirect()->route('jobs.index')->with('error', 'يجب إدخال كلمة للبحث.');
        }

        $jobs = Job::where("title", "LIKE", "%$query%")
            ->orWhereHas("tags", fn($q) => $q->where('name', 'LIKE', "%{$query}%"))
            ->with('tags', 'employer')
            ->get();

        return view('jobs.search', compact('jobs', 'query'));
    }

    private function uploadAvatar(Request $request, $currentAvatar = null)
    {
        if ($request->hasFile('avatar')) {
            if ($currentAvatar) {
                Storage::disk('public')->delete('posts/' . $currentAvatar);
            }
            $imageName = time() . '.' . $request->avatar->extension();
            $request->avatar->storeAs('posts', $imageName, 'public');
            return $imageName;
        }
        return $currentAvatar;
    }

    public function salaries()
    {
        $jobs = Job::with('employer')->orderBy('salary', 'desc')->get();

        return view('jobs.salary', compact('jobs'));
    }
}

<?PHP
namespace App\Http\Controllers;

use App\Http\Requests\JobRequest;
use App\Models\Job;
use App\Models\Tag;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;

class JobController extends Controller
{
    /**
     * Display all jobs and separate featured vs regular jobs.
     */
    public function index()
    {
        $jobs = Job::with('tags', 'user')->orderBy('featured', 'desc')->get();

        // Separate featured jobs from regular jobs
        [$featuredJobs, $regularJobs] = $jobs->partition(fn($job) => $job->featured);

        // Sort regular jobs by newest first
        $regularJobs = $regularJobs->sortByDesc('created_at');

        return view('jobs.index', [
            'featuredJobs' => $featuredJobs,
            'regularJobs' => $regularJobs,
            'tags' => Tag::all()
        ]);
    }

    /**
     * Show job creation form.
     */
    public function create()
    {
        return view("jobs.create");
    }

    /**
     * Store new job and handle tags and avatar.
     */
    public function store(JobRequest $request)
    {
        $tags = json_decode($request->input('tags'), true);
        $tagIds = [];

        // Create tags if not exists
        foreach ($tags as $tagName) {
            $tag = Tag::firstOrCreate(['name' => $tagName]);
            $tagIds[] = $tag->id;
        }

        $validatedData = $request->validated();
        $validatedData["user_id"] = Auth::id();
        $validatedData['avatar'] = $this->uploadAvatar($request, null);

        $job = Job::create($validatedData);

        // Attach tags
        $job->tags()->sync($tagIds);

        return redirect()->route('jobs.index')->with('success', 'Job added successfully!');
    }

    /**
     * Show a single job.
     */
    public function show(Job $job)
    {
        return view("jobs.show", ["job" => $job]);
    }

    /**
     * Show job edit form.
     */
    public function edit(Job $job)
    {
        return view("jobs.edit", ["job" => $job, "tags" => $job->tags]);
    }

    /**
     * Update job and related tags.
     */
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

        $validatedData = $request->validated();
        $validatedData["user_id"] = Auth::id();
        $validatedData['avatar'] = $this->uploadAvatar($request, $job->avatar);

        $job->update($validatedData);
        $job->tags()->sync($tagIds);

        return redirect()->route('jobs.show', $job->id)->with('success', 'Job updated successfully!');
    }

    /**
     * Delete job and its avatar from storage.
     */
    public function destroy(Job $job)
    {
        Storage::disk('public')->delete('posts/' . $job->avatar);
        $job->delete();

        return redirect()->route('jobs.index')->with('success', 'Job deleted successfully.');
    }

    /**
     * Search jobs by title or tags.
     */
    public function search(Request $request)
    {
        $query = $request->input("query");

        if (!$query) {
            return redirect()->route('jobs.index')->with('error', 'You must enter a search term.');
        }

        $jobs = Job::where("title", "LIKE", "%$query%")
            ->orWhereHas("tags", fn($q) => $q->where('name', 'LIKE', "%{$query}%"))
            ->with('tags', 'user')
            ->get();

        return view('jobs.search', compact('jobs', 'query'));
    }

    /**
     * Handle avatar upload for job posts.
     */
    private function uploadAvatar(Request $request, $currentAvatar = null)
    {
        if ($request->hasFile('avatar')) {
            // Delete old avatar if exists
            if ($currentAvatar) {
                Storage::disk('public')->delete('posts/' . $currentAvatar);
            }

            $imageName = time() . '.' . $request->avatar->extension();
            $request->avatar->storeAs('posts', $imageName, 'public');

            return $imageName;
        }

        return $currentAvatar;
    }

    /**
     * Show jobs sorted by salary.
     */
    public function salaries()
    {
        $jobs = Job::with('user')->orderBy('salary', 'desc')->get();
        return view('jobs.salary', compact('jobs'));
    }
}

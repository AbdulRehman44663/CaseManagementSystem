<div class="d-flex mb_26">
    <form id="search-form" class="d-flex w-100">
        <input type="text" id="search-input" class="form-control search_input text_16_500 mr_16" placeholder="Search for Task" style="flex: 1;">
        <button type="submit" class="btn ml-2 text_14_400 text-white br_6 bg_126C9B cp_3">Search</button>
    </form>
</div>
<div class="row">
    @foreach ($tasks as $task)
    @include('admin.tasks.partials.task-card', ['task' => $task])
    @endforeach
</div>
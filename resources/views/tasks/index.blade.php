@include('layouts.header')

@include('layouts.navigation')
    <!-- content -->
    <main class="py-5">
      <div class="container">
        <div class="row">
          <div class="col-md-12">
            <div class="card">
                <div class="card-header card-title">
                  <div class="d-flex align-items-center">
                    <h2 class="mb-0">All Tasks</h2>
                    @if (auth()->user()->role === 'manager')
                        <div class="ml-auto">
                        <a href="{{ route('tasks.create') }}" class="btn btn-success"><i class="fa fa-plus-circle"></i> Add New</a>
                        </div>
                    @endif
                  </div>
                </div>
              <div class="card-body">
                <div class="row">
                  <div class="col-md-6"></div>
                  <div class="col-md-6">
                        <form action="" method="GET" class="display-flex">
                            <div class="row">
                                @if (auth()->user()->role === 'developer')
                                    <div class="col">
                                        <input name="date" type="date" class="input-group mb-3 form-control" onchange="this.form.submit()" @if (request()->date) value="{{ request()->date }}" @endif>
                                    </div>
                                @endif
                                <div class="col">
                                    <div class="input-group mb-3">
                                        <input name='taskname' type="text" class="form-control" placeholder="Search..." aria-label="Search..." aria-describedby="button-addon2" @if (request()->date) value="{{ request()->taskname }}" @endif>
                                        <div class="input-group-append">
                                            <a href="{{ route('tasks.index') }}" class="btn btn-outline-secondary" type="button">
                                                <i class="fa fa-refresh"></i>
                                                </a>
                                            <button class="btn btn-outline-secondary" type="button" id="button-addon2" onclick="this.form.submit()">
                                            <i class="fa fa-search"></i>
                                            </button>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </form>
                  </div>
                </div>
                <table class="table table-striped table-hover">
                  <thead>
                    <tr>
                      <th scope="col">#</th>
                      <th scope="col">Task Name</th>
                      <th scope="col">Created_by</th>
                      <th scope="col">Assigned_to</th>
                      <th scope="col">Status</th>
                      <th scope="col">Created at</th>
                      <th scope="col">Actions</th>
                    </tr>
                  </thead>
                  <tbody>
                    @foreach ($tasks as $task)
                        <tr>
                            <th scope="row">{{ $loop->iteration + 10 * ($tasks->currentPage() - 1)   }}</th>
                            <td>{{ $task -> taskname }}</td>
                            <td>{{ $task -> created_by_user -> username }}</td>
                            <td>{{ $task -> assigned_to_user -> username }}</td>
                            @if (auth()->user()->role === 'developer' && auth()->user()->id === $task->assigned_to)
                                <td>
                                    <form action="{{ route("tasks.update", $task->id) }}" method='POST'>
                                        @csrf
                                        @method('PUT')
                                        <select name="status" id="status" onchange="this.form.submit()">
                                            @foreach ($statuses as $status )
                                            <option value="{{ $status }}" @if ($status === $task -> status) selected @endif>{{ $status }}</option>
                                            @endforeach
                                        </select>
                                        <input type="hidden" name="taskname" value="{{ $task -> taskname }}">
                                        <input type="hidden" name="assigned_to" value="{{ $task -> assigned_to }}">
                                        {{-- <input type="hidden" name="id" value="{{ $task->id }}"> --}}
                                    </form>
                                </td>
                            @else
                                <td>{{ $task -> status }}</td>
                            @endif
                            <td>{{ $task->created_at }}</td>
                            <td width="150">
                                <a href="{{ route('tasks.show', $task->id) }}" class="btn btn-sm btn-circle btn-outline-info" title="Show"><i class="fa fa-eye"></i></a>
                                @if (auth()->user()->role === 'manager')
                                    <a href="{{ route('tasks.edit', $task->id) }}" class="btn btn-sm btn-circle btn-outline-secondary" title="Edit"><i class="fa fa-edit"></i></a>
                                    <a class="btn btn-sm btn-circle btn-outline-danger" title="Delete" onclick="confirm('Are you sure?'); document.getElementById('delete-form').submit()"><i class="fa fa-times"></i></a>
                                    <form id="delete-form" action="{{ route('tasks.destroy', $task->id) }}" method="POST" class="diplay-none">
                                        @csrf
                                        @method("DELETE")
                                    </form>
                                @endif
                            </td>
                        </tr>
                    @endforeach
                  </tbody>
                </table>


                  {{ $tasks->links() }}
              </div>
            </div>
          </div>
        </div>
      </div>
    </main>

    <script src="{{asset('/assets/js/jquery.min.js')}}"></script>
    <script src="{{asset('/assets/js/popper.min.js')}}"></script>
    <script src="{{asset('/assets/js/bootstrap.min.js')}}"></script>
  </body>
</html>

@include('layouts.header')
    <!-- navbar -->
@include('layouts.navigation')

    <!-- content -->
    <main class="py-5">
      <div class="container">
        <div class="row justify-content-md-center">
          <div class="col-md-8">
            <div class="card">
              <div class="card-header card-title">
                <strong>Contact Details</strong>
              </div>
              <div class="card-body">
                <div class="row">
                  <div class="col-md-12">
                    <div class="form-group row">
                      <label for="taskname" class="col-md-3 col-form-label">Task Name</label>
                      <div class="col-md-9">
                        <p class="form-control-plaintext text-muted">{{ $task -> taskname }}</p>
                      </div>
                    </div>

                    <div class="form-group row">
                      <label for="created_by" class="col-md-3 col-form-label">Created By</label>
                      <div class="col-md-9">
                        <p class="form-control-plaintext text-muted">{{ $task -> created_by_user -> username }}</p>
                      </div>
                    </div>

                    <div class="form-group row">
                      <label for="assigned_to" class="col-md-3 col-form-label">Assigned To</label>
                      <div class="col-md-9">
                        <p class="form-control-plaintext text-muted">{{ $task -> assigned_to_user -> username }}</p>
                      </div>
                    </div>

                    <div class="form-group row">
                      <label for="description" class="col-md-3 col-form-label">Description</label>
                      <div class="col-md-9">
                        <p class="form-control-plaintext text-muted">{{ $task -> description }}</p>
                      </div>
                    </div>
                    <hr>
                    <div class="form-group row mb-0">
                      <div class="col-md-9 offset-md-3">
                            @if (auth()->user()->role === 'manager')
                                <a href="{{ route('tasks.edit', $task->id) }}" class="btn btn-info">Edit</a>
                                <a class="btn btn-outline-danger text-danger" title="Delete" onclick="confirm('Are you sure?'); document.getElementById('delete-form').submit()">Delete</a>
                            @endif
                            <a href="{{ route('tasks.index') }}" class="btn btn-outline-secondary">Cancel</a>
                      </div>
                    </div>
                    <form id="delete-form" action="{{ route('tasks.destroy', $task->id) }}" method="POST" class="diplay-none">
                        @csrf
                        @method("DELETE")
                    </form>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </main>

    <script src="assets/js/jquery.min.js"></script>
    <script src="assets/js/popper.min.js"></script>
    <script src="assets/js/bootstrap.min.js"></script>
  </body>
</html>

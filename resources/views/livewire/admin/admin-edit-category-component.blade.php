<div>
    <div class="container" style="padding: 30px 0;">
        <div class="row">
            <div class="col-md-12">
                <div class="panel panel-default">
                    <div class="panel-heading">
                        <div class="row">
                            <div class="col-md-6">
                                Edit Category
                            </div>
                            <div class="col-md-6">
                                <a href="{{route('admin.categories')}}" class="btn btn-success pull-right">All Category</a>
                            </div>
                        </div>

                    </div>
                    <div class="panel-body">
                        @if(Session::has('message'))
                         <div class="alert alert-success" role="alert">{{Session::get('message')}} </div>
                        @endif
                        <form class="form-horizontal" wire:submit.prevent="updateCategory">
                            <div class="form-group">
                                <label class="col-md-4 control-label">Category Name</label>
                                <div class="col-md-4">
                                   <input type="text" placeholder="Category Name" class="form-control input-md" wire:model="name" wire:keyup="generateslug"/>
                                   @error('name') <p class="text-danger">{{$message}}</p>
                                   @enderror
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="col-md-4 control-label">Category Slug</label>
                                <div class="col-md-4">
                                   <input type="text" placeholder="Category slug" class="form-control input-md" wire:model="slug"/>
                                   @error('slug') <p class="text-danger">{{$message}}</p>
                                   @enderror
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="col-md-4 control-label"></label>
                                <div class="col-md-4">
                                    <button type="submit" class="btn btn-primary">Update</button>
                                </div>
                            </div>
                        </form>
                    </div>

                </div>
            </div>
        </div>
    </div>
</div>


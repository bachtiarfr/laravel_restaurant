@extends('layouts.app')

@section('content')

<div class="container">
    <div class="d-flex flex-row-reverse">
        <div class="col-md-8 table-menu">
            <div class="card w-75 float-left">
                <div class="card-header">
                    New Menu
                    
                </div>

                <div class="card-body">
                        <form action="{{url('/items/add')}}" method="post" class="needs-validation" enctype="multipart/form-data" >
                            @csrf
                            <div class="form-group w-10">
                              <label for="formGroupExampleInput">Items Name</label>
                              <input type="text" class="form-control w-10" name="name" placeholder="Table Number" required>
                            </div>
                            <div class="form-group">
                              <label for="formGroupExampleInput2">Image</label>
                              <input type="file" class="form-control" name="image" placeholder="Another input" required>
                            </div>
                            <div class="form-group">
                              <label for="formGroupExampleInput2">Price</label>
                              <input type="text" class="form-control" name="price" placeholder="Another input" required>
                            </div>
                            <div class="form-group">
                              <label for="formGroupExampleInput2">Categorie</label>
                              <select name="categorie" class="form-control" required>
                                    <option value="makanan">Makanan</option>
                                    <option value="minuman">Minuman</option>
                                </select>
                            </div>
                            <div class="form-group">
                              <label for="formGroupExampleInput2">Status</label>
                              <select name="status" class="form-control" required>
                                    <option value="ready">Ready</option>
                                    <option value="not_ready">Not Ready</option>
                                </select>
                            </div>
                            
                            <button class="btn btn-primary" type="submit">Add</button>
    
                          </form>
                </div>
            </div>
        </div>
    </div>
</div>


@endsection

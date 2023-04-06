<form id="productForm">
    <div class="card  mt-5">
        <div class="card-header">
            <h2 class="display-6">Add Product</h2>
        </div>
        <div class="card-body">
            <div class="row">
                <div class="col-md-3">
                    <div class="mb-3">
                        <label for="" class="form-label"><strong>product Name</strong></label>
                        <input type="text" class="form-control" name="name" placeholder="Enter product Name" autocomplete="off"  required>
                    </div>
                </div>
                <div class="col-md-3">
                    <div class="mb-3">
                        <label for="" class="form-label"><strong>Quantity in Stock</strong></label>
                        <input type="number" class="form-control" name="quantity" min="1" placeholder="Enter quantity in stock" autocomplete="off"  required>
                    </div>
                </div>
                <div class="col-md-3">
                    <div class="mb-3">
                        <label for="" class="form-label"><strong>Price per item</strong></label>
                        <input type="number" class="form-control" name="price" min="1" placeholder="Enter price per item" autocomplete="off"  required>
                    </div>
                </div>
                <div class="col-md-3 d-flex justify-content-start align-items-center">
                    <div class="m-1">
                        <button type="submit" id="productBtn" class="btn btn-success">Add Product</button>
                    </div>
                </div>
            </div>
        </div>
    </div>

</form>

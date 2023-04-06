$(document).ready(function () {
    renderProductlist()
    // handling add event
    $('#productBtn').on('click', function (e) {
        if ($('input[name="name"]').val() != '' && $('input[name="quantity"]').val() != '' && $('input[name="price"]').val() != '') {
            e.preventDefault();
            submitProduct()
        }
    })

    // add project ajax method
    function submitProduct() {
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': csrfToken
            }
        });
        $.ajax({
            type: 'POST',
            url: productCreateUrl,
            data: $('#productForm').serialize(),
            success: function (data) {
                console.log(data)
                toastr.success(data, '')
                $('input').val('')
                renderProductlist()
            },
            error: function (data) {
                toastr.error(data, '')
            }
        });
    }

    // update project ajax method
    function updateProductRecord() {
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': csrfToken
            }
        });
        $.ajax({
            type: 'POST',
            url: productUpdateUrl,
            data: $('#editProduct').serialize(),
            success: function(data) {
                console.log(data)
                toastr.success(data, '')
                $('#editProduct input').val('')
                $('#exampleModal').modal('hide')
                renderProductlist()
                
            },
            error: function(data) {
                toastr.error("something went wrong", '')
            }
        });
    }

    // edit icon action button for inline edit
    $(document).on('click', '.inline-edit', function() {
        $('#productId').val($(this).attr('data-attr-id'))
        $('#editProduct input[name="name"]').val($(this).attr('data-name'))
        $('#editProduct input[name="quantity"]').val($(this).attr('data-quantity'))
        $('#editProduct input[name="price"]').val($(this).attr('data-price'))
    })

    //save button for model to update data
    $(document).on('click', '#updateProductBtn', function(e) {
        if ($('#editProduct input[name="name"]').val() != "" &&
            $('#editProduct input[name="quantity"]').val() != "" &&
            $('#editProduct input[name="price"]').val() != "") {
            updateProductRecord();
            e.preventDefault();
        }
    })

//    ajax method for rendering list
    function renderProductlist() {
        $.ajax({
            type: 'get',
            url: productListUrl,
            data: $('#productForm').serialize(),
            success: function (data) {
                var html = '';
                console.log(data);
                let totalValue = 0;
                $.each(data, function (i, item) {
                    html += renderTableDataTemplate(item, i)
                    totalValue += (parseInt(item.price) * parseInt(item.quantity))
                });
                $('#tableData').html(html);
                if (totalValue != 0) {
                    $('#tableData').append(renderTotalValueRow(totalValue));
                }
            },
            error: function (data) {
                console.log(data)
                toastr.error(data, '')
            }
        });
    }

//    method for rendering table row 
    function renderTableDataTemplate(data, key) {
        let dateTimeObject = moment(data.date_time);
        return `<tr class="text-center">
                <td scope="row">${(parseInt(key)+1)}</td>
                        <td>${data.name}</td>
                        <td>${data.quantity}</td>
                        <td>${data.price}</td>
                        <td>${dateTimeObject.format('MMMM Do YYYY, h:mm:ss a')}</td>
                        <td>${parseInt(data.price) * parseInt(data.quantity)}</td>
                        <td><button type="button" class="inline-edit border-0" data-bs-toggle="modal" data-bs-target="#exampleModal" data-attr-id="${data.id}" data-name="${data.name}" data-quantity="${data.quantity}" data-price="${data.price}"><i class="fa-solid fa-pen-to-square"></i></button></td>
                </tr>`
    }

//    method for rendering table row for total value 
    function renderTotalValueRow(data) {
        return `<tr class="text-center table-dark">
                        <td colspan="5"><strong>Total Value</strong></td>
                        <td colspan="2"><strong>${data}</strong></td>
                    </tr>`
    }

});

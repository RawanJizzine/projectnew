'use strict';


var deleteUrl,user_id;
// datatable (jquery)
var dt_basic_table = $('.datatables-basic'), dt_basic, ajaxUrl = dt_basic_table.data('url');
$(function () {
    // DataTable with buttons
    // --------------------------------------------------------------------
    let columnData = [];
    $.each($("#datatable thead th"), function (index, element) {
        columnData.push({
            data: $(element).text().toLowerCase().replace(" ", "_"),
            defaultContent: "",
        });
    });

    if (dt_basic_table.length) {
        dt_basic = dt_basic_table.DataTable({
            ajax: ajaxUrl,
            columns: columnData,
            columnDefs: [
                {
                    // For Responsive
                    className: 'control',
                    orderable: false,
                    searchable: false,
                    responsivePriority: 2,
                    targets: 0,
                    render: function (data, type, full, meta) {
                        return '';
                    }
                },
                {
                    // For Checkboxes
                    targets: 1,
                    orderable: false,
                    searchable: false,
                    responsivePriority: 3,
                    checkboxes: true,
                    render: function () {
                        return '<input type="checkbox" class="dt-checkboxes form-check-input">';
                    },
                    checkboxes: {
                        selectAllRender: '<input type="checkbox" class="form-check-input">'
                    }
                },
                {
                    targets: 'image',
                    searchable: false,
                    orderable: false,
                    responsivePriority: 4,
                    render: function (data, type, full, meta) {
                        return '<img src="' + data + '" alt="Avatar" class="' + dt_basic_table.data('image-class') + '" width="50px">';

                    },
                },
                {
                    targets: 'status',
                    searchable: true,
                    orderable: true,
                    responsivePriority: 5,
                    render: function (data, type, full, meta) {
                        var $status = {
                            'Active': { title: 'Active', class: ' bg-label-success' },
                            'Inactive': { title: 'Inactive', class: ' bg-label-danger' },
                            'Pending': { title: 'Pending', class: ' bg-label-primary' },
                            'Pending': { title: 'Pending', class: ' bg-label-warning' },
                            'Pending': { title: 'Pending', class: ' bg-label-info' }
                        };
                        if (typeof $status[data] === 'undefined') {
                            return data;
                        }
                        return (
                            '<span class="badge ' + $status[data].class + '">' + $status[data].title + '</span>'
                        );
                    },
                },
                {
                    // Actions
                    targets: 'actions',
                    title: 'Actions',
                    orderable: false,
                    searchable: false,
                    render: function (data, type, full, meta) {
                      
                        var actions = dt_basic_table.data('actions');
                        var actionHtml = '';
                        actions.forEach(element => {
                            if (element.modal) {
                                actionHtml += '<li><a href="" data-bs-toggle="offcanvas" data-bs-target="#' + element.modal + '" aria-controls="' + element.modal + '" class="dropdown-item"><i class="text-primary ' + element.icon + '"></i>' + element.title + '</a></li><div class="dropdown-divider" ></div>';
                            } else {
                                actionHtml += '<li><a data-id="'+full['id']+'" href="'+(element.action=='delete'? 'javascript:;' : element.route)+'" class="dropdown-item '+(element.action=='delete'? 'delete-record' : '')+'"><i class="text-primary ' + element.icon + '"></i>' + element.title + '</a></li><div class="dropdown-divider" ></div>';
                                if(element.action=='delete'){
                                    deleteUrl = element.route;
                                }
                            }
                        });
                        return (
                            '<div class="d-inline-block"><a href="javascript:;" class="btn btn-sm btn-icon dropdown-toggle hide-arrow" data-bs-toggle="dropdown"><i class="text-primary ti ti-dots"></i></a>' +
                            '<ul class="dropdown-menu dropdown-menu-end m-0" >' +
                            actionHtml +
                            '</ul>' +
                            '</div>'
                        );
                        // return (
                        //     '<div class="d-flex align-items-center col-actions">' +
                        //     '<a class="me-1 btn btn-primary btn-sm" href="'+dt_basic_table.data('edit-url')+'/'+full.id+'"><i class="fa fa-edit"></i></a>' +
                        //     '<a class="me-1 btn btn-danger btn-sm delete-record" href="javascript:;" data-href="'+dt_basic_table.data('delete-url')+'/'+full.id+'"><i class="fa fa-trash"></i></a>' +
                        //     '</div>'
                        // );
                        // console.log(data)
                        // var textArea = document.createElement('textarea');
                        // textArea.innerHTML = data;
                        // return textArea.value;
                    }
                }

            ],
            // order: [[2, dt_basic_table.data('order')]],
            // dom: '<"card-header flex-column flex-md-row"<"head-label text-center"><"dt-action-buttons text-end pt-3 pt-md-0"B>><"row"<"col-sm-12 col-md-6"l><"col-sm-12 col-md-6 d-flex justify-content-center justify-content-md-end"f>>t<"row"<"col-sm-12 col-md-6"i><"col-sm-12 col-md-6"p>>',
            // displayLength: 7,
            // lengthMenu: [7, 10, 25, 50, 75, 100],
            // buttons: [
            // {
            //     extend: 'collection',
            //     className: 'btn btn-label-primary dropdown-toggle me-2',
            //     text: '<i class="ti ti-file-export me-sm-1"></i> <span class="d-none d-sm-inline-block">Export</span>',
            //     buttons: [
            //         {
            //             extend: 'print',
            //             text: '<i class="ti ti-printer me-1" ></i>Print',
            //             className: 'dropdown-item',
            //             exportOptions: {
            //                 columns: [3, 4, 5, 6, 7],
            //                 // prevent avatar to be display
            //                 format: {
            //                     body: function (inner, coldex, rowdex) {
            //                         if (inner.length <= 0) return inner;
            //                         var el = $.parseHTML(inner);
            //                         var result = '';
            //                         $.each(el, function (index, item) {
            //                             if (item.classList !== undefined && item.classList.contains('user-name')) {
            //                                 result = result + item.lastChild.firstChild.textContent;
            //                             } else if (item.innerText === undefined) {
            //                                 result = result + item.textContent;
            //                             } else result = result + item.innerText;
            //                         });
            //                         return result;
            //                     }
            //                 }
            //             },
            //             customize: function (win) {
            //                 //customize print view for dark
            //                 $(win.document.body)
            //                     .css('color', config.colors.headingColor)
            //                     .css('border-color', config.colors.borderColor)
            //                     .css('background-color', config.colors.bodyBg);
            //                 $(win.document.body)
            //                     .find('table')
            //                     .addClass('compact')
            //                     .css('color', 'inherit')
            //                     .css('border-color', 'inherit')
            //                     .css('background-color', 'inherit');
            //             }
            //         },
            //         {
            //             extend: 'csv',
            //             text: '<i class="ti ti-file-text me-1" ></i>Csv',
            //             className: 'dropdown-item',
            //             exportOptions: {
            //                 columns: [3, 4, 5, 6, 7],
            //                 // prevent avatar to be display
            //                 format: {
            //                     body: function (inner, coldex, rowdex) {
            //                         if (inner.length <= 0) return inner;
            //                         var el = $.parseHTML(inner);
            //                         var result = '';
            //                         $.each(el, function (index, item) {
            //                             if (item.classList !== undefined && item.classList.contains('user-name')) {
            //                                 result = result + item.lastChild.firstChild.textContent;
            //                             } else if (item.innerText === undefined) {
            //                                 result = result + item.textContent;
            //                             } else result = result + item.innerText;
            //                         });
            //                         return result;
            //                     }
            //                 }
            //             }
            //         },
            //         {
            //             extend: 'excel',
            //             text: '<i class="ti ti-file-spreadsheet me-1"></i>Excel',
            //             className: 'dropdown-item',
            //             exportOptions: {
            //                 columns: [3, 4, 5, 6, 7],
            //                 // prevent avatar to be display
            //                 format: {
            //                     body: function (inner, coldex, rowdex) {
            //                         if (inner.length <= 0) return inner;
            //                         var el = $.parseHTML(inner);
            //                         var result = '';
            //                         $.each(el, function (index, item) {
            //                             if (item.classList !== undefined && item.classList.contains('user-name')) {
            //                                 result = result + item.lastChild.firstChild.textContent;
            //                             } else if (item.innerText === undefined) {
            //                                 result = result + item.textContent;
            //                             } else result = result + item.innerText;
            //                         });
            //                         return result;
            //                     }
            //                 }
            //             }
            //         },
            //         {
            //             extend: 'pdf',
            //             text: '<i class="ti ti-file-description me-1"></i>Pdf',
            //             className: 'dropdown-item',
            //             exportOptions: {
            //                 columns: [3, 4, 5, 6, 7],
            //                 // prevent avatar to be display
            //                 format: {
            //                     body: function (inner, coldex, rowdex) {
            //                         if (inner.length <= 0) return inner;
            //                         var el = $.parseHTML(inner);
            //                         var result = '';
            //                         $.each(el, function (index, item) {
            //                             if (item.classList !== undefined && item.classList.contains('user-name')) {
            //                                 result = result + item.lastChild.firstChild.textContent;
            //                             } else if (item.innerText === undefined) {
            //                                 result = result + item.textContent;
            //                             } else result = result + item.innerText;
            //                         });
            //                         return result;
            //                     }
            //                 }
            //             }
            //         },
            //         {
            //             extend: 'copy',
            //             text: '<i class="ti ti-copy me-1" ></i>Copy',
            //             className: 'dropdown-item',
            //             exportOptions: {
            //                 columns: [3, 4, 5, 6, 7],
            //                 // prevent avatar to be display
            //                 format: {
            //                     body: function (inner, coldex, rowdex) {
            //                         if (inner.length <= 0) return inner;
            //                         var el = $.parseHTML(inner);
            //                         var result = '';
            //                         $.each(el, function (index, item) {
            //                             if (item.classList !== undefined && item.classList.contains('user-name')) {
            //                                 result = result + item.lastChild.firstChild.textContent;
            //                             } else if (item.innerText === undefined) {
            //                                 result = result + item.textContent;
            //                             } else result = result + item.innerText;
            //                         });
            //                         return result;
            //                     }
            //                 }
            //             }
            //         }
            // ]
            // },
            // {
            //     text: '<i class="ti ti-plus me-sm-1"></i> <span class="d-none d-sm-inline-block">Add New Record</span>',
            //     className: 'create-new btn btn-primary'
            // }
            // ],
            responsive: {
                details: {
                    display: $.fn.dataTable.Responsive.display.modal({
                        header: function (row) {
                            var data = row.data();
                            return 'Details: ';
                        }
                    }),
                    type: 'column',
                    renderer: function (api, rowIdx, columns) {
                        var data = $.map(columns, function (col, i) {
                            console.log(col);
                            return col.title !== '' // ? Do not show row in modal popup if title is blank (for check box)
                                ? '<tr data-dt-row="' +
                                col.rowIndex +
                                '" data-dt-column="' +
                                col.columnIndex +
                                '">' +
                                '<td>' +
                                col.title +
                                ':' +
                                '</td> ' +
                                '<td>' +
                                col.data +
                                '</td>' +
                                '</tr>'
                                : '';
                        }).join('');

                        return data ? $('<table class="table"/><tbody/>').append(data) : false;
                    }
                }
            }
        });
        $('div.head-label').html('<h5 class="card-title mb-0">' + dt_basic_table.data('title') + '</h5>');
    }





});
// Delete Record
$(document).on('click', '.delete-record', function () {
    var user_id =$(this).data('id'),
        dtrModal = $('.dtr-bs-modal.show');

    // hide responsive modal in small screen
    if (dtrModal.length) {
        dtrModal.modal('hide');
    }

    // sweetalert for confirmation of delete
    Swal.fire({
        title: 'Are you sure?',
        text: "You won't be able to revert this!",
        icon: 'warning',
        showCancelButton: true,
        confirmButtonText: 'Yes, delete it!',
        customClass: {
            confirmButton: 'btn btn-primary me-3',
            cancelButton: 'btn btn-label-secondary'
        },
        buttonsStyling: false
    }).then(function (result) {
        if (result.value) {
            // delete the data
            $.ajax({
                type: 'POST',
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                },
                url: deleteUrl + '/' + user_id,
                success: function () {
                    dt_basic_table.DataTable().ajax.reload();
                },
                error: function (error) {
                    console.log(error);
                }
            });

            // success sweetalert
            Swal.fire({
                icon: 'success',
                title: 'Deleted!',
                text: 'The user has been deleted!',
                customClass: {
                    confirmButton: 'btn btn-success'
                }
            });
        } else if (result.dismiss === Swal.DismissReason.cancel) {
            Swal.fire({
                title: 'Cancelled',
                text: 'The User is not deleted!',
                icon: 'error',
                customClass: {
                    confirmButton: 'btn btn-success'
                }
            });
        }
    });
});

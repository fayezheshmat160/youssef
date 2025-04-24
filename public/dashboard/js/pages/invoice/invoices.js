import { responseStatus } from "../../modules/requests-response.js";

$(document).ready(function () {
    // Append New Item
    $("#btn-append-item").click(function (e) {
        e.preventDefault();
        $(".form-inputs").append(
            `<div class="item-parent col-12"> <div class="row"> <div class="col-lg-8 col-md-7 col-12"> <div class="form-group "> <input type="text" name="title[]" value="" data-name="title" required="" placeholder="Item Title"> </div></div><div class="col-lg-3 col-md-3 col-9"> <div class="input-group mb-3"> <div class="input-group-prepend"> <span class="input-group-text">$</span> </div><input type="number" step="any" name="price[]" class="input-price form-control w-25" required=""> </div></div><div class="col-lg-1 col-md-2 col-3"> <button type="button" class="btn-remove-item text-center btn-block text-danger bg-soft-danger radius py-2"><svg class="svg-inline--fa fa-trash-can" aria-hidden="true" focusable="false" data-prefix="fas" data-icon="trash-can" role="img" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 448 512" data-fa-i2svg=""><path fill="currentColor" d="M135.2 17.69C140.6 6.848 151.7 0 163.8 0H284.2C296.3 0 307.4 6.848 312.8 17.69L320 32H416C433.7 32 448 46.33 448 64C448 81.67 433.7 96 416 96H32C14.33 96 0 81.67 0 64C0 46.33 14.33 32 32 32H128L135.2 17.69zM31.1 128H416V448C416 483.3 387.3 512 352 512H95.1C60.65 512 31.1 483.3 31.1 448V128zM111.1 208V432C111.1 440.8 119.2 448 127.1 448C136.8 448 143.1 440.8 143.1 432V208C143.1 199.2 136.8 192 127.1 192C119.2 192 111.1 199.2 111.1 208zM207.1 208V432C207.1 440.8 215.2 448 223.1 448C232.8 448 240 440.8 240 432V208C240 199.2 232.8 192 223.1 192C215.2 192 207.1 199.2 207.1 208zM304 208V432C304 440.8 311.2 448 320 448C328.8 448 336 440.8 336 432V208C336 199.2 328.8 192 320 192C311.2 192 304 199.2 304 208z"></path></svg></button> </div></div></div>`
        );
        removeItem();
    });

    // Remove Item
    function removeItem() {
        $(".btn-remove-item").click(function (e) {
            e.preventDefault();

            let targetBtn = $(this),
                itemParent = ".item-parent",
                itemLength = document.querySelectorAll(".item-parent").length;

            // Check If Have Less Than 1 Item
            if (itemLength > 1) {
                targetBtn.parents(itemParent).slideUp(100);

                setTimeout(removeElementFromDom, 150);

                // Remove Item From Dom
                function removeElementFromDom() {
                    targetBtn.parents(itemParent).remove();
                }
            } else {
                toastr.warning("There must be at least one item", "Warning");
            }
        });
    }
    removeItem();

    /**
     * Prepare Var
     */

    let showInvoiceSection = $("#show-invoice"),
        invoiceDetailsBox = $(".details-box"),
        invoiceDetailsSpinner = $(".spinner");

    // Show Invoice Row Details
    $(".invoice-row").click(function (e) {
      //  e.preventDefault();
        let invoiceId = $(this).attr("data-id"),
            requestUrl = adminUrl + "/invoices/get-invoice";

        // Get Length Of table tr
        let tr = document.querySelectorAll(".transaction-value"),
            tableTrLength = tr.length;

        // Send Request For Get Data
        $.post(
            requestUrl,
            { id: invoiceId },
            function (row, textStatus, jqXHR) {
                if (row.status == "error") {
                    responseStatus(row);
                } else {
                    if (textStatus == "success") {
                        // Show & Hide
                        showInvoiceSection.fadeIn(150);
                        invoiceDetailsBox.hide();
                        invoiceDetailsSpinner.show(0);

                        // Prepare Var
                        let tableInvoiceItems = $(".table-invoice-items"),
                            totalAmount = 0,
                            items = row.items;

                        // Empty Table Items For Set New
                        tableInvoiceItems.empty();

                        /**
                         * Set Data
                         */

                        // Method
                        if (row.method == null) {
                            tr[1].innerHTML = "Unknown";
                        } else {
                            tr[1].innerHTML = row.method;
                        }

                        //  Status
                        if (row.status == 1) {
                            tr[2].innerHTML = "Paid";
                        } else if (row.status == 2) {
                            tr[2].innerHTML = "Pinding";
                        } else {
                            tr[2].innerHTML = "UnPaid";
                        }

                        $(".transaction-id").text(row.id);
                        tr[3].innerHTML = row.created_at;
                        tr[4].innerHTML = row.expired_at;
                        tr[5].innerHTML = row.client_name;
                        tr[6].innerHTML = row.invoice_to;

                        // Set Items
                        for (let i = 0; i < items.length; i++) {
                            $(".table-invoice-items").append(`<tr>
                          <td class=" font-weight-400 font-15">${
                              items[i].title
                          }</td>
                          <td class=" font-15">: ${"$" + items[i].price}</td>
                          </tr><!-- total -->`);

                            totalAmount += parseFloat(items[i].price);
                        }

                        tr[0].innerHTML = "$" + totalAmount; // Set Total Amount

                        // Show & Hide Spinner
                        setTimeout(() => {
                            invoiceDetailsBox.fadeIn(150);
                            invoiceDetailsSpinner.hide(0);
                            // Scroll To Down
                            $("html, body").animate(
                                {
                                    scrollTop:
                                        $("#show-invoice").offset().top - 85,
                                },
                                0
                            );
                        }, 300);
                    } else {
                        toastr.error(
                            "Error Request To Get Invoice Data [ invoice.js ]",
                            "Notfound!"
                        );
                    }
                }
            },
            "json"
        );
    });

    // Close Invoice Details
    $(".close-and-delete-actions").click(function (e) {
        e.preventDefault();
        showInvoiceSection.fadeOut(100);
    });

    $("#myTable").DataTable({
        pageLength: 10,
        // searching: true,
        // ordering: true,
        // select: {
        //     style: "os",
        //     selector: "td:first-child",
        // },
        // order: [[1, "desc"]],
        // columnDefs: [
        //     {
        //         orderable: false,
        //         className: "select-checkbox",
        //         targets: 0,
        //     },
        // ],
        // select: {
        //     style: "os",
        //     selector: "td:first-child",
        // },
        // order: [[1, "asc"]],
    });

    
});

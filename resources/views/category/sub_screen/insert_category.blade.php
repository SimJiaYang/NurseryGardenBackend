@extends('layouts.app')

@section('content')
    <style>
        .card-registration .select-input.form-control[readonly]:not([disabled]) {
            font-size: 1rem;
            line-height: 2.15;
            padding-left: .75em;
            padding-right: .75em;
        }

        .card-registration {
            background-color: #ECFFDC;
            box-shadow: 0 2px 5px 0 rgb(0 0 0 / 16%), 0 2px 10px 0 rgb(0 0 0 / 12%);
        }

        /* .card-registration .select-arrow {
                                                                                                                                            top: 13px;
                                                                                                                                        } */
    </style>
    <script>
        function getSelectedOption() {
            var selectElement = document.getElementById("selectOption");
            var selectedOptionValue = selectElement.value;

            if (selectedOptionValue === "1") {
                alert("Please select an option");
                return false; // Prevent form submission
            } else {
                // You can now use the selectedOptionValue in your further processing
                return true; // Allow form submission
            }
        }
    </script>

    <section class=" gradient-custom">
        <div class="container py-5 h-100">
            <div class="row justify-content-center align-items-center h-100">
                <div class="col-12 col-lg-9 col-xl-7">
                    <div class="card shadow-2-strong card-registration" style="border-radius: 15px;">
                        <div class="card-body p-4 p-md-5">
                            <h3 class="mb-4 pb-2 pb-md-0 mb-md-5">Add Category</h3>
                            <form onsubmit="return getSelectedOption();">
                                @csrf
                                <div class="row">
                                    <div class="col-md-6 mb-4 d-flex align-items-center">

                                        <div class="form-outline">
                                            <input type="text" id="name" name="name"
                                                class="form-control form-control-lg" placeholder="Category Name" required />
                                            <label class="form-label" for="name">Category Name</label>
                                        </div>


                                    </div>
                                    <div class="col-md-6 mb-4 ">
                                        <select class="select form-control-lg px-3" id="selectOption" name="option">
                                            <option value="1" disabled selected>Choose option</option>
                                            <option value="2">Plant</option>
                                            <option value="3">Product</option>
                                        </select>
                                        <div class="w-100"></div>
                                        <label class="form-label">Category Type</label>
                                    </div>
                                </div>

                                <div class="mt-1 pt-2">
                                    <input class="btn btn-lg" style="background-color: #00A36C; color: white;"
                                        type="submit" value="Submit" />
                                </div>

                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection
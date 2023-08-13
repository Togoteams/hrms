    <!-- Modal -->
    <div class="modal fade" id="staticBackdrop" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1"
        aria-labelledby="staticBackdropLabel" aria-hidden="true">
        <div class="modal-dialog modal-md">
            <div class="modal-content ">
                <div class="modal-header ">
                    <h5 class="modal-title" id="staticBackdropLabel">{{ $page }}</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form  action="" method="GET">
                        <div class="row">
                            <div class="mb-2 col-sm-6">
                                <div class="form-group">
                                    <label for="increment_percentage">Salary Increment %</label>
                                    <input required id="increment_percentage" placeholder="Enter Increment Percentage of Salary" min="1" max="100" type="number"
                                        name="increment_percentage" class="form-control form-control-sm ">
                                </div>
                            </div>
                         
                            <div class="mb-2 col-sm-6">
                                <div class="form-group">
                                    <label  for="employment_type">Employment Type</label>
                                    <select required id="employment_type" name="employment_type" value="local"
                                        class="form-control form-control-sm">
                                        <option selected disabled=""> -Select employment type- </option>
                                        <option value="both">All</option>
                                        <option value="local">Local</option>
                                        <option value="expatriate">Expatriate</option>
                                        <option value="local-contractual">Local-Contractual</option>
                                        <option value="both">Local and Expatriate</option>
                                    </select>
                                </div>
                            </div>
            
                            <div class="mb-2 col-sm-6">
                                <div class="form-group">
                                    <label  for="financial_year">Financial year</label>
                                    <select required id="financial_year" name="financial_year"
                                        class="form-control form-control-sm">
                                        <option selected disabled=""> - Select financial year- </option>
                                        @php
                                            $currentYear = date('Y');
                                        @endphp 
                                        <option value="{{$currentYear-2}}">{{$currentYear-2}}</option>
                                        <option value="{{$currentYear-1}}">{{$currentYear-1}}</option>
                                        <option value="{{$currentYear}}">{{$currentYear}}</option>
                                        <option value="{{$currentYear+1}}">{{$currentYear+1}}</option>
                                        <option value="{{$currentYear+2}}">{{$currentYear+2}}</option>
                                    </select>
                                </div>
                            </div>

                        </div>
                        <hr>
                        <div class="text-center ">
                            {{-- <button onclick="ajaxCall('form_data')" type="button" class="btn btn-white">Apply
                                </button> --}}
                                <button type="submit" class="btn btn-white">Apply</button>
                        </div>
                    </form>
                </div>

            </div>
        </div>
    </div>
    <script>
        function chagne_type(data) {
            if (data == "flat") {
                document.getElementById('type_id').innerText = data + " amount"
            } else {
                document.getElementById('type_id').innerText = data

            }
        }
    </script>


<!-- Button trigger modal -->
<button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#newCustomerModal">
                <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-bag-plus-fill" viewBox="0 0 16 16">
                  <path fill-rule="evenodd" d="M10.5 3.5a2.5 2.5 0 0 0-5 0V4h5zm1 0V4H15v10a2 2 0 0 1-2 2H3a2 2 0 0 1-2-2V4h3.5v-.5a3.5 3.5 0 1 1 7 0M8.5 8a.5.5 0 0 0-1 0v1.5H6a.5.5 0 0 0 0 1h1.5V12a.5.5 0 0 0 1 0v-1.5H10a.5.5 0 0 0 0-1H8.5z"/>
                </svg>

</button>

<!-- Modal -->
<div class="modal fade" id="newCustomerModal" tabindex="-1" aria-labelledby="newCustomerModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h1 class="modal-title fs-5" id="newCustomerModalLabel">New Customer</h1>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">

        <form class="row g-3" method ="post" action = "">
          <div class="col-md-6">
            <label for="cFName" class="form-label"> First Name</label>
            <input type="text" class="form-control" id="cFName" name="cFName">
          </div>
         <div class="col-md-6">
            <label for="cLName" class="form-label"> Last Name</label>
            <input type="text" class="form-control" id="cLName" name="cLName">
          </div>
          <div class="col-12">
            <label for="cAddress" class="form-label">Email</label>
            <input type="email" class="form-control" id="cEmail" name= "cEmail">
          </div>
          <div class="col-12">
            <label for="cPhone" class="form-label"> Phone</label>
            <input type="text" class="form-control" id="cPhone" name="cPhone">
          </div>
                <input type= "hidden" name = "actionType", value="Add">
          <div class="col-12">
            <button type="submit" class="btn btn-primary">Save</button>
          </div>
        </form>

        
      </div>
    </div>
  </div>
</div>

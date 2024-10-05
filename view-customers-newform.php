
<!-- Button trigger modal -->
<button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#newCustomerModal">
        <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-person-plus" viewBox="0 0 16 16">
          <path d="M6 8a3 3 0 1 0 0-6 3 3 0 0 0 0 6m2-3a2 2 0 1 1-4 0 2 2 0 0 1 4 0m4 8c0 1-1 1-1 1H1s-1 0-1-1 1-4 6-4 6 3 6 4m-1-.004c-.001-.246-.154-.986-.832-1.664C9.516 10.68 8.289 10 6 10s-3.516.68-4.168 1.332c-.678.678-.83 1.418-.832 1.664z"/>
          <path fill-rule="evenodd" d="M13.5 5a.5.5 0 0 1 .5.5V7h1.5a.5.5 0 0 1 0 1H14v1.5a.5.5 0 0 1-1 0V8h-1.5a.5.5 0 0 1 0-1H13V5.5a.5.5 0 0 1 .5-.5"/>
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
          <div class="col-12">
            <button type="submit" class="btn btn-primary">Save</button>
          </div>
        </form>

        
      </div>
    </div>
  </div>
</div>

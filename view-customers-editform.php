
<!-- Button trigger modal -->
<button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#editCustomerModal<?php echo $customer['customer_id'];?>">
      <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-pencil-square" viewBox="0 0 16 16">
        <path d="M15.502 1.94a.5.5 0 0 1 0 .706L14.459 3.69l-2-2L13.502.646a.5.5 0 0 1 .707 0l1.293 1.293zm-1.75 2.456-2-2L4.939 9.21a.5.5 0 0 0-.121.196l-.805 2.414a.25.25 0 0 0 .316.316l2.414-.805a.5.5 0 0 0 .196-.12l6.813-6.814z"/>
        <path fill-rule="evenodd" d="M1 13.5A1.5 1.5 0 0 0 2.5 15h11a1.5 1.5 0 0 0 1.5-1.5v-6a.5.5 0 0 0-1 0v6a.5.5 0 0 1-.5.5h-11a.5.5 0 0 1-.5-.5v-11a.5.5 0 0 1 .5-.5H9a.5.5 0 0 0 0-1H2.5A1.5 1.5 0 0 0 1 2.5z"/>
      </svg>

</button>

<!-- Modal -->
<div class="modal fade" id="editCustomerModal<?php echo $customer['customer_id'];?>" tabindex="-1" aria-labelledby="editCustomerModalLabel<?php echo $customer['customer_id'];?>" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h1 class="modal-title fs-5" id="editCustomerModalLabel">Edit Customer</h1>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">

        <form class="row g-3" method ="post" action = "">
          <div class="col-md-6">
            <label for="cFName<?php echo $customer['customer_id'];?>" class="form-label"> First Name</label>
            <input type="text" class="form-control" id="cFName<?php echo $customer['customer_id'];?>" name="cFName" value="<?php echo $customer['customer_firstname];?>">
          </div>
         <div class="col-md-6">
            <label for="cLName <?php echo $customer['customer_id'];?>" class="form-label"> Last Name</label>
            <input type="text" class="form-control" id="cLName<?php echo $customer['customer_id'];?>" name="cLName" value ="<?php echo $customer['customer_lastname'];?>">
          </div>
          <div class="col-12">
            <label for="cEmail <?php echo $customer['customer_id'];?>" class="form-label">Email</label>
            <input type="email" class="form-control" id="cEmail <?php echo $customer['customer_id'];?>" name= "cEmail" value="<?php echo $customer['customer_email'];?>">
          </div>
          <div class="col-12">
            <label for="cPhone <?php echo $customer['customer_id'];?>" class="form-label"> Phone</label>
            <input type="text" class="form-control" id="cPhone <?php echo $customer['customer_id'];?>" name="cPhone" value="<?php echo $customer['customer_phone'];?>">
          </div>
            <input type="hidden" name="cid" value="<?php echo $customer['customer_id'];?>">
            <input type= "hidden" name = "actionType", value="Edit">
          <div class="col-12">
            <button type="submit" class="btn btn-primary">Save</button>
          </div>
        </form>

        
      </div>
    </div>
  </div>
</div>
